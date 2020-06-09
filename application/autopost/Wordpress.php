<?php
/**
 * Wordpress
 *
 * PHP Version 5.6
 *
 * Connect and Publish to Wordpress
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
 * Wordpress class - allows users to connect to their Wordpress and publish posts.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Wordpress implements Autopost {

    /**
     * Class variables
     */
    protected $CI, $params, $redirect_uri, $client_id, $client_secret;
    
    /**
     * Load networks and user model.
     */
    public function __construct() {
        
        // Get the CodeIgniter super object
        $this->CI = & get_instance();
        
        // Get Wordpress client_id
        $this->client_id = get_option('wordpress_client_id');
        
        // Get Wordpress client_secret
        $this->client_secret = get_option('wordpress_client_secret');
        
        // Get Wordpress redirect
        $this->redirect_uri = get_instance()->config->base_url() . 'user/callback/wordpress';
        
        // Set params
        $this->params = array(
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri' => $this->redirect_uri,
            'response_type' => 'code'
        );
        
    }
    
    /**
     * The public method check_availability checks if the Wordpress api is configured correctly.
     *
     * @return boolean true or false
     */
    public function check_availability() {
        
        // Verify if client_id and client_secret exists
        if ( ($this->client_id != '') AND ( $this->client_secret != '') ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method connect will redirect user to Wordpress login page.
     * 
     * @return void
     */
    public function connect() {
        
        // Verify if params are correct
        if ( $this->params ) {
            
            // Generate redirect url
            $loginUrl = 'https://public-api.wordpress.com/oauth2/authorize?' . urldecode(http_build_query($this->params));
            
            // Redirect
            header('Location:' . $loginUrl);
            
        }
        
    }
    
    /**
     * The public method save will get access token.
     *
     * @param string $token contains the token for some social networks
     * 
     * @return void
     */
    public function save($token = null) {
        
        // Verify if code exists
        if ( $this->CI->input->get('code', TRUE) ) {
            
            // Get access token
            $curl = curl_init('https://public-api.wordpress.com/oauth2/token');
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt(
                $curl, CURLOPT_POSTFIELDS, [
                'client_id' => $this->client_id,
                'client_secret' => $this->client_secret,
                'code' => $this->CI->input->get('code', TRUE),
                'redirect_uri' => $this->redirect_uri,
                'grant_type' => 'authorization_code'
                ]
            );
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $auth = curl_exec($curl);
            curl_close($curl);
            
            // Decode response
            $secret = json_decode($auth);
            
            // Verify if token was get
            if ( @$secret->access_token ) {
                
                // Set access token
                $token = $secret->access_token;
                
                // Get user_id
                $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
                
                // Set blog_id
                $blog_id = $secret->blog_id;
                
                // Set blog url
                $blog_url = $secret->blog_url;
                
                // Get user's information
                $curl = curl_init('https://public-api.wordpress.com/rest/v1/me/');
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $me = json_decode(curl_exec($curl));
                curl_close($curl);
                
                // Set display name if exists
                $name = @$me->display_name;
                
                // Set avatar if exists
                $avatar = @$me->avatar_URL;
                
                // Verify if token and blog exists
                if ( ($token != '') AND ( $blog_id != '') ) {
                    
                    // Get url
                    $blog_url = str_replace(['http://', 'https://'], ['', ''], $blog_url);
                    
                    // Verify if account was added
                    if ( $this->CI->networks->check_account_was_added('wordpress', $blog_id, $user_id) ) {
                        
                        $this->CI->session->set_flashdata('deleted', display_mess(79, 'Wordpress'));
                        
                    } else {
                        
                        $this->CI->session->set_flashdata('deleted', display_mess(80));
                        $this->CI->networks->add_network('wordpress', $blog_id, $token, $user_id, '', $blog_url, $avatar);
                        
                    }
                    
                }
                
            }
            
        }
        
    }
    
    /**
     * The public method post publishes posts on Wordpress.
     *
     * @param array $args contains the post data.
     * @param integer $user_id is the ID of the current user
     * 
     * @return boolean true if post was published
     */
    public function post($args, $user_id = null) {
        
        // Get user details
        if ($user_id) {
            
            // if the $user_id variable is not null, will be published a scheduled post
            $user_details = $this->CI->networks->get_network_data(strtolower('wordpress'), $user_id, $args['account']);
            
        } else {
            
            // Get the user ID
            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            $user_details = $this->CI->networks->get_network_data(strtolower('wordpress'), $user_id, $args['account']);
            
        }
        
        $data = [];
        
        // Verify if title is not empty
        if ( $args ['title'] ) {
            
            $data['title'] = $args ['title'];
            $data['content'] = $args['post'];
            
        } else {
            
            $data['content'] = $args['post'];
            
        }
        
        // Verify if image exists
        if ( $args ['img'] ) {
            
            $data['media_urls[]'] = $args['img'];
            
        }
        
        // Check if category exists
        if ( $args['category'] ) {
            
            $category = json_decode($args['category']);
            
            if ( $category->$args['account'] ) {
                
                $data['categories'] = $category->$args['account'];
                
            }
            
        }
        
        $curl = curl_init('https://public-api.wordpress.com/rest/v1/sites/' . $user_details[0]->net_id . '/posts/new/');
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)');
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded','authorization: Bearer '.$user_details[0]->token));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $resp = curl_exec($curl);
        curl_close($curl);
        
        // Decode response
        $response = json_decode($resp);
        
        // Verify if post was published
        if ( @$response->ID ) {
            
            return true;
            
        } else {

            // Save the error
            $this->CI->user_meta->update_user_meta($user_id, 'last-social-error', json_encode($response) );

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
        
        return (object) ['color' => '#0090bb', 'icon' => '<i class="fa fa-wordpress"></i>', 'rss' => true, 'api' => ['client_id', 'client_secret'], 'types' => 'text, links, images', 'categories' => true];
        
    }
    
    /**
     * The public method preview generates a preview for Wordpress.
     *
     * @param array $args contains the img or url.
     * 
     * @return object with html data
     */
    public function preview($url = null) {
        
        return (object) [
                    'name' => 'wordpress',
                    'icon' => '<button type="button" class="btn btn-network-w"><i class="fa fa-wordpress" aria-hidden="true"></i><span data-network="wordpress"><i class="fa fa-times"></i></span></button>',
                    'head' => '<li class="wordpress"><a href="#wordpress" data-toggle="tab"><i class="fa fa-wordpress" aria-hidden="true"></i></a></li>',
                    'content' => '<div class="tab-pane" id="wordpress">
					                  <div class="wordpress forall"><div>
					                  <p class="prevtext blogpost"></p>
							      </div>'];
    }
}
