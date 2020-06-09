<?php
/**
 * Teams Controller
 *
 * PHP Version 5.6
 *
 * Teams contains the Teams Controller
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
 * Teams class - contains all methods for Teams
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Teams extends MY_Controller {
    
    private $user_id, $user_role;
    public function __construct() {
        parent::__construct();
        
        // Load form helper library
        $this->load->helper('form');
        
        // Load form validation library
        $this->load->library('form_validation');
        
        // Load User Model
        $this->load->model('user');
        
        // Load User Meta Model
        $this->load->model('user_meta');
        
        // Load Team Model
        $this->load->model('team');
        
        // Load Main Helper
        $this->load->helper('main_helper');
        
        // Load Fourth Helper
        $this->load->helper('fourth_helper');
        
        // Load Alerts Helper
        $this->load->helper('alerts_helper');
        
        // Load session library
        $this->load->library('session');
        
        // Load URL Helper
        $this->load->helper('url');
        
        // Load User Helper
        $this->load->helper('user_helper');
        
        // Load SMTP
        $config = smtp();
        
        // Load Sending Email Class
        $this->load->library('email', $config);
        
        if (isset($this->session->userdata['username'])) {
            
            // Set user_id
            $this->user_id = $this->user->get_user_id_by_username($this->session->userdata['username']);
            
            // Set user_role
            $this->user_role = $this->user->check_role_by_username($this->session->userdata['username']);
            
            // Set user_status
            $this->user_status = $this->user->check_status_by_username($this->session->userdata['username']);
            
        }
        
        // Verify if exist a customized language file
        if ( file_exists( APPPATH . 'language/' . $this->config->item('language') . '/default_alerts_lang.php' ) ) {
            
            // load the alerts language file
            $this->lang->load( 'default_alerts', $this->config->item('language') );
            
        }
        
        // Verify if exist a customized language file
        if ( file_exists( APPPATH . 'language/' . $this->config->item('language') . '/default_user_lang.php' ) ) {
            
            // load the admin language file
            $this->lang->load( 'default_user', $this->config->item('language') );
            
        }
        
    }
    
    /**
     * The public method team displays the user's team
     * 
     * @param integer $period contains the period of time
     * 
     * @return void
     */
    public function team() {
        
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        $this->check_unconfirmed_account();
        
        // Verify if is a team's member
        if ( $this->session->userdata( 'member' ) ) {
            redirect('user/home');
        } 
        
        // Verify if user can have a team
        if ( !plan_feature( 'teams' ) ) {
            
            // Redirect user to the Settings page
            redirect( '/user/settings' );
            
        }
        
        // Get statistics template
        $this->body = 'user/teams';
        $this->user_layout();
        
    }
    
    /**
     * The public method team_settings manages user's team
     * 
     * @param integer $page is the page number
     * 
     * @return void
     */
    public function show_members( $page ) {
        
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        
        // Verify if user can have a team
        if ( !plan_feature( 'teams' ) ) {
            
            exit();
            
        }
        
        // Verify if is a team's member
        if ( $this->session->userdata( 'member' ) ) {
            exit();
        } 
        
        // Set the limit
        $limit = 10;
        $page--;
        
        // Count number of members
        $total = $this->team->get_members($this->user_id);
        
        // Get members
        $get_members = $this->team->get_members( $this->user_id, $page * $limit, $limit );
        
        // If members exists
        if ( $get_members ) {
            
            $data = ['total' => $total, 'date' => time(), 'members' => $get_members];
            echo json_encode($data);
            
        }
    }
    
    /**
     * The public method team_settings manages user's team
     * 
     * @param string $action contains the action's param
     * @param string $param contains the second url param
     * 
     * @return void
     */
    public function team_settings( $action, $param = NULL ) {
        
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        
        // Verify if user can have a team
        if ( !plan_feature( 'teams' ) ) {
            
            exit();
            
        }
        
        // Verify if is a team's member
        if ( $this->session->userdata( 'member' ) ) {
            exit();
        } 
        
        // Verify what kind of action is this
        if ( $action == 'new-member' ) {
            
            // Check if data was submitted
            if ($this->input->post()) {
                
                // Check if username and password is not empty
                if ( ($this->input->post('username') == '') || ($this->input->post('username') == 'm_') || ($this->input->post('password') == '') ) {
                    
                    // If username or password is empty will display the error
                    display_mess(12);
                    
                } else {
                    
                    // Add form validation
                    $this->form_validation->set_rules('username', 'Username', 'trim|min_length[6]|required');
                    $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|required');
                    
                    // Get data
                    $username = $this->input->post('username');
                    $password = $this->input->post('password');
                    
                    // Check form validation
                    if ($this->form_validation->run() == false) {
                        
                        // Display error
                        display_mess(13);
                        
                    } else {
                        
                        // Save the member
                        if ( $this->team->save_member( $this->user_id, $username, $password ) ) {
                            
                            // Display success message
                            display_mess(138);                            
                            
                        } else {
                            
                            // Display error message
                            display_mess(139);                            
                            
                        }

                    }

                }

            }
            
        } else if ( $action == 'member' ) {
            
            // Get member details
            $get_member = $this->team->get_member( $this->user_id, $param );
            if ( $get_member ) {
                
                echo json_encode( [ $get_member, 'date' => time() ] );
                
            }
            
        } else if ( $action == 'delete' ) {
            
            // Delete member
            $get_member = $this->team->delete_member( $this->user_id, $param );
            if ( $get_member ) {
                
                echo json_encode( 1 );
                
            }
            
        } else if ( $action == 'update' ) {
            
            // Check if data was submitted
            if ($this->input->post()) {
                
                // Check if password is not empty
                if ( $this->input->post('password') == '' ) {
                    
                    // If username or password is empty will display the error
                    display_mess(12);
                    
                } else {
                    
                    // Add form validation
                    $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|required');
                    $this->form_validation->set_rules('member_id', 'Member ID', 'integer');
                    
                    // Get data
                    $password = $this->input->post('password');
                    $member_id = $this->input->post('member_id');
                    
                    // Check form validation
                    if ($this->form_validation->run() == false) {
                        
                        // Display error
                        display_mess(13);
                        
                    } else {
                        
                        // Save the member
                        if ( $this->team->update_member( $this->user_id, $member_id, $password ) ) {
                            
                            // Display success message
                            display_mess(140);                            
                            
                        } else {
                            
                            // Display error message
                            display_mess(141);                            
                            
                        }

                    }

                }

            }
            
        }
        
    } 
    
    /**
     * The function check_unconfirmed_account checks if the current user's account is confirmed
     * 
     * @return void
     */
    protected function check_unconfirmed_account() {
        
        // This function verifies if user has a confirmed account
        if ($this->user_status == 0) {
            
            redirect('/user/unconfirmed-account');
            
        }
        
    }
}

/* End of file Teams.php */
