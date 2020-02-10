@section('title')
  {!! $data['pageInfo']->title!!}
@endsection
@include('public/layouts/partials/head')

@include('public/cashback-partials/auth-popups.login-popup')
  @include('public/cashback-partials/auth-popups.join-us-popup')
  @include('public/cashback-partials/auth-popups.forgot-password-popup')
  @include('public/cashback-partials/auth-popups.toaster_msg_js')

<link rel="stylesheet" href="{{asset('public_assets/css/near-me.css')}}">
<!-- <div class="container-fluid"> -->
<div class="nearme-body" >
<script>
var myLocation  = {<?php echo 'lat:'.$data['myLat'].',lng:'.$data['myLong'];?>};
var isLoggedin = <?php if(Auth::guard('member')->check()) { echo 1; } else { echo 0; }  ?>;
var cbUrl = '<?php echo route('getAjaxPopup.common'); ?>';
  var baseUrl = '<?php echo url('/');?>';
</script>
<div class="near-me-header  primary-section">
  <div class="row">
    <div class="col-md-3 my-auto">
      <a href="{{url('/')}}" class="success-text back-to">{{__('public/nearme.back_to')}}</a>
    </div>
    <div class="col-md-8">
      <div class="n-header-logo  text-center">
        <a href="{{url('/')}}">
        <img src="{{asset('uploads/images/'.config('sximo.cnf_logo_light'))}}" alt=""></a>
        <a class="d-md-none map-mobile-ico float-right" id="show_map"><i class="fas fa-map-marker-alt "></i> Map</a>
        <a class="d-md-none map-mobile-ico float-right" id="show_list"><i class="fas fa-list"></i> List</a>
      </div>
    </div>
  </div>
