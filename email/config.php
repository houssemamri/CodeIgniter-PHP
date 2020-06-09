<?php

/*

  1. Make sure that you set SITE_URL and SITE_DIRECTORY correctly.
  2. Check uploads and exports folder in your server, if they do not exist ,please create those folders
  3. If you have any problem with installation, please create ticket in our support system.

*/

//main variables
// define("SITE_URL", '<your website url>/');
// define("SITE_DIRECTORY",'<your website directory>/');
define("SITE_URL", 'https://review-thunder.com/');
define("SITE_DIRECTORY",'root/www/');
/*
  For example :
  define("SITE_URL", 'http://localhost:8888/email-builder/v2.0/');
  define("SITE_DIRECTORY",'/Applications/MAMP/htdocs/email-builder-php-version/Email-Editor/v2.0.8/');
*/


 //uploads directory,url
define("UPLOADS_DIRECTORY",SITE_DIRECTORY.'email/uploads/');
define("UPLOADS_URL",SITE_URL.'email/uploads/');

//EXPORTS directory,url
define("EXPORTS_DIRECTORY",SITE_DIRECTORY.'email/exports/');
define("EXPORTS_URL",SITE_URL.'email/exports/');

//Db settings

// define('DB_SERVER','<database server name or IP>');
// define('DB_USER','<database user name>');
// define('DB_PASS' ,'<database user\'s password >');
// define('DB_NAME', '<database name>');

//Example DB
define('DB_SERVER','reviewthcpadmin.mysql.db');
define('DB_USER','reviewthcpadmin');
define('DB_PASS' ,'Thunder1');
define('DB_NAME', 'reviewthcpadmin');


// define('EMAIL_SMTP','<Email stmp name>');
// define('EMAIL_PASS' ,'<Email password >');
// define('EMAIL_ADDRESS', '<Email address >');

define('EMAIL_SMTP','smtp.webmarketing-tourisme.com');
define('EMAIL_PASS' ,'Edouard1985');
define('EMAIL_ADDRESS', 'e.richemond@webmarketing-tourisme.com');



?>
