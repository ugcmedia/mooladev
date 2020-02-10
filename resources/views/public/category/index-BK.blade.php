
@extends('public.layouts.app')
@section('title')
@if($data['cat']->meta_title != '')
  {{$data['cat']->meta_title }}
@else
  {!! AppClass::stringReplaceSetting(config('settingConfig.cat_meta_title'),$data['cat']->cat_name)!!}
@endif
@endsection
@section('meta')
  <meta name="description" @if($data['cat']->meta_desc != '') content= "{!! $data['cat']->meta_desc !!}" @else  content= "{!! AppClass::stringReplaceSetting(config('settingConfig.cat_meta_desc'),$data['cat']->cat_name)!!}"  @endif>
  <meta name="keywords" content="{!! $data['cat']->meta_keywords !!}" >
  @php $img = AppClass::getMetaImg($data['cat'],'cat') @endphp
  <meta property="og:image" content="{{$img}}" />
  <meta property="og:title" content="{!! $data['cat']->meta_title !!}" />
  <meta property="og:url" content="{{URL::current()}}" />
  <meta property="og:description" content="{!! $data['cat']->meta_desc!!}" />
  <meta property="og:site_name" content="{{config('sximo.cnf_appname')}}" />
@endsection
<!-- <link rel="stylesheet" href="{{asset('public_assets/css/category-style.css')}}"> -->
@section('content')

<?php
  //  dd($data);
?>

<section class="Category-page-main py-4">

    <!-- cat-filter-mobile-offcanva -->
    <div class="cat-filter-mobile ">
      @include('public/cashback-partials/common-sidebar-filters/side-bar-filter-mobile')
    </div>
    <div class="deal-filter-mobile d-none">
      @include('public/cashback-partials/common-sidebar-filters/side-bar-filter-deal-mobile')
    </div>


