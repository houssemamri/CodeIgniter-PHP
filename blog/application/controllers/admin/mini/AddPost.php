<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AddPost extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function __construct(){
		parent::__construct();
    $this->load->library('session');
    $this->load->helper('url');
    $this->load->model('model');
    $this->load->helper(array('form', 'url'));
	}
	public function index()
	{
		$data['title'] = "Add Mini Blog Post | Admin Home - Review Thunder Blog";
		$this->load->view('admin/header',$data);
		$this->load->view('admin/aside');
		$this->load->view('admin/mini/addPost');
		$this->load->view('admin/footer');
	}
	public function submitPost()
	{
			$title = $this->input->post('title');
			$content = $this->input->post('content');
			$data = array(
				'Title' => $title,
				'Content_English' => $content
			);
			$this->model->insertData('miniposts',$data);
			$data['title'] = "Add Mini Blog Post | Admin Home - Review Thunder Blog";
			$this->load->view('admin/header',$data);
			$this->load->view('admin/aside');
			$data['success'] = 'set';
			$this->load->view('admin/mini/addPost',$data);
			$this->load->view('admin/footer');
	}
}
