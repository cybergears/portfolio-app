<?php

include('./admin-auth.php');

//Page Vars
$edit=0;
$id='';


/**General Page Setting */
$model_name = 'Add New Admin';
$page_title = APP_NAME . ' | ' . $db_query->capital_word($model_name);

$table_name = 'admin';
$table_id = 'admin_id';

$form_title = 'Add New Admin';
$form_subtitle = 'After you fill all the details, Please submit the form.';

$view_page = '/admin-view/';



/** Data Query */

$admin_name = '';
$admin_email = '';
$admin_username = '';
$admin_level = '';
$admin_gender = ''; 



if (isset($_GET['edit'])) {
    $edit=1;
    $model_name = 'Edit Admin Details';
    $form_title = 'Edit Admin Details';
    $id = $db_query->filter($_GET['edit']);
    $fetch_details = $db_query->runQuery("SELECT * FROM ".$table_name." WHERE ".$table_id."='".$id."'");
    
    $admin_name = $fetch_details[0]['admin_name'];
    $admin_email = $fetch_details[0]['admin_email'];
    $admin_username = $fetch_details[0]['admin_username'];
    $admin_level = $fetch_details[0]['admin_level'];
    $admin_gender = $fetch_details[0]['admin_gender'];

}




/** Page Essential Imports */
include('includes/alert.php');



if(isset($_REQUEST['mode']) == "save"){

    $status = 0;
    $dta = $_POST;
    $payload = array();
    $payload['admin_id'] = $dta['admin_id'];
    $payload['admin_name'] = $dta['admin_name'];
    $payload['admin_level'] = $dta['admin_level'];
    $payload['admin_username'] = $dta['admin_username'];
    $payload['added_on'] = date('Y-m-d');
    if(!empty($dta['admin_password'])){
        $payload['admin_password'] = password_hash($dta['admin_password'],PASSWORD_DEFAULT);
    }
    
    $payload['admin_email'] = $dta['admin_email'];
    $payload['admin_gender'] = $dta['admin_gender'];
    $payload['mode'] = $dta['mode'];
    $payload['edit'] = $dta['edit'];
    
    $allowed = $db_query->table_filter($table_name);
    $result = $db_query->filter_duplicate_value_array($payload,  $allowed);
    //echo print_r($result);
    //exit();
    if($payload['edit']==0){
        $op = $db->insert($table_name, $result);
        if($op){
            $status=1;
            
        }else{
            $status=0;
        }
        $db_query->redirect(ADMIN_PATH.$view_page.'?status='.$status); 
    }
    if($payload['edit']==1){
        
        $op = $db->update($table_name, $result,$table_id,$result[$table_id]);
        if($op){
            $status=1;
        }else{
            $status=0;
        }
        $db_query->redirect(ADMIN_PATH.$view_page.'?status='.$status);  
    }
    
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
        <div class="conatiner-fluid content-inner  mt-n5 py-0">
            <div class="row">
            <div class="col-sm-12 col-lg-8 ms-auto me-auto">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title"><?php echo $form_title; ?></h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <p><?php echo $form_subtitle; ?></p>
                            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                                <div class="col-md-12">
                                    <label for="admin_name" class="form-label">Name</label>
                                    <input type="text" name="admin_name" value="<?php echo $admin_name; ?>" class="form-control" id="admin_name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="admin_username" class="form-label">Username</label>
                                    <input type="text" name="admin_username" value="<?php echo $admin_username; ?>" class="form-control" id="admin_username" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <label for="admin_level" class="form-label">Access Level</label>
                                    <select class="form-select" id="admin_level" name="admin_level" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option value='a'>Staff</option>
                                        <option value='b'>Owner</option>
                                        
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid type.
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="admin_email" class="form-label">Email</label>
                                    <input type="email" name="admin_email" value="<?php echo $admin_email; ?>" class="form-control" id="admin_email" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="admin_password" class="form-label">Password</label>
                                    <input type="password" name="admin_password" value="" class="form-control" id="admin_password" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                

                                <div class="col-md-12">
                                    <label for="admin_gender" class="form-label">Gender</label>
                                    <select class="form-select" id="admin_gender" name="admin_gender" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option value='1'>Male</option>
                                        <option value='2'>Female</option>
                                        <option value='0'>Other</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid type.
                                    </div>
                                </div>

                                
                                
                                

                                <input type="hidden" name="mode" value="save">
                                <input type="hidden" name="edit" value="<?php echo $edit; ?>">
                                <?php if($edit==1){ ?>
                                <input type="hidden" name="<?php echo $table_id ?>" value="<?php echo $id; ?>">
                                <?php } ?>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit" id="save">Save</button>
                                </div>
                            </form>
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
            var edit = '<?php echo $edit; ?>';
            if(edit==1){
                $("#admin_gender").val(<?php echo $admin_gender; ?>).change();
                $("#admin_level").val(<?php echo $admin_level; ?>).change();
                $("#admin_password").removeAttr('required');
            }
            
        });
    </script>
</body>

</html>