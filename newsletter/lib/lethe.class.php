<?php 
# +------------------------------------------------------------------------+
# | Artlantis CMS Solutions                                                |
# +------------------------------------------------------------------------+
# | Lethe Newsletter & Mailing System                                      |
# | Copyright (c) Artlantis Design Studio 2014. All rights reserved.       |
# | Version       2.0                                                      |
# | Last modified 13.11.2014                                               |
# | Email         developer@artlantis.net                                  |
# | Web           http://www.artlantis.net                                 |
# +------------------------------------------------------------------------+

class lethe{

	public $OID = 0; # Organization ID
	public $UID = 0; # User ID
	public $ID = 0; # Specific ID
	public $SUBID = 0; # Subscriber ID
	public $SUGID = 0; # Subscriber Group ID
	public $OSMID = 0; # Organization Submission Account ID
	public $admin_area = 0; # If Called as 1 All Actions Will Work Only Admin Area
	public $errPrint = ''; # Error Outputs
	public $auth_mode = 0; # Authorization Mode 0-User, 1-Admin, 2-Super Admin
	public $isPrimary = 0; # Primary / System Record Controller
	public $billingDate = 0; # Billing Period (For Lethe PRO)
	public $orgTag = ''; # Organization Tag
	public $public_key = ''; # Organization Public Key
	public $private_key = ''; # Organization Private Key
	public $public_registration = 0; # Front-End Subscribe Actions
	public $isSuccess = 0; # Successfull Actions
	public $isMaster = 0; # System Controls
	public $subscribeData = ''; # Full Subscribe JSON Data
	public $onInstall = false;
	public $isCampID = 0; /* Fixed 2.1 */
	
	/* Submission Data */
					public $sub_from_title = ''; # Submission Account From Title
					public $sub_from_mail = ''; # Submission Account From E-Mail
					public $sub_reply_mail = ''; # Submission Account Reply E-Mail, (Organizations Can Use)
					public $sub_test_mail = ''; # Submission Account Test E-Mail, (Organizations Can Use)
					public $sub_mail_type = ''; # Submission Account Mail Content Type HTML or Text
					public $sub_send_method = ''; # Submission Account Sending Method, SMTP, PHP, AmazonSES etc.
					public $sub_mail_engine = ''; # Submission Account Mail Sender Engine phpMailer, Swiftmail etc.
					public $sub_smtp_host = ''; # Submission Account SMTP Host IP or address
					public $sub_smtp_port = ''; # Submission Account SMTP Port Number
					public $sub_smtp_user = ''; # Submission Account SMTP Username
					public $sub_smtp_pass = ''; # Submission Account SMTP Password
					public $sub_smtp_secure = ''; # Submission Account SMTP Secure Connection Mode; SSL, TLS 
					public $sub_smtp_auth = ''; # Submission Account SMTP Connection Auth Mode
					public $sub_aws_access_key = ''; # Submission Account AmazonSES Access Key
					public $sub_aws_secret_key = ''; # Submission Account AmazonSES Secret Key
					public $sub_mandrill_user = ''; # Submission Account Mandrill APP Username
					public $sub_mandrill_key = ''; # Submission Account Mandrill APP Key
					public $sub_sendgrid_user = ''; # Submission Account SendGrid Username
					public $sub_sendgrid_pass = ''; # Submission Account SendGrid Pass
					public $sub_dkim_active = ''; # Submission Account DKIM Controller, Active / Inactive
					public $sub_dkim_domain = ''; # Submission Account DKIM Domain Information
					public $sub_dkim_private = ''; # Submission Account DKIM Private Key
					public $sub_dkim_selector = ''; # Submission Account DKIM DNS Selector
					public $sub_dkim_passphrase = ''; # Submission Account DKIM Secret Pass For Generated Key
					public $sub_isDebug = 1; # Submission Account Debug Mode On / Off
					
					public $sub_mail_subject = ''; # Submission Account E-Mail Subject
					public $sub_mail_body = ''; # Submission Account E-Mail Body
					public $sub_mail_altbody = ''; # Submission Account E-Mail Alternative Body
					public $sub_mail_extra = ''; # Submission Account E-Mail Body Extra Contents
					public $sub_mail_id = ''; # Submission Account Unique E-Mail ID
					public $sub_mail_attach = ''; # Submission Account E-Mail Attachment
					public $sub_mail_receiver = array(); # Submission Account Receiver Data
					public $sub_success = true; # Submission limit controller, If limit is exceeded lethe_sender will return false
					public $sendingErrors = '';
					
					public $bounceKey = '';
					public $bounceMail = '';
					public $bounceAction = 0; # 0 - Remove, 1 - Remove / Blacklist, 2 - Unsubscribe, 3 - No Action
					
	/* Reports */
	public $reportCID = 0;
	public $reportPos = 0;
	public $reportIP = '0.0.0.0';
	public $reportMail = null;
	public $reportBounceType = 'unknown';
	public $reportExtraInfo = ''; # Clicked URL
					
	/* Chronos Command */
	public $chronosMin = set_min_cron;
	public $chronosHour = '*';
	public $chronosDay = '*';
	public $chronosMonth = '*';
	public $chronosWeek = '*';
	public $chronosCommand = set_shell_cron_command; # curl -s
	public $chronosURL = "";
	
	
	/* General Settings */
	public function letheSettings(){
		
		global $db;
		
		$this->errPrint = '';
		if(!isset($_POST['lethe_default_lang']) || empty($_POST['lethe_default_lang'])){$this->errPrint.='* Please Choose a Language<br>';}
		if(!isset($_POST['lethe_default_timezone']) || empty($_POST['lethe_default_timezone'])){$this->errPrint.='* Please Choose a Timezone<br>';}
		if(!isset($_POST['lethe_root_url']) || empty($_POST['lethe_root_url'])){$this->errPrint.='* Please Enter Your Lethe URL<br>';}else{
			$letheURL = $_POST['lethe_root_url'];
			$letheURL = ((substr($letheURL,-1)!='/') ? $letheURL.'/':$letheURL);
		}
		if(!isset($_POST['lethe_admin_url']) || empty($_POST['lethe_admin_url'])){$this->errPrint.='* Please Enter Your Lethe Admin URL<br>';}else{
			$letheAURL = $_POST['lethe_admin_url'];
			$letheAURL = ((substr($letheAURL,-1)!='/') ? $letheAURL.'/':$letheAURL);
		}
		if(!isset($_POST['lethe_debug_mode']) || empty($_POST['lethe_debug_mode'])){$lethe_debug_mode=0;}else{$lethe_debug_mode=1;}
		if(!isset($_POST['lethe_system_notices']) || empty($_POST['lethe_system_notices'])){$lethe_system_notices=0;}else{$lethe_system_notices=1;}
		if(!isset($_POST['lethe_sidera_helper']) || empty($_POST['lethe_sidera_helper'])){$lethe_sidera_helper=0;}else{$lethe_sidera_helper=1;}
		if(!isset($_POST['lethe_theme']) || empty($_POST['lethe_theme'])){$this->errPrint.='* Please Choose a Theme<br>';}
		if(!isset($_POST['lethe_google_recaptcha_public']) || empty($_POST['lethe_google_recaptcha_public'])){$this->errPrint.='* Please Enter a reCaptcha Public Key<br>';}
		if(!isset($_POST['lethe_google_recaptcha_private']) || empty($_POST['lethe_google_recaptcha_private'])){$this->errPrint.='* Please Enter a reCaptcha Private Key<br>';}
		if(!isset($_POST['lethe_save_tree_text']) || empty($_POST['lethe_save_tree_text'])){$lethe_save_tree = '';}else{$lethe_save_tree=str_replace("'","’",$_POST['lethe_save_tree_text']);}
		if(!isset($_POST['lethe_save_tree_on']) || empty($_POST['lethe_save_tree_on'])){$lethe_save_tree_on=0;}else{$lethe_save_tree_on=1;}
		if(!isset($_POST['lethe_license_key']) || empty($_POST['lethe_license_key'])){$this->errPrint.='* Please Enter a License Key<br>';}
		$lethePowered = '<p><small>Lethe Newsletter &amp; Mailing System v'. LETHE_VERSION .' &copy; '. date("Y") .'</small></p><p><small>Artlantis Design Studio <a href="http://www.artlantis.net/" target="_blank">http://www.artlantis.net/</a></p><p>Lethe Mailing System <a href="http://www.newslether.com/" target="_blank">http://www.newslether.com/</a></small></p>';
		
		
		if($this->errPrint==''){
			
			$confList = '';
			$confList.= "<?php\n";
			$confList .= "/*  +------------------------------------------------------------------------+ */
/*  | Artlantis CMS Solutions                                                | */
/*  +------------------------------------------------------------------------+ */
/*  | Lethe Newsletter & Mailing System                                      | */
/*  | Copyright (c) Artlantis Design Studio 2014. All rights reserved.       | */
/*  | Version       ". LETHE_VERSION ."                                                      | */
/*  | Last modified ". date('d.m.Y') ."                                               | */
/*  | Email         developer@artlantis.net                                  | */
/*  | Web           http://www.artlantis.net                                 | */
/*  +------------------------------------------------------------------------+ */";
			$confList .= "\n\n";
			$confList .= "# General Settings\n";
			$confList .= "\$LETHE_SETS['lethe_default_lang'] = '". mysql_prep($_POST['lethe_default_lang']) ."';\n";
			$confList .= "\$LETHE_SETS['lethe_default_timezone'] = '". mysql_prep($_POST['lethe_default_timezone']) ."';\n";
			$confList .= "\$LETHE_SETS['lethe_root_url'] = '". $letheURL ."';\n";
			$confList .= "\$LETHE_SETS['lethe_admin_url'] = '". $letheAURL ."';\n";
			$confList .= "\$LETHE_SETS['lethe_debug_mode'] = ". $lethe_debug_mode .";\n";
			$confList .= "\$LETHE_SETS['lethe_system_notices'] = ". $lethe_system_notices .";\n";
			$confList .= "\$LETHE_SETS['lethe_sidera_helper'] = ". $lethe_sidera_helper .";\n";
			$confList .= "\$LETHE_SETS['lethe_theme'] = '". mysql_prep($_POST['lethe_theme']) ."';\n";
			$confList .= "\$LETHE_SETS['lethe_google_recaptcha_public'] = '". mysql_prep($_POST['lethe_google_recaptcha_public']) ."';\n";
			$confList .= "\$LETHE_SETS['lethe_google_recaptcha_private'] = '". mysql_prep($_POST['lethe_google_recaptcha_private']) ."';\n";
			$confList .= "\$LETHE_SETS['lethe_powered_text'] ='". base64_encode($lethePowered) ."';\n";
			$confList .= "\$LETHE_SETS['lethe_save_tree'] ='". $lethe_save_tree ."';\n";
			$confList .= "\$LETHE_SETS['lethe_save_tree_on'] = ". $lethe_save_tree_on .";\n";
			$confList .= "\$LETHE_SETS['lethe_license_key'] = '". mysql_prep($_POST['lethe_license_key']) ."';\n";
			$confList .= "# v2.1 Settings\n";
			
			# Check on Install
			if(!isset($_POST['set_shell_cron_command'])){$_POST['set_shell_cron_command'] = '/usr/bin/wget -O - -q';}
			if(!isset($_POST['set_min_cron'])){$_POST['set_min_cron'] = '*/5';}
			if(!isset($_POST['set_shell_command'])){$_POST['set_shell_command'] = 'crontab';}
			if($this->onInstall){
				if(!isset($_POST['set_shell'])){$_POST['set_shell'] = 1;}
			}
			
			$confList .= "\$LETHE_SETS['set_shell_cron_command'] = '". mysql_prep($_POST['set_shell_cron_command']) ."';\n";
			$confList .= "\$LETHE_SETS['set_min_cron'] = '". mysql_prep($_POST['set_min_cron']) ."';\n";
			$confList .= "\$LETHE_SETS['set_shell_type'] = ". ((isset($_POST['set_shell_type']) && !empty($_POST['set_shell_type'])) ? intval($_POST['set_shell_type']):0) .";\n";
			$confList .= "\$LETHE_SETS['set_shell'] = ". ((isset($_POST['set_shell']) && $_POST['set_shell']=='YES') ? 1:0) .";\n";
			$confList .= "\$LETHE_SETS['set_shell_command'] = '". mysql_prep($_POST['set_shell_command']) ."';\n";
			
			$confList .= "\n\n";
			$confList .= "foreach(\$LETHE_SETS as \$k=>\$v){if(!defined(\$k)){define(\$k,\$v);}}";
			$confList .= "\n";
			$confList .= "?>";
			
			$pathw = LETHE.DIRECTORY_SEPARATOR.'lib/lethe.sets.php';
			if (!file_exists ($pathw) ) {
				@touch ($pathw);
			}
			
			$conc=@fopen ($pathw,'w');
			if (!$conc) {
				$this->errPrint = errMod('Setting File Cannot Be Open','danger');
				return false;
			}else{
				#************* Writing *****
				if (fputs ($conc,$confList) ){
					if(!$this->onInstall){
						
						# Update Crons
						# New Commands
						$newCrons = array();
						
						# Reset Table
						$older = $db->where('pos=0')->get('chronos');
						foreach($older as $cro){
							$newCrons[] = array(
												'OID'=>$cro['OID'],
												'CID'=>$cro['CID'],
												'pos'=>0,
												'cron_command'=>"". $_POST['set_min_cron'] ." * * * * ". $_POST['set_shell_cron_command'] ." '". $letheURL ."chronos/". (($cro['CID']!=0) ? 'lethe.tasks.php?ID='. $cro['CID'] .'':'lethe.bounce.php?ID='. $cro['SAID'] .'') ."' > /dev/null 2>&1",
												'launch_date'=>$cro['launch_date'],
												'SAID'=>$cro['SAID']
												);
						}
						$db->where('ID>0')->delete('chronos');
						
						# Put New Ones
						foreach($newCrons as $sk=>$sv){
							$db->insert('chronos',$sv);
						}
						
						# Update Crontab ---- ONLY FOR SHELL USERS!
						if(isset($_POST['set_shell']) && $_POST['set_shell']=='YES'){
							
							# Get List
							$curr = ((shell_exec(set_shell_command.' -l')) ? shell_exec(set_shell_command.' -l'):'');
							$jobs = preg_split ('/$\R?^/m', trim($jobs));
							//$array = explode("\r\n", trim($jobs)); // trim() gets rid of the last \r\n
							$newArray = array();
							foreach ($array as $key => $item) {
								if ($item != '') {
									$newArray[] = $item;
								}
							}
							
							# Keep Olders
							$keepCron = array();
							foreach($newArray as $cj){
								if(strpos($k, 'lethe') !== false){
									# Removes
								}else{
									# Keep
									$keepCron[] = $crn;
								}
							}
							
							# Lethe Controller
							$keepCron[] = $_POST['set_min_cron']." * * * * ". $_POST['set_shell_cron_command'] ." '". $letheURL ."chronos/lethe.php' > /dev/null 2>&1";
							
							# Update Crontab
							$arrayToStr = implode(PHP_EOL, $keepCron);
							if(!shell_exec('echo "'.$arrayToStr.'" | '.set_shell_command)){
								# Shell Error
							}
							
						}
						
						
						header('Location: ?p=settings/general');
						return true;
						die();
					}else{
						return true;
					}
				}else {
					$this->errPrint = errMod('Settings Could Not Be Written!','danger');
				}
				fclose($conc);
				#************* Writing End **
			}
			
		}else{
			$this->errPrint = errMod($this->errPrint,'danger');
		}
		
	}
	