</div>


  <div class="alert alert-warning text-center" id="alert_access" style="display:none">
    <strong>Warning!</strong> Please allow location access for accuracy
  </div>

      <div class="near-me-sidebar-cont lg-block md-block"  >
        <div id="no-more-cat">
        <div class="text-center mb-3">
          <h2 class="font-15 fw-700 text-muted text-center" id="cityName" >{{__('public/nearme.best_deal_in',['location'  => $userLocation[0]['geoplugin_city']])}} </h2>
          <a href="#" class="primary-link font-15 fw-700" id="changeLoc">{{__('public/nearme.change_location')}}</a>
            <div class="form-group" id="searchForm">
              <label for="location">{{__('public/nearme.search_location')}}</label>
                <div class="row p-0  m-0">
                    <div class="col-1">
                      <span class="mt-4" id="back_to"><i class="fas fa-arrow-left"></i></span>
                    </div>
                    <div class="col-11">
                      <input type="text" class="form-control" id="location_keyword" name="keyword" autocomplete="off" placeholder="{{__('public/nearme.search_loc_placeholder')}}">
                    </div>
                </div>
            </div>
           <div id="dropDown">

           </div>

		   <a href="{{url('/near-me/') }}" class="primary-link font-15 fw-700" id="myLoc">My Location</a>

        </div>

        <div class="" id="display_toggle">
        <div class="location-no-result text-center pb-4 d-none hide">
          <img src="{{('public_assets/images/location.svg')}}" class="img-fluid" alt="">
          <p class="secondary-text font-12 fw-400">{{__('public/nearme.try_adjust_txt')}}</p>
        </div>

        @if($data['showSide'])
        <div class="" id="sub-sidebar" >
		@if($data['store_cat_name']=='' || $data['store_cat_name']=='Null'  )
         <div class="near-me-cat" >
          <ul class="list-inline">
            @php $i=0; @endphp
            @foreach($data['store_cat'] as $storeCat)
            @if($i  == 5)
              @php break; @endphp
                @endif
              <li class="list-inline-item near-me-cat-button bg-white shadow-sm">
                <a href="{{url('near-me/'.str_slug($storeCat->slug))}}" class="primary-link text-center">
                  <img src="{{asset('uploads/images/category/'.$storeCat->store_cat_icon)}}" class="mb-3"  alt="">
                  <p class="font-12 fw-400 mb-0">{{$storeCat->store_cat_name}}</p>
                </a>
              </li>

              @php $i++; @endphp
            @endforeach
            <li class="list-inline-item near-me-cat-button bg-white shadow-sm">
              <a href="#" id="more_cat_show" class="primary-link text-center">
                <!-- <img src="{{asset('uploads/images/category/'.$storeCat->store_cat_icon)}}" class="mb-3"  alt=""> -->
                <p class="font-12 fw-400 mb-0">More</p>
                <p class="font-36 fw-400 mb-0">...</p>

              </a>
            </li>
          </ul>

        </div>
		@endif

        <div class="near-me-offers-list ">

		@if($data['store_cat_name']!='' && $data['store_cat_name']!='Null'  )
			<h3>Offers for - {{$data['store_cat_name']}}</h3>
			<a href="{{ url('/near-me/') }}">All Offers</a>
		@endif

          @foreach($data['outlat_data'] as $store)
          @php
            $totalCount   = 0;
            $getData = explode('|',$store->offers_count);
            $totalCount = $getData[0];
          @endphp
            <div class="offer-cont-box bg-white rounded shadow-sm mb-3 ofstore" id="str{{$store->outlet_id}}">
              <div class="row p-3">
                <div class="col-4">
                  <img src="{{asset('uploads/images/store').'/'.$store->store_logo}}" class="img-fluid" alt="{{$store->store_name}}">
                  <p class="secondary-text font-12 fw-700 text-center mt-1">{{$totalCount}} offers</p>

                </div>
                <div class="col-8">
                  <div class="offer-item-body">
                    <span class="secondary-text text-right float-right font-12 fw-700 "><i class="fas fa-map-marker-alt mr-1"></i> {{round($store->distance_in_km,2)}}  km</span>
                    <p class="font-13 text-dark fw-600">
                      {{$store->store_name}} - {{$store->outlet_name}}
                    </p>

                    <div class="row no-gutters">
					                 <div class="col-6 shadow-btn ">
                            <a onclick="openAjaxPopup({{$store->store_id}},'store','{{$store->cashback_enabled}}')" class="btn btn-secondary p-2 font-12 text-uppercase my-2">{{__('public/nearme.btn_shop_now')}}</a>
                          </div>
            					<div class="col-6 shadow-btn ">
            					<a href="{{url('store/'.str_slug($store->store_slug))}}" class="ml-2 btn btn btn-primary text-uppercase font-13 fw-400 my-2" target="_blank">{{__('public/nearme.btn_view_offer')}}</a>
            				   </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          @endforeach
        </div>

      </div>
      @endif


        <div class="row  ">
        @php $i = 0; $getFooter = AppClass::getFooterLinks(); @endphp
        @foreach($getFooter  as $key=>$footer)
          @if($i == 4)
          @php  break; @endphp
          @endif
          <div class="col-6  col-lg-6 col-md-6 col-sm-6">
            <div class="ft-link">
              <h2 class="widget-title  text-dark fw-700">{{$footer->title}}</h2>
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
                  @endif
                  @if($footer->footer_type == 'html')
                  <div class="ifhtml">
                    {!! $footer->html !!}
                  </div>
                  @endif
                </ul>
            </div>
          </div>
            @php $i++; @endphp
          @endforeach
        </div>
          </div>
        <div class="copy-right pb-3 ">
          <div class="row">
            <div class="col-lg-12 ">
              <div class="footer-logo mb-4 text-center ">
                <a href="#">
                <img src="{{asset('uploads/images/'.config('sximo.cnf_logo_dark'))}}" alt="">
                </a>
                <p class="secondary-text font-13 fw-400 mb-0">
                  {!! config('settingConfig.dev_footer')!!}</p>
              </div>
            </div>
          </div>

        </div>

      </div>
      <div class="p-0" id="more-cat">
          <span class="mt-4"  id="back_to_cat"><i class="fas fa-arrow-left"></i></span>
        <ul class="list-group list-group-flush">
          @foreach($data['store_cat'] as $storeCat)
            <li class="list-group-item">
              <a class="success-link blogtitle font-13" href="{{url('near-me/'.str_slug($storeCat->slug))}}">
                {{$storeCat->store_cat_name}}
              </a>
            </li>
          @endforeach
        </ul>
      </div>
      </div>

      <div class="map-responsive near-me-map	" id="nearme-map">
          {!!  Mapper::render() !!}

      </div>
      <div class="setFocusStoreMobile">

      </div>
    </div>
    <div class="modal fade" id="cb-common-popup" tabindex="-1" role="dialog" aria-labelledby="common-popup" aria-hidden="true"></div>


