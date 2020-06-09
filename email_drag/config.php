<?php

/*

  1. Make sure that you set SITE_URL and SITE_DIRECTORY correctly.
  2. Check uploads and exports folder in your server, if they do not exist ,please create those folders
  3. If you have any problem with installation, please create ticket in our support system.

*/

//main variables
// define("SITE_URL", '<your website url>/');
// define("SITE_DIRECTORY",'<your website directory>/');
define("SITE_URL", 'http://stage.desuntechnology.in/dev1/email/email_project/email_drag/');
define("SITE_DIRECTORY",'public_html/stage/dev1/email/email_project/email_drag');
/*
  For example :
  define("SITE_URL", 'http://localhost:8888/email-builder/v2.0/');
  define("SITE_DIRECTORY",'/Applications/MAMP/htdocs/email-builder-php-version/Email-Editor/v2.0.8/');
*/


 //uploads directory,url
define("UPLOADS_DIRECTORY",SITE_DIRECTORY.'uploads/');
define("UPLOADS_URL",SITE_URL.'uploads/');

//EXPORTS directory,url
define("EXPORTS_DIRECTORY",SITE_DIRECTORY.'exports/');
define("EXPORTS_URL",SITE_URL.'exports/');

//Db settings

// define('DB_SERVER','<database server name or IP>');
// define('DB_USER','<database user name>');
// define('DB_PASS' ,'<database user\'s password >');
// define('DB_NAME', '<database name>');

//Example DB
define('DB_SERVER','localhost');
define('DB_USER','stagedesun');
define('DB_PASS' ,'Desuntech@123');
define('DB_NAME', 'stage_email');


// define('EMAIL_SMTP','<Email stmp name>');
// define('EMAIL_PASS' ,'<Email password >');
// define('EMAIL_ADDRESS', '<Email address >');

define('EMAIL_SMTP','mail.cidcode.net');
define('EMAIL_PASS' ,'123456cidcode.');
define('EMAIL_ADDRESS', 'info@cidcode.net');



?>
