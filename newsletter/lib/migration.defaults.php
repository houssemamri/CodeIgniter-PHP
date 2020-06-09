<?php
# Defaults for old users
if(!defined('set_shell_cron_command')){define('set_shell_cron_command','/usr/bin/wget -O - -q');}
if(!defined('set_min_cron')){define('set_min_cron','*/5');}
if(!defined('set_shell')){define('set_shell',1);}
if(!defined('set_shell_command')){define('set_shell_command','crontab');}
if(!defined('set_shell_type')){define('set_shell_type',0);}
?>