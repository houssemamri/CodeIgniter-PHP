<?php
/**
 * Flickr
 *
 * PHP Version 5.6
 *
 * Connect and Publish to Flickr
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
 * Flickr class - allows users to connect to their Flickr Account and publish posts.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Flickr implements Autopost {

    /**
     * Class variables
     */
    protected $app_key, $app_secret, $flickr;
    
    /**
     * Load networks and user model.
     */
    public function __construct() {
        
        // Get the CodeIgniter super object
        $this->CI = & get_instance();
        
        // Get Flickr app key
        $this->app_key = get_option('flickr_app_key');
        
        // Get Flickr app key
        $this->app_secret = get_option('flickr_app_secret');
        
        // Verify if the class Felper exists
        if(file_exists(FCPATH.'vendor/felper/Felper.php')){
            
            // Require the class Felper
            include_once FCPATH . 'vendor/felper/Felper.php';
            
            // Call the class Felper
            $this->flickr = new Felper($this->app_key, $this->app_secret, base_url() . 'user/callback/flickr');
        }
        
    }
    /**
     * The public method check_availability checks if the Flickr api is configured correctly.
     *
     * @return boolean true or false
     */
    public function check_availability() {
        
        // Verify if app_key and app_secret exists
        if ( ($this->app_key != '') AND ( $this->app_secret != '') ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    /**
     * The public method connect will redirect user to Flickr login page.
     * 
     * @return void
     */
    public function connect() {
        
        // Generate redirect url
        $this->flickr->authenticate('write');
        
    }
    /**
     * The public method save will get access token.
     *
     * @param string $token contains the token for some social networks
     * 
     * @return boolean true or false
     */
    public function save($token = null) {
        
        // Get response
        $res = $this->flickr->authenticate('write');
        
        // Get user_id
        $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
        
        // Verify if the response is correct
        if ( @$res[0] && @$res[1] && @$res[2] ) {
            
            // Set the username
            $username = $res[2];
            
            // Set the token
            $token = $res[0];
            
            // Set the secret
            $secret = $res[1];
            
            // Verify if the account already exists
            if ( $this->CI->networks->check_account_was_added('flickr', $username, $user_id) ) {
                
                $this->CI->session->set_flashdata('deleted', display_mess(79, 'Flickr'));
                return true;
               
            } else {
                
                $this->CI->session->set_flashdata('deleted', display_mess(80));
                $this->CI->networks->add_network('Flickr', $username, $token, $user_id, '', $username, '', $secret);
                return true;
            }
        } else {
            return false;
        }
    }
    
    /**
     * The public method post publishes posts on Flickr.
     *
     * @param  $args contains the post data.
     * @param  $user_id is the ID of the current user
     * 
     * @return boolean true if post was published
     */
    public function post($args, $user_id = null) {
        
        // Get user details
        if ( $user_id ) {
            
            // if the $user_id variable is not null, will be published a postponed post
            $user_details = $this->CI->networks->get_network_data(strtolower('flickr'), $user_id, $args['account']);
            
        } else {
            
            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            $user_details = $this->CI->networks->get_network_data(strtolower('flickr'), $user_id, $args['account']);
            
        }
        
        $headers = array('Content-Type:multipart/form-data');
        
        // check if the image is loaded on server
        $im = explode(base_url(), $args['img']);
        
        if ( isset($im[1]) ) {
            
            $rep = str_replace(base_url(), FCPATH, $args['img']);
            $file = new \CurlFile($rep);
            
        } else {
            
            $curl = curl_init();
            
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_BINARYTRANSFER => 1, CURLOPT_URL => $args['img'],CURLOPT_HEADER => false));
            
            // Send the request & save response to $resp
            $in = curl_exec($curl);
            
            // Close request to clear up some resources
            curl_close($curl);
            
            if ( $in ) {
                
                $filename = FCPATH . 'assets/share/' . uniqid() . time() . '.png';
                
                file_put_contents($filename, $in);
                
                if ( file_exists($filename) ) {
                    
                    $file = new \CurlFile($filename);
                    
                } else {
                    
                    return false;
                    
                }
                
            } else {
                
                return false;
                
            }
            
        }
        
        // Verify if the title exists
        if ( $args['title'] ) {
            
            $data['title'] = $args ['title'];
            $data['description'] = $args['post'];
            
        } else {
            
            $data['title'] = $args['post'];
            
        }
        
        $data['api_key'] = $this->app_key;
        
        ksort($data);
        
        $auth_sig = '';
        
        foreach ( $data as $key => $value ) {
            
            if ( is_null($value) ) {
                
                unset($data[$key]);
                
            } else {
                
                $auth_sig .= $key . $value;
                
            }
        }
        
        $data['photo'] = $file;
        
        try {
            
            // Upload the photo
            $result = $this->flickr->upload($data, $user_details[0]->token, $user_details[0]->secret);
            
            // Verify if the photo was uploaded
            if ( preg_match('/photoid/i', $result) ) {
                
                return true;
                
            } else {

                // Save the error
                $this->CI->user_meta->update_user_meta($user_id, 'last-social-error', json_encode($result));

                // Then return false
                return false;

            }
            
        } catch (Exception $e) {

            // Save the error
            $this->CI->user_meta->update_user_meta($user_id, 'last-social-error', $e->getMessage());

            // Then return false
            return false;
            
        }
        
    }
    
    /**
     * The public method get_info displays information about this class.
     * 
     * @return object with social network information
     */
    public function get_info() {
        
        return (object) ['color' => '#ff007f', 'icon' => '<i class="fa fa-flickr" aria-hidden="true"></i>', 'rss' => true, 'api' => ['app_key', 'app_secret'], 'types' =>  'text, links, images', 'categories' => false];
        
    }
    
    /**
     * The public method preview generates a preview for Flickr.
     *
     * @param array $args contains the img or url.
     * 
     * @return object with html code
     */
    public function preview($args) {
        
        if (filter_var($args['img'], FILTER_VALIDATE_URL) === FALSE) {
            return (object) ['info' => '<div class="col-lg-12 merror"><p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please, enter a valid image\'s url in the field above.</p></div>'];
        }
        
        return (object) [
                    'name' => 'flickr',
                    'icon' => '<button type="button" class="btn btn-network-fl"><i class="fa fa-flickr" aria-hidden="true"></i><span data-network="flickr"><i class="fa fa-times"></i></span></button>',
                    'head' => '<li class="flickr"><a href="#flickr" data-toggle="tab"><i class="fa fa-flickr" aria-hidden="true"></i></a></li>',
                    'content' => '<div class="tab-pane" id="flickr">
					<div class="flickr forall">
                                           <div>
                        <p class="previmg"><img src="' . $args['img'] . '"></p>
                        <p class="prevtext blogpost"></p>
                    </div>
                                        </div>
                                  </div>'];
    }
    
}