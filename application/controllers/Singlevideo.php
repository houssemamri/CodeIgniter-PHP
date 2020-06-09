<?php
class Singlevideo extends CI_Controller 
{
	public function __construct()
	{
	parent::__construct();
	$this->load->database();
	$this->load->model('Single_video_model');
	}
 	
 	public function video($uid,$vid,$cid)
 	{
	$data['video'] = $this->Single_video_model->displayrecords($cid,$uid,$vid);
	//print_r($video);die('here');
	$this->load->view('single_video',$data);		
	}
}
?>