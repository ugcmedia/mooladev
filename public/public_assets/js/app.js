//start smooth scroll top
 window.onscroll = function() { scrollFunction() };

function scrollFunction() {

  if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
    //$('#return-to-top').fadeIn(200);
    $('#scrollTop').show();
    //document.getElementById("scrollTop").style.display = "block ";
  } else {
    $('#scrollTop').hide();
    //document.getElementById("scrollTop").style.display = "none  ";
  }


}

function scrollFunctionMap()
{

	var elmnt = document.getElementById("nearme-wrap");


if (elmnt.scrollTop > 200 ) {
    //$('#return-to-top').fadeIn(200);
    $('#scrollTopMap').css('left', (elmnt.offsetWidth*0.88) );
	$('#scrollTopMap').show();
    //document.getElementById("scrollTop").style.display = "block ";
  } else {
    $('#scrollTopMap').hide();
    //document.getElementById("scrollTop").style.display = "none  ";
  }
}

function topFunction() {
 $('html,body').animate({ scrollTop: 0 }, 1000, function () {});
}

function topFunctionMap() {

 $('#nearme-wrap').animate({ scrollTop: 0 }, 1000, function () {});
}



function initListing()
{
	//coupon hiw and share popover
  $(function(){

    $('[rel="HiwCpnPop"], [rel="CpnSharePop"]').popover({
        container: 'body',
       placement:"bottom",
      trigger:"click",
        html: true,
        content: function () {
            var clone = $($(this).data('popover-content')).clone(true).removeClass('d-none');
            return clone;
        }
    }).click(function(e) {
        e.preventDefault();
    });

  });

  $('#hiw-model').click(function(){
      $($('[rel="HiwCpnPop"]').data('popover-content')).addClass('d-none');
  });

  $('.sthiwbtn').click(function(){
      $('[rel="HiwCpnPop"], [rel="CpnSharePop"]').popover('hide');
  });

  $('[rel="CpnSharePop"]').on('shown.bs.popover', function(){
       var cpnId = $(this).closest('.store-card-wrap').data('couponid');

   $('.popover.fade.show a').each(function(){
       $(this).attr('href',$(this).attr('href').replace('#repCouponId','#coupon-'+cpnId));
      });
   });

   $('[rel="CpnSharePop"]').on('shown.bs.popover', function(){
        var cpnId = $(this).closest('.store-card-wrap').data('couponid');

    $('.popover.fade.show a').each(function(){
        $(this).attr('href',$(this).attr('href').replace('#repCouponId','#coupon-'+cpnId));
       });
    });
/*
    $('.ajax-commentdeal').each(function() {
      var $this = $(this);
      var cmtid = $this.attr('id').replace('cpmnt','');

   new Comments.default({
       el: '#'+$this.attr('id'),
       pageId: cmtid,
       commentableId: cmtid,
       commentableType: "App.Coupons"
     });
    }); */


	$('.cpn-coments').click( function()  {

		var cmtDiv =  $(this).data('target');
		var $this = $(cmtDiv);
		 var cmtid = $this.attr('id').replace('cpmnt','');

   new Comments.default({
       el: '#'+$this.attr('id'),
       pageId: cmtid,
       commentableId: cmtid,
       commentableType: "App.Coupons"
     });

    });


    //subscribe coupon
$('.cpn-fav-action').on('click', function (e) {

  //console.log('aa');
  var tabType = $(this).closest('.store-card-wrap').data('tabtype');
  //console.log(tabType);

	var $this = $(this);
	var action = $(this).data('action');
	favurl = fav_urls.addUrl;


	var CouponId = $(this).closest('.store-card-wrap').data('couponid');
  // var tabType = $(this).closest('.store-card-wrap').data('tabtype');

	// var target   = $(this).closest('.store-card-wrap').find('.');
  var target   ='.fav-unfav-cpnMsg'+CouponId+tabType;
  // var target   = $('.store-card-wrap .cpnMsg');
	 $.ajax({
        method:'post',
        cache: false,
        data: {id:CouponId,action:action,o_type:'coupon', '_token': $('input[name=_token]').val()},
        url:favurl,
        success:function(data){
        if(data.statusCode == 200) {

			     ToasterTargetedMessages(data.statusCode,data.msg,target);
    			 if(action=='add')
    				 {
    					$this.find('.cpn-replace-label').text(fav_labels.removeLab);
    					$this.find('.cpn-replace-label').html(fav_labels.removeLab);
    					$this.data('action','remove');
    				}
    			else
    				{
    					$this.find('.cpn-replace-label').text(fav_labels.addLab);
    					$this.find('.cpn-replace-label').html(fav_labels.addLab);
    					$this.data('action','add');
    				}
          }
      }
    });


} );


}

