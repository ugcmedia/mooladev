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


<!-- hoe it works page -->

<section class="h-i-w-banner">
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
</section>

<section class="how-it-works-home py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col-lg-12 text-center">
        <h2 class="section-title font-24 fw-800">{{__('public/homepage.hp_how_to_get_cb')}} {{config('sximo.cnf_appname')}}?</h2>
      </div>
    </div>
    <div class="h-i-w-home-cont">
      <div class="row">
        <?php $i= 0;
          $howitWorks = AppClass::getHIW();
          $total      = count($howitWorks);
         ?>
         @foreach($howitWorks as $hiw )
         <?php $i++; ?>
            <div class="col-lg-3 mob-br col-md-6 text-center {{ ($i == $total)? 'last' : 0 }}">
              <div class="h-i-w-step">
                <img src="{{asset('uploads/images/blocks').'/'.$hiw->block_image}}" alt="">
              </div>
              <div class="h-step-num position-relative">
                <div class="h-step-count">
                  <span>{{$i}}</span>
                </div>
                <div class="h-step-name">
                  @if($i == $total)
                    <span class="font-40 fw-700 primary-text mb-0 d-inline-block">{{$hiw->title}}</span>
                  @else
                  <p class="font-40 fw-700 primary-text mb-0 d-inline-block">{{$hiw->title}}</p>
                  @endif
                </div>
              </div>
              <p class="text-dark font-13 fw-400">{!! $hiw->block_content !!} </p>
            </div>
          @endforeach
        </div>

    </div>

  </div>
</section>

<section class="why-we-pay py-5">
<div class="container">
  <div class="wf-title text-center mb-5">
    <span class="text-muted font-24 fw-800">{{__('public/hiw-and-pop.hiw_why_pay_money')}} </span>
    <p class="text-muted font-15 fw-400">{{__('public/hiw-and-pop.hiw_why_pay_money_desc')}} </p>
  </div>
<div class="why-we-steps">
  <div class="row no-gutters">

    <div class="col-lg-4">
      <div class="why-we-cont d-flex justify-content-center align-items-center div-inner-white p-3">
        <div class="why-no mr-3">

          {{__('public/hiw-and-pop.hiw_why_pay_money_number_one')}}
        </div>
        <div class="why-disc">
          <p class="secondary-text font-18 fw-400 mb-0"> {{__('public/hiw-and-pop.hiw_why_pay_money_number_one_text')}}</p>
        </div>
      </div>
      <div class="right-shape">
        <i class="right"></i>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="why-we-cont d-flex justify-content-center align-items-center div-inner-white p-3">
        <div class="why-no mr-3">
          {{__('public/hiw-and-pop.hiw_why_pay_money_number_two')}}
        </div>
        <div class="why-disc">
          <p class="secondary-text font-18 fw-400 mb-0">{{__('public/hiw-and-pop.hiw_why_pay_money_number_two_text')}}</p>
        </div>
      </div>
      <div class="right-shape">
        <i class="right"></i>
      </div>
    </div>
    <div class="col-lg-4">
      <div class="why-we-cont d-flex justify-content-center align-items-center div-inner-white p-3">
        <div class="why-no-last mr-3">
          {{__('public/hiw-and-pop.hiw_why_pay_money_number_three')}}
        </div>
        <div class="why-disc">
          <p class="font-18 fw-400 mb-0"> {{__('public/hiw-and-pop.hiw_why_pay_money_number_three_text')}}</p>
        </div>
      </div>
      <div class="right-shape last">
        <i class="right"></i>
      </div>
    </div>
  </div>
 </div>
</div>
</section>

<section class="shoping-steps py-5">
<div class="container">
<div class="row">
  @php $i = 0;
    $blockDetail = AppClass::getBlockContent('hiw_details');
   @endphp
  @foreach($blockDetail as $dBlock)
    @if($i%2 == 0)
        <div class="col-lg-6 mb-5 order-1 order-lg-{{$i}}">
          <div class="shoping-steps-image text-center">
            <img src="{{asset('uploads/images/blocks').'/'.$dBlock->block_image}}" class="img-fluid" alt="">
          </div>
        </div>
        <div class="col-lg-6 mb-5 order-2 order-lg-{{$i}}">
          <div class="shoping-steps-disc d-flex align-items-start flex-column h-100">
            <div class="my-auto">
              <h3 class="font-40 fw-700 text-muted">{{$dBlock->title}}</h3>
              <p class="font-15 fw-400 text-dark">{!! $dBlock->block_content !!}</p>
            </div>
            </div>
          </div>
        @else
        <div class="col-lg-6 mb-5 order-4 order-lg-{{$i}}">
          <div class="shoping-steps-disc d-flex align-items-start flex-column h-100">
            <div class="my-auto">
              <span class="font-40 fw-700 text-muted">{{$dBlock->title}}</span>
              <p class="font-15 fw-400 text-dark">{!! $dBlock->block_content !!}</p>
            </div>
            </div>
          </div>
          <div class="col-lg-6 mb-5 order-3 order-lg-{{$i}}">
            <div class="shoping-steps-image text-center">
              <img src="{{asset('uploads/images/blocks').'/'.$dBlock->block_image}}" class="img-fluid" alt="">
            </div>
          </div>
    @endif
    @php $i++; @endphp
  @endforeach

  </div>
