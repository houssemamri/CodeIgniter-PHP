<?php
session_start();
include_once "connection.php";
include_once "common_function.php";
include_once 'email/includes/db.class.php';

//echo $_SESSION['user_id'];


session_start();
/*if (!isset($_SESSION["user_id"]) || is_null($_SESSION["user_id"])) {
	header("Location: https://review-thunder.com/auth/index");
}*/

$db = new Db();

$EID = $_POST['eid'];
$name = $_POST['tempName'];
$subject = $_POST['subject'];
$email = $_POST['email'];


//TEST EMAIL SEND
if(isset($_POST['eid'])){
	$name = $_POST['tempName'];
$subject = $_POST['subject'];
$email = $_POST['email'];

$sql = "SELECT * FROM templates WHERE id = '".$_POST['eid']."'";
      // echo $sql;
       $result = mysqli_query($conn,$sql);
$msg ='';
        if (mysqli_num_rows($result) > 0){
        while ($row = mysqli_fetch_array($result))
            {
            	/*print_r($row);
            		$return=array('msg'=>'success','data'=> $row["content"]);
     			     echo json_encode($return,TRUE);*/
     			     
     			     $content = $row["html"];
         
            }
		}




//print_r($_POST);die("here");
	$messagead = $content;
	$to1 = $email;
	$subjectad = $subject;
	$headersad = "From: ".'Review Thunder'." <noreply@review-thunder.com>" . "\r\n";
	$headersad .= "MIME-Version: 1.0" . "\r\n";
	$headersad .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headersad .= "X-Mailer: PHP/".phpversion();	
  	
    $mail_success = mail($to1,$subjectad,$messagead,$headersad);

	if(!$mail_success){
		echo '<div style="color:#fff;background:red;width:100%">Error</div>';
	}
}

