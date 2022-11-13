<?php
    include('../config.php');

    //Checking Authentication
    if(!isset($_SESSION[ADMIN_SESSION_NAME])){
        $db_query->redirect(ADMIN_PATH.'/login/' );
    }else{
        //Fetching Admin Details
        $admin_setting = $db_query->fetch_object("select * from admin where admin_id='".$_SESSION[ADMIN_SESSION_NAME]."'");
        
        $admin_level = '';
        if($admin_setting->admin_level=='a'){
            $admin_level = 'Staff User';
        }else if($admin_setting->admin_level=='b'){
            $admin_level = 'Administrator';
        }else if($admin_setting->admin_level=='z'){
            $admin_level = 'Technical Admin';
        }

        $profile_pic = BASEPATH.'/assets/images/'.$admin_setting->admin_profile_pic;

        //fetching menu
        $menu = $db_query->runQuery("select * from admin_menu  INNER JOIN app_icons on admin_menu.item_icon=app_icons.icon_id WHERE admin_menu.status=1");
        //fetching icons
        $icons = $db_query->runQuery("select * from app_icons where status='1'");

    }
    

    
?>