$(document).ready(function(){

  initListing();
  commonSidbarSeachFilter();

  $("iframe").unveil(500);
	$("img").unveil();

  //deal filter check box-change
  $('.fdealcatiDs').on('change',function(){
      getDeals();
  });

  //when deal tab clicked
  $('[data-toggle="dealAjax"]').click(function(e) {
      e.preventDefault();
      var $this = $(this);
      if($this.attr('data-tabname') == 'deal') {
        getDeals();
        $('.cat-filter-mobile').addClass('d-none');
        $('.deal-filter-mobile').removeClass('d-none');

        $('.deal-filter').removeAttr('style');
        $('.coupon-filter').css({'display':'none'});
      }
      else {
        $('.cat-filter-mobile').removeClass('d-none');
        $('.deal-filter-mobile').addClass('d-none');
        $('.coupon-filter').removeAttr('style');
        $('.deal-filter').css({'display':'none'});
      }
      $this.tab('show');
  });

$('#renderall #navPage li a').each(function(){
	$(this).attr('rel','nofollow');
	});


if(window.location.hash && (window.location.hash.indexOf('coupon') || window.location.hash.indexOf('deal') || window.location.hash.indexOf('slider') || window.location.hash.indexOf('store') || window.location.hash.indexOf('storeCat'))) {
  var hashvar = window.location.hash.split('-');
  var objecttype = hashvar[0].replace('#','');
  var objectid = hashvar[1];
  $.ajax({
    method:'post',
    cache: false,
    data: {id:objectid,type:objecttype},
    url:cbUrl,
    success:function(response){
      $('#cb-common-popup').html(response);
      $("#cb-common-popup").modal('show');
    }
  });

  copyModal();
}


});

/*
jQuery.fn.extend({
    getPath: function() {
        var pathes = [];

        this.each(function(index, element) {
            var path, $node = jQuery(element);

            while ($node.length) {
                var realNode = $node.get(0), name = realNode.localName;
                if (!name) { break; }

                name = name.toLowerCase();
                var parent = $node.parent();
                var sameTagSiblings = parent.children(name);

                if (sameTagSiblings.length > 1)
                {
                    var allSiblings = parent.children();
                    var index = allSiblings.index(realNode) + 1;
                    if (index > 0) {
                        name += ':nth-child(' + index + ')';
                    }
                }

                path = name + (path ? ' > ' + path : '');
                $node = parent;
            }

            pathes.push(path);
        });

        return pathes.join(',');
    }
}); */


function ToasterTargetedMessages(status,msg,target) {

  if(status == 200) {
    iziToast.success({
        title: 'OK',
        message: msg,
        target:target,
    });
  }

  if(status == 300) {
    iziToast.error({
        title: 'Error',
        message: msg,
        target:target,
    });
  }

  if(status == 500) {
      iziToast.info({
        title: 'Info',
        message: msg,
        target:target,
    });
  }


}
function ToasterUnTargetedMessages(status,msg,msg_position) {

  if(status == 200) {
    iziToast.success({
      title: 'OK',
      message:msg,
      position: msg_position,
    });
  }
  if(status == 300) {
    iziToast.error({
        title: 'Error',
        message: msg,
        position: msg_position,
    });

  }
  if(status == 500) {
      iziToast.info({
       message: msg,
       position: msg_position,
    });
  }

}

