<?php function dashboard_widget($background, $icon, $title, $value, $url)
{ ?>
<a href="<?php echo $url; ?>">
         <div class="card <?php echo $background; ?>">
            <div class="card-body">
               <div class="d-flex justify-content-between align-items-center">
                  <div class="<?php echo $background; ?> rounded p-3">
                     <?php echo $icon; ?>
                  </div>
                  <div class="text-end">
                        <h2 class="counter"><?php echo $value; ?></h2>
                     <?php echo $title; ?>
                  </div>
               </div>
            </div>
         </div>
      </a>
<?php } ?>