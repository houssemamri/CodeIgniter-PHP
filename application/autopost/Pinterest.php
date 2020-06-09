<?php
/**
 * Pinterest
 *
 * PHP Version 5.6
 *
 * Connect and Publish to Pinterest
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
if ( !defined( 'BASEPATH' ) ) {
    exit('No direct script access allowed');
}

// If session valiable doesn't exists will be called
if ( !isset( $_SESSION) ) {
    
    session_start();
    
}

/**
 * Pinterest class - allows users to connect to their Pinterest Account and publish posts.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Pinterest implements Autopost {

    /**
     * Class variables
     */
    protected $app_id, $app_secret, $pinterest, $loginurl;
    
    /**
     * Load networks and user model.
     */
    public function __construct() {
        
        // Get the CodeIgniter super object
        $this->CI = & get_instance();
        
        // Require the Pinterest Library
        require_once FCPATH . 'vendor/autoload.php';
        
        // Verify if is enabled the option for App Id and App Secret
        if ( !get_option('pinterest_user_api_key') ) {
            
            // Get Pinterest app_id
            $this->app_id = get_option('pinterest_app_id');
            
            // Get Pinterest app_secret
            $this->app_secret = get_option('pinterest_app_secret');
            
            // Call the Pinterest class
            $this->pinterest = new \DirkGroenen\Pinterest\Pinterest($this->app_id, $this->app_secret);
            
        }
        
    }
    
    /**
     * The public method check_availability checks if the Pinterest api is configured correctly.
     *
     * @return boolean true or empty
     */
    public function check_availability() {
        
        // Verify if is enabled the option for App Id and App Secret
        if ( get_option( 'pinterest_user_api_key' ) ) {
            
            return true;
            
        } else {
            
            if ( ( $this->app_id == '' ) AND ( $this->app_secret == '' ) ) {
                
                return false;
                
            } else {
                
                return true;
                
            }
        
        }
        
    }
    
    /**
     * The public method connect will redirect user to Pinterest login page.
     * 
     * @return void
     */
    public function connect() {
        
        // Verify if is enabled the option for App Id and App Secret
        if (get_option('pinterest_user_api_key')) {
            
            // Check if data was submitted
            if ($this->CI->input->post()) {
                
                // Add form validation
                $this->CI->form_validation->set_rules('app_id', 'App ID', 'trim|required');
                $this->CI->form_validation->set_rules('app_secret', 'App Secret', 'trim|required');
                
                // Get post data
                $app_id = $this->CI->input->post('app_id');
                $app_secret = $this->CI->input->post('app_secret');
                
                // Verify if form data is valid
                if ($this->CI->form_validation->run() == false) {
                    
                    display_mess(45);
                    
                } else {
                    
                    $_SESSION['app_id'] = $app_id;
                    $_SESSION['app_secret'] = $app_secret;
                    
                }
                
            }
            
            if ( !isset($_SESSION['app_id']) ) {
                
                echo get_instance()->ecl('Social_login')->content('App ID', 'App Secret', 'Connect', $this->get_info(), 'pinterest', $this->CI->lang->line('mu324'));

            } else {
                
                // Call the Pinterest class
                $this->pinterest = new \DirkGroenen\Pinterest\Pinterest($_SESSION['app_id'], $_SESSION['app_secret']);
                $this->loginurl = $this->pinterest->auth->getLoginUrl(str_replace(['http://', 'http://www.'], ['https://', 'https://www.'], base_url()) . 'user/callback/pinterest', array('read_public,write_public'));
                header('Location:' . $this->loginurl); 
                
            }
            
        } else {
            
            // Get redirect url
            $this->loginurl = $this->pinterest->auth->getLoginUrl(str_replace(['http://', 'http://www.'], ['https://', 'https://www.'], base_url()) . 'user/callback/pinterest', array('read_public,write_public'));
            
            // Redirect
            header('Location:' . $this->loginurl);            
            
        }
        
    }
    
    /**
     * The public method save will get access token.
     *
     * @param string $token contains the token for some social networks
     */
    public function save($token = NULL) {
        
        // Verify if code exists
        if ( $this->CI->input->get('code', TRUE) ) {
            
            // Verify if is enabled the option for App Id and App Secret
            if ( get_option('pinterest_user_api_key') ) {
                
                // Verify if session app_id exists
                if ( isset($_SESSION['app_id']) ) {
                    
                    // Call the Pinterest class
                    $this->pinterest = new \DirkGroenen\Pinterest\Pinterest($_SESSION['app_id'], $_SESSION['app_secret']);
                    
                } else {
                    
                    return true;
                    
                }
                
            }
            
            // Get Pinterest access token
            $token = $this->pinterest->auth->getOAuthToken( $this->CI->input->get('code', TRUE) );
            
            // Set access token
            $this->pinterest->auth->setOAuthToken($token->access_token);
            
            // Get user data
            $me = $this->pinterest->users->me();
            
            // Get my boards
            $boards = $this->pinterest->users->getMeBoards();
            
            // Get access token
            if ( $token->access_token ) {
                
                // Get user+id
                $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
                
                // Get user's image
                $image = (@$me->image == '') ? ' ' : @$me->image;
                
                // Get boards and save
                $y = 0;
                foreach ($boards as $boardu) {
                    
                    $board = str_replace('https://www.pinterest.com/', '', @$boardu->url);
                    
                    if (substr($board, -1, strlen($board))) {
                        $board = substr($board, 0, -1);
                    }
                    
                    if (!$this->CI->networks->get_network_data('pinterest', $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']), $board)) {
                        
                        if ( !isset($_SESSION['app_id']) ) {
                            
                            $this->CI->networks->add_network('pinterest', @$board, $token->access_token, $user_id, '', $boardu->name, $image);
                            
                             // Call the Pinterest class
                            $this->pinterest = new \DirkGroenen\Pinterest\Pinterest($this->app_id, $this->app_secret);
                            
                        } else {
                            
                            $this->CI->networks->add_network('pinterest', @$board, $token->access_token, $user_id, '', $boardu->name, $image, '', $_SESSION['app_id'], $_SESSION['app_secret']);
                            unset($_SESSION['app_id']);
                            unset($_SESSION['app_secret']);
                            
                        }
                        
                    }
                    $y++;
                }
                $this->CI->session->set_flashdata('deleted', display_mess(85));
            }
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method post publishes posts on Pinterest.
     *
     * @param array $args contains the post data.
     * @param integer $user_id is the ID of the current user
     * 
     * @return boolean true if post was published
     */
    public function post($args, $user_id = NULL) {
        
        // Verify if post or image is empty
        if ( ($args['post'] == '') || ($args['img'] == '') ) {
            
            return false;
            
        }
        
        // Get user details
        if ($user_id) {
            
            // if the $user_id variable is not null, will be published a scheduled post
            $user_details = $this->CI->networks->get_network_data(strtolower('pinterest'), $user_id, $args['account']);
            
        } else {
            
            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            $user_details = $this->CI->networks->get_network_data(strtolower('pinterest'), $user_id, $args['account']);
            
        }
        
        // Get user details
        if ($user_details) {
            
            // Verify if is enabled the option for App Id and App Secret
            if ( get_option('pinterest_user_api_key') ) {
                
                    // Call the Pinterest class
                    $this->pinterest = new \DirkGroenen\Pinterest\Pinterest( $user_details[0]->api_key, $user_details[0]->api_secret );
                
            }
            
            try {
                
                // Set access token
                $this->pinterest->auth->setOAuthToken($user_details[0]->token);
                
                // Create the post content
                $data = [
                    'note' => mb_substr($args['post'], 0, 499),
                    'image_url' => $args['img'],
                    'board' => $user_details[0]->net_id
                ];
                
                // Verify if url exists
                if($args['url']) {
                    $data['link'] = $args['url'];
                }
                
                // Publish the post
                $pub = $this->pinterest->pins->create($data);
                
                if ( $pub ) {
                    
                    return true;
                    
                } else {
                    
                    return false;
                    
                }
                
                
            } catch (Exception $e) {

                // Save the error
                $this->CI->user_meta->update_user_meta($user_id, 'last-social-error', $e->getMessage());

                // Then return falsed
                return false;

            }
            
        }
        
    }
    
    /**
     * The public method get_info displays information about this class.
     * 
     * @return object with network's data
     */
    public function get_info() {
        
        return (object) ['color' => '#be000f', 'icon' => '<i class="fa fa-pinterest"></i>', 'rss' => true, 'api' => ['app_id', 'app_secret'], 'types' => 'text, links, images', 'categories' => false];
        
    }
    
    /**
     * The public method preview generates a preview for Pinterest.
     *
     * @param $args contains the img or url.
     * 
     * @return object object with html content
     */
    public function preview($args) {
        
        if (filter_var($args['img'], FILTER_VALIDATE_URL) === FALSE) {
            
            return (object) ['info' => '<div class="col-lg-12 merror"><p><i class="fa fa-exclamation-triangle"></i> ' . display_mess(143) . '</p></div>'];
            
        }
        
        // Get image
        $img = $args['img'];
        
        return (object) [
                    'name' => 'pinterest',
                    'icon' => '<button type="button" class="btn btn-network-p"><i class="fa fa-pinterest"></i><span data-network="pinterest"><i class="fa fa-times"></i></span></button>',
                    'head' => '<li class="pinterest"><a href="#pinterest" data-toggle="tab"><i class="fa fa-pinterest"></i></a></li>',
                    'content' => '
		<div class="tab-pane" id="pinterest">
                <div class="pinterest forall">
                  <div>
                    <p class="previmg"><img src="' . $img . '"></p>
                    <p class="prevtext"></p>
                  </div>
                </div>
              </div>'];
    }
    
}
