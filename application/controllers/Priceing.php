<?php
class Priceing extends CI_Controller 
{
	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->model('Priecingmodel');
	}
 	
 	public function index()
 	{
	$this->load->view('user/pricing');
		
	}

}
?>