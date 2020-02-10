<?php $mobileDetection = new MobileDetect();  ?>
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
<?php
$storeCats = AppClass::getStoreCategory();
?>
<section class="sec-page-header" style="background-image:url('{{$pageimage}}')">
  <div class="container">
    <!-- <div class="row">
      <div class="col-lg-12">
        <div class="db-breadcrumb">
          <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('public/storepage.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('public/storepage.all_storecat')}}</li>
          </ol>
          </nav>
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="col-lg-6 col-md-8">
        <h1 class="page-title-h1">
          {!! $data['pageInfo']->title!!} with <span class="primary-text">Cashback</span>, <span class="promo-text">Coupons</span> & <span class="text-green">Promo Codes</span></h1>
        <p>{!! $data['pageInfo']->note!!}</p>
      </div>
    </div>
  </div>
</section>
<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-4">
        <!-- <div class="merchant-info bg-white d-none d-sm-block">
          <div class="merchant-title featurebg" style="background-image:url('{{$pageimage}}');">
         </div>
        </div> -->
        <!-- <div class="merchant-data bg-white border-top  mb-4">
         <div class="merchant-data-cont p-3 ">
          <p class="mb-0">{{__('public/storepage.total')}} {{__('public/storepage.storecats')}}:</p>
          <span><strong>
           {{count($storeCats)}}
          </strong></span>

        </div>
        </div> -->
        @include('public.cashback-partials.allSideBar')
      </div>
      <div class="col-lg-9 col-md-8">
        <span class="pt-0 text-capitalize h2">{{__('public/storepage.browse_all_storecat')}}</span>


    <div class="row">
		<div class="col-12">
         <div class="top-cat-wrap">
		 <div class="row">
			@foreach($storeCats as $topCat)
        <div class="col-6 col-lg-3 col-md-4">
          <div class="st-result">
            <ul class="list-unstyled mb-0" id="{{substr($topCat->store_cat_name,0,1)}}" >
              <li class="text-center mb-2"><a href="{{url('store-category/'.str_slug($topCat->slug))}}" name="{{substr($topCat->store_cat_name,0,1)}}"><img class="storecatimg" width="65px" @if($topCat->store_cat_icon != '')
                src="{{asset('uploads/images/category').'/'.$topCat->store_cat_icon}}"
               @else
                src="{{asset('uploads/images/no-image.png')}}"
               @endif></a></li>
              <li class="text-center"><a href="{{url('store-category/'.str_slug($topCat->slug))}}" name="{{substr($topCat->store_cat_name,0,1)}}">
                <strong>{{$topCat->store_cat_name}}</strong></a></li>
            </ul>
          </div>
        </div>

          <!-- <div class="col-6 col-lg-3 col-md-4">
              <a href="{{url('store-category/'.str_slug($topCat->slug))}}" id="{{substr($topCat->store_cat_name,0,1)}}">
              <div class="top-cat-box text-center rounded">
                <div class="top-cat-cont">
                  <img @if($topCat->store_cat_icon != '')
                    src="{{asset('uploads/images/category').'/'.$topCat->store_cat_icon}}"
                   @else
                    src="{{asset('uploads/images/no-image.png')}}"
                   @endif>
                 <p class="text-capitalize">{{$topCat->store_cat_name}}</p>

              </div>
              </div>
              </a>
            </div> -->

            @endforeach
			</div>
         </div>
		 </div>
		 </div>

		  @if(trim(config('settingConfig.ads_pages_bottom'))!='')
        <div class="gbands text-center" id="gband-pages">
          {!! stripcslashes(config('settingConfig.ads_pages_bottom')) !!}
        </div>
      @endif

        </div>
    </div>
  </div>
</section>
@endsection
