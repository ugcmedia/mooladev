
$(document).ready(function() {
  var hrefandType =   $('.nav-pills  .active').attr('data-target').replace("#","");

  $('.ftagiDs').on('change',function(){
      getAjaxTab(1,hrefandType);
    });
  $('.fbrandiDs').on('change',function(){
      getAjaxTab(1,hrefandType);
   });
   $('.fstoreiDs').on('change',function(){
      getAjaxTab(1,hrefandType);

   });

  checkSubscribed(<?php echo $data['cat']->cat_id; ?>,'cat','<?php echo route('check.subscribe') ?>');

  $('[data-toggle="tabajax"]').click(function(e) {
      e.preventDefault();
      var $this = $(this);

      getAjaxTab(1,$this.attr('data-target').replace("#",""));
      $this.tab('show');
  });
});

$(document).ready(function()
{
	$(document).on('click', '.pagination a',function(event)
	{
			var getTab =  $('.nav-pills  .active').text();
			$('li').removeClass('active');
			$(this).parent('li').addClass('active');
			event.preventDefault();
			var myurl = $(this).attr('href');
			var page=$(this).attr('href').split('page=')[1];
		  getAjaxTab(page,$('.nav-pills  .active').attr('data-target').replace("#",""));
	});
});

function getAjaxTab(page,type) {
    $(type).parent().focus();
    var Tid  =   $('.nav-pills  .active').attr('data-target');
    var TidP =Tid.replace("#","");
    $(Tid).empty();
    $(Tid).append("<div class='cpn-offer-wrapper bg-white couponbox text-center'><img  src='{{asset('uploads/images/loading.gif')}}' align='center' ></div>");
        if(type === undefined)
        {
           type  =   $('.nav-pills  .active').attr('data-target').replace("#","")
        }

    var sf = '';
    var tf = '';
    var bf = '';
    var tag = '';
    var testall = '';
    var couponId = '';

    $('.fstoreiDs:checked').each(function()
      {
        sf = sf+''+ jQuery(this).val() +',';
      });

    $('.ftagiDs:checked').each(function()
      {
        tf = tf+''+ jQuery(this).val() +',';
      });

    $('.fbrandiDs:checked').each(function()
      {
        document.write()
        bf = bf+''+ jQuery(this).val() +',';

      });

      $.ajax({
        method:'get',
        cache: false,
        url:"?page="+page,
        data: {'storeFilter':sf,'tagFilter' : tf,'brandFilter' : bf,'coupon_id' :couponId,'is_cat' : 1, 'coupon_type':type,'_token': $('input[name=_token]').val()} ,
        success:function(response){
        },
          complete:function(response) {
        }
      }).done(function(data)
  			{
          var Tid =   $('.nav-pills  .active').attr('data-target');
          $(Tid).empty();
          $(Tid).html(data);
  			})
  			.fail(function(jqXHR, ajaxOptions, thrownError)
  			{
  						alert("{{trans('actionMsg.no_response')}}");
  		});
      return false
  }
