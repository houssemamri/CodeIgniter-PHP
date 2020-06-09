<?php
class Single_video_model extends CI_Model 
{

	function displayrecords($cid,$uid,$vid)
	{
	$sql = "SELECT * FROM video WHERE CID = " . $cid . " AND UID=" . $uid." AND VID=".$vid;
	$query=$this->db->query($sql);
	return $query->result();
	}

}
?>