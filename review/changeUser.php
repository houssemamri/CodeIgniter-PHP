<?php
session_start();
$_SESSION['user_id']=$_GET['id'];
header('Location: ' . 'profile.php?id=' . $_GET['id'] . "&status=success");
 ?>
