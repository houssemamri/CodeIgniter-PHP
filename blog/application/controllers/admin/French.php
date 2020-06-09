<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class French extends CI_Controller {

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
		$PID = $this->input->get('id');
		$data['title'] = "Add French Translation | Admin Home - Review Thunder Blog";
		$this->load->view('admin/header',$data);
		$this->load->view('admin/aside');
		$where = array('PID' => $PID);
		$data['Post'] = $this->model->getData('posts',$where)->result();
		$this->load->view('admin/addFrench',$data);
		$this->load->view('admin/footer');
	}
	public function submitPost()
	{
			$title = $this->input->post('title');
			$content = $this->input->post('content');
			$PID = $this->input->post('PID');
			$data = array(
				'Title_Fr' => $title,
				'Content_Fr' => $content
			);
			$where = array(
				'PID' => $PID
			);
			$this->model->updateData('posts',$data,$where);
			redirect($_SERVER['HTTP_REFERER']);
			// $data['title'] = "Add French Post | Admin Home - Review Thunder Blog";
			// $this->load->view('admin/header',$data);
			// $this->load->view('admin/aside');
			// $data['success'] = 'set';
			// $this->load->view('admin/addPost',$data);
			// $this->load->view('admin/footer');
	}
}
