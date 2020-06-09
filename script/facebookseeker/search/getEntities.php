<?php
session_start();

if(isset($_SESSION['bp_logged']) && $_SESSION['bp_logged'] === TRUE){
    require_once('../config.php');
    require_once('../class/entities.php');
    $results = array('No valid token in Entities');
    if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['q']) && $_POST['q'] !='' && isset($_POST['type']) && $_POST['type'] != ''  && isset($_POST['limit']) && $_POST['limit'] > 0){
        require_once('getFbToken.php');
        $access_token = getFbToken($config['APP_ID'], $config['APP_SECRET']);

        if( $access_token === false){
            echo json_encode($results);
        }
        else{
            $text = (string) trim($_POST['q']);
            $type = (string) trim($_POST['type']);
            $limit = (int) trim($_POST['limit']);
            $limit = ($limit > 500) ? 500 : $limit;
            $grabber = new Grabber($access_token);
            $results = $grabber->getEntitiesList($text, $type, $limit);
            echo json_encode($results);
        }
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
