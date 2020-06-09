<?php
/**
 * Reddit
 *
 * PHP Version 5.6
 *
 * Connect and Publish to Reddit
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
 * Reddit class - allows users to connect to their Reddit Account and publish posts.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Reddit implements Autopost {

    /**
     * Class variables
     */
    protected $CI, $connection, $app, $secret, $redirect_url;
    
    /**
     * Load networks and user model.
     */
    public function __construct() {
        
        // Get the CodeIgniter super object
        $this->CI = & get_instance();
        
        // Get the Reddit client_id
        $this->app = get_option('reddit_client_id');
        
        // Get the Reddit client_secret
        $this->secret = get_option('reddit_client_secret');
        
        // Get Reddit callback
        $this->redirect_url = base_url() . 'user/callback/reddit';
        
    }
    
    /**
     * The public method check_availability checks if the Reddit api is configured correctly.
     *
     * @return boolean true or false
     */
    public function check_availability() {
        
        // Verify if app and secret is not empty
        if ( ($this->app != '') AND ( $this->secret != '') ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
    }
    
    /**
     * The public method connect will redirect user to Reddit login page.
     * 
     * @return void
     */
    public function connect() {
        
        // Get permissions
        $permission = 'save,modposts,identity,edit,read,report,submit';
        
        // Set url
        $url = 'https://www.reddit.com/api/v1/authorize';
        
        $code = rand();
        $params = [
            'response_type' => 'code',
            'client_id' => $this->app,
            'redirect_uri' => $this->redirect_url,
            'scope' => $permission,
            'state' => $code,
            'duration' => 'permanent',
        ];
        
        // Get redirect url
        $url = $url . '?' . urldecode(http_build_query($params));
        
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
        
        // Verify if code exists
        if ( $this->CI->input->get('code', TRUE) ) {
            
            // If the code exists will get the token
            $curl = curl_init('https://www.reddit.com/api/v1/access_token');
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_USERPWD, $this->app . ':' . $this->secret);
            curl_setopt(
                $curl, CURLOPT_POSTFIELDS, [
                'grant_type' => 'authorization_code',
                'code' => $this->CI->input->get('code', TRUE),
                'redirect_uri' => $this->redirect_url,
                ]
            );
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            
            // Decode Response
            $data = json_decode(curl_exec($curl));
            
            // Verify if response is valid
            if ( @$data->access_token ) {
                
                // Get access token
                $token = $data->access_token;
                
                // Get refresh token
                $refresh_token = $data->refresh_token;
                
                // Get user data
                $curl = curl_init('https://oauth.reddit.com/api/v1/me');
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token, 'User-Agent: flairbot/1.0 by '));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $data = json_decode(curl_exec($curl));
                curl_close($curl);
                
                // Verify if response is valid
                if ( @$data->name ) {
                    
                    // Get user name
                    $name = $data->name;
                    
                    // Get user_id
                    $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
                    
                    // Verify if the account was already saved
                    if ($this->CI->networks->check_account_was_added('reddit', $name, $user_id)) {
                        
                        // Save account
                        $this->CI->session->set_flashdata('deleted', display_mess(79, 'Reddit'));
                        
                    } else {
                        
                        $this->CI->session->set_flashdata('deleted', display_mess(80));
                        $this->CI->networks->add_network('reddit', $name, $token, $user_id, '', $name, '', $refresh_token);
                        
                    }
                    
                }
                
            }
            
        }
        
    }
    
    /**
     * The public method post publishes posts on Reddit.
     *
     * @param array $args contains the post data.
     * @param integer $user_id is the ID of the current user
     * @return boolea true or false
     */
    public function post($args, $user_id = null) {
        
        // Get user details
        if ($user_id) {
            
            // if the $user_id variable is not null, will be published a scheduled post
            $user_details = $this->CI->networks->get_network_data(strtolower('reddit'), $user_id, $args['account']);
            
        } else {
            
            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            $user_details = $this->CI->networks->get_network_data(strtolower('reddit'), $user_id, $args['account']);
            
        }
        
        // first we need to refresh the token
        $curl = curl_init('https://www.reddit.com/api/v1/access_token');
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_USERPWD, $this->app . ':' . $this->secret);
        curl_setopt(
            $curl, CURLOPT_POSTFIELDS, [
            'grant_type' => 'refresh_token',
            'refresh_token' => $user_details[0]->secret,
            ]
        );
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $data = json_decode(curl_exec($curl));
        curl_close($curl);
        
        // then we check if the token was refreshed
        if ( @$data->access_token ) {
            
            // then we check category exists
            $cat = 'worldnews';
            if ( $args['category'] ) {
                $category = json_decode($args['category']);
                if ( @$category->$args['account'] ) {
                    $cat = $category->$args['account'];
                }
            }
                
            // then we submit the link
            $params = array(
                'url' => $args['url'],
                'title' => mb_substr(rawurldecode($args['post']), 0, 299),
                'sr' => $cat,
                'kind' => 'link',
            );
            
            // curl settings and call to post to the subreddit
            $curl = curl_init('https://oauth.reddit.com/api/submit');
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_USERAGENT, $user_details[0]->net_id . ' by /u/' . $user_details[0]->net_id . ' (Phapper 1.0)');
            curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $data->access_token));
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
            $response = curl_exec($curl);
            $response = json_decode($response);
            curl_close($curl);
            
            // Verify id response is successfully
            if ( @$response->success ) {
                
                // The post was published
                return true;
                
            } else {

                // Save the error
                $this->CI->user_meta->update_user_meta($user_id, 'last-social-error', json_encode($response));

                // Then return falsed
                return false;
                
            }
            
        }
        
    }
    
    /**
     * The public method get_info displays information about this class.
     */
    public function get_info() {
        
        return (object) ['color' => '#e1584b', 'icon' => '<i class="fa fa-reddit-alien"></i>', 'rss' => true, 'api' => ['client_id', 'client_secret'], 'types' => 'text, links', 'categories' => true];
        
    }
    
    /**
     * The public method preview generates a preview for Reddit.
     *
     * @param array $args contains the img or url.
     * 
     * @return object with html content
     */
    public function preview($args) {
        
        if (filter_var($args['url'], FILTER_VALIDATE_URL) === FALSE) {
            
            return (object) ['info' => '<div class="col-lg-12 merror"><p><i class="fa fa-exclamation-triangle"></i> ' . display_mess(142) . '</p></div>'];
            
        }
        
        return (object) [
            'name' => 'reddit',
            'icon' => '<button type="button" class="btn btn-network-fl"><i class="fa fa-reddit-alien" aria-hidden="true"></i><span data-network="reddit"><i class="fa fa-times"></i></span></button>',
            'head' => '<li class="facebook"><a href="#facebook" data-toggle="tab"></a></li>',
            'content' => '<div class="tab-pane" id="facebook">
                          <div class="facebook forall">
                                <div class="col-lg-2 col-sm-3 col-xs-12"> <img src="(img)"> </div>
                                <div class="col-lg-10 col-sm-9 col-xs-12">
                                        <h3>(title)</h3>
                                        <p>(description)</p>
                                        <p>(domain)</p>
                                </div>
                              </div>
                          </div>'];
    }
    
}
