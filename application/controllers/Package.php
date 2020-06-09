<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Package extends MX_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in(); 	//common function for session checking.
        
        $this->load->library('session');
        $this->load->library('form_validation');
		$this->load->model('Package_model');
    }
    
    //===================================================================
    
    public function index()
    {
    	$data['coupon'] = $this->Package_model->coupon_data();
    	$data['paypal_payment'] = $this->Package_model->get_paypal_payment();
        $data_get= $this->Package_model->get_data();
        //echo $this->db->last_query();die();
		$data['allpackage_row']=$data_get;
		//print_r($data_get);exit;
        $site_name=$this->config->item('site_name');
        $this->template->set('title', 'Package | '.$site_name);
        $this->template->set_layout('layout_main', 'front');
        $this->template->build('package',$data);
	}
	
/*================================ Add Package===========================*/	



/*================================ Edit ===========================*/	

public function paypal_return()
{
	
	$data['package_name']= 'XXX';
		
	$data_inserted = $this->Package_model->paypal_order_data($data);
	
	$this->template->set_layout('layout_main', 'front');
    $this->template->build('return');
	
}

public function paypal_cancel()
{
	
		
	$this->template->set_layout('layout_main', 'front');
    $this->template->build('cancel');
	
}
 

	
	
	
}
