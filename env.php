<?php
/*
This file contains all the environment variables of the web application
*/


//Error Handeling
define('DISPLAY_ERRORS', 1); // to disable errors set to 0


//General Server Configuration
header ("Cache-Control:no-cache");
set_time_limit(0);
ignore_user_abort (true);
date_default_timezone_set( 'Asia/Kolkata' );
define('MEMORY_LIMIT', -1);
define('IGNORE_USER_ABORT', 'On');
define('MAX_EXECUTION_TIME', -1);
define('ERROR_LOGGING', true);
define('USER_ABORT_SETTING', true); // if true user can abort the execution of scripts 
define("SECRET_KEY", "SZ)Vhg6w]G,=");
if($_SERVER['REMOTE_ADDR']=="127.0.0.1" || $_SERVER['REMOTE_ADDR']=="::1"){
    define("BASEPATH","http://localhost/cv");
}else{
    define("BASEPATH","https://shahrukhsheikh.in");
}






//Database Configuration
define("DB_HOST", "localhost");	


/** Developer Config (Local) **/
define("DEV_DB_USER", "root");	
define("DEV_DB_PASS", "");	
define("DEV_DB_NAME", "cv");

/** Production Config (Local) **/
define("PROD_DB_USER", "");	
define("PROD_DB_PASS", "");	
define("PROD_DB_NAME", "");

//Web Application Setting

define("ADMIN_DIR", "admin"); //Sets Admin Dashboard Directory Name

define("LANG", "en-US"); // Website Language

define("ADMIN_PATH", BASEPATH.'/'.ADMIN_DIR);

define("ADMIN_SESSION_NAME", 'ADMIN_SESSION');

define("ADMIN_COOKIE_NAME", 'BLINDS_ADMIN');

?>