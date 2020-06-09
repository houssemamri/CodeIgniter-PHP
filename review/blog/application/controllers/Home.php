<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
	public function index()
	{
		//print_r($result);
		$page = $this->input->get('page');
		if(!isset($page)){
			$page = 0;
		}
		$data['title'] = 'Review Thunder - Blog';
		if(!isset($_SESSION['global_status']))
			$this->load->view('header',$data);
		else
			$this->load->view('headerUser',$data);
		$data['next_page'] = $this->model->getFrontPage('posts',6,$page+1)->result();
		$data['result'] = $this->model->getFrontPage('posts',6,$page)->result();
		$this->load->view('home',$data);
		$this->load->view('footer');
	}
	public function language()
	{
		$_SESSION['language1'] = $this->input->get('lang');
		// echo $_SESSION['language'];
		redirect($_SERVER['HTTP_REFERER']);
	}
}
