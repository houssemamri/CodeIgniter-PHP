<?php 
# +------------------------------------------------------------------------+
# | Artlantis CMS Solutions                                                |
# +------------------------------------------------------------------------+
# | Lethe Newsletter & Mailing System                                      |
# | Copyright (c) Artlantis Design Studio 2014. All rights reserved.       |
# | Version       2.0                                                      |
# | Last modified 01.01.2015                                               |
# | Email         developer@artlantis.net                                  |
# | Web           http://www.artlantis.net                                 |
# +------------------------------------------------------------------------+
if(!isset($pgnt)){die('You are not authorized to view this page!');}

/* Demo Check */
if(!isDemo('saveSets')){$errText = errMod(letheglobal_demo_mode_active,'danger');}
$oup = new sessionMaster();

# Load Org Sets
$orgSets = array();
$getOrg = $db->where('isPrimary=1')->getOne('organizations');
$orgSets['orgName'] = $getOrg['orgName'];
$orgSets['private_key'] = $getOrg['private_key'];
$orgSets['public_key'] = $getOrg['public_key'];
$orgSets['api_key'] = $getOrg['api_key'];
$orgSets['rss_url'] = $getOrg['rss_url'];

/* Save Settings */
if(isset($_POST['saveSets'])){
	
	$letheSets = new lethe();
	$letheSets->letheSettings();
	$letheSets->OID = $getOrg['ID'];
	$letheSets->editOrganization();
	$errText = $letheSets->errPrint;
	
	$oup->sesName = 'errPrint';
	$oup->sesVal = $errText;
	$oup->sessMaster();
}

if(isset($_COOKIE['errPrint'])){
	echo($_COOKIE['errPrint']);
	$oup->sesList = "errPrint";
	$oup->sessDestroy();
}
?>

