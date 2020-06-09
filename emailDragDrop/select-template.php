<?php
session_start();
require '../connection.php';
$user_id = $_SESSION['user_id'];
$return = '<select></select>';
$sql = "SELECT * FROM templates where user_id = '$user_id' ORDER BY ID DESC";
//echo $sql;
$query = mysqli_query($conn,$sql);
$i = 0;
while($result = mysqli_fetch_assoc($query)){
    if($i==0)
        $return .= '<option value="'.$result['link'].'" selected>'.$result['name'].'</option>';
    else
        $return .= '<option value="'.$result['link'].'">'.$result['name'].'</option>';

    $i++;
}
echo $return;