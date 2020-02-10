
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
<link rel="stylesheet" href="{{asset('public_assets/css/how-it-works-style.css')}}">
<link rel="stylesheet" href="{{asset('public_assets/css/refer-and-earn.css')}}">

<section class="refer-banner">
  <div class="container">
    <div class="refer-banner-cont text-center">
      <h1 class="text-muted font-48 fw-900">{!! str_ireplace('#REFAMT','<span class="refer-cb">'.config('settingConfig.mlm_split').'%</span>',$data['pageInfo']->heading) !!} </h1>
      <span class="promo-text font-40 fw-700 d-block mb-3">{{__('public/referandearn.sub_title')}}</span>
      <button type="button" class="btn btn-primary" id="show-msg">{{__('public/referandearn.refr_now_btn')}}</button>
    </div>
  </div>
</section>

<section class="how-refer-works py-5">
<div class="container">
  <span class="how-refer-title font-24 text-muted text-center fw-900 mb-5 d-block">{{__('public/referandearn.how_refer_earn_works_title')}} </span>
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
  </div>
  <p class="time-line-devider mb-0"></p>
  <div class="signup-refer text-center mt-0 mt-lg-5">
      <button type="button" class="btn btn-secondary font-20 fw-700"  data-toggle="modal" data-dismiss="modal" data-target="#join-us-modal">{{__('public/referandearn.signup_refer_btn')}}</button>
  </div>
</section>

<section class="refer-friend py-5">
  <h2 class="font-24 fw-900 success-text text-center mb-5">{{__('public/referandearn.why_refer_txt')}}</h2>
  <div class="container">
    <div class="row">
      @php $whyReferBlock = AppClass::getBlockContent('refer_why'); @endphp
      @foreach($whyReferBlock as $wrefer)
        <div class="col-md-4">
          <div class="refer-frnd-cont text-center">
            <img src="{{asset('uploads/images/blocks').'/'.$wrefer->block_image}}" class="img-fluid" alt="">
            <p class="font-20 fw-700 success-text mt-3">{{$wrefer->title}}</p>
          </div>
        </div>
      @endforeach
    </div>
  </div>
</section>

<section class="hiw-faq py-5">
<div class="container">
  <span class="text-muted font-24 fw-800 text-center mb-5 d-block">{{__('public/referandearn.faq_title')}}</span>
  <div class="accordion" id="accordionExample">
    @php $j=0; @endphp
    @foreach($data['refer_faq']  as $reFaq)
     <div class="card mb-4 div-inner-white border-0 round-0">
      <div class="card-header div-inner-white border-bottom-0" id="heading{{$reFaq->faq_id}}">
        <h5 class="panel-title mb-0">
          <button class="btn btn-link d-block w-100 text-left  text-muted font-18 fw-900 px-4 @if($j != 0) collapsed @endif" type="button" data-toggle="collapse" data-target="#collapse{{$reFaq->faq_id}}" aria-expanded="@if($j == 0)  true @endif" aria-controls="collapse{{$reFaq->faq_id}}">
            {{$reFaq->faq_title}}
          </button>
        </h5>
      </div>

      <div id="collapse{{$reFaq->faq_id}}" class="collapse @if($j == 0) show @endif" aria-labelledby="heading{{$reFaq->faq_id}}" data-parent="#accordionExample">
        <div class="card-body mx-3 border-top font-15 secondary-text fw-400">
          {!!$reFaq->faq_desc !!}
        </div>
      </div>
    </div>
    @php $j++; @endphp
    @endforeach
 </div>
</div>
</section>

<section class="refer-now py-5">
<div class="container">
  <div class="row flex-row-reverse">
    @php
          $bonusData = AppClass::getBonusType('join_bonus');
          $referAmt  = AppClass::getBonusType('referral_bonus');
    @endphp
    <div class="col-lg-6 col-sm-7">
      <span class="refer-now-title font-60 fw-900 text-dark">{!!__('public/referandearn.refer_title',['amount' => $referAmt->bonus_amount ]) !!} </span>
      <p class="refer-now-disc font-24 text-dark fw-600">{{__('public/referandearn.refer_sub_title',['bonus' => $bonusData->bonus_amount ])}}</p>
      <p class="no-limit font-20 fw-400 text-dark">{{__('public/referandearn.refer_desc')}}</p>
      <div class="refer-now-button ">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#login-modal">{{__('public/referandearn.refer_now_btn')}}</button>
      </div>

    </div>
  </div>
</div>
</section>
<script type="text/javascript">
  $(document).ready(function(){
    $('#show-msg').click(function(){
        ToasterUnTargetedMessages(500,"{{__('public/referandearn.login_to_refer')}}",'bottomCenter')
    })
  })
</script>
@endsection
