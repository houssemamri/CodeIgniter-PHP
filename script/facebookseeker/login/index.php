<?php
session_start();
// INDEX LOGIN


if(isset($_SESSION['bp_logged']) && $_SESSION['bp_logged'] === TRUE){
    
    header('Location: ../search/');
    exit();
}
else{
    if ($_SERVER['REQUEST_METHOD'] === 'POST'){
        $username  = '';
        $password  = '';
        if(isset($_POST['username'])) $username  = trim($_POST['username']);
        if(isset($_POST['password']))  $password = sha1(trim($_POST['password']));

        $accounts = json_decode(file_get_contents('account.dat'));
        foreach($accounts->users as $account){
            if($account->username == $username && $account->password == $password){
                $_SESSION['user'] = $account->username;
                $_SESSION['bp_logged'] = TRUE;
                header('Location: ../search/');
                exit();
            }
        }
        
        header('Location: ../?login_error');
        exit();
    }
    else{
            header('Location: ../');
            exit();
        }
}
?>
