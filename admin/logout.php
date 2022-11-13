<?php
    include('../config/config.php');
	$status = $db_query->getAuthentication($_COOKIE[ADMIN_COOKIE_NAME],ADMIN_COOKIE_NAME);
	if($status==true){
		$db_query->deleteCookie($_SESSION[ADMIN_SESSION_NAME],ADMIN_COOKIE_NAME);
		unset($_SESSION[ADMIN_SESSION_NAME]);
	}else{
		unset($_SESSION[ADMIN_SESSION_NAME]);
	}
	$db_query->redirect(ADMIN_PATH."/login/");
	exit();

?>