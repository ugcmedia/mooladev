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
@php
function ul_to_array($ul) {
  if (is_string($ul)) {
    // encode ampersand appropiately to avoid parsing warnings
    $ul=preg_replace('/&(?!#?[a-z0-9]+;)/', '&amp;', $ul);
    if (!$ul = simplexml_load_string($ul)) {
      trigger_error("Syntax error in UL/LI structure");
      return FALSE;
    }
    return ul_to_array($ul);
  } else if (is_object($ul)) {
    $output = array();
    foreach ($ul->li as $li) {
      $output[] = (isset($li->ul)) ? ul_to_array($li->ul) : (string) $li;
    }
    return $output;
  } else return FALSE;
}
@endphp
@section('content')

<link rel="stylesheet" href="{{asset('public_assets/css/how-it-works-style.css')}}">
<section class="whatsapp-banner py-5">
<div class="container">
  <div class="row">
    <div class="col-lg-8">
      <div class="w-banner-header d-flex pb-5 pb-lg-0">
        <div class="w-b-logo mr-3">
            <img src="{{asset('public_assets/images/whatsApp.png')}}" class="img-fluid" alt="">
        </div>
          <div class="w-banner-title">
            <h1 class="text-muted font-60 fw-700">{!! $data['pageInfo']->heading !!}
            </h1>
          </div>
        </div>
    </div>

    <div class="col-lg-4">
      @php
      $msg = config('settingConfig.social_whatsapp_sendtxt').config('settingConfig.social_whatsapp_body');
      @endphp
      <div class="w-start-steps-wrapp div-inner-white p-4 rounded">
        <div class="d-md-none text-center">
          <div class="text-dark  font-18 fw-700 mb-2">{!! __('public/whatsapp.mobile_tittle') !!}</div>
          <a href="whatsapp://send?text=$msg&phone=+{{config('settingConfig.social_whatsapp_number')}}&abid=+{{config('social_whatsapp_number')}}" class="btn btn-primary mb-2 d-inline-block" >
            <i class="far fa-arrow-alt-circle-right"></i> {!! __('public/whatsapp.btn_subscribe') !!}
          </a>
          <div class="text-dark  font-22 fw-900 mb-2">OR</div>
        </div>
        @php $i = 1; @endphp

        @foreach(ul_to_array($data['pageInfo']->note) as $whatsup)
        <div class="w-start-steps d-flex mb-4 align-items-start">
          <div class="w-s-no  primary-bg">
            <p class="mb-0 success-text">{{$i}}</p>
          </div>
          <div class="w-s-cont">
            <!-- <p class="mb-0 font-20 text-muted fw-400">Add <strong class="text-dark">+919741266796</strong> to your contacts as DealWoot Official.</p> -->
            <p class="mb-0 font-20 text-muted fw-400">
                {!! str_ireplace(['#WPNUMBER','#WPSENDTEXT'],[' <strong class="text-dark">+'.config('settingConfig.social_whatsapp_number').'</strong>',' <strong class="text-dark">'."'".config('settingConfig.social_whatsapp_sendtxt')."'".'</strong>'],$whatsup)     !!}
            </p>
          </div>
        </div>
        @php  $i++; @endphp
        @endforeach
      </div>
    </div>
  </div>
</div>
</section>

<section class="w-invite d-none d-md-none d-lg-block">
  <div class="row no-gutters k">
    <div class="col-lg-6 d-flex  flex-coloumn align-items-center justify-content-center w-mob-alert ">
      <div class="text-center p-3">
        <div class="success-text font-24 fw-900 mb-4"> {!! __('public/whatsapp.get_invite_txt') !!}</div>
        <div class="subscription-whatsapp-msg iziToast-target"></div>
        <form >
          <div class="mob-link-form whats-app">
            <div class="input-group div-inner-white rounded shadow" style="margin: auto;">
          <div class="input-group-prepend p-2">
            <div class="input-group-text div-inner-white border-0">+91</div>
          </div>
          <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" id="whats_num" class="form-control border-left" placeholder=" {!! __('public/whatsapp.mobile_number_holder') !!}">
          <button type="button" onclick="subscribeWhatsApp('{{route('subsribe.whatsapp')}}','subscription-whatsapp-msg')"    class="btn btn-primary"><i  class="fas fa-chevron-right"></i></button>
        </div>
      </div>
      </form>
      </div>
    </div>

    <div class="col-lg-6 paytm-gift-wrapp d-flex flex-column align-items-center">
      <div class="text-center p-3">
        <img src="{{asset('public_assets/images/Paytm-tr.png')}}" class="img-fluid mb-4" alt="">
        <div class="success-text font-24 fw-900">{!! __('public/whatsapp.luckky_win_title') !!}</div>
      </div>
    </div>
  </div>
</section>

<section class="whatsapp-group py-5">
<div class="container">
  <h2 class="font-24 text-muted fw-900 text-center">{!! __('public/whatsapp.join_group_title') !!}</h2>
  <div class="whatsapp-grp-wrapp border-bottom pt-5">
    <div class="row">
    @php $whatsappBlock = AppClass::getBlockContent('whatsapp_details');  @endphp
    @foreach($whatsappBlock as $wab)
      <div class="col-sm-4">
        <div class="whatsapp-grp-cont text-center">
          <img src="{{asset('uploads/images/blocks').'/'.$wab->block_image}}" class="img-fluid" alt="">
          <span class="font24 fw-700 text-muted mb-3">{{$wab->title}}</span>
          <p class="font-15 fw-400 text-dark">{!! $wab->block_content !!}</p>
        </div>
      </div>
    @endforeach

    </div>
  </div>
</div>
</section>

<section class="hiw-faq py-5">
<div class="container">
  <span class="text-muted font-24 fw-800 text-center mb-5">{!! __('public/whatsapp.faq_title') !!}</span>
  <div class="accordion" id="accordionExample">
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
<script type="text/javascript">

</script>
@endsection
