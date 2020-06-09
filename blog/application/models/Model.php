<?php
class Model extends CI_Model{
  public function __construct()	{
    parent::__construct();
    $this->load->database();
    $this->load->library('session');
  }
  /* Insert, Fetch , Update , Delete Data */
  public function insertData($table,$data)
  {
    $this->db->insert($table,$data);
  }
  public function get($table)
  {
    $query = $this->db->get($table);
    return $query;
  }
  public function getData($table,$where)
  {
    $query = $this->db->get_where($table, $where);
    return $query;
  }
  public function updateData($table,$data,$where)
  {
    $this->db->update($table,$data,$where);
  }
  public function deleteData($table,$where)
  {
    $this->db->delete($table,$where);
  }
  /* End */
  /* Front Page */
  public function getFrontPage($table,$limit,$pageno)
  {
    if($pageno==0){
      $offset = 0;
    }
    else{
      $offset = $limit * $pageno;
    }
    $query = $this->db->order_by('PID','Desc')->get($table,$limit,$offset);
    return $query;
  }
  public function getAvatar($id){
      $otherdb = $this->load->database('global', TRUE);
      $sql = "select avatar,bubble from UserTable where UID ='$id'";
      $query = $otherdb->query($sql);
      $result = $query->result()[0];
      if(is_null($result->avatar)){
          $result->avatar = 1;
      }
      if(is_null($result->bubble)){
          $result->bubble = 1;
      }
      return $result;
  }
}

 ?>
