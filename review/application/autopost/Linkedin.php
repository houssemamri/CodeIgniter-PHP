<?php
/**
 * Linkedin
 *
 * PHP Version 5.6
 *
 * Connect and Publish to Linkedin
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
 * Linkedin class - allows users to connect to their Linkedin Account and publish posts.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Linkedin implements Autopost {

    /**
     * Class variables
     */
    protected $CI, $connection, $redirect_uri, $client_id, $client_secret;

    /**
     * Load networks and user model.
     */
    public function __construct() {
        
        // Get the CodeIgniter super object
        $this->CI = & get_instance();
        
        // Get the Linkedin's client_id
        $this->client_id = get_option('linkedin_client_id');
        
        // Get the Linkedin's client_secret
        $this->client_secret = get_option('linkedin_client_secret');
        
        // Set redirect_url
        $this->redirect_uri = base_url() . 'user/callback/linkedin';
        
        // Require the vendor autoload
        include_once FCPATH . 'vendor/autoload.php';
        
        try {
            
            // Call the Linkedin Class
            $this->connection = new \LinkedIn\LinkedIn(
                [
                    'api_key' => $this->client_id,
                    'api_secret' => $this->client_secret,
                    'callback_url' => $this->redirect_uri,
                ]
            );
            
        } catch (Exception $e) {
            
            return false;
            
        }
        
        // Get account if exsts
        if ( $this->CI->input->get('account', TRUE) ) {
            
            // Verify if account is valid
            if ( is_numeric($this->CI->input->get('account', TRUE) ) ) {
                
                // Create the session account
                $_SESSION['account'] = $this->CI->input->get('account', TRUE);
                
            }
            
        }
        
    }

    /**
     * The public method check_availability checks if the Linkedin api is configured correctly.
     *
     * @return boolean true or false
     */
    public function check_availability() {
        
        // Verify if client_id or client_secret is empty
        if ( ($this->client_id != '') AND ( $this->client_secret != '') ) {
            
            return true;
            
        } else {
            
            return false;
            
        }
    }

    /**
     * The public method connect will redirect user to Linkedin login page.
     * 
     * @return void
     */
    public function connect() {
        
        // Get redirect url
        $url = $this->connection->getLoginUrl(array('r_basicprofile', 'r_emailaddress', 'w_share'));
        
        // Redirect
        header('Location:' . $url);
            
    }

    /**
     * The public method save will get access token.
     *
     * @param string $token contains the token for some social networks
     * 
     * @return void
     */
    public function save( $token = null ) {
        
        // Verify if the code exists
        if ( $this->CI->input->get('code', TRUE) ) {
            
            // Get access token
            $token = $this->connection->getAccessToken( $this->CI->input->get('code', TRUE) );
            
            // Verify if token exists
            if ( $token ) {
                
                // Get expiration time
                $token_expires = $this->connection->getAccessTokenExpiration();
                
                // Set access token
                $this->connection->setAccessToken($token);
                
                // Get profile information
                $udata = $this->connection->get('/people/~:(id,first-name,lastName,email-address,headline,positions:(title,company:(name,id)))');
                
                // Verify if data exists
                if ( $udata ) {
                    
                    // Get first and last name
                    $name = @$udata['firstName'] . ' ' . @$udata['lastName'];
                    
                    // Get profile id
                    $id = @$udata['id'];
                    
                    // Get user_id
                    $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
                    
                    // Get exiration time
                    $expires = date('Y-m-d H:i:s', time() + $token_expires);
                    
                    // Verify if we have to renew account
                    if ( isset($_SESSION['account']) ) {
                        
                        $acc = 0;
                        $act = $_SESSION['account'];
                        unset($_SESSION['account']);
                        
                        // Verify if account is valid
                        if ( !is_numeric($act) ) {
                            
                            exit();
                            
                        } else {
                            
                            // Get account's data
                            $gat = $this->CI->networks->get_account($act);
                            
                            if ($gat) {
                                
                                $acc = $gat[0]->net_id;
                                
                            }
                            
                        }
                        
                        // Verify if user is loggen in correct account
                        if ( $id == $acc ) {
                            
                            // Refresh the token
                            if ($this->CI->networks->update_network($act, $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']), date('Y-m-d H:i:s', strtotime('+60 days')), $token)) {
                                
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
                    
                    // Verify if account was already saved
                    if ( !$this->CI->networks->get_network_data('linkedin', $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']), $id) ) {
                        
                        $this->CI->session->set_flashdata('deleted', display_mess(80));
                        $this->CI->networks->add_network('linkedin', $id, $token, $user_id, $expires, $name, '', '');
                        
                    } else {
                        
                        $this->CI->session->set_flashdata('deleted', display_mess(79, 'Linkedin'));
                        
                    }
                    
                }
                
            }
            
        }
        
    }

    /**
     * The public method post publishes posts on Linkedin.
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
            $user_details = $this->CI->networks->get_network_data(strtolower('linkedin'), $user_id, $args['account']);
            
        } else {
            
            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            $user_details = $this->CI->networks->get_network_data(strtolower('linkedin'), $user_id, $args['account']);
            
        }
        
        // Post visibility
        $object = ['visibility' => [
                'code' => 'anyone'
            ]
        ];
        
        // Verify if the image is not empty
        if ( $args['img'] ) {
            
            // Verify if the url is not empty
            if ( $args['url'] ) {
                
                $object['content'] = ['submitted-url' => $args['url'], 'submitted-image-url' => $args['img']];
                
            } else {
                
                $object['content'] = ['submitted-url' => $args['img']];
                
            }
            
        } else {
            
            if ( $args['url'] ) {
                
                $object['content'] = ['submitted-url' => $args['url']];
                
            }
            
        }
        
        // Verify if title exists
        if ( $args ['title'] ) {
            
            $object['comment'] = mb_substr($args ['title'] . ' ' . $args['post'], 0, 699);
            
        } else {
            
            $object['comment'] = mb_substr($args['post'], 0, 699);
            
        }
        
        try {
            
            // Set access token
            $this->connection->setAccessToken($user_details[0]->token);
            
            // Publish
            $result = $this->connection->fetch('/people/~/shares?format=json', $object, \LinkedIn\LinkedIn::HTTP_METHOD_POST, ['Authorization: Bearer' . $user_details[0]->token]);
            
            if ( $result ) {
                
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

    /**
     * The public method get_info displays information about this class.
     * 
     * @return object with network's data
     */
    public function get_info() {
        
        // here you can add text that will be visible to user
        return (object) ['color' => '#eddb11', 'icon' => '<i class="fa fa-linkedin"></i>', 'rss' => true, 'api' => ['client_id', 'client_secret'], 'types' => 'text, links', 'categories' => false];
        
    }

    /**
     * This function generates a preview for Linkedin.
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
        
        return (object) [
                    'name' => 'linkedin',
                    'icon' => '<button type="button" class="btn btn-network-in"><i class="fa fa-linkedin"></i><span data-network="linkedin"><i class="fa fa-times"></i></span></button>',
                    'head' => '<li class="linkedin"><a href="#linkedin" data-toggle="tab"><i class="fa fa-linkedin"></i></a></li>',
                    'content' => '<div class="tab-pane" id="linkedin">
                                  <div class="facebook forall">' . $url . '<div>
                                  </div>'];
        
    }

}
