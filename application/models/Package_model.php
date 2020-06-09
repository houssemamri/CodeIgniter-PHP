<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}
class Package_model extends CI_Model
{
	function get_data()
  {
	 $this->db->select('*');
	 $this->db->where('status!=', 2);
     $query = $this->db->get('tbl_package');
     $result = $query->result();
     /* echo $this->db->last_query();
     exit;*/
     return $result;
  }
  
  public function get_paypal_payment()
  {
  	 $this->db->select('*');
     $query = $this->db->get('tbl_paypal');
     $result = $query->result();
     /*echo $this->db->last_query();
     exit;*/
     return $result;
  }
  
  function coupon_data()
  {
  	 $this->db->select('*');
     $query = $this->db->get('tbl_coupons');
     $result = $query->result();
     /* echo $this->db->last_query();
     exit;*/
     return $result;
  }
  
  function getLastid()
    {
	   $this->db->select('max(id) as lastid');
	    $query = $this->db->get('tbl_package');
	    $result = $query->row();
	    /*echo $this->db->last_query();
	    exit;*/
	    return $result;
   }
   
  
  function add_data($data)
  {
	 if(!empty($data))
		{
	     $this->db->insert('tbl_package',$data);
	     /*echo $this->db->last_query();
	     exit;*/
	     return $this->db->insert_id();
		}
  }
  function edit_data($data,$package_code)
	{
		if(!empty($data))
		{
			 $this->db->where('package_code',$package_code);
             $this->db->update('tbl_package', $data);
             //echo $this->db->last_query();exit;
			 return $this->db->affected_rows();
		}
	}
	
	function get_data_by_id($package_code)
  	{
	 $this->db->select('*');
	 $this->db->where('package_code', $package_code);
     $query = $this->db->get('tbl_package'); 
	 $result = $query->result();
	 /*echo $this->db->last_query();
	 exit;*/
	 return $result;
	}
	
	public function delete_row_data($package_code)
	  {
	  	  $data['status']=2;
		  $this->db->where('package_code', $package_code);
		  $this->db->update('tbl_package', $data);
		  
	  }
  	
  	
   function paypal_order_data($data)
  {
	 if(!empty($data))
		{
	     $this->db->insert('tbl_payment',$data);
	     /*echo $this->db->last_query();
	     exit;*/
	     return $this->db->insert_id();
		}
  }
  
  
  
  
  
}
