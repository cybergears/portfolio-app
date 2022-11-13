<?php

include('./admin-auth.php');

//Page Vars
$edit=0;
$id='';


/**General Page Setting */
$model_name = 'Add App Settings';
$page_title = APP_NAME . ' | ' . $db_query->capital_word($model_name);

$table_name = 'app_setting';
$table_id = 'app_id';

$form_title = 'Add New App Settings';
$form_subtitle = 'After you fill all the details, Please submit the form.';

$view_page = '/settings-add/1';



/** Data Query */

$app_name = '';
$page_title_prefix = '';
$website_url = '';
$email = '';
$phone='';
$site_description='';

$siderbar_variant = '';
$admin_panel_theme = '';
$tagline = '';
$keywords = '';
$banner_image='';

$dob='';
$address='';
$languages='';






if (isset($_GET['edit'])) {
    $edit=1;
    $model_name = 'Edit App Settings';
    $form_title = 'Edit App Settings';
    $id = $db_query->filter($_GET['edit']);
    $fetch_details = $db_query->runQuery("SELECT * FROM ".$table_name." WHERE ".$table_id."='".$id."'");
    
    $app_name = $fetch_details[0]['app_name'];
    $page_title_prefix = $fetch_details[0]['page_title_prefix'];
    $website_url = $fetch_details[0]['website_url'];
    $email = $fetch_details[0]['email'];
    $phone = $fetch_details[0]['phone'];
    $site_description = $fetch_details[0]['site_description'];
    $sidebar_variant = $fetch_details[0]['sidebar_variant'];
    
    $admin_panel_theme = $fetch_details[0]['admin_panel_theme'];

    $tagline = $fetch_details[0]['tagline'];
    $keywords = $fetch_details[0]['keywords'];

    $dob= $fetch_details[0]['dob'];
    $address= $fetch_details[0]['address'];
    $languages= $fetch_details[0]['languages'];
    

}




/** Page Essential Imports */
include('includes/alert.php');



