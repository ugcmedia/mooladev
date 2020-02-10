@extends('public.layouts.app')
@section('title')
  {!! AppClass::stringReplaceSetting(config('settingConfig.hp_meta_title'),'') !!}
@endsection
@section('meta')
  <meta name="description"  content= "{!! AppClass::stringReplaceSetting(config('settingConfig.hp_meta_desc'),'') !!}" >
  @php $img = AppClass::getMetaImg(null,'no-img') @endphp
  <meta property="og:image" content="{{$img}}" />
  <meta property="og:title" content="{!! AppClass::stringReplaceSetting(config('settingConfig.hp_meta_title'),'') !!}" />
  <meta property="og:url" content="{{URL::current()}}" />
  <meta property="og:description" content="{!!  AppClass::stringReplaceSetting(config('settingConfig.hp_meta_desc'),'') !!}" />
  <meta property="og:site_name" content="{{config('sximo.cnf_appname')}}" />
@endsection
@section('content')

<?php
//dd($data);
?>
<section class="main-banner">
  <?php // include'menu.php'; ?>
  <!-- <div class="main-banner"> -->
      <div class="container h-100">

        <div class="row justify-content-center h-100 align-items-center">
          <div class="col-lg-10 main-banner-cont">


            <div class="main-banner-in">
              <h2 class="banner-title font-48 fw-700 text-white text-center">{{__('public/homepage.hp_hero_title')}}</h2>
            <div class="form-row main-search">
              <div class="col-md-8 mx-auto">
                <div class="input-group mb-3">
                  <img src="{{asset('public_assets/images/search-icon.png')}}" class="search-ico" alt="">
                 <input type="text" class="form-control form-control-lg font-16 fw-300 pl-5" placeholder="{{__('public/homepage.hp_hero_title')}}">
                 <div class="input-group-append">
                   <button class="btn btn-primary px-4 p-2" type="button">
                     {{__('public/common.search')}}
                   </button>
                 </div>
               </div>
              </div>
                 <ul class="banner-cat list-inline text-center mx-auto">
                  @foreach($data['searchCategories'] as $srcat)
                     <li class="list-inline-item">
                       <a href="{{url('category').'/'.$srcat->cat_slug}}">{{ $srcat->cat_name }}</a>
                     </li>
                  @endforeach
                  </ul>
              </div>
            </div>
          </div>
        </div>
      </div>

    <!-- </div> -->
  <!-- </div> -->
</section>

  <!-- hp-how-it-work  -->
  @include('public/homepage/partials/how-it-work')
  <!-- .hp-how-it-work -->

<!-- hp-jion-now -->

<!--Join Now  -->
@if(!Auth::guard('member')->check())
@include('public/homepage/partials/signup-banner')
@endif
<!--End Join Now  -->

<!-- featured stores -->
<section class="featured-stores py-5">
<div class="container">
  <div class="f-stores-header">
    <div class="row">
      <div class="col-md-6">
        <h1 class="font-36 fw-700 text-muted">{{__('public/homepage.hp_featured_store')}}</h1>
      </div>
      <div class="col-md-6 text-left text-md-right">
        <a href="{{url('all-stores')}}" class="btn btn-primary">{{__('public/homepage.btn_view_all_stores')}}</a>
      </div>
    </div>
  </div>

<div class="hp-featured-owl">
        <div class="owl-carousel owl-theme py-5">
              @foreach ($data['featured_stores'] as $fStores)
                      @include('public/cashback-partials/store-box')
              @endforeach
        </div>
</div>

  </div>
</div>
</section>

<!-- store-addofferes -->
<section class="trending offeres bg-white py-5">
  <div class="container">
    <h1 class="font-36 fw-700 text-muted text-center">{{__('public/homepage.hp_trending_offer_title')}} </h1>
    <div id="trending-owl" class="hp-owl">
        <div class="owl-carousel owl-theme py-51">
            @foreach ($data['trendingOffers'] as $tStores)
            <?php
    //         echo "<pre>";
    // print_r($tStores);
            ?>
                <div class="item h-100 mb-3">
                  <div class="hp-owl-card rounded h-100">

                    <!-- <a href="{{-- $tStores->vendor_slug --}}"> -->
                              <div class="hp-owl-card-inner  bg-white shadow-sm rounded h-100">
                                <div class="owl-card-figure rounded">
                                  <img src="{{asset($tStores->offer_image)}}" alt="">
                                </div>
                                  <div class="fd-store-logo bg-white border rounded p-1 text-center">
                                    <img src="{{asset($tStores->vendor_logo)}}" alt="">
                                  </div>
                                <div class="hp-owl-card-inner-in pb-3 px-3 text-center">
                                  <h4 class="text-muted fw-700 font-16">{!!$tStores->vendor_name!!}</h4>
                                <p class="store-add text-muted font-14 fw-400">{{$tStores->offer_title}}</p>
                                  <div class="discount-lable text-center">
                                    <p class="d-lable-text p-2 px-3 rounded d-inline-block mb-0 font-14 fw-400">{{$tStores->vendor_cashback}}  %  MOOLA</p>
                                  </div>
                                </div>
                              </div>
                    <!-- </a> -->

                  </div>
                </div>
           @endforeach
      </div>
        <div class="v-all-button text-center mt-5">
          <a href="#" class="btn btn-primary">{{__('public/homepage.hp_trending_viewall_btn')}}</a>
        </div>
     </div>
  </div>
