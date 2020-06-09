<?php
if($_POST['bubble_post']) {
    include_once '../connection.php';
    session_start();
    $user_id = $_SESSION['user_id'];
    $avatar = (int) $_POST['bubble_post'];
    $sql = "update UserTable set bubble = '$avatar' where UID = '$user_id'";
    var_dump($sql);
    $result = $conn->query($sql);
}