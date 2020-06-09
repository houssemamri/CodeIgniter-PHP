<?php 
# +------------------------------------------------------------------------+
# | Artlantis CMS Solutions                                                |
# +------------------------------------------------------------------------+
# | Lethe Newsletter & Mailing System                                      |
# | Copyright (c) Artlantis Design Studio 2014. All rights reserved.       |
# | Version       2.0                                                      |
# | Last modified 05.01.2015                                               |
# | Email         developer@artlantis.net                                  |
# | Web           http://www.artlantis.net                                 |
# +------------------------------------------------------------------------+
include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'lethe.php');
if(!isLogged()){die('<script>window.location.href="'. lethe_admin_url .'pg.login.php";</script>');}
include_once(LETHE.DIRECTORY_SEPARATOR.'/lib/lethe.class.php');
include_once(LETHE_ADMIN.DIRECTORY_SEPARATOR.'/inc/inc_module_loader.php');
include_once(LETHE_ADMIN.DIRECTORY_SEPARATOR.'/inc/org_set.php');
if(!isset($_GET['pos']) || empty($_GET['pos'])){$pos='';}else{$pos=trim($_GET['pos']);}
if(!isset($_GET['ID']) || !is_numeric($_GET['ID'])){$ID=0;}else{$ID=intval($_GET['ID']);}
if(!isset($_GET['getdata']) || empty($_GET['getdata'])){$getdata='';}else{$getdata=trim($_GET['getdata']);}
if(!isset($_GET['exctyp']) || empty($_GET['exctyp'])){$exctyp=0;}else{$exctyp=intval($_GET['exctyp']);}

/* Live Date */
if($pos=='getlivedate'){
	echo(date('d.m.Y H:i:s A'));
}

include_once(LETHE_ADMIN.DIRECTORY_SEPARATOR.'/inc/inc_auth.php');

/* Shell Tester */
if($pos=='shelltest'){
	if($getdata==''){$getdata='crontab';}
	
	if($exctyp==0){
		$output = ((shell_exec($getdata.' -l')) ? shell_exec($getdata.' -l'):false);
	}else{
		$output = ((exec($getdata.' -l')) ? exec($getdata.' -l'):false);
	}
	
	if($output!=false){
		if($output!=''){
			$output = htmlspecialchars($output,ENT_QUOTES,'UTF-8');
			$output = str_replace(PHP_EOL,'<br>',$output);
			$logz = '<div style="height:200px;overflow:auto;"><div style="white-space: nowrap;">'
					.'<strong>LOG:</strong><hr>'
					.$output
					.'</div></div>';
			die($logz);			
		}else{
			die(letheglobal_works);
		}
	}else{
		die(letheglobal_not_work_please_contact_to_hosting_service_provider_to_enable_shell_exec_or_use_single_cron_files_manually);
	}
}

/* Cron Resetter */
if($pos=='rstcron'){
	
	$letChr = new Crontab();
	$keepCron = array();
	$currJobs = $letChr->getJobs();
	
	foreach($currJobs as $crn){
		if(strpos($k, 'lethe') !== false){
			# Removes
		}else{
			# Keep
			$keepCron[] = $crn;
		}
	}
	
	# Remove Expired Tasks
	$db->where('pos=1')->delete('chronos');
	
	# Add Lethe Tasks
	$keepCron[] = set_min_cron." * * * * ". set_shell_cron_command ." '". lethe_root_url ."chronos/lethe.php' > /dev/null 2>&1";
	
	$getTasks = $db->get('chronos');
	foreach($getTasks as $gt){
		$keepCron[] = $gt['cron_command'];
	}
	
	# Remove All Cronjobs
	shell_exec(set_shell_command.' -r');
	
	# Load New Jobs
	foreach($keepCron as $k=>$v){
		$letChr->addJob($v);
	}
	
}