</section>

<!-- money sever -->
<section class="money-sever">
  <div class="money-sever-banner">
    <div class="container">
      <div class="row">
        <div class="col-md-6 d-flex align-items-end">
          <div class="position-relative">
            <div class="money-sever-caption text-center">
              <img src="{{asset('public_assets/images/mob_splash.png')}}" class="img-fluid" alt="">
            </div>
          </div>
        </div>

        <div class="col-md-6">
          <div class="money-sever-cont d-flex flex-column h-100 text-center text-md-left pt-5 pt-md-0">
            <h1 class="text-white font-48 fw-700">{{__('public/homepage.hp_money_saver_title')}}</h1>
            <div class="my-auto">
              <p class="fw-arch text-white font-24 fw-400">{{__('public/homepage.hp_money_saver_desc')}}</p>
              <div class="form-row">
                <div class="col-md-11 mb-3">
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text  bg-white" id="inputGroupPrepend">{{__('public/homepage.hp_phone_code')}}</span>
                  </div>
                       <input type="text" class="form-control form-control-lg font-16 fw-300 border-left-0" placeholder="{{__('public/homepage.hp_money_placeholder')}}">
                       <div class="input-group-append">
                         <button class="btn btn-dark px-4 p-2" type="button">
                           {{__('public/homepage.hp_send')}}
                         </button>
                       </div>
                     </div>
                </div>
              </div>
            </div>
            <p class="fw-arch font-24 text-white fw-400">{{__('public/homepage.hp_app_desc')}}</p>
            <div class="download-app-stores mb-5">
              <a href="#">
              <img src="{{asset('public_assets/images/App_store.png')}}" class="img-fluid mr-3" alt="">
              </a>
              <a href="#">
              <img src="{{asset('public_assets/images/play-store.png')}}" class="img-fluid" alt="">
              </a>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- join-with-us  -->
<section class="join-with-us py-5">
  <div class="container-fluid">
    <h2 class="text-muted font-36 fw-700 text-center mb-5">{{__('public/homepage.hp_join_the')}} <span class="b-count">{{__('public/homepage.hp_join_cnt')}}</span> {{__('public/homepage.hp_bussiness')}} <strong>{{__('public/homepage.hp_moola101')}}</strong></h2>
    <div class="row">
      <div class="col-lg-6  p-3 bg-white rounded shadow-sm">
        <div class="row justify-content-center">
          <div class="col-lg-9">
            <div class="why-join-cont py-5">
                @foreach ($data['hp_why_joinus'] as $joining)
                  <h5 class="text-muted font-24 fw-400  mb-4">{{$joining->title}}</h5>
                  {!!$joining->block_content!!}
                @endforeach
             <button type="button" class="btn btn-primary" name="button">{{__('public/homepage.hp_partner')}}</button>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        <div class="row">
          @foreach ($data['partners'] as $partner)
              <div class="col-lg-3 col-6 col-sm-4 text-center">
                <div class="partner-logo">
                  <div class="partner-img">
                      <img src="{{asset($partner->vendor_logo)}}" alt="{{$partner->vendor_name}}">
                  </div>
                </div>
              </div>
          @endforeach
        </div>
      </div>
    </div>
  </div>
</section>
<!--End join-with-us  -->

<!-- user stats -->
<section class="user-stats">
  <div class="container">
    <h1 class="text-white font-36 fw-700 text-center mb-5">{{__('public/homepage.hp_millions_user')}}</h1>
    <div class="row">
        @foreach ($data['hp_stats'] as $stats)
          <div class="col-lg-3 col-sm-6 d-flex  mb-4 mb-lg-0 justify-content-center justify-content-md-left">
            <div class="u-stats-icon bg-white mr-3">
              <img src="{{asset($stats->block_image)}}" alt="{{$stats->block_content}}">
            </div>
            <div class="u-stats-cont text-left">
              <p class="text-white fw-700 font-24 mb-0">{{$stats->title}}</p>
              <span class="fm-arch text-white font-16 fw-400">{!!$stats->block_content!!}</span>
            </div>
          </div>
        @endforeach
    </div>
  </div>
</section>
<!-- end user Stats  -->

<!---************************************
  join us and login popup content
******************************************  -->
<!-- join us popup content -->


<!-- login popup content -->



<!-- forgot password popup -->




<script type="text/javascript">
  var imgSource    = "{{asset('uploads/images/loading.gif')}}";
</script>
<script type="text/javascript" src="{{asset('public_assets/js/home.js')}}" ></script>
@endsection
