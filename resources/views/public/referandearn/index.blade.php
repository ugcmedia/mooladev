
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


<?php
//dd($data);
?>

<section class="refer-banner">
  <div class="container">
    <div class="refer-banner-cont text-center">
      <span class="banner-title text-white font-48 fw-700 my-4">{!! str_ireplace('#REFAMT','<span class="refer-cb">'.config('settingConfig.mlm_split').'%</span>',$data['pageInfo']->heading) !!} </span>
      <span class="banner-desc text-white font-24 d-block mb-4">{{__('public/referandearn.sub_title')}}</span>
      <button class="btn btn-primary font-18 fw-400 mt-2" data-dismiss="modal" data-toggle="modal" data-target="#join-us-modal" id="show-msg">{{__('public/referandearn.refr_now_btn')}}</button>
      <!-- <button type="button" class="btn btn-primary" id="show-msg">{{__('public/referandearn.refr_now_btn')}}</button> -->
    </div>
  </div>
</section>

<section class="how-refer-works py-5">
<div class="container">
  <span class="how-refer-title font-36 text-muted text-center fw-700 mb-5 d-block">{{__('public/referandearn.how_refer_earn_works_title')}} </span>
  <p class="time-line-devider mb-0"></p>
  <div class="refer-time-line">

    @php $i = 1;  @endphp
    @foreach($data['refer_hiw'] as $refer)
     @if($i%2 == 0)
     <div class="row">
       <div class="col-lg-6 pt-lg-5 pt-3 order-4 order-lg-3 p-left">
         <div class="penal-no">
           {{$i}}
         </div>
         <div class="shoping-steps-disc d-flex align-items-center flex-column h-100">
           <div class="my-auto text-center text-lg-left">
             <span class="font-32 fw-700 text-muted ref-title">{!! $refer->title!!}</span>
             <p class="font-15 fw-400 text-dark ref-desc">{!!  $refer->block_content !!}</p>

           </div>
           </div>
         </div>
         <div class="col-lg-6 pt-lg-5 pt-3 order-3 order-lg-4">
           <div class="shoping-steps-image text-center">
             <!-- <img src="{{asset('uploads/images/blocks').'/'.$refer->block_image}}" class="img-fluid" alt=""> -->
              <img src="{{asset($refer->block_image)}}" class="img-fluid" alt="">
           </div>
         </div>
       </div>
        @else
        <div class="row">
         <div class="col-lg-6 pt-lg-5 pt-3 order-1 order-lg-1 p-left">
           <div class="penal-no">
           {{$i}}
           </div>
           <div class="shoping-steps-image text-center">
             <!-- <img src="{{asset('uploads/images/blocks').'/'.$refer->block_image}}" class="img-fluid" alt=""> -->
             <img src="{{asset($refer->block_image)}}" class="img-fluid" alt="">
           </div>
         </div>
         <div class="col-lg-6 pt-lg-5 pt-3 order-2 order-lg-2">
           <div class="shoping-steps-disc d-flex align-items-center flex-column h-100">
             <div class="my-auto text-center text-lg-left">
               <span class="font-32 fw-700 text-muted ref-title">{!! $refer->title !!}</span>
               <p class="font-15 fw-400 text-dark ref-desc">{!!  $refer->block_content !!}</p>
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
  <div class="signup-refer text-center mt-3 mt-md-5">
      <button type="button" class="btn btn-primary font-18 fw-700"  data-toggle="modal" data-dismiss="modal" data-target="#join-us-modal">{{__('public/referandearn.signup_refer_btn')}}</button>
  </div>
</section>

<!-- hp-jion-now -->

<!--Join Now  -->
@if(!Auth::guard('member')->check())
@include('public/homepage/partials/signup-banner')
@endif
<!--End Join Now  -->

<section class="hiw-faq py-5">
<div class="container">
  <h3 class="hiw-title text-muted font-36 fw-700 text-center mb-5 d-block">{{__('public/hiw-and-pop.hiw_faq_title')}}</h3>
  <!-- <div class="accordion" id="accordionExample">
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
 </div> -->

 <div class="accordion" id="accordionExample" aria-multiselectable="true">
   @php $j=0; @endphp
   @foreach($data['refer_faq']  as $reFaq)
    <div class="card  round-0">
     <div class="card-header  border-bottom-0" id="heading{{$reFaq->faq_id}}">
       <span class="panel-title mb-0">
         <button class="btn btn-link d-block w-100 text-left  text-muted font-18 fw-700 px-0 @if($j != 0) collapsed @endif" type="button" data-toggle="collapse" data-target="#collapse{{$reFaq->faq_id}}" aria-expanded="@if($j == 0)  true @endif" aria-controls="collapse{{$reFaq->faq_id}}">
           {{$reFaq->faq_title}}
         </button>
       </span>
     </div>

     <div id="collapse{{$reFaq->faq_id}}" class="collapse @if($j == 0) show @endif" aria-labelledby="heading{{$reFaq->faq_id}}" data-parent="#accordionExample">
       <div class="card-body p-1 font-15 secondary-text fw-400">
         {!!$reFaq->faq_desc !!}
       </div>
     </div>
   </div>
   @php $j++; @endphp
   @endforeach
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