/* Advanced Cron Modifier */
if($pos=='advcron'){
	
	if($getdata==''){$getdata='crontab';}
	$output = ((shell_exec($getdata.' -l')) ? shell_exec($getdata.' -l'):false);
	
	# Simulate
	//$output = 'zaa'.PHP_EOL."*/5 * * * * /usr/bin/wget -O - -q 'http://lee/lethe/chronos/lethe.php' > /dev/null 2>&1";
	
	$draw = '<link rel="stylesheet" href="bootstrap/dist/css/bootstrap.min.css">'
		   .'<div class="container-fluid"><div class="row"><div class="col-md-12">'
		   .'<form method="POST" action="" id="cronMod">'
		   .'<h3>Current Tasks</h3><hr>';
		   if($output==false){
			   $draw.='<span class="text-danger">shell_exec does not work!</span>';
		   }else{
			   $output = explode(PHP_EOL,$output);
			   if(count($output)==0){
					$draw.='crontab empty';
			   }else{
				   foreach($output as $val=>$k){
					   if(strpos($k, 'lethe') !== false){
						$draw.='<div class="form-group"><span class="label label-danger">Remove: '. showIn($k,'page') .'</span></div>';
					   }else{
						$draw.='<div class="form-group"><span class="label label-success">Keep: '. showIn($k,'page') .'</span></div>';
					   }
				   }
			   }
		   }
		   
		   $draw.='<h3>Lethe Tasks</h3><hr>';
		   
		   $getTasks = $db->where('pos=0')->get('chronos');
		   $draw.="Main: <code>*/5 * * * * /usr/bin/wget -O - -q 'http://lee/lethe/chronos/lethe.php'  > /dev/null 2>&1</code><br>";
		   foreach($getTasks as $gt){
			   $draw.=(($gt['SAID']==0)?'Task':'Bounce').': <code>'. $gt['cron_command'] .'</code><br>';
		   }
		   $draw.='<hr><button type="submit" name="resetCron" id="resetCron" class="btn btn-success">Reset Cron</button>';
		   $draw.='</form></div></div></div>';
	die($draw);
}

/* Template Preview */
if($pos=='temprev'){
	$opTemp = $myconn->prepare("SELECT * FROM ". db_table_pref ."templates WHERE OID=". set_org_id ." AND ID=? ". ((LETHE_AUTH_VIEW_TYPE) ? ' AND UID='. LETHE_AUTH_ID .'':'') ."") or die(mysqli_error($myconn));
	$opTemp->bind_param('i',$ID);
	$opTemp->execute();
	$opTemp->store_result();
	if($opTemp->num_rows==0){echo(letheglobal_record_not_found);}
	$sr = new Statement_Result($opTemp);
	$opTemp->fetch();
	$opTemp->close();
	echo($sr->Get('temp_contents'));
}

/* Submission Account Details */
if($pos=='getSubInfos'){
	$subAccData = getSubmission($ID,0);
	$printData = '<div class="row">
		<div class="col-md-4">
			<p><strong>'. newsletter_daily_limit .':</strong></p>
			<p><strong>'. letheglobal_sending .':</strong></p>
			<p><strong>'. letheglobal_type .':</strong></p>
			<p><strong>'. newsletter_test_mail .':</strong></p>
		</div>
		<div class="col-md-8">
			<p>'. $subAccData['daily_sent'] .' / '. $subAccData['daily_limit'] .'</p>
			<p>'. $LETHE_MAIL_METHOD[$subAccData['send_method']] .'</p>
			<p>'. $LETHE_MAIL_TYPE[$subAccData['mail_type']] .'</p>
			<p>'. set_org_test_mail .'</p>
		</div>
	</div>';
	$printData.='
		<script>
			if($("#campaign_sender_title").val()==""){
				$("#campaign_sender_title").val("'. showIn(set_org_sender_title,'input') .'");
			}
			if($("#campaign_reply_mail").val()==""){
				$("#campaign_reply_mail").val("'. showIn(set_org_reply_mail,'input') .'");
			}
		</script>
	';
	echo($printData);
}

# End
//if(isset($myconn)){$myconn->close();unset($myconn);ob_end_flush();}
?>