<!-- </div> -->
<script src="{{asset('public_assets/js/popper.min.js')}}"></script>
<script src="{{asset('public_assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript">
$(function () {
  $('#searchForm').hide();
  $('#show_list').css({'display':'none'});

  $('#show_map').click(function() {
    $('#show_list').css({'display':'block'});
    $(this).css({'display': 'none'});
    $('#display_toggle').hide();
    $('.near-me-sidebar-cont').css({'height':'auto'})
  });

  $('#show_list').click(function() {
    $('#show_map').css({'display':'block'});
    $(this).css({'display': 'none'})
    $('#display_toggle').show();
    $('.near-me-sidebar-cont').css({'height':'100%'})
  });

  $('#changeLoc').click(function() {
        $('#searchForm').show();
        $('#cityName').hide();
        $('#display_toggle').hide();
        $(this).hide();
        $('#sub-sidebar').hide();
  });
  $('#back_to').click(function() {
        $('#searchForm').hide();
        $('#cityName').show();
        $('#display_toggle').show();
        $('#changeLoc').show();
        $('#sub-sidebar').hide();
  });
  $('#more_cat_show').click(function() {
      $('#no-more-cat').hide();
      $('#more-cat').show();
  })
  $('#back_to_cat').click(function() {
      $('#no-more-cat').show();
      $('#more-cat').hide();
  })

    getLocation();
    $("#location_keyword").keyup(function () {
        value = $(this).val();
        if (value.length >= 3 ) {
          $.ajax({
               method:'post',
               cache: false,
               data: {keyword:value, '_token': $('input[name=_token]').val()},
               url:"{{route('search.location')}}",
               success:function(data){
                 $('#dropDown').html(data);
             }
           });
      }
      else {
           $('#dropDown').html('');
           $('#sub-sidebar').show();
      }
    });
  });

  function reloadMap(lat,lang,allow) {

    var url       = "{{url('near-me/')}}";
    <?php if(Request::segment(2)) {?>
    url           = url+'/{{Request::segment(2)}}'+'/'+allow+'/'+lat+'/'+lang;
    <?php }else { ?>
      url           = url+'/null'+'/'+allow+'/'+lat+'/'+lang;
    <?php } ?>
    location.href = url;

    // $.ajax({
    //      method:'get',
    //      cache: false,
    //      data: {latitude:lat,longitude:lang, '_token': $('input[name=_token]').val()},
    //      url:"{{url('near-me')}}",
    //      success:function(data){
    //        $('#nearme-map').html('');
    //        $('#nearme-map').html(data);
    //    }
    //  }).
    //  done(function(data)
    //    {
    //       initialize_0();
    //
    //    })

  }


function getLocation() {

  <?php
      if(!Request::segment(3))  {?>
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    <?php  }
   ?>

  navigator.permissions && navigator.permissions.query({name: 'geolocation'}).then(function(PermissionStatus) {
    if(PermissionStatus.state != 'granted'  && PermissionStatus.state != 'denied') {
      if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(showPosition, showError);
      }
    }
    if(PermissionStatus.state == 'denied') {

      $('#alert_access').css({'display':'block','z-index' : '999999'});
      setTimeout(hideAlert,3000)
    }
    if(PermissionStatus.state == 'granted') {
					  //navigator.geolocation.getCurrentPosition(updatePosition);
      $('#alert_access').css({'display':'none'});
    }
  })

}
function hideAlert() {
      $('#alert_access').css({'display':'none'});
}
function showPosition(position) {

     reloadMap(position.coords.latitude,position.coords.longitude,true);
  }

  function updatePosition(position)
  {
	  console.log(position);
  }

function showError(error) {

    switch(error.code) {
        case error.PERMISSION_DENIED:
            reloadMap("{{$userLocation[0]['geoplugin_latitude']}}","{{$userLocation[0]['geoplugin_longitude']}}",false);
            break;
        case error.POSITION_UNAVAILABLE:
           reloadMap("{{$userLocation[0]['geoplugin_latitude']}}","{{$userLocation[0]['geoplugin_longitude']}}",false);
            break;
        case error.TIMEOUT:
            reloadMap("{{$userLocation[0]['geoplugin_latitude']}}","{{$userLocation[0]['geoplugin_longitude']}}",false);
            break;
        case error.UNKNOWN_ERROR:
            reloadMap("{{$userLocation[0]['geoplugin_latitude']}}","{{$userLocation[0]['geoplugin_longitude']}}",false);
          break;
    }
}


function mapHlStore(store_id)
{
	$('.ofstore').removeClass('bg-succ');
	$('#str'+store_id).addClass('bg-succ');
  $('.near-me-sidebar-cont').scrollTop(0);
  $('.near-me-sidebar-cont').scrollTop($('#str'+store_id).offset().top-($('.near-me-header').outerHeight()+10));
	$('#str'+store_id).focus();
  if ($(window).width() < 700)
  {
    $('.setFocusStoreMobile').html($('#str'+store_id).html())
  }
}

  google.maps.event.addDomListener(window, 'load', addMapStyling);

function addMapStyling() {
  // Use this for on load
}

 /* function attachMapListeners(map)
        {
            console.log('triggered');

    var recenterButton = document.querySelector("#recenBtn");
    recenterButton.addEventListener("click", function() {
      map.panTo({<?php echo 'lat:'.$data['myLat'].',lng:'.$data['myLong'];?>});
    });
  };   */


</script>

<style>

.gm-style img[draggable="false"]:not([role="presentation"]) {
    border-radius:50%;
     padding: 2px;
    background: white;
}
</style>
