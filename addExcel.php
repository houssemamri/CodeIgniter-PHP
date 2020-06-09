<?php
include('connection.php');
session_start();
$part=$_POST['Part'];
$article=$_POST['Article'];
$lang=$_POST['Language'];
$category=$_POST['Type'];
$owner=$_SESSION['user_id'];
$gender=$_POST['gender'];
$target_dir = "./";
$target_file = $target_dir . basename($_FILES["filename"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file);
include 'PHPExcel/IOFactory.php';

$inputFileName=$target_file;

if(strcmp($lang,"fr")==0){
    $tableName = "Article" . $article;
}
else if(strcmp($lang,"en")==0){
  $article+=3;
  $tableName = "Article" . $article;
}
else{
  $article+=6;
  $tableName = "Article" . $article;
}
//  Read your Excel workbook
try {
    $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
    $objReader = PHPExcel_IOFactory::createReader($inputFileType);
    $objPHPExcel = $objReader->load($inputFileName);
} catch(Exception $e) {
    die('Error loading file "'.pathinfo($inputFileName,PATHINFO_BASENAME).'": '.$e->getMessage());
}

//  Get worksheet dimensions
$sheet = $objPHPExcel->getSheet(0);
$highestColumn = $sheet->getHighestColumn();
if($part==15)
{
  $highestRow=1;
}
else
{
  $highestRow = $sheet->getHighestRow();
}


//  Loop through each row of the worksheet in turn
for ($row = 1; $row <= $highestRow; $row++){
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);
    foreach($rowData as $var){
      if($part==15)
      {
        $sql="SELECT * FROM UserFavourite WHERE UID=" . $owner . " AND Category like '" . $category . "' AND Article=" . $article . " AND Gender=" . $gender;
        $result=$conn->query($sql);
        if($result->num_rows==0)
        {
          $sql="INSERT INTO UserFavourite(UID,Text,Article,Category,Gender) VALUES(" .  $owner . ",'" . $conn->real_escape_string($var[0]) . "'," . $article . ",'" . $category . "'," . $gender . ")";
        }
        else
        {
          $sql="UPDATE UserFavourite SET Text='" . $conn->real_escape_string($var[0]) . "' WHERE UID=" . $owner . " AND Article=" . $article . " AND Category like '" . $category . "' AND Gender=" . $gender;
        }
        $conn->query($sql);
      }
      else
      {
        $sql="INSERT INTO " . $tableName . "(Text,Part,Category,Owner,Gender) VALUES('" . $conn->real_escape_string($var[0]) . "'," . $part . ",'" . $category . "'," . $owner . "," . $gender . ")";
        $conn->query($sql);
      }
      if($sql){
	  	$msg='1';
	  }else{
	   $msg = '0';
	  }
    }
}
$conn->close();
header('Location:' . $_SERVER['HTTP_REFERER'].'&stat='.$msg);
?>
