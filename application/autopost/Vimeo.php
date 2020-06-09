<?php
/**
 * Vimeo
 *
 * PHP Version 5.6
 *
 * Connect and Publish to Vimeo
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

use Vimeo\Exceptions\VimeoUploadException;

/**
 * Vimeo class - allows users to connect to their Vimeo and publish posts.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Vimeo implements Autopost {

    /**
     * Class variables
     */
    protected $CI, $check, $params, $redirect_uri, $client_id, $client_secrets;

    /**
     * Load networks and user model.
     */
    public function __construct() {
        
        // Get the CodeIgniter super object
        $this->CI = & get_instance();
        
        // Get Vimeo redirect
        $this->redirect_uri = base_url() . 'user/callback/vimeo';
        
        // Verify if the Vimeo's library exists
        if ( file_exists( FCPATH . 'vendor/vm/autoload.php' ) ) {
            
            // Require the Vimeo's library
            include_once FCPATH . 'vendor/vm/autoload.php';
            
        }
        
    }

    /**
     * The public method check_availability check if the Vimeo api is configured correctly.
     *
     * @return boolean true or false
     */
    public function check_availability() {
        
        // Verify if the Vimeo's library exists
        if (file_exists(FCPATH . 'vendor/vm/autoload.php')) {
            
            return true;
            
        } else {
            
            return false;
            
        }
        
    }

    /**
     * The public method connect will redirect user to Vimeo login page.
     * 
     * @return void
     */
    public function connect() {
        
        // Check if data was submitted
        if ($this->CI->input->post()) {
            
            // Add form validation
            $this->CI->form_validation->set_rules('client_identifier', 'Client Identifier', 'trim|required');
            $this->CI->form_validation->set_rules('client_secrets', 'Client Secrets', 'trim|required');
            
            // Get post's data
            $client_identifier = $this->CI->input->post('client_identifier');
            $client_secrets = $this->CI->input->post('client_secrets');
            
            // Verify if form's data is valid
            if ($this->CI->form_validation->run() == false) {
                
                display_mess(45);
                
            } else {
                
                // Create the session variables
                $_SESSION['client_identifier'] = $client_identifier;
                $_SESSION['client_secrets'] = $client_secrets;
                
                // Get redirect
                $loginUrl = 'https://api.vimeo.com/oauth/authorize?response_type=code&client_id='.$_SESSION['client_identifier'].'&redirect_uri='.$this->redirect_uri.'&scope=public+private+upload+edit&state=12345';
                
                // Redirect
                header('Location:' . $loginUrl);
                
            }
            
        } else {
            
            // Display the login form
            echo get_instance()->ecl('Social_login')->content('Client Identifier', 'Client Secrets', 'Connect', $this->get_info(), 'vimeo', $this->CI->lang->line('mu215'), '');
            
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
        
        // Call the Vimeo class
        $lib = new \Vimeo\Vimeo($_SESSION['client_identifier'], $_SESSION['client_secrets']);
        
        // Get access token
        $data = $lib->accessToken($_GET['code'], $this->redirect_uri);
        
        // Verify if access token exists
        if ( @$data['body']['access_token'] ) {
            
            // Get access token
            $token = $data['body']['access_token'];
            
            // Get user name
            $name = $data['body']['user']['name'];
            
            // Get user ID
            $net_id = str_replace('/users/', '', $data['body']['user']['uri']);
            
            // Get user_id
            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            
            // Verify if the account was already saved
            if ( $this->CI->networks->check_account_was_added('vimeo', $net_id, $user_id)) {
                
                $this->CI->session->set_flashdata('deleted', display_mess(79, 'Vimeo') );
                
            } else {
                
                $this->CI->session->set_flashdata('deleted', display_mess(80));
                $this->CI->networks->add_network('vimeo', $net_id, $token, $user_id, '', $name, '', '', $_SESSION['client_identifier'], $_SESSION['client_secrets']);
                
            }
            
        }
        
    }

    /**
     * The public method post publishes posts on Vimeo.
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
            $user_details = $this->CI->networks->get_network_data(strtolower('vimeo'), $user_id, $args['account']);
            
        } else {
            
            // Get the user ID
            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            $user_details = $this->CI->networks->get_network_data(strtolower('vimeo'), $user_id, $args['account']);
            
        }
        
        // If user has the social account
        if ($user_details) {
            
            try {
                $lib = new \Vimeo\Vimeo($user_details[0]->api_key, $user_details[0]->api_secret, $user_details[0]->token);
                
                // Get the video
                $video = str_replace(base_url(), FCPATH, $args['video']);
                
                // Upload the video
                $uri = $lib->upload($video);
                
                // Get video url
                $up = $lib->request($uri);
                
                // Verify if title is not empty
                if ( $args ['title'] ) {
                    
                    $vidu = ['name' => $args['title'], 'description' => $args['post']];
                    
                } else {
                    
                    $vidu = ['name' => $args['post']];
                    
                }
                
                // Publish the video
                if ($up) {
                    
                    $response = $lib->request($up['body']['uri'], $vidu, 'PATCH');
                    
                    if ( $response ) {
                        
                        return true;
                        
                    } else {
                        
                        return false;
                        
                    }
                    
                }
                
            } catch (Exception $e) {

                // Save the error
                $this->CI->user_meta->update_user_meta($user_id, 'last-social-error', $e->getMessage());

                // Then return falsed
                return false;

            }
        }
    }

    /**
     * The public method get_info displays information about this class.
     * 
     * @return object with network's data
     */
    public function get_info() {
        
        return (object) ['color' => '#44bbff', 'icon' => '<i class="fa fa-vimeo" aria-hidden="true"></i>', 'rss' => false, 'api' => [], 'types' => 'text, links, videos', 'categories' => false];
        
    }

    /**
     * The public method preview generates a preview for Vimeo.
     *
     * @param array $args contains the img or url.
     * 
     * @return object with html content
     */
    public function preview($args) {
        
        if ( filter_var($args['video'], FILTER_VALIDATE_URL) ) {
            
            $video = '<div>
                        <p class="previmg"><video controls="true" style="width:100%;height:300px"><source src="' . $args["video"] . '" type="video/mp4" /></video></p>
                        <p class="prevtext"></p>
                    </div>';
            
        } else {
            
            return (object) ['info' => '<div class="col-lg-12 merror"><p><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> ' . display_mess(130) . '</p></div>'];
            
        }
        
        return (object) [
                    'name' => 'vimeo',
                    'icon' => '<button type="button" class="btn btn-network-vi"><i class="fa fa-vimeo"></i><span data-network="vimeo"><i class="fa fa-times"></i></span></button>',
                    'head' => '<li class="vimeo"><a href="#vimeo" data-toggle="tab"><i class="fa fa-vimeo"></i></a></li>',
                    'content' => '<div class="tab-pane" id="youtube">
                                      <div class="vimeo forall">
                                              ' . $video . '
                                          </div>
                                      </div>'
        ];
        
    }

}
