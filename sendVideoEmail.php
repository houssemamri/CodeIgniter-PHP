<?php
include('connection.php');
//Sending email without smtp as smtp is not working because of sarver issues 
/*echo "post";
echo "<pre>";
print_r($_POST);*/
 
    /*if(isset($_POST['submit'])){
		print_r($_POST);
	}*/
    


//Getting UID from post
$UID = $_POST['UID'];
$sql = "SELECT Email FROM UserTable WHERE UID = " . $UID;
$result = $conn->query($sql);
$row = $result->fetch_assoc();
/*echo "row";
echo "<pre>";
print_r($row);*/

//Getting LID from post
$LID = $_POST['LID'];
$emailFrom = $row['Email'];
$subject = 'Video Link Share';
$msg = str_replace("/ckfinder/","https://review-thunder.com/ckfinder/", $_POST['content']);
//echo $msg;die();
$message = $msg;
/*echo "email from";
echo "<pre>";
echo $emailFrom;*/


/*$flag=0;
$sql="SELECT Name,SMTP,SMTPuser,SMTPpwd FROM UserTable WHERE UID=" . $UID;
$result=$conn->query($sql);
$row=$result->fetch_assoc();

require_once('phpmailer/PHPMailerAutoload.php');

$email = new PHPMailer();
$email->isSMTP();
$email->SMTPDebug = 1;
$email->SMTPAuth = true;
$email->Port = 587;
$email->Host = $row['SMTP'];
$email->Username = $row['SMTPuser'];
$email->Password = $row['SMTPpwd'];
$email->From = $emailFrom;
$email->FromName = $row['Name'];
$email->Subject = $subject;
$email->Body = $message;


echo $row['SMTP'] . ' ' . $row['SMTPuser'] . ' ' . $row['SMTPpwd'];

$sql="SELECT * FROM EmailListing WHERE LID=" . $LID;
$result=$conn->query($sql);
while($row = $result->fetch_assoc())
{
	echo $row['Email'];die('here');
  if(filter_var($row['Email'], FILTER_VALIDATE_EMAIL))
  {
 	 $email->AddAddress($row['Email']);*/
    
    // $email->send();
/*    if($email->send()) {
      echo "Working?";
      $flag = 1;
    } else {
      echo "Not Working?";
      echo $email->ErrorInfo;
      $flag = 0;
    }
  }
}
$conn->close();
 header('Location:' . $_SERVER['HTTP_REFERER']);*/



//Getting EID FROM EmailListSub as the email system based on email groups 
	$sqlEid="select EID from EmailListSub where LID='".$LID."'";
	$query2 = mysqli_query($conn,$sqlEid);
	//$emailEid=mysqli_fetch_assoc($query2);
	
	//As long as EID is present n EmailListSub the loop will continue
	while($row = mysqli_fetch_assoc($query2)){
	$EID = $row['EID'];
	
	//Getting Email ID from Emailist based on the group id which is EID
	$sqlEmail = "SELECT Email FROM EmailList WHERE EID = '".$EID."'";
	//echo $sqlEmail;
	$emailQuery = mysqli_query($conn,$sqlEmail);
	//$emailName = mysqli_fetch_assoc($emailQuery);
	
	//as long as there is email id in email list loop will continue
	while($row = mysqli_fetch_assoc($emailQuery)){
	$messagead = $message;
	//$messagead = "test";
	$to1 = $row['Email'];
	echo $to1;echo "<br>";
	$subjectad = $subject;
	echo $subjectad;echo "<br>";
	echo $messagead;echo "<br>";
  	$subjectad = $subject;
	$headersad = "From: ".'Review Thunder'." <$emailFrom>" . "\r\n";
	$headersad .= "MIME-Version: 1.0" . "\r\n";
	$headersad .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headersad .= "X-Mailer: PHP/".phpversion();
  	$mail_success = mail($to1,$subjectad,$messagead,$headersad);

//if mail sending is successfull then an success message will appear other wise error
	if($mail_success){
		header('Location: https://review-thunder.com/manageVideos.php?id=1&suc=1');
	}else{
		header('Location: https://review-thunder.com/manageVideos.php?id=1&err=0');
	}
}
		
	}
	
	
	












?>