	/* Add New User */
	public function addUser(){
	
		global $myconn, $db;
	
		if(!isset($_POST['usr_name']) || empty($_POST['usr_name'])){
			$this->errPrint.='* '. letheglobal_please_enter_a_name .'<br>';
		}
		if(!isset($_POST['usr_mail']) || !mailVal($_POST['usr_mail'])){
			$this->errPrint.='* '. letheglobal_invalid_e_mail_address .'<br>';
		}else{
			if(cntData("SELECT ID,mail FROM ". db_table_pref ."users WHERE mail='". mysql_prep($_POST['usr_mail']) ."'")!=0){
				$this->errPrint.='* '. letheglobal_e_mail_already_exists .'<br>';
			}
		}
		if(!isset($_POST['usr_pass']) || empty($_POST['usr_pass'])){
			$this->errPrint.='* '. letheglobal_please_enter_password .'<br>';
		}else{
			$passLenth = isToo($_POST['usr_pass'],letheglobal_password.' ',5,30);
			if($passLenth!=''){
				$this->errPrint.='* '. $passLenth .'<br>';
			}else{
				if(!isset($_POST['usr_pass2']) || ($_POST['usr_pass2']!=$_POST['usr_pass'])){
					$this->errPrint.='* '. letheglobal_passwords_mismatch .'<br>';
				}
			}
		}
		
		if($this->isMaster==0){ # Organization User
			//if(!isset($_POST['user_daily_limit']) || !is_numeric($_POST['user_daily_limit'])){$this->errPrint.='* '. organizations_please_enter_a_daily_sending_limit .'<br>';}
			if(!isset($_POST['perm-sel-list']) || empty($_POST['perm-sel-list'])){$this->errPrint.='* '. organizations_please_choose_access_pages .'<br>';}
			if(!isset($_POST['user_auth_mode']) || !is_numeric($_POST['user_auth_mode'])){$this->errPrint.='* '. organizations_select_a_management_type .'<br>';}else{
				/* CSRF Auth Protection */
				if(intval($_POST['user_auth_mode'])>1){
					$this->auth_mode = 0;
				}else{
					$this->auth_mode = intval($_POST['user_auth_mode']);
				}
				
				/* Make Primary For New Organization */
				if(intval($_POST['user_auth_mode'])==1){
					if(cntData("SELECT ID FROM ". db_table_pref ."users WHERE OID=". $this->OID ." AND isPrimary=1")==0){
						$this->isPrimary = 1;
					}else{
						$this->isPrimary = 0;
					}
				}
				
				/* Check Limit */
				$sourceLimit = calcSource($this->OID,'users');
				if(!limitBlock($sourceLimit,set_org_max_user)){$this->errPrint.='* '. letheglobal_limit_exceeded .'<br>';}
			}
		}else{
			$_POST['user_daily_limit'] = 0;
		}
		
		if($this->errPrint==''){
		
			$privateKey = encr(md5(rand().uniqid('youaremylethe',true).sha1(time())));
			$publicKey = encr(uniqid('youaremylethe',true).time().rand());
			$usrPass = encr($_POST['usr_pass']);
			
			$usrID = $db->insert('users',
									array(
											'OID'=>$this->OID,
											'real_name'=>$_POST['usr_name'],
											'mail'=>$_POST['usr_mail'],
											'pass'=>$usrPass,
											'auth_mode'=>$this->auth_mode,
											'isActive'=>1,
											'isPrimary'=>$this->isPrimary,
											'private_key'=>$privateKey,
											'public_key'=>$publicKey,
											'last_login'=>date('Y-m-d H:i:s'),
											'session_token'=>md5(date('Y-m-d H:i:s')),
											'session_time'=>date('Y-m-d H:i:s')
									)
			);
									
			
			if($this->isMaster==0){ # Organization User
				/* Add Allowed Pages */

				foreach($_POST['perm-sel-list'] as $k=>$v){
					$pg = str_replace('?p=','',$v);
					
					$db->insert('user_permissions',array(
															'OID'=>$this->OID,
															'UID'=>$usrID,
															'perm'=>$pg
														));
					
				}

			}
		
			$this->errPrint = errMod(letheglobal_recorded_successfully.'!','success');
			$this->isSuccess = 1;
			if(!$this->onInstall){
				unset($_POST);
			}
		}else{
			$this->errPrint = errMod($this->errPrint,'danger');
		}
		
		return $this->errPrint;
	
	}

	/* Edit User */
	public function editUser(){
	
		global $myconn, $db;
		
		/* Mode Protector */
		if(LETHE_AUTH_MODE==0){
			$this->UID = LETHE_AUTH_ID;
		}
		
		/* Check User */
		if(!$this->isMaster){
			$opUserRs = $db->where('OID=? AND ID=?',array($this->OID,$this->UID))->getOne('users');
		}else{
			$opUserRs = $db->where('ID=?',array($this->UID))->getOne('users');
		}
		
		if($db->count==0){$this->errPrint = errMod(letheglobal_record_not_found.'!','danger');return false;}else{
		
			$this->isPrimary = $opUserRs['isPrimary'];
			
			/* Primary User Checker */
			if(!$opUserRs['isPrimary']){
			
				/* Delete */
				if(isset($_POST['del']) && $_POST['del']=='YES'){
					if(!$this->isMaster){
						$db->where('OID=? AND ID=?',array($this->OID,$this->UID))->delete('users');
					}else{
						$db->where('ID=?',array($this->UID))->delete('users');
					}
					header('Location: ?p=settings/users');
					return false; die();
				}
			
				if(isset($_POST['active']) && $_POST['active']=='YES'){$active=1;}else{$active=0;}
			}else{
				$active=1;
			}
	
			if(!isset($_POST['usr_name']) || empty($_POST['usr_name'])){
				$this->errPrint.='* '. letheglobal_please_enter_a_name .'<br>';
			}
			if(!isset($_POST['usr_mail']) || !mailVal($_POST['usr_mail'])){
				$this->errPrint.='* '. letheglobal_invalid_e_mail_address .'<br>';
			}else{
				if(cntData("SELECT ID,OID,mail FROM ". db_table_pref ."users WHERE mail='". mysql_prep($_POST['usr_mail']) ."' AND ID<>". $this->UID ."")!=0){
					$this->errPrint.='* '. letheglobal_e_mail_already_exists .'<br>';
				}
			}
			
			
			if(isset($_POST['usr_pass']) && !empty($_POST['usr_pass'])){
				$passLenth = isToo($_POST['usr_pass'],letheglobal_password.' ',5,30);
				if($passLenth!=''){
					$this->errPrint.='* '. $passLenth .'<br>';
				}else{
					if(!isset($_POST['usr_pass2']) || ($_POST['usr_pass2']!=$_POST['usr_pass'])){
						$this->errPrint.='* '. letheglobal_passwords_mismatch .'<br>';
					}else{
						$_POST['usr_pass'] = encr($_POST['usr_pass']);
					}
				}
			}else{
				$_POST['usr_pass'] = $opUserRs['pass'];
			}
			
			if($this->auth_mode!=2){
				if(!isset($_POST['usr_auth']) || intval($_POST['usr_auth'])>1){
					$this->auth_mode = $opUserRs['auth_mode'];
				}else{
					if(LETHE_AUTH_MODE==0){
						$this->auth_mode = 0;
					}else{
						$this->auth_mode = intval($_POST['usr_auth']);
					}
				}
			}
			
		if($this->isMaster==0){ # Organization User
/* 			if(!isset($_POST['user_daily_limit']) || !is_numeric($_POST['user_daily_limit'])){$this->errPrint.='* '. organizations_please_enter_a_daily_sending_limit .'<br>';}else{
				if(intval($_POST['user_daily_limit'])>set_org_max_daily_limit && intval($_POST['user_daily_limit'])!=0){
					$_POST['user_daily_limit'] = set_org_max_daily_limit;
				}
			} */
			if(!isset($_POST['perm-sel-list']) || empty($_POST['perm-sel-list'])){$this->errPrint.='* '. organizations_please_choose_access_pages .'<br>';}
			if(!isset($_POST['user_auth_mode']) || !is_numeric($_POST['user_auth_mode'])){$this->errPrint.='* '. organizations_select_a_management_type .'<br>';}else{
				/* CSRF Auth Protection */
				if(intval($_POST['user_auth_mode'])>1){
					$this->auth_mode = 0;
				}else{
					$this->auth_mode = intval($_POST['user_auth_mode']);
				}
				
			}
		}else{
			$_POST['user_daily_limit'] = 0;
		}
		
		if(isset($_POST['user_spec_view']) && $_POST['user_spec_view']=='YES'){$user_spec_view=1;}else{$user_spec_view=0;}
			
		/* Update */
			if($this->errPrint==''){
				
				if(!$this->isMaster){
					$LPRE = $db->where('OID=? AND ID=?',array($this->OID,$this->UID))->update('users',array(
																'real_name'=>$_POST['usr_name'],
																'mail'=>$_POST['usr_mail'],
																'pass'=>$_POST['usr_pass'],
																'auth_mode'=>$this->auth_mode,
																'isActive'=>$active,
																'isPrimary'=>$this->isPrimary,
																'user_spec_view'=>$user_spec_view
																));
				}else{
					$LPRE = $db->where('ID=?',array($this->UID))->update('users',array(
																'real_name'=>$_POST['usr_name'],
																'mail'=>$_POST['usr_mail'],
																'pass'=>$_POST['usr_pass'],
																'auth_mode'=>$this->auth_mode,
																'isActive'=>$active,
																'isPrimary'=>$this->isPrimary,
																'user_spec_view'=>$user_spec_view
																));
				}
				
			if($this->isMaster==0){ # Organization User
				/* Clear Removed Perms */
				if(isset($_POST['perm-all-list'])){
					foreach($_POST['perm-all-list'] as $k=>$v){
						$db->where('OID=? AND UID=? AND perm=?',array($this->OID,$this->UID,$v))->delete('user_permissions');
					}
				}
				/* Add Allowed Pages */
				$usrID = intval($this->UID);
				foreach($_POST['perm-sel-list'] as $k=>$v){
					$pg = str_replace('?p=','',$v);
					if(cntData("SELECT ID FROM ". db_table_pref ."user_permissions WHERE OID=". $this->OID ." AND UID=". $usrID ." AND perm='". mysql_prep($pg) ."'")==0){
						$db->insert('user_permissions',array(
																'OID'=>$this->OID,
																'UID'=>$usrID,
																'perm'=>$pg
															));
					}
				}
			}
			
				$this->errPrint = errMod(letheglobal_updated_successfully.'!','success');
				unset($_POST);
			}else{
				$this->errPrint = errMod($this->errPrint,'danger');
			}
			
			return $this->errPrint;
		} $opUser->free();
	
	}

