<?php

include('./admin-auth.php');

//Page Vars
$edit=0;
$id='';


/**General Page Setting */
$model_name = 'Add New Skill';
$page_title = APP_NAME . ' | ' . $db_query->capital_word($model_name);

$table_name = 'skills';
$table_id = 'skill_id';

$form_title = 'Add New Skill';
$form_subtitle = 'After you fill all the details, Please submit the form.';

$view_page = '/skill-view/';



/** Data Query */

$skill_name = '';
$skill_level = '';


if (isset($_GET['edit'])) {
    $edit=1;
    $model_name = 'Edit Skill';
    $form_title = 'Edit Skill';
    $id = $db_query->filter($_GET['edit']);
    $fetch_details = $db_query->runQuery("SELECT * FROM ".$table_name." WHERE ".$table_id."='".$id."'");
    
    $skill_name = $fetch_details[0]['skill_name'];
    $skill_level = $fetch_details[0]['skill_level'];

}




/** Page Essential Imports */
include('includes/alert.php');



if(isset($_REQUEST['mode']) == "save"){

    $status = 0;
    $payload = $_POST;
    
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
                <div class="col-sm-12 col-lg-12 ms-auto me-auto">
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
                                    <label for="skill_name" class="form-label">Skill Name</label>
                                    <input type="text" name="skill_name" value="<?php echo $skill_name; ?>" class="form-control" id="skill_name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="skill_level" class="form-label">Skill Level</label>
                                    <input type="range" name="skill_level" value="<?php echo $skill_level; ?>" class="form-range" id="skill_level" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                       
                                
                                
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION[ADMIN_SESSION_NAME]; ?>">
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
            
            
        });
    </script>
</body>

</html>