//start smooth scroll top
 window.onscroll = function() {scrollFunction()};

function scrollFunction() {

  if (document.body.scrollTop > 200 || document.documentElement.scrollTop > 200) {
          $('#return-to-top').fadeIn(200);
          document.getElementById("scrollTop").style.display = "block ";
  } else {
      document.getElementById("scrollTop").style.display = "none  ";
  }
}

function topFunction() {
 $('html,body').animate({ scrollTop: 0 }, 1000, function () {
  });
}
$('#wsnavtoggle').click(function(){
    closeNav();
});
function readmoredesc(eleid, readmore) {
  var descele = $('#'+eleid);
  if(descele.hasClass('full')) {
    descele.removeClass('full');
    $('.'+readmore).text('+ Read More');
  } else {
    descele.addClass('full')
    $('.'+readmore).text('- Read Less');
  }
}
// Search Box overlay

// open the full screen search box
 function openSearch() {
   document.getElementById("myOverlay").style.display = "block";
   document.getElementById("myOverlay").style.transition = "0.5s";
   $("#searchTxt").focus();
 }
 function closeSearch() {
   document.getElementById("myOverlay").style.display = "none";
 }
 function uncheckAll() {
   var type =   $('.nav-pills  .active').attr('data-target').replace("#","");
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
       getAjaxTab(1,type);
 }

jQuery(function($) {
  $('#already-sub').hide();
  storeSearchable();
});

$('.owl-testimonial').owlCarousel({
  loop:true,
  margin:10,
  nav:true,
  navText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
  responsive:{
      0:{
          items:1
      },
      600:{
          items:3
      },
      1000:{
          items:3
      }
  }
})




  function getComments(cid,type,url) {
  //  $('.couponComment').show();
  //  $('.couponDetail').hide();
  $('#v-offer-detail-'+cid+''+type).collapse('hide');
    type.replace('&quot;', '')
    $.ajax({
      method:'get',
      cache: false,
      data: {coupon_id:cid,divId:type, '_token': $('input[name=_token]').val()},
      url:url,
      success:function(response){
        $('#comments'+cid+''+type+'').html(response);
      }
    });
  }

  function checkSubscribed(catID,type,url) {
    $.ajax({
      method:'Post',
      cache: false,
      data: {id:catID,o_type : type, '_token': $('input[name=_token]').val()},
      url:url,
      success:function(data){
        if(data == 1) {
          $('#s-subscribe-mdl').hide();
          $('#already-sub').show();
        }
      }
    });
  }


function addFollow(storeID,type,url) {

      $.ajax({
        method:'Post',
        cache: false,
        data: {id:storeID,o_type:type, '_token': $('input[name=_token]').val()},
        url:url,
        success:function(data){
          if(data == 1) {
            toastr.success('Successfully subscribed to  !', 'Success');
            $('#s-subscribe-mdl').hide();
            $('#already-sub').show();
          }
          if(data == 0) {
            toastr.error('I do not think that word means what you think it means.', 'Inconceivable!')
            $('#s-subscribe-mdl').show();
            $('#already-sub').hide();
          }
          if(data == 2) {
            $('#s-subscribe-mdl').hide();
            $('#already-sub').show();
          }
      }
    });
}

