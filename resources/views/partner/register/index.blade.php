@extends('public.layouts.app')
<?php /* @section('title')
  {!! $data['pageInfo']->title!!}
@endsection */ ?>
@section('content')
<section class="join-us-main">
  <div class="koin-us-content py-5">
    <div class="container">
      <div class="row no-gutters">
        <div class="col-lg-6 offset-lg-3">
          <h2 class="text-center">Partner Signup</h2>
          <div class="join-us-page-cont p-3 px-0 px-lg-5 div-inner-white">
            <div class="join-us-form pt-5">
              <div class="login-msg"></div>
@if(!empty( $jnerror ) )
<h1>aaa{{ $jnerror }}</h1>
@endif



  <form  method="POST" action="{{ route('joinPartner') }}">
                {{ csrf_field() }}
                <input type="hidden" name="from_join" value="1">
                <div class="form-row">
                  <div class="col-md-12">
                    <input type="text" class="form-control font-15 text-dark mb-3"  name="vendor_name" placeholder="{{__('partner/multi_lang.vendor_name')}}" value="{{ old('vendor_name') }}" required>
                  </div>
                  <div class="col-md-12">
                    <input type="email" class="form-control font-15 text-dark mb-3" name="email" placeholder="{{__('partner/multi_lang.vendor_email')}}" placeholder="E-mail"  value="{{ old('vendor_email') }}" required>
                  </div>
                  <div class="col-md-12">
                    <input id="join-signup-password" type="password" class="form-control text-dark font-15 mb-3" name="password" placeholder="{{__('partner/multi_lang.password')}}"  required>
                    <span toggle="#password-fields-join" class="fa fa-fw fa-eye field-icon toggle-password-join"></span>
                  </div>
                  <div class="col-md-12 pl-2">
                    <div class="form-group has-feedback  animated fadeInLeft delayp1">
                      <label class="text-left">{{__('partner/multi_lang.are_you_human')}} </label>
                      <div class="g-recaptcha" data-sitekey="{{-- config('sximo.cnf_recaptchapublickey') --}}"></div>
                      <div class="clr"></div>
                    </div>
                  </div>
                  <div class="col-md-12 mb-4">
                    <button type="submit" class="btn btn-primary btn-block font-20 fw-700 p-3 mb-3">{{__('partner/multi_lang.create_account_btn')}}</button>
                    <a href="{{url('partner/login')}}" class="btn btn-light btn-block text-dark font-15 fw-700 p-3 mb-3">{{__('partner/multi_lang.already_vendor_btn')}}</a>
                  </div>
                  <div class="col-md-12 text-center">
                      <p class="font-13 secondary-text-light fw-400">
                        <span class="d-block d-md-inline-block">
                          {!! __('partner/multi_lang.vendor_joining_txt', ['companyname' => config('sximo.cnf_appname'), 'termsUrl' => url('terms-of-use'), 'privacyUrl' => url('privacy')]) !!}
                        </span>
                      </p>
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
