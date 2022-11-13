<?php

include('./admin-auth.php');

//Page Vars
$edit=0;
$id='';


/**General Page Setting */
$model_name = 'Add New Social Profile';
$page_title = APP_NAME . ' | ' . $db_query->capital_word($model_name);

$table_name = 'social_profiles';
$table_id = 'social_id';

$form_title = 'Add New Social Profile';
$form_subtitle = 'After you fill all the details, Please submit the form.';

$view_page = '/social-view/';



/** Data Query */

$name = '';
$url = '';
$icon = '';
$icon_list = $db_query->runQuery("SELECT * FROM app_icons WHERE status='1'");

if (isset($_GET['edit'])) {
    $edit=1;
    $model_name = 'Edit Social Profile';
    $form_title = 'Edit Social Profile';
    $id = $db_query->filter($_GET['edit']);
    $fetch_details = $db_query->runQuery("SELECT * FROM ".$table_name." WHERE ".$table_id."='".$id."'");
    
    $name = $fetch_details[0]['name'];
    $url = $fetch_details[0]['url'];
    $icon = $fetch_details[0]['icon'];

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
                                    <label for="name" class="form-label">Network Name</label>
                                    <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" id="name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="url" class="form-label">Url</label>
                                    <input type="text" name="url" value="<?php echo $url; ?>" class="form-control" id="url" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                

                                <div class="col-md-12">
                                    <label for="icon" class="form-label">Icon</label>
                                    <select class="form-select" id="icon" name="icon" required>
                                        <option selected disabled value="0">Choose...</option>
                                        <?php foreach($icon_list as $i){?>
                                            <option value="<?php echo $i['icon_id'] ?>"><?php echo html_entity_decode($i['icon']).' '.$i['icon_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid type.
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="color" class="form-label">Icon Color</label>
                                    <input type="text" name="color" value="<?php echo $color; ?>" class="form-control" id="color" data-jscolor="{}" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                
                                

                                <input type="hidden" name="mode" value="save">
                                <input type="hidden" name="user_id" value="<?php echo $_SESSION[ADMIN_SESSION_NAME]; ?>">
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
    <script src="<?php echo BASEPATH; ?>/assets/js/jscolor.min.js"></script>                              
    <script>
        $(document).ready(function(){

            // Here we can adjust defaults for all color pickers on page:
            jscolor.presets.default = {
                palette: [
                    '#000000', '#7d7d7d', '#870014', '#ec1c23', '#ff7e26', '#fef100', '#22b14b', '#00a1e7', '#3f47cc', '#a349a4',
                    '#ffffff', '#c3c3c3', '#b87957', '#feaec9', '#ffc80d', '#eee3af', '#b5e61d', '#99d9ea', '#7092be', '#c8bfe7',
                ],
                //paletteCols: 12,
                //hideOnPaletteClick: true,
                //width: 271,
                //height: 151,
                //position: 'right',
                //previewPosition: 'right',
                //backgroundColor: 'rgba(51,51,51,1)', controlBorderColor: 'rgba(153,153,153,1)', buttonColor: 'rgba(240,240,240,1)',
            }
            var edit = '<?php echo $edit; ?>';
            if(edit=='1'){
                $("#icon").val(<?php echo $icon; ?>).change();
            }
            
        });
    </script>
</body>

</html>