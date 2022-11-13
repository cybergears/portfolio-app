<?php
include('../config.php');

//Page Vars
$msg = 'Sign in to start your session';
$msg_class = '';

/**General Page Setting */
$model_name = 'Admin Login';
$page_title = APP_NAME.' | '.$db_query->capital_word($model_name);


//Checking Authentication
if($db_query->getAuthentication($_COOKIE[ADMIN_COOKIE_NAME],ADMIN_COOKIE_NAME) == true || isset($_SESSION[ADMIN_SESSION_NAME])){
    $db_query->redirect(ADMIN_PATH."/dashboard/");
}else{
  if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $db_query->filter($_POST['username']);
    $password = $db_query->filter($_POST['password']);
    $remember = $db_query->filter($_POST['auth_cookie']);
    $login = $db_query->admin_login($username,$password,$remember);
    if($login==2){
      $msg='Please fill all required fields';
      $msg_class = 'text-warning';
    }else if($login==4 || $login==3){
      $msg='Username or Password is incorrect';
      $msg_class = 'text-danger';
    }else if($login==1){
      $msg = 'Login Successfull';
      $msg_class = 'text-success';
      $db_query->redirect(ADMIN_PATH."/dashboard/");
    }

  }
}
?>


<!doctype html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <title><?php echo $page_title; ?></title>
      
      <!-- Favicon -->
      <link rel="shortcut icon" href="<?php echo ADMIN_PATH; ?>/assets/images/favicon.ico" />
      
      <!-- Library / Plugin Css Build -->
      <link rel="stylesheet" href="<?php echo ADMIN_PATH; ?>/assets/css/core/libs.min.css" />
      
      
      <!-- Hope Ui Design System Css -->
      <link rel="stylesheet" href="<?php echo ADMIN_PATH; ?>/assets/css/hope-ui.min.css?v=1.2.0" />
      
      <!-- Custom Css -->
      <link rel="stylesheet" href="<?php echo ADMIN_PATH; ?>/assets/css/custom.min.css?v=1.2.0" />
      
      <!-- Dark Css -->
      <link rel="stylesheet" href="<?php echo ADMIN_PATH; ?>/assets/css/dark.min.css"/>
      
      <!-- Customizer Css -->
      <link rel="stylesheet" href="<?php echo ADMIN_PATH; ?>/assets/css/customizer.min.css" />
      
      <!-- RTL Css -->
      <link rel="stylesheet" href="<?php echo ADMIN_PATH; ?>/assets/css/rtl.min.css"/>
      <!-- Custom CSS -->
      <!--<link rel="stylesheet" href="styles/custom_styles.css"  /> -->
  </head>
  <body class="theme-color-default <?php echo $web_setting->admin_panel_theme; ?> " data-bs-spy="scroll" data-bs-target="#elements-section" data-bs-offset="0" tabindex="0">
    <!-- loader Start -->
    <div id="loading">
      <div class="loader simple-loader">
          <div class="loader-body"></div>
      </div>    </div>
    <!-- loader END -->
    
      <div class="wrapper">
      <section class="login-content">
         <div class="row m-0 align-items-center bg-white vh-100">            
            <div class="col-md-6">
               <div class="row justify-content-center">
                  <div class="col-md-10">
                     <div class="card card-transparent shadow-none d-flex justify-content-center mb-0 auth-card">
                        <div class="card-body">
                           
                           <h2 class="mb-2 text-center">Sign In</h2>
                           <p class="text-center <?php echo $msg_class; ?>"><?php echo $msg; ?></p>
                           <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                              <div class="row">
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <label for="username" class="form-label">Username</label>
                                       <input type="text" name="username" class="form-control" id="username" aria-describedby="email" placeholder=" ">
                                    </div>
                                 </div>
                                 <div class="col-lg-12">
                                    <div class="form-group">
                                       <label for="password" class="form-label">Password</label>
                                       <input type="password" name="password" class="form-control" id="password" aria-describedby="password" placeholder=" ">
                                    </div>
                                 </div>
                                 <div class="col-lg-12 d-flex justify-content-between">
                                    <div class="form-check mb-3">
                                       <input type="checkbox" name="auth_cookie" value="1" class="form-check-input" id="customCheck1">
                                       <label class="form-check-label" for="customCheck1">Remember Me</label>
                                    </div>
                                    
                                 </div>
                              </div>
                              <div class="d-flex justify-content-center">
                                 <button type="submit" class="btn btn-primary">Sign In</button>
                              </div>
                              
                             
                              
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="sign-bg">
                  <svg width="280" height="230" viewBox="0 0 431 398" fill="none" xmlns="http://www.w3.org/2000/svg">
                     <g opacity="0.05">
                     <rect x="-157.085" y="193.773" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 -157.085 193.773)" fill="#3B8AFF"/>
                     <rect x="7.46875" y="358.327" width="543" height="77.5714" rx="38.7857" transform="rotate(-45 7.46875 358.327)" fill="#3B8AFF"/>
                     <rect x="61.9355" y="138.545" width="310.286" height="77.5714" rx="38.7857" transform="rotate(45 61.9355 138.545)" fill="#3B8AFF"/>
                     <rect x="62.3154" y="-190.173" width="543" height="77.5714" rx="38.7857" transform="rotate(45 62.3154 -190.173)" fill="#3B8AFF"/>
                     </g>
                  </svg>
               </div>
            </div>
            <div class="col-md-6 d-md-block d-none bg-primary p-0 mt-n1 vh-100 overflow-hidden">
               <img src="<?php echo ADMIN_PATH; ?>/assets/images/auth/01.png" class="img-fluid gradient-main animated-scaleX" alt="images">
            </div>
         </div>
      </section>
      </div>
    
    <!-- Library Bundle Script -->
    <script src="<?php echo ADMIN_PATH; ?>/assets/js/core/libs.min.js"></script>
    
    <!-- External Library Bundle Script -->
    <script src="<?php echo ADMIN_PATH; ?>/assets/js/core/external.min.js"></script>
    
    <!-- Widgetchart Script -->
    <script src="<?php echo ADMIN_PATH; ?>/assets/js/charts/widgetcharts.js"></script>
    
    <!-- mapchart Script -->
    <script src="<?php echo ADMIN_PATH; ?>/assets/js/charts/vectore-chart.js"></script>
    <script src="<?php echo ADMIN_PATH; ?>/assets/js/charts/dashboard.js" ></script>
    
    <!-- fslightbox Script -->
    <script src="<?php echo ADMIN_PATH; ?>/assets/js/plugins/fslightbox.js"></script>
    
    <!-- Settings Script -->
    <script src="<?php echo ADMIN_PATH; ?>/assets/js/plugins/setting.js"></script>
    
    <!-- Slider-tab Script -->
    <script src="<?php echo ADMIN_PATH; ?>/assets/js/plugins/slider-tabs.js"></script>
    
    <!-- Form Wizard Script -->
    <script src="<?php echo ADMIN_PATH; ?>/assets/js/plugins/form-wizard.js"></script>
    
    <!-- AOS Animation Plugin-->
    
    <!-- App Script -->
    <script src="<?php echo ADMIN_PATH; ?>/assets/js/hope-ui.js" defer></script>
  </body>
</html>