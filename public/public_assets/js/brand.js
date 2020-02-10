$(document).ready(function() {
  var hrefandType =   $('.nav-pills  .active').attr('data-target').replace("#","");
  $('.ftagiDs').on('change',function(){
      getAjaxTab(1,hrefandType);
    });
  $('.fstoreiDs').on('change',function(){
     getAjaxTab(1,hrefandType);
  });
  $('.fcatiDs').on('change',function(){
    getAjaxTab(1,hrefandType);
  });

    checkSubscribed(<?php echo $data['brand']->brand_id; ?>,'brand','<?php echo route('check.subscribe') ?>');
    $('[data-toggle="tabajax"]').click(function(e) {

        e.preventDefault();
        var $this = $(this);
        var page=$(this).attr('href').split('page=')[1];
        getAjaxTab(1,$this.attr('data-target').replace("#",""));
        $this.tab('show');
    });
});

$(window).on('hashchange', function() {
	if (window.location.hash) {
			var page = window.location.hash.replace('#', '');

			if (page == Number.NaN || page <= 0) {
					return false;
			}else{
				var getTab =  $('.nav-pills  .active').text();

			}
	}
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
  if(type === undefined) {
     type  =   $('.nav-pills  .active').attr('data-target').replace("#","")
  }
  var tf = '';
  var sf = '';
  var cf = '';
  var couponId = '';

  $('.fcatiDs:checked').each(function()
    {
      cf = cf+''+ jQuery(this).val() +',';
    });
  $('.ftagiDs:checked').each(function()
    {
      tf = tf+''+ jQuery(this).val() +',';
    });
  $('.fstoreiDs:checked').each(function()
    {
      sf = sf+''+ jQuery(this).val() +',';
    });

    $.ajax({
      method:'get',
      cache: false,
      url:"?page="+page,
      data: {'catFilter':cf,'tagFilter' : tf,'storeFilter' : sf,'is_brand' : 1,'coupon_type':type, '_token': $('input[name=_token]').val()} ,
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