if(isset($_REQUEST['mode']) == "save"){

    $status = 0;
    $payload = $_POST;
    if($_FILES['app_admin_logo']){
        $tmpFilePath = $_FILES['app_admin_logo']['tmp_name'];
        $main_path = "images/admin-panel/";
        $gallery_image_name = rand(1,100000).time().'-'.$_FILES['app_admin_logo']['name'];
        $filePath = $main_path.$gallery_image_name;
        if(move_uploaded_file($tmpFilePath, $filePath)){
            $payload['app_admin_logo'] = $gallery_image_name;
            
        }
    }
    if($_FILES['admin_favicon']){
        $tmpFilePath = $_FILES['admin_favicon']['tmp_name'];
        $main_path = "images/admin-panel/";
        $gallery_image_name = rand(1,100000).time().'-'.$_FILES['admin_favicon']['name'];
        $filePath = $main_path.$gallery_image_name;
        if(move_uploaded_file($tmpFilePath, $filePath)){
            $payload['admin_favicon'] = $gallery_image_name;
            
        }
    }
    if($_FILES['site_logo']){
        $tmpFilePath = $_FILES['site_logo']['tmp_name'];
        $main_path = "../assets/logo/";
        $gallery_image_name = rand(1,100000).time().'-'.$_FILES['site_logo']['name'];
        $filePath = $main_path.$gallery_image_name;
        if(move_uploaded_file($tmpFilePath, $filePath)){
            $payload['site_logo'] = $gallery_image_name;
            
        }
    }
    if($_FILES['site_favicon']){
        $tmpFilePath = $_FILES['site_favicon']['tmp_name'];
        $main_path = "../assets/logo/";
        $gallery_image_name = rand(1,100000).time().'-'.$_FILES['site_favicon']['name'];
        $filePath = $main_path.$gallery_image_name;
        if(move_uploaded_file($tmpFilePath, $filePath)){
            $payload['site_favicon'] = $gallery_image_name;
            
        }
    }

    if($_FILES['banner_image']){
        $tmpFilePath = $_FILES['banner_image']['tmp_name'];
        $main_path = "../assets/images/";
        $gallery_image_name = rand(1,100000).time().'-'.$_FILES['banner_image']['name'];
        $filePath = $main_path.$gallery_image_name;
        if(move_uploaded_file($tmpFilePath, $filePath)){
            $payload['banner_image'] = $gallery_image_name;
            
        }
    }

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
        $db_query->redirect(ADMIN_PATH.$view_page); 
    }
    if($payload['edit']==1){
        
        $op = $db->update($table_name, $result,$table_id,$result[$table_id]);
        if($op){
            $status=1;
        }else{
            $status=0;
        }
        $db_query->redirect(ADMIN_PATH.$view_page);  
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
                                <div class="header-title">
                                    <h5 class="card-title">General Settings</h5>
                                </div>
                                <hr class="hr-horizontal">
                                <div class="col-md-12">
                                    <label for="app_name" class="form-label">App Name</label>
                                    <input type="text" name="app_name" value="<?php echo $app_name; ?>" class="form-control" id="app_name" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="page_title_prefix" class="form-label">Page Title Prefix</label>
                                    <input type="text" name="page_title_prefix" value="<?php echo $page_title_prefix; ?>" class="form-control" id="page_title_prefix" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="website_url" class="form-label">Website Url</label>
                                    <input type="text" name="website_url" value="<?php echo $website_url; ?>" class="form-control" id="website_url" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Website Email</label>
                                    <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" id="email">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="phone" class="form-label">Website Phone</label>
                                    <input type="text" name="phone" value="<?php echo $phone; ?>" class="form-control" id="phone">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="site_description" class="form-label">Website Description</label>
                                    <textarea name="site_description" class="form-control" id="site_description"><?php echo $site_description; ?></textarea>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="tagline" class="form-label">Tagline</label>
                                    <textarea name="tagline" class="form-control" id="tagline"><?php echo $tagline; ?></textarea>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="keywords" class="form-label">Keywords</label>
                                    <textarea name="keywords" class="form-control" id="keywords"><?php echo $keywords; ?></textarea>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea name="address" class="form-control" id="address"><?php echo $address; ?></textarea>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="languages" class="form-label">Languages</label>
                                    <textarea name="languages" class="form-control" id="languages"><?php echo $languages; ?></textarea>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div> 
                                
                                <div class="col-md-12">
                                    <label for="dob" class="form-label">Date Of Birth</label>
                                    <input type="date" name="dob" value="<?php echo $dob; ?>" class="form-control" id="dob">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <label for="app_admin_logo" class="form-label">Choose Admin Panel Logo</label>
                                    <input type="file" accept=".jpg,.png,.jpeg" name="app_admin_logo"  class="form-control" id="file">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="admin_favicon" class="form-label">Choose Admin Panel Favicon</label>
                                    <input type="file" accept=".jpg,.png,.jpeg" name="admin_favicon"  class="form-control" id="file2">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="site_logo" class="form-label">Choose Site Logo</label>
                                    <input type="file" accept=".jpg,.png,.jpeg" name="site_logo"  class="form-control" id="file3">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="site_favicon" class="form-label">Choose Site Favicon</label>
                                    <input type="file" accept=".jpg,.png,.jpeg" name="site_favicon"  class="form-control" id="file4">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="banner_image" class="form-label">Choose Banner Image</label>
                                    <input type="file" accept=".jpg,.png,.jpeg" name="banner_image"  class="form-control" id="banner_image">
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="header-title">
                                    <h5 class="card-title">Design Settings</h5>
                                </div>
                                <hr class="hr-horizontal">
                                <div class="col-md-12">
                                    <label for="sidebar_variant" class="form-label">Sidebar Variant</label>
                                    <select class="form-select" id="sidebar_variant" name="sidebar_variant" >
                                        <option selected disabled value="">Choose...</option>
                                        <option value='dark'>Dark</option>
                                        <option value='light'>Light</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a variant type.
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="admin_panel_theme" class="form-label">Admin Panel Theme</label>
                                    <select class="form-select" id="admin_panel_theme" name="admin_panel_theme" >
                                        <option selected disabled value="">Choose...</option>
                                        <option value='dark'>Dark</option>
                                        <option value='light'>Light</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a variant type.
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
                $("#sidebar_variant").val('<?php echo $sidebar_variant; ?>').change();
                $("#admin_panel_theme").val('<?php echo $admin_panel_theme;  ?>').change();
            }
            
        });
    </script>
</body>

</html>