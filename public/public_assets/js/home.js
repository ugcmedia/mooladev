$(document).ready(function() {
  $('#hp_testinomial').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    singleItem:true,
    navText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:1
        }
    }
  })


  //if($('.hidden-lg-down').is(":hidden"))
	  if(true)
  {


  $('.best-deals-owl').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    navText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:2
        },
        1000:{
            items:4
        }
    }
  });

  $('.best-deals-owl-cat').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    navText:['<i class="fa fa-angle-left" aria-hidden="true"></i>','<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    responsive:{
        0:{
            items:1
        },
        600:{
            items:1
        },
        1000:{
            items:4
        }
    }
  });

  }
  else {
   $('#best-deals-owl').removeClass('owl-carousel')
   $('#best-deals-owl').removeClass('owl-theme')
   $('#best-deals-owl').removeClass('d-block')

   $('#best-deals-owl').addClass('row')
   $('#best-deals-owl .item').addClass('col-lg-3 col-sm-6')

   $('#best-deals-owl-cat').removeClass('owl-carousel')
   $('#best-deals-owl-cat').removeClass('owl-theme')
   $('#best-deals-owl-cat').removeClass('d-block')

   $('#best-deals-owl-cat').addClass('row')
   $('#best-deals-owl-cat .item').addClass('col-lg-3 col-sm-6')

  }

      scrollFunction();
      var $this = $('[data-toggle="btabajax"]'),
          loadurl = $this.attr('href'),
          targ = $this.attr('data-target');
      $.get(loadurl, function(data) {
          $(targ).html(data);
      });

      return false;
});

$('[data-toggle="btabajax"]').click(function(e) {
    e.preventDefault();
    var $this = $(this),
        loadurl = $this.attr('href'),
        targ = $this.attr('data-target');

    $.get(loadurl, function(data) {
        $(targ).html(data);

        if (window.location.hash && window.location.hash.indexOf('cpn') > 0)
 			 {
 				$(window.location.hash).click();
 		 	}

    });

    $this.tab('show');
    return false;
});
