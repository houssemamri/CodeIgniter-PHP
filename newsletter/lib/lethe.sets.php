<?php
/*  +------------------------------------------------------------------------+ */
/*  | Artlantis CMS Solutions                                                | */
/*  +------------------------------------------------------------------------+ */
/*  | Lethe Newsletter & Mailing System                                      | */
/*  | Copyright (c) Artlantis Design Studio 2014. All rights reserved.       | */
/*  | Version       2.0                                                      | */
/*  | Last modified 07.06.2018                                               | */
/*  | Email         developer@artlantis.net                                  | */
/*  | Web           http://www.artlantis.net                                 | */
/*  +------------------------------------------------------------------------+ */

# General Settings
$LETHE_SETS['lethe_default_lang'] = 'en';
$LETHE_SETS['lethe_default_timezone'] = 'Pacific/Midway';
$LETHE_SETS['lethe_root_url'] = 'http://review-thunder.com/newsletter/';
$LETHE_SETS['lethe_admin_url'] = 'http://review-thunder.com/newsletter/admin/';
$LETHE_SETS['lethe_debug_mode'] = 0;
$LETHE_SETS['lethe_system_notices'] = 1;
$LETHE_SETS['lethe_sidera_helper'] = 1;
$LETHE_SETS['lethe_theme'] = 'lumen';
$LETHE_SETS['lethe_google_recaptcha_public'] = 'RECAPTCHA_PUBLIC_KEY';
$LETHE_SETS['lethe_google_recaptcha_private'] = 'RECAPTCHA_PRIVATE_KEY';
$LETHE_SETS['lethe_powered_text'] ='PHA+PHNtYWxsPkxldGhlIE5ld3NsZXR0ZXIgJmFtcDsgTWFpbGluZyBTeXN0ZW0gdjIuMCAmY29weTsgMjAxODwvc21hbGw+PC9wPjxwPjxzbWFsbD5BcnRsYW50aXMgRGVzaWduIFN0dWRpbyA8YSBocmVmPSJodHRwOi8vd3d3LmFydGxhbnRpcy5uZXQvIiB0YXJnZXQ9Il9ibGFuayI+aHR0cDovL3d3dy5hcnRsYW50aXMubmV0LzwvYT48L3A+PHA+TGV0aGUgTWFpbGluZyBTeXN0ZW0gPGEgaHJlZj0iaHR0cDovL3d3dy5uZXdzbGV0aGVyLmNvbS8iIHRhcmdldD0iX2JsYW5rIj5odHRwOi8vd3d3Lm5ld3NsZXRoZXIuY29tLzwvYT48L3NtYWxsPjwvcD4=';
$LETHE_SETS['lethe_save_tree'] ='<img alt="" src="http://review-thunder.com/newsletter/resources/system/savepaper.png" style="float:left; height:50px; margin:0px 10px; width:50px" /><span style="color:green;font-weight:bold;">Save a Tree!</span><br>Please don’t print this e-mail unless you really need to!';
$LETHE_SETS['lethe_save_tree_on'] = 1;
$LETHE_SETS['lethe_license_key'] = '78186f83-6d2b-4a07-ba35-3d73fe161d00';
# v2.1 Settings
$LETHE_SETS['set_shell_cron_command'] = '/usr/bin/wget -O - -q';
$LETHE_SETS['set_min_cron'] = '*/5';
$LETHE_SETS['set_shell_type'] = 0;
$LETHE_SETS['set_shell'] = 0;
$LETHE_SETS['set_shell_command'] = 'crontab';


foreach($LETHE_SETS as $k=>$v){if(!defined($k)){define($k,$v);}}
?>