<?php
/**
 * MY_Controller Controller
 *
 * PHP Version 5.6
 *
 * MY_Controller contains the MY_Controller class
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
 * MY_Controller class - extends the Controller core class
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class MY_Controller extends CI_Controller {
    //set the class variables.
    public $template, $data, $footer, $content, $user_header, $admin_header;
    protected $where = [
        FCPATH . 'application/smtp/inc/models/',
        FCPATH . 'application/smtp/inc/',
        FCPATH . 'application/smtp/inc/classes/',
        FCPATH . 'application/smtp/inc/static/',
        FCPATH . 'application/smtp/inc/helpers/',
        FCPATH . 'application/third_party/',
    ];

    /**
     * The function check_session verifies if the session exists and if session is empty will redirect to home page
     * 
     * @param integer $role contains the user role
     * @param integer $is contains the allowed user id
     */
    public function check_session($role=NULL, $is=NULL) {
		  
		  
		
		/* echo $this->session->userdata('username');
	    die; */
		
        $CI = & get_instance();
		
        // check if session exist
        if (!isset($CI->session->userdata['username'])) {
            redirect('/');
        } elseif (($is == 0) AND ( $role != $is)) {
            redirect('/admin/home');
        } elseif (($is == 1) AND ( $role != $is)) {
            redirect('/user/home');
        } else {
            // check if user checked remember me checkbox
            if (isset($CI->session->userdata['autodelete'])) {
                if ($CI->session->userdata['autodelete'] < time()) {
                    // delete session and redirect to home page
                    $CI->session->unset_userdata('username');
                    $CI->session->unset_userdata('autodelete');
                    redirect('/');
                }
            }
        }
    }

    /**
     * The function if_session_exists verifies if the session exists and if session is empty will stop the script running
     * 
     * @param integer $role contains the user role
     * @param integer $is contains the allowed user id
     */
    public function if_session_exists($role, $is) {
        $CI = & get_instance();
        // First verify if session exists
        if (!isset($CI->session->userdata['username'])) {
            exit();
        } elseif ( $role != $is ) {
            // Then verify if the role is not correct and stop the script
            exit();
        }
    }

    /**
     * The function admin_layout loads the admin layout
     */
    public function admin_layout() {
        $this->admin_header = admin_header();
        // making temlate and send data to view.
        $this->template['header'] = heads($this->load->view('admin/layout/header', $this->admin_header, true));
        $this->template['left'] = $this->load->view('admin/layout/left', $this->data, true);
        $this->template['body'] = $this->load->view($this->body, $this->content, true);
        $this->template['footer'] = $this->load->view('admin/layout/footer', $this->footer, true);
        $this->load->view('admin/layout/index', $this->template);
    }

    /**
     * The function user_layout loads the user layout
     */
    public function user_layout() {
        $this->user_header = user_header();
        // making temlate and send data to view.
        $this->template['header'] = heads($this->load->view('user/layout/header', $this->user_header, true));
        $this->template['left'] = $this->load->view('user/layout/left', $this->data, true);
        $this->template['body'] = $this->load->view($this->body, $this->content, true);
        $this->template['footer'] = $this->load->view('user/layout/footer', $this->footer, true);
        $this->load->view('user/layout/index', $this->template);
    }

    /**
     * The function efl verifies if a file exists
     * 
     * @param string $name contains the file name
     */   
    public function efl($name) {
        $this->eche($name);
    }

    /**
     * The function ecl calls a class
     * 
     * @param string $name contains the class name
     */  
    public function ecl($name) {
        $this->eche($name);
        return new $name;
    }

    /**
     * The function eche verifies if a class exists
     * 
     * @param string $name contains the class name
     */  
    public function eche($name) {
        foreach ($this->where as $directory) {
            foreach (glob($directory . '*.php') as $file) {
                if ($file == $directory . $name . '.php') {
                    require_once $file;
                }
            }
        }
    }
}