function checkSubscribed(catID,type,url) {
  $.ajax({
    method:'Post',
    cache: false,
    data: {id:catID,o_type : type, '_token': $('input[name=_token]').val()},
    url:url,
    success:function(data){

      if(data == 1) {
        $('#not-subscribed').hide();
        $('#subscribed').css({'display':'block'});
        //$('#subscribed').show();
      }
      else {
        $('#not-subscribed').css({'display':'block'});
        //$('#not-subscribed').show();
        $('#subscribed').hide();
      }
    }
  });
}


function addSubscriber(storeID,type,url,target) {

      $.ajax({
        method:'Post',
        cache: false,
        data: {id:storeID,o_type:type, '_token': $('input[name=_token]').val()},
        url:url,
        success:function(data){
          ToasterTargetedMessages(data.statusCode,data.msg,'.'+target);
          if(data.statusCode == 200) {
            $('#not-subscribed').hide();
            $('#subscribed').show();
          }
      }
    });
}

//favorite  coupon
function addCouponSubscriber(CouponId,type,url,target,subscribe) {
      $.ajax({
        method:'Post',
        cache: false,
        data: {id:CouponId,o_type:type,subscribe:subscribe, '_token': $('input[name=_token]').val()},
        url:url,
        success:function(data){
          ToasterTargetedMessages(data.statusCode,data.msg,target);
          if(data.statusCode == 200) {
            if(subscribe) {
              $('.add-fav-'+CouponId).css({'display':'none'});
              $('.remove-fav-'+CouponId).css({'display':'block'});
            }
            else {
              $('.add-fav-'+CouponId).css({'display':'block'});
              $('.remove-fav-'+CouponId).css({'display':'none'});
            }
          }
      }
    });
}

function commonSidbarSeachFilter(){

    $('#searchStore').keyup(function(){

        var searchText = $(this).val().toUpperCase();
        $('#store-filter div').each(function(){

            var currentLiText = jQuery(this).text(),
                showCurrentLi = currentLiText.toUpperCase().indexOf(searchText) !== -1;

            jQuery(this).toggle(showCurrentLi);

        });
    });

    $('#searchTag').keyup(function(){

        var searchText = $(this).val().toUpperCase();
        $('#tag-filter div').each(function(){

            var currentLiText = jQuery(this).text(),
                showCurrentLi = currentLiText.toUpperCase().indexOf(searchText) !== -1;

            jQuery(this).toggle(showCurrentLi);

        });
    });


    $('#searchBrand').keyup(function(){

        var searchText = $(this).val().toUpperCase();
        $('#cat-filter div').each(function(){

            var currentLiText = jQuery(this).text(),
                showCurrentLi = currentLiText.toUpperCase().indexOf(searchText) !== -1;

            jQuery(this).toggle(showCurrentLi);

        });
    });

    $('#searchCat').keyup(function(){
        var searchText = $(this).val().toUpperCase();
        $('#cat-filter div').each(function(){
            var currentLiText = jQuery(this).text(),
                showCurrentLi = currentLiText.toUpperCase().indexOf(searchText) !== -1;
                jQuery(this).toggle(showCurrentLi);
        });
    });

    $('#search-deal-Cat').keyup(function(){
        var searchText = $(this).val().toUpperCase();
        $('#deal-cat-filter div').each(function(){
            var currentLiText = jQuery(this).text(),
                showCurrentLi = currentLiText.toUpperCase().indexOf(searchText) !== -1;
                jQuery(this).toggle(showCurrentLi);
        });
    });
}
//get Deal ajax
function getDeals() {
  var cdf = '';

  $('.fdealcatiDs:checked').each(function()
    {
      cdf = cdf+''+ jQuery(this).val() +',';
    });

  $.ajax({
    method:'get',
    cache: false,
    url:DealUrl,
    data: { 'cat_filter':cdf,'ID':id,'_token': $('input[name=_token]').val()} ,
    success:function(response){
    },
    complete:function(response) {
    }
  }).done(function(data)
    {
        var Tid =   $('.coupondeal-tab  .active').attr('data-target');
        $(Tid).empty();
        $(Tid).html(data);
    })
    .fail(function(jqXHR, ajaxOptions, thrownError)
    {
          alert(noResponse);
    });
}

