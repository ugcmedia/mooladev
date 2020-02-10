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
?>
<section class="sec-page-header" style="background-image:url('{{$pageimage}}')">
  <div class="container">
    <!-- <div class="row">
      <div class="col-lg-12">
        <div class="db-breadcrumb">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('public/listing.home')}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{__('public/listing.all_stores')}}</li>
            </ol>
          </nav>
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="col-lg-6 col-md-8">
        <h1 class="page-title-h1">{!! $data['pageInfo']->title!!} </h1>
        <p>{!! $data['pageInfo']->note!!}</p>
      </div>
    </div>
  </div>
</section>

<section class="how-refer-works py-5">
<div class="container">
  <div class="h2 text-center  mb-5">{!! $data['pageInfo']->heading!!}</div>
  <span class="how-refer-title font-24 text-muted text-center fw-900 mb-4 d-block">{{__('public/common.follow_our_journey')}} </span>
  <p class="time-line-devider mb-0"></p>
  <div class="refer-time-line">

    @php $i = 1;  @endphp
    @foreach($data['referEarn'] as $refer)
     @if($i%2 == 0)
     <div class="row">
       <div class="col-lg-6 pt-5 order-4 order-lg-3 p-left">
         <div class="penal-no">
           {{$i}}
         </div>
         <div class="shoping-steps-disc d-flex align-items-center flex-column h-100">
           <div class="my-auto text-center text-lg-left">
             <span class="font-40 fw-700 text-muted">{!! $refer->title!!}</span>
             <p class="font-15 fw-400 text-dark"><?php echo str_ireplace(array('#REF_EARN','#REF_BONUS','#REF_JOIN'),array(config('settingConfig.mlm_split'),round($data['BonusForRefer']->bonus_amount),round($data['BonusForJoin']->bonus_amount)), $refer->block_content) ?></p>
           </div>
           </div>
         </div>
         <div class="col-lg-6 pt-5 order-3 order-lg-4">
           <div class="shoping-steps-image text-center">
             <img src="{{asset('uploads/images/blocks').'/'.$refer->block_image}}" class="img-fluid" alt="">
           </div>
         </div>
       </div>
        @else
        <div class="row">
         <div class="col-lg-6 pt-5 order-1 order-lg-1 p-left">
           <div class="penal-no">
           {{$i}}
           </div>
           <div class="shoping-steps-image text-center">
             <img src="{{asset('uploads/images/blocks').'/'.$refer->block_image}}" class="img-fluid" alt="">
           </div>
         </div>
         <div class="col-lg-6 pt-5 order-2 order-lg-2">
           <div class="shoping-steps-disc d-flex align-items-center flex-column h-100">
             <div class="my-auto text-center text-lg-left">
               <span class="font-40 fw-700 text-muted">{!! $refer->title !!}</span>
               <p class="font-15 fw-400 text-dark"><?php echo str_ireplace(array('#REF_EARN','#REF_BONUS','#REF_JOIN'),array(config('settingConfig.mlm_split'),round($data['BonusForRefer']->bonus_amount),round($data['BonusForJoin']->bonus_amount)), $refer->block_content) ?></p>
             </div>
             </div>
           </div>
         </div>
      @endif
    @php $i++ @endphp
   @endforeach
  </div>

  <p class="time-line-devider mb-0"></p>
  <div class="text-center mb-3 mt-5">{!! $data['pageInfo']->footer_note!!}</p>
  <div class="signup-refer text-center mt-0 mt-lg-5">
      <button type="button" class="btn btn-secondary font-20 fw-700"  data-toggle="modal" data-dismiss="modal" data-target="#join-us-modal">{{__('public/referandearn.signup_refer_btn')}}</button>
  </div>
  </div>
</section>

@endsection
