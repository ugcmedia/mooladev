$(document).ready(function(){
 // $('#frm-1').show();
 $('#frm-2').hide();
 $('#Radio1').click(function(){
     $('#frm-1').show(500);
     $('#frm-2').hide(500);

 });
 $('#Radio2').click(function(){
   $('#frm-1').hide(500);
   $('#frm-2').show(500);
 });
 $('#dth-frm').hide();
 $('#mobile-redio').click(function(){
     $('#mobile-recharge-frm').show(500);
     $('#dth-frm').hide(500);
 });
 $('#dth-redio').click(function(){
   $('#mobile-recharge-frm').hide(500);
   $('#dth-frm').show(500);
 });

 $('#rechg-frm').hide();
 $('#paytm-redio').click(function(){
     $('#paytm-frm').show(500);
     $('#rechg-frm').hide(500);

 });
 $('#freecharge-redio').click(function(){
   $('#paytm-frm').hide(500);
   $('#rechg-frm').show(500);
 });

 $('#amazon-c-frm').hide();
$('#flipkart-c-redio').click(function(){
    $('#flipkart-c-frm').show(500);
    $('#amazon-c-frm').hide(500);

});
$('#amazon-c-redio').click(function(){
  $('#flipkart-c-frm').hide(500);
  $('#amazon-c-frm').show(500);
});

$('#divGetOtp').hide();
$('#OTP').on('submit', function (e) {

  e.preventDefault();







  	$(".area .input").click(function(e) {

     $("label[type='checkbox']", this)
     var pX = e.pageX,
        pY = e.pageY,
        oX = parseInt($(this).offset().left),
        oY = parseInt($(this).offset().top);

     $(this).addClass('active');

     if ($(this).hasClass('active')) {
        $(this).removeClass('active')
        if ($(this).hasClass('active-2')) {
           if ($("input", this).attr("type") == "checkbox") {
              if ($("span", this).hasClass('click-efect')) {
                 $(".click-efect").css({
                    "margin-left": (pX - oX) + "px",
                    "margin-top": (pY - oY) + "px"
                 })
                 $(".click-efect", this).animate({
                    "width": "0",
                    "height": "0",
                    "top": "0",
                    "left": "0"
                 }, 400, function() {
                    $(this).remove();
                 });
              } else {
                 $(this).append('<span class="click-efect x-' + oX + ' y-' + oY + '" style="margin-left:' + (pX - oX) + 'px;margin-top:' + (pY - oY) + 'px;"></span>')
                 $('.x-' + oX + '.y-' + oY + '').animate({
                    "width": "500px",
                    "height": "500px",
                    "top": "-250px",
                    "left": "-250px",
                 }, 600);
              }
           }

           if ($("input", this).attr("type") == "radio") {

              $(".area .input input[type='radio']").parent().removeClass('active-radio').addClass('no-active-radio');
              $(this).addClass('active-radio').removeClass('no-active-radio');

              $(".area .input.no-active-radio").each(function() {
                 $(".click-efect", this).animate({
                    "width": "0",
                    "height": "0",
                    "top": "0",
                    "left": "0"
                 }, 400, function() {
                    $(this).remove();
                 });
              });

              if (!$("span", this).hasClass('click-efect')) {
                 $(this).append('<span class="click-efect x-' + oX + ' y-' + oY + '" style="margin-left:' + (pX - oX) + 'px;margin-top:' + (pY - oY) + 'px;"></span>')
                 $('.x-' + oX + '.y-' + oY + '').animate({
                    "width": "500px",
                    "height": "500px",
                    "top": "-250px",
                    "left": "-250px",
                 }, 600);
              }

           }
        }
        if ($(this).hasClass('active-2')) {
           $(this).removeClass('active-2')
        } else {
           $(this).addClass('active-2');
        }
     }
  	});




    	$(".area .input").click(function(e) {

       $("label[type='checkbox']", this)
       var pX = e.pageX,
          pY = e.pageY,
          oX = parseInt($(this).offset().left),
          oY = parseInt($(this).offset().top);

       $(this).addClass('active');

       if ($(this).hasClass('active')) {
          $(this).removeClass('active')
          if ($(this).hasClass('active-2')) {
             if ($("input", this).attr("type") == "checkbox") {
                if ($("span", this).hasClass('click-efect')) {
                   $(".click-efect").css({
                      "margin-left": (pX - oX) + "px",
                      "margin-top": (pY - oY) + "px"
                   })
                   $(".click-efect", this).animate({
                      "width": "0",
                      "height": "0",
                      "top": "0",
                      "left": "0"
                   }, 400, function() {
                      $(this).remove();
                   });
                } else {
                   $(this).append('<span class="click-efect x-' + oX + ' y-' + oY + '" style="margin-left:' + (pX - oX) + 'px;margin-top:' + (pY - oY) + 'px;"></span>')
                   $('.x-' + oX + '.y-' + oY + '').animate({
                      "width": "500px",
                      "height": "500px",
                      "top": "-250px",
                      "left": "-250px",
                   }, 600);
                }
             }

             if ($("input", this).attr("type") == "radio") {

                $(".area .input input[type='radio']").parent().removeClass('active-radio').addClass('no-active-radio');
                $(this).addClass('active-radio').removeClass('no-active-radio');

                $(".area .input.no-active-radio").each(function() {
                   $(".click-efect", this).animate({
                      "width": "0",
                      "height": "0",
                      "top": "0",
                      "left": "0"
                   }, 400, function() {
                      $(this).remove();
                   });
                });

                if (!$("span", this).hasClass('click-efect')) {
                   $(this).append('<span class="click-efect x-' + oX + ' y-' + oY + '" style="margin-left:' + (pX - oX) + 'px;margin-top:' + (pY - oY) + 'px;"></span>')
                   $('.x-' + oX + '.y-' + oY + '').animate({
                      "width": "500px",
                      "height": "500px",
                      "top": "-250px",
                      "left": "-250px",
                   }, 600);
                }

             }
          }
          if ($(this).hasClass('active-2')) {
             $(this).removeClass('active-2')
          } else {
             $(this).addClass('active-2');
          }
       }
    	});


});



  $(function(){
    var current = location.pathname.replace(/\/$/, "");
    $('.list-group  a').each(function(){
        var $this = $(this);
        // if the current path is like this link, make it active
        if($this.attr('href').indexOf(current) !== -1){
            $this.addClass('active');
        }
    })
  });



});
