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
$pageimage = asset('public_assets/images/page-header-bg.jpg');
if(!empty($data['pageInfo']->image))
  $pageimage = asset('uploads/images').'/'.$data['pageInfo']->image;

?>
<link rel="stylesheet" href="{{asset('public_assets/css/how-it-works-style.css')}}">

<?php
//dd($data);
?>

<!--New section  -->
<section class="hit-hero-banner bg-white py-5">
    <div class="container">
      <!-- <div class="page-navigation">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb p-0 mb-2">
            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('public/storepage.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$data['pageInfo']->title}}</li>
          </ol>
        </nav>
      </div> -->
      <div class="hero-banner-cont px-3">
        <div class="row">
          <div class="col-md-12">
            <div class="st-title">
               <h1 class="font-48"><span class="fw-700 text-white">{{$data['pageInfo']->title}}</span></h1>
               <p class="text-muted font-14 fw-400">{!!$data['pageInfo']->note!!} </p>
               @if(!Auth::guard('member')->check())
               <button class="btn btn-primary font-18 fw-400 mt-2" data-dismiss="modal" data-toggle="modal" data-target="#join-us-modal" >{!! __('public/hiw-and-pop.join_now_btn') !!}</button>
               @endif

            </div>
          </div>
        </div>
      </div>
</section>












<!-- how it works section -->
<section class="how-it-work py-5">
  <div class="container">
    <h1 class="hiw-title d-block fw-700 font-36 text-muted text-center mb-5">{{__('public/homepage.hp_how_it_works')}}</h1>
    <div class="hiw-inner">
      <div class="row text-center">
        @foreach($data['hiw_images'] as $hiw)
        <?php // dd($hiw) ?>
        <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
          <div class="hiw-cont">
            <div class="hiw-icon mb-3">
              <img src="{{asset($hiw->block_image)}}" alt="{!! $hiw->title !!}" class="img-fluid">
            </div>
            <div class="hiw-caption">
              <p class="font-20 fw-700 text-muted">{!! $hiw->title !!}</p>
              <p class="fm-arch text-muted">{!!$hiw->block_content!!}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>



<!-- Video  -->
<section class="hiw-video-main py-5">
  <div class="container">
    <div class="hiw-video-inner">
      <div class="row text-center">
          <div class="col-lg-12 col-md-12 mb-3 mb-lg-0">
              <video width="920" controls class="hiw-video shadow-lg mb-lg-5 mb-3">
                <source src="http://moola101.ga/uploads/video/birds.mp4" type="video/mp4">
                <source src="http://moola101.ga/uploads/video/birds.ogg" type="video/ogg">
                Your browser does not support HTML5 video.
              </video>
            </div>
          </div>
        </div>
    </div>
</section>
<!-- . Video -->

<!-- <section class="h-i-w-banner">
<div >
  <div class="container">
    <div class="hiwPlayBtn">
      <a href="javascript:void(0)" data-toggle="modal" class="video-btn" data-for="video" data-src="{{url(config('settingConfig.website_hiw_video'))}}" data-target="#hwiVid">
        <img src="{{asset('public_assets/images/play-icon.png')}}" alt="Play Video">
      </a>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-8">
        <div class="h-i-w-banner-cont text-white">
          <h1 class="promo-text font-60 fw-900">{{$data['pageInfo']->title}}</h1>
          <p class="font-24 fw-400 text-white">{!!$data['pageInfo']->note!!}</p>
          @if(!Auth::guard('member')->check())
          <button class="btn btn-primary font-18 fw-400 mt-2" data-dismiss="modal" data-toggle="modal" data-target="#join-us-modal" >{!! __('public/hiw-and-pop.join_now_btn') !!}</button>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
</section> -->

<section class="coustomers-testi py-5">
<div class="container">
  <h1 class="text-muted font-36 fw-700 text-center d-block"> {{__('public/hiw-and-pop.hiw_tesinomial_txt')}}</h1>
  <div class="hiw-testinomial">
  <div class="owl-carousel owl-theme owl-loaded owl-drag">
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
</section>

<section class="hiw-faq py-5">
<div class="container">
  <h3 class="hiw-title text-muted font-36 fw-700 text-center mb-5 d-block">{{__('public/hiw-and-pop.hiw_faq_title')}}</h3>
  <div class="accordion" id="accordionExample" aria-multiselectable="true">
    @php $j=0; @endphp
    @foreach($data['faq']  as $faq)
     <div class="card  round-0">
      <div class="card-header  border-bottom-0" id="heading{{$faq->faq_id}}">
        <span class="panel-title mb-0">
          <button class="btn btn-link d-block w-100 text-left  text-muted font-18 fw-700 px-0 @if($j != 0) collapsed @endif" type="button" data-toggle="collapse" data-target="#collapse{{$faq->faq_id}}" aria-expanded="@if($j == 0)  true @endif" aria-controls="collapse{{$faq->faq_id}}">
            {{$faq->faq_title}}
          </button>
        </span>
      </div>

      <div id="collapse{{$faq->faq_id}}" class="collapse @if($j == 0) show @endif" aria-labelledby="heading{{$faq->faq_id}}" data-parent="#accordionExample">
        <div class="card-body p-1 font-15 secondary-text fw-400">
          {!!$faq->faq_desc !!}
        </div>
      </div>
    </div>
    @php $j++; @endphp
    @endforeach
  </div>
  </div>
</section>
@if(!Auth::guard('member')->check())
  <!-- <section class="hiw-join-now py-5 text-center">
    <div class="container">
    <span class="font-40 fw-400 text-dark mb-5 d-block">{{__('public/hiw-and-pop.login_join_title')}} </span>
    <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#join-us-modal">
      <button type="button" class="btn btn-info font-18 fw-400 px-3 mr-3">{{__('public/hiw-and-pop.join_now_btn')}}  </button>
    </a>
    <button type="button" data-toggle="modal" data-target="#login-modal" class="btn btn-outline-dark font-18 fw-400 px-4">{{__('public/hiw-and-pop.login_btn')}} </button>
    </div>
  </section> -->
  @endif
  @include('public/howitworks/partials.video-pop')

  <script type="text/javascript" src="{{asset('public_assets/js/page.js')}}"></script>
  <script type="text/javascript">

  </script>
@endsection