$(document).ready(function(){


  // $('.ftagiDs').on('change',function(){
  //   var hrefandType =   $('.nav .active').attr('href');
  //   var target      =   $('.nav .active').attr('data-target');
  //   getAjaxTab(false, null, null,target,hrefandType);
  //   });
  // $('.fbrandiDs').on('change',function(){
  //   var hrefandType =   $('.nav .active').attr('href');
  //   var target      =   $('.nav .active').attr('data-target');
  //   getAjaxTab(false, null, null,target,hrefandType);
  //  });
  // $('#cat-tag-filter li .c-filter-remove').on('click',function(){
  //   var hrefandType =   $('.nav .active').attr('href');
  //   var target      =   $('.nav .active').attr('data-target');
  //   getAjaxTab(false, null, null,target,hrefandType);
  // });
  // $('.fstoreiDs').on('change',function(){
  //   var hrefandType =   $('.nav .active').attr('href');
  //   var target      =   $('.nav .active').attr('data-target');
  //   getAjaxTab(false, null, null,target,hrefandType);
  // });

//   $('.fcatiDs').on('change',function(){
//
//     var sf = '';
//     var hrefandType =   $('.nav .active').attr('href');
//     var target      =   $('.nav .active').attr('data-target');
//     getAjaxTab(false, null, null,target,hrefandType);
// //    getAjaxTab();
//   });

  jQuery("#read-moreDesc").click(function(){
  		if(jQuery(this).parents('.d-lg-inline-flex').find('.title-main').hasClass('title-disc')) {
          jQuery(this).parents('.d-lg-inline-flex').find('.title-main').removeClass('title-disc')
          jQuery(this).parents('.d-lg-inline-flex').find('.title-main').addClass('title-disc-full')
  		  	jQuery(this).html('- Read less');
  	    } else {
          jQuery(this).parents('.d-lg-inline-flex').find('.title-main').removeClass('title-disc-full')
          jQuery(this).parents('.d-lg-inline-flex').find('.title-main').addClass('title-disc')
          jQuery(this).html('+ Read More');
  	    }
  });

});
// floating div when scroll down
$(function() {
// Set this variable with the height of your sidebar + header
// var offsetPixels = 1000;
//
// $(window).scroll(function() {
//
//   if ($(window).scrollTop() > offsetPixels) {
//
//     $( ".scrollingBox" ).css({
//       "position": "fixed",
//       "top": "76px"
//     });
//   } else {
//     $( ".scrollingBox" ).css({
//       "position": "static" ,
//         //  "z-index": "-1"
//     });
//   }
// });
var topPos = $('.sidebarBox').outerHeight() + 40;
var headerHeight = $(".header-top").outerHeight() + 10;
var sidebarWidth = $(".sidebarBox").width();
//console.log(topPos+"-topPos");
$(window).scroll(function () {
  //console.log($(document).scrollTop()+"-top");

    var top = $(document).scrollTop()
        margb = 60,// отступ от #colophon
        pip = ($('section.footer').offset().top) - margb,

        height = $('#stickFilter').outerHeight();

        //height = $('.sidebarBox').outerHeight();
        //console.log(pip+"-pip");
        //console.log(height+"-height");
        //alert($('#stickFilter').outerHeight());
    if (top > topPos && top < pip - height && screen.width >= '1250') {

      console.log('aaaa');
        $('#stickFilter').addClass('filterFixed shadow rounded').removeAttr("style");
        $( "#stickFilter" ).css({ "top": headerHeight+"px", "width":  sidebarWidth+"px" });
        //$('.cashback-time-wrap').css({'position':'absolute', 'width':'280px', 'top':'440px'});
    } else if (top > pip - height && screen.width >= '1250') {
      console.log('bbbbb');
        $('#stickFilter').removeClass('filterFixed shadow rounded').css({'position': 'absolute', 'top': pip - height - topPos});// отступ от #colophon
        //$('.cashback-time-wrap').css({'position':'relative', 'width':'280px', 'top':'0'});
    } else {
      // console.log('cccc');
        $('#stickFilter').removeClass('filterFixed shadow rounded');
        $( "#stickFilter" ).css({'position': 'static', "top": "auto", "width": "100%" });
    }
});
});

// cat-tag-filter remove
$(document).ready(function(c) {
  $('#cat-tag-filter li i').on('click', function(c){
      $(this).parent().fadeOut('slow', function(c){
      });
  });
});
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

      $('#customCheck'+id+'c').prop('checked', false); // Unchecks it
    }
    var hrefandType =   $('.nav-pills  .active').attr('data-target').replace("#","");
    // var page         =  $('.nav-pills  .active').attr('href').split('page=')[1];

    getAjaxTab(1,hrefandType);
    //getAjaxTab();
}
function copyRefLink()
{
	var varCpy = $('#copyLink');
	varCpy.select();
	 document.execCommand("copy");
	 $('.copyLinkBtn').text('Copied');
}
// cat-filter-offcanva
function openNav() {

  $('.wsmenucontainer').removeClass('wsoffcanvasopener');
  document.getElementById("mySidenav").style.width = "250px";
  // document.getElementById("main").style.marginLeft = "250px";
  // document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
  //document.body.classList.add("cat-filter-overlap");
    $('.cat-filter-overlap').css({"display": "block", "transition": "all 0.4s ease-in-out"});

}

