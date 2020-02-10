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
<section class="prt-hero-banner bg-white py-5 text-center">
    <div class="container h-100">
      <!-- <div class="page-navigation">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb p-0 mb-2">
            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('public/storepage.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$data['pageInfo']->title}}</li>
          </ol>
        </nav>
      </div> -->
      <!-- <div class="hero-banner-cont px-3"> -->
        <div class="row justify-content-center h-100 align-items-center">
          <div class="col-md-12">
            <div class="st-title">
               <h1 class="font-48"><span class="fw-700 text-white">{!!$data['pageInfo']->note!!}</span></h1>
               <p class="font-20 fw-400 text-white mb-lg-5 mb-3">{{__('public/homepage.prt_desc')}} </p>
               @if(!Auth::guard('member')->check())
               <a href="{{url('/partner/register')}}" class="btn btn-primary font-18 fw-400 mt-2" >Become a Partner</a>
               @endif

            </div>
          </div>
        </div>
      <!-- </div> -->
</section>


<!--Partner Section  -->
<section class="partner-section py-5  bg-white">
<div class="container">
<div class="refer-time-line">
<div class="row">
<div class="col-lg-6 pt-5 order-1 order-lg-1">

<div class="shoping-steps-image text-center">
<img src="http://moola101.ga/uploads/images/Laptop-1.png" class="img-fluid" alt="">
</div>
</div>
<div class="col-lg-6 pt-5 order-2 order-lg-2">
<div class="shoping-steps-disc d-flex h-100">
<div class="my-auto text-center text-lg-left">
<p class="prt-title font-36 fw-700 text-muted">Moola101 makes loyalty easy</p>
<p class="font-20 fw-400 text-dark">Fave provides rewards and payments conveniences to customer in an all-in-one platform that help local businesses grow more revenue.</p>
</div>
</div>
</div>
</div>
<div class="row">
<div class="col-lg-6 pt-5 order-4 order-lg-3">

<div class="shoping-steps-disc d-flex h-100">
<div class="my-auto text-center text-lg-left">
<p class="prt-title font-36 fw-700 text-muted">Moola101 makes loyalty easy</p>
<p class="font-20 fw-400 text-dark">Fave provides rewards and payments conveniences to customer in an all-in-one platform that help local businesses grow more revenue.</p>
</div>
</div>
</div>
<div class="col-lg-6 pt-5 order-3 order-lg-4">
<div class="shoping-steps-image text-center">
<img src="http://moola101.ga/uploads/images/Laptop-2.png" class="img-fluid" alt="">
</div>
</div>
</div>
<div class="row">
<div class="col-lg-6 pt-5 order-1 order-lg-1">

<div class="shoping-steps-image text-center">
<img src="http://moola101.ga/uploads/images/Laptop-1.png" class="img-fluid" alt="">
</div>
</div>
<div class="col-lg-6 pt-5 order-2 order-lg-2">
<div class="shoping-steps-disc d-flex h-100">
<div class="my-auto text-center text-lg-left">
<p class="prt-title font-36 fw-700 text-muted">Moola101 makes loyalty easy</p>
<p class="font-20 fw-400 text-dark">Fave provides rewards and payments conveniences to customer in an all-in-one platform that help local businesses grow more revenue.</p>
</div>
</div>
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

<!-- Testinomial section -->
<section class="coustomers-testi py-5  bg-white">
<div class="container">
  <h1 class="text-muted font-36 fw-700 text-center d-block"> {{__('public/hiw-and-pop.hiw_tesinomial_txt_old')}}</h1>
  <div class="prt-testinomial">
  <div class="owl-carousel owl-theme owl-loaded owl-drag">
    @foreach($data['testinomial'] as $testi)
    <div class="item py-5 ml-1">
      <div class="top-cpn-box c-testi-card border rounded p-5 p-lg-5 shadow-sm">
        <!-- <div class="text-center mb-3">
          <div class="c-avtar">
            <img src="{{asset($testi->block_image)}}" class="rounded-circle" alt="">
          </div>
        </div> -->
        <div class="c-name text-center">
          <p class="text-muted font-18 fw-700">{!! $testi->title !!}</p>
        </div>
        <div class="c-review text-center">
          <p class="secondary-text font-15 fw-400 px-4 mb-4">{!! $testi->block_content !!}</p>
        </div>

      </div>
    </div>
    @endforeach

   </div>
  </div>
</div>
</section>
<!-- End Testinomial section -->

<!-- FAQ section -->
<section class="hiw-faq py-5">
<div class="container">
  <h3 class="hiw-title text-muted font-36 fw-700 text-center mb-3 mb-lg-5 d-block">{{__('public/hiw-and-pop.hiw_faq_title')}}</h3>
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
<!-- End FAQ section -->

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

@include('public/partner/partials.video-pop')

  <!-- <script type="text/javascript" src="{{asset('public_assets/js/page.js')}}"></script>
  <script type="text/javascript">

  </script> -->
@endsection
