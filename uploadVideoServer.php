<?php
include('connection.php');

$UID = $_POST['UID'];
$CID = $_POST['CID'];
$title = $_POST['title'];
$description = $_POST['description'];

  define('UPLOAD_DIR', dirname(__FILE__)."/assets/upload/");
    $image_parts = explode(";base64,", $_POST['video_screenshot']);
    $image_type_aux = explode(dirname(__FILE__)."/assets/upload/", $image_parts[0]);
    $image_type = $image_type_aux[1];
    $image_base64 = base64_decode($image_parts[1]);
    $image_name = uniqid() . '.jpg';
    $file = UPLOAD_DIR . $image_name ;
    file_put_contents($file, $image_base64);
	$image_path = "https://review-thunder.com/assets/upload/".$image_name;

if (isset($_FILES['capture']['tmp_name'])) {
  $fileType = pathinfo($_FILES['capture']['name'],PATHINFO_EXTENSION);
  $target_file = './videos/video' . time() . '.' . $fileType;
  echo $target_file;
  if (move_uploaded_file($_FILES['capture']['tmp_name'], $target_file)) {
    $sql = "INSERT INTO video(UID,Name,Path,frame_image,description,CID) VALUES(" . $UID . ",'" . $title . "','" . $target_file . "','".$image_path."','".$description."'," . $CID . ")";
   //echo $sql;
    $conn->query($sql);
    $conn->close();
    header('Location: ' . './uploadVideo.php?id=' . $UID . '&success=true');
  } else {
    $conn->close();
    header('Location: ' . './uploadVideo.php?id=' . $UID . '&success=false');
  }
}
?>