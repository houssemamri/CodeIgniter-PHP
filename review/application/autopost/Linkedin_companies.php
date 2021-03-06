<?php
/**
 * Linkedin Companies
 *
 * PHP Version 5.6
 *
 * Connect and Publish to Linkedin Companies
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
 * Linkedin_companies class - allows users to connect to their Linkedin Companies and publish posts.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Linkedin_companies implements Autopost {

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
        
        // Get Linkedin client_id
        $this->client_id = get_option('linkedin_companies_client_id');
        
        // Get Linkedin client_secret
        $this->client_secret = get_option('linkedin_companies_client_secret');
        
        // Set redirect_url
        $this->redirect_uri = base_url() . 'user/callback/linkedin_companies';
        
        // Require the vendor autoload
        include_once FCPATH . 'vendor/autoload.php';
        
        try {
            
            // Call the Linkedin's class
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
        if( $this->CI->input->get('account', TRUE) ) {
            
            // Verify if account is valid
            if( is_numeric($this->CI->input->get('account', TRUE)) ) {
                
                $_SESSION['account'] = $this->CI->input->get('account', TRUE);
                
            }
            
        }
        
    }
    
    /**
     * The public method check_availability checks if the Linkedin Companies api is configured correctly.
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
     * The public method connect will redirect user to Linkedin login page.
     * 
     * @return void
     */
    public function connect() {
        
        // Get the redirect url
        $url = $this->connection->getLoginUrl(array('r_basicprofile', 'r_emailaddress', 'w_share', 'rw_company_admin'));
        
        // Redirect
        header('Location:' . $url);

    }
    
    /**
     * The public method save will get access token.
     *
     * @param void
     */
    public function save($token = null) {
       echo "gffgd";
	   die;
        // Verify if the code exists
        if ( $this->CI->input->get('code', TRUE) ) {
            
            // Get access token
            $token = $this->connection->getAccessToken( $this->CI->input->get('code', TRUE) );
            
            // Verify if token exists
            if ($token) {
                
                // Get expiration time
                $token_expires = $this->connection->getAccessTokenExpiration();
                
                // Get exiration time
                $expires = date('Y-m-d H:i:s', time() + $token_expires);
                
                // Get linkedin pages
                $curl = curl_init('https://api.linkedin.com/v1/companies?format=json&is-company-admin=true');
                curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ' . $token));
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $companies = json_decode(curl_exec($curl));
                curl_close($curl);
                
                // Verify if user has companies
                if ( @$companies->values ) {
                    
                    // Get user_id
                    $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
                    
                    // Verify if must be refreshed a token
                    if (isset($_SESSION['account']) ) {
                        
                        $acc = 0;
                        $act = $_SESSION['account'];
                        unset($_SESSION['account']);
                        if ( !is_numeric($act) ) {
                            exit();
                        } else {
                            
                            // Get user social account
                            $gat = $this->CI->networks->get_account($act);
                            
                            if($gat) {
                                $acc = $gat[0]->net_id;
                            }
                            
                        }
                        
                        // Connect pages or refresh tokens
                        $j = 0;
                        $b1 = 0;
                        for ($m = 0; $m < count($companies->values); $m++) {
                            
                            if ( $companies->values[$m]->id == $acc ) {
                                $j++;
                            }
                            
                            $acci = 0;
                            $gat = $this->CI->networks->get_account_field($this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']), $companies->values[$m]->id, 'network_id');
                            
                            if ( $gat ) {
                                
                                $acci = $gat;
                                
                            }
                            
                            if ( $acci ) {
                                
                                if ( $this->CI->networks->update_network($acci, $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']), date('Y-m-d H:i:s', strtotime('+60 days')), $token) ) {
                                    
                                    $b1++;
                                    
                                }
                                
                            } else {
                               
                                if ( $this->CI->networks->add_network('linkedin_companies', $companies->values[$m]->id, $token, $user_id, $expires, $companies->values[$m]->name, '', '') ) {
                                    
                                    $b1++;
                                    
                                }
                                
                            }
                        }
                        if ( $j > 0 ) {
                            
                            if ( $b1 > 0 ) {
                                
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
                    
                    for ( $y = 0; $y < count($companies->values); $y++ ) {
                        
                        $this->CI->networks->add_network('linkedin_companies', $companies->values[$y]->id, $token, $user_id, $expires, $companies->values[$y]->name, '', '');
                        
                    }
                    
                    $this->CI->session->set_flashdata('deleted', display_mess(107));
                    
                }
                
            }
            
        }
        
    }
    
    /**
     * The public method publishes posts on Linkedin Companies.
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
            $user_details = $this->CI->networks->get_network_data(strtolower('linkedin_companies'), $user_id, $args['account']);
            
        } else {
            
            $user_id = $this->CI->user->get_user_id_by_username($this->CI->session->userdata['username']);
            $user_details = $this->CI->networks->get_network_data(strtolower('linkedin_companies'), $user_id, $args['account']);
            
        }
        
        // Set visibility
        $object = ['visibility' => [
                'code' => 'anyone'
            ]
        ];
        
        // Verify if image is not empty
        if ( $args['img'] ) {
            
            // Verify if url exists
            if ( $args['url'] ) {
                
                $object['content'] = ['submitted-url' => $args['url'],'submitted-image-url' => $args['img']];
                
            } else {
                
                $object['content'] = ['submitted-url' => $args['img']];
                
            }
            
        } else {
            
            // Verify if url exists
            if ( $args['url'] ) {
                
                // Submit the url
                $object['content'] = ['submitted-url' => $args['url']];
                
            }
            
        }
        
        // Verify if title exists
        if ( $args ['title'] ) {
            
            $object['comment'] = mb_substr($args ['title'] . ' ' . $args['post'], 0, 699);
            
        } else {
            
            $object['comment'] = mb_substr($args['post'], 0, 699);
            
        }
        
        // Try to publish
        try {
            
            // Set access token
            $this->connection->setAccessToken($user_details[0]->token);
            
            // Publish
            $result = $this->connection->fetch('/companies/'.$user_details[0]->net_id.'/shares?format=json', $object, \LinkedIn\LinkedIn::HTTP_METHOD_POST, ['Authorization: Bearer' . $user_details[0]->token]);
            
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
     * @return object with network details
     */
    public function get_info() {
        
        // here you can add text that will be visible to user
        return (object) ['color' => '#eddb11', 'icon' => '<i class="fa fa-linkedin-square"></i>', 'rss' => true, 'api' => ['client_id', 'client_secret'], 'types' => 'text, links', 'categories' => false];
        
    }
    
    /**
     * The public method preview generates a preview for Linkedin Companies.
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
                    'name' => 'linkedin_companies',
                    'icon' => '<button type="button" class="btn btn-network-in"><i class="fa fa-linkedin-square"></i><span data-network="linkedin_companies"><i class="fa fa-times"></i></span></button>',
                    'head' => '<li class="linkedin_companies"><a href="#linkedin_companies" data-toggle="tab"><i class="fa fa-linkedin-square"></i></a></li>',
                    'content' => '<div class="tab-pane" id="linkedin_companies">
                                  <div class="facebook forall">' . $url . '<div>
                                  </div>'];
        
    }
}
