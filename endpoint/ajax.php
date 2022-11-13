<?php
    include('../config.php');

    if ($_REQUEST['get_type']=="contactMe")  {

        echo $methods->contactMe();	
        exit();
        
    }

?>