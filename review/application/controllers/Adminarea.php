<?php
/**
 * Adminarea
 *
 * PHP Version 5.6
 *
 * Adminarea contains the Adminarea class for admin account
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

/**
 * Adminarea class - contains all metods and pages for admin account.
 *
 * @category Social
 * @package Midrub
 * @author Scrisoft <asksyn@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link https://www.midrub.com/
 */
class Adminarea extends MY_Controller {

    private $user_id, $user_role, $socials = [];

    public function __construct() {
        parent::__construct();
        
        // Load form helper library
        $this->load->helper('form');
        
        // Load form validation library
        $this->load->library('form_validation');
        
        // Load User Model
        $this->load->model('user');
        
        // Load User Meta Model
        $this->load->model('user_meta');
        
        // Load Notifications Model
        $this->load->model('notifications');
        
        // Load Posts Model
        $this->load->model('posts');
        
        // Load Plans Model
        $this->load->model('plans');
        
        // Load Urls Model
        $this->load->model('urls');
        
        // Load Networks Model
        $this->load->model('networks');
        
        // Load Options Model
        $this->load->model('options');
        
        // Load Campaigns Model
        $this->load->model('campaigns');
        
        // Load RSS Model
        $this->load->model('rss');
        
        // Load session library
        $this->load->library('session');
        
        // Load URL Helper
        $this->load->helper('url');
        
        // Load Main Helper
        $this->load->helper('main_helper');
        
        // Load Admin Helper
        $this->load->helper('admin_helper');
        
        // Load RSS Helper
        $this->load->helper('fifth_helper');
        
        // Load Alerts Helper
        $this->load->helper('alerts_helper');
        
        // Load SMTP
        $config = smtp();
        
        // Load Sending Email Class
        $this->load->library('email', $config);
        
        // Load Gshorter library
        $this->load->library('gshorter');
        
        // Check if session username exists
        if (isset($this->session->userdata ['username'])) {
            
            // Set user_id
            $this->user_id = $this->user->get_user_id_by_username($this->session->userdata ['username']);
            
            // Set user_role
            $this->user_role = $this->user->check_role_by_username($this->session->userdata ['username']);
            
        }
        
        // Load language
        if ( file_exists( APPPATH . 'language/' . $this->config->item('language') . '/default_admin_lang.php' ) ) {
            $this->lang->load( 'default_admin', $this->config->item('language') );
        }
        if ( file_exists( APPPATH . 'language/' . $this->config->item('language') . '/default_alerts_lang.php' ) ) {
            $this->lang->load( 'default_alerts', $this->config->item('language') );
        }
    }

    /**
     * The function dashboard displays admin dashboard.
     */
    public function dashboard() {
        // Check if the session exists and if the login user is admin
        $this->check_session($this->user_role, 1);
        // Get all users registered in the last 7 days
        $statistics = generate_admin_statstics(7, $this->user->get_last_users(7));
        // Load Third Helper
        $this->load->helper('third_helper');
        // Create missing tables and columns
        manage_db();
        // Count all sent posts per social network
        $count_sent_posts = $this->posts->get_all_count_posts();
        // Get last 5 users and display them in the Dashboard
        $get_users = $this->user->get_users(0, 5, 0);
        // Check if an update is available
        $this->check_update();
        $this->body = 'admin/home';
        $this->content = [
            'last_users' => $get_users
        ];
        $this->footer = [
            'statistics' => $statistics,
            'sent' => $count_sent_posts
        ];
        $this->admin_layout();
    }

    /**
     * The function scheduled_posts displays scheduled posts page
     */
    public function scheduled_posts() {
        // Check if the session exists and if the login user is admin
        $this->check_session($this->user_role, 1);
        // Count all scheduled posts
        $all_scheduled = $this->posts->count_all_scheduled_posts();
        // Count all unpublished scheduled posts
        $unpublished = $this->posts->count_all_scheduled_posts('unpublished');
        // Get first unpublished scheduled post
        $first_unpublished = $this->posts->get_first_unpublished_post();
        // Get the last unpublished scheduled post
        $last_scheduled = $this->posts->get_the_time_scheduled_post();
        $this->content = [
            'scheduled' => $all_scheduled,
            'unpublished' => $unpublished,
            'first_unpublished' => $first_unpublished,
            'last_scheduled' => $last_scheduled
        ];
        // Get auto-publish template
        $this->body = 'admin/auto-publish';
        $this->admin_layout();
    }

