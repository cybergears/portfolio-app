<?php
include('./admin-auth.php');

//Page Vars
$edit=0;
$id='';


/**General Page Setting */
$model_name = 'Add Admin Menu';
$page_title = APP_NAME . ' | ' . $db_query->capital_word($model_name);

$table_name = 'admin_menu';
$table_id = 'menu_id';

$form_title = 'Add New Menu Item';
$form_subtitle = 'After you fill all the details, Please submit the form.';

$view_page = '/menu-view/';



/** Data Query */

$item_name = '';
$item_link = '';
$item_icon = '';
$item_type = '';
$child_id = '';
$placement = '';

$menu_list = $db_query->runQuery("SELECT * FROM ".$table_name." WHERE item_type='0'");
$icon_list = $db_query->runQuery("SELECT * FROM app_icons WHERE status='1'");
if (isset($_GET['edit'])) {
    $edit=1;
    $model_name = 'Edit Admin Menu';
    $form_title = 'Edit Menu Item';
    $id = $db_query->filter($_GET['edit']);
    $fetch_details = $db_query->runQuery("SELECT * FROM ".$table_name." WHERE ".$table_id."='".$id."'");
    
    $item_name = $fetch_details[0]['item_name'];
    $item_link = $fetch_details[0]['item_link'];
    $item_icon = $fetch_details[0]['item_icon'];
    $item_type = $fetch_details[0]['item_type'];
    $child_id = $fetch_details[0]['child_id'];
    $placement = $fetch_details[0]['placement'];

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
            // generating template pages
            if($result['item_link']!='#' || !empty($result['item_link'])){
                $template = $db_query->generate_menu_file_template($result['item_link']);
                if($template){
                    $status=1;
                }else{
                    $status=0;
                }
            }else{
                $status=1;
            }
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
                                    <label for="item_name" class="form-label">Menu Name</label>
                                    <input type="text" name="item_name" value="<?php echo $item_name; ?>" class="form-control" id="item_name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="item_link" class="form-label">Page URL</label>
                                    <input type="text" name="item_link" value="<?php echo $item_link; ?>" class="form-control" id="item_link" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <label for="item_icon" class="form-label">Select Icon</label>
                                    <select class="form-select" id="item_icon" name="item_icon" required>
                                        <option selected disabled  value="0">Choose...</option>
                                        <?php foreach($icon_list as $i){?>
                                            <option value="<?php echo $i['icon_id'] ?>"><?php echo html_entity_decode($i['icon']).' '.$i['icon_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid parent item.
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="placement" class="form-label">Menu Placement</label>
                                    <select class="form-select" id="placement" name="placement" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option value='1'>Sidebar</option>
                                        <option value='0'>Other</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid Position.
                                    </div>
                                </div>
                                

                                <div class="col-md-12">
                                    <label for="item_type" class="form-label">Select Type</label>
                                    <select class="form-select" id="item_type" name="item_type" required>
                                        <option selected disabled value="">Choose...</option>
                                        <option value='0'>Parent</option>
                                        <option value='1'>Child</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid type.
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <label for="child_id" class="form-label">Select Parent Menu Item</label>
                                    <select class="form-select" id="child_id" name="child_id" required>
                                        <option selected  value="0">Choose...</option>
                                        <?php foreach($menu_list as $m){?>
                                            <option class="items_child" value="<?php echo $m['menu_id'] ?>"><?php echo $m['item_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a valid parent item.
                                    </div>
                                </div>

                                <input type="hidden" name="mode" value="save">
                                <input type="hidden" name="edit" value="<?php echo $edit; ?>">
                                <?php if($edit==1){ ?>
                                <input type="hidden" name="<?php echo $table_id ?>" value="<?php echo $id; ?>">
                                <?php } ?>
                                <div class="col-12">
                                    <button class="btn btn-primary" type="submit" id="save_menu">Save</button>
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
            $("#item_type").on('change',function(){
                var id = $(this).val();
                if(id==0){
                    $(".item_type").hide();
                    $("#child_id").removeAttr('required');
                    $("#child_id").val('0').change();
                }else{
                    $(".item_type").show();
                    $("#child_id").attr('required');
                }
            });

            if(edit=='1'){
                $("#item_type").val(<?php echo $item_type; ?>).change();
                $("#child_id").val(<?php echo $child_id; ?>).change();
                $("#item_icon").val(<?php echo $item_icon; ?>).change();
                $("#placement").val(<?php echo $placement; ?>).change();
            }
            
        });
    </script>
</body>

</html>