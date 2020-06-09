<?php
include('connection.php');
session_start();
$UID = $_POST['company'];
$sql="DELETE FROM Master WHERE MasterID=" . $_SESSION['master_id'] . " AND SubId=" . $UID;
$conn->query($sql);
$sql="DELETE FROM UserTable WHERE UID=" . $UID;
$conn->query($sql);
$sql="DELETE FROM imageUser WHERE UID=" . $UID;
$conn->query($sql);
$conn->close();
?>