	/* Add Submission Account */
	public function addSubAccount(){
	
		global $myconn,$db,$LETHE_BOUNCE_TYPES;
		
		$datas = array();
		
		/* General */
		if(!isset($_POST['acc_title']) || empty($_POST['acc_title'])){$this->errPrint .= '* '. settings_please_enter_a_account_title .'<br>';}else{$datas['acc_title'] = trim($_POST['acc_title']);}
		if(!isset($_POST['daily_limit']) || !is_numeric($_POST['daily_limit'])){$this->errPrint .= '* '. settings_please_enter_a_daily_limit .'<br>';}else{$datas['daily_limit'] = $_POST['daily_limit'];}
		if(!isset($_POST['spec_limit_range']) || !is_numeric($_POST['spec_limit_range'])){$datas['limit_range']=1440;}else{$datas['limit_range'] = trim($_POST['spec_limit_range']);}
		if(!isset($_POST['send_per_conn']) || !is_numeric($_POST['send_per_conn'])){$this->errPrint .= '* '. settings_please_enter_a_per_connection_limit .'<br>';}else{$datas['send_per_conn'] = $_POST['send_per_conn'];}
		if(!isset($_POST['standby_time']) || !is_numeric($_POST['standby_time'])){$this->errPrint .= '* '. settings_please_enter_a_standby_limit .'<br>';}else{$datas['standby_time'] = $_POST['standby_time'];}
		if(isset($_POST['systemAcc']) && $_POST['systemAcc']=='YES'){$systemAcc=1;$datas['systemAcc'] = 1;}else{$systemAcc=0;$datas['systemAcc'] = 0;}
		if(isset($_POST['debug']) && $_POST['debug']=='YES'){$isDebug=1;$datas['isDebug'] = 1;}else{$isDebug=0;$datas['isDebug'] = 0;}
		if(isset($_POST['active']) && $_POST['active']=='YES'){$isActive=1;$datas['isActive'] = 1;}else{$isActive=0;$datas['isActive'] = 0;}
		
		/* Sending */
		if(!isset($_POST['from_title']) || empty($_POST['from_title'])){$this->errPrint .= '* '. settings_please_enter_a_sender_title .'<br>';}else{$datas['from_title'] = trim($_POST['from_title']);}
		if(!isset($_POST['from_mail']) || !mailVal($_POST['from_mail'])){$this->errPrint .= '* '. settings_invalid_sender_mail .'<br>';}else{$datas['from_mail'] = trim($_POST['from_mail']);}
		if(!isset($_POST['reply_mail']) || !mailVal($_POST['reply_mail'])){$this->errPrint .= '* '. settings_invalid_reply_mail .'<br>';}else{$datas['reply_mail'] = trim($_POST['reply_mail']);}
		if(!isset($_POST['test_mail']) || !mailVal($_POST['test_mail'])){$this->errPrint .= '* '. settings_invalid_test_mail .'<br>';}else{$datas['test_mail'] = trim($_POST['test_mail']);}
		if(!isset($_POST['mail_type']) || !is_numeric($_POST['mail_type'])){$this->errPrint .= '* '. settings_please_choose_a_mail_content_type .'<br>';}else{$datas['mail_type'] = $_POST['mail_type'];}
		if(!isset($_POST['send_method']) || !is_numeric($_POST['send_method'])){$this->errPrint .= '* '. settings_please_choose_a_sending_method .'<br>';}else{$datas['send_method'] = $_POST['send_method'];}
		if(!isset($_POST['mail_engine']) || empty($_POST['mail_engine'])){$this->errPrint .= '* '. settings_please_choose_a_mail_engine .'<br>';}else{$datas['mail_engine'] = $_POST['mail_engine'];}
		
		/* Connection SMTP */
		if(isset($_POST['send_method']) && intval($_POST['send_method'])==0){
			if(!isset($_POST['smtp_host']) || empty($_POST['smtp_host'])){$this->errPrint .= '* '. settings_please_enter_a_smtp_server .'<br>';}else{$datas['smtp_host'] = trim($_POST['smtp_host']);}
			if(!isset($_POST['smtp_port']) || empty($_POST['smtp_port'])){$this->errPrint .= '* '. settings_please_enter_a_smtp_port .'<br>';}else{$datas['smtp_port'] = trim($_POST['smtp_port']);}
			if(!isset($_POST['smtp_user']) || empty($_POST['smtp_user'])){$this->errPrint .= '* '. settings_please_enter_a_smtp_username .'<br>';}else{$datas['smtp_user'] = trim($_POST['smtp_user']);}
			if(!isset($_POST['smtp_pass']) || empty($_POST['smtp_pass'])){$this->errPrint .= '* '. settings_please_enter_a_smtp_password .'<br>';}else{$datas['smtp_pass'] = trim($_POST['smtp_pass']);}
			if(!isset($_POST['smtp_secure']) || !is_numeric($_POST['smtp_secure'])){$this->errPrint .= '* '. settings_please_choose_a_smtp_encryption .'<br>';}else{$datas['smtp_secure'] = $_POST['smtp_secure'];}
		}else{
			$datas['smtp_host']='';
			$datas['smtp_port']=0;
			$datas['smtp_user']='';
			$datas['smtp_pass']='';
			$datas['smtp_secure']=0;			
		}
		
		# PHP Mail
		if(isset($_POST['send_method']) && intval($_POST['send_method'])==1){
			if(!function_exists('mail')){$this->errPrint .= '* Server does not support PHP mail() !<br>';}
		}
		
		# AWS
		if(isset($_POST['send_method']) && intval($_POST['send_method'])==2){
			if(!isset($_POST['aws_acc_key']) || empty($_POST['aws_acc_key'])){$this->errPrint .= '* '. settings_please_enter_aws_smtp_username .'<br>';}else{$datas['aws_access_key'] = trim($_POST['aws_acc_key']);}
			if(!isset($_POST['aws_sec_key']) || empty($_POST['aws_sec_key'])){$this->errPrint .= '* '. settings_please_enter_aws_smtp_password .'<br>';}else{$datas['aws_secret_key'] = trim($_POST['aws_sec_key']);}
			if(!isset($_POST['aws_region']) || empty($_POST['aws_region'])){$this->errPrint .= '* '. settings_please_choose_aws_region .'<br>';}else{$datas['aws_region'] = trim($_POST['aws_region']);}
			if(!isset($_POST['aws_port']) || !is_numeric($_POST['aws_port'])){$this->errPrint .= '* '. settings_please_enter_a_smtp_port .'<br>';}else{$datas['smtp_port'] = trim($_POST['aws_port']);}
		}else{
			$datas['aws_access_key']='';
			$datas['aws_secret_key']='';		
			$datas['aws_region']='email-smtp.us-east-1.amazonaws.com';
			$datas['smtp_port']=587;
		}
		
		# Mandrill
		if(isset($_POST['send_method']) && intval($_POST['send_method'])==3){
			if(!isset($_POST['mandrill_user']) || empty($_POST['mandrill_user'])){$this->errPrint .= '* '. settings_please_enter_a_mandrill_username .'<br>';}else{$datas['mandrill_user'] = trim($_POST['mandrill_user']);}
			if(!isset($_POST['mandrill_key']) || empty($_POST['mandrill_key'])){$this->errPrint .= '* '. settings_please_enter_a_mandrill_key .'<br>';}else{$datas['mandrill_key'] = trim($_POST['mandrill_key']);}
		}else{
			$datas['mandrill_user']='';
			$datas['mandrill_key']='';			
		}
		
		# SendGrid
		if(isset($_POST['send_method']) && intval($_POST['send_method'])==4){
			if(!isset($_POST['sendgrid_user']) || empty($_POST['sendgrid_user'])){$this->errPrint .= '* '. settings_please_enter_a_sendgrid_username .'<br>';}else{$datas['sendgrid_user'] = trim($_POST['sendgrid_user']);}
			if(!isset($_POST['sendgrid_pass']) || empty($_POST['sendgrid_pass'])){$this->errPrint .= '* '. settings_please_enter_a_sendgrid_password .'<br>';}else{$datas['sendgrid_pass'] = trim($_POST['sendgrid_pass']);}
		}else{
			$datas['sendgrid_user']='';
			$datas['sendgrid_pass']='';			
		}
		
		# Bounce Settings
		$bounce_on = ((isset($_POST['bounce_on']) && $_POST['bounce_on']=="YES") ? 1:0);
		
		if(($bounce_on==1) && (isset($_POST['send_method']) && intval($_POST['send_method'])<2)){
			
		$datas['disable_bounce'] = 1;
		if(!isset($_POST['pop3_host']) || empty($_POST['pop3_host'])){$this->errPrint .= '* '. settings_please_enter_a_pop3_server .'<br>';}else{$datas['pop3_host'] = trim($_POST['pop3_host']);}
		if(!isset($_POST['pop3_port']) || empty($_POST['pop3_port'])){$this->errPrint .= '* '. settings_please_enter_a_pop3_port .'<br>';}else{$datas['pop3_port'] = trim($_POST['pop3_port']);}
		if(!isset($_POST['pop3_user']) || empty($_POST['pop3_user'])){$this->errPrint .= '* '. settings_please_enter_a_pop3_username .'<br>';}else{$datas['pop3_user'] = trim($_POST['pop3_user']);}
		if(!isset($_POST['pop3_pass']) || empty($_POST['pop3_pass'])){$this->errPrint .= '* '. settings_please_enter_a_pop3_password .'<br>';}else{$datas['pop3_pass'] = trim($_POST['pop3_pass']);}
		if(!isset($_POST['pop3_secure']) || !is_numeric($_POST['pop3_secure'])){$this->errPrint .= '* '. settings_please_choose_a_pop3_encryption .'<br>';}else{$datas['pop3_secure'] = trim($_POST['pop3_secure']);}
		
		if(!isset($_POST['imap_host']) || empty($_POST['imap_host'])){$this->errPrint .= '* '. settings_please_enter_a_imap_server .'<br>';}else{$datas['imap_host'] = trim($_POST['imap_host']);}
		if(!isset($_POST['imap_port']) || empty($_POST['imap_port'])){$this->errPrint .= '* '. settings_please_enter_a_imap_port .'<br>';}else{$datas['imap_port'] = trim($_POST['imap_port']);}
		if(!isset($_POST['imap_user']) || empty($_POST['imap_user'])){$this->errPrint .= '* '. settings_please_enter_a_imap_username .'<br>';}else{$datas['imap_user'] = trim($_POST['imap_user']);}
		if(!isset($_POST['imap_pass']) || empty($_POST['imap_pass'])){$this->errPrint .= '* '. settings_please_enter_a_imap_password .'<br>';}else{$datas['imap_pass'] = trim($_POST['imap_pass']);}
		if(!isset($_POST['imap_secure']) || !is_numeric($_POST['imap_secure'])){$this->errPrint .= '* '. settings_please_choose_a_imap_encryption .'<br>';}else{$datas['imap_secure'] = trim($_POST['imap_secure']);}
		
		if(!isset($_POST['bounce_acc']) || !is_numeric($_POST['bounce_acc'])){$this->errPrint .= '* '. settings_please_choose_a_bounce_connector .'<br>';}else{$datas['bounce_acc'] = trim($_POST['bounce_acc']);}
		
		}else{
			# Disable Bounce Acc
			$datas['disable_bounce'] = 0;
			
/* 			$datas['pop3_host'] = '';
			$datas['pop3_port'] = '';
			$datas['pop3_user'] = '';
			$datas['pop3_pass'] = '';
			$datas['pop3_secure'] = 0;
			
			$datas['imap_host'] = '';
			$datas['imap_port'] = '';
			$datas['imap_user'] = '';
			$datas['imap_pass'] = '';
			$datas['imap_secure'] = 0; */
			
			$datas['bounce_acc'] = 0;
		}
		
		# SMTP Auth
		if(isset($_POST['smtp_auth']) && $_POST['smtp_auth']=='YES'){$smtp_auth=1;}else{$smtp_auth=0;}
		$datas['smtp_auth'] = $smtp_auth;
		
		/* DKIM */
		if(isset($_POST['dkimactive']) && $_POST['dkimactive']=='YES'){
			$dkimactive=1;
			$datas['dkim_active'] = 1;
			if(!isset($_POST['dkimdomain']) || empty($_POST['dkimdomain'])){$this->errPrint .= '* '. settings_please_enter_a_dkim_domain .'<br>';}else{$datas['dkim_domain'] = trim($_POST['dkimdomain']);}
			if(!isset($_POST['dkimprivate']) || empty($_POST['dkimprivate'])){$this->errPrint .= '* '. settings_please_enter_a_dkim_private_key .'<br>';}else{$datas['dkim_private'] = trim($_POST['dkimprivate']);}
			if(!isset($_POST['dkimselector']) || empty($_POST['dkimselector'])){$this->errPrint .= '* '. settings_please_enter_a_dkim_selector .'<br>';}else{$datas['dkim_selector'] = trim($_POST['dkimselector']);}
			if(!isset($_POST['dkimpassphrase']) || empty($_POST['dkimpassphrase'])){$this->errPrint .= '* '. settings_please_enter_a_dkim_passphrase .'<br>';}else{$datas['dkim_passphrase'] = trim($_POST['dkimpassphrase']);}
		}else{
			$dkimactive=0;
			$datas['dkim_active'] = 0;
			$datas['dkim_domain'] = '';
			$datas['dkim_private'] = '';
			$datas['dkim_selector'] = '';
			$datas['dkim_passphrase'] = '';
		}
		
		/* Bounce Actions */
		$bounceActions = array();
		foreach($LETHE_BOUNCE_TYPES as $k=>$v){
			if($this->onInstall){$frmAct=1;}else{
				$frmAct = ((isset($_POST['bounces_'.$k]) && is_numeric($_POST['bounces_'.$k])) ? $_POST['bounces_'.$k]:0);
			}
			$bounceActions[$k] = $frmAct;
		}
		
		$bounceActions = json_encode($bounceActions);
		$datas['bounce_actions'] = $bounceActions;
		
		if($this->errPrint==''){
		
			# Defaults
			$account_id = encr(uniqid('lethe',true).time().rand()); $datas['account_id'] = $account_id;
			$daily_date = date("Y-m-d H:i:s");
			$daily_date = strtotime(date("Y-m-d H:i:s", strtotime($daily_date)) . " +". $_POST['spec_limit_range'] ." minutes");
			$datas['daily_reset'] = date('Y-m-d H:i:s',$daily_date);
			if($systemAcc){$myconn->query("UPDATE ". db_table_pref ."submission_accounts  SET systemAcc=0 WHERE ID>0");}
		
			# CREATE
			if($db->insert('submission_accounts',$datas)){
				$subAccID = $myconn->insert_id;
				# Add Bounce Cron
				$buildCron = new lethe();
				$buildCron->chronosURL = "'".lethe_root_url.'chronos/lethe.bounce.php?ID='.$subAccID."' > /dev/null 2>&1";
				$genComm = $buildCron->buildChronos();
				$genDate = date('Y-m-d H:i:s');
				$db->insert('chronos',array(
												'OID'=>set_org_id,
												'SAID'=>$subAccID,
												'pos'=>0,
												'cron_command'=>$genComm,
												'launch_date'=>$genDate
											));
											
				$this->reConfSubAcc();
				
				$this->errPrint = errMod(''. letheglobal_recorded_successfully .'!','success');
											
			}else{
				$this->errPrint = errMod('Error Occured While Submission Account Creation '.$db->getLastError(),'danger');
			}

			if(!$this->onInstall){
				unset($_POST);
			}
		
		}else{
			$this->errPrint = errMod($this->errPrint,'danger');
		}
	
	}
	