function Uncheck(id,type) {
    if(type == 'store') {
      $('#customCheck'+id+'s').prop('checked', false); // Unchecks it
    }
    if(type == 'tag') {
      $('#customCheck'+id+'t').prop('checked', false); // Unchecks it
    }
    if(type == 'brand') {
      $('#customCheck'+id+'b').prop('checked', false); // Unchecks it
    }
    if(type == 'cat') {
      $('#customCheck'+id+'s').prop('checked', false); // Unchecks it
    }
    if(type == 'location') {
      $('#customCheck'+id+'l').prop('checked', false); // Unchecks it
    }
    //mobile uncheck
    if(type == 'store') {
      $('#customCheck'+id+'sm').prop('checked', false); // Unchecks it
    }
    if(type == 'tag') {
      $('#customCheck'+id+'tm').prop('checked', false); // Unchecks it
    }
    if(type == 'brand') {
      $('#customCheck'+id+'bm').prop('checked', false); // Unchecks it
    }
    if(type == 'cat') {
      $('#customCheck'+id+'cm').prop('checked', false); // Unchecks it
    }
    // var hrefandType =   $('.coupon-tab   .active').attr('data-target').replace("#","");
    getAjaxTab(1);
}

function uncheckAll() {


    $('.fstoreiDs:checked').each(function()
      {

        $(this).prop('checked',false);
      });
    $('.ftagiDs:checked').each(function()
      {
        $(this).prop('checked',false);
      });
    $('.fbrandiDs:checked').each(function()
      {
        $(this).prop('checked',false);
      });
    $('.fcatiDs').each(function()
      {
        $(this).prop('checked',false);
      });
    $('.flocationiDs').each(function()
      {
        $(this).prop('checked',false);
      });
        getAjaxTab(1);
}
function unDealcheckAll() {
  $('.fdealcatiDs').each(function()
    {
      $(this).prop('checked',false);
    });
    getDeals();
}
function UncheckDeal(id,type) {

    if(type == 'cat') {
      $('#customDealCheck'+id+'c').prop('checked', false); // Unchecks it
      $('#customDealCheck'+id+'dcm').prop('checked', false); // Unchecks it

    }

    getDeals();
}

/* //ajax comment system
$(document).ready(function(e) {
	 $('a.closedetail').click(function() {
     $(this).closest('.collapse').collapse('hide');
   });
   $('.ajax-commentdeal').each(function() {
	   var $this = $(this);
	   var cmtid = $this.attr('id').replace('cpmnt','');

	new Comments.default({
      el: '#'+$this.attr('id'),
      pageId: cmtid,
      commentableId: cmtid,
      commentableType: "App.Coupons"
    });


   });
});
 */
//mobile filters
function openNav() {
  $('.wsmenucontainer').removeClass('wsoffcanvasopener');
  document.getElementById("mySidenav").style.width = "250px";
  //document.getElementById("mySidenavdeal").style.width = "250px";

    $('.cat-filter-overlap').css({"display": "block", "transition": "all 0.4s ease-in-out"});
}

function closeNav() {

  $('.cat-filter-overlap').css({"display": "none", "transition": "all 0.4s ease-in-out"});
   if($('#mySidenav').length != 0) {
    document.getElementById("mySidenav").style.width = "0";
    //document.getElementById("main").style.marginLeft= "0";
  }
  if($('#mySidenavdeal').length != 0) {
   document.getElementById("mySidenavdeal").style.width = "0";
   //document.getElementById("main").style.marginLeft= "0";
 }
}

