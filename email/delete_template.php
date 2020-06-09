<?php
include_once 'includes/db.class.php';
session_start();

if (!isset($_POST['templateId']) ) {
   echo 'value not be null';
   return;
}

$db = new Db();
$UserId=$_SESSION["user_id"];
$templateId = $_POST['templateId'];
/*echo "userid:";
echo $UserId;
echo "<br>";
echo "template id";
echo $templateId;die();*/

$result = $db -> deleteTemplate( $templateId,$UserId);
if ($result) {
  echo 'ok';
}else {
   echo 'error';
}


?>
