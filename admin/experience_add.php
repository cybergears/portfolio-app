<?php

include('./admin-auth.php');

//Page Vars
$edit=0;
$id='';


/**General Page Setting */
$model_name = 'Add New Experience';
$page_title = APP_NAME . ' | ' . $db_query->capital_word($model_name);

$table_name = 'experience';
$table_id = 'experience_id';

$form_title = 'Add New Experience';
$form_subtitle = 'After you fill all the details, Please submit the form.';

$view_page = '/experience-view/';



/** Data Query */

$company_name = '';
$title = '';
$description = '';
$from = '';
$to = '';


if (isset($_GET['edit'])) {
    $edit=1;
    $model_name = 'Edit Experience';
    $form_title = 'Edit Expreience';
    $id = $db_query->filter($_GET['edit']);
    $fetch_details = $db_query->runQuery("SELECT * FROM ".$table_name." WHERE ".$table_id."='".$id."'");
    
    $company_name = $fetch_details[0]['company_name'];
    $title = $fetch_details[0]['title'];
    $description = $fetch_details[0]['description'];
    $from = $fetch_details[0]['from'];
    $to = $fetch_details[0]['to'];

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
                                    <label for="company_name" class="form-label">Company Name</label>
                                    <input type="text" name="company_name" value="<?php echo $company_name; ?>" class="form-control" id="company_name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="title" class="form-label">Job Title</label>
                                    <input type="text" name="title" value="<?php echo $title; ?>" class="form-control" id="title" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="description" class="form-label">Job Summary (Not More Than 300 Characters.)</label>
                                    <textarea name="description" maxlength="300" class="form-control" id="description"><?php echo $description; ?></textarea>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="temp_data" class="form-label">Do you currently work here?</label>
                                    <select class="form-select" id="temp_data" name="temp_data" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option value='0'>No</option>
                                        <option value='1'>Yes</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid type.
                                    </div>
                                </div>

                                <div class="col-md-12" id="from_date">
                                    <label for="from" class="form-label">From</label>
                                    <input type="date" name="from" value="<?php echo $from; ?>" class="form-control" id="from" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-12" id="to_date">
                                    <label for="to_date" class="form-label">To</label>
                                    <input type="date" name="to_dt" value="" class="form-control" id="to_dt">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                
                                
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION[ADMIN_SESSION_NAME]; ?>">
                                <input type="hidden" name="to" value="" id="to">
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
            var to_dte = '<?php echo $to; ?>';
            $("#to_date").hide();
            $("#temp_data").on('change',function(){
                var type = $(this).val();
                if(type==0){
                    $("#to_date").show();
                    //$("#to").val($("#to_date").val());
                }else{
                    $("#to_date").hide();
                    $("#to").val('PRESENT');
                }
            });

            $("#to_dt").on('change',function(){
                console.log($(this).val());
                $("#to").val($(this).val());
            });


            if(edit=='1'){

                if(to_dte=='PRESENT'){
                    $("#temp_data").val(1).change();
                    $("#to").val(to_dte);
                }else{
                    $("#temp_data").val(0).change();
                    $("#to_dt").val(to_dte);
                    $("#to").val(to_dte);
                }
            }
            
            
        });
    </script>
</body>

</html>