	/* Edit Submission Account */
	public function editSubAccount(){
	
		global $myconn,$LETHE_BOUNCE_TYPES,$db;
		
		$datas = array();
		
		/* Open Account */
		$subIDs = $this->ID;
		$opAccRs = $db->where('ID=?',array($subIDs))->getOne('submission_accounts');
		if($db->count==0){$this->errPrint=errMod(letheglobal_record_not_found,'danger');}else{
		
		/* Delete */
		if(isset($_POST['del']) && $_POST['del']=='YES'){
		
			/* Delete Controls Here */
			if($opAccRs['systemAcc']==1){$this->errPrint .= '* '. settings_system_accounts_cannot_be_deleted .'!<br>';}else{
				$subAccID = $opAccRs['ID'];
				
				if(cntData("SELECT * FROM ". db_table_pref ."organization_settings WHERE set_key='org_submission_account' AND FIND_IN_SET('". $subAccID ."', set_val)")==0){
					
				# Remove Account
				$db->where('ID=?',array($subAccID))->delete('submission_accounts');
				
				# Remove Bounce Cron
				$db->where('OID=? AND ID=?',array(set_org_id,$subAccID))->update('chronos',array('pos'=>1));
				
				header('Location: ?p=settings/submission');
				die();
				
				}else{
					$this->errPrint .= '* '. settings_submission_account_being_used_by_the_organization .'<br>';
				}
			}
		
		}
		
		/* General */
		if(!isset($_POST['acc_title']) || empty($_POST['acc_title'])){$this->errPrint .= '* '. settings_please_enter_a_account_title .'<br>';}else{$datas['acc_title'] = trim($_POST['acc_title']);}
		if(!isset($_POST['daily_limit']) || !is_numeric($_POST['daily_limit'])){$this->errPrint .= '* '. settings_please_enter_a_daily_limit .'<br>';}else{$datas['daily_limit'] = trim($_POST['daily_limit']);}
		if(!isset($_POST['spec_limit_range']) || !is_numeric($_POST['spec_limit_range'])){$_POST['spec_limit_range']=$opAccRs['limit_range'];}else{$datas['limit_range'] = $_POST['spec_limit_range'];}
		if(!isset($_POST['send_per_conn']) || !is_numeric($_POST['send_per_conn'])){$this->errPrint .= '* '. settings_please_enter_a_per_connection_limit .'<br>';}else{$datas['send_per_conn'] = $_POST['send_per_conn'];}
		if(!isset($_POST['standby_time']) || !is_numeric($_POST['standby_time'])){$this->errPrint .= '* '. settings_please_enter_a_standby_limit .'<br>';}else{$datas['standby_time'] = $_POST['standby_time'];}
		if(isset($_POST['systemAcc']) && $_POST['systemAcc']=='YES'){$systemAcc=1;$datas['systemAcc']=1;}else{
			/* Check System Accounts */
			if(cntData("SELECT ID FROM ". db_table_pref ."submission_accounts WHERE systemAcc=1 AND ID<>" . $this->ID)==0){
				$systemAcc=1;
				$datas['systemAcc']=1;
			}else{
				$systemAcc=0;
				$datas['systemAcc']=0;
			}
		}
		if(isset($_POST['debug']) && $_POST['debug']=='YES'){$isDebug=1;$datas['isDebug']=1;}else{$isDebug=0;$datas['isDebug']=0;}
		if(isset($_POST['active']) && $_POST['active']=='YES'){$isActive=1;$datas['isActive']=1;}else{$isActive=0;$datas['isActive']=0;}
		
		/* Sending */
		if(!isset($_POST['from_title']) || empty($_POST['from_title'])){$this->errPrint .= '* '. settings_please_enter_a_sender_title .'<br>';}else{$datas['from_title'] = trim($_POST['from_title']);}
		if(!isset($_POST['from_mail']) || !mailVal($_POST['from_mail'])){$this->errPrint .= '* '. settings_invalid_sender_mail .'<br>';}else{$datas['from_mail'] = trim($_POST['from_mail']);}
		if(!isset($_POST['reply_mail']) || !mailVal($_POST['reply_mail'])){$this->errPrint .= '* '. settings_invalid_reply_mail .'<br>';}else{$datas['reply_mail'] = trim($_POST['reply_mail']);}
		if(!isset($_POST['test_mail']) || !mailVal($_POST['test_mail'])){$this->errPrint .= '* '. settings_invalid_test_mail .'<br>';}else{$datas['test_mail'] = trim($_POST['test_mail']);}
		if(!isset($_POST['mail_type']) || !is_numeric($_POST['mail_type'])){$this->errPrint .= '* '. settings_please_choose_a_mail_content_type .'<br>';}else{$datas['mail_type'] = $_POST['mail_type'];}
		if(!isset($_POST['send_method']) || !is_numeric($_POST['send_method'])){$this->errPrint .= '* '. settings_please_choose_a_sending_method .'<br>';}else{$datas['send_method'] = $_POST['send_method'];}
		if(!isset($_POST['mail_engine']) || empty($_POST['mail_engine'])){$this->errPrint .= '* '. settings_please_choose_a_mail_engine .'<br>';}else{$datas['mail_engine'] = $_POST['mail_engine'];}
		
		/* Connection SMTP */
		if(isset($_POST['send_method']) && intval($_POST['send_method'])==0){
			if(!isset($_POST['smtp_host']) || empty($_POST['smtp_host'])){$this->errPrint .= '* '. settings_please_enter_a_smtp_server .'<br>';}else{$datas['smtp_host'] = trim($_POST['smtp_host']);}
			if(!isset($_POST['smtp_port']) || empty($_POST['smtp_port'])){$this->errPrint .= '* '. settings_please_enter_a_smtp_port .'<br>';}else{$datas['smtp_port'] = trim($_POST['smtp_port']);}
			if(!isset($_POST['smtp_user']) || empty($_POST['smtp_user'])){$this->errPrint .= '* '. settings_please_enter_a_smtp_username .'<br>';}else{$datas['smtp_user'] = trim($_POST['smtp_user']);}
			if(!isset($_POST['smtp_pass']) || empty($_POST['smtp_pass'])){$_POST['smtp_pass'] = $opAccRs['smtp_pass'];}else{$datas['smtp_pass'] = trim($_POST['smtp_pass']);}
			if(!isset($_POST['smtp_secure']) || !is_numeric($_POST['smtp_secure'])){$this->errPrint .= '* '. settings_please_choose_a_smtp_encryption .'<br>';}else{$datas['smtp_secure'] = trim($_POST['smtp_secure']);}
		}
		
		if(isset($_POST['smtp_auth']) && $_POST['smtp_auth']=='YES'){$smtp_auth=1;}else{$smtp_auth=0;}
		$datas['smtp_auth'] = $smtp_auth;
		
		# PHP Mail
		if(isset($_POST['send_method']) && intval($_POST['send_method'])==1){
			if(!function_exists('mail')){$this->errPrint .= '* Server does not support PHP mail() !<br>';}
		}
		
		/* Amazon SES */
		if(isset($_POST['send_method']) && intval($_POST['send_method'])==2){
			if(!isset($_POST['aws_acc_key']) || empty($_POST['aws_acc_key'])){$this->errPrint .= '* '. settings_please_enter_aws_smtp_username .'<br>';}else{$datas['aws_access_key'] = trim($_POST['aws_acc_key']);}
			if(!isset($_POST['aws_sec_key']) || empty($_POST['aws_sec_key'])){$this->errPrint .= '* '. settings_please_enter_aws_smtp_password .'<br>';}else{$datas['aws_secret_key'] = trim($_POST['aws_sec_key']);}
			if(!isset($_POST['aws_region']) || empty($_POST['aws_region'])){$this->errPrint .= '* '. settings_please_choose_aws_region .'<br>';}else{$datas['aws_region'] = trim($_POST['aws_region']);}
			if(!isset($_POST['aws_port']) || !is_numeric($_POST['aws_port'])){$this->errPrint .= '* '. settings_please_enter_a_smtp_port .'<br>';}else{$datas['smtp_port'] = trim($_POST['aws_port']);}
		}
		
		# Mandrill
		if(isset($_POST['send_method']) && intval($_POST['send_method'])==3){
			if(!isset($_POST['mandrill_user']) || empty($_POST['mandrill_user'])){$this->errPrint .= '* '. settings_please_enter_a_mandrill_username .'<br>';}else{$datas['mandrill_user'] = trim($_POST['mandrill_user']);}
			if(!isset($_POST['mandrill_key']) || empty($_POST['mandrill_key'])){$this->errPrint .= '* '. settings_please_enter_a_mandrill_key .'<br>';}else{$datas['mandrill_key'] = trim($_POST['mandrill_key']);}
		}
		
		# SendGrid
		if(isset($_POST['send_method']) && intval($_POST['send_method'])==4){
			if(!isset($_POST['sendgrid_user']) || empty($_POST['sendgrid_user'])){$this->errPrint .= '* '. settings_please_enter_a_sendgrid_username .'<br>';}else{$datas['sendgrid_user'] = trim($_POST['sendgrid_user']);}
			if(!isset($_POST['sendgrid_pass']) || empty($_POST['sendgrid_pass'])){$_POST['sendgrid_pass']=$opAccRs['sendgrid_pass'];}else{$datas['sendgrid_pass'] = trim($_POST['sendgrid_pass']);}
		}
		
		# Bounce Settings
		$bounce_on = ((isset($_POST['bounce_on']) && $_POST['bounce_on']=="YES") ? 1:0);
		
		if(($bounce_on==1) && (isset($_POST['send_method']) && intval($_POST['send_method'])<2)){
			
		$datas['disable_bounce'] = 1;
		
		if(!isset($_POST['pop3_host']) || empty($_POST['pop3_host'])){$this->errPrint .= '* '. settings_please_enter_a_pop3_server .'<br>';}else{$datas['pop3_host'] = trim($_POST['pop3_host']);}
		if(!isset($_POST['pop3_port']) || empty($_POST['pop3_port'])){$this->errPrint .= '* '. settings_please_enter_a_pop3_port .'<br>';}else{$datas['pop3_port'] = trim($_POST['pop3_port']);}
		if(!isset($_POST['pop3_user']) || empty($_POST['pop3_user'])){$this->errPrint .= '* '. settings_please_enter_a_pop3_username .'<br>';}else{$datas['pop3_user'] = trim($_POST['pop3_user']);}
		if(!isset($_POST['pop3_pass']) || empty($_POST['pop3_pass'])){$datas['pop3_pass'] = $opAccRs['pop3_pass'];}else{$datas['pop3_pass'] = $_POST['pop3_pass'];}
		if(!isset($_POST['pop3_secure']) || !is_numeric($_POST['pop3_secure'])){$this->errPrint .= '* '. settings_please_choose_a_pop3_encryption .'<br>';}else{$datas['pop3_secure'] = trim($_POST['pop3_secure']);}
		
		if(!isset($_POST['imap_host']) || empty($_POST['imap_host'])){$this->errPrint .= '* '. settings_please_enter_a_imap_server .'<br>';}else{$datas['imap_host'] = trim($_POST['imap_host']);}
		if(!isset($_POST['imap_port']) || empty($_POST['imap_port'])){$this->errPrint .= '* '. settings_please_enter_a_imap_port .'<br>';}else{$datas['imap_port'] = trim($_POST['imap_port']);}
		if(!isset($_POST['imap_user']) || empty($_POST['imap_user'])){$this->errPrint .= '* '. settings_please_enter_a_imap_username .'<br>';}else{$datas['imap_user'] = trim($_POST['imap_user']);}
		if(!isset($_POST['imap_pass']) || empty($_POST['imap_pass'])){$datas['imap_pass'] = $opAccRs['imap_pass'];}else{$datas['imap_pass'] = $_POST['imap_pass'];}
		if(!isset($_POST['imap_secure']) || !is_numeric($_POST['imap_secure'])){$this->errPrint .= '* '. settings_please_choose_a_imap_encryption .'<br>';}else{$datas['imap_secure'] = trim($_POST['imap_secure']);}
		
		if(!isset($_POST['bounce_acc']) || !is_numeric($_POST['bounce_acc'])){$this->errPrint .= '* '. settings_please_choose_a_bounce_connector .'<br>';}else{$datas['bounce_acc'] = trim($_POST['bounce_acc']);}
		
		}else{
			# Disable Bounce Acc
			$datas['disable_bounce'] = 0;			
			$datas['bounce_acc'] = $opAccRs['pop3_pass'];
		}
		
		
		/* DKIM */
		if(isset($_POST['dkimactive']) && $_POST['dkimactive']=='YES'){
			$dkimactive=1;
			$datas['dkim_active'] = 1;
			if(!isset($_POST['dkimdomain']) || empty($_POST['dkimdomain'])){$this->errPrint .= '* '. settings_please_enter_a_dkim_domain .'<br>';}else{$datas['dkim_domain'] = trim($_POST['dkimdomain']);}
			if(!isset($_POST['dkimprivate']) || empty($_POST['dkimprivate'])){$this->errPrint .= '* '. settings_please_enter_a_dkim_private_key .'<br>';}else{$datas['dkim_private'] = trim($_POST['dkimprivate']);}
			if(!isset($_POST['dkimselector']) || empty($_POST['dkimselector'])){$this->errPrint .= '* '. settings_please_enter_a_dkim_selector .'<br>';}else{$datas['dkim_selector'] = trim($_POST['dkimselector']);}
			if(!isset($_POST['dkimpassphrase']) || empty($_POST['dkimpassphrase'])){$this->errPrint .= '* '. settings_please_enter_a_dkim_passphrase .'<br>';}else{$datas['dkim_passphrase'] = trim($_POST['dkimpassphrase']);}
		}else{
			$dkimactive=0;
		}
		
		/* Bounce Actions */
		$bounceActions = array();
		foreach($LETHE_BOUNCE_TYPES as $k=>$v){
			$frmAct = ((isset($_POST['bounces_'.$k]) && is_numeric($_POST['bounces_'.$k])) ? $_POST['bounces_'.$k]:0);
			$bounceActions[$k] = $frmAct;
		}
		
		$bounceActions = json_encode($bounceActions);
		$datas['bounce_actions'] = $bounceActions;
		
		if($this->errPrint==''){
		
			# Disable other system account if current account set for system account
			if($systemAcc){
				$db->where('ID>0')->update('submission_accounts',array('systemAcc'=>0));
			}
			
			# Limit Resetter
			if(isset($_POST['resetLimit']) && $_POST['resetLimit']=='YES'){
				$datas['daily_sent'] = 0;
				$daily_date = date("Y-m-d H:i:s");
				$daily_date = strtotime(date("Y-m-d H:i:s", strtotime($daily_date)) . " +". $_POST['spec_limit_range'] ." minutes");
				$datas['daily_reset'] = date('Y-m-d H:i:s',$daily_date);
			}
			
			$db->where('ID=?',array($this->ID))->update('submission_accounts',$datas);
			$this->reConfSubAcc();
			unset($_POST);
		
			$this->errPrint = errMod(''. letheglobal_updated_successfully .'!','success');
		}else{
			$this->errPrint = errMod($this->errPrint,'danger');
		}
		
		}
	
	}
	
	/* Submission Account Resetter */
	public function reConfSubAcc(){
		
		global $db;
		
		# Get Current List
		$currList = $db->where('set_key=?',array('org_submission_account'))->getOne('organization_settings');
		$currAcs = $currList['set_val'];
		$currAcs = explode(',',$currAcs);
		
		# System Account
		$sysSubAcc = $db->where('systemAcc=1')->getOne('submission_accounts');
		
		# Update Org Submission Accounts
		$subAcs = $db->where('isActive=1')->get('submission_accounts');
		$acList = array();
		foreach($subAcs as $subAcss){
			$acList[] = $subAcss['ID'];
		}
		$db->where('set_key=?',array('org_submission_account'))->update('organization_settings',array(
																										'set_val'=>implode(',',$acList)
																										));
																										
		# Check Deleted Accounts On Campaigns
		$replacer = array();
		foreach($currAcs as $k=>$v){
			if(!in_array($v,$acList)){
				$replacer[] = $v;
			}
		}
		
		if(count($replacer)>0){
			foreach($replacer as $k=>$v){
				$db->where('campaign_sender_account=?',array($v))->update('campaigns',array('campaign_sender_account'=>$sysSubAcc['ID']));
			}
		}
		
	}
	
