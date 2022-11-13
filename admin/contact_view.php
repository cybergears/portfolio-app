<?php

include('./admin-auth.php');

//Page Vars
$title  = array('#','Subject','Name', 'Email','Message','Status', 'Action' );
$edit_icon = '<svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.3764 20.0279L18.1628 8.66544C18.6403 8.0527 18.8101 7.3443 18.6509 6.62299C18.513 5.96726 18.1097 5.34377 17.5049 4.87078L16.0299 3.69906C14.7459 2.67784 13.1541 2.78534 12.2415 3.95706L11.2546 5.23735C11.1273 5.39752 11.1591 5.63401 11.3183 5.76301C11.3183 5.76301 13.812 7.76246 13.8651 7.80546C14.0349 7.96671 14.1622 8.1817 14.1941 8.43969C14.2471 8.94493 13.8969 9.41792 13.377 9.48242C13.1329 9.51467 12.8994 9.43942 12.7297 9.29967L10.1086 7.21422C9.98126 7.11855 9.79025 7.13898 9.68413 7.26797L3.45514 15.3303C3.0519 15.8355 2.91395 16.4912 3.0519 17.1255L3.84777 20.5761C3.89021 20.7589 4.04939 20.8879 4.24039 20.8879L7.74222 20.8449C8.37891 20.8341 8.97316 20.5439 9.3764 20.0279ZM14.2797 18.9533H19.9898C20.5469 18.9533 21 19.4123 21 19.9766C21 20.5421 20.5469 21 19.9898 21H14.2797C13.7226 21 13.2695 20.5421 13.2695 19.9766C13.2695 19.4123 13.7226 18.9533 14.2797 18.9533Z" fill="currentColor"></path></svg>';
$delete_icon = '<svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M20.2871 5.24297C20.6761 5.24297 21 5.56596 21 5.97696V6.35696C21 6.75795 20.6761 7.09095 20.2871 7.09095H3.71385C3.32386 7.09095 3 6.75795 3 6.35696V5.97696C3 5.56596 3.32386 5.24297 3.71385 5.24297H6.62957C7.22185 5.24297 7.7373 4.82197 7.87054 4.22798L8.02323 3.54598C8.26054 2.61699 9.0415 2 9.93527 2H14.0647C14.9488 2 15.7385 2.61699 15.967 3.49699L16.1304 4.22698C16.2627 4.82197 16.7781 5.24297 17.3714 5.24297H20.2871ZM18.8058 19.134C19.1102 16.2971 19.6432 9.55712 19.6432 9.48913C19.6626 9.28313 19.5955 9.08813 19.4623 8.93113C19.3193 8.78413 19.1384 8.69713 18.9391 8.69713H5.06852C4.86818 8.69713 4.67756 8.78413 4.54529 8.93113C4.41108 9.08813 4.34494 9.28313 4.35467 9.48913C4.35646 9.50162 4.37558 9.73903 4.40755 10.1359C4.54958 11.8992 4.94517 16.8102 5.20079 19.134C5.38168 20.846 6.50498 21.922 8.13206 21.961C9.38763 21.99 10.6811 22 12.0038 22C13.2496 22 14.5149 21.99 15.8094 21.961C17.4929 21.932 18.6152 20.875 18.8058 19.134Z" fill="currentColor"></path></svg>';
$status_visible_icon = '<svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22.4541 11.3918C22.7819 11.7385 22.7819 12.2615 22.4541 12.6082C21.0124 14.1335 16.8768 18 12 18C7.12317 18 2.98759 14.1335 1.54586 12.6082C1.21811 12.2615 1.21811 11.7385 1.54586 11.3918C2.98759 9.86647 7.12317 6 12 6C16.8768 6 21.0124 9.86647 22.4541 11.3918Z" fill="#130F26"></path><circle cx="12" cy="12" r="5" fill="#918F98"></circle><circle cx="12" cy="12" r="3" fill="#130F26"></circle><mask mask-type="alpha" maskUnits="userSpaceOnUse" x="9" y="9" width="6" height="6"><circle cx="12" cy="12" r="3" fill="#130F26"></circle></mask><circle opacity="0.89" cx="13.5" cy="10.5" r="1.5" fill="white" fill-opacity="0.6"></circle></svg>';
$status_hide_icon = '<svg width="32" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M9.80327 15.2526C10.4277 15.6759 11.1888 15.9319 11.9987 15.9319C14.1453 15.9319 15.8919 14.1696 15.8919 12.0037C15.8919 11.1866 15.6382 10.4186 15.2186 9.78855L14.1551 10.8617C14.3307 11.1964 14.4283 11.5902 14.4283 12.0037C14.4283 13.3525 13.3354 14.4551 11.9987 14.4551C11.5889 14.4551 11.1986 14.3567 10.8668 14.1795L9.80327 15.2526ZM18.4288 6.54952C19.8436 7.84907 21.0438 9.60149 21.9415 11.7083C22.0195 11.8954 22.0195 12.112 21.9415 12.2892C19.8534 17.1921 16.1358 20.1259 11.9987 20.1259H11.9889C10.1058 20.1259 8.30063 19.5056 6.71018 18.3735L4.81725 20.2834C4.67089 20.4311 4.4855 20.5 4.30011 20.5C4.11472 20.5 3.91957 20.4311 3.78297 20.2834C3.53903 20.0373 3.5 19.6435 3.69515 19.358L3.72442 19.3186L18.1556 4.75771C18.1751 4.73802 18.1946 4.71833 18.2044 4.69864L18.2044 4.69863C18.2239 4.67894 18.2434 4.65925 18.2532 4.63957L19.1704 3.71413C19.4631 3.42862 19.9217 3.42862 20.2046 3.71413C20.4974 3.99964 20.4974 4.4722 20.2046 4.75771L18.4288 6.54952ZM8.09836 12.0075C8.09836 12.2635 8.12764 12.5195 8.16667 12.7558L4.55643 16.3984C3.5807 15.2564 2.7318 13.8781 2.05854 12.293C1.98049 12.1158 1.98049 11.8992 2.05854 11.7122C4.14662 6.80933 7.86419 3.88534 11.9916 3.88534H12.0013C13.3966 3.88534 14.7529 4.22007 16.0018 4.85015L12.7429 8.13841C12.5087 8.09903 12.255 8.0695 12.0013 8.0695C9.84494 8.0695 8.09836 9.83177 8.09836 12.0075Z" fill="currentColor"></path></svg>';



