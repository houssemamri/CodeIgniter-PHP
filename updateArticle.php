<?php
include('connection.php');
$article=$_POST['Article'];
$part=$_POST['Part'];
$id=$_POST['Text'];
$newText=$_POST['updateText'];
$lang=$_POST['language'];
$category=$_POST['Type'];
$gender=$_POST['gender'];
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
session_start();
if($part==15)
{
  $sql="UPDATE UserFavourite SET Text='" . $newText . "' WHERE ID=" . $id . " AND Article=" . $article . " AND Category like '" . $category . "' AND Gender=" . $gender;
  $conn->query($sql);
}
else
{
    if($_SESSION['user_id']==1)
    {
      $sql="UPDATE " . $tableName . " SET Text='" . $newText . "' WHERE ID=" . $id;
      $conn->query($sql);
    }
    $sql="SELECT * FROM " . $tableName . " WHERE ID=" . $id . " AND Owner=1";
    $result=$conn->query($sql);
    if($_SESSION['user_id']!=1 && $result->num_rows>0)
    {
          $sql="SELECT * FROM TempTable WHERE OriginalID=" . $id;
          $result=$conn->query($sql);
          if($result->num_rows==0){
            $sql="INSERT INTO TempTable(OriginalID,Text,Part,Article,Category,Owner,Gender) VALUES(" . $id . ",'" . $newText . "'," . $part . "," . $article . ",'" . $category . "'," . $_SESSION['user_id'] . "," . $gender . ")";
            $conn->query($sql);
          }
          else{
            $sql="UPDATE TempTable SET Text='" . $newText . "' WHERE OriginalID=" . $id;
            $conn->query($sql);
          }
    }
    else
    {
          $sql="UPDATE " . $tableName . " SET Text='" . $newText . "' WHERE ID=" . $id;
          $conn->query($sql);
    }
}
$conn->close();
header('Location:' . $_SERVER['HTTP_REFERER']);
 ?>