	/* Add Organization */
	public function addOrganization(){
	
		global $myconn, $db;
		global $LETHE_ORG_DISK_QUOTA_LIST;
		global $LETHE_ORG_EDITABLE_CODES;
		global $LETHE_SUBSCRIBE_ERRORS;
	
		$this->errPrint = '';
		$extErrors = '';
		
		# Org Timezone Changed on v2.1
		if(!defined('lethe_default_timezone')){define('lethe_default_timezone','UTC');}
		$_POST['org_timezone'] = lethe_default_timezone;
		
		if(!isset($_POST['org_name']) || empty($_POST['org_name'])){$this->errPrint .= '* '. organizations_please_enter_a_organization_name .'<br>';}
		if(!isset($_POST['org_max_user']) || !is_numeric($_POST['org_max_user'])){$this->errPrint .= '* '. organizations_please_enter_a_maximum_user_limit .'<br>';}
		if(!isset($_POST['org_max_newsletter']) || !is_numeric($_POST['org_max_newsletter'])){$this->errPrint .= '* '. organizations_please_enter_a_maximum_newsletter_limit .'<br>';}
		if(!isset($_POST['org_max_autoresponder']) || !is_numeric($_POST['org_max_autoresponder'])){$this->errPrint .= '* '. organizations_please_enter_a_maximum_autoresponder_limit .'<br>';}
		if(!isset($_POST['org_max_subscriber']) || !is_numeric($_POST['org_max_subscriber'])){$this->errPrint .= '* '. organizations_please_enter_a_maximum_subscriber_limit .'<br>';}
		if(!isset($_POST['org_max_subscriber_group']) || !is_numeric($_POST['org_max_subscriber_group'])){$this->errPrint .= '* '. organizations_please_enter_a_maximum_subscriber_group_limit .'<br>';}
		if(!isset($_POST['org_max_subscribe_form']) || !is_numeric($_POST['org_max_subscribe_form'])){$this->errPrint .= '* '. organizations_please_enter_a_maximum_subscribe_form_limit .'<br>';}
		if(!isset($_POST['org_max_blacklist']) || !is_numeric($_POST['org_max_blacklist'])){$this->errPrint .= '* '. organizations_please_enter_a_maximum_black_list_limit .'<br>';}
		if(!isset($_POST['org_max_template']) || !is_numeric($_POST['org_max_template'])){$this->errPrint .= '* '. organizations_please_enter_a_maximum_template_limit .'<br>';}
		if(!isset($_POST['org_max_shortcode']) || !is_numeric($_POST['org_max_shortcode'])){$this->errPrint .= '* '. organizations_please_enter_maximum_short_code_limit .'<br>';}
		if(!isset($_POST['org_max_daily_limit']) || !is_numeric($_POST['org_max_daily_limit'])){$this->errPrint .= '* '. organizations_please_enter_a_daily_sending_limit .'<br>';}
		if(!isset($_POST['org_standby_organization']) || !is_numeric($_POST['org_standby_organization'])){$this->errPrint .= '* '. organizations_please_enter_a_standby_time_for_organizations .'<br>';}
		if(!isset($_POST['org_submission_account']) || intval($_POST['org_submission_account'])==0){$this->errPrint .= '* '. organizations_please_choose_a_submission_account .'<br>';}
		if(!isset($_POST['org_sender_title']) || empty($_POST['org_sender_title'])){$this->errPrint .= '* '. organizations_please_enter_a_sender_title .'<br>';}
		if(!isset($_POST['org_reply_mail']) || !mailVal($_POST['org_reply_mail'])){$this->errPrint .= '* '. organizations_invalid_reply_mail .'<br>';}
		if(!isset($_POST['org_test_mail']) || !mailVal($_POST['org_test_mail'])){$this->errPrint .= '* '. organizations_invalid_test_mail .'<br>';}
		if(!isset($_POST['org_after_unsubscribe']) || !is_numeric($_POST['org_after_unsubscribe'])){$this->errPrint .= '* '. organizations_please_choose_a_unsubscribe_action .'<br>';}
		if(!isset($_POST['org_verification']) || !is_numeric($_POST['org_verification'])){$this->errPrint .= '* '. organizations_please_choose_a_verification_method .'<br>';}
		if(!isset($_POST['org_random_load']) || empty($_POST['org_random_load'])){$_POST['org_random_load']='';}else{$_POST['org_random_load']=1;}
		if(!isset($_POST['org_load_type']) || !is_numeric($_POST['org_load_type'])){$this->errPrint .= '* '. organizations_please_choose_a_load_type .'<br>';}
		if(!isset($_POST['org_max_disk_quota']) || !in_array($_POST['org_max_disk_quota'],$LETHE_ORG_DISK_QUOTA_LIST)){$this->errPrint .= '* '. organizations_invalid_disk_quota_value .'<br>';}
		
		if($this->errPrint==''){
		
			/* Common Values */
			$this->isPrimary = ((cntData("SELECT * FROM ". db_table_pref ."organizations WHERE isPrimary=1")==0) ? 1:0);
			$billingDate = (($this->billingDate==0) ? date('Y-m-d H:i:s'):$this->billingDate);
			$orgTag = (($this->orgTag=='') ? slugify($_POST['org_name'].'-'.substr(encr($_POST['org_name'].time()),0,12)):$this->orgTag);
			$public_key = (($this->public_key=='') ? md5($orgTag.time().rand().$_POST['org_name'].uniqid(true)):$this->public_key);
			$private_key = (($this->private_key=='') ? md5($orgTag.sha1(time().rand().$_POST['org_name'].uniqid(true)).sha1(uniqid(true))):$this->private_key);
			$genAPIKey = sha1($private_key . md5(rand()) . $_SERVER['REMOTE_ADDR'] . $private_key . $public_key);
			$genAPIKey = substr(base64_encode($genAPIKey),0,32);
			
			# RSS Url
			if(!isset($_POST['org_rss_url']) || empty($_POST['org_rss_url'])){
				# Define as system URL
				$_POST['org_rss_url'] = lethe_root_url.'lethe.newsletter.php?pos=rss&oid='.$public_key;
			}else{
				$_POST['org_rss_url'] = $_POST['org_rss_url'];
			}
			
			$addOrg = $db->insert('organizations',array(
															'orgTag'=>$orgTag,
															'orgName'=>$_POST['org_name'],
															'billingDate'=>$billingDate,
															'isActive'=>1,
															'public_key'=>$public_key,
															'private_key'=>$private_key,
															'api_key'=>$genAPIKey,
															'ip_addr'=>$_SERVER['REMOTE_ADDR'],
															'isPrimary'=>$this->isPrimary,
															'rss_url'=>$_POST['org_rss_url'],
															'daily_reset'=>date('Y-m-d H:i:s')
														));
														
			if(!$addOrg){
				$extErrors.='Org Insert Failed - '.$db->getLastError().'<br>';
			}
		
			
			/* Organization ID */
			$orgID = $addOrg;
			$this->OID = $orgID;
			
			/* Create Folders */
			$orgFolder = substr($orgTag,0,30);
			if(mkdir(LETHE_RESOURCE.DIRECTORY_SEPARATOR.$orgFolder,0755)){
				mkdir(LETHE_RESOURCE.DIRECTORY_SEPARATOR.$orgFolder.'/expimp',0755);
			}
			
			/* Load Settings */
			global $LETHE_ORG_SET_VALS;
			

			foreach($LETHE_ORG_SET_VALS as $k=>$v){
				
				$addSet=$db->insert('organization_settings',array(
															'set_key'=>$v,
															'set_val'=>$_POST[$v],
															'OID'=>$orgID
														));
				
			} 
			
			/* Primary Records */
			# Groups				
			$addOrgGrp = $db->insert('subscriber_groups',
							array(
								'OID'=>$orgID,
								'UID'=>0,
								'group_name'=>'Unsubscribes',
								'isUnsubscribe'=>1,
								'isUngroup'=>0
								)
			);
			$addOrgGrp = $db->insert('subscriber_groups',
							array(
								'OID'=>$orgID,
								'UID'=>0,
								'group_name'=>'Ungrouped',
								'isUnsubscribe'=>0,
								'isUngroup'=>1
								)
			);
			
			if(!$addOrgGrp){
				$extErrors.='Sub Group Insert Failed - '.$db->getLastError().'<br>';
			}
			
			$unGroupID = getOrgData($orgID,0);
			
			# Forms
			$newFormID = "LetheForm_".substr(encr(time().uniqid(true)),0,7);
			
			$defCustErrors = array();
			foreach($LETHE_SUBSCRIBE_ERRORS as $fks=>$fvs){
				$defCustErrors[] = $fvs[1];
			}
			$defCustErrors = implode("[@]",$defCustErrors);
			
			$addOrgSubForm = $db->insert('subscribe_forms',array(
													'OID'=>$orgID,
													'form_name'=>'System Form',
													'form_id'=>$newFormID,
													'form_type'=>0,
													'form_success_url'=>NULL,
													'form_success_url_text'=>NULL,
													'form_success_text'=>'Your mail recorded successfully!',
													'form_success_redir'=>0,
													'form_remove'=>0,
													'isSystem'=>1,
													'form_view'=>0,
													'isDraft'=>0,
													'include_jquery'=>1,
													'include_jqueryui'=>1,
													'form_group'=>$unGroupID,
													'form_errors'=>$defCustErrors,
													'subscription_stop'=>0
												));
												
			if(!$addOrgSubForm){
				$extErrors.='Sub Form Insert Failed - '.$db->getLastError().'<br>';
			}
			

			$sysFormID = getOrgData($orgID,2);
			
			# Form Fields
			$addOrgFormFields = $db->insert('subscribe_form_fields',
									array(
											'OID'=>$orgID,
											'FID'=>$sysFormID,
											'field_label'=>'E-Mail',
											'field_name'=>'LetheForm_Mail',
											'field_type'=>'email',
											'field_required'=>1,
											'field_pattern'=>NULL,
											'field_placeholder'=>'E-Mail',
											'sorting'=>1,
											'field_data'=>NULL,
											'field_static'=>1,
											'field_save'=>'subscriber_mail',
											'field_error'=>'Invalid E-Mail Address'
									)
			);
			$addOrgFormFields = $db->insert('subscribe_form_fields',
									array(
											'OID'=>$orgID,
											'FID'=>$sysFormID,
											'field_label'=>'Save',
											'field_name'=>'LetheForm_Save',
											'field_type'=>'submit',
											'field_required'=>0,
											'field_pattern'=>NULL,
											'field_placeholder'=>NULL,
											'sorting'=>2,
											'field_data'=>NULL,
											'field_static'=>1,
											'field_save'=>NULL,
											'field_error'=>NULL
									)
			);
								
								
			if(!$addOrgFormFields){
				$extErrors.='Sub Form Field Insert Failed - '.$db->getLastError().'<br>';
			}

						
			# Templates
			$this->createSystemTemplates();
			
			/* Public Registration */
			if($this->public_registration){
				/* Verification Mails Here */
				# Only PRO
			}
			
			if(!$this->onInstall){
				unset($_POST);
			}
			$this->isSuccess=1;
		
			$this->errPrint = errMod($extErrors.''. letheglobal_recorded_successfully .'!','success');
		}else{
			$this->errPrint = errMod($this->errPrint,'danger');
		
		}
	}
		