/**General Page Setting */
$model_name = 'Manage Contact Queries';
$page_title = APP_NAME . ' | ' . $db_query->capital_word($model_name);

$table_name = 'contact_form';
$table_id = 'contact_id';
$edit_page = ADMIN_PATH.'/contact-add/';
$current_page = ADMIN_PATH.'/contact-view/';



/** Page Essential Imports */
include('includes/alert.php');

/** Data Query */
$data = $db_query->runQuery("SELECT * FROM ".$table_name."");

if(isset($_GET['status'])){
    if($_GET['status']==1){
        alert_notification('success','Operation Successful!');
    }else{
        alert_notification('danger','Please Try Again.');
    }
    $db_query->redirect($current_page); 
    
}
if(isset($_GET['delete'])){
    $id = $db_query->filter($_GET['delete']);
    $where = array();
    $where[$table_id] = $id;
    $action = $db->delete($table_name, $where,1);
    if($action){
        alert_notification('success','Operation Successful');
    }else{
        alert_notification('danger','Please Try Again.!');
    }
    $db_query->redirect($current_page);
    
}

if(isset($_GET['active'])){
    $id = $db_query->filter($_GET['active']);
    $where = array();
    $get_status = $db_query->fetch_object("SELECT * FROM ".$table_name." WHERE ".$table_id."=".$id." LIMIT 1");
    if($get_status->status==1){
        $where['status'] = 0;
    }else{
        $where['status'] = 1;
    }
    
    
    $action = $db->update($table_name, $where,$table_id,$id);
    if($action){
        alert_notification('success','Operation Successful');
    }else{
        alert_notification('danger','Please Try Again.!');
    }
    $db_query->redirect($current_page);
    
}

