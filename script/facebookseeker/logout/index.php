<?php
session_start();
unset($_SESSION['bp_logged']);
session_unset();
session_destroy();
if(isset($_GET['type']) && $_GET['type'] == 'authorize'){
    header('Location: ../?error_authorize');
}
else{
    header('Location: ../');
}
exit();
 
?>