    /**
     * The function update updates the midrub platform
     */
    public function update() {
        // Check if the session exists and if the login user is admin
        $this->check_session($this->user_role, 1);
        // Load Third Helper
        $this->load->helper('third_helper');
        manage_db();
        $code = 0;
        if ($this->input->post()) {
            // Add form validation
            $this->form_validation->set_rules('code', 'Code', 'trim|required');
            // get data
            $code = $this->input->post('code');
            if ($this->form_validation->run() == false) {
                $code = 4;
            } else {
                $curl = curl_init();
                curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'http://get-code.midrub.com/?l=' . $code, CURLOPT_HEADER => false));
                $resp = curl_exec($curl);
                curl_close($curl);
                if ($resp == 1) {
                    if ($this->options->add_option_value('update_code', $code)) {
                        $code = 1;
                    } else {
                        $code = 2;
                    }
                } else {
                    $code = 3;
                }
            }
        }
        $new_update = $this->check_update();
        $msg = '';
        if ($this->session->flashdata('errorwrite')) {
            $msg = $this->session->flashdata('errorwrite');
        }
        $restore = '';
        if (file_exists('backup/backup.json')) {
            $restore = true;
        }
        if ($this->options->get_an_option('update_code')) {
            $code = 1;
        }
        // Get update template
        $this->body = 'admin/update';
        $this->content = [
            'new_update' => $new_update,
            'restore' => $restore,
            'msg' => $msg,
            'code' => $code
        ];
        $this->admin_layout();
    }

    /**
     * The function notifications displays notifications page
     */
    public function notifications() {
        // Check if the session exists and if the login user is admin
        $this->check_session($this->user_role, 1);
        // Get templates
        $templates = $this->notifications->get_templates(1);
        $notifications = $this->notifications->get_templates(0);
        $this->content = [
            'templates' => $templates,
            'notifications' => $notifications
        ];
        // Get notifications template
        $this->body = 'admin/notifications';
        $this->admin_layout();
    }

    /**
     * The function users displays users page
     */
    public function users() {
        // Check if the session exists and if the login user is admin
        $this->check_session($this->user_role, 1);
        $get_plans = $this->plans->get_all_plans(1);
        // Get users template
        $this->body = 'admin/users';
        $this->content = [
            'plans' => $get_plans
        ];
        $this->admin_layout();
    }

    /**
     * The function new_user displays new user page
     */
    public function new_user() {
        // Check if the session exists and if the login user is admin
        $this->check_session($this->user_role, 1);
        // Get new user template
        $this->body = 'admin/new-user';
        $this->admin_layout();
    }

    /**
     * The function tools displays the tools page.
     */
    public function tools($name = NULL) {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 1);
        include_once APPPATH . 'interfaces/Tools.php';
        // Get all available tools.
        $classes = [];
        foreach (scandir(APPPATH . 'tools') as $dirname) {
            if (is_dir(APPPATH . 'tools' . '/' . $dirname) && ($dirname != '.') && ($dirname != '..')) {
                include_once APPPATH . 'tools' . '/' . $dirname . '/' . $dirname . '.php';
                $class = ucfirst(str_replace('-', '_', $dirname));
                $get = new $class ();
                $classes [] = $get->check_info();
            }
        }
        $options = $this->options->get_all_options();
        // Load view/admin/tools.php file
        $this->body = 'admin/tools';
        $this->content = [
            'tools' => $classes,
            'options' => $options
        ];
        $this->admin_layout();
    }

    /**
     * The function networks will create a new user
     */
    public function networks() {
        // Check if the session exists and if the login user is admin
        $this->check_session($this->user_role, 1);
        include_once APPPATH . 'interfaces/Autopost.php';
        // Get all available social networks.
        $classes = [];
        foreach (glob(APPPATH . 'autopost/*.php') as $filename) {
            include_once $filename;
            $className = str_replace([
                APPPATH . 'autopost/',
                '.php'
                    ], '', $filename);
            $get = new $className ();
            $con = $this->networks->get_network_accounts(strtolower($className), $this->user_id);
            $info = $get->get_info();
            $num_accounts = 0;
            if (@$con [0]->num) {
                $num_accounts = $con [0]->num;
            }
            $classes [] = '<li>
                                <div class="col-md-10 col-sm-8 col-xs-6 clean">
                                    <h3>' . ucwords(str_replace('_', ' ', $className)) . '</h3>
                                    <span style="background-color:' . $info->color . '">' . $num_accounts . ' ' . $this->lang->line('ma135') . '</span>
                                </div>
                                <div class="col-md-2 col-sm-4 col-xs-6 clean text-right">
                                    <a href="' . base_url() . 'admin/network/' . strtolower($className) . '"><button type="button" class="btn btn-default"><i class="fa fa-cogs" aria-hidden="true"></i> ' . $this->lang->line('ma134') . '</button></a>
                                </div>
                            </li>';
        }
        // Load view/admin/networks.php file
        $this->body = 'admin/networks';
        $this->content = [
            'data' => $classes
        ];
        $this->admin_layout();
    }

    /**
     * The function network displays network page
     *
     * @param $network contains
     *        	the network page
     */
    public function network($network) {
        // Check if the session exists and if the login user is admin
        $this->check_session($this->user_role, 1);
        // Check if the session exists and if the login user is admin
        $options = $this->options->get_all_options();
        // Load class
        $class = '';
        if ( file_exists( APPPATH . 'autopost/' . ucfirst($network) . '.php' ) ) {
            include_once APPPATH . 'interfaces/Autopost.php';
            include_once APPPATH . 'autopost/' . ucfirst($network) . '.php';
            $class_network = ucfirst($network);
            $class = new $class_network();
        }
        $this->body = 'admin/network';
        $this->content = [
            'data' => '',
            'network' => $network,
            'options' => $options,
            'class' => $class   
        ];
        $this->admin_layout();
    }
    
    /**
     * The function connect redirects admin to the login page
     *
     * @param $networks contains the name of network
     * 
     * @return void
     */
    public function connect($network) {
        // Check if the session exists and if the login user is admin
        $this->check_session($this->user_role, 1);
        include_once APPPATH . 'interfaces/Autopost.php';
        if (file_exists(APPPATH . 'autopost/' . ucfirst($network) . '.php')) {
            include_once APPPATH . 'autopost/' . ucfirst($network) . '.php';
            $get = new $network;
            $get->connect();
        } else {
            display_mess(47);
        }
    }
    
    /**
     * The function callback saves token from a social network
     *
     * @param $network contains the network name
     * 
     * @return void
     */
    public function callback($network) {
        // Check if the session exists and if the login user is admin
        $this->check_session($this->user_role, 1);
        include_once APPPATH . 'interfaces/Autopost.php';
        if (file_exists(APPPATH . 'autopost/' . ucfirst($network) . '.php')) {
            include_once APPPATH . 'autopost/' . ucfirst($network) . '.php';
            $get = new $network;
            $get->save();
            redirect('/admin/network/' . $network);
        } else {
            display_mess(47);
        }
    }

    /**
     * The function plans displays plans page
     */
    public function plans() {
        // Check if the session exists and if the login user is admin
        $this->check_session($this->user_role, 1);
        // Get all available social networks.
        include_once APPPATH . 'interfaces/Autopost.php';
        $classes = [];
        foreach (glob(APPPATH . 'autopost/*.php') as $filename) {
            include_once $filename;
            $className = str_replace([APPPATH . 'autopost/', '.php'], '', $filename);
            // Check if the administrator has disabled the $className social network
            if ($this->options->check_enabled(strtolower($className)) == false) {
                continue;
            }
            $get = new $className;
            if ($get->check_availability()) {
                $con = $this->networks->get_network_data(strtolower($className), $this->user_id);
                $info = $get->get_info();
                $num_accounts = 0;
                if (@$con[0]->num) {
                    $num_accounts = $con[0]->num;
                }
                $netw = ucwords(str_replace('_', ' ', $className));
                $classes[] = '
                    <li>
                        <div class="col-md-12">
                            ' .$netw. '
                            <div class="enablus pull-right">
                                <input id="id_' . strtolower($className) . '" type="checkbox" name="' . strtolower($className) . '" class="set_network">
                                <label for="id_' . strtolower($className) . '"></label>
                            </div>
                        </div>
                    </li>';
            }
        }
        // Load view/admin/plans.php file
        $this->body = 'admin/plans';
        $this->content = [
            'data' => '',
            'networks' => $classes
        ];
        $this->admin_layout();
    }

    /**
     * The function set_option enables and disables an option
     *
     * @param $option_name contains
     *        	the option name
     * @param $value contains
     *        	new option's value
     */
    public function set_option($option_name, $value = null) {
        // Check if the session exists and if the login user is admin
        $this->check_session($this->user_role, 1);
        if ($value) {
            // Enable and add value to an option
            $value = str_replace('-', '/', $value);
            $value = $this->security->xss_clean(base64_decode($value));
            if ($this->options->add_option_value($option_name, $value)) {
                echo json_encode(1);
            } else {
                display_mess();
            }
        } else {
            // Enable or disable the $option_name option
            if ($this->options->enable_or_disable_network($option_name)) {
                echo json_encode(1);
            } else {
                display_mess();
            }
        }
    }

    /**
     * The function settings displays the settings's page
     */
    public function settings() {
        // Check if the session exists and if the login user is admin
        $this->check_session($this->user_role, 1);
        $options = $this->options->get_all_options();
        $this->content = [
            'options' => $options
        ];
        // Get settings page
        $this->body = 'admin/settings';
        $this->admin_layout();
    }

    /**
     * The function faq displays the faq page
     */
    public function faq() {
        // Check if the session exists and if the login user is admin
        $this->check_session($this->user_role, 1);
        // Get faq template
        $this->body = 'admin/faq';
        $this->admin_layout();
    }

    /**
     * The function get_notifications gets all sent notifications
     */
    public function get_notifications() {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        $get_notifications = $this->notifications->get_templates(0);
        if ($get_notifications) {
            echo json_encode([
                'notification' => $get_notifications,
                'time' => time()
            ]);
        }
    }

    /**
     * The function get_notification gets notifications by id
     *
     * @param $notification_id contains
     *        	the notification's id
     */
    public function get_notification($notification_id) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        // Get notification data by $notification_id
        $get_notification = $this->notifications->get_notification($notification_id);
        if ($get_notification) {
            echo json_encode($get_notification);
        }
    }

    /**
     * The function publish_scheduled gets all scheduled posts that must be published before the time() and limit by $limit
     *
     * @param $limit contains
     *        	the limit number
     */
    public function publish_scheduled($limit) {
        // Check if the session exists and if the login user is admin
        $must_be_published = $this->posts->get_all_scheduled_posts($limit);
        if ($must_be_published) {
            $num = 0;
            foreach ($must_be_published as $post) {
                $post_id = $post ['post_id'];
                $body = $post ['body'];
                $title = $post ['title'];
                $url = $post ['url'];
                $img = $post ['img'];
                $video = $post ['video'];
                $user_id = $post ['user_id'];
                $category = $post ['category'];
                // Get number of published posts in this month for the user
                $posts_published = $this->user_meta->get_post_number($user_id);
                // Then verify how many posts can publish the user for the current plan
                $published_limit = $this->plans->get_plan_features($user_id, 'publish_posts');
                if ($posts_published) {
                    $posts_published = unserialize($posts_published [0]->meta_value);
                    if (($posts_published ['date'] == date('Y-m')) and ( $published_limit <= $posts_published ['posts'])) {
                        // set status publish
                        $this->posts->change_scheduled_to_publish($post_id);
                        $num ++;
                        continue;
                    }
                }
                // set status publish
                $this->posts->change_scheduled_to_publish($post_id);
                // Verify if the post must be published in a group
                if (is_numeric($category)) {
                    // Load Campaigns Model
                    $this->load->model('lists');
                    // get all group's social accounts
                    $networks = $this->lists->get_lists_meta($user_id, 0, $category, 3);
                    $pub = 0;
                    if ($networks) {
                        foreach ($networks as $network) {
                            $body2 = $body;
                            $title2 = $title;
                            if($this->user->get_user_option($user_id, 'use_spintax_posts') == 1) {
                                if(in_array($network->network_name, $this->socials)) {
                                    $body2 = get_instance()->ecl('Deco')->lsd($body2, $user_id);
                                    if($title2) {
                                        $title2 = get_instance()->ecl('Deco')->lsd($title2, $user_id);
                                    }
                                } else {
                                    $this->socials[] = $network->network_name;
                                }
                            }
                            $args = [
                                'post' => $body2,
                                'title' => $title2,
                                'network' => $network->network_name,
                                'account' => $network->network_id,
                                'url' => $url,
                                'img' => $img,
                                'video' => $video,
                                'category' => '',
                                'id' => $post_id
                            ];
                            // verify if post already has the meta
                            if($this->networks->if_posts_has_the_meta($post_id, $network->network_id)) {
                                continue;
                            }
                            // publish post and check if was published succesfully
                            if (publish($args, $user_id)) {
                                $this->posts->save_post_meta($post_id, $network->network_id, $network->network_name, 1, $user_id);
                                $pub++;
                            } else {
                                // if the post wasn't published successfully, will be send a notification to user
                                // first we need to check if user want to receive notification about post errors on email
                                $options = $this->user_meta->get_all_user_options($user_id);
                                if (isset($options ['error_notifications'])) {
                                    $this->notifications->send_notification($user_id, 'error-sent-notification');
                                }
                                $this->posts->save_post_meta($post_id, $network->network_id, $network->network_name, 2, $user_id);
                            }
                            sleep(5);
                        }
                    }
                } else {
                    // get all networks where the post must be published
                    $networks = $this->posts->all_social_networks_by_post_id($user_id, $post_id);
                    $pub = 0;
                    if ($networks) {
                        foreach ($networks as $network) {
                            $body2 = $body;
                            $title2 = $title;
                            if($this->user->get_user_option($user_id, 'use_spintax_posts') == 1) {
                                if(in_array($network['network_name'], $this->socials)) {
                                    $body2 = get_instance()->ecl('Deco')->lsd($body2, $user_id);
                                    if($title2) {
                                        $title2 = get_instance()->ecl('Deco')->lsd($title2, $user_id);
                                    }
                                } else {
                                    $this->socials[] = $network['network_name'];
                                }
                            }
                            $args = [
                                'post' => $body2,
                                'title' => $title2,
                                'network' => $network ['network_name'],
                                'account' => $network ['network_id'],
                                'url' => $url,
                                'img' => $img,
                                'video' => $video,
                                'category' => $category,
                                'id' => $post_id
                            ];
                            $this->posts->update_post_meta($network ['meta_id'], 1, $user_id);
                            // publish post and check if was published succesfully
                            if (publish($args, $user_id)) {
                                $this->posts->update_post_meta($network ['meta_id'], 1, $user_id);
                                $pub++;
                            } else {
                                // if the post wasn't published successfully, will be send a notification to user
                                // first we need to check if user want to receive notification about post errors on email
                                $options = $this->user_meta->get_all_user_options($user_id);
                                if (isset($options ['error_notifications'])) {
                                    $this->notifications->send_notification($user_id, 'error-sent-notification');
                                }
                                $this->posts->update_post_meta($network ['meta_id'], 2, $user_id);
                            }
                            sleep(5);
                        }
                    }
                }
                if ($pub > 0) {
                    // a new post was published successfully in this month
                    $this->user_meta->set_post_number($user_id);
                }
                $num ++;
            }
            echo json_encode($num);
        } else {
            echo json_encode('0');
        }
    }

    /**
     * The function publish_rss gets all enabled RSS Feed and publish $limit post
     *
     * @param $limit contains
     *        	the limit number
     */
    public function publish_rss($limit) {
            
        // Get number of RSS to process
        $rss_process_limit = get_option( 'rss_process_limit' );
    
        if ( !is_numeric($rss_process_limit) ) {
            
            $rss_process_limit = 1;
            
        }
        
        for ( $pr = 0; $pr < $rss_process_limit; $pr++ ) {
            
            // Check if the session exists and if the login user is admin
            $random = $this->rss->get_random_rss();
            
            $networks = json_decode(@$random [0]->networks);
            
            if ( !@$networks ) {
                
                $this->rss->reset_rss();
                exit();
                
            } else {
                
                $networks = (array) $networks;
                
            }
            
            // Check if RSS Feeds support is enabled
            if ( $this->options->check_enabled('rss_feeds') == false ) {
                
                exit();
                
            }

            $posts_published = $this->user_meta->get_post_number($random [0]->user_id);
            
            $published_limit = $this->plans->get_plan_features($random [0]->user_id, 'publish_posts');
            
            if ( $posts_published ) {
                
                $posts_published = unserialize($posts_published [0]->meta_value);
                
                if ( ( $posts_published ['date'] == date('Y-m')) and ( $published_limit <= $posts_published ['posts']) ) {
                    
                    $this->rss->set_completed($random [0]->rss_id, 1);
                    exit();
                    
                }
                
            }
            
            if ( get_instance()->ecl('Classo')->bean($random) ) {
                
                $this->rss->set_completed($random [0]->rss_id, 1);
                exit();
                
            }
            
            if ( @$random [0]->rss_url ) {
                
                $parsed = parse_rss_feed($random [0]->rss_url);
                
                if ( @$parsed ) {
                    
                    $f = 0;
                    
                    for ( $n = 0; $n < count($parsed ['title']); $n ++ ) {
                        
                        if ( $limit == $f ) {
                            break;
                        }
                        
                        $description = '';
                        
                        $title = trim($parsed ['title'] [$n]);
                        
                        if ( $random [0]->publish_description == 1 ) {
                            
                            $description = $parsed ['description'] [$n];
                            
                        }
                        
                        $url = $parsed ['url'][$n];
                        
                        if ( $url ) {
                            
                            if ( preg_match('/amazon./i', $url) ) {
                                
                                $url = explode('ref=', $url);
                                $url = $url [0];
                                
                            }
                            
                            if ( preg_match('/news.google/i', $url) ) {
                                
                                $url = explode('&url=', $url);
                                $url = (@$url[1]) ? $url[1] : $url[0];
                                
                            }
                            
                            $url2 = $url;
                            
                            if ( $this->rss->was_published($random [0]->user_id, $random [0]->rss_id, $url) ) {
                                
                                $net = [];
                                
                                $networks = get_feed_net($networks);
                                
                                if ($networks) {
                                    
                                    foreach ( $networks as $value ) {
                                        
                                        $account = $this->networks->get_account($value);
                                        
                                        if ( !$account ) {
                                            
                                            continue;
                                            
                                        }
                                        
                                        $name = $account[0]->network_name;

                                        // Verify if the Feed RSS has a refferal
                                        if ( $random [0]->refferal ) {
                                            
                                            $refferal = str_replace(['&', '?'], ['', ''], $random [0]->refferal);
                                            
                                            if ( preg_match('/\?/i', $url2) ) {
                                                
                                                $url2 = $url2 . '&' . $refferal;
                                                
                                            } else {
                                                
                                                $url2 = $url2 . '?' . $refferal;
                                                
                                            }
                                            
                                        }
                                        
                                        // Verify if we have to exclude some posts
                                        if ( @trim($random [0]->include) ) {

                                            $include = $random [0]->include;
                                            $g = 0;

                                            $exn = explode(',', $include);
                                            foreach ( $exn as $ex ) {

                                                if ( preg_match('/' . $ex . '/i', $title) ) {

                                                    $g++;
                                                }
                                                
                                                if ( preg_match('/' . $ex . '/i', $description) ) {

                                                    $g++;
                                                }
                                                
                                            }

                                            // If $g is 0 means no required words found
                                            if ( $g < 1 ) {

                                                continue;
                                            }
                                            
                                        }
                                        
                                        if ( @trim($random [0]->exclude) ) {

                                            $exclude = $random [0]->exclude;
                                            $w = 0;

                                            $exc = explode(',', $exclude);
                                            
                                            foreach ( $exc as $ex ) {

                                                if ( preg_match('/' . $ex . '/i', $title) ) {

                                                    $w++;
                                                }
                                                
                                                if ( preg_match('/' . $ex . '/i', $description) ) {

                                                    $w++;
                                                }
                                                
                                            }

                                            // If $g is 0 means no required words found
                                            if ( $w > 0 ) {

                                                continue;
                                                
                                            }
                                            
                                        }

                                        // Create teporary variables for title and description
                                        $title2 = $title;
                                        
                                        $description2 = $description;

                                        // Verify if user want to make original the content
                                        if ( $this->user->get_user_option($account[0]->user_id, 'use_spintax_rss') == 1 ) {
                                            
                                            if ( in_array($account[0]->network_name, $this->socials) ) {
                                                
                                                $description2 = get_instance()->ecl('Deco')->lsd($description2, $account[0]->user_id);
                                                
                                                if ( $title2 ) {
                                                    
                                                    $title2 = get_instance()->ecl('Deco')->lsd($title2, $account[0]->user_id);
                                                    
                                                }
                                                
                                            } else {
                                                
                                                $this->socials[] = $account[0]->network_name;
                                                
                                            }
                                            
                                        }

                                        // Short the url
                                        $url2 = $this->short_url($url2);
                                        
                                        $args = [
                                            'title' => html_entity_decode(stripslashes($title2)),
                                            'post' => html_entity_decode(stripslashes($description2)),
                                            'network' => $name,
                                            'account' => $value,
                                            'url' => $url2,
                                            'img' => '',
                                            'video' => '',
                                            'category' => ''
                                        ];
                                        
                                        if ( $random[0]->type ) {
                                            
                                            if ( $parsed['show'][$n] ) {
                                                
                                                $args['img'] = $parsed['show'][$n];
                                                
                                            }
                                            
                                        }
                                        // Publish post and check if was published succesfully
                                        if ( publish($args, $random [0]->user_id) ) {
                                            
                                            $net [] = [
                                                $name,
                                                $value,
                                                1
                                            ];
                                            
                                        } else {
                                            
                                            $net [] = [
                                                $name,
                                                $value,
                                                2
                                            ];
                                            
                                        }
                                        
                                        sleep(1);
                                        
                                    }
                                    
                                }
                                
                                if ( $net ) {
                                    
                                    // A new post was published successfully in this month
                                    $this->user_meta->set_post_number($random [0]->user_id);
                                    
                                }
                                
                                $net = json_encode($net);
                                
                                if ( $this->rss->save_published($random [0]->user_id, $random [0]->rss_id, $net, @htmlentities(stripslashes(trim($parsed ['title'] [$n]))), @htmlentities(stripslashes(trim($description))), $url) == 1 ) {
                                    
                                    $f++;
                                    
                                }
                                
                            }
                            
                        }
                        
                    }

                    if ( $limit > $f ) {

                        $this->rss->set_completed($random [0]->rss_id, 1);
                    }
                    
                }
                
            }
            
        }
        
    }

    /**
     * The function publish_rss_posts gets all scheduled posts and publish $limit post
     *
     * @param $limit contains
     *        	the limit number
     */
    public function publish_rss_posts($limit) {
        // Check if the session exists and if the login user is admin
        $random = $this->rss->get_random_rss_m($limit);
        if (@$random) {
            $posts_published = $this->user_meta->get_post_number($random[0]['user_id']);
            $published_limit = $this->plans->get_plan_features($random[0]['user_id'], 'publish_posts');
            if ($posts_published) {
                $posts_published = unserialize($posts_published [0]->meta_value);
                if (($posts_published ['date'] == date('Y-m')) and ( $published_limit <= $posts_published ['posts'])) {
                    $this->rss->set_completed($random[0]['rss_id'], 1);
                    exit();
                }
            }
            $networks = json_decode(@$random [0] ['net']);
            if ($networks) {
                $f = 0;
                for ($n = 0; $n < count($random); $n ++) {
                    $description = '';
                    $uri = $random [$n] ['url'];
                    if (preg_match('/amazon./i', $uri)) {
                        $uri = explode('ref=', $uri);
                        $uri = $uri [0];
                    }
                    if (preg_match('/news.google/i', $uri)) {
                        $uri = explode('&url=', $uri);
                        $uri = $uri [1];
                    }
                    $description = '';
                    $title = $random [$n] ['title'];
                    $description = $random [$n] ['content'];
                    if (@$random [$n]['refferal']) {
                        $refferal = str_replace(['&', '?'], ['', ''], $random [$n]['refferal']);
                        if (preg_match('/\?/i', $uri)) {
                            $uri = $uri . '&' . $refferal;
                        } else {
                            $uri = $uri . '?' . $refferal;
                        }
                    }
                    $url = $this->short_url($uri);
                    if ($uri) {
                        $net = [];
                        $networks = get_feed_net($networks);
                        foreach ($networks as $value) {
                            $account = $this->networks->get_account($value);
                            $title2 = $title;
                            $description2 = $description;
                            if($this->user->get_user_option($account[0]->user_id, 'use_spintax_rss') == 1) {
                                if(in_array($account[0]->network_name, $this->socials)) {
                                    $description2 = get_instance()->ecl('Deco')->lsd($description2, $account[0]->user_id);
                                    if($title2) {
                                        $title2 = get_instance()->ecl('Deco')->lsd($title2, $account[0]->user_id);
                                    }
                                } else {
                                    $this->socials[] = $account[0]->network_name;
                                }
                            }
                            $name = $account[0]->network_name;
                            $args = [
                                'title' => html_entity_decode(stripslashes($title2)),
                                'post' => html_entity_decode(stripslashes($description2)),
                                'network' => $name,
                                'account' => $value,
                                'url' => $url,
                                'img' => '',
                                'video' => '',
                                'category' => ''
                            ];
                            if($random[$n]['type']) {
                                if(@$random [$n] ['img']) {
                                    $args['img'] = $random [$n] ['img'];
                                }
                            }
                            // Publish post and check if was published succesfully
                            if (publish($args, $random [0] ['user_id'])) {
                                $net [] = [
                                    $name,
                                    $value,
                                    1
                                ];
                                $this->rss->published($random[$n]['post_id']);
                            } else {
                                $net [] = [
                                    $name,
                                    $value,
                                    2
                                ];
                            }
                            sleep(1);
                        }
                        if ($net) {
                            // A new post was published successfully in this month
                            $this->user_meta->set_post_number($random [0] ['user_id']);
                            $net = json_encode($net);
                            $this->rss->update_rss_posts_meta($random[$n]['post_id'],'networks',$net);
                        }
                    }
                }
            }
        }
    }

    /**
     * The function plan creates or updates a plan
     */
    public function plan() {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        // Check if data was submitted
        if ($this->input->post()) {
            // Add form validation
            $this->form_validation->set_rules('plan_name', 'Plan Name', 'trim|required');
            $this->form_validation->set_rules('plan_price', 'Plan Price', 'trim|required');
            $this->form_validation->set_rules('currency_sign', 'Currency Sign', 'trim|required');
            $this->form_validation->set_rules('currency_code', 'Currency Code', 'trim|required');
            $this->form_validation->set_rules('allowed_accounts', 'Allowed Accounts', 'trim|integer|required');
            $this->form_validation->set_rules('allowed_rss', 'Allowed RSS Feeds', 'trim|integer|required');
            $this->form_validation->set_rules('accounts_number', 'Allowed Number Accounts', 'trim|integer|required');
            $this->form_validation->set_rules('limit_posts_month', 'Limit Posts Month', 'trim|integer|required');
            $this->form_validation->set_rules('limit_videos', 'Limit Videos', 'trim|integer|required');
            $this->form_validation->set_rules('limit_images', 'Limit Images', 'trim|integer|required');
            $this->form_validation->set_rules('features_plan', 'Features Plan', 'trim|required');
            $this->form_validation->set_rules('period_plan', 'Period Plan', 'trim|integer|required');
            $this->form_validation->set_rules('emails', 'Emails', 'trim|integer');
            $this->form_validation->set_rules('allowed_networks', 'Allowed Networks', 'trim');
            $this->form_validation->set_rules('teams', 'Teams', 'trim|integer');
            $this->form_validation->set_rules('status', 'Status', 'trim|integer');
            $this->form_validation->set_rules('update', 'Update', 'trim|integer|required');
            // get data
            $plan_name = $this->input->post('plan_name');
            $plan_price = $this->input->post('plan_price');
            $currency_sign = $this->input->post('currency_sign');
            $currency_code = $this->input->post('currency_code');
            $allowed_accounts = $this->input->post('allowed_accounts');
            $allowed_rss = $this->input->post('allowed_rss');
            $accounts_number = $this->input->post('accounts_number');
            $limit_posts_month = $this->input->post('limit_posts_month');
            $limit_videos = $this->input->post('limit_videos');
            $limit_images = $this->input->post('limit_images');
            $features_plan = $this->input->post('features_plan');
            $period_plan = $this->input->post('period_plan');
            $emails = $this->input->post('emails');
            $allowed_networks = $this->input->post('allowed_networks');
            $update = $this->input->post('update');
            $teams = $this->input->post( 'teams' );
            $status = $this->input->post( 'status' );
            if ($this->form_validation->run() == false) {
                display_mess(12);
            } else {
                if ($this->plans->save_plan($plan_name, $plan_price, $currency_sign, $currency_code, $allowed_accounts, $allowed_rss, $accounts_number, $limit_posts_month, $features_plan, $period_plan, $emails, $update, $limit_videos, $limit_images, $allowed_networks, $teams, $status)) {
                    display_mess(92);
                } else {
                    display_mess(18);
                }
            }
        }
    }

    /**
     * The function get_plans gets all created plans
     */
    public function get_plans() {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        $get_plans = $this->plans->get_all_plans(1);
        echo json_encode([
            'plans' => $get_plans
        ]);
    }

    /**
     * The function delete_plan deletes a plan by $plan_id
     *
     * @param $plan_id contains
     *        	the plan's id
     */
    public function delete_plan($plan_id) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        $delete_plan = $this->plans->delete_plan($plan_id);
        if ($delete_plan) {
            display_mess(93);
        } else {
            display_mess(94);
        }
    }

    /**
     * The function get_plan gets a plan by $plan_id
     *
     * @param $plan_id contains
     *        	the plan's id
     */
    public function get_plan($plan_id) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        $get_plan = $this->plans->get_plan($plan_id);
        echo json_encode([
            'plan' => $get_plan
        ]);
    }

    /**
     * The function del_notification deletes a notification by $notification_id
     *
     * @param $notification_id contains
     *        	the notification's id
     */
    public function del_notification($notification_id) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        // Get notification data by $notification_id
        $del_notification = $this->notifications->del_notification_completely($notification_id);
        if ($del_notification) {
            display_mess(11);
        } else {
            display_mess();
        }
    }

    /**
     * The function notification updates or saves a new notification
     */
    public function notification() {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        // Check if data was submitted
        if ($this->input->post()) {
            // Add form validation
            $this->form_validation->set_rules('title', 'Title', 'trim|required');
            $this->form_validation->set_rules('body', 'Body', 'trim|required');
            $this->form_validation->set_rules('template', 'Template', 'trim');
            // Get data
            $title = str_replace('-', '/', $this->input->post('title'));
            $body = str_replace('-', '/', $this->input->post('body'));
            $title = $this->security->xss_clean(base64_decode($title));
            $body = htmlspecialchars_decode($this->security->xss_clean(base64_decode($body)));
            $template = $this->input->post('template');
            // Check form validation
            if ($this->form_validation->run() == false) {
                display_mess(7);
            } else {
                if ($this->notifications->update_msg($title, $body, $template)) {
                    if ($template) {
                        display_mess(9);
                    } else {
                        // Check if admin wants to send notification via email
                        if ($this->options->check_enabled('enable-notifications-email') == false) {
                            display_mess(76);
                        } else {
                            // Gets all user's email that want to receive notifications by email
                            $emails = $this->user->get_all_user_email_for_notifications();
                            $i = 0;
                            if ($emails) {
                                foreach ($emails as $email) {
                                    // Sends to getted emails
                                    $this->email->from($this->config->item('contact_mail'), $this->config->item('site_name'));
                                    $this->email->to($email->email);
                                    $this->email->subject($title);
                                    $this->email->message($body);
                                    if ($this->email->send()) {
                                        $i ++;
                                    }
                                }
                            }
                            if ($i > 0) {
                                display_mess(10, $i);
                            } else {
                                display_mess(76);
                            }
                        }
                    }
                } else {
                    display_mess(8);
                }
            }
        }
    }

    /**
     * The function user_info gets user data by $user_id
     *
     * @param $user_id is
     *        	the user's id
     */
    public function user_info($user_id) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        $getdata = $this->user->get_user_info($user_id);
        if ($getdata) {
            echo json_encode([
                'msg' => $getdata,
                'user_id' => $this->user_id
            ]);
        }
    }

    /**
     * The function delete_user deletes an user by $user_id
     *
     * @param $user_id is
     *        	the user's id
     */
    public function delete_user($user_id) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        // Check if user want delete his own account
        if ($this->user_id == $user_id) {
            return false;
        }
        $data = '';
        // Delete all posts and posts meta
        if ($this->posts->delete_posts($user_id)) {
            $data = display_mess(73);
        }
        // Delete connected social accounts
        if ($this->networks->delete_network('all', $user_id)) {
            $data .= display_mess(74);
        }
        // Delete feeds and posts
        if ($this->rss->delete_all_rss($user_id)) {
            $data .= display_mess(100);
        }
        // Delete campaigns
        if ($this->campaigns->delete_campaigns($user_id)) {
            $data .= display_mess(127);
        }
        // Delete templates
        if ($this->campaigns->delete_templates($user_id)) {
            $data .= display_mess(128);
        }
        // Delete lists
        if ($this->campaigns->delete_lists($user_id)) {
            $data .= display_mess(129);
        }
        // Delete schedules
        $this->campaigns->delete_schedules($user_id);
        // Load Botis Model
        $this->load->model('botis');        
        // Delete all user's bots
        $this->botis->delete_user_bots($user_id);
        // Load Fourth Helper
        $this->load->helper('fourth_helper');
        // Load Tickets Model
        $this->load->model('tickets');
        // Load Activity Model
        $this->load->model('activity');        
        // Delete all user's activity
        $this->activity->delete_user_activity($user_id);
        // Delete tickets
        if ($this->tickets->delete_tickets($user_id)) {   
        }
        // Delete user account
        $result = $this->user->delete_user($user_id);
        if ($result) {
            $data .= display_mess(65);
            echo json_encode('<div class="msuccess">' . $data . '</div>');
        } else {
            $data .= display_mess(75);
            echo json_encode('<div class="merror">' . $data . '</div>');
        }
    }

    /**
     * The function show_users displays users from database
     *
     * @param integer $page is the number of page
     * @param integer $order contains the order param
     * @param string $search is the search key
     */
    public function show_users($page, $order, $search = null) {
        
        // Check if the session exists and if the login user is admin
        $this->check_session();
        if ($this->user_role == 0) {
            return false;
        }
        // This function display users
        $page --;
        $limit = 10;
        $total = $this->user->count_all_users($search);
        $get_users = $this->user->get_users($page * $limit, $limit, $order, $search);
        if ($get_users) {
            $data = [
                'total' => $total,
                'users' => $get_users
            ];
            echo json_encode($data);
        }
        
    }

    /**
     * The function search_users searches users
     *
     * @param integer $order contains the order param
     * @param string $search is the search key
     */
    public function search_users( $order, $search ) {
        
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        $page = 0;
        $limit = 10;
        $total = $this->user->count_all_users($search);
        $get_users = $this->user->get_users($page * $limit, $limit, $order, $search);
        if ($get_users) {
            $data = [
                'total' => $total,
                'users' => $get_users
            ];
            echo json_encode($data);
        }
    }

    /**
     * The function update_user updates or changes data and user's plan if is different than current user's plan
     */
    public function update_user() {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        // Check if data was submitted
        if ($this->input->post()) {
            // Add form validation
            $this->form_validation->set_rules('password', 'Password', 'trim');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
            $this->form_validation->set_rules('proxy', 'Proxy', 'trim');
            $this->form_validation->set_rules('role', 'Role', 'integer');
            $this->form_validation->set_rules('user_id', 'User ID', 'integer');
            $this->form_validation->set_rules('status', 'Status', 'integer');
            $this->form_validation->set_rules('plan', 'Plan', 'integer');
            // Get data
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $role = $this->input->post('role');
            $user_id = $this->input->post('user_id');
            $status = $this->input->post('status');
            $plan = $this->input->post('plan');
            $proxy = $this->input->post('proxy');
            // The admin can't changes this role or status
            if ($this->user_id == $user_id) {
                $role = 1;
                $status = 1;
            }
            // Check form validation
            if ($this->form_validation->run() == false) {
                display_mess(16);
            } else {
                if ($this->user->check_email($email, $user_id) == true) {
                    // Check if the email address are present in our database
                    display_mess(57);
                } else {
                    $r = 0;
                    if ($this->user->updateuser($user_id, $email, $password, $role, $status, $plan, $proxy)) {
                        display_mess(58);
                        $r++;
                    }
                    if ($r == 0) {
                        if ($proxy) {
                            if ($this->user->update_proxy($user_id, $proxy)) {
                                display_mess(58);
                            } else {
                                display_mess(59);
                            }
                        } else {
                            display_mess(59);
                        }
                    }
                }
            }
        }
    }

    /**
     * The function create_user creates an user
     */
    public function create_user() {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        // Check if data was submitted
        if ($this->input->post()) {
            // Add form validation
            $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_dash');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
            $this->form_validation->set_rules('role', 'Role', 'integer');
            $this->form_validation->set_rules('sendpass', 'Send Password', 'integer');
            $this->form_validation->set_rules('plan', 'Plan', 'integer');
            // Get data
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $role = $this->input->post('role');
            $sendpass = $this->input->post('sendpass');
            $plan = $this->input->post('plan');
            // Check form validation
            if ($this->form_validation->run() == false) {
                display_mess(33);
            } else {
                // Check if the password has less than six characters
                if ((strlen($username) < 6) || (strlen($password) < 6)) {
                    display_mess(34);
                } elseif (preg_match('/\s/', $username) || preg_match('/\s/', $password)) {
                    // Check if the username or password contains white spaces
                    display_mess(35);
                } elseif ($this->user->check_email($email)) {
                    // Check if the email address are present in our database
                    display_mess(60);
                } elseif ($this->user->check_username($username)) {
                    // Check if the username are present in our database
                    display_mess(37);
                } else {
                    if ($this->user->signup($username, $email, $password, 1, $role)) {
                        // The username and password will be send via email
                        if ($sendpass == 1) {
                            $args = [
                                '[username]' => $username,
                                '[password]' => $password,
                                '[site_name]' => $this->config->item('site_name'),
                                '[login_address]' => $this->config->item('login_url'),
                                '[site_url]' => $this->config->base_url()
                            ];
                            // Get the send-password-new-users notification template
                            $template = $this->notifications->get_template('send-password-new-users', $args);
                            if ($template) {
                                $this->email->from($this->config->item('contact_mail'), $this->config->item('site_name'));
                                $this->email->to($email);
                                $this->email->subject($template ['title']);
                                $this->email->message($template ['body']);
                                if ($this->email->send()) {
                                    display_mess(61);
                                } else {
                                    display_mess(62);
                                }
                            } else {
                                display_mess(18);
                            }
                        } else {
                            display_mess(63);
                        }
                    } else {
                        display_mess(64);
                    }
                }
            }
        }
    }

    /**
     * The function upmedia uploads media files using ajax
     */
    public function upmedia() {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        // The background can be a video or an image
        $allowedimageformat = ($_POST ['media-name'] == 'login-bg') ? [
            'gif',
            'png',
            'jpg',
            'jpeg',
            'avi',
            'mp4',
            'webm'
                ] : [
            'gif',
            'png',
            'jpg',
            'jpeg',
            'ico'
        ];
        $format = pathinfo($_FILES ['file'] ['name'], PATHINFO_EXTENSION);
        if (!in_array($format, $allowedimageformat)) {
            echo ($_POST ['media-name'] == 'login-bg') ? 2 : 1;
            die();
        }
        $config ['upload_path'] = 'assets/img';
        $config ['file_name'] = time();
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        $this->upload->set_allowed_types('*');
        $data ['upload_data'] = '';
        if ($this->upload->do_upload('file')) {
            // Delete old media file
            $old_url = get_option($_POST ['media-name']);
            if ($old_url) {
                $url = str_replace($this->config->base_url(), '', $old_url);
                // Check if old file exist and delete it
                if (file_exists($url)) {
                    unlink($url);
                }
            }
            // Get information about uploaded file
            $data ['upload_data'] = $this->upload->data();
            $this->options->set_media_option($_POST ['media-name'], $this->config->base_url() . 'assets/img/' . $data ['upload_data'] ['file_name']);
            if (!in_array($format, [
                        'avi',
                        'mp4',
                        'webm'
                    ])) {
                echo '<img src="' . $this->config->base_url() . 'assets/img/' . $data ['upload_data'] ['file_name'] . '" class="thumbnail" />';
            } else {
                echo '<video autoplay="" loop="" class="fillWidth fadeIn wow collapse in" id="video-background" width="187"><source src="' . $this->config->base_url() . 'assets/img/' . $data ['upload_data'] ['file_name'] . '" type="video/mp4"></video>';
            }
        }
    }

    /**
     * The function check_update checks if an update are available
     */
    public function check_update() {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        $l_version = '';
        if (file_exists('update.json')) {
            $get_last = file_get_contents('update.json');
            $from = json_decode($get_last, true);
            unset($decode);
            $l_version = $from ['version'];
        }
        // Check if the update file is available
        $update_url = 'https://www.midrub.com/update-new-version/update.php';
        $context = stream_context_create(array(
            'http' => array(
                'method' => 'GET',
                'timeout' => 30
            )
        ));
        $update_down = @file_get_contents($update_url, 0, $context);
        $new_update = '';
        if ($update_down) {
            $from = json_decode($update_down, true);
            unset($update_down);
            // Check if the last version is equal to the current version
            if ($from ['version'] != $l_version) {
                // Set update option available. In this way the script will not check if an update available every time when will be loaded a page.
                if ($this->options->check_enabled('update') == false) {
                    $this->options->enable_or_disable_network('update');
                }
                // Return update information
                return $from;
            }
        }
        return false;
    }

    /**
     * The function upnow uploads media files using ajax
     *
     * @param $reset contains
     *        	a number
     */
    public function upnow($reset = null) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        if (file_exists('try-update.php')) {
            unlink('try-update.php');
        }
        $ws = @fopen('try-update.php', 'w+');
        fwrite($ws, $_SERVER ['REMOTE_ADDR']);
        fclose($ws);
        if (!file_exists('try-update.php')) {
            $this->session->set_flashdata('errorwrite', 'Please, check the file writing permission.');
            redirect('/admin/update');
        } else {
            // Check if $reset is not null and cancel the last update if is not null
            if ($reset) {
                // Redirect to cancel update page
                redirect('/update.php?cancel=update');
            } else {
                $uplio = $this->options->get_an_option('update_code');
                if ($uplio) {
                    // Delete last update notification
                    $this->options->enable_or_disable_network('update');
                    $this->options->enable_or_disable_network('update_code', 1);
                    // Redirect to the update page
                    redirect('/update.php?l=' . $uplio);
                } else {
                    redirect('/update.php');
                }
            }
        }
    }

    /**
     * The function get_statistics gets statistics and display in the admin dashboard
     *
     * @param $num contains
     *        	the period number
     */
    public function get_statistics($num) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        // This function get statistics by $num
        $statistics = generate_admin_statstics($num, $this->user->get_last_users($num));
        if ($statistics) {
            echo json_encode($statistics);
        }
    }

    /**
     * The function short_url shorts a url
     *
     * @param $url contains
     *        	the url string
     */
    public function short_url($url) {
        $options = $this->options->get_all_options();
        if (@$options ['shortener']) {
            // This function will return a short url if Gshorter is configured corectly
            return $this->gshorter->short($url);
        } else {
            $shorted = $this->urls->save_url($url);
            if ($shorted) {
                $url = base_url() . $shorted;
                return $url;
            }
        }
    }

}

/* End of file adminarea.php */
