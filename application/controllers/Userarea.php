<?php
/**
 * Userarea Controller
 *
 * PHP Version 5.6
 *
 * Userarea contains the Userarea class for user account
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
 * Userarea class - contains all metods and pages for user account.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Userarea extends MY_Controller {

    private $user_id, $user_role, $user_status, $socials = [];

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
        
        // Load Posts Model
        $this->load->model('posts');
        
        // Load Plans Model
        $this->load->model('plans');
        
        // Load Urls Model
        $this->load->model('urls');
        
        // Load Networks Model
        $this->load->model('networks');
        
        // Load Campaigns Model
        $this->load->model('campaigns');
        
        // Load Notifications Model
        $this->load->model('notifications');
        
        // Load Options Model
        $this->load->model('options');
        
        // Load RSS Model
        $this->load->model('rss');
        
        // Load session library
        $this->load->library('session');
        
        // Load URL Helper
        $this->load->helper('url');
        
        // Load Main Helper
        $this->load->helper('main_helper');
        
        // Load RSS Helper
        $this->load->helper('fifth_helper');
        
        // Load User Helper
        $this->load->helper('user_helper');
        
        // Load Alerts Helper
        $this->load->helper('alerts_helper');
        
        // Load SMTP
        $config = smtp();
        
        // Load Sending Email Class
        $this->load->library('email', $config);
        
        // Load Gshorter library
        $this->load->library('gshorter');
        
        // Check if session username exists
        if (isset($this->session->userdata['username'])) {
            
            // Set user_id
            $this->user_id = $this->user->get_user_id_by_email($this->session->userdata["user_email"]);
            
            // Set user_role
            $this->user_role = $this->user->check_role_by_email($this->session->userdata["user_email"]);
            
            // Set user_status
            $this->user_status = $this->user->check_status_by_email($this->session->userdata["user_email"]);
            
        }
        
        // Load language
        if ( file_exists( APPPATH . 'language/' . $this->config->item('language') . '/default_user_lang.php' ) ) {
            $this->lang->load( 'default_user', $this->config->item('language') );
        }
        if ( file_exists( APPPATH . 'language/' . $this->config->item('language') . '/default_alerts_lang.php') ) {
            $this->lang->load( 'default_alerts', $this->config->item('language') );
        }
        
    }

    /**
     * The function dashboard displays user dashboard.
     * 
     * @return void
     */
    public function dashboard() {

        // Check if user is admin
        //$this->check_session($this->user_role, 0);
        // Check if user has confirmed his account
        //$this->_check_unconfirmed_account();
        // Get all users registered in the last 7 days
        $statistics = generate_user_statstics(7, $this->posts->get_last_posts(7, $this->user_id));
        // Get last 5 posts and display them in the Dashboard
        $get_posts = $this->posts->get_posts($this->user_id, 0, 10);
        // Get data about user's plan
        $get_plan = plan_explore($this->user_id);
        if(!@$get_plan['plan'][0]->meta_value){
            redirect('user/home');
        }
        // Get number of sent posts
        $total = $this->posts->count_all_sent_posts($this->user_id);
        // Get user plan
        $user_plan = $this->plans->check_if_plan_ended($this->user_id);
        // Get Last Campaigns
        $campaigns = $this->campaigns->get_campaigns($this->user_id, 0, 'email', 10);
        // Get Email Sending Limit of the Current Plan
        $sent_emails = $this->plans->get_plan_features($this->user_id, 'sent_emails');
        $expired = 0;
        $expires_soon = 0;
        if ($user_plan) {
            if ($user_plan < time()) {
                $expired = 1;
                $this->plans->delete_user_plan($this->user_id);
            } elseif ($user_plan < time() + 432000) {
                $expires_soon = 1;
            }
        }
        if( !get_user_option('tokens-expiration') ) {
            $allaccounts = $this->networks->get_expired_tokens($this->user_id);
            if($allaccounts) {
                $this->user_meta->update_user_meta($this->user_id, 'tokens-expiration', 1);
            }
        }
        // Load view/auth/auth file
        $this->body = 'user/index';
        $this->content = ['last_posts' => $get_posts, 'timestamp' => time(), 'count' => $total, 'expired' => $expired, 'expires_soon' => $expires_soon, 'get_plan' => $get_plan, 'campaigns' => $campaigns, 'sent_emails' => $sent_emails];
        $this->footer = ['statistics' => $statistics];
        $this->user_layout();
    }

    /**
     * The function posts displays posts page and allows to publish new posts.
     * 
     * @return void
     */
    public function posts() {
        // Check if the current user is admin and if session exists
        //$this->check_session($this->user_role, 0);
       // $this->_check_unconfirmed_account();
        // Get all options
		
        $options = $this->options->get_all_options();
        // Get all valid network connections
        $networks = $this->networks->get_networks($this->user_id);
        // Get all user options
        $user_options = $this->user_meta->get_all_user_options($this->user_id);
        $published = 0;
        // Get number of published posts in the current month
        $posts_published = $this->user_meta->get_post_number($this->user_id);
        // Get Posts Limit of the Current Plan
        $published_limit = $this->plans->get_plan_features($this->user_id, 'publish_posts');
        // Get Select Accounts Limit of the Current Plan
        $selected_accounts = $this->plans->get_plan_features($this->user_id, 'publish_accounts');
        if ($posts_published) {
            $posts_published = unserialize($posts_published[0]->meta_value);
            if (($posts_published['date'] == date('Y-m'))) {
                $published = $posts_published['posts'];
            }
        }
        // Load view/auth/auth file
        $this->body = 'user/posts';
        $this->content = ['networks' => $networks, 'options' => $options, 'user_options' => $user_options, 'published' => $published, 'limit' => $published_limit, 'selected_accounts' => $selected_accounts];
        $this->user_layout();
    }

    /**
     * The function history diplays the history page and information about each published post.
     * 
     * @return void
     */
    public function history() {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        $this->_check_unconfirmed_account();
        // Load view/user/history.php file
        $this->body = 'user/history';
        $this->user_layout();
    }

    /**
     * The function RSS_feeds displays the RSS feeds page.
     *
     * @param $arg contains the id of feed or a string
     * 
     * @return void
     */
    public function RSS_feeds($arg = null) {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        $this->_check_unconfirmed_account();
        
        if ($this->options->check_enabled('rss_feeds') == false)
            show_404();
        if ($arg == null) {
            // Get all RSS Feeds
            $all_rss = $this->rss->get_all_rss($this->user_id);
            // Get RSS Feeds per plan
            $rss_limit = $this->plans->get_plan_features($this->user_id, 'rss_feeds');
            // Get all options
            $options = $this->options->get_all_options();
            // Load view/user/rss-feeds.php file
            $this->body = 'user/rss-feeds';
            $this->content = ['data' => $all_rss, 'options' => $options, 'rss_limit' => $rss_limit];
            $this->user_layout();
        } else {
            if (is_numeric($arg)) {
                // Get RSS data by rss_id
                $rss = $this->rss->get_rss($arg);
                $content = parse_rss_feed($rss[0]->rss_url);
                // Get all connected accounts
                $networks = $this->networks->get_networks($this->user_id);
                $published = 0;
                $posts_published = $this->user_meta->get_post_number($this->user_id);
                $published_limit = $this->plans->get_plan_features($this->user_id, 'publish_posts');
                $selected_accounts = $this->plans->get_plan_features($this->user_id, 'publish_accounts');
                if ($posts_published) {
                    $posts_published = unserialize($posts_published[0]->meta_value);
                    if (($posts_published['date'] == date('Y-m'))) {
                        $published = $posts_published['posts'];
                    }
                }
                // Load view/user/rss.php file
                $this->body = 'user/rss';
                $this->content = ['data' => $content, 'title' => $rss[0]->rss_name, 'refferal' => trim($rss[0]->refferal), 'period' => trim($rss[0]->period), 'include' => trim($rss[0]->include), 'exclude' => trim($rss[0]->exclude), 'enabled' => $rss[0]->enabled, 'publish_description' => $rss[0]->publish_description, 'publish_url' => $rss[0]->publish_url, 'rss_id' => $rss[0]->rss_id, 'networks' => $networks, 'rss_networks' => $rss[0]->networks, 'published' => $published, 'limit' => $published_limit, 'selected_accounts' => $selected_accounts, 'publish_way' => $rss[0]->pub, 'type' => $rss[0]->type];
                $this->user_layout();
            } else {
                // Get all RSS Feeds
                $all_rss = $this->rss->get_all_rss($this->user_id);
                // Get RSS Feeds per plan
                $rss_limit = $this->plans->get_plan_features($this->user_id, 'rss_feeds');
                if(($all_rss?count($all_rss):0) >= $rss_limit){
                    exit();
                }
                // Load view/user/rss-feeds.php file
                $this->body = 'user/rss-feed';
                $this->content = ['data' => ''];
                $this->user_layout();
            }
        }
    }

    /**
     * The function tools displays the tools page.
     * 
     * @return void
     */
    public function tools($name = NULL) {
        // Check if the current user is admin and if session exists
       // $this->check_session($this->user_role, 0);
       // $this->_check_unconfirmed_account();
        if ($this->options->check_enabled('enable_tools_page') == false)
            show_404();
        include_once APPPATH . 'interfaces/Tools.php';
        if ($name) {
            if (file_exists(APPPATH . 'tools' . '/' . $name . '/' . $name . '.php')) {
                include_once APPPATH . 'tools' . '/' . $name . '/' . $name . '.php';
                $class = ucfirst(str_replace('-', '_', $name));
                $get = new $class;
                $page = $get->page(['user_id' => $this->user_id]);
                $info = $get->check_info();
                // Load view/user/tool.php file
                $this->body = 'user/tool';
                $this->content = ['info' => $info, 'page' => $page];
                $this->user_layout();
            } else {
                echo display_mess(47);
            }
        } else {
            // Get all available tools.
            $classes = [];
            foreach (scandir(APPPATH . 'tools') as $dirname) {
                if (is_dir(APPPATH . 'tools' . '/' . $dirname) && ($dirname != '.') && ($dirname != '..')) {
                    include_once APPPATH . 'tools' . '/' . $dirname . '/' . $dirname . '.php';
                    $class = ucfirst(str_replace('-', '_', $dirname));
                    $get = new $class;
                    $classes[] = $get->check_info();
                }
            }
            $get_favourites = $this->user_meta->get_favourites($this->user_id);
            $favourites = '';
            if ($get_favourites) {
                $favourites = unserialize($get_favourites[0]->meta_value);
            }
            // Get all options
            $options = $this->options->get_all_options();
            // Load view/user/tools.php file
            $this->body = 'user/tools';
            $this->content = ['tools' => $classes, 'favourites' => $favourites, 'options' => $options];
            $this->user_layout();
        }
    }

    /**
     * The function networks displays Networks page and network single page.
     *
     * @param $network contains a string with the name of network
     * 
     * @return void
     */
    public function networks($network = null) {
        // Check if the current user is admin and if session exists
       // $this->check_session($this->user_role, 0);
        //$this->_check_unconfirmed_account();
        if (!$network) {
            // Get all available social networks.
            include_once APPPATH . 'interfaces/Autopost.php';
            $classes = [];
            foreach (glob(APPPATH . 'autopost/*.php') as $filename) {
				
                include_once $filename;
                $className = str_replace([APPPATH . 'autopost/', '.php'], '', $filename);
                // Check if the administrator has disabled the $className social network
                if ( ($this->options->check_enabled(strtolower($className)) == FALSE) || (check_plan_networks(strtolower($className)) == FALSE) ) {
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
                    if ($this->options->check_enabled('tool_monitoris') == true) {
                        if(in_array(strtolower($className),['facebook','facebook_pages','facebook_groups','instagram','twitter']))
                        {
                            $netw = '<a href="' . base_url() . 'user/tools/monitoris?net='.strtolower($className).'&page=1">'.ucwords(str_replace('_', ' ', $className)).'</a>';
                        }
                    }
                    
                    $redirect_link="get_content_menu('".base_url() . 'user/networks/' . strtolower($className)."','networks_div')";
                    $classes[] = '
                        <li>
                            <div class="col-md-8 col-sm-8 col-xs-6 clean">';
                             
				 $classes[] .= '<img src="'.base_url().'img/network/'.ucwords($className).'.png" class="network_image">';
							 
                               $classes[] .= '<!--span class="icons" style="background-color:' . $info->color . '">' . $num_accounts . ' '.$this->lang->line('mu111').'</span-->
                            <h3>' .$netw. '</h3>

</div>
                            <div class="col-md-4 col-sm-4 col-xs-6 clean text-right">
                                <a onclick="'.$redirect_link.'" href="javascript:void(0);" class="btn btn-default"><i class="fa fa-cogs" aria-hidden="true"></i> '.$this->lang->line('mu110').'</a>
                            </div>
                        </li>';
                }
            }
            /* <a href="' . base_url() . 'user/networks/' . strtolower($className) . '" class="btn btn-default"><i class="fa fa-cogs" aria-hidden="true"></i> '.$this->lang->line('mu110').'</a> */
            // Load view/user/networks.php file
            $this->body = 'user/networks';
            $this->content = ['data' => $classes];
            $this->user_layout($this->lang->line('mu112'));
        } else {
            // Check if the network is disabled
            if ( ($this->options->check_enabled(strtolower($network)) == false) || (check_plan_networks(strtolower($network)) == FALSE) ) {
                die();
            }
            $allaccounts = $this->networks->get_all_accounts($this->user_id, $network);
            $msg = '';
            if ($this->session->flashdata('deleted')) {
                $msg = 'popup_fon(\'subi\', \''.$this->session->flashdata('deleted').'\', 1500, 2000);';
            }
            $network = ucfirst($network);
            include_once APPPATH . 'interfaces/Autopost.php';
            include_once APPPATH . 'autopost/' . $network . '.php';
            $get = new $network;
            $info = $get->get_info();
            $popup = (property_exists($info, 'popup')) ? $info->popup : '';
            $hidden = (property_exists($info, 'hidden')) ? $info->hidden : '';
            // Get all options
            $options = $this->options->get_all_options();
            // Load plan features
			
            $limit_accounts = $this->plans->get_plan_features($this->user_id, 'network_accounts');
            // Load view/user/network.php file
            $this->body = 'user/network';
            $this->content = ['data' => $allaccounts, 'network' => $network, 'msg' => $msg, 'popup' => $popup, 'hidden' => $hidden, 'options' => $options, 'limit_accounts' => $limit_accounts];
            $this->user_layout();
        }
    }

    /**
     * The function Settings displays the Settings page.
     * 
     * @return void
     */
    public function settings() {
        
        // Verify if is a team's member
        if ( $this->session->userdata( 'member' ) ) {
            redirect('user/home');
        } 
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        $this->_check_unconfirmed_account();
        // Get User Information
        $getdata = $this->user->get_user_info($this->user_id);
        // Get User's options
        $options = $this->user_meta->get_all_user_options($this->user_id);
        // display user data in settings page
        $this->content = ['udata' => $getdata, 'options' => $options];
        // Load view/user/settings.php file
        $this->body = 'user/settings';
        $this->user_layout();
    }

    /**
     * The function expiration_tokens displays the tokens which will expire soon or already were expired
     * 
     * @return void
     */
    public function expiration_tokens() {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        $this->_check_unconfirmed_account();
        $allaccounts = $this->networks->get_expired_tokens($this->user_id);
        if ( !$allaccounts ) {
            $this->user_meta->enable_disable_user_option($this->user_id, 'tokens-expiration');
        }
        $msg = '';
        if ($this->session->flashdata('deleted')) {
            $msg = 'popup_fon(\'subi\', \''.$this->session->flashdata('deleted').'\', 1500, 2000);';
        }
        // display user data in settings page
        $this->content = ['accounts' => $allaccounts, 'msg' => $msg];
        // Load view/user/expiration-tokens.php file
        $this->body = 'user/expiration-tokens';
        $this->user_layout();
    }

    /**
     * The function notification displays the notifications page
     * 
     * @return void
     */
    public function notifications() {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        $this->_check_unconfirmed_account();
        $notifications = $this->notifications->get_notifications($this->user_id);
        // Load view/user/notifications.php file
        $this->body = 'user/notifications';
        $this->content = ['notifications' => $notifications];
        $this->user_layout();
    }

    /**
     * The function plans displays the plans page.
     * 
     * @return void
     */
    public function plans() {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        $this->_check_unconfirmed_account();
        // Get all plans
        $get_plans = $this->plans->get_all_plans();
        // Get user plan
        $user_plan = $this->plans->get_user_plan($this->user_id);
        // Check if user plan expires soon
        $check_plan = $this->plans->check_if_plan_ended($this->user_id);
        $expires_soon = 0;
        if ($check_plan) {
            if ($check_plan < time() + 432000) {
                $expires_soon = 1;
            }
        }
        $upgrade = '';
        if($this->session->flashdata('upgrade'))
        {
            $upgrade = $this->session->flashdata('upgrade');
        }
        // Load view/user/plans.php file
        $this->body = 'user/plans';
        $this->content = ['plans' => $get_plans, 'user_plan' => $user_plan, 'expires_soon' => $expires_soon, 'upgrade' => $upgrade];
        $this->user_layout();
    }

    /**
     * The function Upgrade change the user plan.
     *
     * @param $plan_id contains the id of the upgrading plan
     * 
     * @return void
     */
    public function upgrade($plan_id) {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        $this->_check_unconfirmed_account();
        $price = $this->plans->get_plan_price($plan_id);
        if ($price[0]->plan_price > 0) {
            $this->body = 'user/gateways';
            $this->content = ['plan' => $plan_id];
            $this->user_layout();
        } else {
            if($this->plans->change_plan($plan_id, $this->user_id))
            {
                $this->session->set_flashdata('upgrade', display_mess(105));
            } else {
                $this->session->set_flashdata('upgrade', display_mess(106));
            }
            // go to plans page
            redirect('user/plans');
        }
    }
    
    /**
     * The function Pay will redirect user to pay
     *
     * @param $net contains the gateway name
     * @param $plan_id contains the id of the upgrading plan
     * 
     * @return void
     */
    public function pay($net,$plan_id) {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        $this->_check_unconfirmed_account();
        // Load PayPal Helper
        $this->load->helper('paypal_helper');
        $price = $this->plans->get_plan_price($plan_id);
        if ($price[0]->plan_price > 0) {
            switch($net)
            {
                case 'paypal':
                    if(get_option('paypal-address') && get_option('identity-token')):
                        pay_now($plan_id, $price[0]->plan_price, $price[0]->currency_code);
                    endif;
                    break;
                case 'voguepay':
                    if(get_option('merchant-id')):
                        voguepay($plan_id, $price[0]->plan_price, $price[0]->currency_code, $this->user_id);
                    endif;
                    break;
                case '2checkout':
                    if(get_option('2co-account-number')):
                        checkout2($plan_id, $price[0]->plan_price, $price[0]->currency_code, $this->user_id, $plan_id);
                    endif;
                    break; 
                case 'stripe':
                    if(file_exists(FCPATH.'vendor/stm/init.php') && get_option('stripe-secret')):
                    $this->body = 'user/stripe';
                    $this->content = ['plan' => $plan_id];
                    $this->user_layout();
                    else:
                        display_mess(45);
                    endif;
                    break;
            }
        } else {
            if($this->plans->change_plan($plan_id, $this->user_id)) {
                $this->session->set_flashdata('upgrade', display_mess(105));
            } else {
                $this->session->set_flashdata('upgrade', display_mess(106));
            }
            // go to plans page
            redirect('user/plans');
        }
    }
    
    /**
     * The function Charge_stripe allows to pay with stripe
     *
     * @param $plan_id contains the id of the upgrading plan
     * 
     * @return void
     */
    public function charge_stripe($plan_id) {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        $this->_check_unconfirmed_account();
        // Load PayPal Helper
        $this->load->helper('paypal_helper');
        $price = $this->plans->get_plan_price($plan_id);
        if ($price[0]->plan_price > 0) {
            if ($this->input->post()) {
                $this->form_validation->set_rules('number', 'Card Number', 'trim|required');
                $this->form_validation->set_rules('month', 'Month', 'trim|required');
                $this->form_validation->set_rules('year', 'Year', 'trim|required');
                $this->form_validation->set_rules('cvc', 'CVC', 'trim|required');
                $number = $this->input->post('number');
                $month = $this->input->post('month');
                $year = $this->input->post('year');
                $cvc = $this->input->post('cvc');
                if ($this->form_validation->run() != false) {
                    $result = pay_stripe($plan_id,$price[0]->plan_price,$price[0]->currency_code,$number,$month,$year,$cvc);
                    if(@$result['value'])
                    {
                        if($this->plans->check_payment($result['value'], $result['code'], $result['plan_id'], $result['tx'], $this->user_id,'Stripe'))
                        {
                            $this->session->set_flashdata('upgrade', display_mess(105));
                        } else {
                            $this->session->set_flashdata('upgrade', display_mess(106));
                        }
                        redirect('user/plans');
                    } else{
                        $this->session->set_flashdata('upgrade', display_mess(106));
                        redirect('user/plans');
                    }
                } else {
                    $this->session->set_flashdata('upgrade', display_mess(106));
                    redirect('user/plans');
                }
            } else {
                $this->session->set_flashdata('upgrade', display_mess(106));
                redirect('user/plans');
            }
        } else {
            if($this->plans->change_plan($plan_id, $this->user_id))
            {
                $this->session->set_flashdata('upgrade', display_mess(105));
            } else {
                $this->session->set_flashdata('upgrade', display_mess(106));
            }
            // go to plans page
            redirect('user/plans');
        }
    }

    /**
     * The function success_payment check the transaction if is valid and change the user plan.
     * 
     * @return void
     */
    public function success_payment() {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        $this->_check_unconfirmed_account();
        // Load PayPal Helper
        $this->load->helper('paypal_helper');
        if(get_instance()->input->get('tx', TRUE)) {
            $check_payment = check_payment();
            if ($check_payment) {
                if ($this->plans->check_payment($check_payment['value'], $check_payment['code'], $check_payment['plan_id'], $check_payment['tx'], $this->user_id, 'PayPal')) {
                    $this->session->set_flashdata('upgrade', display_mess(105));
                } else {
                    $this->session->set_flashdata('upgrade', display_mess(106));
                }
                redirect('user/plans');
            } else {
                $this->session->set_flashdata('upgrade', display_mess(106));
                redirect('user/plans');
            }
        } else if(get_instance()->input->get('ip_country', TRUE)) {
            $sid = get_instance()->input->get('sid', TRUE);
            $currency_code = get_instance()->input->get('currency_code', TRUE);
            $total = get_instance()->input->get('total', TRUE);
            $plan_id = get_instance()->input->get('plan_id', TRUE);
            $order_number = get_instance()->input->get('order_number', TRUE);
            $key = get_instance()->input->get('key', TRUE);
            $price = $this->plans->get_plan_price($plan_id);
            if($price) {
                $hashSecretWord = get_option('2co-secret-word'); //2Checkout Secret Word
                $hashSid = $sid; //2Checkout account number
                $hashTotal = $total; //Sale total to validate against
                $hashOrder = $order_number; //2Checkout Order Number
                $StringToHash = strtoupper(md5($hashSecretWord . $hashSid . $hashOrder . $hashTotal));
                if ($StringToHash == $key) {
                    if(($price[0]->plan_price == $total) && ($price[0]->currency_code == $currency_code)) {
                        if($this->plans->check_payment($total, $currency_code, $plan_id, $order_number, $this->user_id, '2checkout')) {
                            $this->session->set_flashdata('upgrade', display_mess(105));
                        } else {
                            $this->session->set_flashdata('upgrade', display_mess(106));
                        }
                        redirect('user/plans');
                    }
                }
            }
        } else {
            $request = $this->security->xss_clean($_REQUEST);
            if(@$request['transaction_id']) {
                vogue_success($request,$this->user_id);
                if($this->plans->check_transaction($request['transaction_id'])) {
                    if($this->plans->payment_done($this->user_id, 'voguepay')) {
                        $this->session->set_flashdata('upgrade', display_mess(105));
                    } else {
                        $this->session->set_flashdata('upgrade', display_mess(106));
                    }
                    redirect('user/plans');
                } else {
                    $this->session->set_flashdata('upgrade', display_mess(106));
                    redirect('user/plans');
                }
            } else {
                $this->session->set_flashdata('upgrade', display_mess(106));
                redirect('user/plans');
            }
        }
    }

    /**
     * The function get_notification displays a notification
     *
     * @param $notification_id is the id of the selected notification
     * 
     * @return void
     */
    public function get_notification($notification_id) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        // Get notification data by $notification_id
        $get_notification = $this->notifications->get_notification($notification_id, $this->user_id);
        if ($get_notification) {
            echo json_encode($get_notification);
        }
    }   

    /**
     * The function del_notification deletes a notification
     *
     * @param $notification_id is the id of the selected notification
     * 
     * @return void
     */
    public function del_notification($notification_id) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        // delete notification by $notification_id and $this->user_id
        $del_notification = $this->notifications->del_notification($notification_id, $this->user_id);
        if (!$del_notification) {
            display_mess();
        } else {
            echo json_encode('');
        }
    }

    /**
     * The function content_from_url gets contents from an url
     *
     * @param $url contains the address of a page or website
     * 
     * @return void
     */
    public function content_from_url($url) {
        // Check if the current user is admin and if session exists
        $url = str_replace('-', '/', $url);
        $url = $this->security->xss_clean(base64_decode($url));
        echo json_encode(get_site($url));
    }

    /**
     * The function bookmark saves new tool to favourites
     *
     * @param $tool contains the tool name
     * 
     * @return void
     */
    public function bookmark($tool) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $tool = str_replace('-', '/', $tool);
        $tool = $this->security->xss_clean(base64_decode($tool));
        $get_favourites = $this->user_meta->get_favourites($this->user_id);
        if ($get_favourites) {
            $get_favourites = unserialize($get_favourites[0]->meta_value);
            if (in_array($tool, $get_favourites)) {
                unset($get_favourites[array_search($tool, $get_favourites)]);
            } else {
                array_push($get_favourites, $tool);
            }
            if ($get_favourites) {
                $set_favourites = serialize($get_favourites);
                if ($this->user_meta->update_favourites($this->user_id, $set_favourites)) {
                    echo json_encode(1);
                }
            } else {
                if ($this->user_meta->delete_favourites($this->user_id)) {
                    echo json_encode(2);
                }
            }
        } else {
            $tool = serialize([$tool]);
            if ($this->user_meta->update_favourites($this->user_id, $tool)) {
                echo json_encode(1);
            }
        }
    }

    /**
     * The function set_option adds new value for an option
     *
     * @param $option_name contains the name of option
     * 
     * @return void
     */
    public function set_option($option_name) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        if ($option_name) {
            // Enable or disable the $option_name option
            if ($this->user_meta->enable_disable_user_option($this->user_id, $option_name)) {
                echo json_encode(1);
            } else {
                display_mess();
            }
        }
    }

    /**
     * The function rss_option enables and disables an user's rss option
     *
     * @param $rss_id id the is of a rss feed
     * @param $option is the rss's option
     * 
     * @return void
     */
    public function rss_option($rss_id, $option) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        if ($option) {
            // Enable or disable the $option option
            if ($this->rss->enable_or_disable_rss_option($this->user_id, $rss_id, $option)) {
                echo json_encode(1);
            } else {
                display_mess();
            }
        }
    }

    /**
     * The function set_schedule_rss schedules the publishing of a post
     *
     * @param $rss_url contains the post url
     * @param $time contains the time when will be published the post
     * @param $ctime contains the current time
     * @param $rss_id contains the rss id
     * 
     * @return void
     */
    public function set_schedule_rss($rss_url, $time, $ctime, $rss_id) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $time = $time - $ctime + time();
        $rss_url = str_replace('-', '/', $rss_url);
        $rss_url = urldecode($this->security->xss_clean(base64_decode($rss_url)));
        $feed_rss = $this->rss->get_rss($rss_id);
        $title = '';
        $description = '';
        $img = '';
        if (@$feed_rss) {
            $parsed = parse_rss_feed($feed_rss[0]->rss_url);
            if (@$parsed) {
                for ($n = 0; $n < count($parsed['title']); $n++) {
                    $uri = $parsed['url'][$n];
                    if (preg_match('/amazon./i', $rss_url)) {
                        $rss_url = explode('ref=', $rss_url);
                        $rss_url = $rss_url [0];
                    }
                    if (preg_match('/amazon./i', $parsed['url'][$n])) {
                        $uri = explode('ref=', $parsed['url'][$n]);
                        $uri = $uri [0];
                    }
                    if (preg_match('/news.google/i', $parsed['url'][$n])) {
                        $uri = explode('&url=', $parsed['url'][$n]);
                        $uri = (@$uri[1])?$uri[1]:$uri[0];
                        $rss_u = explode('&url=', $rss_url);
                        $rss_url = (@$rss_u[1])?$rss_u[1]:$rss_u[0];
                    }
                    if ($uri == $rss_url) {
                        $title = @htmlentities(stripslashes(trim($parsed['title'][$n])));
                        $description = @htmlentities(stripslashes(trim($parsed['description'][$n])));
                        $img = trim($parsed['show'][$n]);
                        break;
                    }
                }
            }
        }
        if ($title) {
            if ($this->rss->schedule_rss($this->user_id, $rss_id, $rss_url, $time, $title, $description, $img)) {
                echo json_encode(1);
            } else {
                display_mess();
            }
        } else {
            display_mess();
        }
    }

    /**
     * The function delete_post_rss deletes scheduled post from feed rss
     *
     * @param $rss_url contains the post url
     * 
     * @return void
     */
    public function delete_post_rss($rss_url) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $rss_url = str_replace('-', '/', $rss_url);
        $rss_url = $this->security->xss_clean(base64_decode($rss_url));
        if ($this->rss->delete_post_rss($this->user_id, $rss_url)) {
            echo json_encode(1);
        } else {
            display_mess();
        }
    }

    /**
     * The function rss_networks saves networks for a RSS Feed
     *
     * @param $rss_id is the id of a rss feed
     * @param $networks contains the rss's networks
     * 
     * @return void
     */
    public function rss_networks($rss_id, $networks) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        if ($networks) {
            $networks = str_replace('-', '/', $networks);
            $networks = $this->security->xss_clean(base64_decode($networks));
            // Save networks
            if ($this->rss->save_networks($this->user_id, $rss_id, $networks)) {
                echo json_encode('');
            } else {
                display_mess();
            }
        }
    }

    /**
     * The function rss_networks gets preview for a selected social network
     *
     * @param $network is the network
     * @param $url is the address required for some social networks
     * @param $img is the image required for preview
     * 
     * @return void
     */
    public function preview($network, $url = null, $img = null, $video = null) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $url = str_replace("-", "/", $url);
        $url = $this->security->xss_clean(base64_decode($url));
        $img = $this->security->xss_clean(base64_decode($img));
        $video = $this->security->xss_clean(base64_decode($video));
        $args = ['url' => $url, 'img' => $img, 'video' => $video];
        include_once APPPATH . 'interfaces/Autopost.php';
        if (file_exists(APPPATH . 'autopost/' . ucfirst($network) . '.php')) {
            include_once APPPATH . 'autopost/' . ucfirst($network) . '.php';
            $get = new $network;
            $result = $get->preview($args);
			
            if (property_exists($result, 'name') && property_exists($result, 'head') && property_exists($result, 'content') && property_exists($result, 'icon')) {
                echo json_encode(['name' => $result->name, 'head' => $result->head, 'content' => $result->content, 'icon' => $result->icon]);
            } elseif (property_exists($result, 'info')) {
				// print_r($result->info);
			// die;
                echo json_encode(['info' => $result->info]);
            }
        } else {
            display_mess(66);
        }
    }

    /**
     * The function update_userinfo updates user information
     * 
     * @return void
     */
    public function update_userinfo() {
        
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        
        // Verify if is a team's member
        if ( $this->session->userdata( 'member' ) ) {
            exit();
        }
        
        // Check if data was submitted
        if ($this->input->post()) {
            // Add form validation
            $this->form_validation->set_rules('password', 'Password', 'trim');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
            // Get data
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            $user_id = $this->user_id;
            // Check form validation
            if ($this->form_validation->run() == false) {
                display_mess(16);
            } else {
                if ($this->user->check_email($email, $user_id) == true) {
                    // Check if the email address is present in our database
                    display_mess(57);
                } else {
                    if ($this->user->updateuser($user_id, $email, $password)) {
                        display_mess(67);
                    } else {
                        display_mess(68);
                    }
                }
            }
        }
    }

    /**
     * The function update_userinfo updates user information
     *
     * @param $msgId contains the message's id
     * 
     * @return void
     */
    public function show_post($msgId) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        // Get post data by user id and post id
        $getmes = $this->posts->get_post($this->user_id, $msgId);
        if ($getmes) {
            echo json_encode($getmes);
        }
    }

    /**
     * The function new_rss gets data from RSS or saves a new Feed RSS
     *
     * @param $url contains RSS Feed's url
     * @param $save is an option to save new RSS Feed
     * 
     * @return void
     */
    public function new_rss($url, $save = null) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $url = str_replace('-', '/', $url);
        if ($save) {
            // Save new feed
            $url = $this->security->xss_clean(base64_decode($url));
            $get_content = parse_rss_feed($url);
            if (@$get_content['rss_title']) {
                $response = $this->rss->save_new_rss($this->user_id, $url, stripslashes($get_content['rss_title']));
                if ($response == 1) {
                    echo json_encode(display_mess(86));
                } elseif ($response > 3) {
                    echo json_encode(['msg' => display_mess(87), 'last_id' => $response]);
                } elseif ($response == 3) {
                    echo json_encode(display_mess(88));
                }
            } else {
                echo json_encode(display_mess(89));
            }
        } else {
            // Displays content from $url
            $url = $this->security->xss_clean(base64_decode($url));
            if ($url) {
                $parse_url = parse_rss_feed($url);
                echo json_encode($parse_url);
            }
        }
    }

    /**
     * The function delete_post deletes a post
     *
     * @param $msgId is the post's id
     * 
     * @return void
     */
    public function delete_post($msgId) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        // Delete post data by user id and post id
        $getmes = $this->posts->delete_post($this->user_id, $msgId);
        if ($getmes) {
            echo json_encode(1);
        }
    }

    /**
     * The function get_categories gets all categories for a social network
     *
     * @param $network contains the network name
     * @param $id contains the user id from a social network
     * 
     * @return void
     */
    public function get_categories($network, $id) {
        // Check if the current user is admin and if session exists
        $this->check_session();
        if ($this->user_role == 1) {
            display_mess(1);
        }
        $categories = get_categories(['network' => strtolower($network), 'blog_id' => $id]);
        if ($categories) {
            echo json_encode($categories);
        } else {
            display_mess(1);
        }
    }

    /**
     * The function get_selected gets all selected accounts where will be published a post
     *
     * @param $selected contains all selected ids
     * 
     * @return void
     */
    public function get_selected($selected) {
        // Check if the current user is admin and if session exists
        $this->check_session();
        if ($this->user_role == 1) {
            display_mess(1);
        }
        $accounts = explode(",", json_encode(base64_decode($selected)));
        $account = [];
        if ($accounts) {
            foreach ($accounts as $cont) {
                $acont = $this->networks->get_account(trim($cont, '"'));
                $expire = (trim($acont[0]->expires) == '') ? $this->lang->line('mm125') : substr($acont[0]->expires, 0, 19);
                $account[] = '<li>' . $acont[0]->user_name . ' <span class="expires">'.$this->lang->line('mm126').' <strong>' . $expire . '</strong></span><div class="btn-group pull-right"><button type="button" class="btn btn-default select-net active" data-categories="1" data-account="' . $acont[0]->network_id . '" data-net="' . $acont[0]->net_id . '">'.$this->lang->line('mm120').'</button></div></li>';
            }
        }
        echo json_encode($account);
    }

    /**
     * The function show_posts will display posts with pagination
     *
     * @param $page is the page number
     * @param $search is the key
     * 
     * @return void
     */
    public function show_posts($page, $search = null) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $limit = 10;
        $page--;
        $total = $this->posts->count_all_posts($this->user_id, $search);
        $getmes = $this->posts->get_posts($this->user_id, $page * $limit, $limit, $search);
        if ($getmes) {
            $data = ['total' => $total, 'date' => time(), 'posts' => $getmes];
            echo json_encode($data);
        }
		else{
			$data = ['total' => '0', 'date' => '', 'posts' => ''];
            echo json_encode($data);
		}
    }
    
    /**
     * The function get_media gets user's media
     *
     * @param $type contains the media's type
     * @param $page contains the page number
     * 
     * @return void
     */
    public function get_media($type, $page) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        // Load Media Model
        $this->load->model('media');
        $limit = 10;
        $page--;
        $total = $this->media->get_user_media($this->user_id, $type);
        $getmed = $this->media->get_user_medias($this->user_id, $type, $page * $limit, $limit);
        if ($getmed) {
            $data = ['total' => $total, 'medias' => $getmed];
            echo json_encode($data);
        }
    }
    
    /**
     * The function delete_media deletes user's media
     *
     * @param $media_id contains the media's ID
     * 
     * @return void
     */
    public function delete_media($media_id) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        // Load Media Model
        $this->load->model('media');
        // Verify if the user is owner of the media
        $get_media = $this->media->single_media($this->user_id, $media_id);
        if($get_media) {
            if($this->media->delete_media($this->user_id, $media_id)) {
                $filename = str_replace(base_url(), FCPATH, $get_media[0]->body);
                if($get_media[0]->type == 'image') {
                    echo json_encode(display_mess(132));
                } else {
                    echo json_encode(display_mess(133));
                }
                @unlink($filename);
            }
        }
    }

    /**
     * The function show_feed_posts will display published posts with pagination
     *
     * @param $page is the page number
     * @param $rss_id is the feed RSS id
     * 
     * @return void
     */
    public function show_feed_posts($page, $rss_id) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $limit = 10;
        $page--;
        $rss = $this->rss->get_rss($rss_id);
        $total = $this->rss->count_all_feed_posts($this->user_id, $rss_id, $rss[0]->pub);
        $getposts = $this->rss->get_posts($this->user_id, $rss_id, $page * $limit, $limit, $rss[0]->pub);
        if ($getposts) {
            $data = ['total' => $total, 'date' => time(), 'posts' => $getposts];
            echo json_encode($data);
        }
    }

    /**
     * The function search_posts searches posts
     *
     * @param $search contains the search key
     * 
     * @return void
     */
    public function search_posts($search) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $limit = 10;
        $page = 0;
        $total = $this->posts->count_all_posts($this->user_id, $search);
        $getmes = $this->posts->get_posts($this->user_id, $page * $limit, $limit, $search);
        if ($getmes) {
            $data = ['total' => $total, 'date' => time(), 'posts' => $getmes];
            echo json_encode($data);
        }
    }

    /**
     * The function search_posts searches posts
     *
     * @param $network displays accounts per network
     * @param $page is the number of page
     * @param $search contains search key
     * 
     * @return void
     */
    public function show_accounts($network, $page, $search = null) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $limit = 10;
        $page--;
        $total = $this->networks->count_all_accounts($this->user_id, $network, $search);
        $get_accounts = ($search) ? $this->networks->get_accounts($this->user_id, $network, $page * $limit, $search) : $this->networks->get_accounts($this->user_id, $network, $page * $limit);
        if ($get_accounts) {
            $data = ['total' => $total, 'accounts' => $get_accounts];
            echo json_encode($data);
        }
    }

    /**
     * The function show_feeds displays rss feeds with pagination
     *
     * @param $page contains number of page
     * 
     * @return void
     */
    public function show_feeds($page) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $limit = 10;
        $page--;
        $total = $this->rss->count_feeds($this->user_id);
        $get_feeds = $this->rss->get_rss_feeds($this->user_id, $page * $limit, $limit);
        if ($get_feeds) {
            $data = ['total' => $total, 'feeds' => $get_feeds];
            echo json_encode($data);
        }
    }

    /**
     * The function search_accounts searches accounts on database
     *
     * @param $network is the network name
     * @param $search is the search key
     * 
     * @return void
     */
    public function search_accounts($network, $search = null) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $limit = 10;
        $page = 0;
        $search = str_replace('-', '/', $search);
        $search = $this->security->xss_clean(base64_decode($search));
        $total = $this->networks->count_all_accounts($this->user_id, $network, $search);
        $get_accounts = ($search) ? $this->networks->get_accounts($this->user_id, $network, 0, $search) : $this->networks->get_accounts($this->user_id, $network);
        if ($get_accounts) {
            $data = ['total' => $total, 'accounts' => $get_accounts];
            echo json_encode($data);
        }
    }

    /**
     * The function publish publishes posts on social networks
     * 
     * @return void
     */
    public function publish() {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        // Check if data was submitted
        if ($this->input->post()) {
            // Add form validation
            $this->form_validation->set_rules('post', 'Post', 'trim|required');
            $this->form_validation->set_rules('networks', 'Networks', 'trim');
            $this->form_validation->set_rules('url', 'Url', 'trim');
            $this->form_validation->set_rules('img', 'Image', 'trim');
            $this->form_validation->set_rules('video', 'Video', 'trim');
            $this->form_validation->set_rules('category', 'Category', 'trim');
            $this->form_validation->set_rules('all_planns', 'All Plans', 'trim');
            $this->form_validation->set_rules('date', 'Date', 'trim');
            $this->form_validation->set_rules('current_date', 'Current Date', 'trim');
            $this->form_validation->set_rules('post_title', 'Post Title', 'trim');
            $this->form_validation->set_rules('publish', 'Publish', 'trim|integer');
            // Get data
            $post = str_replace('-', '/', $this->input->post('post'));
            $post = $this->security->xss_clean(base64_decode($post));
            $networks = $this->input->post('networks');
            $url = $this->input->post('url');
            $img = $this->input->post('img');
            $video = $this->input->post('video');
            $category = $this->input->post('category');
            $all_planns = $this->input->post('all_planns');
            $date = $this->input->post('date');
            $current_date = $this->input->post('current_date');
            $publish = $this->input->post('publish');
            $post_title = $this->input->post('post_title');
            // Get number of published posts in this month
            $posts_published = $this->user_meta->get_post_number($this->user_id);
            if ($posts_published) {
                $published_limit = $this->plans->get_plan_features($this->user_id, 'publish_posts');
                $posts_published = unserialize($posts_published[0]->meta_value);
                if (($posts_published['date'] == date('Y-m')) AND ( $published_limit <= $posts_published['posts'])) {
                    $publish = 0;
                }
            }
            if ($this->form_validation->run() == false) {
                display_mess(6);
            } else {
                $date = (is_numeric(strtotime($date))) ? strtotime($date) : time();
                $current_date = (is_numeric(strtotime($current_date))) ? strtotime($current_date) : time();
                // If date is null or has invalid format will be converted to current time or null with strtotime
                if ($date > $current_date) {
                    // The post will be scheduled
                    $publish = 2;
                    $d = $date - $current_date;
                    $date = time() + $d;
                } else {
                    $date = time();
                }
                if(is_numeric($networks)) {
                    // Load Lists Model
                    $this->load->model('lists');
                    $metas = $this->lists->get_lists_meta($this->user_id, 0, $networks, 3);
                    if($metas) {
                        $category = $networks;
                        $networks = $metas;
                    } else {
                        display_mess(131);
                        exit();
                    }
                }
                $lastId = $this->posts->save_post($this->user_id, $post, $url, $img, $video, $date, $publish, $category, $post_title);
                if ($networks != '{}') {
                    if ($lastId) {
                        $net = '';
                        if(!is_numeric($category)) {
                            $networks = (array) json_decode($networks);
                            foreach ($networks as $network => $account) {
                                $post2 = $post;
                                $post_title2 = $post_title;
                                // Check if network exists
                                if (file_exists(APPPATH . 'autopost/' . ucfirst($network) . '.php')) {
                                    $accounts = json_decode($account);
                                    if ($accounts) {
                                        foreach ($accounts as $ac_id) {
                                            if ($publish == 1) {
                                                if(get_user_option('use_spintax_posts') == 1) {
                                                    if(in_array($network, $this->socials)) {
                                                        $post2 = get_instance()->ecl('Deco')->lsd($post2, $this->user_id);
                                                        if ( $post_title2 ) {
                                                            $post_title2 = get_instance()->ecl('Deco')->lsd($post_title2, $this->user_id);
                                                        }
                                                    } else {
                                                        $this->socials[] = $network;
                                                    }
                                                }
                                                $args = ['post' => $post2, 'title' => $post_title2, 'network' => $network, 'account' => $ac_id, 'url' => $url, 'img' => $img, 'video' => $video, 'category' => $category, 'id' => $lastId];
                                                $check_pub = publish($args);
                                                if ($check_pub) {
                                                    if ($net) {
                                                        if (!preg_match('/' . $network . '/i', $net)) {
                                                            $net .= ', ' . ucfirst(str_replace('_', ' ', $network));
                                                        }
                                                    } else {
                                                        if (!preg_match('/' . $network . '/i', $net)) {
                                                            $net .= ucfirst(str_replace('_', ' ', $network));
                                                        }
                                                    }
                                                    $this->posts->save_post_meta($lastId, $ac_id, $network, 1, $this->user_id);
                                                } else {
                                                    $this->posts->save_post_meta($lastId, $ac_id, $network, 2, $this->user_id);
                                                }
                                            } else {
                                                $net .= ucfirst(str_replace('_', ' ', $network));
                                                $this->posts->save_post_meta($lastId, $ac_id, $network, 0, $this->user_id);
                                            }
                                        }
                                    }
                                }
                            }
                        } else {
                            if($networks) {
                                foreach ($networks as $meta) {
                                    $post2 = $post;
                                    $post_title2 = $post_title;
                                    // Check if network exists
                                    if (file_exists(APPPATH . 'autopost/' . ucfirst($meta->network_name) . '.php')) {
                                        if($this->user->get_user_option($this->user_id, 'use_spintax_posts') == 1) {
                                            if(in_array($meta->network_name, $this->socials)) {
                                                $post2 = get_instance()->ecl('Deco')->lsd($post2, $this->user_id);
                                                if($post_title2) {
                                                    $post_title2 = get_instance()->ecl('Deco')->lsd($post_title2, $this->user_id);
                                                }
                                            } else {
                                                $this->socials[] = $meta->network_name;
                                            }
                                        }
                                        if ($meta->network_id) {
                                            if ($publish == 1) {
                                                $args = ['post' => $post2, 'title' => $post_title2, 'network' => $meta->network_name, 'account' => $meta->network_id, 'url' => $url, 'img' => $img, 'video' => $video, 'category' => $category, 'id' => $lastId];
                                                $check_pub = publish($args);
                                                if ($check_pub) {
                                                    $net = $this->lang->line('mu210');
                                                    $this->posts->save_post_meta($lastId, $meta->network_id, $meta->network_name, 1, $this->user_id);
                                                }
                                            }
                                        }
                                    }
                                    sleep(1);
                                }
                            }
                            if ($publish == 2) {
                                $net = $this->lang->line('mu210');
                            }
                        }
                        if ($net) {
                            if ($publish > 0){
                                if($all_planns){
                                    // Load Second Helper
                                    $this->load->helper('second_helper');
                                    resend_it($lastId,$all_planns,$current_date);
                                }
                            }
                            if ($publish == 1) {
                                // A new post was published successfully in this month
                                $this->user_meta->set_post_number($this->user_id);
                                display_mess(2, $net);
                            } elseif ($publish == 2) {
                                display_mess(4);
                                // Check if the administrator want to receive a notification about the scheduled post
                                if ($this->options->check_enabled('enable-scheduled-notifications')) {
                                    // Send a notification via email
                                    $args = ['[site_name]' => $this->config->item('site_name'), '[login_address]' => '<a href="' . $this->config->item('login_url') . '">' . $this->config->item('login_url') . '</a>', '[site_url]' => '<a href="' . $this->config->base_url() . '">' . $this->config->base_url() . '</a>'];
                                    // Get the send-password-new-users notification template
                                    $template = $this->notifications->get_template('scheduled-notification', $args);
                                    if ($template) {
                                        $this->email->from($this->config->item('contact_mail'), $this->config->item('site_name'));
                                        $this->email->to($this->config->item('notification_mail'));
                                        $this->email->subject($template['title']);
                                        $this->email->message($template['body']);
                                        $this->email->send();
                                    }
                                }
                            } else {
                                display_mess(3);
                            }
                        } else {
                            display_mess();
                        }
                    } else {
                        display_mess(5);
                    }
                } else {
                    if ($publish == 0) {
                        display_mess(3);
                    } else {
                        display_mess();
                    }
                }
            }
        }
    }

    /**
     * The function connect redirects user to the login page
     *
     * @param $networks contains the name of network
     * 
     * @return void
     */
    public function connect($network) {
        include_once APPPATH . 'interfaces/Autopost.php';
        if ($network == 'wordpress_platform') {
            if ($this->input->post()) {
                $this->form_validation->set_rules('website_name', 'Website Name', 'trim|required');
                $this->form_validation->set_rules('website_url', 'Website Url', 'trim|required');
                $this->form_validation->set_rules('website_key', 'Website Key', 'trim|required');
                // Get data
                $website_name = $this->input->post('website_name');
                $website_url = $this->input->post('website_url');
                $website_key = $this->input->post('website_key');
                if ($this->form_validation->run() == false) {
                    display_mess(47);
                } else {
                    $check = get($website_url . '?key-checker=' . $website_key);
                    if (@is_numeric($check)) {
                        $this->networks->add_network('wordpress_platform', $website_key, $website_key, $this->user_id, '', $website_name, $website_url);
                        redirect('/user/networks/' . $network);
                    } else {
                        display_mess(104);
                    }
                }
            }
        } elseif ($network == 'instagram') {
            if ($this->input->post()) {
                $this->form_validation->set_rules('username', 'Username', 'trim|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                // Get data
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                if ($this->form_validation->run() == false) {
					
                    display_mess(47);
                } else {
                    if (file_exists(APPPATH . 'autopost/Instagram.php')) {
                        include_once APPPATH . 'autopost/Instagram.php';
                        $get = new Instagram();
                        $check = new \InstagramAPI\Instagram(false, false);
                        $user_proxy = $this->user->get_user_option($this->user_id,'proxy');
						
                        if($user_proxy) {
                            $check->setProxy($user_proxy);
                        } else {
                            $proxies = @trim(get_option('instagram_proxy'));
                            if ($proxies) {
                                $proxies = explode('<br>', nl2br($proxies, false));
                                $rand = rand(0, count($proxies));
                                if (@$proxies[$rand]) {
                                    $check->setProxy($proxies[$rand]);
                                }
                            }   
                        }
                        try {
							
							
                            $check->login($username,$password);
							
                            $this->networks->add_network('instagram', $username, $password, $this->user_id, '', $username, '');
                            redirect('/user/callback/' . $network);
                        } catch (Exception $e) {
                            $check = $e->getMessage();
							// print_r($check);
							// die;
                            if(preg_match('/required/i', $check))
                            {
                                echo $this->lang->line('mm140');
                            } else{
                                echo $this->lang->line('mm141');
                            }
                        }
                    }
                }
            }
        }
        // Connects user to his social account
        $this->check_session($this->user_role, 0);
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
     * The function disconnect deletes an account from a social network
     *
     * @param $account_id contains the account's id
     * 
     * @return void
     */
    public function disconnect($account_id) {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        // delete $account by using $account_id and $this->user_id
        if ($this->networks->delete_network($account_id, $this->user_id)) {
            $this->session->set_flashdata('deleted', display_mess(78));
            redirect($_SERVER['HTTP_REFERER']);
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
	
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        include_once APPPATH . 'interfaces/Autopost.php';
        if (file_exists(APPPATH . 'autopost/' . ucfirst($network) . '.php')) {
            include_once APPPATH . 'autopost/' . ucfirst($network) . '.php';
            $get = new $network;
			// print_r($get->save());
			// die;
            $get->save();
			 $user_id = $this->user_id;
			$redirect_link="https://review-thunder.com/profile.php?id=$user_id";
           // redirect('/user/networks/' . $network);
			redirect($redirect_link);
        } else {
            display_mess(47);
        }
    }

    /**
     * The function save_token saves token and user information from his social account
     *
     * @param $network contains the network name
     * @param $token contains the token
     * 
     * @return void
     */
    public function save_token($network, $token) {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        $token = str_replace('-', '/', $token);
        $clean_token = $this->security->xss_clean(base64_decode($token));
        include_once APPPATH . 'interfaces/Autopost.php';
        if (file_exists(APPPATH . 'autopost/' . ucfirst($network) . '.php')) {
            include_once APPPATH . 'autopost/' . ucfirst($network) . '.php';
            $get = new $network;
            if ($get->save($clean_token)) {
                echo 1;
            } else {
                echo display_mess(1);
            }
        } else {
            echo display_mess(1);
        }
    }

    /**
     * The function short_url shorts a url if the api is configured
     *
     * @param $url contains the url
     * 
     * @return void
     */
    public function short_url($url) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $url = str_replace("-", "/", $url);
        $options = $this->options->get_all_options();
        if (@$options['shortener']) {
            // This function will return a short url if Gshorter is configured corectly
            echo json_encode($this->gshorter->short($this->security->xss_clean(base64_decode($url))));
        } else {
            $shorted = $this->short_it($this->security->xss_clean(base64_decode($url)));
            if ($shorted) {
                $url = base_url() . $shorted;
                echo json_encode($url);
            }
        }
    }

    /**
     * The function upimg uploads files on server
     * 
     * @return void
     */
    public function upimg() {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        // Load Media Model
        $this->load->model('media');
        $size = 6000000;
        if(get_option('upload_limit')) {
            $size = get_option('upload_limit')*1000000;
        }
        // Allows user to upload images and post them on the social networks
        if ($_FILES['file']['size'] > $size) {
            die();
        }
        // Verify 
        $check_format = ($_FILES['file']['type'] == 'image/png') || ($_FILES['file']['type'] == 'image/jpeg') || ($_FILES['file']['type'] == 'image/gif');
        if ($_POST['type'] == 'video') {
            $check_format = ($_FILES['file']['type'] == 'video/mp4') || ($_FILES['file']['type'] == 'video/webm') || ($_FILES['file']['type'] == 'video/avi');
            $limit_videos = plan_feature('limit_videos');
            if(!$limit_videos) {
                $limit_videos = 1;
            }
            $ctotal = $this->media->get_user_media($this->user_id, 'video');
            if($ctotal >= $limit_videos) {
                echo json_encode(3);
                exit();
            }
            
        } else {
            $limit_images = plan_feature('limit_images');
            if(!$limit_images) {
                $limit_images = 1;
            }
            $ctotal = $this->media->get_user_media($this->user_id, 'image');
            if($ctotal >= $limit_images) {
                echo json_encode(4);
                exit();
            }
        }
        if ($check_format) {
            $config['upload_path'] = 'assets/share';
            $config['file_name'] = uniqid() . '-' . time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->set_allowed_types('*');
            $data['upload_data'] = '';
            if ($this->upload->do_upload('file')) {
                $data['upload_data'] = $this->upload->data();
                chmod(FCPATH . 'assets/share/' . $data['upload_data']['file_name'], 0644);
                // Save media in the database
                if ($_POST['type'] == 'video') {
                    $this->media->save_media($this->user_id, $this->config->base_url() . 'assets/share/' . $data['upload_data']['file_name'], 'video');
                } else {
                    $this->media->save_media($this->user_id, $this->config->base_url() . 'assets/share/' . $data['upload_data']['file_name'], 'image');
                }
                echo $this->config->base_url() . 'assets/share/' . $data['upload_data']['file_name'];
            }
        } else {
            if ($_POST['type'] == 'video') {
                echo json_encode(5);
            } else {
                echo json_encode(1);
            }
            
        }
    }

    /**
     * The function short_it shorts a url
     *
     * @param $url contains the url
     * 
     * @return void
     */
    public function short_it($url) {
        $check = $this->urls->save_url($url);
        if ($check) {
            return $check;
        } else {
            return false;
        }
    }

    /**
     * The function short redirects to original url
     *
     * @param $param contains the param from url
     * 
     * @return void
     */
    public function short($param) {
        $un = $this->security->xss_clean(base64_decode(str_replace('-', '/', $param)));
        if (is_numeric($un)) {
            $original = $this->urls->get_original_url($un);
            if ($original) {
                $check = @parse_url($_SERVER['HTTP_REFERER']);
                $network_name = 'Unknown';
                $color = '#d3d3d3';
                if (preg_match('/facebook/i', @$check['host'])) {
                    $network_name = 'Facebook';
                    $color = '#86B9EA';
                } else if (preg_match('/t.co/i', @$check['host'])) {
                    $network_name = 'Twitter';
                    $color = '#7BDFE8';
                } else if (preg_match('/flickr/i', @$check['host'])) {
                    $network_name = 'Flickr';
                    $color = '#ea85b6';
                } else if (preg_match('/linkedin/i', @$check['host'])) {
                    $network_name = 'Linkedin';
                    $color = '#287bbc';
                } else if (preg_match('/instagram/i', @$check['host'])) {
                    $network_name = 'Instagram';
                    $color = '#4fffbd';
                } else if (preg_match('/reddit/i', @$check['host'])) {
                    $network_name = 'Reddit';
                    $color = '#e1584b';
                } else if (preg_match('/pinterest/i', @$check['host'])) {
                    $network_name = 'Pinterest';
                    $color = '#ff80a3';
                } else if (preg_match('/umblr/i', @$check['host'])) {
                    $network_name = 'Tumblr';
                    $color = '#AACAE8';
                } else if (preg_match('/vk.com/i', @$check['host'])) {
                    $network_name = 'VK';
                    $color = '#9aabc3';
                } else if (preg_match('/blogspot/i', @$check['host'])) {
                    $network_name = 'Blogger';
                    $color = '#f1a56b';
                } else if (preg_match('/wordpress/i', @$check['host'])) {
                    $network_name = 'Wordpress';
                    $color = '#52c6fb';
                } else if (preg_match('/medium/i', @$check['host'])) {
                    $network_name = 'Medium';
                    $color = '#4fffbd';
                } else if (preg_match('/youtube/i', @$check['host'])) {
                    $network_name = 'Youtube';
                    $color = '#f1a56b';
                } else if (preg_match('/google_plus/i', @$check['host'])) {
                    $network_name = 'Google Plus';
                    $color = '#dd4b39';
                } else if (preg_match('/dailymotion/i', @$check['host'])) {
                    $network_name = 'Dailymotion';
                    $color = '#ca3737';
                } else if (preg_match('/imgur/i', @$check['host'])) {
                    $network_name = 'Imgur';
                    $color = '#1bb76e';
                } else if (preg_match('/vimeo/i', @$check['host'])) {
                    $network_name = 'Vimeo';
                    $color = '#44bbff';
                } else if (preg_match('/500px/i', @$check['host'])) {
                    $network_name = '500px';
                    $color = '#00adee';
                }
                $this->urls->update_url_stats($un, $network_name, $color);
                redirect($original);
            } else {
                echo display_mess(47);
            }
        } else {
            echo display_mess(47);
        }
    }

    /**
     * The function get_url_stats get statistics by url
     *
     * @param $url contains the shorten url
     * 
     * @return void
     */
    public function get_url_stats($url) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $url = str_replace('-', '/', $url);
        $url = $this->security->xss_clean(base64_decode($url));
        $parse = parse_url($url);
        $parse = str_replace('/', '', $parse['path']);
        $get_id = base64_decode($parse);
        if (is_numeric($get_id)) {
            $stats = $this->urls->get_url_stats($get_id);
            if ($stats) {
                echo json_encode($stats);
            } else {
                echo json_encode(2);
            }
        } else {
            echo json_encode(2);
        }
    }

    /**
     * The function rss_settings saves a new rss settings
     *
     * @param string $type contains the settings type
     * @param integer $rss_id contains rss's id
     * @param string $value contains $value string
     * 
     * @return void
     */
    public function rss_settings( $type, $rss_id, $value ) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        
        if ( $type == 'refferal' ) {
            
            $refferal = str_replace( '-', '/', $value );
            $refferal = $this->security->xss_clean(base64_decode($refferal));
            if ($refferal) {
                if ($this->rss->enable_or_disable_rss_option($this->user_id, $rss_id, 'refferal', $refferal)) {
                    echo json_encode(1);
                }
            } else {
                if ($this->rss->enable_or_disable_rss_option($this->user_id, $rss_id, 'refferal', ' ')) {
                    echo json_encode(1);
                }            
            }
            
        } else if ( $type == 'period' ) {
  
            if ( $value ) {
                
                if ( $this->rss->enable_or_disable_rss_option($this->user_id, $rss_id, 'period', $value) ) {
                    
                    echo json_encode(1);
                    
                }
                
            } else {
                
                if ($this->rss->enable_or_disable_rss_option($this->user_id, $rss_id, 'period', ' ')) {
                    echo json_encode(1);
                }         
            }
            
        } else if ( $type == 'include' ) {
  
            $include = str_replace( '-', '/', $value );
            $include = $this->security->xss_clean(base64_decode($include));
            
            if ($include) {
                
                if ($this->rss->enable_or_disable_rss_option($this->user_id, $rss_id, 'include', $include)) {
                    echo json_encode(1);
                }
                
            } else {
                
                if ($this->rss->enable_or_disable_rss_option($this->user_id, $rss_id, 'include', ' ')) {
                    echo json_encode(1);
                }
                
            }
            
        } else if ( $type == 'exclude' ) {
  
            $exclude = str_replace( '-', '/', $value );
            $exclude = $this->security->xss_clean(base64_decode($exclude));
            
            if ($exclude) {
                
                if ($this->rss->enable_or_disable_rss_option($this->user_id, $rss_id, 'exclude', $exclude)) {
                    echo json_encode(1);
                }
                
            } else {
                
                if ($this->rss->enable_or_disable_rss_option($this->user_id, $rss_id, 'exclude', ' ')) {
                    echo json_encode(1);
                }
                
            }
            
        }
    }
    
    /**
     * The function get_rss_stats gets post's stats
     *
     * @param integer $post_id contains post's id
     * 
     * @return void
     */
    public function get_rss_stats($post_id) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        // Get RSS data by rss_id
        show_post_stats($this->rss->get_rss_post($post_id, $this->user_id));
    }
    
    /**
     * The function tool loads the tool functions
     * @param $name contains the tool's name
     * 
     * @return void
     */
    public function tool($name) {
        if ($name) {
            if (file_exists(APPPATH . 'tools' . '/' . $name . '/functions.php')) {
                include_once APPPATH . 'tools' . '/' . $name . '/functions.php';
            } else {
                echo display_mess(47);
            }
        }
    }

    /**
     * The function get_statistics gets statistics by $num
     *
     * @param $num contains the period
     * 
     * @return void
     */
    public function get_statistics($num) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $statistics = generate_user_statstics($num, $this->posts->get_last_posts($num, $this->user_id));
        if ($statistics) {
            echo json_encode($statistics);
        }
    }
    
    /**
     * The function get_img saves images
     * 
     * @return void
     */
    public function get_img() {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        if ($this->input->post()) {
            // Add form validation
            $this->form_validation->set_rules('im', 'Im', 'trim|required');
            $img = $this->input->post('im');
            $img = str_replace('-', '/', $img);
            $img = base64_decode($img);
            if ($this->form_validation->run() != false) {
                $path = FCPATH.'assets/share/';
                $name = uniqid() . '-' . time();
                $format = '.jpeg';
                $file = $path.$name.$format;
                if(file_put_contents($file,file_get_contents($img)))
                {
                    echo json_encode(base_url().'assets/share/'.$name.$format);
                }
            }
        }
    }

    /**
     * The function delete_user_account deletes current user account
     * 
     * @return void
     */
    public function delete_user_account() {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $data = '';
        $success = 0;
        // Delete all posts and posts meta
        if ($this->posts->delete_posts($this->user_id)) {
            $data = display_mess(69);
        }
        // Delete connected social accounts
        if ($this->networks->delete_network('all', $this->user_id)) {
            $data .= display_mess(70);
        }
        // Delete feeds and posts
        if ($this->rss->delete_all_rss($this->user_id)) {
            $data .= display_mess(101);
        }
        // Delete campaigns
        if ($this->campaigns->delete_campaigns($this->user_id)) {
            $data .= display_mess(124);
        }
        // Delete templates
        if ($this->campaigns->delete_templates($this->user_id)) {
            $data .= display_mess(125);
        }
        // Delete lists
        if ($this->campaigns->delete_lists($this->user_id)) {
            $data .= display_mess(126);
        }
        // Delete schedules
        if ($this->campaigns->delete_schedules($this->user_id)) {
        }
        // Load Fourth Helper
        $this->load->helper('fourth_helper');
        // Load Tickets Model
        $this->load->model('tickets');
        // Delete tickets
        $this->tickets->delete_tickets($this->user_id);
        // Load Botis Model
        $this->load->model('botis');        
        // Delete all user's bots
        $this->botis->delete_user_bots($this->user_id);
        // Load Activity Model
        $this->load->model('activity');        
        // Delete all user's activity
        $this->activity->delete_user_activity($this->user_id);
        // Delete user account
        if ($this->user->delete_user($this->user_id)) {
            // The user's account was deleted
            $success = 1;
            $data .= display_mess(71);
        } else {
            $data .= display_mess(72);
        }
        if ($data) {
            if ($success > 0) {
                // Deletes user's session
                $this->session->unset_userdata('username');
                $this->session->unset_userdata('member');
                $this->session->unset_userdata('autodelete');
            }
            $data = ($success > 0) ? '<div class="success">' . $data . '</div>' : '<div class="error">' . $data . '</div>';
            // Return information abbout account deletion
            $response = ['data' => $data, 'success' => $success];
            echo json_encode($response);
        } else {
            display_mess();
        }
    }
    
    /**
     * The function save_current_posts saves all current posts 
     *
     * @param $rss contains the rss's ID
     * 
     * @return void
     */
    public function save_current_posts($rss) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $random = $this->rss->get_rss($rss,$this->user_id);
        if (!@$random) {
            exit();
        }
        if ($this->options->check_enabled('rss_feeds') == false) {
            exit();
        }
        if (@$random [0]->rss_url) {
            $parsed = parse_rss_feed($random [0]->rss_url);
            if (@$parsed) {
                $f = 0;
                for ($n = 0; $n < count($parsed ['title']); $n ++) {
                    $description = "";
                    $title = htmlentities(trim($parsed ['title'] [$n]));
                    if ($random [0]->publish_description == 1) {
                        $description = htmlentities(@stripslashes(trim($parsed ['description'] [$n])));
                    }
                    $url = $parsed ['url'][$n];
                    if (@$random [0]->refferal) {
                        $refferal = str_replace(['&','?'],['',''],$random [0]->refferal);
                        if(preg_match('/\?/i',$uri)) {
                            $uri = $uri . '&' . $refferal;
                        } else {
                            $uri = $uri . '?' . $refferal;
                        }
                    }
                    if ($url) {
                        if (preg_match('/amazon./i', $url)) {
                            $url = explode('ref=', $url);
                            $url = $url [0];
                        }
                        if (preg_match('/news.google/i', $url)) {
                            $url = explode('&url=', $url);
                            $url = (@$url[1])?$url[1]:$url[0];
                        }
                        $url = $url;
                        if ($this->rss->was_published($random [0]->user_id, $random [0]->rss_id, $url)) {
                            $this->rss->save_published($random [0]->user_id, $random [0]->rss_id, '', htmlentities(trim($parsed ['title'] [$n])), $description, $url);
                        }
                    }
                }
            }
        }
    }

    /**
     * The function delete_feeds deletes feeds
     * 
     * @param $feed contains the feed's id
     * 
     * @return void
     */
    public function delete_feeds($feed) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $data = '';
        $success = 0;
        // Delete the RSS Feed
        $all_rss = $this->rss->delete_rss($this->user_id, $feed);
        if ($all_rss) {
            $success++;
            $data .= display_mess(90);
        } else {
            $data .= display_mess(91);
        }
        if ($data) {
            $data = ($success > 0) ? '<div class="success">' . $data . '</div>' : '<div class="error">' . $data . '</div>';
            // Return information abbout account deletion
            $response = ['data' => $data, 'success' => $success];
            echo json_encode($response);
        } else {
            display_mess();
        }
    }

    /**
     * The function unconfirmed_account displays uncofirmed page
     * 
     * @return void
     */
    public function unconfirmed_account() {
        // Check if the current user is admin and if session exists
        $this->check_session();
        if ($this->user_status == 1) {
            redirect('/user/home');
        }
        // Show unconfirmed account page
        $this->load->view('user/unconfirmed-account');
    }
    
    /**
     * The function _check_unconfirmed_account checks if the current user's account is confirmed
     * 
     * @return void
     */
    private function _check_unconfirmed_account() {
		
        if ($this->user_status == 0) {
            redirect('/user/unconfirmed-account');
        }
    }
}

/* End of file Userarea.php */
