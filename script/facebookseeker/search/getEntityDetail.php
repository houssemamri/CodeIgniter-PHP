<?php
session_start();
if(isset($_SESSION['bp_logged']) && $_SESSION['bp_logged'] === TRUE){
    require_once('../config.php');
    require_once('../class/entities.php');
    $results = array('No valid token in Entity detail');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['e']) && $_POST['e'] !='' && isset($_POST['t']) && $_POST['t'] != ''){
        require_once('getFbToken.php');
        $access_token = getFbToken($config['APP_ID'], $config['APP_SECRET']);
        $entity = (string) trim($_POST['e']);
        $type = (string) trim($_POST['t']);
        $grabber = new Grabber($access_token);
        $grabber->setType($type);
        $result = $grabber->getEntityDetail($entity);
        echo json_encode($result);
    }
    else{
        echo json_encode($results);
    }

?>
<?php
}
else{

    header('Location: ../');
    exit();

}


?>
