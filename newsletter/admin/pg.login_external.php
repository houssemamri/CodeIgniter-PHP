<?php 
# +------------------------------------------------------------------------+
# | Artlantis CMS Solutions                                                |
# +------------------------------------------------------------------------+
# | Lethe Newsletter & Mailing System                                      |
# | Copyright (c) Artlantis Design Studio 2014. All rights reserved.       |
# | Version       2.0                                                      |
# | Last modified 31.10.2014                                               |
# | Email         developer@artlantis.net                                  |
# | Web           http://www.artlantis.net                                 |
# +------------------------------------------------------------------------+
include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'lethe.php');
$sirius->langFiles[] = 'letheglobal_front.php';
$sirius->langFiles[] = 'subscribers_back.php';
$sirius->loadLanguages();
include_once(LETHE.DIRECTORY_SEPARATOR.'/lib/lethe.class.php');




if (isset($_GET['logout']))
{
	$letheCookie = new sessionMaster;
	$letheCookie->sesList = "lethe,lethe_login";
	$letheCookie->sessDestroy();
	header('Location:/logout.php');
	die();
}


if (isset($_GET['login']))
{
	// echo $_GET['login'];
	// $myconn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );;
	$LTH = $myconn->stmt_init();
	// $LTH = $myconn->prepare("SELECT ID,OID,pass,private_key,isActive,mail,last_login FROM ". db_table_pref ."users WHERE mail=? AND isActive=1") or die(mysqli_error($myconn));
	$LTH = $myconn->prepare("SELECT ID,OID,pass,private_key,isActive,mail,last_login FROM ". db_table_pref ."users WHERE mail=?") or die(mysqli_error($myconn));
	$LTH->bind_param('s',$_GET['login']);
	$LTH->execute();
	$LTH->store_result();
	if($LTH->num_rows==0){
		$errText = errMod('* '. letheglobal_incorrect_login_informations .'','danger');
	}else{
		$sr = new Statement_Result($LTH);
		$LTH->fetch();
		// if(encr($_POST['pass']) != $sr->Get('pass')){
			// $errText = errMod('* '. letheglobal_incorrect_login_informations .'','danger');
		// }else{
		/* Create New Token */
		$logToken = encr($sr->Get('ID').$sr->Get('private_key').$sr->Get('OID').time().uniqid());
		if(DEMO_MODE){$logToken=encr('lethe_demo_mode');}
		$sessionTime=time()+(11800);
		// if(isset($_POST['remember']) && $_POST['remember']=='YES'){
		// 	$sessionTime=time() + (10 * 365 * 24 * 60 * 60);
		// }

		/* Create Cookie */
		$letheCookie = new sessionMaster;
		$letheCookie->sesName = "lethe";
		$letheCookie->sesVal = $logToken;
		$letheCookie->sesTime = $sessionTime;
		$letheCookie->sessMaster();
		// print_r($letheCookie);
		/* Login Cache */
		$letheCookie->sesName = "lethe_login";
		$letheCookie->sesVal = $sr->Get('last_login');
		$letheCookie->sesTime = $sessionTime;
		$letheCookie->sessMaster();
		/* Update Login Data */
		$myconn->query("UPDATE ". db_table_pref ."users SET last_login='". date("Y-m-d H:i:s") ."',session_token='". $logToken ."',session_time='". date("Y-m-d H:i:s",$sessionTime) ."' WHERE ID=". $sr->Get('ID') ."") or die(mysqli_error($myconn));
		$errText = errMod('<strong>'. letheglobal_you_have_been_successfully_logged_in .'!</strong><br>
			'. letheglobal_youll_redirect_to_dashboard_in_5_seconds .'. <a href="index.php?p=dashboard" class="alert-link">'. letheglobal_click_here .'</a>
			<meta http-equiv="refresh" content="5; url=index.php" />
			'
			,'success');
		$loginSucc = true;
	}
	$LTH->close();
}
