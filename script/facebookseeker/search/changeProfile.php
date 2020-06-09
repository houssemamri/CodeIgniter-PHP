<?php
session_start();
$result = array();

if(isset($_REQUEST['username']) && trim($_REQUEST['username']) != '' 
        && isset($_REQUEST['password']) && trim($_REQUEST['password']) !=''
        && isset($_REQUEST['_action']) && $_REQUEST['_action'] == 'changeaccount'
        && isset($_REQUEST['_method']) && $_REQUEST['_method'] == 'JXR'){
            

    $username  = trim($_REQUEST['username']);
    $password = sha1(trim($_REQUEST['password']));
    
    
    $account = array('username' => $username, 'password' => $password);
    
    $accountfile = '../login/account.dat';
    //
    
    $accounts= json_decode(file_get_contents($accountfile));
    $updatable = true;
    foreach($accounts->users as $a){
        if($a->username == $username && $a->username != $_SESSION['user']){
            $updatable = false;
            $result['type'] = 'exist';
        }
    }
    if($updatable === true){
        foreach($accounts->users as $a){
            if($a->username == $_SESSION['user']){
                $_SESSION['user'] = $username;
                $a->username = $username;
                $a->password = $password;
            }
        }
        
        $f = fopen($accountfile, 'w');
        if (!$f) {
             $result['type'] = 'danger';
        }
        else if (fwrite($f, json_encode($accounts)) === FALSE) {
            $result['type'] = 'danger';
        }
        else{
            $result['type'] ='success';
        }
        fclose($f);
    }

    
    $result['username'] = $username;
}
else{

    $result['type'] = 'danger';
}
echo json_encode($result);

?>
