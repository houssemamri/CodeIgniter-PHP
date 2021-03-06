<?php
/**
 * Medium
 *
 * PHP Version 5.6
 *
 * Connect and Publish to Medium
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
 * Medium class - allows users to connect to their Medium Account and publish posts.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Medium implements Autopost {

    /**
     * Class variables
     */
    protected $CI, $params, $medium, $redirect_uri, $client_id, $client_secret;
    
    /**
     * Load networks and user model.
     */
    public function __construct() {
        
        // Get the CodeIgniter super object
        $this->CI = & get_instance();
        
        // Get Medium's client_id
        $this->client_id = get_option('medium_client_id');
        
        // Get Medium's client_secret
        $this->client_secret = get_option('medium_client_secret');
        
        // // Get Medium's redirect
        $this->redirect_uri = base_url() . 'user/callback/medium';
        
        // Require the vendor autoload
        include_once FCPATH . 'vendor/autoload.php';
        
        // Create params with connection data
        $this->params = [
            'client-id' => $this->client_id,
            'client-secret' => $this->client_secret,
            'scopes' => 'basicProfile,publishPost',
            'redirect-url' => $this->redirect_uri,
            'state' => 'publishPost'
        ];
        
        // Call the medium's class
        $this->medium = new JonathanTorres\MediumSdk\Medium($this->params);
        
    }
    
    /**
     * The public method check_availability checks if the Medium api is configured correctly.
     *
     * @return boolean true or false
     */
    public function check_availability() {
        
        // Verify if client_id and client_secret is not empty
        if ( ($this->client_id != '') AND ( $this->client_secret != '') ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }
    
    /**
     * The public method connect will redirect user to Medium login page.
     */
    public function connect() {
        
        // Get redirect url
        $loginUrl = $this->medium->getAuthenticationUrl();
        
        // Redirect
        header('Location:' . $loginUrl);
        
    }
    
    /**
     * The public method save will get access token.
     *
     * @param string $token contains the token for some social networks
     * 
     * @return void
     */
    public function save($token = null) {
        
        // Verify if the code exists
        if ( $this->CI->input->get('code', TRUE) ) {
            
            // Generate the token
            $postdata = http_build_query(['code' => $this->CI->input->get('code', TRUE), 'client_id' => $this->client_id, 'client_secret' => $this->client_secret, 'grant_type' => 'authorization_code', 'redirect_uri' => $this->redirect_uri]);
            $curl = curl_init('https://api.medium.com/v1/tokens');
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-type: application/x-www-form-urlencoded'));
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $postdata);
            $resp = curl_exec($curl);
            curl_close($curl);
            
            // Decode response
            $secret = json_decode($resp);
            
            // Verify if access token exists
            if ( @$secret->access_token ) {
                
                // Get access token
                $token = $secret->access_token;
                
                // Get refresh token
                $refresh = @$secret->refresh_token;
                
                // Get expire time
                $expires_in = @$secret->expires_at; // is valid for 60 days but we refresh it if we get $refresh_token

                // get user data
                $curl = curl_init();
                
                // Set some options - we are passing in a useragent too here
                curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://api.medium.com/v1/me?accessToken='.$token,CURLOPT_HEADER => false));
                
                // Send the request & save response to $resp
                $data = curl_exec($curl);
                
                // Close request to clear up some resources
                curl_close($curl);
                
                // Verify if data exists
                if ( $data ) {
                    
                    // Decode response
                    $udata = json_decode($data);
                    
                    // Verify if response is valid
                    if ( @$udata->data->name ) {
                        
                        // Get blog name
                        $name = $udata->data->name;
                        
                        // Get blog avatar
                        $imageUrl = $udata->data->imageUrl;
                        
                        // Get blog id
                        $id = $udata->data->id;
                        
                        if ( $refresh ) {
                            $expires_in = ' ';
                        }
                        
                        // Get user_id
                        $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
                        
                        // Verify if blog was already saved
                        if ( !$this->CI->networks->get_network_data('medium', $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']), $id) ) {
                            
                            $this->CI->session->set_flashdata('deleted', display_mess(80));
                            $this->CI->networks->add_network('medium', $id, $token, $user_id, $expires_in, $name, $imageUrl, $refresh);
                            
                        } else {
                            
                            $this->CI->session->set_flashdata('deleted', display_mess(79, 'Medium'));
                            
                        }
                        
                    }
                    
                }
                
            }
            
        }
        
    }
    
    /**
     * The public method post publishes posts on Medium.
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
            $user_details = $this->CI->networks->get_network_data(strtolower('medium'), $user_id, $args['account']);
            
        } else {
            
            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            $user_details = $this->CI->networks->get_network_data(strtolower('medium'), $user_id, $args['account']);
            
        }
        
        try {
            
            // Generate new access token
            $accessToken = $this->medium->exchangeRefreshToken($user_details[0]->secret);
            
            // Verify if access token was generated
            if ( @$accessToken ) {
                
                // Set access token
                $this->medium->setAccessToken($accessToken);
                
                $data = [];
                
                // Verify if title exists
                if ( $args ['title'] ) {
                    
                    $data['title'] = $args ['title'];
                    $data['content'] = $args['post'];
                    
                } else {
                    
                    $data['content'] = $args['post'];
                    
                }
                
                // Set post format
                $data['contentFormat'] = 'html';
                
                // Set post's status
                $data['publishStatus'] = 'public';
                
                // Publish the post
                $response = $this->medium->createPost($user_details[0]->net_id, $data);
                
                if ( $response ) {
                    
                    return true;
                    
                } else {
                    
                    // Save the error
                    $this->CI->user_meta->update_user_meta( $user_id, 'last-social-error', json_encode($response) );

                    // Then return falsed
                    return false;                    
                    
                }
                
            } else {
                
                // Save the error
                $this->CI->user_meta->update_user_meta( $user_id, 'last-social-error', 'Invalid access token.' );

                // Then return falsed
                return false;
                
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
        
        return (object) ['color' => '#02b875', 'icon' => '<i class="fa fa-medium" style="color:#ffffff"></i>', 'rss' => true, 'api' => ['client_id', 'client_secret'], 'types' => 'text, links', 'categories' => false];
        
    }
    
    /**
     * The public method preview generates a preview for Medium.
     *
     * @param array $args contains the img or url.
     * 
     * @return object with html content
     */
    public function preview($url = null) {
        
        return (object) [
                    'name' => 'medium',
                    'icon' => '<button type="button" class="btn btn-network-m"><img src="/assets/img/medium.png"><span data-network="medium"><i class="fa fa-times"></i></span></button>',
                    'head' => '<li class="medium"><a href="#medium" data-toggle="tab"><img src="/assets/img/medium.png"></a></li>',
                    'content' => '<div class="tab-pane" id="medium">
                                  <div class="medium forall">
                                        <div>
                                          <p class="prevtext blogpost"></p>
                                        </div>
                                  </div>
                                </div>'
        ];
        
    }
    
}
