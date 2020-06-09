<?php
include('connection.php');
include('setLanguage.php');
session_start();
$article=$_POST['article'];
$lang=$_POST['lang'];
$category=$_POST['type'];
$owner=$_SESSION['user_id'];
$special=$_POST['special'];
$gender=$_POST['sex'];
$str="";
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
$count=0;
$res=$_POST['partArray'];
$headerStyle="<div class=\"header\"></div><br />";
$header=array("","Réponse Avis Positifs","Réponse Avis Négatifs","Réponse Positive Simple","Réponse Positif Anglais","Réponse Négatif Anglais","Réponse Positive Anglais","Réponse Négative Anglais","Réponse Positive Simple Anglais","Réponse Positive Espagnol","Réponse Négative Espagnol","Réponse Positive Simple Espagnol");
foreach($res as $array){
  if($array==0)
    $count++;
}
if($count<10)
{
  $str="<div class=\"articleHeader\">" . $header[$article] . "</div><br />";
  $str .="<div id=\"generateBody\">";
  //$str="<img id='imageBox' src='img/" . $ansbox ."' /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
  //$str.="<div id='textBox'>";
  foreach($res as $i)
  {
    if($i!=0){
      //$sql="SELECT * FROM " . $tableName . " WHERE PART=" . $array . " ORDER BY RAND() LIMIT 1";
      $sql="SELECT OriginalID as ID,Text FROM TempTable WHERE Article=" . $article . " AND Part=" . $i . " AND Category like '" . $category .
      "' AND owner=" . $owner . " AND Gender=" . $gender . " UNION SELECT ID,Text FROM " . $tableName . " WHERE ID NOT IN ( SELECT OriginalID FROM TempTable WHERE Owner=" . $owner . ") AND Owner=1 AND part=" . $i . " AND Category like '" . $category . "' AND Gender=" . $gender . " UNION SELECT ID,Text FROM " . $tableName .
      " WHERE owner=" . $owner . " AND Part=" . $i . " AND Category like '" . $category . "' AND Gender=" . $gender . " ORDER BY RAND() LIMIT 1";
      $result=$conn->query($sql);
      $row=$result->fetch_assoc();
      $str .= $row['Text'];
      $str .= "<br />";
      }
    }
    $str .="</div><br />";
}
else{
    $str="<div class=\"articleHeader\">" . $header[$article] . "</div><br />";
    $str .="<div id=\"generateBody\">";
    //$str="<img id='imageBox' src='img/" . $ansbox ."' /><br /><br /><br /><br /><br /><br /><br /><br /><br />";
    //$str.="<div id='textBox'>";
    $sql="SELECT max(Part) as high FROM " . $tableName;
    $result=$conn->query($sql);
    $row1=$result->fetch_assoc();
    for($i=1;$i<=$row1['high'];++$i){
      $sql="SELECT OriginalID as ID,Text FROM TempTable WHERE Article=" . $article . " AND Part=" . $i . " AND Category like '" . $category .
      "' AND owner=" . $owner . " AND Gender=" . $gender . " UNION SELECT ID,Text FROM " . $tableName . " WHERE ID NOT IN ( SELECT OriginalID FROM TempTable WHERE Owner=" . $owner . ") AND Owner=1 AND part=" . $i . " AND Category like '" . $category . "' AND Gender=" . $gender . " UNION SELECT ID,Text FROM " . $tableName .
      " WHERE owner=" . $owner . " AND Part=" . $i . " AND Category like '" . $category . "' AND Gender=" . $gender . " ORDER BY RAND() LIMIT 1";
      $result=$conn->query($sql);
      $row=$result->fetch_assoc();
      $str .= $row['Text'];
      $str .= "<br />";
    }
}
if($special==1){
  $sql="SELECT * FROM UserFavourite WHERE UID=" . $owner . " AND Article=" . $article . " AND Category like'" . $category . "' AND Gender=" . $gender;
  $result=$conn->query($sql);
  if($result->num_rows>=0){
      $row=$result->fetch_assoc();
      $str .= $row['Text'] . "<br />";
  }
}
$str .="</div><br />";
$conn->close();
echo $str;
?>