function closeNav() {
  $('.cat-filter-overlap').css({"display": "none", "transition": "all 0.4s ease-in-out"});
   if($('#mySidenav').length != 0 && $('#main').length != 0) {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft= "0";
  }
}

function storeSearchable(){

    $('#searchStore').keyup(function(){

        var searchText = $(this).val().toUpperCase();
        $('.store-widget-list ul > li').each(function(){

            var currentLiText = jQuery(this).text(),
                showCurrentLi = currentLiText.toUpperCase().indexOf(searchText) !== -1;

            jQuery(this).toggle(showCurrentLi);

        });
    });

    $('#searchTag').keyup(function(){

        var searchText = $(this).val().toUpperCase();
        $('.tag-widget-list ul > li').each(function(){

            var currentLiText = jQuery(this).text(),
                showCurrentLi = currentLiText.toUpperCase().indexOf(searchText) !== -1;

            jQuery(this).toggle(showCurrentLi);

        });
    });


    $('#searchBrand').keyup(function(){

        var searchText = $(this).val().toUpperCase();
        $('.brand-widget-list ul > li').each(function(){

            var currentLiText = jQuery(this).text(),
                showCurrentLi = currentLiText.toUpperCase().indexOf(searchText) !== -1;

            jQuery(this).toggle(showCurrentLi);

        });
    });

    $('#searchCat').keyup(function(){
        var searchText = $(this).val().toUpperCase();
        $('.cat-widget-list ul > li').each(function(){
            var currentLiText = jQuery(this).text(),
                showCurrentLi = currentLiText.toUpperCase().indexOf(searchText) !== -1;

            jQuery(this).toggle(showCurrentLi);

        });
    });

}




$(document).ready(function() {

    // $(".list-group-item").on("click", function() {
    //      $(this).siblings().removeClass('active');
    //      $(this).addClass("active");
    //  });

	if($('[data-toggle="btabajax"]').length > 0)
	{
      var $this = $('[data-toggle="btabajax"]'),
          loadurl = $this.attr('href'),
          targ = $this.attr('data-target');
      $.get(loadurl, function(data) {
          $(targ).html(data);
      });

	}
});

$('[data-toggle="btabajax"]').click(function(e) {
    e.preventDefault();
    var $this = $(this),
        loadurl = $this.attr('href'),
        targ = $this.attr('data-target');

    $.get(loadurl, function(data) {
        $(targ).html(data);
    });

    $this.tab('show');
    return false;
});

function isEmail(email) {
  var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  return regex.test(email);
}

function subscribeMailChamp(url) {

     if($('#subscriber-email').val() != '' ) {
       if(isEmail($('#subscriber-email').val())) {
         $.ajax({
           method:'Post',
           cache: false,
           data: {email:$('#subscriber-email').val(), '_token': $('input[name=_token]').val()},
           url:url,
           success:function(data){
               toastr.success('Successfully subscribed to Newsletter !', 'Success');
               $('#subscriber-email').val('')
           }
         });
     }
     else {
       toastr.error('Please enter valid email !', 'error');
     }
   }
     else {
         toastr.error('Please Enter Email Address !', 'error');
     }
}



	(function ($) {
	$.fn.countTo = function (options) {
		options = options || {};

		return $(this).each(function () {
			// set options for current element
			var settings = $.extend({}, $.fn.countTo.defaults, {
				from:            $(this).data('from'),
				to:              $(this).data('to'),
				speed:           $(this).data('speed'),
				refreshInterval: $(this).data('refresh-interval'),
				decimals:        $(this).data('decimals')
			}, options);

			// how many times to update the value, and how much to increment the value on each update
			var loops = Math.ceil(settings.speed / settings.refreshInterval),
				increment = (settings.to - settings.from) / loops;

			// references & variables that will change with each update
			var self = this,
				$self = $(this),
				loopCount = 0,
				value = settings.from,
				data = $self.data('countTo') || {};

			$self.data('countTo', data);

			// if an existing interval can be found, clear it first
			if (data.interval) {
				clearInterval(data.interval);
			}
			data.interval = setInterval(updateTimer, settings.refreshInterval);

			// initialize the element with the starting value
			render(value);

			function updateTimer() {
				value += increment;
				loopCount++;

				render(value);

				if (typeof(settings.onUpdate) == 'function') {
					settings.onUpdate.call(self, value);
				}

				if (loopCount >= loops) {
					// remove the interval
					$self.removeData('countTo');
					clearInterval(data.interval);
					value = settings.to;

					if (typeof(settings.onComplete) == 'function') {
						settings.onComplete.call(self, value);
					}
				}
			}

			function render(value) {
				var formattedValue = settings.formatter.call(self, value, settings);
				$self.html(formattedValue);
			}
		});
	};

	$.fn.countTo.defaults = {
		from: 0,               // the number the element should start at
		to: 0,                 // the number the element should end at
		speed: 1000,           // how long it should take to count between the target numbers
		refreshInterval: 100,  // how often the element should be updated
		decimals: 0,           // the number of decimal places to show
		formatter: formatter,  // handler for formatting the value before rendering
		onUpdate: null,        // callback method for every time the element is updated
		onComplete: null       // callback method for when the element finishes updating
	};

	function formatter(value, settings) {
		return value.toFixed(settings.decimals);
	}
}(jQuery));

