<?php
/**
 * Youtube
 *
 * PHP Version 5.6
 *
 * Connect and Publish to Youtube
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
 * Youtube class - allows users to connect to their Youtube Account and upload videos
 *
 * @category Social
 * @package Midrub
 * @author Scrisoft <asksyn@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link https://www.midrub.com/
 */
class Youtube implements Autopost {

    /**
     * Class variables
     */
    protected $connect, $client, $CI, $clientId, $clientSecret, $apiKey, $youtube;

    /**
     * Load networks and user model.
     */
    public function __construct() {
                
        // Get the CodeIgniter super object
        $this->CI = & get_instance();
        
        // Get the Google's client_id
        $this->clientId = get_option('youtube_client_id');
        
        // Get the Google's client_secret
        $this->clientSecret = get_option('youtube_client_secret');
        
        // Get the Google's api key
        $this->apiKey = get_option('youtube_api_key');
        
        // Get the Google's application name
        $appName = get_option('youtube_google_application_name');
                
        // Verify if the class Google_Client was already called
        if ( !class_exists( 'Google_Client', false ) ) {
            
            require_once FCPATH . 'vendor/google/src/Google_Client.php';
            
        }
        
        require_once FCPATH . 'vendor/google/src/contrib/Google_YouTubeService.php';
        require_once FCPATH . 'vendor/google/src/service/Google_MediaFileUpload.php';
        
        // Youtube CallBack
        $scriptUri = get_instance()->config->base_url() . 'user/callback/youtube';
        
        // Call the class Google_Client
        $this->client = new Google_Client();
        
        // Offline because we need to get refresh token
        $this->client->setAccessType('offline');
        
        // Name of the google application
        $this->client->setApplicationName($appName);
        
        // Set the client_id
        $this->client->setClientId($this->clientId);
        
        // Set the client_secret
        $this->client->setClientSecret($this->clientSecret);
        
        // Redirects to same url
        $this->client->setRedirectUri($scriptUri);
        
        // Set the api key
        $this->client->setDeveloperKey($this->apiKey);
        
        // Load required scopes
        $this->client->setScopes(array(
            'https://www.googleapis.com/auth/youtube.upload https://www.googleapis.com/auth/youtube https://www.googleapis.com/auth/youtubepartner https://www.googleapis.com/auth/userinfo.profile'
        ));
        
        // Call the Youtube Services
        $this->youtube = new Google_YouTubeService($this->client);
    }

