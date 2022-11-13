<?php include('config.php'); ?>
<!doctype html>
<html lang="<?php echo LANG; ?>">
<head>
  <?php include('includes/header.php'); ?>
  <title><?php echo APP_NAME; ?></title>
  <noscript>
    <style type="text/css">
      [data-aos] {
        opacity: 1 !important;
        transform: translate(0) scale(1) !important;
      }
    </style>
  </noscript>
</head>

<body id="top">
  <?php include_once('includes/nav.php'); ?>
  <div class="page-content">
    <div>
      <?php include_once('includes/introduction.php'); ?>
      <?php include_once('includes/about.php'); ?>
      <?php include_once('includes/skills.php'); ?>
      <?php //include_once('includes/portfolio.php'); ?>
      <?php include_once('includes/experience.php'); ?>
      <?php include_once('includes/education.php'); ?>
      <?php //include_once('includes/refrence.php'); ?>
      <?php include_once('includes/contact.php'); ?>
    </div>
  </div>
  <?php include('includes/footer.php'); ?>
</body>

</html>