jQuery(function ($) {
  // custom formatting example
  $('.count-number').data('countToOptions', {
	formatter: function (value, options) {
	  return value.toFixed(options.decimals).replace(/\B(?=(?:\d{3})+(?!\d))/g, ',');
	}
  });

  // start all the timers
  $('.timer').each(count);

  function count(options) {
	var $this = $(this);
	options = $.extend({}, options || {}, $this.data('countToOptions') || {});
	$this.countTo(options);
  }
});

function copyCoupon(unID)
{

   $('#popCopyCode').select();
   document.execCommand("copy");
   unID.innerHTML = 'COPIED' ;
   setInterval(function(){ unID.innerHTML = 'Copy'; }, 5000);

}


  //ajax popup
  function openAjaxPopup(id, type, poponly=false) {


	var url = cbUrl;
	var currUrl = nowUrl;

	var otype = type;
	if(type=='storeCat')
		otype = 'store-cat';
	if(type=='discount')
		otype = 'coupon';

	if(!poponly)
	{
  	if(isLoggedin && type!='coupon')
  		window.open(baseUrl+'/out/'+otype+'/'+id);
  	else if(isLoggedin && type=='coupon')
  	{ window.open(nowUrl+'#coupon-'+id);
  	              window.location.href = baseUrl + '/out/coupon/' + id;
  	}
	}

    if(type=='discount')
		type = 'coupon';

    $("input[name='redirect_to']").val(currUrl + '#' + type + '-' + id);

	    $('.join-opt a.btn').each(function(sc) {
        var shref = $(this).attr('href');
        if (shref.indexOf('?') > 1)
            shref = shref.substr(0, shref.indexOf('?'));
        $(this).attr('href', shref + '?redirect_to=' + encodeURIComponent(currUrl + '#' + type + '-' + id));
    });
    //alert(url);

      $.ajax({
        method:'post',
        cache: false,
        data: {id:id,type:type},
        url:url,
        success:function(response){
          //alert(response);
          $('#common-popup').html(response);
          $("#common-popup").modal('show');

        }
      });
  }


$(document).ready(function() {
  $('#showRefer').click(function() {
    $('#referInput').toggle();
  });
});







//hide or show password


// open the full screen search box
//  function openSearch() {
//    document.getElementById("myOverlay").style.display = "block";
// }
//
// // Close the full screen search box
// function closeSearch() {
// document.getElementById("myOverlay").style.display = "none";
// }
$(document).ready(function(e) {
	 $('a.closedetail').click(function() {
     $(this).closest('.collapse').collapse('hide');
   });

    $('.openCmt').click( function(){
		var cmtid = $(this).data('target').replace('#cpnCmt','');
		new Comments.default({
      el: '#cpmnt'+cmtid,
      pageId: cmtid,
      commentableId: cmtid,
      commentableType: "App.Coupons"
    });

	} );
   /* $('.ajax-comment').each(function() {
	   var $this = $(this);
	   var cmtid = $this.attr('id').replace('cpmnt','');

	new Comments.default({
      el: '#'+$this.attr('id'),
      pageId: cmtid,
      commentableId: cmtid,
      commentableType: "App.Coupons"
    });


   }); */
});

