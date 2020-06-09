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
		$data['title'] = "Add Post | Admin Home - Review Thunder Blog";
		$this->load->view('admin/header',$data);
		$this->load->view('admin/aside');
		$this->load->view('admin/addPost');
		$this->load->view('admin/footer');
	}
	public function submitPost()
	{
			$config['upload_path']          = './assets/img/';
			$config['allowed_types']        = 'jpg|png';
		  $this->load->library('upload', $config);
			if($this->upload->do_upload('file-input'))
			{
	      $data = $this->upload->data();
				$path = 'assets/img/' . $data['file_name'];
				$title = $this->input->post('title');
				$content = $this->input->post('content');
				$data = array(
					'Title' => $title,
					'Mainimage' => $path,
					'Content_English' => $content
				);
				$this->model->insertData('posts',$data);
				$data['title'] = "Add Post | Admin Home - Review Thunder Blog";
				$this->load->view('admin/header',$data);
				$this->load->view('admin/aside');
				$data['success'] = 'set';
				$this->load->view('admin/addPost',$data);
				$this->load->view('admin/footer');
			}
			else
			{
					$data['title'] = "Add Post | Admin Home - Review Thunder Blog";
					$this->load->view('admin/header',$data);
					$this->load->view('admin/aside');
					$data['fail'] = 'set';
					$this->load->view('admin/addPost',$data);
					$this->load->view('admin/footer');

			}
	}
}
