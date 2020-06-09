<?php
include('connection.php');
session_start();
$article=$_POST['article'];
$part=$_POST['part'];
$lang=$_POST['lang'];
$category=$_POST['type'];
$owner=$_POST['user'];
$gender=$_POST['sex'];
//echo $article . " " . $part . " " . $lang . " " . $category . " " . $owner;
if(strcmp($lang,"fr")==0){
  $tableName="Article" . $article;
}
else if(strcmp($lang,"en")==0){
  $article+=3;
  $tableName="Article" . $article;
}
else{
  $article+=6;
  $tableName="Article" . $article;
}
//echo $part . " " . $tableName . " " . $owner . " " . $lang . " " . $category;
$data=array();
if($part==15)
{
  $sql="SELECT * FROM UserFavourite WHERE UID=" . $owner . " AND Category like '" . $category . "' AND Article=" . $article . " AND Gender=" . $gender;
  $result=$conn->query($sql);
  while($row=$result->fetch_assoc()){
    $data[]= array(
      'id' => $row['ID'],
      'text' => $row['Text'],
    );
  }
}
else
{
    if(!isset($_SESSION['admin_status'])){
      //$sql="SELECT * FROM " . $tableName . " WHERE part=" . $part . " AND Category like '" . $category . "' AND Owner=1 OR Owner=" . $owner;
      $sql="SELECT OriginalID as ID,Text FROM TempTable WHERE Article=" . $article . " AND Part=" . $part . " AND Category like '" . $category . "' AND owner= " . $owner .
      " AND Gender=" . $gender . " UNION SELECT ID,Text FROM " . $tableName . " WHERE ID NOT IN ( SELECT OriginalID FROM TempTable WHERE Owner=" . $owner . ") AND Owner=1 AND part=" . $part .
      " AND Category like '" . $category . "' AND Gender=" . $gender . " UNION SELECT ID,Text FROM " . $tableName . " WHERE owner=" . $owner . " AND Part=" . $part .
      " AND Category like '" . $category . "' AND Gender=" . $gender . " ORDER BY ID";
    }
    else{
      $sql="SELECT * FROM " . $tableName . " WHERE part=" . $part . " AND Category like '" . $category . "' AND Gender=" . $gender;
    }
    $result=$conn->query($sql);
    while($row=$result->fetch_assoc()){
        $data[]= array(
          'id' => $row['ID'],
          'text' => $row['Text'],
        );
    }
}
echo json_encode($data);
$conn->close();
?>
