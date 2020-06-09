<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {

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
	}
	public function read($title)
	{
		//print_r($result);
		/*$page = $this->input->get('page');
		if(!isset($page)){
			$page = 0;
		}*/
		$title = str_replace('-',' ',$title);
		$data['title'] = $title . ' - Review Thunder';
		$this->load->view('headerUser',$data);
		$where = array('Title' => $title);
		$data['result'] = $this->model->getData('posts',$where)->result();
		if($data['result'] == null){
			redirect('Error');
		}
		$this->load->view('single',$data);
		$this->load->view('footer');
	}
}