//cb-popups
function openAjaxPopup(id,type,cb_enabled) {

	if( isLoggedin || cb_enabled=='N' )
	{
		if(type=='coupon')
		{
			var newtab = $("meta[property=og\\:url]").attr("content")+'#coupon-'+id;
			window.open(newtab);
			window.location.href = baseUrl+'/out/coupon/'+id;
		}
		else
		{
			if(type=='offer')
			type='coupon';
			if(type=='discount')
			type='coupon';

			var newtab =  baseUrl+'/out/'+type+'/'+id;
			window.open(newtab);
		}
	}
	if(type=='offer')
			type='coupon';
			if(type=='discount')
			type='coupon';

	var currUrl = window.location.href;
	$( "input[name='redirect_to']").val(currUrl+'#'+type+'-'+id);

	$('.social-login-ico a').each(function(sc){
						var shref = $(this).attr('href');
						if(shref.indexOf('?') > 1)
						shref = shref.substr(0,shref.indexOf('?'));

						$(this).attr('href', shref+'?redirect_to='+encodeURIComponent(currUrl+'#'+type+'-'+id));

	});


	var url = cbUrl;
    $.ajax({
      method:'post',
      cache: false,
      data: {id:id,type:type},
      url:url,
      success:function(response){
        $('#cb-common-popup').html(response);
        $("#cb-common-popup").modal('show');
      }
    });

	copyModal();
}
function isNumber(n) {
  return !isNaN(parseFloat(n)) && isFinite(n);
}

function copyModal()
{
	$('#cb-common-popup' ).on('click','.modal-copy',function(){

		var $this = $(this);

		$('#cb-common-popup #cpn_Code').select();
		document.execCommand("copy");
		$this.text('COPIED');
	});

	$('#cb-common-popup' ).on('keypress', '#cpn_Code',function (event) {
		event.preventDefault();
       return false;
	});

}
//subscribe whatsup
function subscribeWhatsApp(url,target) {

  if($('#whats_num').val() != '' ) {
    if(isNumber($('#whats_num').val())) {

    $.ajax({
      method:'Post',
      cache: false,
      data: {mobile_no:$('#whats_num').val(), '_token': $('input[name=_token]').val()},
      url:url,
      success:function(data){
        ToasterTargetedMessages(data.statusCode,data.msg,'.'+target);
        if(data.statusCode == 200) {
          $('#whats_num').val('')

        }
        }
      });
    }
    else {
      ToasterTargetedMessages(300,'Enter Valid Mobile number','.'+target);
    }
  }
  else {
     ToasterTargetedMessages(300,'Enter Mobile number','.'+target);
  }
}

// Offset issue fix
$(function() {

  //$('a[href*="#"]:not([href="#"]):not(.nav-link):not([data-toggle="collapse"])').click(function() {
   $('a.moveHash').click(function() {

    var offsetTop = $('header.sticky-top').outerHeight() + 24;
    //alert(offsetTop);

    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'')
&& location.hostname == this.hostname) {

      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top - offsetTop //offsets for fixed header
        }, 1000);
        return false;
      }
    }
  });
  //Executed on page load with URL containing an anchor tag.
  if($(location.href.split("#")[1])) {
	  var offsetTop = $('header.sticky-top').outerHeight() + 24;
      var target = $('#'+location.href.split("#")[1]);
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top - offsetTop //offset height of header here too.
        }, 1000);
        return false;
      }
    }
});

function searchCoupons()
{
  var keyword = $('#searchCoupons').val().toUpperCase();

  $('.store-cpn-tab .tab-pane.active .store-card-wrap').each( function(){
	  var title = $(this).find('h4').text();
	  var desc = $(this).find('#summary').text();
	        if (title.toUpperCase().indexOf(keyword) > -1 || desc.toUpperCase().indexOf(keyword) > -1)
				$(this).show();
			else
				$(this).hide();
  } );

}


function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}


function subscribeMailChamp(url,target) {
     if($('#subscriber-email').val() != '' ) {
       if(isEmail($('#subscriber-email').val())) {
         $.ajax({
           method:'Post',
           cache: false,
           data: {email:$('#subscriber-email').val(), '_token': $('input[name=_token]').val()},
           url:url,
           success:function(data){
                ToasterTargetedMessages(data.statusCode,data.msg,'.'+target);
               $('#subscriber-email').val('')
           }
         });
       }
       else {
            ToasterTargetedMessages(300,'Invalid Email','.'+target);
        }
      }
     else {
           ToasterTargetedMessages(300,'Enter Email Address First','.'+target);
     }

}
