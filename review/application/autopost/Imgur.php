<?php
/**
 * Imgur
 *
 * PHP Version 5.6
 *
 * Connect and Publish to Imgur
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
 * Imgur class - allows users to connect to their Imgur Account and upload videos
 *
 * @category Social
 * @package Midrub
 * @author Scrisoft <asksyn@gmail.com>
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link https://www.midrub.com/
 */
class Imgur implements Autopost {

    /**
     * Class variables
     */
    protected $api, $callback, $CI, $clientId, $clientSecret;

    /**
     * Load networks and user model.
     */
    public function __construct() {
        
        // Get the CodeIgniter super object
        $this->CI = & get_instance();
        
        // Get the Imgur's client_id
        $this->clientId = get_option('imgur_client_id');
        
        // Get the Imgur's client_secret
        $this->clientSecret = get_option('imgur_client_secret');
        
        // Get redirect url
        $this->callback = base_url() . 'user/callback/imgur';
        
    }

    /**
     * The public method check_availability checks if the Imgur api is configured correctly.
     *
     * @return boolean true or false
     */
    public function check_availability() {
        
        // Verify if clientId and clientSecret is not empty
        if (($this->clientId != '') and ( $this->clientSecret != '')) {
            
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
        
        // Get redirect url
        $authUrl = 'https://api.imgur.com/oauth2/authorize?client_id=' . $this->clientId . '&response_type=code&state=code';
        
        // Redirect
        header('Location:' . $authUrl);
        
    }

    /**
     * The public method save will get access token.
     *
     * @param string $token contains the token for some social networks
     * 
     * @return boolean true or false
     */
    public function save($token = null) {
        
        // Verify if code exists
        if ( $this->CI->input->get('code', TRUE) ) {
            
            // Generate access token
            $curl = curl_init('https://api.imgur.com/oauth2/token');
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt(
                $curl, CURLOPT_POSTFIELDS, [
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'code' => $this->CI->input->get('code', TRUE),
                    'redirect_uri' => $this->callback,
                    'grant_type' => 'authorization_code'
                ]
            );
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            $data = curl_exec($curl);
            curl_close($curl);
            
            // Decode response
            $data = json_decode($data);
            
            // Verify if access token exists
            if ( @$data->access_token ) {
                
                // Get refresh token
                $refresh = $data->refresh_token;
                
                // Get access token
                $token = $data->access_token;
                
                // Get user_id
                $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
                
                // Verify if the account was already saved
                if ( !$this->CI->networks->get_network_data('imgur', $this->CI->user->get_user_id_by_username($this->CI->session->userdata ['username']), $data->account_id) ) {
                    
                    // Save account
                    $this->CI->networks->add_network('imgur', $data->account_id, $token, $user_id, '', $data->account_username, '', $refresh);
                    
                }
                
            }
            
        }
        
    }

    /**
     * The public method post publishes posts on Imgur.
     *
     * @param array $args contains the post data.
     * @param integer $user_id is the ID of the current user
     * 
     * @return boolean true if post was published
     */
    public function post($args, $user_id = null) {
        
        // Get user's details
        if ( $user_id ) {
            
            // if the $user_id variable is not null, will be published a postponed post
            $con = $this->CI->networks->get_network_data('imgur', $user_id, $args ['account']);
            
        } else {
            
            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            $con = $this->CI->networks->get_network_data('imgur', $user_id, $args ['account']);
            
        }
        
        // Verify if user's account exists
        if ( $con ) {
            
            // Verify if the secret column is not empty
            if ($con [0]->secret) {
                
                try {
                    
                    // Refresh the token 
                    $curl = curl_init('https://api.imgur.com/oauth2/token');
                    curl_setopt($curl, CURLOPT_POST, true);
                    curl_setopt(
                            $curl, CURLOPT_POSTFIELDS, [
                        'client_id' => $this->clientId,
                        'client_secret' => $this->clientSecret,
                        'refresh_token' => $con[0]->secret,
                        'grant_type' => 'refresh_token'
                            ]
                    );
                    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                    $data = curl_exec($curl);
                    curl_close($curl);
                    
                    // Decode response
                    $data = json_decode($data);
                    
                    // Get access token
                    $token = @$data->access_token;
                    
                    // Get post data
                    $title = $args['post'];
                    
                    $post = '';
                    
                    // If title is not empty
                    if ( $args['title'] ) {
                        
                        // Set the title
                        $title = $args['title'];
                        
                        // Set post's body
                        $post = $args['post'];
                        
                    }
                    
                    // Verify if token exists
                    if ($token) {
                        
                        // Upload the image
                        $curl = curl_init('https://api.imgur.com/3/image');
                        curl_setopt($curl, CURLOPT_POST, true);
                        curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $data->access_token));
                        curl_setopt(
                                $curl, CURLOPT_POSTFIELDS, [
                            'title' => $title,
                            'description' => $post,
                            'image' => $args['img']
                                ]
                        );
                        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                        $data = curl_exec($curl);
                        curl_close($curl);
                        
                        // Decode the response
                        $data = json_decode($data);
                        
                        // Verify if the post was published
                        if ( @$data->data->title ) {
                            
                            return true;
                            
                        } else {
                            
                            return false;
                            
                        }
                        
                    } else {
            
                        // Save the error
                        $this->CI->user_meta->update_user_meta( $user_id, 'last-social-error', 'Invalid access token.' );

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
        }
    }

    /**
     * The public method get_info displays information about this class.
     * 
     * @return object with network's data
     */
    public function get_info() {
        
        return (object) [
                    'color' => '#1bb76e',
                    'icon' => '<i class="fa fa-info" aria-hidden="true"></i>',
                    'rss' => true,
                    'api' => [
                        'client_id',
                        'client_secret',
                    ],
                    'types' => 'text, links, images',
                    'categories' => false
        ];
        
    }

    /**
     * The public method preview generates a preview for Midrub
     *
     * @param $args contains the image or url
     * 
     * @return object with html coontent
     */
    public function preview($args) {
        
        if (filter_var($args['img'], FILTER_VALIDATE_URL) === FALSE) {
            return (object) ['info' => '<div class="col-lg-12 merror"><p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Please, enter a valid image\'s url in the field above.</p></div>'];
        }
        
        return (object) [
                    'name' => 'imgur',
                    'icon' => '<button type="button" class="btn"><i class="fa fa-info" aria-hidden="true"><span data-network="imgur"><i class="fa fa-times"></i></span></button>',
                    'head' => '<li class="imgur"><a href="#imgur" data-toggle="tab"><i class="fa fa-info" aria-hidden="true"></i></a></li>',
                    'content' => '<div class="tab-pane" id="imgur">
                                <div class="imgur forall">
                                    <div>
                                            <p class="previmg"><img src="' . $args['img'] . '"></p>
                                            <p class="prevtext"></p>
                                    </div>
                                    </div>
                                </div>'];
        
    }

}
