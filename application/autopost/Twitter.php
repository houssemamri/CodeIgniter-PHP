<?php
/**
 * Twitter
 *
 * PHP Version 5.6
 *
 * Connect and Publish to Twitter
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
 * Twitter class - allows users to connect to their Twitter Account and publish posts.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
use Abraham\TwitterOAuth\TwitterOAuth;

class Twitter implements Autopost {

    /**
     * Class variables
     */
    public $CI, $connection, $twitter_key, $twitter_secret;

    /**
     * Load networks and user model.
     */
    public function __construct() {
        
        // Get the CodeIgniter super object
        $this->CI = & get_instance();
        
        // Get the Twitter app_id
        $this->twitter_key = get_option('twitter_app_id');
        
        // Get the Twitter app_secret
        $this->twitter_secret = get_option('twitter_app_secret');
        
        // Require the vendor autoload
        include_once FCPATH . 'vendor/autoload.php';
        
        // Call the TwitterOAuth
        $this->connection = new TwitterOAuth($this->twitter_key, $this->twitter_secret);
        
    }

    /**
     * The public method check_availability checks if the Twitter api is configured correctly.
     *
     * @return boolean true or false
     */
    public function check_availability() {
        
        // Verify if the twitter_key and twitter_secret is not empty
        if ( ($this->twitter_key != '') AND ( $this->twitter_secret != '') ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method connect will redirect user to Twitter login page.
     * 
     * @return void
     */
    public function connect() {
      
        // Request the token
        $request_token = $this->connection->oauth('oauth/request_token', array('oauth_callback' => base_url() . 'user/callback/twitter'));
       
        // Create empty session variables
        $_SESSION['oauth_token'] = $request_token['oauth_token'];
        $_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
        // Generate the redirect url
        $url = $this->connection->url('oauth/authorize', array('oauth_token' => $request_token['oauth_token']));
        
        // Redirect
        header('Location: ' . $url);
        
    }

    /**
     * The public method save will get access token.
     *
     * @param string $token contains the token for some social networks
     * 
     * @return void
     */
    public function save($token = null) {
        
        // Verify if oauth_verifier exists
        if ( $this->CI->input->get('oauth_verifier', TRUE) ) {
			
            // Call the TwitterOAuth class
            $twitterOauth = new TwitterOAuth($this->twitter_key, $this->twitter_secret, $_SESSION['oauth_token'], $_SESSION['oauth_token_secret']);
            
            // Get access token
            $twToken = $twitterOauth->oauth('oauth/access_token', array('oauth_verifier' => $this->CI->input->get('oauth_verifier', TRUE)));
            $newTwitterOauth = new TwitterOAuth($this->twitter_key, $this->twitter_secret, $twToken['oauth_token'], $twToken['oauth_token_secret']);
            $response = (array) $newTwitterOauth->get('account/verify_credentials');
            
            // Verify if access token exists
            if ( @$twToken['oauth_token'] ) {
                
                // Get user_id
                $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
                
                // Verify if account was already saved 
                if ( $this->CI->networks->check_account_was_added('twitter', $response['id'], $user_id) ) {
                    
                    $this->CI->session->set_flashdata('deleted', display_mess(79, 'twitter'));
                    
                } else {

                    $this->CI->session->set_flashdata('deleted', display_mess(80));
                    $this->CI->networks->add_network('twitter', @$response['id'], $twToken['oauth_token'], $user_id, '', @$response['screen_name'], @$response['profile_image_url'], $twToken['oauth_token_secret']);
                    
                }
                
            }
            
        }
        
    }

    /**
     * The public method post publishes posts on Twitter.
     *
     * @param $args contains the post data.
     * @param $user_id is the ID of the current user
     * 
     * @return boolean true if post was published
     */
    public function post($args, $user_id = NULL) {
        
        // Get user details
        if ($user_id) {
            
            // if the $user_id variable is not null, will be published a scheduled post
            $user_details = $this->CI->networks->get_network_data(strtolower('twitter'), $user_id, $args['account']);
            
        } else {
            
            // Get the user ID
            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            $user_details = $this->CI->networks->get_network_data(strtolower('twitter'), $user_id, $args['account']);
            
        }
        
        try {
            
            // Call the TwitterOAuth class with valid access token
            $connection = new TwitterOAuth($this->twitter_key, $this->twitter_secret, $user_details[0]->token, $user_details[0]->secret);
            
            // Create the tweet
            $post = $args['post'];
            
            // Verify if title exists
            if ( $args['title'] ) {
                
                $post = $args['title'] . ' ' . $post;
                
            }
            
            // Verify if image exists
            if ( $args['img'] ) {
                
                // Upload the image
                $media = $connection->upload('media/upload', array('media' => $args['img']));
                $check = $connection->post('statuses/update', ['status' => mb_substr(rawurldecode($post), 0, 279), 'media_ids' => $media->media_id_string]);
                sleep(1);
                
            } elseif ($args['video']) {
                
                // Upload the video
                $media = $connection->upload('media/upload', array('media' => str_replace(base_url(), FCPATH, $args['video']), 'media_type' => 'video/mp4'), true);
                $check = $connection->post('statuses/update', ['status' => mb_substr(rawurldecode($post), 0, 279), 'media_ids' => $media->media_id_string]);
                sleep(1);
                
            } else {
                
                // Calculate the tweet length
                $length = 279;
                $url = '';
                
                // Verify if url is empty
                if ( $args['url'] ) {
                    
                    $length = 277 - strlen($args['url']);
                    $url = ' ' . $args['url'];
                    
                }
                
                // Publish the tweet
                $check = $connection->post('statuses/update', ['status' => mb_substr(rawurldecode($post), 0, $length) . $url]);
                
            }
            
            // Verify if the post was published successfully
            if ( @$check->errors ) {

                // Save the error
                $this->CI->user_meta->update_user_meta($user_id, 'last-social-error', json_encode($check->errors) );

                // Then return falsed
                return false;

            } else {
                
                if( @$check->id && @$args['id'] ) {
                    sami($check->id,$args['id'],$args['account'],'twitter',$user_id);
                }
                
                return true;
                
            }
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
     * @return object with network's data
     */
    public function get_info() {
        
        return (object) ['color' => '#55acee', 'icon' => '<i class="fa fa-twitter"></i>', 'rss' => true, 'api' => ['app_id', 'app_secret'], 'types' => 'text, links, images, videos', 'categories' => false];
        
    }

    /**
     * The public preview generates a preview for Twitter.
     *
     * @param $args contains the img or url.
     * 
     * @return object with html content
     */
    public function preview($args) {
        
        $url = '<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 clean"> <img src="//abs.twimg.com/sticky/default_profile_images/default_profile_normal.png"></div>
                <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
                    <h3>Twitter ID</h3>
                        <p class="prevtext"></p>
                </div>';
        
        // If $args['img'] exists will be displayed in the preview
        if ( filter_var($args['img'], FILTER_VALIDATE_URL) ) {
            
            $url = '<div>
                        <p class="previmg"><img src="' . $args['img'] . '"></p>
                        <p class="prevtext 140"></p>
                    </div>';
            
        } elseif (filter_var($args['url'], FILTER_VALIDATE_URL)) {
            
            $url = '<div class="col-lg-2 col-sm-3 col-xs-12"> <img src="(img)"> </div>
                    <div class="col-lg-10 col-sm-9 col-xs-12">
                            <h3>(title)</h3>
                            <p>(description)</p>
                            <p>(domain)</p>
                    </div>';
            
        } elseif ( filter_var($args['video'], FILTER_VALIDATE_URL) ) {
            
            $url = '<div>
                        <p class="previmg"><video controls="true" style="width:100%;height:300px"><source src="' . $args['video'] . '" type="video/mp4" /></video></p>
                        <p class="prevtext"></p>
                    </div>';
            
        }
        return (object) [
                    'name' => 'twitter',
                    'icon' => '<button type="button" class="btn btn-network-t"><i class="fa fa-twitter" aria-hidden="true"></i><span data-network="twitter"><i class="fa fa-times"></i></span></button>',
                    'head' => '<li class="twitter"><a href="#twitter" data-toggle="tab"><i class="fa fa-twitter"></i></a></li>',
                    'content' => '<div class="tab-pane" id="twitter">
				      <div class="twitter forall">
                                          ' . $url . '
                                      </div>
                                  </div>'];
    }

}