?>
<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $page_title; ?></title>
    <?php include('includes/head.php'); ?>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo ADMIN_PATH; ?>/styles/custom_styles.css" />
</head>

<body class="theme-color-default <?php echo $web_setting->admin_panel_theme; ?>  ">
    <!-- loader Start -->
    <div id="loading">
        <div class="loader simple-loader">
            <div class="loader-body"></div>
        </div>
    </div>
    <!-- loader END -->

    <?php include('includes/sidebar.php'); ?>
    <main class="main-content">
        <div class="position-relative iq-banner">
            <!--Nav Start-->
            <?php include('includes/top-nav.php'); ?>
            <!-- Nav Header Component Start -->
            <div class="iq-navbar-header" style="height: 85px;">
                
            </div> <!-- Nav Header Component End -->
            <!--Nav End-->
        </div>
        <div class="conatiner-fluid content-inner mt-n5 py-0">
        <div class="row">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title"><?php echo $model_name; ?></h4>
               </div>
            </div>
            <div class="card-body">
               <p>Contact Queries Management allows the user to manage the Contact Queries.</p>
               <div class="table-responsive">
                  <table id="datatable" class="table" data-toggle="data-table">
                     <thead>
                        <tr class="table-dark">
                            <?php foreach($title as $t){?>
                                <th><?php echo $t; ?></th>
                            <?php }?>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                            $counter = 0;
                            foreach($data as $d){
                                $counter++;
                                $status = '';
                                if($d['status']==1){
                                    $status='Active';
                                }else{
                                    $status = 'Unactive';
                                }
                                
                            
                        ?>
                        <tr>
                           <td><?php echo $counter; ?></td>
                           <td><?php echo $d['subject']; ?></td>
                           <td><?php echo $d['name']; ?></td>
                           <td><?php echo $d['email']; ?></td>
                           <td><?php echo $d['message']; ?></td>
                           <td><?php echo $status; ?></td>
                           <td>
                            <a href="javascript:void(0)" id="edit" onClick="javascript:edit_item('<?php echo $d[$table_id]; ?>','<?php echo $edit_page; ?>');">
                                <?php echo $edit_icon; ?>
                            </a>
                            <a href="javascript:void(0)" id="status" onClick="javascript:change_status('<?php echo $d[$table_id]; ?>','<?php echo $current_page; ?>')">
                            <?php
                                if($d['status']==1){
                                    echo $status_hide_icon;
                                }else{
                                    echo $status_visible_icon;
                                }
                            ?>
                            </a>
                            <a href="javascript:void(0)" id="delete" onClick="javascript:delete_item('<?php echo $d[$table_id]; ?>','<?php echo $current_page; ?>')">
                                <?php echo $delete_icon; ?>
                            </a>
                            
                           </td>
                        </tr>
                        <?php } ?>
                     </tbody>
                     <tfoot>
                        <tr class="table-dark">
                        <?php foreach($title as $t){?>
                            <th><?php echo $t; ?></th>
                        <?php }?>
                        </tr>
                     </tfoot>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
        </div>
        <!-- Footer Section Start -->
        <?php include('includes/footer.php'); ?>
        <!-- Footer Section End -->
    </main>
    <!-- Wrapper End-->
    <?php include('includes/foot.php'); ?>

    <!-- Custom Scripts -->
    <script src="<?php echo ADMIN_PATH; ?>/scripts/functions.js"></script>

    <script>
        $(document).ready(function(){
            $(".notifications").fadeOut(9000);

            
        });

    </script>
</body>

</html>

