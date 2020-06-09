<?php
/**
 * Auth Controller
 *
 * PHP Version 5.6
 *
 * Auth contains the Auth class for login, signup and password reset
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
 * Userarea class - contains all metods and pages for user account.
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
		
		
        // Load form helper library
        $this->load->helper('form');
        // Load form validation library
        $this->load->library('form_validation');
        // Load User Model
        $this->load->model('user');
        // Load Options Model
        $this->load->model('options');
        // Load Networks Model
        $this->load->model('networks');
        // Load Notifications Model
        $this->load->model('notifications');
        // Load Main Helper
        $this->load->helper('main_helper');
        // Load Alerts Helper
        $this->load->helper('alerts_helper');
        // Load session library
        $this->load->library('session');
        // Load SMTP
        $config = smtp();
        // Load Sending Email Class
        $this->load->library('email', $config);
        // Load URL Helper
        $this->load->helper('url');
        
        // Load language
        if ( file_exists( APPPATH . 'language/' . $this->config->item('language') . '/default_auth_lang.php') ) {
            $this->lang->load('default_auth', $this->config->item('language'));
        }
        if( file_exists( APPPATH . 'language/' . $this->config->item('language') . '/default_alerts_lang.php') ){
            $this->lang->load('default_alerts', $this->config->item('language'));
        }
    }

    /**
     * The function index displays the login page
     */
    public function index() {
		
		
	
		
        // Check if session exists
        $this->check_session_auth();
        if (defined('cron')) {
            return false;
        }
        // Get all available social networks.
        include_once APPPATH . 'interfaces/Login.php';
        $classes = [];
        $formobile = [];
        // Get all options
        $options = $this->options->get_all_options();
        if (isset($options['social-signup'])) {
            foreach (glob(APPPATH . 'login/*.php') as $filename) {
                include_once $filename;
                $className = str_replace([APPPATH . 'login/', '.php'], '', $filename);
                $get = new $className;
                if ($get->check_availability()) {
                    $classes[] = '<div class="row no-mobile">
                                     <div class="col-lg-12">
                                         <a href="' . site_url() . 'login/' . strtolower($className) . '" class="btn btn-labeled btn-' . strtolower($className) . '">'.$this->lang->line('m44').' ' . ucfirst($className) . '</a>
                                     </div>
                                 </div>';
                    $formobile[] = '<div class="col-xs-3 col-sm-3 for-mobile">
                                        <a href="' . site_url() . 'login/' . strtolower($className) . '" class="btn btn-labeled btn-' . strtolower($className) . '">' . $get->icon . '</a>
                                    </div>';
                }
            }
        }
		
		
        // Load view/auth/auth file
        $this->load->view('auth/auth', ['data' => $classes, 'formobile' => $formobile, 'signup' => isset($options['enable-registration']) ? 1 : 0]);
    }

    /**
     * The function signin allows to login in user or admin account
     */
    public function signin() {
		
		
		
		
        
        // Check if user was blocked
       // $this->check_block();
        
        // Load Team Model
        $this->load->model('team');
        
        // Check if data was submitted
        if ($this->input->post()) {
          
            // Check if username and password is not empty
            if (($this->input->post('username') == '') || ($this->input->post('password') == '')) {
                
                display_mess(12);
                
            } else {
                
                // Add form validation
                $this->form_validation->set_rules('username', 'Username', 'trim|min_length[6]|required');
                $this->form_validation->set_rules('password', 'Password', 'trim|min_length[6]|required');
                $this->form_validation->set_rules('remember', 'Remember', 'integer');
                
                // Get data
                $username = $this->input->post('username');
                $password = $this->input->post('password');
                $remember = $this->input->post('remember');
                
                // Check form validation
                if ($this->form_validation->run() == false) {
                    
                    display_mess(13);
                    
                } else {
                    
                    // Verify if the user is member of a team
                    if ( preg_match( '/m_/i', $username ) ) {
                        
                        // Get the team's owner
                        $team_owner = $this->team->check($username, $password);

                        if ( $team_owner ) {

                            // Create the session
                            $this->session->set_userdata( 'username', $team_owner );

                            // Create the team's member session
                            $this->session->set_userdata( 'member', $username );

                            // If remember me are unckecked the session will be deleted after two hours
                            if ($remember == 0) {

                                $this->session->set_userdata('autodelete', time() + 7200);

                            }

                            // If block session exists will be removed
                            if ($this->session->userdata('block_user')) {

                                $this->session->unset_userdata('block_user');

                            }

                            display_mess(14);

                        } else {

                            $this->block_count();
                            display_mess(15);

                        }
                        
                    } else {
                    
                        // Check if user and password exists
                        if ($this->user->check($username, $password)) {

                            // First we check if the user account was blocked
                            if ($this->user->check_status_by_username(strtolower($username)) == 2) {

                                display_mess(77);

                            } else {

$user_id=$this->user->get_user_id_by_username(strtolower($username));

$email=$this->user->get_email_by('username' , strtolower($username));
$role=$this->user->check_role_by_username(strtolower($username));

$this->session->set_userdata('username', strtolower($username));

$this->session->set_userdata('user_name', strtolower($username));
$this->session->set_userdata('global_status', true);
$this->session->set_userdata('master_id', $user_id);
$this->session->set_userdata('user_id', $user_id);
$this->session->set_userdata('user_email', strtolower($email));
 $this->session->set_userdata('language','fr');

               
       if($role==1)
      {
       
     $this->session->set_userdata('admin_status',1);
      }
      else
      {
        $this->session->set_userdata('user_status',1);
        
      }
	  
/* 	print_r($this->session->all_userdata());
	die; */
			                 /* $_SESSION['user_id']=$row['id'];
			  			    $_SESSION['user_email']=$row['email']; */
                                // If remember me are unckecked the session will be deleted after two hours
                                if ($remember == 0) {

                                    $this->session->set_userdata('autodelete', time() + 7200);

                                }

                                /* if ($this->session->userdata('block_user')) {

                                    $this->session->unset_userdata('block_user');

                                } */

                                display_mess(14);

                            }

                        } else {

                            $this->block_count();
                            display_mess(15);

                        }
                    }
                }
            }
        }
    }

    /**
     * The function passwordreset displays the password reset page
     */
    public function passwordreset() {
        // Check if session exists
        $this->check_session_auth();
        // Load view/auth/password-resset file
        $this->load->view('auth/password-reset');
    }

    /**
     * The function terms displays the terms page
     */
    public function terms() {
        $this->load->view('auth/terms');
    }

    /**
     * The function privacy displays the privacy page
     */
    public function privacy() {
        $this->load->view('auth/privacy');
    }

    /**
     * The function report_bug displays the report bug page
     */
    public function report_bug() {
        // Displays report a bug page
        $msg = '';
        if ($this->input->post()) {
            // Add form validation
            $this->form_validation->set_rules('subject', 'Subject', 'trim|required');
            $this->form_validation->set_rules('description', 'description', 'trim|required');
            $this->form_validation->set_rules('g-recaptcha-response', 'Catcha', 'trim|required');
            // Get data
            $subject = $this->input->post('subject');
            $description = $this->input->post('description');
            $g_recaptcha_response = $this->input->post('g-recaptcha-response');
            // Check form validation
            if ($this->form_validation->run() == false) {
                $msg = display_mess(25);
            } else {
                // Check if the catcha code is valid
                $curl = curl_init('https://www.google.com/recaptcha/api/siteverify');
                curl_setopt($curl, CURLOPT_POST, true);
                curl_setopt(
                        $curl, CURLOPT_POSTFIELDS, [
                    'secret' => $this->config->item('captcha_secret_key'), // Add the captcha variable in your config file $config['captcha_secret_key'] = ''; with the secret catcha code
                    'response' => $g_recaptcha_response // The catcha response
                        ]
                );
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
                $auth = curl_exec($curl);
                $response = json_decode($auth);
                if (@$response->success) {
                    $this->email->from($this->config->item('contact_mail'), $this->config->item('site_name'));
                    $this->email->to($this->config->item('notification_mail'));
                    $this->email->subject($subject);
                    $this->email->message($description);
                    if ($this->email->send()) {
                        $msg = display_mess(51);
                    } else {
                        $msg = display_mess(25);
                    }
                }
            }
        }
        $this->load->view('auth/report-bug', ['msg' => $msg]);
    }

    /**
     * The function password_reset will reset the password
     */
    public function password_reset() {
        // Check if data was submitted
        if ($this->input->post()) {
            // Add form validation
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
            // Get data
            $email = $this->input->post('email');
            if ($this->form_validation->run() == false) {
                display_mess(16);
            } else {
                // Check if email address exists in database
                if ($this->user->check_email($email)) {
                    // Get username
                    $username = 'User';
                    $getUsername = $this->user->get_username_by_email($email);
                    if ($getUsername) {
                        $username = $getUsername;
                    }
                    $reset = time();
                    $add_reset = $this->user->add_code($email, $reset, 'reset_code');
                    // Send password reset confirmation email
                    if ($add_reset) {
                        // Will be send the password-reset notification template to the current user
                        $args = ['[username]' => $username, '[site_name]' => $this->config->item('site_name'), '[reset_link]' => '<a href="' . $this->config->base_url() . 'new-password?reset=' . $reset . '&f=' . $add_reset . '">' . $this->config->base_url() . 'new-password?reset=' . $reset . '&f=' . $add_reset . '</a>', '[login_address]' => '<a href="' . $this->config->item('login_url') . '">' . $this->config->item('login_url') . '</a>', '[site_url]' => '<a href="' . $this->config->base_url() . '">' . $this->config->base_url() . '</a>'];
                        $template = $this->notifications->get_template('password-reset', $args);
                        // Check if the template exists
                        if ($template) {
                            $this->email->from($this->config->item('contact_mail'), $this->config->item('site_name'));
                            $this->email->to($email);
                            $this->email->subject($template['title']);
                            $this->email->message($template['body']);
                            if ($this->email->send()) {
                                display_mess(17);
                            } else {
                                display_mess(18);
                            }
                        } else {
                            display_mess(18);
                        }
                    } else {
                        display_mess(19);
                    }
                } else {
                    display_mess(20);
                }
            }
        }
    }

    /**
     * The function new_password displays the change password page
     */
    public function new_password() {
        // Check if session exists
        $this->check_session_auth();
        $reset = $this->input->get('reset', true);
        $f = $this->input->get('f', true);
        $changed = false;
        if (is_numeric($reset) AND is_numeric($f)) {
            // Check if reset code is valid
            if (!$this->user->check_reset_code($reset, $f)) {
                echo display_mess(26);
                die();
            }
            $data = '';
            if ($this->input->post()) {
                // Add form validation
                $this->form_validation->set_rules('password', 'Password', 'trim|required');
                $password = trim($this->input->post('password'));
                $password2 = trim($this->input->post('password2'));
                if ($password != $password2) {
                    $data = display_mess(21);
                } else {
                    if (strlen($password) < 6) {
                        $data = display_mess(22);
                    } elseif (preg_match('/\s/', $password)) {
                        $data = display_mess(23);
                    } else {
                        if ($this->user->password_changed($password, $reset, $f)) {
                            $changed = true;
                            $data = display_mess(24);
                        } else {
                            $data = display_mess(25);
                        }
                    }
                }
            }
            // Load view/auth/new-password file
            $this->load->view('auth/new-password', ['msg' => $data, 'changed' => $changed]);
        } else {
            echo display_mess(26);
            die();
        }
    }

    /**
     * The function signup displays the signup page
     */
    public function signup() {
        $username = '';
        $data = '';
        // Check if session exists
        $this->check_session_auth();
        $userdata = $this->session->flashdata('userdata');
        if ($userdata) {
            if (($userdata['id'] != '') AND ( $userdata['email'] != '')) {
                // Check if username exists and login automatically
                if ($this->user->check_username($userdata['id'])) {
                    if ($this->user->get_user_id_by_username($userdata['id'])) {
                        $this->user->last_access($this->user->get_user_id_by_username($userdata['id']));
                    }
                    $this->session->set_userdata('username', $userdata['id']);
                    $this->session->set_userdata('autodelete', time() + 7200);
                    redirect('/user/home');
                }
                if (!$this->user->check_email($userdata['email'])) {
                    if ($this->user->signup($userdata['id'], $userdata['email'], time(), 1)) {
                        if (!get_option('facebook_user_api_key')) {
                            $this->networks->add_network($userdata['network'], $userdata['net_id'], $userdata['access_token'], $this->user->get_user_id_by_username($userdata['id']), date('Y-m-d H:i:s', strtotime('+60 days')), $userdata['name'], $userdata['photo'], @$userdata['secret']);
                        }
                        if ($this->user->get_user_id_by_username($userdata['id'])) {
                            $this->user->last_access($this->user->get_user_id_by_username($userdata['id']));
                        }
                        $this->session->set_userdata('username', $userdata['id']);
                        $this->session->set_userdata('autodelete', time() + 7200);
                        redirect('/user/home');
                    } else {
                        $data = display_mess(27);
                    }
                } else {
                    $data = display_mess(28);
                }
            } else {
                if ($userdata['id']) {
                    if ($this->user->check_username($userdata['id'])) {
                        if ($this->user->get_user_id_by_username($userdata['id'])) {
                            $this->user->last_access($this->user->get_user_id_by_username($userdata['id']));
                        }
                        $this->session->set_userdata('username', $userdata['id']);
                        $this->session->set_userdata('autodelete', time() + 7200);
                        redirect('/user/home');
                    }
                } else {
                    $data = display_mess(29);
                }
            }
            if ($userdata['email'] == null) {
                $data = display_mess(30);
            }
        }
        $error = $this->session->flashdata('error');
        if ($error) {
            $data = '<p class="merror block">' . $error . '</p>';
        }
        // Get all available social networks.
        include_once APPPATH . 'interfaces/Login.php';
        $classes = [];
        $formobile = [];
        // Get all options
        $options = $this->options->get_all_options();
        if (isset($options['social-signup'])) {
            foreach (glob(APPPATH . 'login/*.php') as $filename) {
                include_once $filename;
                $className = str_replace([APPPATH . 'login/', '.php'], '', $filename);
                $get = new $className;
                if ($get->check_availability()) {
                    $classes[] = '<div class="row no-mobile">
                                      <div class="col-lg-12">
                                          <a href="' . site_url() . 'login/' . strtolower($className) . '" class="btn btn-labeled btn-' . strtolower($className) . '">'.$this->lang->line('m44').' ' . ucfirst($className) . '</a>
                                      </div>
                                  </div>';
                    $formobile[] = '<div class="col-xs-3 col-sm-3 for-mobile">
                                        <a href="' . site_url() . 'login/' . strtolower($className) . '" class="btn btn-labeled btn-' . strtolower($className) . '">' . $get->icon . '</a>
                                    </div>';
                }
            }
        }
        if (isset($options['enable-registration'])) {
            // Load view/auth/signup file
            $this->load->view('auth/signup', ['msg' => $data, 'formobile' => $formobile, 'username' => $username, 'data' => $classes]);
        }
    }

    /**
     * The function register will save user data to database
     */
    public function register() {
        // Check if data was submitted
        if ($this->input->post()) {
            // Check if ip and registration limit exists
            // If you want remove ip limit just remove the if bellow
            if ($this->options->check_enabled('signup_limit')) {
                if ($this->user->check_ip_and_date() == 1) {
                    display_mess(31);
                    exit();
                }
            } else {
                if ($this->user->check_ip_and_date() > 0) {
                    display_mess(32);
                    exit();
                }
            }
            // Add form validation
            $this->form_validation->set_rules('username', 'Username', 'trim|required|alpha_dash');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|valid_email|required');
            // Get data
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $email = $this->input->post('email');
            // Check form validation
            if ($this->form_validation->run() == false) {
                display_mess(33);
            } else {
                // Check if the password has less than six characters
                if ((strlen($username) < 6) || (strlen($password) < 6)) {
                    display_mess(34);
                } elseif (preg_match('/\s/', $username) || preg_match('/\s/', $password)) {
                    // Check if the username or password contains white spaces
                    display_mess(35);
                } elseif ($this->user->check_email($email)) {
                    // Check if the email address are present in our database
                    display_mess(36);
                } elseif ($this->user->check_username($username)) {
                    // Check if the username are present in our database
                    display_mess(37);
                } else {
                    if ($this->user->signup($username, $email, $password)) {
                        // Check if admin want to receive a notification about new users
                        if ($this->options->check_enabled('enable-new-user-notification')) {
                            // Get the new-user-notification notification template and send it
                            $args = ['[username]' => $username, '[site_name]' => '<a href="' . $this->config->base_url() . '">' . $this->config->item('site_name') . '</a>', '[login_address]' => '<a href="' . $this->config->item('login_url') . '">' . $this->config->item('login_url') . '</a>', '[site_url]' => '<a href="' . $this->config->base_url() . '">' . $this->config->base_url() . '</a>'];
                            $template = $this->notifications->get_template('new-user-notification', $args);
                            if ($template) {
                                $this->email->from($this->config->item('contact_mail'), $this->config->item('site_name'));
                                $this->email->to($this->config->item('notification_mail'));
                                $this->email->subject($template['title']);
                                $this->email->message($template['body']);
                                $this->email->send();
                            }
                        }
                        // Check if sign up need confirm
                        if ($this->options->check_enabled('signup_confirm')) {
                            $activate = time();
                            // Save activation code in user's information from database
                            $add_activate = $this->user->add_code($email, $activate, 'activate');
                            // Get the welcome-message-with-confirmation notification template and send it
                            $args = ['[username]' => $username, '[site_name]' => $this->config->item('site_name'), '[confirmation_link]' => '<a href="' . $this->config->base_url() . 'activate?code=' . $activate . '&f=' . $add_activate . '">' . $this->config->base_url() . 'activate?code=' . $activate . '&f=' . $add_activate . '</a>', '[login_address]' => '<a href="' . $this->config->item('login_url') . '">' . $this->config->item('login_url') . '</a>', '[site_url]' => '<a href="' . $this->config->base_url() . '">' . $this->config->base_url() . '</a>'];
                            $template = $this->notifications->get_template('welcome-message-with-confirmation', $args);
                            if ($template) {
                                $this->email->from($this->config->item('contact_mail'), $this->config->item('site_name'));
                                $this->email->to($email);
                                $this->email->subject($template['title']);
                                $this->email->message($template['body']);
                                if ($this->email->send()) {
                                    display_mess(38);
                                } else {
                                    display_mess(18);
                                }
                            } else {
                                display_mess(18);
                            }
                        } else {
                            // Display successfully message 
                            display_mess(39);
                            // Get the welcome-message-no-confirmation notification template and send it
                            $args = ['[username]' => $username, '[site_name]' => $this->config->item('site_name'), '[login_address]' => '<a href="' . $this->config->item('login_url') . '">' . $this->config->item('login_url') . '</a>', '[site_url]' => '<a href="' . $this->config->base_url() . '">' . $this->config->base_url() . '</a>'];
                            $template = $this->notifications->get_template('welcome-message-no-confirmation', $args);
                            if ($template) {
                                $this->email->from($this->config->item('contact_mail'), $this->config->item('site_name'));
                                $this->email->to($email);
                                $this->email->subject($template['title']);
                                $this->email->message($template['body']);
                                $this->email->send();
                            }
                        }
                    } else {
                        display_mess(40);
                    }
                }
            }
        }
    }

    /**
     * The function resend_confirmation resends the password reset link by email
     */
    public function resend_confirmation() {
        // This function will resend confirmation code
        // Check if resend code was sent recently
        if ($this->session->userdata('resend')) {
            if ($this->session->userdata('resend') > time()) {
                display_mess(41);
                die();
            }
        }
        if ($this->session->userdata('username')) {
            $email = $this->user->get_email_by('username', $this->session->userdata('username'));
            if ($email) {
                $activate = time();
                $add_activate = $this->user->add_code($email, $activate, 'activate');
                if ($add_activate) {
                    // Will be send the resend-confirmation-email notification template to the current user
                    $args = ['[username]' => $this->session->userdata('username'), '[site_name]' => $this->config->item('site_name'), '[confirmation_link]' => '<a href="' . $this->config->base_url() . 'activate?code=' . $activate . '&f=' . $add_activate . '">' . $this->config->base_url() . 'activate?code=' . $activate . '&f=' . $add_activate . '</a>', '[login_address]' => '<a href="' . $this->config->item('login_url') . '">' . $this->config->item('login_url') . '</a>', '[site_url]' => '<a href="' . $this->config->base_url() . '">' . $this->config->base_url() . '</a>'];
                    $template = $this->notifications->get_template('resend-confirmation-email', $args);
                    if ($template) {
                        $this->email->from($this->config->item('contact_mail'), $this->config->item('site_name'));
                        $this->email->to($email);
                        $this->email->subject($template['title']);
                        $this->email->message($template['body']);
                        if ($this->email->send()) {
                            $this->session->set_userdata('resend', time() + 3600);
                            display_mess(42);
                        } else {
                            display_mess(43);
                        }
                    } else {
                        display_mess(43);
                    }
                } else {
                    display_mess(43);
                }
            } else {
                display_mess(43);
            }
        } else {
            display_mess(43);
        }
    }

    /**
     * The function activate will activate user's account
     */
    public function activate() {
        $code = $this->input->get('code', true);
        $f = $this->input->get('f', true);
        if (is_numeric($code) AND is_numeric($f)) {
            // Check if reset code is valid
            if (!$this->user->check_activation_code($code, $f)) {
                echo display_mess(26);
                die();
            } else {
                // This function will activate the user account
                $activate_account = $this->user->activate_account($f);
                if ($activate_account) {
                    display_mess(44);
                    // Check if user session exists
                    if (isset($CI->session->userdata['username'])) {
                        echo '<script language="javascript">document.location.href = "' . site_url() . '";</script>';
                    }
                    if ($this->user->get_username_by_id($f)) {
                        $this->user->last_access($f);
                        $this->session->set_userdata('username', strtolower($this->user->get_username_by_id($f)));
                        $this->session->set_userdata('autodelete', time() + 7200);
                        echo '<script language="javascript">document.location.href = "' . site_url() . '"; </script>';
                    } else {
                        display_mess(45);
                        die();
                    }
                } else {
                    display_mess(45);
                    die();
                }
            }
        } else {
            echo display_mess(26);
            die();
        }
    }

    /**
     * The function login displays login options via social networks
     *
     * @param $network is the network's name
     */
    public function login($network) {
        include_once APPPATH . 'interfaces/Login.php';
        if (file_exists(APPPATH . 'login/' . ucfirst($network) . '.php')) {
            include_once APPPATH . 'login/' . ucfirst($network) . '.php';
            $get = new $network;
            $get->sign_in();
        } else {
            display_mess(47);
        }
    }

    /**
     * The function callback will save user token
     *
     * @param $network is the network's name
     */
    public function callback($network) {
        include_once APPPATH . 'interfaces/Login.php';
        if (file_exists(APPPATH . 'login/' . ucfirst($network) . '.php')) {
            include_once APPPATH . 'login/' . ucfirst($network) . '.php';
            $get = new $network;
            $get->get_token();
        } else {
            display_mess(47);
        }
    }

    /**
     * The function check_session_auth checks if session exists
     */
    public function check_session_auth() {
        // Check if session exist
        if (isset($this->session->userdata['username'])) {
            // Check if user checked remember me checkbox
            if (isset($this->session->userdata['autodelete'])) {
                if ($this->session->userdata['autodelete'] < time()) {
                    // Delete session and redirect to home page
                    $this->session->unset_userdata('username');
                    $this->session->unset_userdata('member');
                    $this->session->unset_userdata('autodelete');
                } else {
                    redirect('/user/home');
                }
            } else {
                redirect('/user/home');
            }
        }
    }

    /**
     * The function block_count will block user
     */
    public function block_count() {
        if ($this->session->userdata('block_user')) {
            $get_count = $this->session->userdata('block_user');
            if (($get_count['time'] > time() - 3600) AND ( $get_count['tried'] == 1)) {
                $this->session->unset_userdata('block_user');
                $session_data = ['time' => time(), 'tried' => 2];
                $this->session->set_userdata('block_user', $session_data);
            } elseif (($get_count['time'] > time() - 3600) AND ( $get_count['tried'] == 2)) {
                $this->session->unset_userdata('block_user');
                $session_data = ['time' => time(), 'tried' => 3];
                $this->session->set_userdata('block_user', $session_data);
            } elseif (($get_count['time'] > time() - 3600) AND ( $get_count['tried'] == 3)) {
                $this->session->unset_userdata('block_user');
                $session_data = ['time' => time(), 'tried' => 4];
                $this->session->set_userdata('block_user', $session_data);
            } elseif (($get_count['time'] > time() - 3600) AND ( $get_count['tried'] == 4)) {
                $this->session->unset_userdata('block_user');
                $session_data = ['time' => time(), 'tried' => 5];
                $this->session->set_userdata('block_user', $session_data);
                display_mess(48);
                die();
            } else {
                $this->session->unset_userdata('block_user');
                $session_data = ['time' => time(), 'tried' => 1];
                $this->session->set_userdata('block_user', $session_data);
            }
        } else {
            $session_data = ['time' => time(), 'tried' => 1];
            $this->session->set_userdata('block_user', $session_data);
        }
    }

    /**
     * The function block_count checks if the user is already blocked
     */
    public function check_block() {
        if ($this->session->userdata('block_user')) {
            $get_count = $this->session->userdata('block_user');
            if (($get_count['time'] > time() - 3600) AND ( $get_count['tried'] == 5)) {
                display_mess(48);
                die();
            } else {
                if (($get_count['time'] < time() - 3600)) {
                    $this->session->unset_userdata('block_user');
                }
            }
        }
    }

    /**
     * The function logout will delete user's session
     */
    public function logout() {
        // This function will delete all active session
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('member');
        $this->session->unset_userdata('autodelete');
        // Delete all user's sessions from database
        $this->user->delete_all_sessions();
        redirect('/');
    }

}

/* End of file Auth.php */
