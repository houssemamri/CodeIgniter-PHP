<?php
/**
 * Ticketsarea Controller
 *
 * PHP Version 5.6
 *
 * Ticketsarea contains the Ticketsarea class for System Tickets
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
 * Ticketsarea class - contains all metods and pages for System Tickets
 *
 * @category Social
 * @package  Midrub
 * @author   Scrisoft <asksyn@gmail.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GNU General Public License
 * @link     https://www.midrub.com/
 */
class Ticketsarea extends MY_Controller {
    
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
        // Load Tickets Model
        $this->load->model('tickets');
        // Load Questions Model
        $this->load->model('questions');
        // Load Main Helper
        $this->load->helper('main_helper');
        // Load Fourth Helper
        $this->load->helper('fourth_helper');
        // Load session library
        $this->load->library('session');
        // Load URL Helper
        $this->load->helper('url');
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
        // Load language
        if ( file_exists( APPPATH . 'language/' . $this->config->item('language') . '/default_tickets_lang.php' ) ) {
            $this->lang->load( 'default_tickets', $this->config->item('language') );
        }
        if ( file_exists( APPPATH . 'language/' . $this->config->item('language') . '/default_user_lang.php' ) ) {
            $this->lang->load( 'default_user', $this->config->item('language') );
        }
        if ( file_exists( APPPATH . 'language/' . $this->config->item('language') . '/default_alerts_lang.php' ) ) {
            $this->lang->load( 'default_alerts', $this->config->item('language') );
        }
        if ( file_exists( APPPATH . 'language/' . $this->config->item('language') . '/default_admin_lang.php' ) ) {
            $this->lang->load( 'default_admin', $this->config->item('language') );
        }
    }
    
    /**
     * The function user_tickets displays the user's tickets page
     */
    public function my_tickets() {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        $this->check_unconfirmed_account();
        
        // Load User Helper
        $this->load->helper('user_helper');
        $this->body = 'user/tickets';
        $this->content = ['res' => ''];
        $this->user_layout();
    }
    
    /**
     * The function all_tickets displays the admin's tickets page
     */
    public function all_tickets() {
        // Check if the session exists and if the login user is admin
        $this->check_session($this->user_role, 1);
        
        // Load Admin Helper
        $this->load->helper('admin_helper');
        $this->body = 'admin/tickets';
        $this->content = [
            'res' => ''
        ];
        $this->admin_layout();
    }    
    
    /**
     * The function new_ticket displays the user's new ticket page
     */
    public function new_ticket() {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        $this->check_unconfirmed_account();
        
        // Load User Helper
        $this->load->helper('user_helper');
        $res = '';
        // Check if data was submitted
        if ($this->input->post()) {
            // Verify when was saved the last reply
            $last_reply = $this->tickets->last_ticket($this->user_id);
            if($last_reply) {
                $limit = 24;
                // Verify if admin had changed the default limit
                $verify = get_option('tickets_limit');
                if($verify) {
                    $limit = $verify;
                }
                if(($last_reply + $limit * 3600) > time()) {
                    $res = 'popup_fon(\'sube\', \''. $this->lang->line('mi16') . ' ' . $limit . ' ' . $this->lang->line('mm107') .'\', 1500, 2000);';
                }
            }
            if(get_option('disable-tickets')) {
                $res = 'popup_fon(\'sube\', \''.$this->lang->line('mi33').'\', 1500, 2000);';
            }
            if(!$res) {
                // Add form validation
                $this->form_validation->set_rules('ticket-subject', 'Ticket Subject', 'trim|required');
                $this->form_validation->set_rules('ticket-body', 'Ticket Body', 'trim|required');
                // Get data
                $subject = $this->input->post('ticket-subject');
                $body = $this->input->post('ticket-body');
                // Check form validation
                if ($this->form_validation->run() == false) {
                    $res = 'popup_fon(\'sube\', \''.$this->lang->line('mu59').'\', 1500, 2000);';
                } else {
                    $attachment = $this->upload_attachment();
                    if(!$attachment) {
                        $attachment = '';
                    }
                    if($this->tickets->save_ticket($this->user_id, $subject, $body, $attachment)) {
                        $res = 'popup_fon(\'subi\', \''.$this->lang->line('mi6').'\', 1500, 2000); setTimeout(function() {document.location.href="'.$this->config->base_url() . 'user/tickets";}, 5000);';
                    } else {
                        $res = 'popup_fon(\'sube\', \''.$this->lang->line('mu59').'\', 1500, 2000);';
                    }
                }
            }
        }
        $this->body = 'user/new_ticket';
        $this->content = ['res' => $res];
        $this->user_layout();
    }
    
    /**
     * The function new_question displays the admin's new question page
     */
    public function new_question() {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 1);
        
        // Load Admin Helper
        $this->load->helper('admin_helper');
        $res = '1';
        // Check if data was submitted
        if ($this->input->post()) {
            // Add form validation
            $this->form_validation->set_rules('question', 'Question', 'trim|required');
            $this->form_validation->set_rules('response', 'Response', 'trim|required');
            // Get data
            $question = $this->input->post('question');
            $response = $this->input->post('response');
            // Check form validation
            if ($this->form_validation->run() == false) {
                $res = 'popup_fon(\'sube\', \''.$this->lang->line('mu59').'\', 1500, 2000);';
            } else {
                if($this->questions->save_question($question, $response)) {
                    $res = 'popup_fon(\'subi\', \''.$this->lang->line('mi28').'\', 1500, 2000); setTimeout(function() {document.location.href="'.$this->config->base_url() . 'admin/tickets";}, 5000);';
                } else {
                    $res = 'popup_fon(\'sube\', \''.$this->lang->line('mu59').'\', 1500, 2000);';
                }
            }
        }
        $this->body = 'admin/tickets';
        $this->content = ['res' => '', 'result' => $res];
        $this->admin_layout();
    }
    
    /**
     * The function ticket gets a ticket's data
     *
     * @param integer $ticket_id contains the ticket's id
     */
    public function ticket($ticket_id) {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 0);
        $this->check_unconfirmed_account();
        
        // Load User Helper
        $this->load->helper('user_helper');
        // Verify if the ticket exists and if the user is the owner of the ticket
        $res = $this->tickets->get_ticket($this->user_id, $ticket_id);
        $upres = '';
        if($res) {
            $action = get_instance()->input->get('action', TRUE);
            if($action) {
                $this->tickets->ticket_status($ticket_id,'3');
                redirect('user/get-ticket/'.$ticket_id);
            }
            if($res[0]->status < 3) {
                // Check if data was submitted
                if ($this->input->post()) {
                    // Verify when was saved the last reply
                    $last_reply = $this->tickets->last_reply($this->user_id, $ticket_id);
                    if($last_reply) {
                        if($last_reply + 60 > time()) {
                            $upres = 'popup_fon(\'sube\', \''.$this->lang->line('mi13').'\', 1500, 2000);';
                        }
                    }                  
                    if(!$upres) {
                        // Add form validation
                        $this->form_validation->set_rules('reply-body', 'Reply Body', 'trim|required');
                        // Get data
                        $body = $this->input->post('reply-body');
                        // Check form validation
                        if ($this->form_validation->run() == false) {
                            $upres = 'popup_fon(\'sube\', \''.$this->lang->line('mu59').'\', 1500, 2000);';
                        } else {
                            $attachment = $this->upload_attachment();
                            if(!$attachment) {
                                $attachment = '';
                            }
                            if($this->tickets->save_reply($this->user_id, $ticket_id, $body, $attachment)) {
                                $this->tickets->ticket_status($ticket_id,'1');
                                $upres = 'popup_fon(\'subi\', \''.$this->lang->line('mi14').'\', 1500, 2000);';
                            } else {
                                $upres = 'popup_fon(\'sube\', \''.$this->lang->line('mi15').'\', 1500, 2000);';
                            }
                        }
                    }
                }
            }
            // Gets ticket's meta
            $metas = $this->tickets->get_metas($ticket_id);
            $this->body = 'user/tickets';
            $this->content = ['res' => $res, 'id' => $ticket_id, 'metas' => $metas, 'upres' => $upres];
            $this->user_layout();
        } else {
            show_404();
        }
    }
    
    /**
     * The function ticket_info gets a ticket's data
     *
     * @param integer $ticket_id contains the ticket's id
     */
    public function ticket_info($ticket_id) {
        // Check if the current user is admin and if session exists
        $this->check_session($this->user_role, 1);
        $this->check_unconfirmed_account();
        
        // Load Admin Helper
        $this->load->helper('admin_helper');
        // Verify if the ticket exists and if the user is the owner of the ticket
        $res = $this->tickets->get_ticket('admin', $ticket_id);
        $upres = '';
        if($res) {
            $action = get_instance()->input->get('action', TRUE);
            if($action) {
                $this->tickets->ticket_status($ticket_id,'3');
                redirect('admin/get-ticket/'.$ticket_id);
            }
            // Check if data was submitted
            if ($this->input->post()) {
                if(!$upres) {
                    // Add form validation
                    $this->form_validation->set_rules('reply-body', 'Reply Body', 'trim|required');
                    // Get data
                    $body = $this->input->post('reply-body');
                    // Check form validation
                    if ($this->form_validation->run() == false) {
                        $upres = 'popup_fon(\'sube\', \''.$this->lang->line('mu59').'\', 1500, 2000);';
                    } else {
                        $attachment = $this->upload_attachment();
                        if(!$attachment) {
                            $attachment = '';
                        }
                        if($this->tickets->save_reply($this->user_id, $ticket_id, $body, $attachment)) {
                            $this->tickets->ticket_status($ticket_id,'2');
                            $upres = 'popup_fon(\'subi\', \''.$this->lang->line('mi14').'\', 1500, 2000);';
                        } else {
                            $upres = 'popup_fon(\'sube\', \''.$this->lang->line('mi15').'\', 1500, 2000);';
                        }
                    }
                }
            }
            // Gets ticket's meta
            $metas = $this->tickets->get_metas($ticket_id);
            $this->body = 'admin/tickets';
            $this->content = ['res' => $res, 'id' => $ticket_id, 'metas' => $metas, 'upres' => $upres];
            $this->admin_layout();
        } else {
            show_404();
        }
    }
    
    /**
     * The function delete_ticket deletes a ticket
     *
     * @param integer $ticket_id contains the ticket's id
     */
    public function delete_ticket($ticket_id) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        // Delete ticket data by user id and ticket id
        $getmes = $this->tickets->delete_ticket($this->user_id, $ticket_id);
        if ($getmes) {
            echo json_encode(1);
        }
    }
    
    /**
     * The function delete_question deletes a question
     *
     * @param integer $question_id contains the question's id
     */
    public function delete_question($question_id) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        // Delete question by $question_id
        $getquest = $this->questions->delete_question($question_id);
        if ($getquest) {
            echo json_encode(1);
        }
    }
    
    /**
     * The function delete_ticket_as_admin deletes a ticket as admin
     *
     * @param integer $ticket_id contains the ticket's id
     */
    public function delete_ticket_as_admin($ticket_id) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        // Delete ticket data by user id and ticket id
        $getmes = $this->tickets->delete_ticket('admin', $ticket_id);
        if ($getmes) {
            echo json_encode(1);
        }
    }
    
    /**
     * The function upload_attachment uploads files on server
     */
    public function upload_attachment() {
        $size = 6000000;
        if(get_option('upload_limit')) {
            $size = get_option('upload_limit')*1000000;
        }
        // Allows user to upload images and post them on the social networks
        if ($_FILES['file']['size'] > $size) {
            return false;
        }
        $check_format = ($_FILES['file']['type'] == 'image/png') || ($_FILES['file']['type'] == 'image/jpeg') || ($_FILES['file']['type'] == 'image/gif') || ($_FILES['file']['type'] == 'video/mp4') || ($_FILES['file']['type'] == 'video/webm') || ($_FILES['file']['type'] == 'video/avi');
        if ($check_format) {
            $config['upload_path'] = 'assets/share';
            $config['file_name'] = uniqid() . '-' . time();
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            $this->upload->set_allowed_types('*');
            $data['upload_data'] = '';
            if ($this->upload->do_upload('file')) {
                $data['upload_data'] = $this->upload->data();
                return $this->config->base_url() . 'assets/share/' . $data['upload_data']['file_name'];
            }
        } else {
            return false;
        }
    }
    
    /**
     * The function get_tickets extracts the user tickets from the database
     * 
     * @param integer $page gets the page number
     * @param string $type gets the query type
     */
    public function get_tickets($page, $type) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,0);
        $limit = 10;
        $page--;
        // Count all user's tickets
        $total = $this->tickets->count_all_tickets($this->user_id);
        // Get all user tickets
        $getickets = $this->tickets->get_all_tickets($this->user_id, $page * $limit, $limit);
        if ($getickets) {
            $data = ['total' => $total, 'tickets' => $getickets];
            echo json_encode($data);
        }
    }
    
    /**
     * The function get_tickets extracts all tickets from the database
     * 
     * @param integer $page gets the page number
     * @param string $type gets the query type
     */
    public function get_all_tickets($page, $type) {
        // Verify if session exists and if the user is admin
        $this->if_session_exists($this->user_role,1);
        $limit = 10;
        $page--;
        // Count all user's tickets
        $total = $this->tickets->count_all_tickets('admin');
        // Get all user tickets
        $getickets = $this->tickets->get_all_tickets('admin', $page * $limit, $limit);
        if ($getickets) {
            $data = ['total' => $total, 'tickets' => $getickets];
            echo json_encode($data);
        }
    }
    
    /**
     * The function get_questions gets question from the database by key
     * 
     * @param string $key contains the search key
     */
    public function get_questions($key) {
        $key = $this->security->xss_clean(base64_decode($key));
        $gequestions = $this->questions->get_questions($key);
        if ($gequestions) {
            echo json_encode($gequestions);
        }
    }
    
    /**
     * The function check_unconfirmed_account checks if the current user's account is confirmed
     */
    protected function check_unconfirmed_account() {
        if ($this->user_status == 0) {
            redirect('/user/unconfirmed-account');
        }
    }
}

/* End of file Tickets.php */