</div>
</section>

<section class="withdraw-funds primary-bg py-5">
<div class="container">
  <div class="wf-title text-center mb-5">
    <span class="success-text font-24 fw-800">{{__('public/hiw-and-pop.hiw_withdraw_title')}}</span>
    <p class="success-text font-15 fw-400">{!! __('public/hiw-and-pop.hiw_withdraw_desc') !!}</p>
  </div>

  <div class="row wf-card-wrapp">
    @foreach($data['withdrawtype'] as $withdrawType)
    <div class="col-xxl-4 col-lg-3 col-sm-6 mb-4 mb-lg-0">
      <div class="wf-card p-4 p-md-5 div-inner-white rounded text-center">
        <img src="{{asset('uploads/images').'/'.$withdrawType->image}}" class="img-fluid" alt="">
      </div>
    </div>
    @endforeach
  </div>

 </div>
</section>

<section class="hiw-user-stats py-5">
<div class="container">
  <span class="hiw-u-stats-title text-muted font-24 fw-800 text-center d-block mb-5">{{__('public/hiw-and-pop.hiw_number_number_speak_txt') }}</span>
  <div class="row">
    @php     $HiwStates = AppClass::getBlockContent('hiw_stats');  @endphp
    @foreach($HiwStates as $hstate)
      <div class="col-sm-4 mb-5 mb-sm-0">
        <div class="hiw-stats-card div-inner-white rounded shadow p-4">
          <img src="{{asset('uploads/images/blocks').'/'.$hstate->block_image}}" class="d-block mb-4" alt="">
          <span class="font-48 fw-800 primary-text">{{str_ireplace('#CURRENCY',config('sximo.cnf_currencyname'),$hstate->title)}}</span>
          <p class="text-muted font-24 fw-400">{!! $hstate->block_content !!}</p>
        </div>
      </div>
    @endforeach

  </div>
</div>
</section>

<section class="coustomers-testi py-5 div-inner-white">
<div class="container">
  <span class="text-muted font-24 fw-800 text-center d-block"> {{__('public/hiw-and-pop.hiw_tesinomial_txt')}}</span>
  <div id="top-testinomial-and-cb-owl">
  <div class="owl-carousel owl-theme">
    @foreach($data['testinomial'] as $testino)
    <div class="item py-5">
      <div class="top-cpn-box c-testi-card div-inner-white border rounded p-5 p-lg-3">
        <div class="c-cote text-right1">
        </div>
        <div class="d-flex align-items-center mb-3">
          <div class="c-avtar mr-3">
            <img src="{{asset('uploads/images/user').'/'.$testino->user_image}}" class="rounded-circle" alt="">
          </div>
          <div class="c-name">
            <p class="text-muted font-18 fw-800">{{$testino->name}}</p>
          </div>
        </div>
      <div class="c-review">
        <p class="secondary-text font-15 fw-400">{!! $testino->comment !!}</p>
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
  <span class="text-muted font-24 fw-800 text-center mb-5 d-block">{{__('public/hiw-and-pop.hiw_faq_title')}}</span>
  <div class="accordion" id="accordionExample" aria-multiselectable="true">
    @php $j=0; @endphp
    @foreach($data['faq']  as $faq)
     <div class="card mb-4 div-inner-white border-0 round-0">
      <div class="card-header div-inner-white border-bottom-0" id="heading{{$faq->faq_id}}">
        <span class="panel-title mb-0">
          <button class="btn btn-link d-block w-100 text-left  text-muted font-18 fw-900 px-4 @if($j != 0) collapsed @endif" type="button" data-toggle="collapse" data-target="#collapse{{$faq->faq_id}}" aria-expanded="@if($j == 0)  true @endif" aria-controls="collapse{{$faq->faq_id}}">
            {{$faq->faq_title}}
          </button>
        </span>
      </div>

      <div id="collapse{{$faq->faq_id}}" class="collapse @if($j == 0) show @endif" aria-labelledby="heading{{$faq->faq_id}}" data-parent="#accordionExample">
        <div class="card-body mx-3 border-top font-15 secondary-text fw-400">
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
  <section class="hiw-join-now py-5 text-center">
    <div class="container">
    <span class="font-40 fw-400 text-dark mb-5 d-block">{{__('public/hiw-and-pop.login_join_title')}} </span>
    <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#join-us-modal">
      <button type="button" class="btn btn-info font-18 fw-400 px-3 mr-3">{{__('public/hiw-and-pop.join_now_btn')}}  </button>
    </a>
    <button type="button" data-toggle="modal" data-target="#login-modal" class="btn btn-outline-dark font-18 fw-400 px-4">{{__('public/hiw-and-pop.login_btn')}} </button>
    </div>
  </section>
  @endif
  @include('public/howitworks/partials.video-pop')

  <script type="text/javascript" src="{{asset('public_assets/js/page.js')}}"></script>
  <script type="text/javascript">

  </script>
@endsection
