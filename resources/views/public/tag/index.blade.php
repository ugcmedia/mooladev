@php
$mobileDetection = new MobileDetect();
@endphp
@extends('public.layouts.app')
@section('title')
@if($data['tag']->meta_title != '')
  {!! $data['tag']->meta_title !!}
@else
  {!! AppClass::stringReplaceSetting(config('settingConfig.brand_meta_title'),$data['tag']->tag_name)!!}
@endif

@endsection
@section('meta')
  <meta name="description" @if($data['tag']->meta_desc != '') content= "{!! $data['tag']->meta_desc !!}" @else  content= "{!! AppClass::stringReplaceSetting(config('settingConfig.brand_meta_desc'),$data['tag']->tag_name)!!}"  @endif>
  <meta name="keywords" content="{!! $data['tag']->meta_keywords!!}">
  @php $img = AppClass::getMetaImg($data['tag'],'tag') @endphp
  <meta property="og:image" content="{{$img}}" />
  <meta property="og:title" content="{!! $data['tag']->meta_title !!}" />
  <meta property="og:url" content="{{URL::current()}}" />
  <meta property="og:description" content="{!! $data['tag']->meta_desc!!}" />
  <meta property="og:site_name" content="{{config('sximo.cnf_appname')}}" />
@endsection
@section('content')
<section class="Category-page-main py-4">
  @if($mobileDetection->isMobile())
    <!-- cat-filter-mobile-offcanva -->
    <div class="cat-filter-mobile ">
      @include('public/cashback-partials/common-sidebar-filters/side-bar-filter-mobile')
    </div>

  @endif
  <div class="container">
    <div class="store-main-wrapp">
      <div class="row">

        @include('public/tag/tag-partials.side-content')
        @include('public/cashback-partials.common-hiw.hiw-pop')

        <div class="col-lg-9 col-md-8">
          <div class="store-banner">
            <div class="store-banner-cont pb-3">
              <div class="container">
                  <div class="row">
                      <div class="col-lg-9">
                        <div class="store-title">
                          <h1 class="font-32 text-dark fw-400">{{AppClass::getHTag($data['tag']->tag_name,$data['tag']->h1_tag,'tag','h1')}} </h1>
                        </div>
                        <div class="store-meta-disc">
                          <p class="mb-2 mb-lg-0 font-12 secondary-text">
                            @if(strip_tags($data['tag'] ->main_desc) != '' || strip_tags($data['tag']->main_desc) != null)
                                   {!! mb_strimwidth($data['tag']->main_desc, 0, 182, '...') !!}
                              @endif
                        </div>
                      </div>

                      <div class="col-lg-3 text-left text-lg-right d-none d-md-block">
                        <div class="store-brd">
                          <nav aria-label="breadcrumb p-0">
                            <ol class="breadcrumb p-0 mb-0">
                              <li class="breadcrumb-item secondary-text-dark font-13 fw-300"><a href="{{url('/')}}" class="secondary-text-dark">{{__('public/tag.home')}}</a></li>
                              <li class="breadcrumb-item secondary-text-dark font-13 fw-300"><a href="{{url('all-tags')}}" class="secondary-text-dark">{{__('public/tag.tags')}}</a></li>
                              <li class="breadcrumb-item active font-13 fw-300" aria-current="page">{{$data['tag']->tag_name}}</li>
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
                $getData = explode('|',$data['tag']->offers_count);
                $totalCount   = $getData[0];
                $totalDeals   = $getData[2];
                $totalCoupons = $getData[1];
                $h2Data = [$data['tag']->tag_name,$data['tag']->h2_tag,'tag', 'h2'];
              @endphp

            @if(Count($data['topStores']) > 0)
            <div class="st-cat-cb-list p-3 div-inner-white rounded mb-4">
              <div class="st-cat-cb-title clearfix">
                <p class="font-18 fw-700 text-dark mb-0 d-inline-block float-left">Shop from top stores of {{$data['tag']->tag_name}} Tag</p>
                <label class="switch float-right" data-toggle="collapse" href="#cat-switch"  aria-expanded="false" aria-controls="collapseExample">
                  <input type="checkbox" checked>
                  <span class="slider round bg-promo-dark"></span>
                </label>
              </div>

            <div class="collapse" id="cat-switch">
              <div id="top-tag-owl">
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

          </div>
          @php $sharePopCName = $data['tag']->tag_name; @endphp
          <!-- common Popover for coupon box -->
          @include('public/cashback-partials/common-popover/share-hwi-popover')

            @if(strip_tags($data['tag']->seo_desc) != '')
              <section class="buyers-guid mt-4">
                  {!! $data['tag']->seo_desc !!}
              </section>
            @endif

            <!-- sidebar widget content for mobile -->
              @if($mobileDetection->isMobile())
                @include('public/tag/tag-partials.side-content-mobile')
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
  var id           = "{{$data['tag']->tag_id}}";

</script>

<script type="text/javascript" src="{{asset('public_assets/js/tag.js')}}">

</script>
@endsection
