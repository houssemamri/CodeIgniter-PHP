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

# Print Organization Informations
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
$errLogs[] = '<hr>';

# It's required for different timezone setting
$opCampSet = $db
				->where('launch_date <= ? AND campaign_type=0 AND (campaign_pos=0 OR campaign_pos=1)',array(date('Y-m-d H:i:s')))
				->get('campaigns',5); # Only 5 Campaign Will Load at This Time
		
if($db->count==0){
	$errLogs[] = '* There no campaign found!';
}else{
	# Fetch Campaigns
	foreach($opCampSet as $kkey=>$opCampSetRs){
		$errLogs[] = '* ['. $kkey .'] - Campaign <b>'.showIn($opCampSetRs['subject'],'page').'</b> Init';
		# NEWSLETTER ####################################################################################################################
		
			# Mail Settings Init
			$errLogs[] = '* ['. $kkey .'] - Mail Engine Init';
			$opOrg->OID=$opCampSetRs['OID'];
			$opOrg->OSMID=$opCampSetRs['campaign_sender_account'];
			$opOrg->sub_from_title = showIn($opCampSetRs['campaign_sender_title'],'page');
			$opOrg->sub_reply_mail = showIn($opCampSetRs['campaign_reply_mail'],'page');
			$opOrg->sub_mail_attach = $opCampSetRs['attach'];
			$opOrg->orgSubInit(); # Load Submission Settings
			$opOrg->sub_mail_id = $opCampSetRs['campaign_key'];
			$setMailPerConn = $orgSets['set_send_per_conn'];
			$setMailPerConnCount = 0;
			
			# Static Short Code Replaces
			# LOG **
			$errLogs[] = "* [". $kkey ."] - Static Data Rendering Started";
			$replaced = $opOrg->shortReplaces(array(
													$opCampSetRs['subject'],
													$opCampSetRs['details'],
													$opCampSetRs['alt_details']
													));
													
			# Campaign Group Loader
			# LOG **
			$errLogs[] = "* [". $kkey ."] - Campaign Groups Initialization";
			$subGrps = array();
			$opCampGrp = $db->where("OID=? AND CID=?",array($opCampSetRs['OID'],$opCampSetRs['ID']))->get('campaign_groups');
			foreach($opCampGrp as $opCampGrpRs){$subGrps[] = " S.GID=". $opCampGrpRs['GID'] ." ";}
			if(count($subGrps)>0){
				# LOG **
				$errLogs[] = "* [". $kkey ."] - Campaign Groups Loaded";
				$subGrps = " (". implode(" OR ",$subGrps) .") ";
			}else{
				# LOG **
				$errLogs[] = "* [". $kkey ."] - Campaign Groups Corrupted";
			}
			
			# Load Subscribers (Max Load 5000 for One Phase)
							$db->join("tasks T", "T.CID=". $opCampSetRs['ID'] ." AND S.subscriber_mail=T.subscriber_mail", "LEFT");
							$db->join("unsubscribes U", "U.CID=". $opCampSetRs['ID'] ." AND S.subscriber_mail=U.subscriber_mail", "LEFT");
							$db->where("S.OID=". $orgSets['set_ID'] ." AND (T.subscriber_mail IS NULL) AND (U.subscriber_mail IS NULL)");
							
							# Special Condutions
							if($orgSets['set_org_load_type']==1){ # Only Active Subscribers There No Verify Control (Single / Double Verified Will Include)
								$db->where('(S.subscriber_active=1)');
								# LOG **
								$errLogs[] = "* [". $kkey ."] - Active Subscriber Selection";
							}
							else if($orgSets['set_org_load_type']==2){ # Only Active and Single Verified Subscribers
								$db->where('(S.subscriber_active=1 AND S.subscriber_verify=1)');
								# LOG **
								$errLogs[] = "* [". $kkey ."] - Active + Single Verified Subscriber Selection";
							}else if($orgSets['set_org_load_type']==3){ # Only Active and Single + Double Verified Subscribers
								$db->where('(S.subscriber_active=1 AND (S.subscriber_verify=1 OR S.subscriber_verify=2))');
								# LOG **
								$errLogs[] = "* [". $kkey ."] - Active + Single Verified Subscriber Selection";
							}else{
								# LOG **
								$errLogs[] = "* [". $kkey ."] - Continue for Condition Set Without Active / Verify Controls";
							}
							
							# Group Selection
							$db->where($subGrps);
							
							# Load Type
							# If Random Load Option is Active
							# Thats will protect your repeated mails, if you cancel a campaign in progress
							if($orgSets['set_org_random_load']==1){
								$db->orderBy("RAND ()");
							}
							
							# LOAD !
							$opSubs = $db->get('subscribers S',5000,"S.*");

							
				# LOG **
				$errLogs[] = "* [". $kkey ."] - Subscriber Statement<blockquote><code><pre>".$db->getLastQuery()."</pre></code></blockquote>";
				$errLogs[] = "* [". $kkey ."] - Loaded <strong>". $db->count ."</strong> Record";
				
				# UPDATE STATUS IF CAMPAING DONE
				if($db->count==0){
					# LOG **
					$errLogs[] = "* [". $kkey ."] - There No Subscriber(s) Found, Task Complete or Error Occured";
					$errLogs[] = "* [". $kkey ."] - Campaign Marked as Completed";
					# Mark It Completed
					$myconn->query("UPDATE ". db_table_pref ."campaigns SET campaign_pos=3 WHERE OID=". $orgSets['set_ID'] ." AND ID = ". $opCampSetRs['ID'] ."") or die(mysqli_error($myconn));
					$myconn->query("UPDATE ". db_table_pref ."chronos SET pos=1 WHERE OID=". $orgSets['set_ID'] ." AND CID = ". $opCampSetRs['ID'] ."") or die(mysqli_error($myconn));
					# Add Cron Remover
				}else{
					# If Position is Pending Turn it to In Progress
					if($opCampSetRs['campaign_pos']==0){
						$myconn->query("UPDATE ". db_table_pref ."campaigns SET campaign_pos=1 WHERE ID = ". $opCampSetRs['ID'] ."") or die(mysqli_error($myconn));
						# LOG **
						$errLogs[] = "* [". $kkey ."] - New Campaign Started, Campaign Marked as In Progress";
					}else{
						# LOG **
						$errLogs[] = "* [". $kkey ."] - Task Handler Started";
						$errLogs[] = "* [". $kkey ."] - System Goes to Fetch Subscribers With Setting Condution";
					}
				}
						
				# Defined as Live Campaign
				$opOrg->isCampID = $opCampSetRs['ID'];

				# FETCH DATA START
					$sentData = array();
					foreach($opSubs as $opSubsRs){
						# User Specific SC Replaces Start ******************************************
						$ireplaced = array();
						foreach($replaced as $rk=>$rv){
							$rvVal = $rv;
							
							# Auto Track
							$rvVal = makeTrack($rvVal,$opCampSetRs['campaign_key'],$opSubsRs['subscriber_key']);
							
							$frKeys = array(
												'#\{?(NAME_PREFIX)\}#'=>(($opSubsRs['subscriber_tag']=='' || $opSubsRs['subscriber_tag']=='NOTAG') ? '':$opSubsRs['subscriber_tag']),
												'#\{?(SUBSCRIBER_NAME)\}#'=>(($opSubsRs['subscriber_name']=='') ? '':$opSubsRs['subscriber_name']),
												'#\{?(SUBSCRIBER_MAIL)\}#'=>(($opSubsRs['subscriber_mail']=='') ? '':$opSubsRs['subscriber_mail']),
												'#\{?(SUBSCRIBER_WEB)\}#'=>(($opSubsRs['subscriber_web']=='') ? '':$opSubsRs['subscriber_web']),
												'#\{?(SUBSCRIBER_PHONE)\}#'=>(($opSubsRs['subscriber_phone']=='') ? '':$opSubsRs['subscriber_phone']),
												'#\{?(SUBSCRIBER_COMPANY)\}#'=>(($opSubsRs['subscriber_company']=='') ? '':$opSubsRs['subscriber_company']),
												'#\{?(NEWSLETTER_LINK\[(.*?)\])\}#'=>'<a href="'. lethe_root_url .'lethe.newsletter.php?pos=web&amp;id='. $opCampSetRs['campaign_key'] .'&amp;sid='. $opSubsRs['subscriber_key'] .'">$2</a>',
												'#\{?(RSS_LINK\[(.*?)\])\}#'=>'<a href="'. $orgSets['set_org_rss_url'] .'">$2</a>',
												'#\{?(UNSUBSCRIBE_LINK\[(.*?)\])\}#'=>'<a href="'. lethe_root_url .'lethe.newsletter.php?pos=unsubscribe&amp;id='. $opCampSetRs['campaign_key'] .'&amp;sid='. $opSubsRs['subscriber_key'] .'&amp;oid='. $orgSets['set_public_key'] .'">$2</a>',
												'#\{?(VERIFY_LINK\[(.*?)\])\}#'=>'', # Verify Link Cannot Be Use In Campaigns
											);
							$rvVal = preg_replace(array_keys($frKeys), $frKeys,$rvVal);
							
							
							# Track Link
							$rvVal = preg_replace_callback('#\{?(TRACK_LINK\[(.*?)\]\[(.*?)\])\}#',
															create_function(
																'$matches',
																'return \'<a href="'. lethe_root_url .'lethe.newsletter.php?pos=track&amp;id='. $opCampSetRs['campaign_key'] .'&amp;sid='. $opSubsRs['subscriber_key'] .'&amp;redu=\'. letheURLEnc($matches[3]) .\'" target="_blank">\'. trckTextMod($matches[2]) .\'</a>\';'
															)
															,$rvVal);
							
							$ireplaced[$rk] = $rvVal;
						}

						# User Specific SC Replaces End ***********************************************
						
						$rcSubject = $ireplaced[0];
						$rcBody = $ireplaced[1];
						$rcAltBody = $ireplaced[2];
						
						/* Add Open Tracker */
						$rcBody .= '<img src="'. lethe_root_url .'lethe.newsletter.php?pos=opntrck&amp;id='. $opCampSetRs['campaign_key'] .'&amp;sid='. $opSubsRs['subscriber_key'] .'" alt="" style="display:none;">';
																
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
						$setMailPerConnCount++;
						/* Fixed 2.1 (Sent Stats Moved to Engine From Here) */
						
						# Send Mails With Per Conn Limit Start ****
						if($setMailPerConnCount>=$setMailPerConn){
							$opOrg->sub_mail_receiver = $sentData;
							$opOrg->letheSender(); # SEND MAILS HERE!
							$setMailPerConnCount=0; # Reset Conn Limit
							
							# LOG **
							$errLogs[] = "* [". $kkey ."] - Rendered Data Send to Mail Engine";
							$errLogs[] = "* [". $kkey ."] - System Goes to Standby Mode";
							
							# Go Standby
							sleep($orgSets['set_standby_time']);
						}
						# Send Mails With Per Conn Limit End ****
						
					}
				# FETCH DATA END
				
					# Send All Mails If Count Less Than Limit ****
						$opOrg->sub_mail_receiver = $sentData;
						$opOrg->letheSender(); # SEND MAILS HERE!
						$setMailPerConnCount=0; # Reset Conn Limit
						
						/* Fixed 2.1 (Sent Stats Moved to Engine From Here) */
						
						# Go Standby
						sleep($orgSets['set_standby_time']);
					# Send All Mails If Count Less Than Limit ****
							
			
			
		
		# NEWSLETTER END ################################################################################################################
		$errLogs[] = '<hr>';
	}	
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
die();
# NEW FATURE END ################################################################
?>