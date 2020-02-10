
$(document).ready(function() {

  //alert('welcome to category page');
//alert('aaa');
  //var hrefandType =   $('.cat-all-deals  .active').attr('data-target').replace("#","");
  //alert(hrefandType);

  // $('.ftagiDs').on('change',function(){
  //     getAjaxTab(1,hrefandType);
  //   });

  $('.fbrandiDs').on('change',function()
   {
    // alert('bcvbcv0');
      getAjaxTab(1);
   });

   $('.flocationiDs').on('change',function()
    {
     // alert('bcvbcv0');
       getAjaxTab(1);
    });

   // $('.fstoreiDs').on('change',function(){
   //    getAjaxTab(1,hrefandType);
   //
   // });

  // checkSubscribed('<?php echo $data['cat']->cat_id; ?>','cat','<?php echo route('check.subscribe') ?>');

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
			var getTab =  $('.cat-all-deals  .active').text();
			$('li').removeClass('active');
			$(this).parent('li').addClass('active');
			event.preventDefault();
			var myurl = $(this).attr('href');
			var page=$(this).attr('href').split('page=')[1];
		  getAjaxTab(page,$('.cat-all-deals  .active').attr('data-target').replace("#",""));
	});
});

function getAjaxTab(page) {
    // $(type).parent().focus();
    // var Tid  =   $('.cat-all-deals .active').attr('data-target');
    // var TidP =Tid.replace("#","");
    // $(Tid).empty();
    // $(Tid).append("<div class='cpn-offer-wrapper bg-white couponbox text-center'><img  src='{{asset('uploads/images/loading.gif')}}' align='center' ></div>");
    //     if(type === undefined)
    //     {
    //        type  =   $('.cat-all-deals.active').attr('data-target').replace("#","")
    //     }

    //var sf = '';
    //var tf = '';
    var cf = '';
    var lf = '';
    var tag = '';
    var testall = '';
    var couponId = '';

    $('.fbrandiDs:checked').each(function()
      {
        cf = cf+''+ jQuery(this).val() +',';
      });
      $('.flocationiDs:checked').each(function() {
        lf = lf +''+jQuery(this).val()+',';
      });

      console.log(cf)
      $.ajax({
        method:'get',
        cache: false,
        url:"?page="+page,
        data: {'catFilter':cf,'locationFilter':lf,'is_location': 1, 'is_cat' : 1, '_token': $('input[name=_token]').val()} ,
        success:function(response){
        },
          complete:function(response) {
        }
      }).done(function(data)
  			{
          //var Tid =   $('.cat-all-deals .active').attr('data-target');
          var Tid = $('#cat-all-deals');
          $(Tid).empty();
          $(Tid).html(data);
  			})
  			.fail(function(jqXHR, ajaxOptions, thrownError)
  			{



  		});
      return false
  }
