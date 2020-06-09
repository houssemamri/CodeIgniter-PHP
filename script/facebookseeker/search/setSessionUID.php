<?php
session_start();
if(isset($_POST['UID']) && $_POST['UID'] !=''){
    $_SESSION['UID'] = $_POST['UID'];
}
return $_SESSION['UID'];
?>