    /**
     * The public method check_availability checks if the Youtube api is configured correctly.
     *
     * @return will be true if the client_id, apiKey, and client_secret is not empty
     */
    public function check_availability() {
        
        // Verify if clientId, clientSecret and apiKey exists
        if ( ($this->clientId != '') and ( $this->clientSecret != '') and ( $this->apiKey != '') ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method connect will redirect user to Google login page.
     * 
     * @return void
     */
    public function connect() {
        
        // Generate redirect url
        $authUrl = $this->client->createAuthUrl();
        
        // Redirect
        header('Location:' . $authUrl);
        
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
            
            // Send the received code
            $this->client->authenticate( $this->CI->input->get('code', TRUE) );
            
            // Get access token
            $token = $this->client->getAccessToken();
            
            // Set access token
            $this->client->setAccessToken($token);
            
            // Decode response
            $token = json_decode($token);
            
            // Verify if token exists
            if ( @$token->access_token ) {
                
                // Get refresh token
                $refresh = $token->refresh_token;
                
                // Get expiration time
                $expires_in = $token->expires_in;
                
                // Get access token
                $token = $token->access_token;
                
                // we will use the token to get user data
                $curl = curl_init();
                
                // Set some options - we are passing in a useragent too here
                curl_setopt_array($curl, array(
                    CURLOPT_RETURNTRANSFER => 1,
                    CURLOPT_URL => 'https://www.googleapis.com/oauth2/v3/userinfo?access_token=' . $token,
                    CURLOPT_HEADER => false
                ));
                
                // Send the request & save response to $resp
                $udata = curl_exec($curl);
                
                // Close request to clear up some resources
                curl_close($curl);
                
                // Veify if response is valid
                if ($udata) {
                    
                    // Decode response
                    $udecode = json_decode($udata);
                    
                    // Verify if account exists
                    if ( @$udecode->sub ) {
                        
                        // Get user_id
                        $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
                        
                        // Get user name
                        $name = @$udecode->name;
                        
                        // Get user picture
                        $picture = @$udecode->picture;
                        
                        // Verify if social network was already added
                        if ( !$this->CI->networks->get_network_data('youtube', $this->CI->user->get_user_id_by_username($this->CI->session->userdata ['username']), $udecode->sub) ) {
                            
                            $this->CI->networks->add_network('youtube', $udecode->sub, $token, $user_id, '', $name, $picture, $refresh);
                            
                        }
                        
                    }
                    
                }
                
            }
            
        }
        
    }

    /**
     * The public method post publishes posts on Youtube.
     *
     * @param array $args contains the post data.
     * @param integer $user_id is the ID of the current user
     * 
     * @return boolean true if post was published
     */
    public function post($args, $user_id = null) {
        
        // Get user details
        if ($user_id) {
            
            // if the $user_id variable is not null, will be published a postponed post
            $con = $this->CI->networks->get_network_data(strtolower('youtube'), $user_id, $args ['account']);
            
        } else {
            
            // Get the user ID
            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            $con = $this->CI->networks->get_network_data(strtolower('youtube'), $this->CI->user->get_user_id_by_username($this->CI->session->userdata ['username']), $args ['account']);
            
        }
        
        // Verify if user has the social account
        if ($con) {
            
            // Verify if secret exists
            if ($con [0]->secret) {
                
                try {
                    
                    // Get video
                    $video = str_replace(base_url(), FCPATH, $args['video']);
                    
                    // Refresh token
                    $this->client->refreshToken($con[0]->secret);
                    
                    // Get access token
                    $newtoken = $this->client->getAccessToken();
                    
                    // Set access token
                    $this->client->setAccessToken($newtoken);
                    $file_info = finfo_open(FILEINFO_MIME_TYPE);
                    $mime_type = finfo_file($file_info, $video);
                    $video_snippet = new Google_VideoSnippet();
                    
                    // Verify if title is not empty
                    if ( $args ['title'] ) {
                        
                        $video_snippet->setTitle($args ['title']);
                        $video_snippet->setDescription($args ['post']);
                        
                    } else {
                        
                        $video_snippet->setTitle($args['post']);
                        
                    }
                    
                    // Verify if category exists
                    if ( $args['category'] ) {
                        
                        $category = json_decode($args['category']);
                        
                        if (@$category->$args['account']) {
                            $video_snippet->setCategoryId([$category->$args['account']]);
                        }
                        
                    }
                    
                    // Publish the video
                    $status = new Google_VideoStatus();
                    $status->setPrivacyStatus('public');
                    $google_video = new Google_Video();
                    $google_video->setSnippet($video_snippet);
                    $google_video->setStatus($status);
                    $upload = $this->youtube->videos->insert('snippet,status', $google_video, array(
                        'data' => file_get_contents($video),
                        'mimeType' => $mime_type,
                    ));
                    
                    if ( $upload ) {
                        
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
        
    }

    /**
     * The public method get_info displays information about this class.
     * 
     * @return object with network's data
     */
    public function get_info() {
        
        return (object) [
                    'color' => '#ca3737',
                    'icon' => '<i class="fa fa-youtube"></i>',
                    'rss' => false,
                    'api' => [
                        'client_id',
                        'client_secret',
                        'api_key',
                        'google_application_name'
                    ],
                    'types' => 'text, links, videos',
                    'categories' => true
        ];
        
    }

    /**
     * The public method preview generates a preview for Youtube.
     *
     * @param array $args contains the video or url.
     * 
     * @return object with html content
     */
    public function preview($args) {
        
        if (filter_var($args['video'], FILTER_VALIDATE_URL)) {
            $video = '<div>
                        <p class="previmg"><video controls="true" style="width:100%;height:300px"><source src="' . $args["video"] . '" type="video/mp4" /></video></p>
                        <p class="prevtext"></p>
                    </div>';
        } else {
            
            return (object) ['info' => '<div class="col-lg-12 merror"><p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' . display_mess(130) . '</p></div>'];
            
        }
        
        return (object) [
                    'name' => 'youtube',
                    'icon' => '<button type="button" class="btn btn-network-y"><i class="fa fa-youtube"></i><span data-network="youtube"><i class="fa fa-times"></i></span></button>',
                    'head' => '<li class="youtube"><a href="#youtube" data-toggle="tab"><i class="fa fa-youtube"></i></li>',
                    'content' => '<div class="tab-pane" id="youtube">
                                      <div class="youtube forall">
                                                  ' . $video . '
                                              </div>
                                      </div>'
        ];
        
    }

}
