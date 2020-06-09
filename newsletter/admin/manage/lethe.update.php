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
if(DEMO_MODE){
	echo(errMod(letheglobal_demo_mode_active,'danger'));
}else{
if(!isset($pgnt)){die('You are not authorized to view this page!');}
if(!isDemo('addUser,editUser')){$errText = errMod(letheglobal_demo_mode_active,'danger');}
$ID = ((!isset($_GET['ID']) || intval($_GET['ID'])==0) ? 0:intval($_GET['ID']));
$run = ((!isset($_GET['run']) || intval($_GET['run'])==0) ? 0:intval($_GET['run']));
$lv = ((!isset($_GET['lv']) || empty($_GET['lv'])) ? '':trim($_GET['lv']));
# Load Upgrades
$output = array();
$upgList = get_web_page('http://www.newslether.com/resources/feeds/lethe.upgrader.php?key='.lethe_license_key);

if($upgList['errno']!=0){
	$output[] = '<div class="text-danger">Upgrade Datas Could Not be Downloaded</div>';
}else{
	$upgRes = json_decode($upgList['content'],true);
			if($upgRes['err']!='ALLOW'){
				if($upgRes['err']=='INVALID_LICENSE'){$output[] = '<div class="text-danger">Invalid License</div>';}
			}else{
				# LOAD
				
				$upgRes['pgData'] = str_replace('[TABLE_PREF]',db_table_pref,$upgRes['pgData']);
				$json = json_decode($upgRes['pgData'],true);
				if($run==1){
					
					
					foreach($json as $k=>$v){
						
						if($k==$lv){
						####
						
						# Print Update Info
						$output[] = '<h2>'. $v['info'] .'</h2><hr>';
						
						# Print Parts
						foreach($v['parts'] as $pk=>$pv){
							$output[] = '<h3>'. $pv['title'] .'</h3><hr>';
							
							# Print Commands
							foreach($pv['commands'] as $ck=>$cv){
								if($myconn->query(mysql_prep($cv['com']))){
									$output[] = '<div class="text-success">'. $cv['succ'] .'</div>';
								}else{
									$output[] = '<div class="text-danger">'. $cv['err'] .' <small class="text-muted">('. mysqli_error($myconn) .')</small></div>';
								}
							}
						}
						
						####
						}
					}
				}else{
					foreach($json as $k=>$v){
						$output[] = '<a href="?p=settings/update&amp;run=1&amp;lv='. $k .'">'. $json[$k]['info'] .'</a>';
					}
				}
				# LOAD
				
			}
}
echo implode('<br>',$output) .'</div>';
}
?>