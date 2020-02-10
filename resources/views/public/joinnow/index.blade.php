<?php
$joinToolTip = AppClass::getTips();
 $ref_code_optional = '';
 foreach ($joinToolTip as $key => $value) {
   if($value->tip_key == 'optional_ref_code') {
     $ref_code_optional = $value->note;
   }
 }

?>
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
<?php
$referCode  = '';
if(isset($_GET['referal_code'])) {
  $referCode = $_GET['referal_code'];
}
if(isset($_COOKIE[config('settingConfig.dev_cookie_prefix').'dealsBagRAE'])) {
    $referCode = $_COOKIE[config('settingConfig.dev_cookie_prefix').'dealsBagRAE'];
}
?>
@section('content')

<section class="join-us-main">
<div class="koin-us-content py-5">
<div class="container">
<div class="row no-gutters">
  <div class="col-lg-6">
    <div class="join-us-banner text-center d-flex flex-column p-3">
      <h1 class="join-us-title font-32 fw-900 success-text">{{__('public/join-now.join_now_title')}}</h1>
      <div class="d-logo m-auto">
        <img src="{{asset('public_assets/images/DW_Header_70.png')}}" class="img-fluid" alt="">
      </div>
      <div class="join-us-benifit">
      <div class="row">
        @if(Count($data['leftContent']) > 0)
          @foreach($data['leftContent'] as $left)
            <div class="col-md-4">
              <div class="join-b-image mb-2">
                <img src="{{asset('uploads/images/blocks').'/'.$left->block_image}}" alt="{!! $left->title !!}">
              </div>
              <span class="jb-title success-text font-24 fw-700">{!! $left->title !!}</span>
              <p class="success-text font-14 fw-400">  {!! $left->block_content !!}</p>
            </div>
          @endforeach
        @endif

      </div>
    </div>
  </div>
</div>

  <div class="col-lg-6">
    <div class="join-us-page-cont p-3 px-0 px-lg-5 div-inner-white">
      <div class="join-us-header pb-4 border-bottom">
        <p class="font-15 secondary-text fw-400 text-center">{{__('public/join-now.join_us_following')}}</p>
        <div class="social-login-ico text-center mb-3">
          <a href="{{ url('/auth/facebook') }}"><i class="fb fab fa-facebook-f"></i></a>
          <a href="{{ url('/auth/google') }}"><i class="g-plus fab fa-google-plus-g"></i></a>
        </div>
        <p class="font-12 fw-400 secondary-text-light text-center">{{__('public/join-now.join_us_desc')}}</p>
      </div>
      <div class="join-us-form pt-5">
        <div class="join-Now-msg">  </div>
        <form  method="POST" action="{{ route('joinNow') }}">
          {{ csrf_field() }}
          <input type="hidden" name="from_join" value="1">
          <div class="form-row">
            <div class="col-md-6">
              <input type="text" class="form-control font-15 text-dark mb-3"  name="first_name" placeholder="{{__('public/join-now.first_name_placeholder')}}" value="{{ old('first_name') }}" required>
            </div>
            <div class="col-md-6">
              <input type="text" class="form-control font-15 text-dark mb-3" name="last_name" placeholder="{{__('public/join-now.last_name_placeholder')}}" value="{{ old('last_name') }}">
            </div>
            <div class="col-md-12">
              <input type="email" class="form-control font-15 text-dark mb-3" name="email" placeholder="{{__('public/join-now.email_placeholder')}}" placeholder="E-mail"  value="{{ old('email') }}" required>
            </div>
            <div class="col-md-12">
              <!-- <input type="password" class="form-control font-15 text-dark mb-3" placeholder="Password"> -->
              <input id="join-signup-password" type="password" class="form-control text-dark font-15 mb-3" name="password"   placeholder="{{__('public/join-now.password_placeholder')}}"  required>
              <span toggle="#password-fields-join" class="fa fa-fw fa-eye field-icon toggle-password-join"></span>
            </div>
            <div class="col-md-12">
              <div class="input-group mb-3">
              <input type="text" class="form-control font-15 text-dark" value="{{$referCode}}" name="refer_code" type="text"  placeholder="{{__('public/join-now.referral_code_placeholder')}} " value="{{ old('refer_code') }}">
              <div class="input-group-append">
                <span class="input-group-text text-dark">{{__('public/join-now.its_optional_txt')}}
                  <i class="far fa-question-circle text-primary float-right ml-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{$ref_code_optional}}"></i>
                </span>
              </div>
            </div>
            </div>
            <div class="fieldset mb-3">
              <!-- <div class="row"> -->
                <div class="col-md-12 pl-2">
                  <div class="form-group has-feedback  animated fadeInLeft delayp1">
                    <label class="text-left"> Are u human ? </label>
                    <div class="g-recaptcha" data-sitekey="{{ config('sximo.cnf_recaptchapublickey') }}"></div>
                    <div class="clr"></div>
                  </div>
                </div>
              <!-- </div> -->
            </div>
            <div class="col-md-12 mb-4">
              <button type="submit" class="btn btn-primary btn-block font-20 fw-700 p-3 mb-3">{{__('public/join-now.create_account_btn')}}</button>
              <button type="button" class="btn btn-light btn-block text-dark font-15 fw-700 p-3 mb-3" data-toggle="modal" data-target="#login-modal" data-dismiss="modal">{{__('public/join-now.already_member_btn')}}</button>
            </div>
            <div class="col-md-12 text-center">

                <p class="font-13 secondary-text-light fw-400"><span class="d-block d-md-inline-block">{{__('public/join-now.by_joining_txt')}}</span>
                  <a href="{{url('terms-of-use') }}" class="font-13 primary-link fw-400">{{__('public/join-now.terms_condition_txt')}}</a> {{__('public/join-now.and')}}
                  <a href="{{url('privacy') }}" class="font-13 primary-link fw-400">{{__('public/join-now.privacy_txt')}}</a>
                </p>
                <p class="secondary-text-light text-center font-13 fw-400">{{__('public/join-now.qualify_txt',['currency_name' => config('sximo.cnf_currencyname'),'amount' =>$data['bonus_info']->bonus_amount,'days' =>  $data['bonus_info']->validity_days])}}</p>
            </div>
          </div>
      </form>
      </div>
    </div>
  </div>
</div>
</div>
</div>
</section>
<script type="text/javascript">
//show hidden passsword
//refresh Captcha
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip()
    $(".btn-refresh-join").click(function(){
      $.ajax({
         type:'GET',
         url:'/refresh_captcha',
         success:function(data){
            $(".captcha span").html(data.captcha);
         }
      });
    });


  //show hidden passsword
  $(".toggle-password-join").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));

    if ($('#join-signup-password').attr("type") == "password") {
      $('#join-signup-password') .attr("type", "text");
    } else {
      $('#join-signup-password') .attr("type", "password");
    }
  });
    });
</script>
@endsection
