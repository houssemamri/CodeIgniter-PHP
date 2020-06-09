<html>
<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: anas
 * Date: 1/26/2020
 * Time: 9:53 PM
 */
ini_set('display_errors', 1);
session_start();
if($_POST['img']&&strlen($_POST['img'])>1) {

    require_once('../connection.php');
    $user_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM fb_setting WHERE user_id=" . $user_id;
    $result = $conn->query($sql);
    $row = $result->fetch_array();
    https://graph.facebook.com/1888052194672982?fields=access_token&access_token=EAAIc4lUFxCEBAD4lwULJSxxjZBrqWpU0Q7rBQZCC920hKL7W2p5UvoMWQfXdA0ZBlENq5ZCMPGD2eAfavGY4Gp2pgAWlHm3ZAT5hePdZCps0cLVM2r65Rb9mi3nFfAfJ4P5wPPGyBZCZAxR75suQnIuj7bfNTZC3wL6Jn2ObHXEvRdAZDZD
    // set post fields
    $ch = curl_init('https://graph.facebook.com/' . $row['fb_page_id'] . '/?fields=access_token&access_token=' . $row['access_token']);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    $respon_decode = json_decode($response);
    $token = $respon_decode->access_token;
//    var_dump($token);

    $post = [
        'url' => $_POST['img'],
        'message' => $_POST['message'],
        'published'=>'true',
        'access_token' => $token
    ];

    $ch = curl_init('https://graph.facebook.com/' . $row['fb_page_id'] . '/photos');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
    $response = curl_exec($ch);
    curl_close($ch);
//    var_dump($post);
//    var_dump($response);
    $response_decode = json_decode($response);
    if($response_decode->post_id){
        echo '<div class="alert alert-warning" role="alert">
                QR code posted! This window will close in 5 seconds
                </div>';
        echo '<script> setTimeout(function() { window.close(); }, 5000);</script>';

    }

}
//
//$post = [
//    'message' => 'test'
//];
//
//$ch = curl_init('https://graph.facebook.com/1888052194672982/feed?message=test&access_token=EAAIc4lUFxCEBAO4a0O2rb9enr2kOgDThsz4gKK9rnZCWAKduoZCpLapstl4eclFkUdDTUMgGt426UUNFlR6cDIZCRuZCdSamLV1BVvbYbwYSyEZCvBI2OviWVFN8KJVz6CQBC8WYhSIrFjmItFHNFTsJEAUZChT3ZAiP7NSfiOFiwZDZD');
//curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
//
//// execute!
//$response = curl_exec($ch);
//
//// close the connection, release resources used
//curl_close($ch);
//
//// do anything you want with your response
//var_dump($response);?>
<form action="" method="post">
    <label>QR code:</label><br>
    <img src="https://review-thunder.com/<?=urldecode($_GET['url'])?>"><br>

    <input type="hidden" name="img" value="https://review-thunder.com/<?=urldecode($_GET['url'])?>"><br>

    <label for="Message">Message:</label><br />
    <textarea name="message" rows="20" cols="20" id="message"></textarea>

    <input type="submit" name="submit" value="Submit" />
</form>

</body>
</html>