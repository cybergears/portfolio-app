<?php
/* 
This file control every connection in the application.
*/

ob_start();
session_start();
include_once('env.php');

//General Configuration

ini_set('memory_limit',MEMORY_LIMIT);
ini_set('max_execution_time',MAX_EXECUTION_TIME);
ini_set('ignore_user_abort',IGNORE_USER_ABORT);
ini_set('display_errors', DISPLAY_ERRORS);
ini_set('display_startup_errors', DISPLAY_ERRORS);
error_reporting(E_ALL & ~E_NOTICE);
error_reporting(DISPLAY_ERRORS);


//database connections

if($_SERVER['REMOTE_ADDR']=="127.0.0.1" || $_SERVER['REMOTE_ADDR']=="::1"){
    
    //define("BASEPATH","http://localhost/blinds");
    define("DB_USER", DEV_DB_USER);	
    define("DB_PASS", DEV_DB_PASS);	
    define("DB_NAME", DEV_DB_NAME);

}else{
    
    //define("BASEPATH","https://otzol.net/comfieblinds");
    define("DB_USER", PROD_DB_USER);	
    define("DB_PASS", PROD_DB_PASS);	
    define("DB_NAME", PROD_DB_NAME);	
}

require_once("class/ClassDb.php");
$db = new DB();



include("class/ClassQuery.php");

$db_query = new Query();

include("controller/Methods.php");
$methods = new Methods();

$web_setting = $db_query->fetch_object("select * from app_setting where app_id=1");
define("APP_NAME", $web_setting->app_name);
$profile_data = $methods->fetchProfile();

//echo print_r($profile_data['social_icons']);

?>