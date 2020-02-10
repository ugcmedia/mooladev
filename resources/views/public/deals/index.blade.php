@php
$mobileDetection = new MobileDetect();
@endphp
@extends('public.layouts.app')
@section('title')
  {!! $data['pageInfo']->title!!}
@endsection
@section('meta')
  <meta name="description"  content="{!! $data['pageInfo']->metadesc!!}" >
  <meta name="keywords" content="{!! $data['pageInfo']->metakey!!}">
  @php $img = AppClass::getMetaImg($data['pageInfo'],'pages') @endphp
  <meta property="og:image" content="{{$img}}" />
  <meta property="og:title" content="{!! $data['pageInfo']->meta_title !!}" />
  <meta property="og:url" content="{{URL::current()}}" />
  <meta property="og:description" content="{!! $data['pageInfo']->metadesc!!}" />
  <meta property="og:site_name" content="{{config('sximo.cnf_appname')}}" />
@endsection
@section('content')
<?php
if(!$mobileDetection->isMobile())
  $pageimage = asset('public_assets/images/page-header-bg.jpg');
else
  $pageimage = asset('public_assets/images/mobile-page-header-bg.jpg');

if(!empty($data['pageInfo']->image)) {
  if($mobileDetection->isMobile()) {
    $pageimage = asset('uploads/images').'/mobile-'.$data['pageInfo']->image;
  } else {
    $pageimage = asset('uploads/images').'/'.$data['pageInfo']->image;
  }
}
?>
<section class="sec-page-header" style="background-image:url('{{$pageimage}}')">
  <div class="container">
    <!-- <div class="row">
      <div class="col-lg-12">
       <div class="db-breadcrumb">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('public/storepage.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('public/storepage.all_deals')}}</li>
          </ol>
        </nav>
       </div>
      </div>
    </div> -->
    <div class="row">
      <div class="col-lg-6 col-md-8">
        <h1 class="page-title-h1">{!! $data['pageInfo']->title!!}</h1>
        <p>{!! $data['pageInfo']->note!!}</p>
      </div>
    </div>
  </div>
</section>
<!-- Daily deals -->
@if( config('settingConfig.homepage_deals') =='Y' )
  @include('public/homepage/partials/daily-deals')
@endif
<!-- .Daily deals -->
<section class="deals-of-the-day py-5">
  <div class="container">
    <div class="d-lg-none d-md-none d-sm-block">
      <div class="cat-filter-overlap"></div>
      <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <div class="mob-cat-filter px-2"></div>
      </div>
      <div id="main">
        <span style="font-size:30px;cursor:pointer" onclick="openNav()"><i class="fa fa-filter"></i></span>
      </div>
    </div>
    <div class="row">
      @if(!$mobileDetection->isMobile())
        @include('public/deals/partials/side-content')
      @endif
      <div class="col-lg-9 col-md-8">
        <div class="" id="dod-ajax">
          @include('public/cashback-partials/deal-partials.hottest_deal_ajax_tab')
        </div>
        @if(strip_tags($data['pageInfo']->footer_note) != '')
          <section class="merchant-footer mt-3 mb-5">
              <div id="store-seo-desc" class="shortseodesc">
                {!!$data['pageInfo']->footer_note !!}
              </div>
              @if(strlen($data['pageInfo']->footer_note) > 100)
              <div class="text-right">
                <a href="javascript:void(0);" onclick="readmoredesc('store-seo-desc', 'seoreadmore');" class="seoreadmore" id="read-moreDesc1">{{__('public/storepage.read_more')}}</a>
              </div>
              @endif
           </section>
         @endif
    		 @if(trim(config('settingConfig.ads_pages_bottom'))!='')
          <div class="gbands col-md-12 text-center" id="gband-pages">
            {!! stripcslashes(config('settingConfig.ads_pages_bottom')) !!}
          </div>
          @endif

          <!-- sidebar widget content for mobile -->
            @if($mobileDetection->isMobile())
              @include('public/deals/partials.side-content-mobile')
            @endif
          <!-- .sidebar widget content for mobile -->

      </div>
    </div>
   </div>
</section>
<script type="text/javascript">
  var imgSource = "{{asset('uploads/images/loading.gif')}}";
</script>
<script type="text/javascript" src="{{asset('public_assets/js/home.js')}}"></script>
<script type="text/javascript" src="{{asset('public_assets/js/dod.js')}}"></script>
@endsection
