<?php
/**
 * The_500px
 *
 * PHP Version 5.6
 *
 * Connect and Publish to 500px
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
if ( !defined('BASEPATH') ) {
    
    exit('No direct script access allowed');
    
}

// If session valiable doesn't exists will be called
if ( !isset($_SESSION) ) {
    
    session_start();
    
}

/**
 * The_500px class - allows users to connect to their 500px account and publish photos.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class The_500px implements Autopost {

    /**
     * Class variables
     */
    protected $CI, $check, $params, $redirect_uri, $consumer_key, $consumer_secret;
    
    /**
     * Load networks and user model.
     */
    public function __construct() {
        
        // Get the CodeIgniter super object
        $this->CI = & get_instance();
        
        // Verify if the library _500PXOAuth exists
        if( file_exists( FCPATH . 'vendor/oauth/_500PXOAuth.php' ) ) {
            
            // Get the 500px consumer_key
            $this->consumer_key = get_option('the_500px_consumer_key');
            
            // Get the 500px consumer_secret
            $this->consumer_secret = get_option('the_500px_consumer_secret');
            
            // Require required files
            include_once FCPATH . 'vendor/oauth/OAuth.php';
            include_once FCPATH . 'vendor/oauth/_500PXOAuth.php';
            
            // Call the _500PXOAuth class
            $this->check = new _500PXOAuth($this->consumer_key, $this->consumer_secret);
            
            // Set the 500px redirect
            $this->redirect_url = base_url() . 'user/callback/the_500px';
            
        }
        
    }
    
    /**
     * The public method check_availability check if the 500px api is configured correctly.
     *
     * @return boolean true or false
     */
    public function check_availability() {
        
        // Verify if consumer_key and consumer_secret is not empty
        if ( ($this->consumer_key != '') AND ( $this->consumer_secret != '') ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method connect will redirect user to 500px login page.
     * 
     * @return void
     */
    public function connect() {
        
        // Get redirect url
        $request = $this->check->getRequestToken($this->redirect_url);
        
        // Create the empty sessions
        $_SESSION['oauth_token'] = $temp = $request['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request['oauth_token_secret'];
        
        // Get authorize url and redirect
        $urlAuth = $this->check->getAuthorizeURL($temp);
        
        // Redirect
        header('Location: ' . $urlAuth);
        
    }
    
    /**
     * The public method save will get access token.
     *
     * @param string $token contains the token for some social networks
     * 
     * @return void
     */
    public function save($token = null) {
        
        // Try to generate an access token
        if ( $this->CI->input->get('oauth_verifier', TRUE) ) {
            
            // 500px Object with temp request token
            $this->check = new _500PXOAuth($this->consumer_key, $this->consumer_secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);

            // Getting real access token
            $access_token_array = $this->check->getAccessToken($_GET['oauth_verifier']);

            // Store real access token	
            $_SESSION['oauth_token'] = $token = $access_token_array['oauth_token'];
            $_SESSION['oauth_token_secret'] = $secret = $access_token_array['oauth_token_secret'];

            // Getting user info
            $user_info = $this->check->get('users');
            $user_info = $user_info['user'];
            
            // Verify if returned user information is correct
            if ( (@$user_info['id']) AND (@$user_info['username']) AND (@$user_info['userpic_url']) ) {
                
                // Get user_id
                $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
                
                // Verify if account was already saved
                if ($this->CI->networks->check_account_was_added('the_500px', $user_info['id'], $user_id)) {
                    
                    $this->CI->session->set_flashdata('deleted', display_mess(79, '500px'));
                    
                } else {
                    
                    $this->CI->session->set_flashdata('deleted', display_mess(80));
                    $this->CI->networks->add_network('the_500px', $user_info['id'], $token, $user_id, '', $user_info['username'], $user_info['userpic_url'], $secret);
                    
                }
                
            }
            
        }
        
    }
    
    /**
     * The public method post publishes posts on 500px.
     *
     * @param array $args contains the post data.
     * @param integer $user_id is the ID of the current user
     * 
     * @return boolean true if post was published
     */
    public function post($args, $user_id = null) {
        
        // get user data
        if ( $user_id ) {
            
            // If the $user_id variable is not null, will be published a scheduled post
            $user_details = $this->CI->networks->get_network_data(strtolower('the_500px'), $user_id, $args['account']);
            
        } else {
            
            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            $user_details = $this->CI->networks->get_network_data(strtolower('the_500px'), $user_id, $args['account']);
            
        }
        
        // Call the _500PXOAuth class
        $this->check = new _500PXOAuth($this->consumer_key, $this->consumer_secret, $user_details[0]->token, $user_details[0]->secret);
        
        // Check if the image is loaded on server
        $im = explode(base_url(), $args['img']);
        
        if ( isset($im[1]) ) {
            
            $rep = str_replace(base_url(), FCPATH, $args['img']);
            $file = $rep;
            
        } else {
            
            $curl = curl_init();
            
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_BINARYTRANSFER => 1, CURLOPT_URL => $args['img'],CURLOPT_HEADER => false));
            
            // Send the request & save response to $resp
            $in = curl_exec($curl);
            
            // Close request to clear up some resources
            curl_close($curl);
            
            if ($in) {
                
                $filename = FCPATH . 'assets/share/' . uniqid() . time() . '.png';
                
                file_put_contents($filename, $in);
                
                if ( file_exists($filename) ) {
                    
                    $file = $filename;
                    
                } else {
                    
                    return false;
                    
                }
                
            } else {
                
                return false;
                
            }
            
        }
        
        $params = [];
        
        // Verify if title is not empty
        if ( @$args['title'] ) {
            
            $params['name'] = $args['title'];
            $params['description'] = $args['post'];
            
        } else {
            
            $params['name'] = $args['post'];
            $params['description'] = '';
            
        }
        
        // Get category
        if ( @$args['category'] ) {
            
            $category = json_decode($args['category']);
            
            if ( @$category->$args['account'] ) {
                
                $params['category'] = $category->$args['account'];
                    
            }
            
        } else {
            
            $params['category'] = 0;
            
        }
        
        $params['shutter_speed'] = '1/160';
        $params['focal_length'] = '72';
        $params['aperture'] = 'f 7.1';
        $params['iso'] = '100';
        $params['camera'] = 'Canon EOS 40D';
        $params['lens'] = 'EF-S17-85mm f/4-5.6 IS USM';
        $params['privacy'] = 0;
        
        try {
            
            $_500px=$this->check->get('users');
            $_500px=$_500px['user'];
            $userName = $_500px['username'];
            $userScreenName = $_500px['fullname'];
            $_500pxUrl = "http://500px.com/" . $userName;

            // Get upload Key
            $_500px = $this->check->post('photos',$params);
            $photo500pxid = $_500px['photo']['id'];
            $upload_key = $_500px['upload_key'];

            // Upload the photo
            $_500px = $this->check->sync_upload($file, $photo500pxid, $upload_key, $this->consumer_key, $user_details[0]->token);
            return true;
            
        
        } catch (Exception $e) {

            // Save the error
            $this->CI->user_meta->update_user_meta($user_id, 'last-social-error', $e->getMessage());

            // Then return falsed
            return false;

        }
    }
    
    /**
     * The public method get_info displays information about this class.
     * 
     * @return object with network data
     */
    public function get_info() {
        
        return (object) ['color' => '#00adee', 'icon' => '<i class="fa fa-500px"></i>', 'rss' => false, 'api' => ['consumer_key', 'consumer_secret'], 'types' => 'text, links, images', 'categories' => true];
        
    }
    
    /**
     * The public method preview generates a preview for 500px
     *
     * @param $args contains the img or url.
     * 
     * @return object with html content
     */
    public function preview($args) {
        
        if (filter_var($args['img'], FILTER_VALIDATE_URL) === FALSE) {
            return (object) ['info' => '<div class="col-lg-12 merror"><p><i class="fa fa-exclamation-triangle"></i> ' . display_mess(143) . '</p></div>'];
        }
        
        $img = $args['img'];
        
        return (object) [
                    'name' => 'the_500px',
                    'icon' => '<button type="button" class="btn btn-network-p"><i class="fa fa-500px"></i><span data-network="the_500px"><i class="fa fa-times"></i></span></button>',
                    'head' => '<li class="the_500px"><a href="#the_500px" data-toggle="tab"><i class="fa fa-500px"></i></a></li>',
                    'content' => '
		<div class="tab-pane" id="the_500px">
                <div class="the_500px forall">
                  <div>
                    <p class="previmg"><img src="' . $img . '"></p>
                    <p class="prevtext"></p>
                  </div>
                </div>
              </div>'];
        
    }
}