// $(function () {
//
//
// $(window).scroll(function() {
//   var scroll = $(window).scrollTop();
//   if (scroll > 0) {
//      $(".header-top").css({"box-shadow": "0 2px 4px 0 rgba(0,0,0,.4)"});
//
//   }
//   else {
//         $(".header-top").css({"box-shadow": "none"});
//   }
//     });
// })



jQuery(function($) {
	var alphaList = [];
$('.store-card').each( function(e){
	 alphaList.push(($(this).data('alpha')));
} );
alphaList= unique(alphaList).sort();

	$('#alpha-filter').append('<a class="nav-link active filAll" href="javascript:void(0)" onClick="filterAlpha(\'#\')">All</a> ');
	$.each(alphaList, function( index, value ) {
		$('#alpha-filter').append('<a class="nav-link fil'+value+'" href="javascript:void(0)" onClick="filterAlpha(\''+value+'\')">'+value+'</a> ');
	});

});

function unique(array) {
    return $.grep(array, function(el, index) {
        return index == $.inArray(el, array);
    });
}

function filterAlpha(alpha)
{
	$('#alpha-filter .nav-link').removeClass('active');
	if(alpha=='#')
	{
		$('.store-card').show();
		$('#alpha-filter .filAll').addClass('active');
	}
		else
		{
			$('.store-card').hide();

			$(".store-card[data-alpha='"+alpha+"']").show();
			$('#alpha-filter .fil'+alpha).addClass('active');
		}


}
fncReadless();
function fncReadless() {
    $("#longtext").addClass("parrafContract ");
    $("#readless").hide();
    $("#readmore").show();
}
function fncReadmore() {
    $("#longtext").removeClass("parrafContract ");
    $("#readless").show();
    $("#readmore").hide();
}


/* Sticky Header style */
(function(){

  //alert('ssss');

  var header = $(".headtoppart").wrap(),
          headHeight = header.height(),
          triggerPosition = 0,
          lastScrollPosition = $(window).scrollTop(),
          //searchField = $("#store_name", header),
          //catMenuClasses = document.getElementById("nav-tab1").classList,
          //acctMenuClasses = ebates.user.loggedIn && document.querySelector(".user .account-menu").classList,
          stopAfter = 15000,
          posTimer = setInterval(function(){
              triggerPosition = $(".header-wrapper").offset().top;
              triggerPosition < 5 && header.addClass("top-0") || header.removeClass("top-0");
          }, 200),  // update in case some element is dynamically inserted above header (ABP warning, promo timer...)
          // adjustAnchorScroll = function(){
          //     var hash = this.hash || location.hash;
          //     hash.length > 1 && setTimeout(function(){window.scrollBy(0, hash === "#top" && -(header.height() + 5));}, 50);
          // },
          unminimize = function(){ console.log('unminimize'); header.removeClass("minh"); },
          minimize = function(){
              // var suggestEl = $(".ac_results");
              // if(suggestEl.length !== 0 && suggestEl.is(":visible") || catMenuClasses.contains("active") || acctMenuClasses && acctMenuClasses.contains("active")) {
              //   return;
              // }
              //alert('minimize');
              //console.log('minimize');
              header.addClass("minh");
          };
  console.log(lastScrollPosition);
  $(header).on("mouseenter mouseover focus", unminimize)
  $(window).on("scroll", function(){
    //alert('aa');
      var gap = $(window).scrollTop(),
      isFixed = header.hasClass("fixed"),
      scrollingUp = gap < lastScrollPosition;
      gap > triggerPosition ? (!isFixed && header.addClass("fixed")) : isFixed && header.removeClass("fixed");
      if(isFixed){
          if(scrollingUp){
              gap < headHeight && header.removeClass("minh") || minimize();
          } else {
              gap > headHeight && minimize();
          }
      }
      header.css({left: -$(window).scrollLeft()});
      lastScrollPosition = gap;
  });

})();
/* .Sticky Header style */
