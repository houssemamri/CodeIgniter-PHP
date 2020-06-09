<?php
session_start();
$_SESSION['language']=$_GET['lang'];
header('Location: ' . $_SERVER['HTTP_REFERER']);
?>
