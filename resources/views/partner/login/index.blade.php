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
<?php /* @section('title')
  {!! $data['pageInfo']->title!!}
@endsection */ ?>

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
  <div class="col-lg-6 offset-lg-3">
    <h2 class="text-center">{{__('partner/multi_lang.vendor_login_title')}}</h2>
    <div class="join-us-page-cont p-3 px-0 px-lg-5 div-inner-white">
      <!-- <div class="join-us-header pb-4 border-bottom">
        <p class="font-15 secondary-text fw-400 text-center">{{__('public/join-now.join_us_following')}}</p>
        <div class="social-login-ico text-center mb-3">
          <a href="{{ url('/auth/facebook') }}"><i class="fb fab fa-facebook-f"></i></a>
          <a href="{{ url('/auth/google') }}"><i class="g-plus fab fa-google-plus-g"></i></a>
        </div>
        <p class="font-12 fw-400 secondary-text-light text-center">{{__('public/join-now.join_us_desc')}}</p>
      </div> -->
      <div class="join-us-form pt-5">
        <div class="join-Now-msg">  </div>

      <form class="cd-form" method="post" action="{{url('partner/doLogin')}}">
          {{ csrf_field() }}
          <div class="form-row">
            <div class="col-md-12">
              <input type="email"  name="email"  value="{{ old('email') }}" class="form-control font-15 text-dark mb-3" placeholder="{{__('public/login.email_placeholder')}}"  required>
            </div>
            <input type="hidden" name="previous_url" value="{{URL::current()}}">

            <div class="col-md-12">
              <input id="password-field" type="password" class="form-control text-dark font-15 mb-3" placeholder="{{__('public/login.password_placeholder')}}" name="password" value="" required >
           <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
            </div>
            <div class="col-md-12">
              <div class="form-check">
              <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
              <label class="form-check-label font-15 secondary-text fw-400" for="defaultCheck1">
                {{__('public/common.remember_me')}}
              </label>
            </div>
            </div>
            <input type="hidden" name="redirect_to" value="{{URL::current()}}"/>
            <div class="col-md-12 my-4 border-bottom">
              <button type="submit" class="btn btn-primary btn-block font-20 fw-700 p-3 mb-3">{{__('public/login.btn_signin')}}</button>
              <a href="{{url('partner/register')}}" class="btn btn-light btn-block text-dark font-15 fw-700 p-3 mb-3">{{__('public/login.create_account_btn')}}</a>
              <p class="text-center"><a href="javascript:void(0)" class="success-link">{{__('public/login.forgot_password_txt')}}</a></p>
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