	/* Edit Organization */
	public function editOrganization(){
	
		global $myconn;
		global $db;
		
		# Org Timezone Changed on v2.1
		if(!isset($_POST['lethe_default_timezone'])){$_POST['org_timezone'] = lethe_default_timezone;}else{
			$_POST['org_timezone'] = trim($_POST['lethe_default_timezone']);
		}
		
			$private_key = $this->private_key;
			$opOrg = $myconn->prepare("SELECT * FROM ". db_table_pref ."organizations WHERE ID=?") or die(mysqli_error($myconn));
			$opOrg->bind_param('i',$this->OID);
			$opOrg->execute();
			$opOrg->store_result();
			if($opOrg->num_rows==0){
				echo errMod('* '. letheglobal_record_not_found .'','danger');
			}else{
				$sr = new Statement_Result($opOrg);
				$opOrg->fetch();
			}
			
		$this->errPrint = '';
				
		if(!isset($_POST['org_name']) || empty($_POST['org_name'])){$this->errPrint .= '* '. organizations_please_enter_a_organization_name .'<br>';}
		
		if(LETHE_AUTH_MODE==2 && PRO_MODE){
			if(!isset($_POST['org_max_user']) || !is_numeric($_POST['org_max_user'])){$this->errPrint .= '* '. organizations_please_enter_a_maximum_user_limit .'<br>';}
			if(!isset($_POST['org_max_newsletter']) || !is_numeric($_POST['org_max_newsletter'])){$this->errPrint .= '* '. organizations_please_enter_a_maximum_newsletter_limit .'<br>';}
			if(!isset($_POST['org_max_autoresponder']) || !is_numeric($_POST['org_max_autoresponder'])){$this->errPrint .= '* '. organizations_please_enter_a_maximum_autoresponder_limit .'<br>';}
			if(!isset($_POST['org_max_subscriber']) || !is_numeric($_POST['org_max_subscriber'])){$this->errPrint .= '* '. organizations_please_enter_a_maximum_subscriber_limit .'<br>';}
			if(!isset($_POST['org_max_subscriber_group']) || !is_numeric($_POST['org_max_subscriber_group'])){$this->errPrint .= '* '. organizations_please_enter_a_maximum_subscriber_group_limit .'<br>';}
			if(!isset($_POST['org_max_subscribe_form']) || !is_numeric($_POST['org_max_subscribe_form'])){$this->errPrint .= '* '. organizations_please_enter_a_maximum_subscribe_form_limit .'<br>';}
			if(!isset($_POST['org_max_blacklist']) || !is_numeric($_POST['org_max_blacklist'])){$this->errPrint .= '* '. organizations_please_enter_a_maximum_black_list_limit .'<br>';}
			if(!isset($_POST['org_max_template']) || !is_numeric($_POST['org_max_template'])){$this->errPrint .= '* '. organizations_please_enter_a_maximum_template_limit .'<br>';}
			if(!isset($_POST['org_max_shortcode']) || !is_numeric($_POST['org_max_shortcode'])){$this->errPrint .= '* '. organizations_please_enter_maximum_short_code_limit .'<br>';}
			if(!isset($_POST['org_max_daily_limit']) || !is_numeric($_POST['org_max_daily_limit'])){$this->errPrint .= '* '. organizations_please_enter_a_daily_sending_limit .'<br>';}
			if(!isset($_POST['org_standby_organization']) || !is_numeric($_POST['org_standby_organization'])){$this->errPrint .= '* '. organizations_please_enter_a_standby_time_for_organizations .'<br>';}
		}else{
			$_POST['org_max_user'] = set_org_max_user;
			$_POST['org_max_newsletter'] = set_org_max_newsletter;
			$_POST['org_max_autoresponder'] = set_org_max_autoresponder;
			$_POST['org_max_subscriber'] = set_org_max_subscriber;
			$_POST['org_max_subscriber_group'] = set_org_max_subscriber_group;
			$_POST['org_max_subscribe_form'] = set_org_max_subscribe_form;
			$_POST['org_max_blacklist'] = set_org_max_blacklist;
			$_POST['org_max_template'] = set_org_max_template;
			$_POST['org_max_shortcode'] = set_org_max_shortcode;
			$_POST['org_max_daily_limit'] = set_org_max_daily_limit;
			$_POST['org_standby_organization'] = set_org_standby_organization;
		}
		
		/* Only For Super Admin */
		if(LETHE_AUTH_MODE==2){
			if(!isset($_POST['org_submission_account']) || count($_POST['org_submission_account'])==0){$this->errPrint .= '* '. organizations_please_choose_a_submission_account .'<br>';}else{
				$_POST['org_submission_account'] = implode(',',$_POST['org_submission_account']);
			}
		}else{
			$_POST['org_submission_account'] = set_org_submission_account;
		}
		
			if(!isset($_POST['org_sender_title']) || empty($_POST['org_sender_title'])){$this->errPrint .= '* '. organizations_please_enter_a_sender_title .'<br>';}
			if(!isset($_POST['org_reply_mail']) || !mailVal($_POST['org_reply_mail'])){$this->errPrint .= '* '. organizations_invalid_reply_mail .'<br>';}
			if(!isset($_POST['org_test_mail']) || !mailVal($_POST['org_test_mail'])){$this->errPrint .= '* '. organizations_invalid_test_mail .'<br>';}
			if(!isset($_POST['org_after_unsubscribe']) || !is_numeric($_POST['org_after_unsubscribe'])){$this->errPrint .= '* '. organizations_please_choose_a_unsubscribe_action .'<br>';}
			if(!isset($_POST['org_verification']) || !is_numeric($_POST['org_verification'])){$this->errPrint .= '* '. organizations_please_choose_a_verification_method .'<br>';}
			if(!isset($_POST['org_random_load']) || empty($_POST['org_random_load'])){$_POST['org_random_load']='';}else{$_POST['org_random_load']=1;}
			if(!isset($_POST['org_load_type']) || !is_numeric($_POST['org_load_type'])){$this->errPrint .= '* '. organizations_please_choose_a_load_type .'<br>';}
		
		if($this->errPrint==''){
		
			/* Common Values */
			$this->isPrimary = $sr->Get('isPrimary');
			$billingDate = (($this->billingDate==0) ? '':$this->billingDate);
			$orgTag = (($this->orgTag=='') ? $sr->Get('orgTag'):$this->orgTag);
			$public_key = (($this->public_key=='') ? $sr->Get('public_key'):$this->public_key);
			$private_key = (($this->private_key=='') ? $sr->Get('private_key'):$this->private_key);
			
			# RSS Url
			if(!isset($_POST['org_rss_url']) || empty($_POST['org_rss_url'])){
				# Define as system URL
				$_POST['org_rss_url'] = lethe_root_url.'lethe.newsletter.php?pos=rss&oid='.$public_key;
			}else{
				$_POST['org_rss_url'] = $_POST['org_rss_url'];
			}
			
		
			$addOrg = $myconn->prepare("UPDATE 
														". db_table_pref ."organizations
												SET
														orgTag=?,
														orgName=?,
														billingDate=?,
														isActive=1,
														public_key=?,
														private_key=?,
														rss_url=?
											  WHERE
														ID=". $sr->Get('ID') ."
													") or die(mysqli_error($myconn));
			$addOrg->bind_param('ssssss',
									$orgTag,
									$_POST['org_name'],
									$billingDate,
									$public_key,
									$private_key,
									$_POST['org_rss_url']
									);
			$addOrg->execute();
			$addOrg->close();
			
			/* Organization ID */
			$orgID = $sr->Get('ID');
			
			/* Load Settings */
			global $LETHE_ORG_SET_VALS;
			
			$addSet = $myconn->prepare("UPDATE ". db_table_pref ."organization_settings SET set_val=? WHERE OID=? AND set_key=?") or die(mysqli_error($myconn));
			foreach($LETHE_ORG_SET_VALS as $k=>$v){
				if(!isset($_POST[$v])){$_POST[$v]=constant('set_'.$v);}
				$addSet->bind_param('sis',$_POST[$v],$orgID,$v);
				$addSet->execute();
			} $addSet->close();
					
			unset($_POST);
			$this->isSuccess=1;
		
			$this->errPrint = errMod(''. letheglobal_updated_successfully .'!','success');
		}else{
			$this->errPrint = errMod($this->errPrint,'danger');
		
		}
	
	}
	
	/* System Templates */
	private function createSystemTemplates(){
		
		global $myconn,$db;
		$tempList = array(
							'verification'=>array('name'=>'Verification Mail Template',
													'content'=>'<!DOCTYPE html> <html lang="en"> <head> <meta charset="utf-8"> <title>Lethe Newsletter Verification</title> </head> <body style="margin:0; padding:0; background-color:#EAEEEF; font-family:Tahoma; font-size:12px; color:#000;"> <p>&nbsp;</p> <!-- page content --> <div id="main_lay" style="width: 500px; margin: 50px auto; margin-bottom: 0; padding: 15px; background-color: #fff; -webkit-box-shadow: 2px 2px 5px 0px rgba(148,148,148,1); -moz-box-shadow: 2px 2px 5px 0px rgba(148,148,148,1); box-shadow: 2px 2px 5px 0px rgba(148,148,148,1);"> <h3>{ORGANIZATION_NAME}<br /><small style="color: #999;">E-Mail Verification</small></h3> <hr style="border: 1px solid #ededed; height: 1px;" /> <p>Hello {SUBSCRIBER_NAME},</p> <p>Welcome to {ORGANIZATION_NAME}! Please take a second to confirm <span style="color: #ec5500;">{SUBSCRIBER_MAIL}</span> as your email address by clicking this link:</p> <p><strong style="color: #0489b1;">{VERIFY_LINK[Click Here!]}</strong></p> <p>Once you do, you will be able to opt-in to notifications of activity and access other features that require a valid email address.</p> <p>Thank You!</p> <hr style="border: 1px solid #ededed; height: 1px;" /> <div style="background-color: #f2f2f2; padding: 7px;"><small> {company_name}<br /> {company_phone_1} - {company_phone_2} </small></div> </div> <div id="ext_lay" style="width: 500px; margin: 2px auto; padding: 15px;"><small>{LETHE_SAVE_TREE}</small></div> <!-- page content --> <p>&nbsp;</p> </body> </html>',
													'prev'=>lethe_admin_url.'images/temp/verification_temp.png'
													),
							'unsubscribe'=>array('name'=>'Unsubscribe Page Template',
													'content'=>'<!DOCTYPE html> <html lang="en"> <head> <meta charset="utf-8"> <title>Lethe Newsletter Unsubscribe</title> </head> <body style="margin:0; padding:0; background-color:#EAEEEF; font-family:Tahoma; font-size:12px; color:#000;"> <p>&nbsp;</p> <!-- page content --> <div id="main_lay" style="width: 500px; margin: 50px auto; margin-bottom: 0; padding: 15px; background-color: #fff; -webkit-box-shadow: 2px 2px 5px 0px rgba(148,148,148,1); -moz-box-shadow: 2px 2px 5px 0px rgba(148,148,148,1); box-shadow: 2px 2px 5px 0px rgba(148,148,148,1);"> <h3>{ORGANIZATION_NAME}<br /><small style="color: #999;">Unsubscription</small></h3> <hr style="border: 1px solid #ededed; height: 1px;" /> <p>Hello {SUBSCRIBER_NAME},</p> <p>We are sorry to see you go :-(</p> <p>You have been successfully removed from this subscriber list. <br />You will no longer hear from us.</p> <p>{UNSUBSCRIBE_SURVEY}</p> <p>Thank You!</p> <hr style="border: 1px solid #ededed; height: 1px;" /> <div style="background-color: #f2f2f2; padding: 7px;"><small> {company_name}<br /> {company_phone_1} - {company_phone_2} </small></div> </div> <!-- page content --> <p>&nbsp;</p> </body> </html>',
													'prev'=>lethe_admin_url.'images/temp/unsubscribe_temp.png'
													),
							'thank'=>array('name'=>'Subscription Thank Template',
													'content'=>' <!DOCTYPE html> <html lang="en"> <head> <meta charset="utf-8"> <title>Lethe Newsletter Subscription</title> </head> <body style="margin:0; padding:0; background-color:#EAEEEF; font-family:Tahoma; font-size:12px; color:#000;"> <p>&nbsp;</p> <!-- page content --> <div id="main_lay" style="width: 500px; margin: 50px auto; margin-bottom: 0; padding: 15px; background-color: #fff; -webkit-box-shadow: 2px 2px 5px 0px rgba(148,148,148,1); -moz-box-shadow: 2px 2px 5px 0px rgba(148,148,148,1); box-shadow: 2px 2px 5px 0px rgba(148,148,148,1);"> <h3>{ORGANIZATION_NAME}<br /><small style="color: #999;">Subscription</small></h3> <hr style="border: 1px solid #ededed; height: 1px;" /> <h1>Thank You!</h1> <p>Hello {SUBSCRIBER_NAME},</p> <p>Thank you for subscribing to our newsletter.</p> <p>Your subscription is now complete!</p> <hr style="border: 1px solid #ededed; height: 1px;" /> <div style="background-color: #f2f2f2; padding: 7px;"><small> {company_name}<br /> {company_phone_1} - {company_phone_2} </small></div> </div> <!-- page content --> <p>&nbsp;</p> </body> </html>',
													'prev'=>lethe_admin_url.'images/temp/thank_temp.png'
													),
							'norecord'=>array('name'=>'No Record Found Template',
													'content'=>'<!DOCTYPE html> <html lang="en"> <head> <meta charset="utf-8"> <title>No Record Found</title> </head> <body style="margin:0; padding:0; background-color:#EAEEEF; font-family:Tahoma; font-size:12px; color:#000;"> <p> </p> <!-- page content --> <div id="main_lay" style="width: 500px; margin: 50px auto; margin-bottom: 0; padding: 15px; background-color: #fff; -webkit-box-shadow: 2px 2px 5px 0px rgba(148,148,148,1); -moz-box-shadow: 2px 2px 5px 0px rgba(148,148,148,1); box-shadow: 2px 2px 5px 0px rgba(148,148,148,1);"> <h3>{ORGANIZATION_NAME}<br /><small style="color: #999;">Error Occurred<br /></small></h3> <hr style="border: 1px solid #ededed; height: 1px;" /> <h1><span style="color: #ff0000;">There No Record Found!</span></h1> Please try again or contact with web administration.<br /><br />Thank you!<br /><br /><hr style="border: 1px solid #ededed; height: 1px;" /> <div style="background-color: #f2f2f2; padding: 7px;"><small> {ORGANIZATION_NAME}<br /></small></div> </div> <!-- page content --> <p> </p> </body> </html>',
													'prev'=>lethe_admin_url.'images/temp/norecord_temp.png'
													),
							'erroroccurred'=>array('name'=>'Error Occurred Template',
													'content'=>'<!DOCTYPE html> <html lang="en"> <head> <meta charset="utf-8"> <title>Error Occurred</title> </head> <body style="margin:0; padding:0; background-color:#EAEEEF; font-family:Tahoma; font-size:12px; color:#000;"> <p> </p> <!-- page content --> <div id="main_lay" style="width: 500px; margin: 50px auto; margin-bottom: 0; padding: 15px; background-color: #fff; -webkit-box-shadow: 2px 2px 5px 0px rgba(148,148,148,1); -moz-box-shadow: 2px 2px 5px 0px rgba(148,148,148,1); box-shadow: 2px 2px 5px 0px rgba(148,148,148,1);"> <h3>{ORGANIZATION_NAME}<br /><small style="color: #999;">Error Occurred<br /></small></h3> <hr style="border: 1px solid #ededed; height: 1px;" /> <h1><span style="color: #ff0000;">Error Occurred!</span></h1> There is error occurred while request this page!<br /><br />Please try again or contact with web administration.<br /><br />Thank you!<br /><br /><hr style="border: 1px solid #ededed; height: 1px;" /> <div style="background-color: #f2f2f2; padding: 7px;"><small> {ORGANIZATION_NAME}<br /></small></div> </div> <!-- page content --> <p> </p> </body> </html>',
													'prev'=>lethe_admin_url.'images/temp/erroroccurred_temp.png'
													),
							'alreadyverified'=>array('name'=>'Already Verified Template',
													'content'=>'<!DOCTYPE html> <html lang="en"> <head> <meta charset="utf-8"> <title>Already Verified</title> </head> <body style="margin:0; padding:0; background-color:#EAEEEF; font-family:Tahoma; font-size:12px; color:#000;"> <p> </p> <!-- page content --> <div id="main_lay" style="width: 500px; margin: 50px auto; margin-bottom: 0; padding: 15px; background-color: #fff; -webkit-box-shadow: 2px 2px 5px 0px rgba(148,148,148,1); -moz-box-shadow: 2px 2px 5px 0px rgba(148,148,148,1); box-shadow: 2px 2px 5px 0px rgba(148,148,148,1);"> <h3>{ORGANIZATION_NAME}<br /><small style="color: #999;">Subscription</small></h3> <hr style="border: 1px solid #ededed; height: 1px;" /> <h1>You have already verified!</h1> <p>Hello {SUBSCRIBER_NAME},</p> You have already been verified your account. Please remove this mail from your mailbox.<br /><br />Thank you!<br /><hr style="border: 1px solid #ededed; height: 1px;" /> <div style="background-color: #f2f2f2; padding: 7px;"><small> {ORGANIZATION_NAME}<br /></small></div> </div> <!-- page content --> <p> </p> </body> </html>',
													'prev'=>lethe_admin_url.'images/temp/already_verified_temp.png'
													)
						);
						
						
		$extErrors = '';
		foreach($tempList as $k=>$v){
			
			$tempQry = $db->insert('templates',array(
														'OID'=>$this->OID,
														'UID'=>0,
														'temp_name'=>$v['name'],
														'temp_contents'=>$v['content'],
														'temp_prev'=>$v['prev'],
														'temp_type'=>$k,
														'isSystem'=>1,
														'temp_id'=>NULL
													));
			if(!$tempQry){
				$extErrors.='System Templates Insert Failed - '.$db->getLastError().'<br>';
			}
		
		}
		
	}
	
	/* Blacklist Add */
	public function addBlacklist(){
	
		global $myconn,$db;
		
		$db->where('OID=? AND email=?',array($this->OID,$_POST['new_rec_mail']))->getOne('blacklist');
		
	
		if($db->count==0){
			
			$addRec = insert('blacklist',array(
													'OID'=>$this->OID,
													'email'=>$_POST['new_rec_mail'],
													'ipAddr'=>$_POST['new_rec_ip'],
													'reasons'=>$_POST['new_rec_reason']
												));
												
			if(!$addRec){
				$extErrors='Blacklist Insert Failed - '.$db->getLastError().'<br>';
			}
		
		} 
	
	}
	
	/* Add Subscriber */
	public function addSubscriber(){
	
		global $myconn,$db;
		global $LETHE_SUBSCRIBE_SAVE_FIELDS;
		global $LETHE_ORG_SETS;
		
	
		if(!is_array($this->subscribeData)){
			$this->errPrint = '* Invalid Datas!';
			return false;
		}else{
			$subData = $this->subscribeData;
			$fullData = array();
			$jsonObject = null;
			$GID = 0;
			if(isset($_POST['LetheForm_Mail'])){
				$jsonObject = $_POST['LetheForm_Mail'];
			}
			
			$save_field_vars = array();
			foreach($subData as $k=>$v){
				if($k=='GID'){
					$GID = $v['data'];
					# Dont Add to JSON
					# $fullData[$jsonObject][] = array('label'=>'Group','content'=>$v['data']);
				}elseif($k=='sbscrtag'){
					$save_field_vars['sbscrtag'] = $v['data'];
					# Dont Add to JSON
					# $fullData[$jsonObject][] = array('label'=>'Group','content'=>$v['data']);
				}else{
					foreach($LETHE_SUBSCRIBE_SAVE_FIELDS as $a=>$b){
						if($a==$v['data']){
							if($v['data']=='subscriber_full_data'){
								$fullData[$jsonObject][] = array('label'=>$v['label'],'content'=>validateDatas($_POST[$k],$v['type']));
							}else{
								$save_field_vars[$a] = validateDatas($_POST[$k],$v['type']);
								# Dont Add to JSON Saved Fields
								# $fullData[$jsonObject][] = array('label'=>$v['label'],'content'=>validateDatas($_POST[$k],$v['type']));
							}
						}
					}
				}
			}
			
			
			/* Local Data */
/* 			$localData = getMyLocal();
			$fetchLocal_country_name = $localData['country_name'];
			$fetchLocal_country_code = $localData['country_code'];
			$fetchLocal_city_name = $localData['city_name'];
			$fetchLocal_region_name = $localData['region_name'];
			$fetchLocal_region_code = $localData['region_code']; */
			$fetchLocal_country_name = 'N/A';
			$fetchLocal_country_code = 'N/A';
			$fetchLocal_city_name = 'N/A';
			$fetchLocal_region_name = 'N/A';
			$fetchLocal_region_code = 'N/A';
			
			# Dont Add to JSON
/* 			$fullData[$jsonObject][] = array('label'=>'Country','content'=>$localData['country_name']);
			$fullData[$jsonObject][] = array('label'=>'Country Code','content'=>$localData['country_code']);
			$fullData[$jsonObject][] = array('label'=>'City','content'=>$localData['city_name']);
			$fullData[$jsonObject][] = array('label'=>'Region','content'=>$localData['region_name']);
			$fullData[$jsonObject][] = array('label'=>'Region Code','content'=>$localData['region_code']); */
			
			/* Rendered Data */
			$fullData = json_encode($fullData);
			$subscriber_name = ((array_key_exists('subscriber_name',$save_field_vars)) ? $save_field_vars['subscriber_name']:NULL);
			$subscriber_mail = ((array_key_exists('subscriber_mail',$save_field_vars)) ? $save_field_vars['subscriber_mail']:NULL);
			$subscriber_web = ((array_key_exists('subscriber_web',$save_field_vars)) ? $save_field_vars['subscriber_web']:NULL);
			$subscriber_date = ((array_key_exists('subscriber_date',$save_field_vars)) ? date('Y-m-d H:i:s',strtotime($save_field_vars['subscriber_date'])):date('Y-m-d H:i:s'));
			$subscriber_phone = ((array_key_exists('subscriber_phone',$save_field_vars)) ? $save_field_vars['subscriber_phone']:NULL);
			$subscriber_company = ((array_key_exists('subscriber_company',$save_field_vars)) ? $save_field_vars['subscriber_company']:NULL);
			$subscriber_tag = ((array_key_exists('sbscrtag',$save_field_vars)) ? $save_field_vars['sbscrtag']:'NOTAG');
					
			/* Subscriber Key */
			$subKey = encr('lethe'.time().$fullData.uniqid(true).$subscriber_mail);
			$verifyMod = ((isLogged()) ? 2:(($LETHE_ORG_SETS['set_org_verification']==0) ? 2:0));
			
		
			/* Verification Code */
			$genVerifyKey = encr($subKey.uniqid(true));
						
			/* Add */
			$db->setTrace (true);
			$addSub = $db->insert('subscribers',array(
												'OID'=>$this->OID,
												'GID'=>$GID,
												'subscriber_name'=>trim($subscriber_name),
												'subscriber_mail'=>trim($subscriber_mail),
												'subscriber_web'=>trim($subscriber_web),
												'subscriber_date'=>trim($subscriber_date),
												'subscriber_phone'=>trim($subscriber_phone),
												'subscriber_company'=>trim($subscriber_company),
												'subscriber_full_data'=>$fullData,
												'subscriber_active'=>1,
												'subscriber_verify'=>$verifyMod,
												'subscriber_key'=>$subKey,
												'ip_addr'=>getIP(),
												'subscriber_verify_key'=>$genVerifyKey,
												'local_country'=>$fetchLocal_country_name,
												'local_country_code'=>$fetchLocal_country_code,
												'local_city'=>$fetchLocal_city_name,
												'local_region'=>$fetchLocal_region_name,
												'local_region_code'=>$fetchLocal_region_code,
												'add_date'=>date('Y-m-d H:i:s'),
												'subscriber_tag'=>$subscriber_tag
											));

			if(!$addSub){
				$this->errPrint = '* Subscriber Cannot Be Added to Database!<br>';
				if(lethe_debug_mode){
					$this->errPrint .= $db->getLastError();
					$this->errPrint .= '<br><br>';
					print_r ($db->trace);
				}
				return false;
			}else{
			
				/* Send Verification */
				if(!isLogged()){ # Dont send verification if admin add on panel
					$this->SUBID = $addSub;
					$this->sendVerify();
				}
			
			}
			
			return true;
			
		}
	}
	
	/* Remove Subscriber */
	public function removeSubscription($smail,$removeReport=true){
		
		global $myconn, $db;
		$orgIDs = $this->OID;
		$subGID = $this->SUGID;
		
		
		if($subGID!=0){
			# Group Based Removing
			
			$suListR = $db->where('GID=? AND subscriber_mail=?',array($subGID,$smail))->getOne('subscribers');

				
				$db->where('subscriber_mail=?',array($smail))->delete('unsubscribes');
				$db->where('email=?',array($smail))->delete('reports');
				$db->where('subscriber_mail=? AND subscriber_key=?',array($smail,$suListR['subscriber_key']))->delete('tasks');
				$db->where('subscriber_mail=?',array($smail))->delete('subscribers');
				

			
		}else{
			
			$subData = $db->where('subscriber_mail=?',array($smail))->getOne('subscribers');
			
			$db->where('subscriber_mail=?',array($smail))->delete('unsubscribes');
			$db->where('email=?',array($smail))->delete('reports');
			$db->where('subscriber_mail=? AND subscriber_key=?',array($smail,$subData['subscriber_key']))->delete('tasks');
			$db->where('subscriber_mail=?',array($smail))->delete('subscribers');
			
		}
		
		
	}

	/* Build Subscriber JSON Data */
	public function buildJSON($ID){
		
		global $myconn;
		
		# Get OID If its Not Set (Requires Private Key)
		if($this->OID==0){
			$opOr = $myconn->prepare("SELECT ID,private_key FROM ". db_table_pref ."organizations WHERE private_key=?") or die(mysqli_error($myconn));
			$opOr->bind_param('s',$this->private_key);
			$opOr->execute();
			$opOr->store_result();
			if($opOr->num_rows==0){
				$opOr->close();
				return false;
			}else{
				$oidPVTK = new Statement_Result($opOr);
				$opOr->fetch();
				$opOr->close();
				$this->OID = $oidPVTK->Get('ID');
			}
		}
		
		# Open Subscriber
		$opSub = $myconn->query("SELECT * FROM ". db_table_pref ."subscribers WHERE OID=". $this->OID ." AND ID=". intval($ID) ."") or die(mysqli_error($myconn));
		if(mysqli_num_rows($opSub)!=0){
			$opSubRs = $opSub->fetch_assoc();
			$currJson = json_decode($opSubRs['subscriber_full_data'],true);
			
			# Static
				$currJson[$opSubRs['subscriber_mail']][]=array('label'=>'Group','content'=>$opSubRs['GID']);
				$currJson[$opSubRs['subscriber_mail']][]=array('label'=>'Name','content'=>$opSubRs['subscriber_name']);
				$currJson[$opSubRs['subscriber_mail']][]=array('label'=>'E-Mail','content'=>$opSubRs['subscriber_mail']);
				$currJson[$opSubRs['subscriber_mail']][]=array('label'=>'Web','content'=>$opSubRs['subscriber_web']);
				$currJson[$opSubRs['subscriber_mail']][]=array('label'=>'Date','content'=>$opSubRs['subscriber_date']);
				$currJson[$opSubRs['subscriber_mail']][]=array('label'=>'Phone','content'=>$opSubRs['subscriber_phone']);
				$currJson[$opSubRs['subscriber_mail']][]=array('label'=>'Company','content'=>$opSubRs['subscriber_company']);
				$currJson[$opSubRs['subscriber_mail']][]=array('label'=>'Country','content'=>$opSubRs['local_country']);
				$currJson[$opSubRs['subscriber_mail']][]=array('label'=>'Country Code','content'=>$opSubRs['local_country_code']);
				$currJson[$opSubRs['subscriber_mail']][]=array('label'=>'City','content'=>$opSubRs['local_city']);
				$currJson[$opSubRs['subscriber_mail']][]=array('label'=>'Region','content'=>$opSubRs['local_region']);
				$currJson[$opSubRs['subscriber_mail']][]=array('label'=>'Region Code','content'=>$opSubRs['local_region_code']);
				# $staticDts = array('Group','Name','E-Mail','Web','Date','Phone','Company','Country','Country Code','City','Region','Region Code');
					
			
			$newJson = json_encode($currJson);
			return $newJson;
			
		} 
		$opSub->free();
		
	}
	
	/* Unsubscribe Action */
	public function getUnsubscribing($smail,$CID=0,$typ){
		
		global $myconn;
		
		# typ 0 - Mark It Inactive
		# typ 1 - Force Remove
		# typ 2 - Move to Unsubscribe
		
		$keyOrMail = ((!mailVal($smail)) ? false:true); # true is mail control
		
		# Check Record Availability
		$chkRec = $myconn->prepare("SELECT * FROM ". db_table_pref ."subscribers WHERE OID=". $this->OID ." AND ". (($keyOrMail) ? 'subscriber_mail':'subscriber_key') ."=?") or die(mysqli_error($myconn));
		$chkRec->bind_param('s',$smail);
		$chkRec->execute();
		$chkRec->store_result();
		if($chkRec->num_rows==0){$chkRec->close();return false;}else{
			$srUns = new Statement_Result($chkRec);
			$chkRec->fetch();
			$chkRec->close();
		}
		
		if($typ==0){
			# If Action is Campaign, Subscriber Will Add to Unsubscribe Reports Table
			$myconn->query("UPDATE ". db_table_pref ."subscribers SET subscriber_active=0 WHERE ID=". intval($srUns->Get('ID')) ."") or die(mysqli_error($myconn));
			if($CID!=0){
				$chkTbl = $myconn->prepare("SELECT * FROM ". db_table_pref ."unsubscribes WHERE OID=". $this->OID ." AND CID=? AND subscriber_mail=?") or die(mysqli_error($myconn));
				$chkTbl->bind_param('is',$CID,$smail);
				$chkTbl->execute(); $chkTbl->store_result();
				if($chkTbl->num_rows==0){
					$addUns = $myconn->prepare("INSERT INTO ". db_table_pref ."unsubscribes SET OID=". $this->OID .", CID=?, subscriber_mail=?, add_date='". date('Y-m-d H:i:s') ."'") or die(mysqli_error($myconn));
					$addUns->bind_param('is',$CID,$smail);
					$addUns->execute();
					$addUns->close();
				} $chkTbl->close();
			}
			return true;
		}
		else if($typ==1){
			# If Action is Campaign, Subscriber Will Add to Unsubscribe Reports Table
			$smail = $srUns->Get('subscriber_mail');
			$this->removeSubscription($smail);
			
			if($CID!=0){
				$chkTbl = $myconn->prepare("SELECT * FROM ". db_table_pref ."unsubscribes WHERE OID=". $this->OID ." AND CID=? AND subscriber_mail=?") or die(mysqli_error($myconn));
				$chkTbl->bind_param('is',$CID,$smail);
				$chkTbl->execute(); $chkTbl->store_result();
				if($chkTbl->num_rows==0){
					$addUns = $myconn->prepare("INSERT INTO ". db_table_pref ."unsubscribes SET OID=". $this->OID .", CID=?, subscriber_mail=?, add_date='". date('Y-m-d H:i:s') ."'") or die(mysqli_error($myconn));
					$addUns->bind_param('is',$CID,$smail);
					$addUns->execute();
					$addUns->close();
				} $chkTbl->close();
			}
			return true;
		}
		else if($typ==2){
			# If Action is Campaign, Subscriber Will Add to Unsubscribe Reports Table
			$opGrp = $myconn->query("SELECT * FROM ". db_table_pref ."subscriber_groups WHERE OID=". $this->OID ." AND isUnsubscribe=1") or die(mysqli_error($myconn));
			if(mysqli_num_rows($opGrp)==0){$opGrp->free(); return false;}else{
				$opGrpRs = $opGrp->fetch_assoc();
				$GRP = $opGrpRs['ID'];
				$myconn->query("UPDATE ". db_table_pref ."subscribers SET GID=". $GRP ." WHERE ID=". intval($srUns->Get('ID')) ."") or die(mysqli_error($myconn));
			if($CID!=0){
				$chkTbl = $myconn->prepare("SELECT * FROM ". db_table_pref ."unsubscribes WHERE OID=". $this->OID ." AND CID=? AND subscriber_mail=?") or die(mysqli_error($myconn));
				$chkTbl->bind_param('is',$CID,$smail);
				$chkTbl->execute(); $chkTbl->store_result();
				if($chkTbl->num_rows==0){
					$addUns = $myconn->prepare("INSERT INTO ". db_table_pref ."unsubscribes SET OID=". $this->OID .", CID=?, subscriber_mail=?, add_date='". date('Y-m-d H:i:s') ."'") or die(mysqli_error($myconn));
					$addUns->bind_param('is',$CID,$smail);
					$addUns->execute();
					$addUns->close();
				} $chkTbl->close();
			}
				$opGrp->free();
				return true;
			}
		}
		
	}

	/* Verification Mail Sender */
	public function sendVerify($mod=1){
	
		global $myconn;
		global $LETHE_ORG_SETS;
		
		# Mod 1 - Single
		# Mod 2 - Double
		# Only OID and SUBID required for simple verification sender calling, Mod value can be changed into first verification page
		
		/* Load Verification Template */
		$opTemp = $myconn->query("
								   SELECT 
											TEMP.temp_type, TEMP.temp_name, TEMP.temp_contents,
											ORG.ID,ORG.orgName,ORG.public_key AS OPLKEY,
											SBR.ID AS SBRID,
											SBR.subscriber_name, SBR.subscriber_mail, SBR.subscriber_web, SBR.subscriber_date, SBR.subscriber_phone, SBR.subscriber_company,
											SBR.subscriber_verify,SBR.subscriber_verify_key,SBR.subscriber_key,
											ORGSET.OID AS OSOID,
											ORGSET.set_key,ORGSET.set_val
											
								     FROM 
											". db_table_pref ."templates AS TEMP,
											". db_table_pref ."organizations AS ORG,
											". db_table_pref ."organization_settings AS ORGSET,
											". db_table_pref ."subscribers AS SBR
								    WHERE 
											ORG.ID=". $this->OID ." 
									  AND 
											(TEMP.OID=ORG.ID AND TEMP.temp_type='verification')
									  AND
											(SBR.ID=". $this->SUBID .")
									  AND
											(ORGSET.OID=". $this->OID .")
									  AND
											(ORGSET.set_key='org_submission_account' OR ORGSET.set_key='org_sender_title' OR ORGSET.set_key='org_reply_mail')
									
									") or die(mysqli_error($myconn));
		if(mysqli_num_rows($opTemp)==0){
			$opTemp->free();
			return false;
		}else{
			$opTempRs = $opTemp->fetch_assoc();
			
			$replaced = $this->shortReplaces(array($opTempRs['temp_name'],$opTempRs['temp_contents']));
			$mailTitle = $replaced[0];
			$mailBody = $replaced[1];
			
			/* Special System Codes */
			$find = array(
			'{SUBSCRIBER_NAME}',
			'{SUBSCRIBER_MAIL}',
			'{SUBSCRIBER_PHONE}',
			'{SUBSCRIBER_COMPANY}'
			);
			
			$replace = array(
			$opTempRs['subscriber_name'],
			$opTempRs['subscriber_mail'],
			$opTempRs['subscriber_phone'],
			$opTempRs['subscriber_company']
			);
			
			$mailBody = str_replace($find,$replace,$mailBody);
			$mailTitle = str_replace($find,$replace,$mailTitle);
			
			/* Verify Code Replacer */
			$mailBody = preg_replace('#\{?(VERIFY_LINK\[)(.*?)\\]}#','<a href="'. lethe_root_url .'lethe.newsletter.php?pos=verification&amp;oid='. $opTempRs['OPLKEY'] .'&amp;sid='. $opTempRs['subscriber_key'] .'&amp;rt='. (($mod==1) ? $opTempRs['subscriber_verify_key']:encr($opTempRs['subscriber_verify_key'])) .'">$2</a>',$mailBody);
			
			/* Send Mail */

			$this->sub_from_title = showIn($LETHE_ORG_SETS['set_org_sender_title'],'page');
			$this->sub_reply_mail = showIn($LETHE_ORG_SETS['set_org_reply_mail'],'page');
			$this->sysSubInit(); # Load Submission Settings Changed on v2.1 orgSubInit to sysSubInit
			$this->sub_mail_id = md5($opTempRs['subscriber_mail']);
			
			/* Design Receiver Data */
			$rcMail = $opTempRs['subscriber_mail'];
			$rcName = $opTempRs['subscriber_name'];
			$rcSubject = trim($mailTitle);
			$rcBody = $mailBody;
			$rcAltBody = '';
			$recData = array($rcMail=>array(
											'name'=>$rcName,
											'subject'=>$rcSubject,
											'body'=>$rcBody,
											'altbody'=>$rcAltBody,
											)						
							);
			$this->sub_mail_receiver = $recData;
			$this->letheSender();
			if($this->sub_success){
				/* Update Interval */
				$intDate = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s')."+2 minutes")); # Next submmission will execute 2 min later
				$myconn->query("UPDATE ". db_table_pref ."subscribers SET subscriber_verify_sent_interval='". $intDate ."' WHERE ID=". $this->SUBID ."") or die(mysqli_error($myconn));
				$opTemp->free();return true;
			}else{$opTemp->free();return false;}
			
		}
		$opTemp->free();
		return false;
	
	}
	
	/* Short Code Replacer */
	public function shortReplaces($datas=array()){

		global $myconn;
		global $LETHE_ORG_SETS;
		# This function only used for custom codes, system codes will used in newsletter sending actions
		# Datas can be used in array, each keys will return to replaced version like $short[0] - subject , $short[1] - body
		# Called data array keys must be defined for callbacks
		
		/* Load Dynamic Codes */
		$find = array();
		$replace = array();
		$orgName = $LETHE_ORG_SETS['set_org_name'];
		$opCodes = $myconn->query("SELECT 
											*
									 FROM 
											". db_table_pref ."short_codes
									WHERE 
											OID=". $this->OID ."
											
										") or die(mysqli_error($myconn));
		while($opCodesRs = $opCodes->fetch_assoc()){
			$find[] = '{'.$opCodesRs['code_key'].'}';
			$replace[] = $opCodesRs['code_val'] ;
		} $opCodes->free();
		
		# Special System Codes
		# Additional codes could be added here (Different date types etc.)
		$find[] = '{ORGANIZATION_NAME}';
		$find[] = '{CURR_DATE}';
		$find[] = '{CURR_MONTH}';
		$find[] = '{CURR_YEAR}';
		$find[] = '{LETHE_SAVE_TREE}';
		$replace[] = $orgName;
		$replace[] = date("d/m/Y");
		$replace[] = date("m");
		$replace[] = date("Y");
		$replace[] = lethe_save_tree;
		
		foreach($datas as $k=>$v){
			$datas[$k] = str_replace($find,$replace,$v);
		}
		return $datas;

	}
		
	/* E-Mail Sender */
	public function letheSender(){
	
		global $LETHE_MAIL_ENGINE;
		global $myconn;
	
		/* Load Engine */
		if($this->sub_success){
			include_once($LETHE_MAIL_ENGINE[$this->sub_mail_engine]['init']);
		}else{
			$this->sendPos = false;
			return false;
		}
	
	}
	
	/* System E-Mail Sender */
	public function sysSubInit(){
	
		global $myconn;
	
		
			/* Load System Submission Account */
			$opSysSub = $myconn->query("SELECT * FROM ". db_table_pref ."submission_accounts WHERE systemAcc=1") or die(mysqli_error($myconn));
			if(mysqli_num_rows($opSysSub)==0){
				die('Error: System Submission Account Cannot be Loaded!');
			}else{
				$opSysSubRs = $opSysSub->fetch_assoc();
				$this->sub_from_title = $opSysSubRs['from_title'];
				$this->sub_from_mail = $opSysSubRs['from_mail'];
				$this->sub_reply_mail = $opSysSubRs['reply_mail'];
				$this->sub_test_mail = $opSysSubRs['test_mail'];
				$this->sub_mail_type = $opSysSubRs['mail_type'];
				$this->sub_send_method = $opSysSubRs['send_method'];
				$this->sub_mail_engine = $opSysSubRs['mail_engine'];
				$this->sub_smtp_host = $opSysSubRs['smtp_host'];
				$this->sub_smtp_port = $opSysSubRs['smtp_port'];
				$this->sub_smtp_user = $opSysSubRs['smtp_user'];
				$this->sub_smtp_pass = $opSysSubRs['smtp_pass'];
				$this->sub_smtp_secure = $opSysSubRs['smtp_secure'];
				$this->sub_smtp_auth = $opSysSubRs['smtp_auth'];
				$this->sub_aws_access_key = $opSysSubRs['aws_access_key'];
				$this->sub_aws_secret_key = $opSysSubRs['aws_secret_key'];
				$this->sub_aws_region = $opSysSubRs['aws_region'];
				$this->sub_mandrill_user = $opSysSubRs['mandrill_user'];
				$this->sub_mandrill_key = $opSysSubRs['mandrill_key'];
				$this->sub_sendgrid_user = $opSysSubRs['sendgrid_user'];
				$this->sub_sendgrid_pass = $opSysSubRs['sendgrid_pass'];
				$this->sub_dkim_active = $opSysSubRs['dkim_active'];
				$this->sub_dkim_domain = $opSysSubRs['dkim_domain'];
				$this->sub_dkim_private = $opSysSubRs['dkim_private'];
				$this->sub_dkim_selector = $opSysSubRs['dkim_selector'];
				$this->sub_dkim_passphrase = $opSysSubRs['dkim_passphrase'];
				$this->sub_isDebug = $opSysSubRs['isDebug'];
				$this->OSMID = $opSysSubRs['ID'];
				
				/* Limit Check */
				if($opSysSubRs['daily_sent']>=$opSysSubRs['daily_limit']){
					$this->sendingErrors = letheglobal_sending_limit_exceeded;
					$this->sub_success = false;
				}
				
				//$this->letheSender();
				
			} $opSysSub->free();
		
	}
	
	/* System E-Mail Sender (Using PhpMail for non-configurated SMTP users) */
	# BE CAREFUL TO USE THAT
	# !!!! IF YOUR SYSTEM DOES NOT GIVE ACCESS TO USE PHP MAIL, IT WILL DOES NOT WORK !!!!!
	
	public function sysSubInitPMail(){
		
		global $db,$myconn;
		
		$opOrgData = $db->where('systemAcc=1')->getOne('submission_accounts');
				$this->sub_from_title = $opOrgData['from_title'];
				$this->sub_from_mail = $opOrgData['from_mail'];
				$this->sub_reply_mail = $opOrgData['reply_mail'];
				$this->sub_test_mail = $opOrgData['test_mail'];
				$this->sub_mail_type = $opOrgData['mail_type'];
				$this->sub_send_method = 1;
				$this->sub_mail_engine = $opOrgData['mail_engine'];
				$this->sub_isDebug = $opOrgData['isDebug'];
				$this->OSMID = $opOrgData['ID'];
		
		$this->letheSender();
		
	}
	
	/* Organization E-Mail Sender */
	public function orgSubInit(){
	
		global $myconn;
	
		
			/* Load System Submission Account */
			$opSysSub = $myconn->query("SELECT * FROM ". db_table_pref ."submission_accounts WHERE ID=". $this->OSMID ." AND isActive=1") or die(mysqli_error($myconn));
			if(mysqli_num_rows($opSysSub)==0){
				die('Error: Submission Account Cannot be Loaded!');
			}else{
				$opSysSubRs = $opSysSub->fetch_assoc();
				$this->sub_from_mail = $opSysSubRs['from_mail'];
				$this->sub_mail_type = $opSysSubRs['mail_type'];
				$this->sub_send_method = $opSysSubRs['send_method'];
				$this->sub_mail_engine = $opSysSubRs['mail_engine'];
				$this->sub_smtp_host = $opSysSubRs['smtp_host'];
				$this->sub_smtp_port = $opSysSubRs['smtp_port'];
				$this->sub_smtp_user = $opSysSubRs['smtp_user'];
				$this->sub_smtp_pass = $opSysSubRs['smtp_pass'];
				$this->sub_smtp_secure = $opSysSubRs['smtp_secure'];
				$this->sub_smtp_auth = $opSysSubRs['smtp_auth'];
				$this->sub_aws_access_key = $opSysSubRs['aws_access_key'];
				$this->sub_aws_secret_key = $opSysSubRs['aws_secret_key'];
				$this->sub_aws_region = $opSysSubRs['aws_region'];
				$this->sub_mandrill_user = $opSysSubRs['mandrill_user'];
				$this->sub_mandrill_key = $opSysSubRs['mandrill_key'];
				$this->sub_sendgrid_user = $opSysSubRs['sendgrid_user'];
				$this->sub_sendgrid_pass = $opSysSubRs['sendgrid_pass'];
				$this->sub_dkim_active = $opSysSubRs['dkim_active'];
				$this->sub_dkim_domain = $opSysSubRs['dkim_domain'];
				$this->sub_dkim_private = $opSysSubRs['dkim_private'];
				$this->sub_dkim_selector = $opSysSubRs['dkim_selector'];
				$this->sub_dkim_passphrase = $opSysSubRs['dkim_passphrase'];
				$this->sub_isDebug = $opSysSubRs['isDebug'];
				
				/* Limit Check */
				if($opSysSubRs['daily_sent']>=$opSysSubRs['daily_limit']){
					$this->sendingErrors = letheglobal_sending_limit_exceeded;
					$this->sub_success = false;
				}
				
			} $opSysSub->free();
		
	}
	
	/* Cron Command Builder */
	public function buildChronos(){
		$build = $this->chronosMin.' ';
		$build .= $this->chronosHour.' ';
		$build .= $this->chronosDay.' ';
		$build .= $this->chronosMonth.' ';
		$build .= $this->chronosWeek.' ';
		$build .= $this->chronosCommand.' ';
		$build .= $this->chronosURL;
		//$build .= '> /dev/null 2>&1';
		return $build;
	}
	
	/* Load Organization */
	public function loadOrg($o){
		
		global $orgSets;
		global $db;
		
		# Codecanyon Version Load Primary Organization
		$opOrg = $db->where('isPrimary=1')->getOne('organizations');
		
		if($db->count<1){
			# There no Organization Found!
			die('There no organization found! [Point: Org Set Loader]');
			return false;
		}
		
		# Load Main Settings
		foreach($opOrg as $k=>$v){
			$orgSets['set_'.$k] = $v;
		}
			$orgSets['set_org_name'] = $opOrg['orgName'];
			$orgSets['set_org_rss_url'] = $opOrg['rss_url'];
		
		# Dynamic Settings
		$opSets = $db->where('OID=?',array($opOrg['ID']))->get('organization_settings');
		foreach($opSets as $opSetsRs){
			$orgSets['set_'.$opSetsRs['set_key']] = $opSetsRs['set_val'];
		}
		
		/* Check Daily Limit */
		if($orgSets['set_org_max_daily_limit']!=0){
			if($orgSets['set_daily_sent']>=$orgSets['set_org_max_daily_limit']){return false;}
		}
		
		/* Submission Account */
		$OSMIDs = 0;
		$subAccs = explode(',',$orgSets['set_org_submission_account']);
		if(count($subAccs)<1){return false;}else{
			$OSMIDs = $subAccs[0];
		}
		
		/* Submission Settings */
		$opSubAcc = $db->where('ID=? AND isActive=1 AND daily_sent<=daily_limit',array($OSMIDs))->getOne('submission_accounts');
		if($db->count==0){return false;} # Submission Account Doesnt Meet Conditions
		$orgSets['set_send_per_conn'] = $opSubAcc['send_per_conn'];
		$orgSets['set_standby_time'] = $opSubAcc['standby_time'];
		@date_default_timezone_set($orgSets['set_org_timezone']); # Org Timezone
		return true;
		
	}
	
	/* Add to Report */
	public function addReport(){
		
		global $myconn;
		
		# Check Exists
		$chkRep = $myconn->prepare("SELECT * FROM ". db_table_pref ."reports WHERE OID=? AND pos=? AND email=? AND CID=?") or die(mysqli_error($myconn));
		$chkRep->bind_param('iisi',
									$this->OID,
									$this->reportPos,
									$this->reportMail,
									$this->reportCID
							);
		$chkRep->execute();
		$chkRep->store_result();
		if($chkRep->num_rows==0){ # Add New
			
			$addRep = $myconn->prepare("INSERT INTO 
														". db_table_pref ."reports
												SET
														OID=?,
														CID=?,
														pos=?,
														ipAddr=?,
														email=?,
														bounceType=?,
														extra_info=?
												") or die(mysqli_error($myconn));
			$addRep->bind_param('iiissss',
											$this->OID,
											$this->reportCID,
											$this->reportPos,
											$this->reportIP,
											$this->reportMail,
											$this->reportBounceType,
											$this->reportExtraInfo
									);
			$addRep->execute();
			$addRep->close();
			$chkRep->close();
			return true;
			
		}else{ # Update Hit
			
			$updST = new Statement_Result($chkRep);
			$chkRep->fetch();
			
			$this->reportExtraInfo = $updST->Get('extra_info') . $this->reportExtraInfo;
			$updRep = $myconn->prepare("UPDATE 
														". db_table_pref ."reports
												SET
														hit_cnt=hit_cnt+1, extra_info=?
												WHERE
														OID=? AND pos=? AND email=? AND CID=?
												") or die(mysqli_error($myconn));
			$updRep->bind_param('siisi',
										$this->reportExtraInfo,
										$this->OID,
										$this->reportPos,
										$this->reportMail,
										$this->reportCID
								);
			$updRep->execute();
			$updRep->close();
			$chkRep->close();
			return true;
			
		}
	
	
		
		
	}
	
	/* Bounce Action */
	private function bounceActs(){
		
		# 0 - Remove, 1 - Remove / Blacklist, 2 - Unsubscribe
		if($this->bounceAction==0){
			# Force Remove by Mail
			$this->removeSubscription($this->reportMail,false); # False Dont Remove Reports
			return true;
		}
		else if($this->bounceAction==1){
			# Add to Blacklist
			$_POST['new_rec_mail'] = $this->reportMail;
			$_POST['new_rec_ip'] = '0.0.0.0';
			$_POST['new_rec_reason'] = 1; # Bounce
			$this->addBlacklist();
			
			# Force Remove by Mail
			$this->removeSubscription($this->reportMail,false); # False Dont Remove Reports
			return true;
		}
		else if($this->bounceAction==2){
			# Move to Unsubscribe
			$this->getUnsubscribing($this->reportMail,$this->reportCID,2);
			return true;
		}
		else if($this->bounceAction==3){
			# No Action
			//$this->getUnsubscribing($this->reportMail,$this->reportCID,2);
			return true;
		}
		
		return false;
	}
	
	/* Bounce Handler */
	public function bounceHandle(){
		
		global $myconn;
		
		# Open Campaign
		if(!empty($this->bounceKey)){
			$campID = $this->bounceKey;
			
			$opCamp = $myconn->prepare("SELECT * FROM ". db_table_pref ."campaigns WHERE campaign_key=?") or die(mysqli_error($myconn));
			$opCamp->bind_param('s',$campID);
			if($opCamp->execute()){
				$opCamp->store_result();
				if($opCamp->num_rows!=0){
					$srArg = new Statement_Result($opCamp);
					$opCamp->fetch();
					$opCamp->close();
										
					# Add to Reports
					$this->reportCID = $srArg->Get('ID');
					$this->OID = $srArg->Get('OID');
					$this->reportPos = 2; # Bounce
					if($this->addReport()){
						
						# Apply Action
						if($this->bounceActs()){
							return true;
						}else{
							return false;
						}
						
					}else{
						return false;
					}
				}else{
					return false;
				}
			}else{
				return false;
			}
			
		}else{
			return false;
		}
		
		
	}
	
	
# Campaign Remover
public function removeCamp(){
	
	global $db;
	
	# $this->isCampID
	

		$db->where('OID=? AND CID=?',array($this->OID,$this->isCampID))->delete('tasks');
		$db->where('OID=? AND CID=?',array($this->OID,$this->isCampID))->delete('reports');
		$db->where('OID=? AND CID=?',array($this->OID,$this->isCampID))->delete('unsubscribes');
		$db->where('OID=? AND ID=?',array($this->OID,$this->isCampID))->delete('campaigns');
		$db->where('OID=? AND CID=?',array($this->OID,$this->isCampID))->delete('campaign_ar');
		$db->where('OID=? AND CID=?',array($this->OID,$this->isCampID))->delete('campaign_groups');
		$db->where('pos=1 AND OID=? AND CID=?',array($this->OID,$this->isCampID))->update('campaign_groups');
	
	
}

# Camp Resetter
public function resetCamp(){
	
	global $db;
	
	# $this->isCampID
	

		$db->where('OID=? AND CID=?',array($this->OID,$this->isCampID))->delete('tasks');
		$db->where('OID=? AND CID=?',array($this->OID,$this->isCampID))->delete('reports');
		$db->where('OID=? AND CID=?',array($this->OID,$this->isCampID))->delete('unsubscribes');
	
	
}

} # Lethe Class End

class Statement_Result
{
    private $_bindVarsArray = array();
    private $_results = array();

    public function __construct(&$stmt)
    {
        $meta = $stmt->result_metadata();

        while ($columnName = $meta->fetch_field())
            $this->_bindVarsArray[] = &$this->_results[$columnName->name];

        call_user_func_array(array($stmt, 'bind_result'), $this->_bindVarsArray);
       
        $meta->close();
    }
   
    public function Get_Array()
    {
        return $this->_results;   
    }
   
    public function Get($column_name)
    {
        return $this->_results[$column_name];
    }
} 
?>