<?php
include_once 'includes/db.class.php';
session_start();
//
// if (strlen($_POST['name'])<1) {
//   echo 'error';
//   return ;
// }isset,is_null

// if (isset($_POST['name']) || is_null($_POST['name'])
// || isset($_POST['content']) || is_null($_POST['content'])) {
//    echo 'value not be null';
//    return;
// }

$db = new Db();
//
//echo $_SESSION['user_id'];die();
 $UserId=$_SESSION['user_id'];
 $name = $_POST['name'];
 $bg_color = $_POST['bg_color'];
// $content =htmlentities($_POST['content']);
//
$contentArr=$_POST['contentArr'];
//print_r($contentArr);die();
$result = $db -> insertTemplate( $name,$UserId,$bg_color);
//print_r($result);die("here result");
$tempId=$db->getLastTempId();
//echo $tempId;
$result=false;
//echo sizeof($contentArr);die("here content size");
for ($i=0; $i < sizeof($contentArr); $i++) {
  if (isset($contentArr[$i]['id'])) {
    $result = $db -> insertTemplateBlocks( $tempId, $contentArr[$i]['id'],$contentArr[$i]['content']);
  }
}

if ($result) {
  echo 'ok';
}else {
   echo 'error';
}

?>