<form name="genSets" id="genSets" action="" method="POST">
<div role="tabpanel">

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab"><?php echo(letheglobal_general_settings);?></a></li>
    <li role="presentation"><a href="#helpers" aria-controls="helpers" role="tab" data-toggle="tab"><?php echo(settings_helpers);?></a></li>
	<li role="presentation"><a href="#org" aria-controls="org" role="tab" data-toggle="tab"><?php echo(organizations_organization);?></a></li>
	<li role="presentation"><a href="#cron" aria-controls="cron" role="tab" data-toggle="tab">Cron</a></li>
    <li role="presentation"><a href="#save" aria-controls="save" role="tab" data-toggle="tab"><?php echo(letheglobal_save);?></a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
	<!-- GENERAL -->
    <div role="tabpanel" class="tab-pane fade in active" id="general">
		&nbsp;
			<div class="form-group">
				<label for="lethe_default_lang"><?php echo(sh('ZlPryzmM0A').settings_default_language);?></label>
				<select name="lethe_default_lang" id="lethe_default_lang" class="form-control autoWidth">
					<?php foreach($SLNG_LIST as $k=>$v){
						echo('<option value="'. $k .'"'. formSelector($k,lethe_default_lang,0) .'>'. showIn($v['sname'],'page') .'</option>');
					}?>
				</select>
			</div>
			<div class="form-group">
				<label for="lethe_default_timezone"><?php echo(sh('Y3lrxevM75').settings_default_timezone);?></label>
				<select name="lethe_default_timezone" id="lethe_default_timezone" class="form-control autoWidth">
					<?php 
					$tzones = timezone_list();
					foreach($tzones as $k=>$v){echo('<option value="'. $k .'"'. formSelector($k,lethe_default_timezone,0) .'>'. showIn($v,'page') .'</option>');}?>
				</select>
			</div>
			<div class="form-group">
				<label for="lethe_theme"><?php echo(sh('1vngRNdgmk').settings_default_theme);?></label>
				<select name="lethe_theme" id="lethe_theme" class="form-control autoWidth">
					<?php 
					foreach($LETHE_THEME_LIST as $k=>$v){echo('<option value="'. $k .'"'. formSelector(lethe_theme,$k,0) .'>'. $v .'</option>');}?>
				</select>
			</div>
			<div class="form-group">
				<label for="lethe_root_url"><?php echo(sh('pX6gY14gOl'));?>Lethe URL</label>
				<input type="url" value="<?php echo(showIn(lethe_root_url,'input'));?>" name="lethe_root_url" id="lethe_root_url" class="form-control autoWidth" size="50" placeholder="http://www.example.com/lethe/">
				<span class="help-block"><small><?php echo(settings_change_if_its_incorrect);?> e.g. http://www.example.com/lethe/</small></span>
			</div>
			<div class="form-group">
				<label for="lethe_admin_url"><?php echo(sh('GAYM2EmrXQ'));?>Lethe Admin URL</label>
				<input type="url" name="lethe_admin_url" id="lethe_admin_url" value="<?php echo(showIn(lethe_admin_url,'input'));?>" class="form-control autoWidth" size="50" placeholder="http://www.example.com/lethe/admin/">
				<span class="help-block"><small><?php echo(settings_change_if_its_incorrect);?> e.g. http://www.example.com/lethe/admin/</small></span>
			</div>
			<div class="form-group">
				<label for="lethe_save_tree_on"><?php echo(sh('maz8jKjgpO').settings_save_tree_on);?></label>
				<div>
				<input type="checkbox" name="lethe_save_tree_on" id="lethe_save_tree_on" data-on-label="<?php echo(letheglobal_yes);?>" data-off-label="<?php echo(letheglobal_no);?>" value="YES" class="letheSwitch"<?php echo(formSelector(lethe_save_tree_on,1,1));?>>
				</div>
			</div>
			<div class="form-group">
				<label for="lethe_save_tree_text"><?php echo(sh('6mxg6vGg4n').settings_save_tree_text);?></label>
				<textarea name="lethe_save_tree_text" id="lethe_save_tree_text" class="form-control autoWidth"><?php echo(showIn(lethe_save_tree,'page'));?></textarea>
			</div>
			<div class="form-group">
				<label for="lethe_google_recaptcha_public"><?php echo(sh('KX1M7K1MmV').'Google reCaptcha '.settings_public_key);?></label>
				<input type="text" name="lethe_google_recaptcha_public" id="lethe_google_recaptcha_public" value="<?php echo(((DEMO_MODE) ? 'DEMO MODE':showIn(lethe_google_recaptcha_public,'input')));?>" class="form-control autoWidth" size="50">
			</div>
			<div class="form-group">
				<label for="lethe_google_recaptcha_private"><?php echo(sh('KX1M7K1MmV').'Google reCaptcha '.settings_private_key);?></label>
				<input type="text" name="lethe_google_recaptcha_private" id="lethe_google_recaptcha_private" value="<?php echo(((DEMO_MODE) ? 'DEMO MODE':showIn(lethe_google_recaptcha_private,'input')));?>" class="form-control autoWidth" size="50">
			</div>
			<div class="form-group">
				<label for="lethe_license_key"><?php echo(sh('VPGMkzEra7').settings_license_key);?></label>
				<input type="text" name="lethe_license_key" id="lethe_license_key" value="<?php echo(((DEMO_MODE) ? 'DEMO MODE':showIn(lethe_license_key,'input')));?>" class="form-control autoWidth" size="50">
			</div>
	</div>
	<!-- HELPERS -->
    <div role="tabpanel" class="tab-pane fade" id="helpers">
	&nbsp;
			<div class="form-group">
				<label for="lethe_debug_mode"><?php echo(sh('ZVKMZNoMLA').settings_debug_mode);?></label>
				<div>
				<input type="checkbox" name="lethe_debug_mode" id="lethe_debug_mode" data-on-label="<?php echo(letheglobal_yes);?>" data-off-label="<?php echo(letheglobal_no);?>" value="YES" class="letheSwitch"<?php echo(formSelector(lethe_debug_mode,1,1));?>>
				</div>
			</div>
			<div class="form-group">
				<label for="lethe_system_notices"><?php echo(sh('2WzrLvx8m4').settings_system_notices);?></label>
				<div>
				<input type="checkbox" name="lethe_system_notices" id="lethe_system_notices" data-on-label="<?php echo(letheglobal_yes);?>" data-off-label="<?php echo(letheglobal_no);?>" value="YES" class="letheSwitch"<?php echo(formSelector(lethe_system_notices,1,1));?>>
				</div>
			</div>
			<div class="form-group">
				<label for="lethe_sidera_helper"><?php echo(sh('PzWM4K4rqx'));?>Pointips</label>
				<div>
				<input type="checkbox" name="lethe_sidera_helper" id="lethe_sidera_helper" data-on-label="<?php echo(letheglobal_yes);?>" data-off-label="<?php echo(letheglobal_no);?>" value="YES" class="letheSwitch"<?php echo(formSelector(lethe_sidera_helper,1,1));?>>
				</div>
			</div>
	</div>
	<!-- ORG -->
    <div role="tabpanel" class="tab-pane fade" id="org">
	&nbsp;
			<div class="form-group">
				<label for="org_name"><?php echo(sh('G4e9iXSAzy').organizations_organization_name);?></label>
				<input type="text" class="form-control autoWidth" id="org_name" name="org_name" size="40" value="<?php echo(showIn($orgSets['orgName'],'input'));?>">
			</div>
			<div class="form-group">
				<label for="org_private_key"><?php echo(sh('BPVgomvMpO').organizations_private_key);?></label>
				<input onclick="this.select();" type="text" class="form-control autoWidth" id="org_private_key" name="org_private_key" size="40" value="<?php echo(showIn($orgSets['private_key'],'input'));?>" readonly>
			</div>
			<div class="form-group">
				<label for="org_public_key"><?php echo(sh('G4Pr97e8yp').organizations_public_key);?></label>
				<input onclick="this.select();" type="text" class="form-control autoWidth" id="org_public_key" name="org_public_key" size="40" value="<?php echo(showIn($orgSets['public_key'],'input'));?>" readonly>
			</div>
			<div class="form-group">
				<label for="org_api_key"><?php echo(sh('5bBgbbOgEa').organizations_api_key);?></label>
				<input onclick="this.select();" type="text" class="form-control autoWidth" id="org_api_key" name="org_api_key" size="40" value="<?php echo(showIn($orgSets['api_key'],'input'));?>" readonly>
			</div>
			<div class="form-group">
				<label for="org_rss_url"><?php echo(sh('bByrWnKg9L'));?>RSS</label>
				<input onclick="this.select();" type="text" class="form-control autoWidth" id="org_rss_url" name="org_rss_url" size="40" value="<?php echo(showIn($orgSets['rss_url'],'input'));?>">
				<span class="help-block txxs"><strong>Default:</strong> <?php echo(lethe_root_url.'lethe.newsletter.php?pos=rss&amp;oid='.$orgSets['public_key']);?></span>
			</div>
			<!-- SUBMISSION ACCOUNTS -->
			<?php 
				$saccs = $db->where('isActive=1')->get('submission_accounts');
				foreach($saccs as $sacc){
					echo('<input type="hidden" name="org_submission_account[]" id="org_submission_account" value="'. $sacc['ID'] .'">');
				}
			?>
			
			<div class="form-group">
				<label for="org_sender_title"><?php echo(sh('uWlPzwExES').organizations_sender_title);?></label>
				<input type="text" class="form-control autoWidth" id="org_sender_title" name="org_sender_title" value="<?php echo((defined('set_org_sender_title')) ? showIn(set_org_sender_title,'input'):'');?>">
			</div>
			
			<div class="form-group">
				<label for="org_reply_mail"><?php echo(sh('zIo5YkkltJ').organizations_reply_e_mail);?></label>
				<input type="email" class="form-control autoWidth" id="org_reply_mail" name="org_reply_mail" value="<?php echo((defined('set_org_reply_mail')) ? showIn(set_org_reply_mail,'input'):'');?>">
			</div>
			
			<div class="form-group">
				<label for="org_test_mail"><?php echo(sh('bcWtR8fOlU').organizations_test_e_mail);?></label>
				<input type="email" class="form-control autoWidth" id="org_test_mail" name="org_test_mail" value="<?php echo((defined('set_org_test_mail')) ? showIn(set_org_test_mail,'input'):'');?>">
			</div>
						
			<div class="form-group">
				<label for="org_after_unsubscribe"><?php echo(sh('9AD1ki4Cyo').organizations_after_unsubscribe);?></label>
				<select name="org_after_unsubscribe" id="org_after_unsubscribe" class="form-control autoWidth">
					<?php 
					foreach($LETHE_AFTER_UNSUBSCRIBE as $k=>$v){
						echo('<option value="'. $k .'"'. ((defined('set_org_after_unsubscribe')) ? formSelector(set_org_after_unsubscribe,$k,0):'') .'>'. $v .'</option>');
					}
					?>
				</select>
			</div>
			
			<div class="form-group">
				<label for="org_verification"><?php echo(sh('lTvpd5ypqz').organizations_verification);?></label>
				<select name="org_verification" id="org_verification" class="form-control autoWidth">
					<?php 
					foreach($LETHE_VERIFICATION_TYPE as $k=>$v){
						echo('<option value="'. $k .'"'. ((defined('set_org_verification')) ? formSelector(set_org_verification,$k,0):'') .'>'. $v .'</option>');
					}
					?>
				</select>
			</div>
			
			<div class="form-group">
				<label for="org_random_load"><?php echo(sh('NnedVTtSjA').organizations_random_loader);?></label>
				<div>
				<input type="checkbox" name="org_random_load" id="org_random_load" data-on-label="<?php echo(letheglobal_yes);?>" data-off-label="<?php echo(letheglobal_no);?>" value="YES" class="letheSwitch"<?php echo(((defined('set_org_random_load') && set_org_random_load==1) ? ' checked':''));?>>
				</div>
			</div>
			
			<div class="form-group">
				<label for="org_load_type"><?php echo(sh('07NRNro5bL').organizations_load);?></label>
				<select name="org_load_type" id="org_load_type" class="form-control autoWidth">
					<?php 
					foreach($LETHE_LOAD_TYPES as $k=>$v){
						echo('<option value="'. $k .'"'. ((defined('set_org_load_type')) ? formSelector(set_org_load_type,$k,0):'') .'>'. $v .'</option>');
					}
					?>
				</select>
			</div>
	</div>
		<!-- LIMITS -->
		<div role="tabpanel" class="tab-pane fade" id="limits">
			&nbsp;
			<div class="form-group">
				<label for="org_max_disk_quota"><?php echo(sh('sOMxavMns9').organizations_maximum_disk_quota);?></label>
				<?php if(LETHE_AUTH_MODE==2 && PRO_MODE){?>
				<select id="org_max_disk_quota" name="org_max_disk_quota" class="form-control autoWidth">
					<?php 
					foreach($LETHE_ORG_DISK_QUOTA_LIST as $k=>$v){
						echo('<option value="'. $v .'"'. formSelector($v,set_org_max_disk_quota,0) .'>'. (($v==0) ? letheglobal_unlimited:formatBytes($v,0,0)) .'</option>');
					}
					?>
				</select>
				<?php }else{
					echo('<div class="row"><div class="col-md-3">'. getMyLimits(0,0) .'</div></div>');
				}?>
			</div>
			<div class="form-group">
				<label for="org_max_user"><?php echo(sh('Ui5lTJHQkK').organizations_maximum_user);?></label>
				<?php if(LETHE_AUTH_MODE==2 && PRO_MODE){?>
				<input type="number" onkeydown="validateNumber(event);" class="form-control autoWidth" id="org_max_user" name="org_max_user" value="<?php echo((defined('set_org_max_user')) ? showIn(set_org_max_user,'input'):'');?>" size="5">
				<span class="help-block">0 = <?php echo(letheglobal_unlimited);?></span>
				<?php }else{
					echo('<div class="row"><div class="col-md-3">'. getMyLimits(calcSource(set_org_id,'users'),set_org_max_user) .'</div></div>');
				}?>
			</div>
			<div class="form-group">
				<label for="org_max_newsletter"><?php echo(sh('71oZLhC3cV').organizations_maximum_newsletter);?></label>
				<?php if(LETHE_AUTH_MODE==2 && PRO_MODE){?>
				<input type="number" onkeydown="validateNumber(event);" class="form-control autoWidth" id="org_max_newsletter" name="org_max_newsletter" value="<?php echo((defined('set_org_max_newsletter')) ? showIn(set_org_max_newsletter,'input'):'');?>" size="5">
				<span class="help-block">0 = <?php echo(letheglobal_unlimited);?></span>
				<?php }else{
					echo('<div class="row"><div class="col-md-3">'. getMyLimits(calcSource(set_org_id,'newsletters'),set_org_max_newsletter) .'</div></div>');
				}?>
			</div>
			<div class="form-group">
				<label for="org_max_autoresponder"><?php echo(sh('jLXNE56gUg').organizations_maximum_autoresponder);?></label>
				<?php if(LETHE_AUTH_MODE==2 && PRO_MODE){?>
				<input type="number" onkeydown="validateNumber(event);" class="form-control autoWidth" id="org_max_autoresponder" name="org_max_autoresponder" value="<?php echo((defined('set_org_max_autoresponder')) ? showIn(set_org_max_autoresponder,'input'):'');?>" size="5">
				<span class="help-block">0 = <?php echo(letheglobal_unlimited);?></span>
				<?php }else{
					echo('<div class="row"><div class="col-md-3">'. getMyLimits(calcSource(set_org_id,'autoresponder'),set_org_max_autoresponder) .'</div></div>');
				}?>
			</div>
			<div class="form-group">
				<label for="org_max_subscriber"><?php echo(sh('LfGB6T1JMr').organizations_maximum_subscriber);?></label>
				<?php if(LETHE_AUTH_MODE==2 && PRO_MODE){?>
				<input type="number" onkeydown="validateNumber(event);" class="form-control autoWidth" id="org_max_subscriber" name="org_max_subscriber" value="<?php echo((defined('set_org_max_subscriber')) ? showIn(set_org_max_subscriber,'input'):'');?>" size="5">
				<span class="help-block">0 = <?php echo(letheglobal_unlimited);?></span>
				<?php }else{
					echo('<div class="row"><div class="col-md-3">'. getMyLimits(calcSource(set_org_id,'subscribers'),set_org_max_subscriber) .'</div></div>');
				}?>
			</div>
			<div class="form-group">
				<label for="org_max_subscriber_group"><?php echo(sh('xyyyyqvwF2').organizations_maximum_subscriber_group);?></label>
				<?php if(LETHE_AUTH_MODE==2 && PRO_MODE){?>
				<input type="number" onkeydown="validateNumber(event);" class="form-control autoWidth" id="org_max_subscriber_group" name="org_max_subscriber_group" value="<?php echo((defined('set_org_max_subscriber_group')) ? showIn(set_org_max_subscriber_group,'input'):'');?>" size="5">
				<span class="help-block">0 = <?php echo(letheglobal_unlimited);?></span>
				<?php }else{
					echo('<div class="row"><div class="col-md-3">'. getMyLimits(calcSource(set_org_id,'subscriber.groups'),set_org_max_subscriber_group) .'</div></div>');
				}?>
			</div>
			<div class="form-group">
				<label for="org_max_subscribe_form"><?php echo(sh('aIhmrEqZ7D').organizations_maximum_subscribe_form);?></label>
				<?php if(LETHE_AUTH_MODE==2 && PRO_MODE){?>
				<input type="number" onkeydown="validateNumber(event);" class="form-control autoWidth" id="org_max_subscribe_form" name="org_max_subscribe_form" value="<?php echo((defined('set_org_max_subscribe_form')) ? showIn(set_org_max_subscribe_form,'input'):'');?>" size="5">
				<span class="help-block">0 = <?php echo(letheglobal_unlimited);?></span>
				<?php }else{
					echo('<div class="row"><div class="col-md-3">'. getMyLimits(calcSource(set_org_id,'subscriber.forms'),set_org_max_subscribe_form) .'</div></div>');
				}?>
			</div>
			<div class="form-group">
				<label for="org_max_blacklist"><?php echo(sh('CcQajclBzO').organizations_maximum_blacklist);?></label>
				<?php if(LETHE_AUTH_MODE==2 && PRO_MODE){?>
				<input type="number" onkeydown="validateNumber(event);" class="form-control autoWidth" id="org_max_blacklist" name="org_max_blacklist" value="<?php echo((defined('set_org_max_blacklist')) ? showIn(set_org_max_blacklist,'input'):'');?>" size="5">
				<span class="help-block">0 = <?php echo(letheglobal_unlimited);?></span>
				<?php }else{
					echo('<div class="row"><div class="col-md-3">'. getMyLimits(calcSource(set_org_id,'subscriber.blacklist'),set_org_max_blacklist) .'</div></div>');
				}?>
			</div>
			<div class="form-group">
				<label for="org_max_template"><?php echo(sh('ow9Oc0forZ').organizations_maximum_template);?></label>
				<?php if(LETHE_AUTH_MODE==2 && PRO_MODE){?>
				<input type="number" onkeydown="validateNumber(event);" class="form-control autoWidth" id="org_max_template" name="org_max_template" value="<?php echo((defined('set_org_max_template')) ? showIn(set_org_max_template,'input'):'');?>" size="5">
				<span class="help-block">0 = <?php echo(letheglobal_unlimited);?></span>
				<?php }else{
					echo('<div class="row"><div class="col-md-3">'. getMyLimits(calcSource(set_org_id,'templates'),set_org_max_template) .'</div></div>');
				}?>
			</div>
			<div class="form-group">
				<label for="org_max_shortcode"><?php echo(sh('RFsCUOaRjk').organizations_maximum_short_code);?></label>
				<?php if(LETHE_AUTH_MODE==2 && PRO_MODE){?>
				<input type="number" onkeydown="validateNumber(event);" class="form-control autoWidth" id="org_max_shortcode" name="org_max_shortcode" value="<?php echo((defined('set_org_max_shortcode')) ? showIn(set_org_max_shortcode,'input'):'');?>" size="5">
				<span class="help-block">0 = <?php echo(letheglobal_unlimited);?></span>
				<?php }else{
					echo('<div class="row"><div class="col-md-3">'. getMyLimits(calcSource(set_org_id,'shortcode'),set_org_max_shortcode) .'</div></div>');
				}?>
			</div>
			<div class="form-group">
				<label for="org_max_daily_limit"><?php echo(sh('3Zb0MmV4bv').organizations_daily_send_limit);?></label>
				<?php if(LETHE_AUTH_MODE==2 && PRO_MODE){?>
				<input type="number" onkeydown="validateNumber(event);" class="form-control autoWidth" id="org_max_daily_limit" name="org_max_daily_limit" value="<?php echo((defined('set_org_max_daily_limit')) ? showIn(set_org_max_daily_limit,'input'):'');?>" size="5">
				<span class="help-block">0 = <?php echo(letheglobal_unlimited);?></span>
				<?php }else{
					echo('<div class="row"><div class="col-md-3">'. getMyLimits($sr->Get('daily_sent'),set_org_max_daily_limit) .'</div></div>');
				}?>
			</div>
			<div class="form-group">
				<label for="org_standby_organization"><?php echo(sh('ftJoFAPhU6').organizations_standby_between_organizations.' ('. letheglobal_minute .')');?></label>
				<?php if(LETHE_AUTH_MODE==2 && PRO_MODE){?>
				<input type="number" onkeydown="validateNumber(event);" class="form-control autoWidth" id="org_standby_organization" name="org_standby_organization" value="<?php echo((defined('set_org_standby_organization')) ? showIn(set_org_standby_organization,'input'):'');?>" size="5">
				<span class="help-block">0 = <?php echo(letheglobal_unlimited);?></span>
				<?php }else{
					echo('<div class="row"><div class="col-md-3"><span class="label label-warning">'. set_org_standby_organization.' '. letheglobal_minute .'</span></div></div>');
				}?>
			</div>
		</div>
	<!-- CRON -->
    <div role="tabpanel" class="tab-pane fade" id="cron">
	&nbsp;
	

	
		<div class="form-group">
			<label for="set_shell_cron_command"><?php echo(sh('41PgQ6Grna').settings_cron_command);?></label>
			<select name="set_shell_cron_command" id="set_shell_cron_command" class="form-control autoWidth">
				<?php 
					foreach($LETHE_SHELL_CRON_COMM as $val){
						echo('<option value="'. $val .'"'. formSelector(set_shell_cron_command,$val,0) .'>'. $val .'</option>');
					}
				?>
			</select>
		</div>
		
		<div class="form-group">
			<label for="set_min_cron"><?php echo(sh('G4Pr90kgyp').settings_minimum_cron_time.'('.letheglobal_minute.')');?></label>
			<select name="set_min_cron" id="set_min_cron" class="form-control autoWidth">
				<?php 
					foreach($LETHE_SHELL_CRON_PER as $val=>$lab){
						echo('<option value="'. $val .'"'. formSelector(set_min_cron,$val,0) .'>'. $lab .'</option>');
					}
				?>
			</select>
		</div>
	
		<div class="form-group">
			<label for="set_shell"><?php echo(sh('zb3rO2GgAQ').'shell_exec');?></label>
			<div>
				<input type="checkbox" id="set_shell" name="set_shell" value="YES" data-on-label="<?php echo(letheglobal_yes);?>" data-off-label="<?php echo(letheglobal_no);?>" class="letheSwitch"<?php echo(formSelector(set_shell,1,1));?>>
			</div>
		</div>
	
		<!-- SHELL -->
		<div class="shell_mode well" data-shell="on">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="set_shell_type"><?php echo(sh('xVYMGmwgoO').settings_exec_type);?></label>
						<select name="" id="" class="form-control autoWidth">
							<option value="0"<?php echo(formSelector(set_shell_type,0,0));?>>shell_exec</option>
							<option value="1"<?php echo(formSelector(set_shell_type,1,0));?>>exec</option>
						</select>
					</div>
					<div class="form-group">
						<label for="set_shell_command"><?php echo(sh('BPVgonn8pO').settings_shell_command);?></label>
						<select name="set_shell_command" id="set_shell_command" class="form-control autoWidth">
							<?php 
								foreach($LETHE_SHELL_CRON as $val){
									echo('<option value="'. $val .'"'. formSelector(set_shell_command,$val,0) .'>'. $val .'</option>');
								}
							?>
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="row">
						<div class="col-md-4">
							<button type="button" id="shellTest" class="btn btn-warning">TEST</button><br>
						</div>
						<div class="col-md-8">
							<div id="shell_result"></div>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- NON-SHELL -->
		<div class="shell_mode alert alert-warning" data-shell="off">
			<div class="form-group">
				<label for="set_main_cron"><?php echo(sh('5bBgb3GrEa').settings_main_cron_file);?></label>
				<input type="text" name="set_main_cron" id="set_main_cron" value="" readonly class="form-control">
			</div>
			<div class="form-group">
				<label for="set_task_cron"><?php echo(sh('VPGMknXra7').settings_task_cron_file);?></label>
				<input type="text" name="set_task_cron" id="set_task_cron" value="" readonly class="form-control">
			</div>
			<div class="form-group">
				<label for="set_ar_task_cron"><?php echo(sh('EyvMNYNrd9').settings_autoresponder_task_cron_file);?></label>
				<input type="text" name="set_ar_task_cron" id="set_ar_task_cron" value="" readonly class="form-control">
			</div>
			<div class="form-group">
				<label for="set_bounce_cron"><?php echo(sh('WlVgw4nrR0').settings_bounce_cron_file);?></label>
				<input type="text" name="set_bounce_cron" id="set_bounce_cron" value="" readonly class="form-control">
			</div>
		</div>
		
		<script>
			/* Cron Command Changer */
			function cronChng(){
				var siteURI = '<?php echo(lethe_root_url);?>chronos/';
				var newCroner = "[PER] * * * * [COM] '"+siteURI+"[FILE]'  > /dev/null 2>&1";
				newCroner = newCroner.replace('[PER]',$("#set_min_cron").find('option:selected').val());
				newCroner = newCroner.replace('[COM]',$("#set_shell_cron_command").find('option:selected').val());
				
				$("#set_main_cron").val(newCroner.replace('[FILE]','lethe.php'));
				$("#set_task_cron").val(newCroner.replace('[FILE]','lethe.tasks.single.php'));
				$("#set_ar_task_cron").val(newCroner.replace('[FILE]','lethe.tasks.ar.single.php'));
				$("#set_bounce_cron").val(newCroner.replace('[FILE]','lethe.bounce.single.php'));
			}
		
			$(document).ready(function(){
								
				// Shell Tester
				$("#shellTest").click(function(){
					getAjax('#shell_result','act.xmlhttp.php?pos=shelltest&getdata='+$("#set_shell_command").find('option:selected').val()+'&exctyp='+$("#set_shell_type").find('option:selected').val(),'<span class="spin glyphicon glyphicon-refresh"></span>');
				});
				
				$(".shell_mode[data-shell=off]").hide();
				$("#set_shell").change(function(e){
					if($(this).is(':checked')){
						$(".shell_mode[data-shell=off]").hide();
						$(".shell_mode[data-shell=on]").show();
					}else{
						$(".shell_mode[data-shell=on]").hide();
						$(".shell_mode[data-shell=off]").show();						
					}
				});
				
				$("#set_shell_cron_command").change(function(){cronChng();});
				$("#set_min_cron").change(function(){cronChng();});
				
				cronChng();
			});
		</script>
		

		
	</div>
		<div role="tabpanel" class="tab-pane fade" id="save">
	&nbsp;
	<div class="form-group">
		<button type="submit" name="saveSets" id="saveSets" class="btn btn-primary"><?php echo(letheglobal_save);?></button>
	</div>
	</div>
  </div>

</div>
</form>

<script type="text/javascript">
	$(document).ready(function(){
		/* Change Theme */
		$("#lethe_theme").on('change',function(){
			var selTheme = $(this).val();
			  $(".getTheme").html('<link type="text/css" rel="stylesheet" href="bootstrap/dist/css/'+ selTheme +'_bootstrap.min.css"></link>');
		});
	});
</script>
