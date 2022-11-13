<?php
require_once('admin-auth.php');

include('controller/commonController.php');
$controller = new commonController();

if($_GET['get_type']=="fetch_attribute_essentials"){
    echo $controller->fetch_attribute_essentials($_GET['page_name']);    
    exit();
}

?>