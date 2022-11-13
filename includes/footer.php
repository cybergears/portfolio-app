<footer class="footer">
    <div class="container text-center">
      <?php foreach($profile_data['social_icons'] as $icons){ ?>
        <a class="cc-facebook btn btn-link " style="color:#000; ?>; "  href="<?php echo $icons['url']; ?>" target="_BLANK" rel="tooltip" title="<?php echo $icons['name'] ?>">
          <?php echo $db_query->icon_front($icons['icon']); ?>
        </a>
      <?php } ?>
        
    </div>
      <div class="h4 title text-center"><?php echo APP_NAME; ?></div>
      <div class="text-center text-muted">
        <p>&copy;All rights reserved.<br>Design - <a class="credit" href="https://templateflip.com" target="_blank">TemplateFlip</a><br>Developed By - <a class="credit" href="https://shahrukhsheikh.in" target="_blank">Shahrukh Sheikh</a> </p>
      </div>
</footer>
<script src="<?php echo BASEPATH; ?>/assets/js/core/jquery.3.2.1.min.js?ver=1.1.0"></script>
<!--<script src="js/core/popper.min.js?ver=1.1.0"></script>
<script src="js/core/bootstrap.min.js?ver=1.1.0"></script>-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="<?php echo BASEPATH; ?>/assets/js/now-ui-kit.js?ver=1.1.0"></script>
<script src="<?php echo BASEPATH; ?>/assets/js/aos.js?ver=1.1.0"></script>
<script src="<?php echo BASEPATH; ?>/scripts/main.js?ver=1.1.0"></script>

<script>
  $(document).ready(function(){

    read_more('<?php echo $web_setting->site_description; ?>');
    $("#about_text").on('click',function(){
        read_more('<?php echo $web_setting->site_description; ?>');
    });
    
    function read_more(text){

      var total_chars = text.length;
      var action= $("#about_text").attr('class');
      
      
      if(total_chars>100){
        if(action=='read_more'){
          var read_a = text.substring(1,280);
          $("#about_text").html(read_a+'... <a href="javascript:void(0);">Read More</a>');
          $("#about_text").removeClass('read_more');
          $("#about_text").addClass('read_less');
        }if(action=='read_less'){
          var read_a = text.substring(1,total_chars);
          $("#about_text").html(read_a+'<a href="javascript:void(0);">Read Less</a>');
          $("#about_text").removeClass('read_less');
          $("#about_text").addClass('read_more');
        }
      }else{
        $("#about_text").html(text);
      }
      
    }

    $("#contact_form").on('click',function(){
      contactMe();
    });

    function contactMe(){
      var name = $("#name").val();
      var subject = $("#subject").val();
      var email = $("#reply_email").val();
      var message = $("#message").val();

      var data =  new FormData();

      if(name!=="" || subject!="" || email!="" || message!=""){

        data.append('name',name);
        data.append('subject',subject);
        data.append('reply_email',email);
        data.append('message',message);

        $.ajax({
          url: '<?php echo BASEPATH; ?>' + '/endpoint/ajax.php?get_type=contactMe',
          type: 'POST',
          data:data,
          async: false,  
          cache: false,   
          dataType: 'json',
          processData: false,
          contentType: false,
          success: function(response) {
            
            if(response[0].status==1){
              $("#contact_status").fadeOut(5000).html(response[0].msg);
            }

            $("#name").val('');
            $("#subject").val('');
            $("#reply_email").val('');
            $("#message").val('');

          }
        });
      }
    }
    
  });
</script>
