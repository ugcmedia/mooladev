
<!-- Add blocker  -->
<div id="footeraddblocker" class="addd-blocckerr fixed-bottom" style="display:none;">
  <div class="container">
  <div class="row bg-white rounded">
    <div class="col-md-6 border-right">
      <div class="ad-alert">
        <div class="add-msgg mr-2">
        <i class="fa fa-exclamation-circle text-danger"></i>
      </div>
      <div class="msg-dics">
       <p class="mb-0 font-weight-bold">{{__('public/common.adblockSection.adtitle')}}</p>
       <span class="addd-notice">{{__('public/common.adblockSection.adsubtitle')}}</span>
      </div>
    </div>
    </div>
    <div class="col-md-6 m-auto text-center">
      <a href="{{url(__('public/common.adblockSection.adlink'))}}" class="addd-notice">{{__('public/common.adblockSection.adlinktext')}} <i class="fa fa-chevron-circle-right ml-2"></i></a>
    </div>
  </div>
</div>
</div>
<!-- //Add blocker  -->

<!--  subscribe -->
@if(!Request::is('/'))
  @include('public/homepage/partials/subscribe')
@endif
<!--  .subscribe -->

  <section id="mainFooter" class="footer-bttom div-inner-white pt-5">
    <div class="container">
      <div class="ft-bottom-links border-bottom pb-5">
        <div class="row">
          @php $getFooter = AppClass::getFooterLinks(); @endphp
    			@foreach($getFooter as $footer)
          <?php

            if($footer->footer_type == 'blog' ) {
              $colClass = "col-6 col-lg-4 col-md-4 col-sm-6";
            // } else if ($footer->footer_type == 'html') {
            //   $colClass = "col-12 col-lg-3 col-md-3 col-sm-6";
            } else {
              $colClass = "col-6 col-lg-2 col-md-2 col-sm-4";
            }
          ?>

            <div class=" {{$colClass}}">
              <div class="ft-link">
                <div class="widget-title text-dark fw-700">{{$footer->title}}</div>
                  <ul class="list-unstyled">
                    @if($footer->footer_type == 'page')
                    @php $fPages = AppClass::getPages($footer->pages); @endphp
                    @foreach($fPages as $key=>$page)
                      <li><a href="{{url($page['slug'])}}" class="success-link font-13 fw-400">{{str_ireplace('#REFAMT',config('settingConfig.mlm_split').'%',$page['title'])}}</a></li>
                    @endforeach
                    @endif
                    @if($footer->footer_type == 'store')
        							@foreach(AppClass::getStores($footer->stores) as $store)
                          <li><a href="{{url('store/'.str_slug($store->store_slug))}}" class="success-link font-13 fw-400">{{$store->store_name}}</a></li>
                    	@endforeach
        						@endif
                    @if($footer->footer_type == 'category')
                      @foreach(AppClass::getCat($footer->categories) as $cat)
                          <li><a href="{{url('category/'.str_slug($cat->cat_slug))}}" class="success-link font-13 fw-400">{{$cat->cat_name}}</a></li>
                      @endforeach
                    @endif
                    @if($footer->footer_type == 'blog')
                      @foreach(AppClass::getBlog($footer->blogs) as $blog)
                        <li class="f-bloglist">
                          <a class="success-link blogtitle font-13" href="{{url('blog').'/'.$blog->alias}}">
                            {!! substr($blog->title, 0, 75) . ""!!}
                          </a>
                          <div class="footer-blog-desc text-dark mt-1">
                            @if(strip_tags($blog->note) != '' && strip_tags($blog->note)  !=null)
                              {!! substr($blog->note, 0, 65) . "..."!!}
                            @endif
                        </div>
                        </li>

                      @endforeach
                      <a href="{{url(config('pageList.blog'))}}" class="success-link font-13 fw-400">View All Blogs</a>
                    @endif
                    @if($footer->footer_type == 'html')
                    <div class="ifhtml">
                      {!! $footer->html !!}
                    </div>
          					@endif
                  </ul>
              </div>
            </div>
            @endforeach
      </div>
    </div>
    <div class="copy-right pt-5">
      <div class="row">
        <div class="col-lg-4">
          <div class="footer-logo mb-4 text-center text-lg-left">
            <a href="#">
            <img src="{{asset('uploads/images/'.config('sximo.cnf_logo_dark'))}}" alt="">
            </a>
          </div>
        </div>

        <div class="col-lg-4 order-3 order-lg-2 mb-4 text-center">
          <p class="secondary-text font-13 fw-400 mb-0">
            {!! config('settingConfig.dev_footer')!!}</p>
        </div>

        <div class="col-lg-4 order-2 order-lg-3 mb-4 text-center text-lg-right">
          <div class="footer-social">
            {!! AppClass::getSocialFollow() !!}
            <!-- <ul class="list-inline">

              <a href="#"><li class="list-inline-item"><i class="fab fa-facebook-f"></i></li></a>
              <a href="#"><li class="list-inline-item"><i class="fab fa-twitter"></i></li></a>
              <a href="#"><li class="list-inline-item"><i class="fab fa-instagram"></i></li></a>
              <a href="#"><li class="list-inline-item"><i class="fab fa-youtube"></i></li></a>
            </ul> -->
          </div>
        </div>
      </div>
    </div>
    </div>
  </section>
  <button onclick="topFunction()" id="scrollTop" class="  " title="Go to top" style="display: none;"><i class="fa fa-angle-up mb-1" aria-hidden="true"></i></button>


<!-- footer script here -->
<script src="{{asset('public_assets/js/popper.min.js')}}"></script>
<script src="{{asset('public_assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('public_assets/js/owl.carousel.min.js')}}"></script>

<script type="text/javascript">
var isAdBlockActive= true;
</script>

<script src="{{asset('public_assets/js/ads.js')}}"></script>
<script>
			if(isAdBlockActive && isLoggedin && '<?php echo config('settingConfig.module_adblock');?>'==='Y')
			$('#footeraddblocker').show();
</script>
<?php if(Auth::guard('member')->id()) { ?>
<script src="https://js.pusher.com/4.3/pusher.min.js"></script>
  <script>


	function notifyMe(data) {
	  	  var options = {
	  	        body: data.message,
	  	        icon: "icon.jpg",
	  	        dir : "ltr"
	  	    };
	  	  var notification = new Notification(data.title,options);
	}
	Notification.requestPermission(function (permission) {
		if (Notification.permission === "granted") {
			Pusher.logToConsole = true;
			var pusher = new Pusher('51b9f9f451f4520cca1a', {
				cluster: 'ap2',
				forceTLS: true
			});
			var channel = pusher.subscribe("dealswoot-desktop-{{Auth::guard('member')->id()}}");
					channel.bind('my-event', function(data) {
						setTimeout(notifyMe(data), 3000);
					});
			}
		});

</script>
<?php } ?>
