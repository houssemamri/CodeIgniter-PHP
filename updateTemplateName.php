<?php
include('connection.php');
$EID = $_POST['eid'];
$name = $_POST['tempName'];


$sql="UPDATE templates SET name='" . $name . "' WHERE id = " . $EID;

$conn->query($sql);
$conn->close();
?>
