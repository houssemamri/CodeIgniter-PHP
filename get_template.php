<?php
session_start();
include_once "connection.php";
?> 
<?php
$choose_temp= $_POST['choose_temp'];
$sql = "SELECT * FROM templates WHERE id = '".$choose_temp."'";
      // echo $sql;
       $result = mysqli_query($conn,$sql);
$msg ='';
        if (mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_array($result))
            {
            	/*print_r($row);
            		$return=array('msg'=>'success','data'=> $row["content"]);
     			     echo json_encode($return,TRUE);*/
     			     
     			     echo $row["html"];
         
            }
		}
 ?> 



       