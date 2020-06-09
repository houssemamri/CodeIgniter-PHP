<?php
/*  +------------------------------------------------------------------------+ */
/*  | Artlantis CMS Solutions                                                | */
/*  +------------------------------------------------------------------------+ */
/*  | Lethe Newsletter & Mailing System                                      | */
/*  | Copyright (c) Artlantis Design Studio 2014. All rights reserved.       | */
/*  | Version       2.0                                                      | */
/*  | Last modified 25.02.2015                                               | */
/*  | Email         developer@artlantis.net                                  | */
/*  | Web           http://www.artlantis.net                                 | */
/*  +------------------------------------------------------------------------+ */
include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'lethe.php');
include_once(dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR.'lib/lethe.class.php');
$ID = ((!isset($_GET['ID']) || !is_numeric($_GET['ID'])) ? 0:intval($_GET['ID']));


$errLogs = array();
$phase = rand(5000,10000);

# Load Organization Settings For First Time
# This Only Fetch Primary Organization For Lethe Lite Version!
$orgSets = array(); # Main Settings Stored in This Array (set_x)
$opOrg = new lethe();

# Limit Control
if(!$opOrg->loadOrg(1)){
	die("* Organization Not Found or Limits Exceeded!");
}

$LETHE_ORG_SETS['set_org_name'] = $orgSets['set_org_name'];

/* Memory Settings */
@set_time_limit(0);
@date_default_timezone_set($orgSets['set_org_timezone']); # Org Timezone
@ini_set('memory_limit','512M');
$errLogs[] = "Server: Timezone &gt; " . date_default_timezone_get();
$errLogs[] = "Server: Current Date is &gt; " . date("Y-m-d H:i:s A");
if(!ini_get('safe_mode')){
	$errLogs[] = "Error: PHP Safe Mode Active, set_time_limit May Not Work Properly";
}
$errLogs[] = "Server: Current Script Execute Time &gt; " . ini_get('max_execution_time');
$errLogs[] = "Server: Current Memory Limit &gt; "  . ini_get('memory_limit');;

/* Open Campaigns */
$opCamp = $db->where('campaign_type=1 AND (campaign_pos=0 OR campaign_pos=1) AND launch_date<=?',array(date("Y-m-d H:i:s")))->get('campaigns');

