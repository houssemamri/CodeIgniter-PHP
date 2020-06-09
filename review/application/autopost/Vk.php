<?php
/**
 * VK
 *
 * PHP Version 5.6
 *
 * Connect and Publish to VK
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
if ( !defined('BASEPATH')) {
    
    exit('No direct script access allowed');
    
}

/**
 * Vk class - allows users to connect to their VK and publish posts.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Vk implements Autopost {

    /**
     * Class variables
     */
    protected $CI, $check, $params, $redirect_uri, $client_id, $client_secret;
    
    /**
     * Load networks and user model.
     */
    public function __construct() {
        
        // Get the CodeIgniter super object
        $this->CI = & get_instance();
        
        // Get VK's client_id
        $this->client_id = get_option('vk_client_id');
        
        // Get VK's client_secret
        $this->client_secret = get_option('vk_client_secret');
        
        // Get the redirect url
        $this->redirect_uri = 'http://oauth.vk.com/authorize?client_id='.$this->client_id. '&scope=wall,offline,photos,friends&redirect_uri=http://oauth.vk.com/blank.html&display=page&v=5.73&response_type=token';
        
        // Params for request
        $this->params = array(
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'redirect_uri' => $this->redirect_uri,
            'response_type' => 'code'
        );
        
    }
    /**
     * The public method check_availability checks if the VK api is configured correctly.
     *
     * @return boolean true or false
     */
    public function check_availability() {
        if (($this->client_id != '') AND ( $this->client_secret != '')) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * The public method connect will redirect user to VK login page.
     * 
     * @return void
     */
    public function connect() {
        
        if ( $this->params ) {
            
            // Get redirect url
            $loginUrl = 'http://oauth.vk.com/authorize?' . urldecode(http_build_query($this->params));
            
            // Redirect
            header('Location:' . $loginUrl);
            
        }
        
    }
    
    /**
     * The public method save will get access token.
     *
     * @param string $token contains the token for some social networks
     * 
     * @return boolean true or false
     */
    public function save($token = null) {
        
        // Get the url
        $error = 0;
        $token = explode('#code=', $token);
        if ( !@$token[1] ) {
            
            $error = 1;
            
        }
        
        // Will check if the token is valid
        $params = [
            'client_id' => $this->client_id,
            'client_secret' => $this->client_secret,
            'code' => $token[1],
            'redirect_uri' => $this->redirect_uri
        ];
        
        // Get cURL resource
        $curl = curl_init();
        
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params)),CURLOPT_HEADER => false));
        
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        
        // Close request to clear up some resources
        curl_close($curl);
        
        // Decode response
        $token = (array)json_decode($resp);
        
        // If token is valid
        if ( @$token['access_token'] ) {
            
            // Set token
            $token = $token['access_token'];
            
            // Get user_id
            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            
            // Permissions
            $params = [
                'fields' => 'uid,screen_name,photo_big,wall,offline',
                'access_token' => $token,
                'v' => '5.73'
            ];
            
            // Get cURL resource
            $curl = curl_init();
            
            // Set some options - we are passing in a useragent too here
            curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://api.vk.com/method/users.get'.'?'.urldecode(http_build_query($params)),CURLOPT_HEADER => false));
            
            // Send the request & save response to $resp
            $userInfo = curl_exec($curl);
            
            // Close request to clear up some resources
            curl_close($curl);

            // Get user data
            $userInfo = (array)json_decode($userInfo);
            
            // Verify if user data is correct
            if ( (@$userInfo['response'][0]->id) AND ( @$userInfo['response'][0]->first_name) AND ( @$userInfo['response'][0]->last_name) AND ( @$userInfo['response'][0]->photo_big) ) {
                
                // Verify if account was already added
                if ( $this->CI->networks->check_account_was_added('vk', $userInfo['response'][0]->id, $user_id) ) {
                    
                    $this->CI->session->set_flashdata('deleted', display_mess(79, 'VK'));
                    
                } else {
                    
                    $aid = 0;
                    
                    $params = [
                        'title' => get_instance()->config->item('site_name'),
                        'description' => 'album',
                        'access_token' => $token,
                        'v' => '5.73'
                    ];

                    // Get cURL resource
                    $curl = curl_init();
                    
                    // Set some options - we are passing in a useragent too here
                    curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://api.vk.com/method/photos.createAlbum'.'?'.urldecode(http_build_query($params)),CURLOPT_HEADER => false));
                    
                    // Send the request & save response to $resp
                    $res = curl_exec($curl);
                    
                    // Close request to clear up some resources
                    curl_close($curl);
                    
                    // Decode the response
                    $res = json_decode($res);

                    // Verify if album was created
                    if ( @$res->response->id ) {
                        
                        $aid = $res->response->id;
                        
                    }
                    
                    $this->CI->session->set_flashdata('deleted', display_mess(80));
                    $this->CI->networks->add_network('vk', $userInfo['response'][0]->id, $token, $user_id, '', $userInfo['response'][0]->first_name . ' ' . $userInfo['response'][0]->last_name, $userInfo['response'][0]->photo_big, $aid);
                    return true;
                }
                
            }
            
        }
        
        return false;
        
    }
    
    /**
     * The public method post publishes posts on Vk.
     *
     * @param array $args contains the post data.
     * @param integer $user_id is the ID of the current user
     * 
     * @return boolean true if post was published
     */
    public function post($args, $user_id = null) {
        // get user details
        if ( $user_id ) {
            
            // if the $user_id variable is not null, will be published a scheduled post
            $user_details = $this->CI->networks->get_network_data(strtolower('vk'), $user_id, $args['account']);
            
        } else {
            
            // Get the user ID
            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            $user_details = $this->CI->networks->get_network_data(strtolower('vk'), $user_id, $args['account']);
            
        }
        
        // Get post's data
        $post = $args['post'];
        
        // Verify if title is not empty
        if( $args['title'] ) {
            
            $post = $args['title']. ' '. $post;
            
        }
        
        $params = [
            'owner_id' => $user_details[0]->net_id,
            'message' => urlencode($post),
            'access_token' => $user_details[0]->token,
            'v' => '5.73'
        ];
        
        // Verify if image exists
        if ( $args['img'] ) {
            
            // Verify if secret exists
            if( !trim($user_details[0]->secret) ) {
                
                $params['attachments'] = $args['img'];
                
            } else {
                
                // Publish details
                $params = [
                    'album_id' => $user_details[0]->secret,
                    'save_big' => 1,
                    'access_token' => $user_details[0]->token,
                    'v' => '5.73'
                ];                
                
                // Get cURL resource
                $curl = curl_init();
                
                // Set some options - we are passing in a useragent too here
                curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://api.vk.com/method/photos.getUploadServer'.'?'.urldecode(http_build_query($params)),CURLOPT_HEADER => false));
                
                // Send the request & save response to $resp
                $res = curl_exec($curl);
                
                // Close request to clear up some resources
                curl_close($curl);
                
                // Decode response
                $res = json_decode($res);
                
                // Verify if photo was uploaded
                if ( @$res->response->upload_url ) {
                    
                    // check if the image is loaded on server
                    $im = explode(base_url(), $args['img']);
                    
                    if ( isset($im[1]) ) {
                        
                        $rep = str_replace(base_url(), FCPATH, $args['img']);
                        $file = new \CurlFile($rep);
                        
                    } else {
                        
                        $curl = curl_init();
                        
                        // Set some options - we are passing in a useragent too here
                        curl_setopt_array($curl, [CURLOPT_RETURNTRANSFER => 1, CURLOPT_BINARYTRANSFER => 1, CURLOPT_URL => $args['img'], CURLOPT_HEADER => false]);
                        
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
                    
                    if( $file ) {
                        
                        $ch = curl_init( $res->response->upload_url );
                        curl_setopt ( $ch, CURLOPT_HEADER, false );
                        curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
                        curl_setopt ( $ch, CURLOPT_SSL_VERIFYPEER, false );
                        curl_setopt ( $ch, CURLOPT_POST, true );
                        curl_setopt ( $ch, CURLOPT_POSTFIELDS, array( 'file1' => $file ) );
                        $data = curl_exec($ch);
                        curl_close($ch);
                        $data = json_decode( $data );
                        
                        if ( @$data->server ) {
                            
                            $params = [
                                'album_id' => $user_details[0]->secret,
                                'server' => $data->server,
                                'photos_list' => $data->photos_list,
                                'hash' => $data->hash,
                                'caption' => urlencode($post),
                                'access_token' => $user_details[0]->token,
                                'v' => '5.73'
                            ];
                            
                            // Get cURL resource
                            $curl = curl_init();
                            
                            // Set some options - we are passing in a useragent too here
                            curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://api.vk.com/method/photos.save'.'?'.urldecode(http_build_query($params)),CURLOPT_HEADER => false));
                            
                            // Send the request & save response to $resp
                            $res = curl_exec($curl);
                            
                            // Close request to clear up some resources
                            curl_close($curl);
                            
                            // Decode response
                            $res = json_decode($res);
                            
                            if ( @$res->response[0]->id ) {
                                
                                $params['attachments'] = 'photo' . $user_details[0]->net_id . '_' . $res->response[0]->id;
                                
                            }
                            
                        } else {
                            
                            $params['attachments'] = $args['img'];
                            
                        }
                        
                    }
                    
                } else {
                    
                    $params['attachments'] = $args['img'];
                    
                }
                
            }
            
        } else if ( $args['url'] ) {
            
            $params['attachments'] = $args['url'];
            
        }
        
        // Get cURL resource
        $curl = curl_init();
        
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, array(CURLOPT_RETURNTRANSFER => 1, CURLOPT_URL => 'https://api.vk.com/method/wall.post' . '?' . urldecode(http_build_query($params)),CURLOPT_HEADER => false));
        
        // Send the request & save response to $resp
        $publish = curl_exec($curl);
        
        // Close request to clear up some resources
        curl_close($curl);
        
        // Decode response
        $publish = json_decode($publish);

        if ( @$publish->error ) {
            
            // Save the error
            $this->CI->user_meta->update_user_meta($user_id, 'last-social-error', json_encode($publish->error) );
            
        } else {
            
            return true;
            
        }
        
    }
    
    /**
     * The public method get_info displays information about this class.
     * 
     * @return object with network's data
     */
    public function get_info() {
        
        return (object) ['color' => '#6383a8', 'icon' => '<i class="fa fa-vk"></i>', 'rss' => true, 'popup' => 'class="openpopup btn btn-default"', 'hidden' => '
		                <li class="upim" data-network="vk">
                            <div class="col-md-12 clean">
                                <div class="input-group search">
                                    <input type="text" placeholder="Please, copy the url from the opened popup and enter it in the field bellow." class="form-control search_accounts token">
                                    <span class="input-group-btn search-m">
                                        <button class="btn save-token" type="button"><i class="fa fa-floppy-o"></i></button>
                                    </span>
                                </div>
                            </div>
                        </li>', 'api' => ['client_id', 'client_secret'], 'types' => 'text, links, images', 'categories' => false];
        
    }
    
    /**
     * The public method preview generates a preview for Vk.
     *
     * @param $args contains the img or url.
     * 
     * @return object with html content
     */
    public function preview($args) {
        
        return (object) [
                    'name' => 'vk',
                    'icon' => '<button type="button" class="btn btn-network-v"><i class="fa fa-vk"></i><span data-network="vk"><i class="fa fa-times"></i></span></button>',
                    'head' => '<li class="vk"><a href="#vk" data-toggle="tab"><i class="fa fa-vk"></i></a></li>',
                    'content' => '
		<div class="tab-pane" id="vk">
                <div class="vk forall">
                  <div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 clean"> <img src="https://vk.com/images/camera_200.png"> </div>
                  <div class="col-lg-11 col-md-11 col-sm-11 col-xs-12">
                    <h3>VK ID</h3>
                    <p class="prevtext"></p>
                  </div>
                </div>
              </div>'];
        
    }
    
}