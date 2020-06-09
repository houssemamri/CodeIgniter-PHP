<?php
/**
 * Facebook
 *
 * PHP Version 5.6
 *
 * Connect and Publish to Facebook
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

// If session valiable doesn't exists will be created
if (!isset($_SESSION)) {
    session_start();
}

/**
 * Facebook class - allow to publish posts on Facebook.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Facebook implements Autopost {

    /**
     * Class variables
     */
    public $fb, $app_id, $app_secret;

    /**
     * Load networks and user model.
     */
    public function __construct() {
        
        // Get the CodeIgniter super object
        $this->CI = & get_instance();
        
        // Get the Facebook App ID
        $this->app_id = get_option('facebook_app_id');
        
        // Get the Facebook App Secret
        $this->app_secret = get_option('facebook_app_secret');
        
        // Verify if user can use his App ID and App secret
        if ( !get_option('facebook_user_api_key') ) {
            
            // Verify if the Facebook SDK exists
            if ( file_exists(FCPATH . 'vendor/facebook/php-sdk-v4/src/Facebook/autoload.php') ) {
                
                try {
                    
                    // Require the Facebook Library
                    include FCPATH . 'vendor/facebook/php-sdk-v4/src/Facebook/autoload.php';
                    
                    // Load the Facebook Class
                    $this->fb = new Facebook\Facebook(
                        [
                            'app_id' => $this->app_id,
                            'app_secret' => $this->app_secret,
                            'default_graph_version' => 'v2.5',
                            'default_access_token' => '{access-token}',
                        ]
                    );
                    
                } catch ( Facebook\Exceptions\FacebookResponseException $e ) {
                    
                    // When Graph returns an error
                    get_instance()->session->set_flashdata('error', 'Graph returned an error: ' . $e->getMessage());
                    
                } catch ( Facebook\Exceptions\FacebookSDKException $e ) {
                    
                    // When validation fails or other local issues
                    get_instance()->session->set_flashdata('error', 'Facebook SDK returned an error: ' . $e->getMessage());
                    
                }
            }
        }
        
        // Verify if will be refreshed the token
        if ( $this->CI->input->get('account', TRUE) ) {
            
            // Verify if account is valid
            if ( is_numeric( $this->CI->input->get('account', TRUE) ) ) {
                
                // Create a session with the account ID
                $_SESSION['account'] = $this->CI->input->get('account', TRUE);
                
            }
            
        }
    }

    /**
     * The public method check_availability checks if the Facebook api is configured correctly.
     *
     * @return boolean true or false
     */
    public function check_availability() {
        
        // Verify if app_id and app_secret exists
        if ( ($this->app_id != '') AND ( $this->app_secret != '') ) {
            
            return true;
            
        } else {
            
            // If user can use app_id and app_secret the return will be always true
            if ( !get_option('facebook_user_api_key') ) {
                
                return false;
                
            } else {
                
                return true;
                
            }
            
        }
        
    }

    /**
     * The public method connect will redirect user to facebook login page.
     * 
     * @return void
     */
    public function connect() {
        
        // Verify if user can use his App ID and App secret
        if ( get_option('facebook_user_api_key') ) {

            // Check if data was submitted
            if ( $this->CI->input->post() ) {
                
                // Add form validation
                $this->CI->form_validation->set_rules('app_id', 'App ID', 'trim|required');
                $this->CI->form_validation->set_rules('app_secret', 'App Secret', 'trim|required');
                
                // Get post data
                $app_id = $this->CI->input->post('app_id');
                $app_secret = $this->CI->input->post('app_secret');
                
                // Verify if post data is correct
                if ( $this->CI->form_validation->run() == false ) {
                    
                    // Return error message
                    display_mess(45);
                    
                } else {
                    
                    // Create sessions with app_id and app_secret
                    $_SESSION['app_id'] = $app_id;
                    $_SESSION['app_secret'] = $app_secret;
                    
                }
                
            }

            // Verify if the session app_id exists
            if ( !isset($_SESSION['app_id']) ) {

                // If doesn't exists will be displayed the form
                echo get_instance()->ecl('Social_login')->content('App ID', 'App Secret', 'Connect', $this->get_info(), 'facebook', $this->CI->lang->line('mu208'));
                exit();
                
            } else {
                
                // Verify if the Facebook SDK exists
                if ( file_exists(FCPATH . 'vendor/facebook/php-sdk-v4/src/Facebook/autoload.php') ) {
                    
                    try {
                        
                        // Require the Facebook Library
                        include FCPATH . 'vendor/facebook/php-sdk-v4/src/Facebook/autoload.php';
                        
                        // Load the Facebook Class
                        $this->fb = new Facebook\Facebook(['app_id' => $_SESSION['app_id'], 'app_secret' => $_SESSION['app_secret'], 'default_graph_version' => 'v2.5', 'default_access_token' => '{access-token}']);
                        
                    } catch ( Facebook\Exceptions\FacebookResponseException $e ) {
                        
                        // When Graph returns an error
                        get_instance()->session->set_flashdata('error', 'Graph returned an error: ' . $e->getMessage());
                        
                    } catch ( Facebook\Exceptions\FacebookSDKException $e ) {
                        
                        // When validation fails or other local issues
                        get_instance()->session->set_flashdata('error', 'Facebook SDK returned an error: ' . $e->getMessage());
                        
                    }
                    
                }
                
            }
            
        }
            
        // Redirect use to the login page
        $helper = $this->fb->getRedirectLoginHelper();

        // Permissions to request
        $permissions = ['email', 'user_about_me', 'publish_actions'];

        // Get redirect url
        $loginUrl = $helper->getLoginUrl(get_instance()->config->base_url() . 'user/callback/facebook', $permissions);

        // Redirect
        header('Location:' . $loginUrl);
    }

    /**
     * The public method save will get access token.
     *
     * @param string $token contains the token for some social networks
     * 
     * @return boolean true or false
     */
    public function save($token = null) {
        
        // Verify if user can use his App ID and App secret
        if (get_option('facebook_user_api_key')) {
            
            // Verify id session app_id exists
            if (!isset($_SESSION['app_id'])) {
                
                // Return false but will not save account
                return false;
                
            } else {
                
                // Verify if the Facebook SDK exists
                if (file_exists(FCPATH . 'vendor/facebook/php-sdk-v4/src/Facebook/autoload.php')) {
                    
                    try {
                        
                        // Require the Facebook Library
                        include FCPATH . 'vendor/facebook/php-sdk-v4/src/Facebook/autoload.php';
                        
                        // Call the Facebook Class
                        $this->fb = new Facebook\Facebook(['app_id' => $_SESSION['app_id'], 'app_secret' => $_SESSION['app_secret'], 'default_graph_version' => 'v2.5', 'default_access_token' => '{access-token}']);
                        
                    } catch ( Facebook\Exceptions\FacebookResponseException $e ) {
                        
                        // When Graph returns an error
                        get_instance()->session->set_flashdata('error', 'Graph returned an error: ' . $e->getMessage());
                        
                    } catch ( Facebook\Exceptions\FacebookSDKException $e ) {
                        
                        // When validation fails or other local issues
                        get_instance()->session->set_flashdata('error', 'Facebook SDK returned an error: ' . $e->getMessage());
                        
                    }
                    
                }
                
            }
        }
        
        // Obtain the user access token from redirect
        $helper = $this->fb->getRedirectLoginHelper();
        
        // Get the user access token
        $access_token = $helper->getAccessToken();
        
        // Convert it to array
        $access_token = (array) $access_token;
        
        // Get array value
        $access_token = array_values($access_token);
        
        // Verify if access token exists
        if ( @$access_token[0] ) {
            
            // Get user data
            $getUserdata = json_decode(get('https://graph.facebook.com/me?fields=id,name,email&access_token=' . $access_token[0]));
            
            // Verify if user data was got
            if ( property_exists($getUserdata, 'id') ) {
                
                // Verify if a token must be refreshed
                if ( isset($_SESSION['account']) ) {
                    
                    $acc = 0;
                    $act = $_SESSION['account'];
                    unset($_SESSION['account']);
                    
                    if (!is_numeric($act)) {
                        
                        exit();
                        
                    } else {
                        
                        // Get account data
                        $gat = $this->CI->networks->get_account($act);
                        
                        if ($gat) {
                            
                            $acc = $gat[0]->net_id;
                            
                        }
                        
                    }
                    
                    // Verify if user is logged in the expected account 
                    if ($getUserdata->id == $acc) {
                        
                        // Update the token
                        if ($this->CI->networks->update_network($act, $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']), date('Y-m-d H:i:s', strtotime('+60 days')), $access_token[0])) {
                            
                            $this->CI->session->set_flashdata('deleted', display_mess(135));
                            redirect('user/expiration-tokens', 'refresh');
                            
                        } else {
                            
                            $this->CI->session->set_flashdata('deleted', display_mess(136));
                            redirect('user/expiration-tokens', 'refresh');
                            
                        }
                        
                    } else {

                        $this->CI->session->set_flashdata('deleted', display_mess(137));
                        redirect('user/expiration-tokens', 'refresh');
                        
                    }
                }
                
                // Get the user_id
                $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
                
                // Calculate expire token period
                $expires = date('Y-m-d H:i:s', strtotime('+60 days'));
                
                // Verify if the account was saved
                if ($this->CI->networks->check_account_was_added('facebook', $getUserdata->id, $user_id)) {
                    
                    $this->CI->session->set_flashdata('deleted', display_mess(79, 'Facebook'));
                    
                } else {
                    
                    // Return success message
                    $this->CI->session->set_flashdata('deleted', display_mess(80));
                    
                    if (!isset($_SESSION['app_id'])) {
                        
                        $this->CI->networks->add_network('facebook', $getUserdata->id, $access_token[0], $user_id, $expires, $getUserdata->name, 'http://graph.facebook.com/' . $getUserdata->id . '/picture?type=square');
                        
                    } else {
                        
                        $this->CI->networks->add_network('facebook', $getUserdata->id, $access_token[0], $user_id, $expires, $getUserdata->name, 'http://graph.facebook.com/' . $getUserdata->id . '/picture?type=square', '', $_SESSION['app_id'], $_SESSION['app_secret']);
                        unset($_SESSION['app_id']);
                        unset($_SESSION['app_secret']);
                        
                    }
                    return true;
                }
            }
            
        } else {
            
            return false;
            
        }
    }

    /**
     * The public method post publishes posts on facebook.
     *
     * @param array $args contains the post data.
     * @param integer $user_id is the ID of the current user
     * 
     * @return boolean true if post was published
     */
    public function post($args, $user_id = null) {
        
        // Get user details
        if ($user_id) {

            // If the $user_id variable is not null, will be published a postponed post
            $user_details = $this->CI->networks->get_network_data('facebook', $user_id, $args['account']);
            
        } else {

            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            $user_details = $this->CI->networks->get_network_data('facebook', $user_id, $args['account']);
            
        }
        
        // Verify if user can use his App ID and App secret
        if (get_option('facebook_user_api_key')) {
            
            // If api_key is empty missing no app_id and app_secret
            if (!$user_details[0]->api_key) {
                
                return false;
                
            } else {
                
                // Verify if the Facebook SDK exists
                if (file_exists(FCPATH . 'vendor/facebook/php-sdk-v4/src/Facebook/autoload.php')) {
                    
                    try {
                        
                        // Call the Facebook Class
                        include FCPATH . 'vendor/facebook/php-sdk-v4/src/Facebook/autoload.php';
                        $this->fb = new Facebook\Facebook(['app_id' => $user_details[0]->api_key, 'app_secret' => $user_details[0]->api_secret, 'default_graph_version' => 'v2.5', 'default_access_token' => '{access-token}']);
                        
                    } catch (Facebook\Exceptions\FacebookResponseException $e) {
                        
                        // When Graph returns an error
                        get_instance()->session->set_flashdata('error', 'Graph returned an error: ' . $e->getMessage());
                        
                    } catch (Facebook\Exceptions\FacebookSDKException $e) {
                        
                        // When validation fails or other local issues
                        get_instance()->session->set_flashdata('error', 'Facebook SDK returned an error: ' . $e->getMessage());
                        
                    }
                    
                }
                
            }
            
        }
        
        try {
            
            // Set access token
            $this->fb->setDefaultAccessToken($user_details[0]->token);
            
            // Get post content 
            $post = $args['post'];
            
            // Verify if the title is not empty
            if ( $args['title'] ) {
                
                $post = $args['title'] . ' ' . $post;
                
            }
            
            // Verify if image exists
            if ($args['img']) {

                // Try to upload the image
                $postu = $this->fb->post('/me/photos', ['url' => $args['img'], 'no_story' => true], $user_details[0]->token);

                // Decode the response
                if ( @$postu->getDecodedBody() ) {
                    
                    // Try to get the post's ID
                    $mo = $postu->getDecodedBody();
                    
                    if ( @$mo['id'] ) {

                        // Verify if url exists
                        if ( $args['url'] ) {
                            
                            $post = $post . ' ' . $args['url'];
                            
                        }
                        
                        // Create post content
                        $data = ['message' => $post, 'object_attachment' => $mo['id']];
                        
                        // Publish the post
                        $post = $this->fb->post('/me/feed', $data, $user_details[0]->token);
                        
                    }
                    
                }
                
            } elseif ($args['video']) {
                
                // Verify if url exists
                if ($args['url']) {
                    $post = $post . ' ' . $args['url'];
                }
                
                // Create the post content
                $linkData = ['source' => $this->fb->videoToUpload($args['video']), 'description' => $post];
                
                // Publish the video
                $post = $this->fb->post('/me/videos', $linkData, $user_details[0]->token);
                
            } elseif ($args['url']) {
                
                // Create the post content
                $linkData = ['link' => $args['url'], 'message' => $post];
                
                // Publish the post
                $post = $this->fb->post('/me/feed', $linkData, $user_details[0]->token);
                
            } else {
                
                // Create the post content
                $linkData = ['message' => $post];
                
                // Publish the post
                $post = $this->fb->post('/me/feed', $linkData, $user_details[0]->token);
                
            }
            
            // Verify if the post was published
            if (@$post->getDecodedBody()) {
                
                // Decode the response
                $mo = $post->getDecodedBody();
                
                // Save the post response
                if (@$mo['id'] && @$args['id']) {
                    sami($mo['id'], $args['id'], $args['account'], 'facebook', $user_id);
                }
                
                return true;
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
     * @return object with network data
     */
    public function get_info() {
        
        return (object) ['color' => '#3b5998', 'icon' => '<i class="fa fa-facebook"></i>', 'rss' => true, 'api' => ['app_id', 'app_secret'], 'types' => 'text, links, images, videos', 'categories' => false];
        
    }

    /**
     * The public method preview generates a preview for facebook.
     *
     * @param array $args contains the img or url.
     * 
     * @return object with html content
     */
    public function preview($args) {
        
        if (filter_var($args["img"], FILTER_VALIDATE_URL)) {
            
            $url = '<div>
                        <p class="previmg"><img src="' . $args['img'] . '"></p>
                        <p class="prevtext"></p>
                    </div>';
            
        } elseif (filter_var($args['video'], FILTER_VALIDATE_URL)) {
            
            $url = '<div>
                        <p class="previmg"><video controls="true" style="width:100%;height:300px"><source src="' . $args['video'] . '" type="video/mp4" /></video></p>
                        <p class="prevtext"></p>
                    </div>';
            
        } elseif (filter_var($args['url'], FILTER_VALIDATE_URL)) {
            
            $url = '<div class="col-lg-2 col-sm-3 col-xs-12"> <img src="(img)"> </div>
                    <div class="col-lg-10 col-sm-9 col-xs-12">
                            <h3>(title)</h3>
                            <p>(description)</p>
                            <p>(domain)</p>
                    </div>';
            
        } else {
            
            $url = '<div>
                  <p class="prevtext"></p>
                  </div>';
            
        }
        
        // return html data with some placeholders words: (image), (title), (description) and (domain). These placeholders will be replaced with data extracted from url.
        return (object) [
                    'name' => 'facebook',
                    'icon' => '<button type="button" class="btn btn-network-f"><i class="fa fa-facebook"></i><span data-network="facebook"><i class="fa fa-times"></i></span></button>',
                    'head' => '<li><a href="#facebook" data-toggle="tab"><i class="fa fa-facebook"></i></a></li>',
                    'content' => '<div class="tab-pane" id="facebook">
                                  <div class="facebook forall">
                                                      ' . $url . '
                                                  </div>
                                          </div>'];
    }

}
