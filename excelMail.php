<?php
include('connection.php');
session_start();
$owner=$_SESSION['user_id'];
$target_dir = "./";
$target_file = $target_dir . basename($_FILES["filename"]["name"]);
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);


move_uploaded_file($_FILES["filename"]["tmp_name"], $target_file);

include("PHPExcel/IOFactory.php");

$inputFileName=$target_file;

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
$highestRow = $sheet->getHighestRow();
$highestColumn = $sheet->getHighestColumn();

//  Loop through each row of the worksheet in turn
for ($row = 1; $row <= $highestRow; $row++){
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                                    NULL,
                                    TRUE,
                                    FALSE);
    foreach($rowData as $var){
        $sql="INSERT INTO EmailList (UID,Email,First,Last,Company) VALUES(". $owner . ",'" . $conn->real_escape_string($var[0]) . "','" . $conn->real_escape_string($var[1]) . "','" . $conn->real_escape_string($var[2]) . "','" . $conn->real_escape_string($var[3]) .  "')";
        $conn->query($sql);
      }
}
$conn->close();
header('Location:' . $_SERVER['HTTP_REFERER']);
?>
