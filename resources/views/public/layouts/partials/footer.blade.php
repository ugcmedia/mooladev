<!-- footer -->
<section class="footer pt-5 bg-dark">
  <div class="container">
    <div class="footer-top pb-5">
      <div class="row">
        <div class="col-lg-8">
          <div class="row">
            <div class="col-md-3 col-sm-6">
              <h4 class="font-16 fw-400 text-white mb-3">About</h4>
              <ul class="list-unstyled ft-link">
                <li><a href="{{url('about-us')}}" class="fm-arch text-white font-14 fw-400">{{__('public/homepage.about_us')}}</a></li>
                <li><a href="#" class="fm-arch text-white font-14 fw-400">{{__('public/homepage.moola101_creers')}} </a></li>
                <li><a href="#" class="fm-arch text-white font-14 fw-400"> {{__('public/homepage.privacy_policy')}} </a></li>
                <li><a href="#" class="fm-arch text-white font-14 fw-400"> {{__('public/homepage.terms_conditions')}}  </a></li>
                <li><a href="{{url('how-it-works')}}" class="fm-arch text-white font-14 fw-400">{{__('public/homepage.how_moola101_works')}}</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-6">
              <h4 class="font-16 fw-400 text-white mb-3">{{__('public/homepage.explore')}} </h4>
              <ul class="list-unstyled ft-link">
                <li><a href="http://moola101.ga/all-stores" class="fm-arch text-white font-14 fw-400">{{__('public/homepage.all_stores')}} </a></li>
                <li><a href="#" class="fm-arch text-white font-14 fw-400">{{__('public/homepage.store_directory')}}</a></li>
                <li><a href="#" class="fm-arch text-white font-14 fw-400">{{__('public/homepage.blog')}}</a></li>
                <li><a href="#" class="fm-arch text-white font-14 fw-400">{{__('public/homepage.cashback_buddy')}}</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-6">
              <h4 class="font-16 fw-400 text-white mb-3">{{__('public/homepage.help_and_support')}}</h4>
              <ul class="list-unstyled ft-link">
                <li><a href="{{url('faq')}}" class="fm-arch text-white font-14 fw-400">{{__('public/homepage.faq')}}</a></li>
                <li><a href="#" class="fm-arch text-white font-14 fw-400">{{__('public/homepage.support')}}</a></li>
                <li><a href="#" class="fm-arch text-white font-14 fw-400">{{__('public/homepage.get_in_touch')}}</a></li>
                <li><a href="#" class="fm-arch text-white font-14 fw-400">{{__('public/homepage.affiliates')}}</a></li>
                <li><a href="{{url('contact-us')}}" class="fm-arch text-white font-14 fw-400">{{__('public/homepage.contact_us')}}</a></li>
              </ul>
            </div>
            <div class="col-md-3 col-sm-6">
              <h4 class="font-16 fw-400 text-white mb-3">{{__('public/homepage.follow_us')}}</h4>
              <ul class="ft-social-icons list-inline">
                  <li class="list-inline-item btn-facebook">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                  </li>
                  <li class="list-inline-item btn-twitter">
                    <a href="#"><i class="fab fa-twitter"></i></a>
                  </li>
                  <li class="list-inline-item btn-google ">
                    <a href="#"><i class="fab fa-google-plus-g"></i></a>
                  </li>
                  
                  <li class="list-inline-item btn-linked-in">
                    <a href="#"><i class="fab fa-linkedin-in"></i></a>
                  </li>
              </ul>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="ft-get-app rounded">
            <div class="row no-gutters">
              <div class="col-6">
                <img src="{{asset('public_assets/images/vector_hand.png')}}" class="img-fluid" alt="">
              </div>
              <div class="col-6">
                <div class="ft-get-app-cont">
                  <h3 class="text-white font-24 fw-400 mb-3">{{__('public/homepage.get_the_app')}}</h3>
                  <div class="download-app-stores">
                    <a href="#" class="d-block mb-3">
                    <img src="{{asset('public_assets/images/ft_app.png')}}" class="img-fluid mr-3" alt="">
                    </a>
                    <a href="#" class="d-block">
                    <img src="{{asset('public_assets/images/ft_and.png')}}" class="img-fluid" alt="">
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="copy-right p-3">
      <p class="mb-0 fm-arch text-white font-14 fw-400 text-center">{{__('public/homepage.copyright')}}</p>
    </div>
  </div>
</section>

<button onclick="topFunction()" id="scrollTop" class="  " title="Go to top" style="display: none;"><i class="fa fa-angle-up mb-1" aria-hidden="true"></i></button>

<script type="text/javascript" src="{{asset('public_assets/js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public_assets/js/popper.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public_assets/js/bootstrap.min.js')}}"></script>
<!-- <script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script> -->
<script type="text/javascript" src="{{asset('public_assets/js/owl.carousel.js')}}"></script>
<script type="text/javascript" src="{{asset('public_assets/js/app.js')}}"></script>
<!-- <script src="js/app.js"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.js"></script>
<script type="text/javascript">
// Read more and toggleClass

var text = $('.text-overflow'),
     btn = $('.btn-overflow'),
       h = text[0].scrollHeight;

if(h > 120) {
	btn.addClass('less');
	btn.css('display', 'block');
}

btn.click(function(e)
{
  e.stopPropagation();

  if (btn.hasClass('less')) {
      btn.removeClass('less');
      btn.addClass('more');
      btn.text('Show less');

      text.animate({'height': h});
  } else {
      btn.addClass('less');
      btn.removeClass('more');
      btn.text('Show more');
      // text.animate({'height': '120px'});
  }
});
</script>

</body>
</html>
