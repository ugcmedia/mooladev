<script>


$(document).ready(function()
{
            //Join now popup message
            <?php
              $message = Session::get('serror');
              //dd($message);
              if ($message == 'joniNow-msg'){
            ?>
              $('#join-us-modal').modal('show');
              <?php
               if (count($errors) > 0) {
                 foreach ($errors->all() as $error) {
              ?>
                  ToasterTargetedMessages(300,"<?php echo $error; ?>",".<?php echo $message?>")
            <?php }
              }

            }?>

            <?php if(isset($message['target'])) {
                  if($message['target'] == 'joniNow-msg') {?>
                    $('#join-us-modal').modal('show');
                    ToasterTargetedMessages("<?php echo $message['statusCode']; ?>","<?php echo $message['msg']; ?>",".<?php echo $message['target']; ?>")
            <?php } }?>

            <?php $successMessage = Session::get('jsuccess');
                  if(isset($successMessage)) {
            ?>
              ToasterUnTargetedMessages("<?php echo $successMessage['statusCode']; ?>","<?php echo $successMessage['msg']; ?>","bottomCenter")
            <?php } ?>
            /* join now message end here */





                    //Join now page message
                    <?php
                      $message = Session::get('jnerror');
                      if ($message == 'join-Now-msg'){

                    ?>
                      <?php
                       if (count($errors) > 0) {
                         foreach ($errors->all() as $error) {
                      ?>
                          ToasterTargetedMessages(300,"<?php echo $error; ?>",".<?php echo $message?>")
                    <?php }
                      }

                    }?>

                    <?php if(isset($message['target'])) {
                          if($message['target'] == 'join-Now-msg') {?>
                            ToasterTargetedMessages("<?php echo $message['statusCode']; ?>","<?php echo $message['msg']; ?>",".<?php echo $message['target']; ?>")
                    <?php } }?>

                    <?php $successMessage = Session::get('jnsuccess');
                          if(isset($successMessage)) {

                    ?>
                      ToasterUnTargetedMessages("<?php echo $successMessage['statusCode']; ?>","<?php echo $successMessage['msg']; ?>","bottomCenter")
                    <?php } ?>
                    /* join now page message end here */







                /* Login  popup message start here */

                <?php
                  $loginmessage = Session::get('lcerror');
                  if ($loginmessage['type'] == 'login')
                  {

                ?>
                  $('#login-modal').modal('show');
                  <?php

                       if (count($loginmessage) > 0)
                       {
                         ?>
                            ToasterTargetedMessages(300,"<?php echo  $loginmessage['msg']; ?>",".<?php echo "login"; ?>")
                      <?php
                  }
                }
               ?>

                <?php if(isset($loginmessage['type']))
                {
                      if($loginmessage['type'] == 'login') {?>
                        $('#login-modal').modal('show');
                        ToasterUnTargetedMessages(500,"<?php echo $loginmessage['msg']; ?>","bottomCenter")
                <?php } }?>

                <?php
                $successMessage = Session::get('lsuccess');

                       if(isset($successMessage['type']))
                        {

                ?>

                  ToasterUnTargetedMessages(200,"<?php echo $successMessage['msg']; ?>","bottomCenter")
                <?php }?>

                /* login popup message end here  */



                /* Login  Page message start here */
                <?php
                  $message = Session::get('lerror');
                  //dd($message);
                  if ($message == 'login-msg'){
                ?>
                  $('#login-modal').modal('show');
                  <?php
                   if (count($errors) > 0) {
                     foreach ($errors->all() as $error) {
                  ?>
                    ToasterTargetedMessages(300,"<?php echo $error; ?>",".<?php echo "login"; ?>")
                <?php }
                  }
                }?>

                <?php
                      $loginmessage = Session::get('vlerror');


                  if ($loginmessage['type'] == 'login')
                  {
                ?>

                  <?php

                       if (count($loginmessage) > 0)
                       {

                                   foreach ($loginmessage as $error)
                                   {
                                      ?>
                                      ToasterTargetedMessages(300,"<?php echo $error; ?>",".<?php echo "login"; ?>")
                      <?php  }
                  }
                }
               ?>

                <?php if(isset($loginmessage['type']))
                {
                      if($loginmessage['type'] == 'login') {?>

                        ToasterUnTargetedMessages(500,"<?php echo $loginmessage['msg']; ?>","bottomCenter")
                <?php } }?>

                <?php
                $successMessage = Session::get('vlsuccess');

                       if(isset($successMessage['type']))
                        {

                ?>

                  ToasterUnTargetedMessages(200,"<?php echo $successMessage['msg']; ?>","bottomCenter")
                <?php }?>

                /* login page message end here  */









  /* forgot password  messages start here */

  <?php
        $forgotmessage = Session::get('ferror');
    if ($forgotmessage == 'forgot-password-msg'){
  ?>
    $('#forgot-modal').modal('show');
    <?php
     if (count($errors) > 0) {
       foreach ($errors->all() as $error) {
    ?>
        ToasterTargetedMessages(300,"<?php echo $error; ?>",".<?php echo $forgotmessage?>")
  <?php }
    }
  }?>

  <?php if(isset($forgotmessage['target'])) {
        if($forgotmessage['target'] == 'forgot-password-msg') {?>
          $('#forgot-modal').modal('show');
          ToasterTargetedMessages("<?php echo  $forgotmessage['statusCode']; ?> ","<?php echo $forgotmessage['msg']; ?>",".<?php echo $forgotmessage['target']; ?>")
  <?php } }?>

  <?php $successMessage = Session::get('fsuccess');
        if(isset($successMessage)) {
  ?>
    ToasterUnTargetedMessages("<?php echo  $successMessage['statusCode']; ?> ","<?php echo $successMessage['msg']; ?>","bottomCenter")
  <?php } ?>

  /* forgot passowrd messages end here  */








  /* reset passsword messages start here */

  <?php
        $resetmessage = Session::get('rerror');
    if ($resetmessage == 'reset-password-msg'){
  ?>
    <?php
     if (count($errors) > 0) {
       foreach ($errors->all() as $error) {
    ?>
        ToasterTargetedMessages(300,"<?php echo $error; ?>",".<?php echo $resetmessage?>")
  <?php }
    }
  }?>

  <?php if(isset($resetmessage['target'])) {
        if($resetmessage['target'] == 'reset-password-msg') {?>
          ToasterTargetedMessages("<?php echo  $resetmessage['statusCode']; ?> ","<?php echo $resetmessage['msg']; ?>",".<?php echo $resetmessage['target']; ?>")
  <?php } }?>

  <?php $successMessage = Session::get('rsuccess');
        if(isset($successMessage)) {
  ?>
  ToasterTargetedMessages("<?php echo  $successMessage['statusCode']; ?> ","<?php echo $successMessage['msg']; ?>",".<?php echo $successMessage['target']; ?>")
  <?php } ?>

  /* reset password messages end here */

<?php $logout_successMessage = Session::get('logoutsuccess');
      if(isset($logout_successMessage)) {
?>
ToasterUnTargetedMessages("200","<?php echo $logout_successMessage['msg']; ?>","bottomCenter")
<?php } ?>






//refresh Captcha
    $('[data-toggle="tooltip"]').tooltip()
    $(".btn-refresh").click(function(){
      $.ajax({
         type:'GET',
         url:'/refresh_captcha',
         success:function(data){
            $(".captcha span").html(data.captcha);
         }
      });
    });
  });






  //show hidden passsword
  $('.toggle-password').on('click', function(){
		 var $this= $(this),
		   $password_field = $this.prev('input');
		 ( 'password' == $password_field.attr('type') ) ? $password_field.attr('type', 'pass') : $password_field.attr('type', 'password');
		   if( $password_field.attr('type') == 'pass') {
         $(this).toggleClass("fa-eye fa-eye-slash");
		   } else {
         $(this).toggleClass("fa-eye fa-eye");
		   }
		});

  // $(".toggle-password").click(function() {
  //   $(this).toggleClass("fa-eye fa-eye-slash");
  //   var input = $($(this).attr("toggle"));
  //   alert(input);
  //   if ($('#signup-password', '#password-field').attr("type") == "password") {
  //     $('#signup-password', '#password-field') .attr("type", "text");
  //   } else {
  //     $('#signup-password') .attr("type", "password");
  //   }
  // });
  </script>
