<?php
if($_POST['avatar_post']) {
    include_once '../connection.php';
    session_start();
    $user_id = $_SESSION['user_id'];
    $avatar = (int) $_POST['avatar_post'];
    $sql = "update UserTable set avatar = '$avatar' where UID = '$user_id'";
    var_dump($sql);
    $result = $conn->query($sql);
}