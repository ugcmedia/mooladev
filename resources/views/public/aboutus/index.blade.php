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

<link rel="stylesheet" href="{{asset('public_assets/css/refer-and-earn.css')}}">
<?php
$pageimage = asset('public_assets/images/page-header-bg.jpg');
if(!empty($data['pageInfo']->image))
  $pageimage = asset('uploads/images').'/'.$data['pageInfo']->image;

//print_r($data);
//dd($data);
?>



<!--New section  -->



<?
/*php print_r($data);
    die(); */?>

<section class=" bg-white  py-5 hit-hero-banner" style="  background-image: url('http://moola101.ga/uploads/images/main-banner.png');">
    <div class="container">



      <div class="page-navigation">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb p-0 mb-2">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$data['pageInfo']->title}}</li>
          </ol>
        </nav>
      </div>
      <!-- <div class="page-navigation">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb p-0 mb-2">
            <b>
            <p class="text-light text-sm">
              <a href="{{url('/')}}"> <span class="text-secondary ">{{__('public/storepage.home')}}  </span></a> &nbsp;> &nbsp; {{--$data['pageInfo']->title--}}</p>

</b>
          </ol>
        </nav>
      </div> -->


      <div class="hero-banner-cont">
        <div class="row">
          <div class="col-md-12">
            <div class="st-title">
               <h1 class="font-48"><span class="fw-700 text-white">{{$data['pageInfo']->title}}</span></h1>
               <div class="text-white">
                   <p class="text-white font-14 fw-400 ">
                   {!! $data['pageInfo']->footer_note !!}
                   </p>
             </div>
               {{-- @if(!Auth::guard('member')->check()) --}}
               <!-- <button class="btn btn-primary font-18 fw-400 mt-2" data-dismiss="modal" data-toggle="modal" data-target="#join-us-modal" >{!! __('public/hiw-and-pop.join_now_btn') !!}</button> -->
               {{-- @endif --}}

            </div>
          </div>
        </div>
      </div>
</section>

<!--Partner Section  -->
<section class="partner-section py-5  bg-white">
<div class="container">
<div class="refer-time-line">
<div class="row">





<div class="col-lg-6 pt-5 order-1 order-lg-1">

<div class="shoping-steps-image text-center">
<img src="http://moola101.ga/uploads/images/ipad-old.png"class="img-fluid" alt="">


</div>
</div>
<div class="col-lg-6 pt-5 order-2 order-lg-2">
<div class="shoping-steps-disc d-flex h-100">
<div class="my-auto text-center text-lg-left">
<!-- <p class="prt-title font-36 fw-700 text-muted"> {{--$data['pageInfo']->title --}}    </p> -->
<p class="font-20 fw-400  "><b>{!!$data['pageInfo']->note!!}</b></p>
</div>
</div>
</div>
</div>



</div>
</div>

</section>



<!-- hp-jion-now -->

<!--Join Now  -->
@if(!Auth::guard('member')->check())
@include('public/homepage/partials/signup-banner')
@endif
<!--End Join Now  -->


<section class="coustomers-testi py-5">
<div class="container">
  <h1 class="text-muted font-36 fw-700 text-center d-block"> {{__('public/hiw-and-pop.hiw_tesinomial_txt')}}</h1>
  <div class="hiw-testinomial">

  <div class="hp-featured-owl">
          <div class="owl-carousel owl-theme py-5">
                  @foreach($data['testinomial'] as $testi)
                      <div class="item py-5 ml-1">
                          <div class="top-cpn-box c-testi-card border rounded p-5 p-lg-3 shadow-sm">

                                <div class="text-center mb-3">
                                  <div class="c-avtar">
                                    <img src="{{asset($testi->block_image)}}" class="rounded-circle" alt="">
                                  </div>
                                </div>

                                  <div class="c-review text-center">
                                    <p class="secondary-text font-15 fw-400 px-4 mb-4">{!! $testi->block_content !!}</p>
                                  </div>

                                <div class="c-name text-center">
                                  <p class="text-muted font-18 fw-700">{!! $testi->title !!}</p>
                                </div>

                          </div>
                      </div>
                  @endforeach
          </div>
</div>




  </div>
</div>
</section>




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


















@endsection