foreach($opCamp as $kkey=>$opCampRs){
	# LOG **
	$errLogs[] = "* [". $kkey ."] - Campaign Data Loaded - " . date("Y-m-d H:i:s A");
	# LOG **
	$errLogs[] = "* [". $kkey ."] - Organization Data Loaded - " . date("Y-m-d H:i:s A");
	
		# AUTORESPONDER #################################################################################################################
			
			# LOG **
			$errLogs[] = "* [". $kkey ."] - Engine Settings Initialization - " . date("Y-m-d H:i:s A");
			
			# Mail Settings Init
			$opOrg->OID=$opCampRs['OID'];
			$opOrg->OSMID=$opCampRs['campaign_sender_account'];
			$opOrg->sub_from_title = showIn($opCampRs['campaign_sender_title'],'page');
			$opOrg->sub_reply_mail = showIn($opCampRs['campaign_reply_mail'],'page');
			$opOrg->sub_mail_attach = $opCampRs['attach'];
			$opOrg->orgSubInit(); # Load Submission Settings
			$opOrg->sub_mail_id = $opCampRs['campaign_key'];
			$setMailPerConn = $orgSets['set_send_per_conn'];
			$setMailPerConnCount = 0;
			
			# Static Short Code Replaces
			# LOG **
			$errLogs[] = "* [". $kkey ."] - Static Data Rendering Started - " . date("Y-m-d H:i:s A");
			$replaced = $opOrg->shortReplaces(array(
													$opCampRs['subject'],
													$opCampRs['details'],
													$opCampRs['alt_details']
													));
													
			# Campaign Group Loader
			# LOG **
			$errLogs[] = "* [". $kkey ."] - Campaign Groups Initialization - " . date("Y-m-d H:i:s A");
			$subGrps = array();
			$opCampGrp = $db->where("OID=? AND CID=?",array($opCampRs['OID'],$opCampRs['ID']))->get('campaign_groups');
			foreach($opCampGrp as $opCampGrpRs){$subGrps[] = " S.GID=". $opCampGrpRs['GID'] ." ";}
			if(count($subGrps)>0){
				# LOG **
				$errLogs[] = "* [". $kkey ."] - Campaign Groups Loaded";
				$subGrps = " (". implode(" OR ",$subGrps) .") ";
			}else{
				# LOG **
				$errLogs[] = "* [". $kkey ."] - Campaign Groups Corrupted";
			}
			
			# Subscriber datas will collect on this section
				$listLoadCond = array();
				
				# AR Condutions *******
				$opArDataRs = $db->where('OID=? AND CID=? AND ar_week_0=1 AND ar_week_1=1 AND ar_week_2=1 AND ar_week_3=1 AND ar_week_4=1 AND ar_week_5=1 AND ar_week_6=1',array($opCampRs['OID'],$opCampRs['ID']))->getOne('campaign_ar');
				if($db->count==0){
					# LOG **
					$errLogs[] = "* [". $kkey ."] - Autoresponder Settings Corrupted or Date Requirements Doesnt Meet - " . date("Y-m-d H:i:s A");
				}else{
					# LOG **
					$errLogs[] = "* [". $kkey ."] - Autoresponder Settings Loaded - " . date("Y-m-d H:i:s A");
					
					
				//echo(implode(' ',$listLoadCond));die();
				/* Render Conds */
				# LOG **
				$errLogs[] = "* [". $kkey ."] - Data Condution Settings End - " . date("Y-m-d H:i:s A");
				$listLoadCond = implode(' ',$listLoadCond);
				$sentData = array();

				
# Query Changes
# v.2.1 --> (U.CID=". $opCampRs['ID'] .") AND --> Removed for Unsubscription

				
				# ACTIONS
				
					# After Subscription
					if($opArDataRs['ar_type']==0){
						$date_prep = date("Y-m-d H:i:s");
						$db->where("(S.add_date <= date_sub('". $date_prep ."', interval ". $opArDataRs['ar_time'] ." ". $opArDataRs['ar_time_type'] ."))");
					# After Unsubscription
					}else if($opArDataRs['ar_type']==1){
						$date_prep = date("Y-m-d H:i:s");
					# Specific Date
					}else if($opArDataRs['ar_type']==2){
						$date_prep = date("Y-m-d H:i:s");
						
					# Special Date
					}else if($opArDataRs['ar_type']==3){
						$date_prep = date("Y-m-d H:i:s");
						# Remove Older Year Tasks
						$myconn->query("DELETE FROM ". db_table_pref ."tasks WHERE OID=". $opCampRs['OID'] ."  AND YEAR(add_date)<". date("Y") ." AND CID=". $opCampRs['ID'] ."") or die(mysqli_error($myconn));
						$db->where("(S.subscriber_date BETWEEN '". $date_prep ."' - INTERVAL ". $opArDataRs['ar_time'] ." ". $opArDataRs['ar_time_type'] ." AND '". $date_prep ."' + INTERVAL ". $opArDataRs['ar_time'] ." ". $opArDataRs['ar_time_type'] .")");
					} # Act End
				
				$db->join("tasks T", "T.CID=". $opCampRs['ID'] ." AND S.subscriber_mail=T.subscriber_mail", "LEFT");
				if($opArDataRs['ar_type']!=1){
					$db->join("unsubscribes U", "U.CID=". $opCampRs['ID'] ." AND S.subscriber_mail=U.subscriber_mail", "LEFT");
				}else{
					$db->join("unsubscribes U","U.CID=". $opCampRs['ID'] ."", "LEFT");
				}
				
				$db->where("S.OID=". $orgSets['set_ID'] ."");
				$db->where("(T.subscriber_mail IS NULL)");
				if($opArDataRs['ar_type']!=1){
					$db->where('(U.subscriber_mail IS NULL)');
				}else{
					$db->where("(U.add_date > date_sub('". $date_prep ."', interval ". $opArDataRs['ar_time'] ." ". $opArDataRs['ar_time_type'] ."))");
				}
			
				
				# ACTIONS END
				
				# Dont Use Group, Verify Cond On Unsubscriber Callbacks
				if($opArDataRs['ar_type']!=1){
					# Verify Mode Cond (If Verify Type Selected as "All" This Condition Will Escaped)
					if($orgSets['set_org_load_type']==1){ # Only Active Subscribers There No Verify Control (Single / Double Verified Will Include)
						$db->where('(S.subscriber_active=1)');
						# LOG **
						$errLogs[] = "* [". $kkey ."] - Active Subscriber Selection - " . date("Y-m-d H:i:s A");
					}
					else if($orgSets['set_org_load_type']==2){ # Only Active and Single Verified Subscribers
						$db->where('(S.subscriber_active=1 AND S.subscriber_verify=1)');
						# LOG **
						$errLogs[] = "* [". $kkey ."] - Active + Single Verified Subscriber Selection - " . date("Y-m-d H:i:s A");
					}else{
						# LOG **
						$errLogs[] = "* [". $kkey ."] - Continue for Condition Set Without Active / Verify Controls - " . date("Y-m-d H:i:s A");
					}
					
					# Group Selection
					$db->where($subGrps);
				}
				
				
				# Load Type
				# If Random Load Option is Active
				# Thats will protect your repeated mails, if you cancel a campaign in progress
				if($orgSets['set_org_random_load']==1){
					$db->orderBy("RAND ()");
				}
				
				$opSubs = $db->get('subscribers S',200,"S.*");
				
				# LOG **
				$errLogs[] = "* [". $kkey ."] - Subscriber Statement<blockquote><code><pre>".$db->getLastQuery()."</pre></code></blockquote>";
										
				# Update to Completed and Add Cron Remover
				if($db->count==0){
					# LOG **
					$errLogs[] = "* [". $kkey ."] - There No Subscriber(s) Found, Task Complete or Error Occured - " . date("Y-m-d H:i:s A");
					$errLogs[] = "* [". $kkey ."] - Cron Remover Active - " . date("Y-m-d H:i:s A");
					$errLogs[] = "* [". $kkey ."] - Campaign Marked as Completed - " . date("Y-m-d H:i:s A");
					
					# Mark it Completed after tasks end (for Specific Date, ar_end option will check on next phase)
						# ------- Settings will apply after all tasks done -----
						if($opArDataRs['ar_type']==2){
							# Reset AR If Finish Date Reach
							$date_prep_end = date("Y-m-d H:i:s",strtotime($opArDataRs['ar_end_date']));
							if($date_prep_end<=$date_prep){
							
								# Mark It Complete and Remove Cron If "End Campaign" Active
								if($opArDataRs['ar_end']==1){
									$db->where('OID=? AND ID=?',array($orgSets['set_ID'],$opCampRs['ID']))->update('campaigns',array('campaign_pos'=>3));
									$db->where('OID=? AND CID=?',array($orgSets['set_ID'],$opCampRs['ID']))->update('chronos',array('pos'=>1));
								}else{
									# Reset All Data and Update New Cron Date
									# New Launch Date
									$genDate = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s") . " +". $opArDataRs['ar_time'] ." ". $opArDataRs['ar_time_type'] .""));
									# New Finish Date
									$difference = dateDiff(strtotime($opCampRs['launch_date']),strtotime($opArDataRs['ar_end_date']));
									$genFinDate = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s") . " +". $difference .""));
									$db->where('OID=? AND ID=?',array($orgSets['set_ID'],$opCampRs['ID']))->update('campaigns',array('campaign_pos'=>0,'launch_date'=>$genDate));
									$db->where('OID=? AND CID=?',array($orgSets['set_ID'],$opCampRs['ID']))->update('campaign_ar',array('ar_end_date'=>$genFinDate));

									# Remove Old Cron ---- DISABLED ----
									# $db->where('OID=? AND CID=?',array($orgSets['set_ID'],$opCampRs['ID']))->update('chronos',array('pos'=>1));
									# Add New Cron ---- DISABLED ----
									# $buildCron = new lethe();
									# $buildCron->chronosMin = "*";
									# $buildCron->chronosURL = "'".lethe_root_url.'chronos/lethe.tasks.php?ID='.$opCampRs['ID']."' > /dev/null 2>&1";
									# $genComm = $buildCron->buildChronos();
									
									# $db->insert('chronos',array('OID'=>$orgSets['set_ID'],'CID'=>$opCampRs['ID'],'pos'=>1,'cron_command'=>$genComm,'launch_date'=>$genDate));
									
									# Remove Datas
									$db->where('OID=? AND CID=?',array($orgSets['set_ID'],$opCampRs['ID']))->delete('tasks');
									$db->where('OID=? AND CID=?',array($orgSets['set_ID'],$opCampRs['ID']))->delete('reports');
									# Close Phase For New Settings
								}
							
							}else{
								# Campaign Continues
									# Reset All Data and Update New Cron Date
									# New Launch Date
									$genDate = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s") . " +". $opArDataRs['ar_time'] ." ". $opArDataRs['ar_time_type'] .""));
									# New Finish Date
									$difference = dateDiff(strtotime($opCampRs['launch_date']),strtotime($opArDataRs['ar_end_date']));
									$genFinDate = date('Y-m-d H:i:s', strtotime(date("Y-m-d H:i:s") . " +". $difference .""));
									$myconn->query("UPDATE ". db_table_pref ."campaigns SET campaign_pos=0,launch_date='". $genDate ."' WHERE OID=". $orgSets['set_ID'] ." AND ID = ". $opCampRs['ID'] ."") or die(mysqli_error($myconn));
									$myconn->query("UPDATE ". db_table_pref ."campaign_ar SET ar_end_date='". $genFinDate ."' WHERE OID=". $orgSets['set_ID'] ." AND CID = ". $opCampRs['ID'] ."") or die(mysqli_error($myconn));
									# Remove Old Cron ---- DISABLED ----
									# $db->where('OID=? AND CID=?',array($orgSets['set_ID'],$opCampRs['ID']))->update('chronos',array('pos'=>1));
									# Add New Cron ---- DISABLED ----
									# $buildCron = new lethe();
									# $buildCron->chronosMin = "*";
									# $buildCron->chronosURL = "'".lethe_root_url.'chronos/lethe.tasks.php?ID='.$opCampRs['ID']."' > /dev/null 2>&1";
									# $genComm = $buildCron->buildChronos();

									# $db->insert('chronos',array('OID'=>$orgSets['set_ID'],'CID'=>$opCampRs['ID'],'pos'=>0,'cron_command'=>$genComm,'launch_date'=>$genDate));
									
									# Remove Datas
									$db->where('OID=? AND CID=?',array($orgSets['set_ID'],$opCampRs['ID']))->delete('tasks');
									$db->where('OID=? AND CID=?',array($orgSets['set_ID'],$opCampRs['ID']))->delete('reports');
									# Close Phase For New Settings
							}
							# AR 2 Settings End
						}
						# ------- Settings will apply after all tasks done -----
				}else{
					# If Position is Pending Turn it to In Progress
					if($opCampRs['campaign_pos']==0){
						$db->where('ID=?',array($opCampRs['ID']))->update('campaigns',array('campaign_pos'=>1));
						# LOG **
						$errLogs[] = "* [". $kkey ."] - New Campaign Started, Campaign Marked as In Progress - " . date("Y-m-d H:i:s A");
					}else{
						# LOG **
						$errLogs[] = "* [". $kkey ."] - Task Handler Started - " . date("Y-m-d H:i:s A");
						$errLogs[] = "* [". $kkey ."] - System Goes to Fetch Subscribers With Setting Condution - " . date("Y-m-d H:i:s A");
					}
				}
				
				# Add Sent Mails
				# Add Sent Mails (Fixed 2.1 - Moved to Engine)
				// $addSents = $myconn->prepare("INSERT INTO ". db_table_pref ."tasks SET OID=". $orgSets['set_ID'] .",CID=". $opCampRs['ID'] .",subscriber_mail=?") or die(mysqli_error($myconn));
				$opOrg->isCampID = $opCampRs['ID'];
				
				
				# LOAD SUBSCRIBERS START ###########################################
				$ireplaced = array();
				foreach($opSubs as $opSubsRs){
															
					# User Specific SC Replaces Start ******************************************
					foreach($replaced as $rk=>$rv){
						$rvVal = $rv;
						
						# Auto Track
						$rvVal = makeTrack($rvVal,$opCampRs['campaign_key'],$opSubsRs['subscriber_key']);
						
						$frKeys = array(
											'#\{?(NAME_PREFIX)\}#'=>(($opSubsRs['subscriber_tag']=='' || $opSubsRs['subscriber_tag']=='NOTAG') ? '':$opSubsRs['subscriber_tag']),
											'#\{?(SUBSCRIBER_NAME)\}#'=>(($opSubsRs['subscriber_name']=='') ? '':$opSubsRs['subscriber_name']),
											'#\{?(SUBSCRIBER_MAIL)\}#'=>(($opSubsRs['subscriber_mail']=='') ? '':$opSubsRs['subscriber_mail']),
											'#\{?(SUBSCRIBER_WEB)\}#'=>(($opSubsRs['subscriber_web']=='') ? '':$opSubsRs['subscriber_web']),
											'#\{?(SUBSCRIBER_PHONE)\}#'=>(($opSubsRs['subscriber_phone']=='') ? '':$opSubsRs['subscriber_phone']),
											'#\{?(SUBSCRIBER_COMPANY)\}#'=>(($opSubsRs['subscriber_company']=='') ? '':$opSubsRs['subscriber_company']),
											'#\{?(NEWSLETTER_LINK\[(.*?)\])\}#'=>'<a href="'. lethe_root_url .'lethe.newsletter.php?pos=web&amp;id='. $opCampRs['campaign_key'] .'&amp;sid='. $opSubsRs['subscriber_key'] .'">$2</a>',
											'#\{?(RSS_LINK\[(.*?)\])\}#'=>'<a href="'. $orgSets['set_org_rss_url'] .'">$2</a>',
											'#\{?(UNSUBSCRIBE_LINK\[(.*?)\])\}#'=>'<a href="'. lethe_root_url .'lethe.newsletter.php?pos=unsubscribe&amp;id='. $opCampRs['campaign_key'] .'&amp;sid='. $opSubsRs['subscriber_key'] .'&amp;oid='. $orgSets['set_public_key'] .'">$2</a>',
											'#\{?(VERIFY_LINK\[(.*?)\])\}#'=>'', # Verify Link Cannot Be Use In Campaigns
										);
						$rvVal = preg_replace(array_keys($frKeys), $frKeys,$rvVal);
						
						
						# Track Link
						$rvVal = preg_replace_callback('#\{?(TRACK_LINK\[(.*?)\]\[(.*?)\])\}#',
														create_function(
															'$matches',
															'return \'<a href="'. lethe_root_url .'lethe.newsletter.php?pos=track&amp;id='. $opCampRs['campaign_key'] .'&amp;sid='. $opSubsRs['subscriber_key'] .'&amp;redu=\'. letheURLEnc($matches[3]) .\'" target="_blank">\'. trckTextMod($matches[2]) .\'</a>\';'
														)
														,$rvVal);
						
						$ireplaced[$rk] = $rvVal;
					}

					# User Specific SC Replaces End ***********************************************
					
					$rcSubject = $ireplaced[0];
					$rcBody = $ireplaced[1];
					$rcAltBody = $ireplaced[2];
					
					/* Add Open Tracker */
					$rcBody .= '<img src="'. lethe_root_url .'lethe.newsletter.php?pos=opntrck&amp;id='. $opCampRs['campaign_key'] .'&amp;sid='. $opSubsRs['subscriber_key'] .'" alt="" style="display:none;">';
															
					/* Design Receiver Data */

					$rcMail = showIn($opSubsRs['subscriber_mail'],'page');
					$rcName = showIn($opSubsRs['subscriber_name'],'page');
					$sentData[$rcMail] = array(
												'name'=>$rcName,
												'subject'=>$rcSubject,
												'body'=>$rcBody,
												'altbody'=>$rcAltBody,
												'subkey'=>$opSubsRs['subscriber_key']
												);
																
					# Save Sent Mails
/* 					$addSents->bind_param('s',$rcMail);
					$addSents->execute(); */
					/* Fixed 2.1 (Sent Stats Moved to Engine From Here) */
					$setMailPerConnCount++;
					
												
					# Send Mails With Per Conn Limit Start ****
					if($setMailPerConnCount>=$setMailPerConn){
						$opOrg->sub_mail_receiver = $sentData;
						$opOrg->letheSender();
						$setMailPerConnCount=0; # Reset Conn Limit
						
						# LOG **
						$errLogs[] = "Progress ($phase): Rendered Data Send to Mail Engine - " . date("Y-m-d H:i:s A");
						$errLogs[] = "Progress ($phase): System Goes to Standby Mode - " . date("Y-m-d H:i:s A");
						
						# Go Standby
						sleep($orgSets['set_standby_time']);
					}
					# Send Mails With Per Conn Limit End ****
												
				}
				# LOAD SUBSCRIBERS END ###########################################
				
					# Send All Mails If Count Less Than Limit ****
						$opOrg->sub_mail_receiver = $sentData;
						$opOrg->letheSender();
						//print_r($sentData);
						$setMailPerConnCount=0; # Reset Conn Limit
						
						/* Fixed 2.1 (Sent Stats Moved to Engine From Here) */
						
						# Go Standby
						sleep($orgSets['set_standby_time']);
					# Send All Mails If Count Less Than Limit ****
						
				}
				# AR Condutions End *******
				
			/* Load Subscribers End */
			# LOG
			$errLogs[] = "Progress ($phase): Campaign Task Phase Finished!";
			

		
}

/* Show Log */
if(lethe_debug_mode){
	$errLogStr = '';
	foreach($errLogs as $k=>$v){
		$errLogStr.=$v.'<br>';
	}
	echo($errLogStr);
}

/* Clear Cache */
ob_end_flush();
?>