<!-- end-cat-filter-mobile-offcanva -->
<div class="container">
  <div class="store-main-wrapp">
    <div class="row">
      @include('public/category/cat-partials.side-content')
      @include('public/cashback-partials.common-hiw.hiw-pop')

      <div class="col-lg-9 col-md-8">
        <div class="store-banner">
          <div class="store-banner-cont pb-3">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                      <div class="store-title">
                        <h1 class="font-32 text-dark fw-400">{{AppClass::getHTag($data['cat']->cat_name,$data['cat']->h1_tag,'cat','h1')}}</h1>
                      </div>
                      <div class="store-meta-disc">
                        <div class="mb-2 mb-lg-0 font-12 secondary-text">
                          @if(strip_tags($data['cat'] ->main_desc) != '' || strip_tags($data['cat']->main_desc) != null)
                                 {!! mb_strimwidth($data['cat']->main_desc, 0, 182, '...') !!}
                            @endif
                          </div>
                      </div>
                    </div>

                    <div class="col-lg-3 text-left text-lg-right d-none d-md-block">
                      <div class="store-brd">
                        <nav aria-label="breadcrumb p-0">
                          <ol class="breadcrumb p-0 mb-0">
                            <li class="breadcrumb-item secondary-text-dark font-13 fw-300"><a href="{{url('/')}}" class="secondary-text-dark">{{__('public/category.home')}}</a></li>
                            <li class="breadcrumb-item secondary-text-dark font-13 fw-300"><a href="{{url('all-coupon-categories')}}" class="secondary-text-dark">{{__('public/category.cate')}}</a></li>
                            <li class="breadcrumb-item active font-13 fw-300" aria-current="page">{{$data['cat']->cat_name}}</li>
                          </ol>
                        </nav>
                      </div>

                    </div>
                  </div>
              </div>
            </div>
            <!-- How it works -->
            @include('public/cashback-partials.common-hiw.hiw')
            @php
              $totalCount   = 0;
              $totalDeals   = 0;
              $totalCoupons = 0;
              $getData = explode('|',$data['cat']->offers_count);
              $totalCount = $getData[0];
              $totalDeals = $getData[2];
              $totalCoupons =  $getData[1];

              $h2Data = [$data['cat']->cat_name,$data['cat']->h2_tag,'cat', 'h2'];

            @endphp

          @if(Count($data['topStores']) > 0)
          <div class="st-cat-cb-list px-3 pt-3 pb-0 div-inner-white rounded mb-4">
            <div class="st-cat-cb-title clearfix">
              <p class="font-18 fw-700 text-dark mb-3 d-inline-block float-left">Shop from top stores of {{$data['cat']->cat_name}} Category</p>
            <label class="switch float-right mt-2" data-toggle="collapse" href="#cat-switch"  aria-expanded="false" aria-controls="collapseExample">
              <input type="checkbox" checked>
              <span class="slider round bg-promo-dark"></span>
            </label>
            </div>

          <div class="collapse" id="cat-switch">
            <div id="top-store-owl">
              <div class="owl-carousel owl-theme section-inner-white pt-4 px-4 rounded">
                  @foreach($data['topStores'] as $ctStore)
                <?php
                $offercount = '0';
                if(!empty($ctStore->offers_count)) {
                    $offercount = AppClass::getOffersCount($ctStore->offers_count)." Offers";
                    $storeimg = ($ctStore->store_logo != '')? asset('uploads/images/store').'/'.$ctStore->store_logo : asset('uploads/images/no-image.jpg');
                  }
                ?>
                <div class="item">
                  <a href="{{url('store/'.str_slug($ctStore->store_slug))}}">
                    <div class="top-brand-box text-center pb-4">
                      <div class="top-brand-logo">
                        <img  class="owl-lazy" data-src="{{$storeimg}}">
                      </div>
                        <p class="top-brand-name mb-0 secondary-text font-15">
                          {{$ctStore->store_name}}
                        </p>
                        <p class="top-brand-offer primary-text font-15">
                        {{  $offercount}}
                        </p>
                    </div>
                    </a>
                  </div>
                @endforeach
              </div>
            </div>
          </div>
        </div>
        @endif
        <!-- </div> -->

        <!-- hotest tabpane -->
        <div class="hotest-tab">
          @if(true)
           <ul class="nav nav-pills coupondeal-tab nav-justified mb-4 bg-promo-dark" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link @if(!$data['dealTab']) active @endif secondary-text py-3 px-5"  data-tabname="coupon" id="pills-home-tab-cpn-of" data-toggle="dealAjax" href="#pills-coupon-cpn-of" role="tab" aria-controls="pills-home-cpn-of" aria-selected="true">
                <img src="{{asset('public_assets/images/Cpn-tag.png')}}" class="hot-deals-icon mr-2 d-none d-md-inline-block" alt="">
                {{__('public/storepage.tab_coupon_offer_txt')}}  ({{$totalCount}})
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link  @if($data['dealTab']) active @endif  secondary-text py-3 px-5" data-tabname="deal" id="pills-deals-tab-hd" data-toggle="dealAjax" data-target ="#deals"   href="#deals" role="tab" aria-controls="pills-profile-hd" aria-selected="false">
                <img src="{{asset('public_assets/images/bargain.svg')}}"  class="hot-deals-icon mr-2 d-none d-md-inline-block" alt="">
                {{__('public/storepage.tab_hottest_offer_txt')}}( {{$data['cat']->deals_count}} )
              </a>
            </li>
          </ul>
          @endif
          @if(true)
          <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade @if(!$data['dealTab']) show active @endif" id="pills-coupon-cpn-of" role="tabpanel" aria-labelledby="pills-home-tab-cpn-of">
              @endif
              <!-- coupons & offers inner tab -->
              <div class="store-cpn-tab">
                <ul class="nav nav-pills coupon-tab mb-3 div-inner-white rounded" id="pills-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active secondary-text py-2 px-5"    role="tab" href="#all"  data-toggle="tabajax" data-target="#all" aria-controls="pills-home-all" aria-selected="true">{{__('public/storepage.coupon_tab_All')}}({{$totalCount}})</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link secondary-text py-2 px-5 font-15 fw-400" href="#coupons" data-target="#coupons"  data-toggle="tabajax" role="tab"   aria-controls="pills-profile-cpn" aria-selected="false">{{__('public/storepage.coupon_tab_coupon')}} ({{$totalCoupons}})</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link secondary-text py-2 px-5 font-15 fw-400" href="#dealsTab" data-target="#dealsTab"  data-toggle="tabajax" role="tab" aria-controls="pills-contact-of" aria-selected="false">{{__('public/storepage.coupon_tab_offer')}}({{$totalDeals}})</a>
                </li>
              </ul>
              @php
                $isDevice = '';
                $mobileDetection = new MobileDetect();
                if($mobileDetection->isMobile())
                  $isDevice = 'mobile';
              @endphp
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="pills-home-all-tab">
                  @if($isDevice == 'mobile')
                    @include('public/cashback-partials/coupon-tab-content.coupon-tab-mobile')
                   @else
                    @include('public/cashback-partials/coupon-tab-content.coupon-tab')
                  @endif
                </div>
                <div class="tab-pane fade" id="coupons" role="tabpanel" aria-labelledby="pills-profile-cpn-tab">
                    @if($isDevice == 'mobile')
                      @include('public/cashback-partials/coupon-tab-content.coupon-tab-mobile')
                     @else
                      @include('public/cashback-partials/coupon-tab-content.coupon-tab')
                    @endif
                </div>
                <div class="tab-pane fade" id="dealsTab" role="tabpanel" aria-labelledby="pills-contact-of-tab">
                    @if($isDevice == 'mobile')
                      @include('public/cashback-partials/coupon-tab-content.coupon-tab-mobile')
                     @else
                      @include('public/cashback-partials/coupon-tab-content.coupon-tab')
                    @endif
                </div>
              </div>
              </div>
              @if(true)
            </div>

          <div class="tab-pane fade @if($data['dealTab']) show active @endif " id="deals"  role="tabpanel" aria-labelledby="deals">

          </div>
        </div>
        @endif
      </div>
      @php $sharePopCName = $data['cat']->cat_name; @endphp
      <!-- common Popover for coupon box -->
      @include('public/cashback-partials/common-popover/share-hwi-popover')

@if(strip_tags($data['cat']->seo_desc) != '')
  <section class="buyers-guid mt-4">
      {!! $data['cat']->seo_desc !!}
  </section>
@endif

<!-- sidebar widget content for mobile -->
  @if($mobileDetection->isMobile())
    @include('public/category/cat-partials.side-content-mobile')
  @endif
<!-- .sidebar widget content for mobile -->

    </div>
  </div>
</div>
</div>
</div>
</section>
<script type="text/javascript">
  var imgSource    = "{{asset('uploads/images/loading.gif')}}";
  var noResponse   = "{{trans('actionMsg.no_response')}}";
  var DealUrl      = "{{route('category-coupon-hottest-deal.ajax')}}";
  var id           = "{{$data['cat']->cat_id}}";
  <?php
    if($data['dealTab']) { ?>
        $('.cat-filter-mobile').addClass('d-none');
        $('.deal-filter-mobile').removeClass('d-none');
        $('.deal-filter').removeAttr('style');
        $('.coupon-filter').css({'display':'none'});
        getDeals();
  <?php } ?>
</script>
<script type="text/javascript" src="{{asset('public_assets/js/cat.js')}}">

</script>
@endsection
