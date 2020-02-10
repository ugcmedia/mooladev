@php
$referCode  = '';
if(isset($_GET['referal_code'])) {
  $referCode = $_GET['referal_code'];
}
if(isset($_COOKIE[config('settingConfig.dev_cookie_prefix').'m101RAE'])) {
  $referCode = $_COOKIE[config('settingConfig.dev_cookie_prefix').'m101RAE'];
}
$joinToolTip = AppClass::getTips();
$ref_code_optional = '';
foreach ($joinToolTip as $key => $value) {
  if($value->tip_key == 'optional_ref_code') {
    $ref_code_optional = $value->note;
  }
}

@endphp
<!-- join us popup content -->
<div class="modal fade" id="join-us-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="join-us-modal modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content shadow-lg">
      <div class="modal-body">
        <button type="button" class="modal-close close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="join-us-modal-cont p-3">
          <div class="join-us-header pb-4 border-bottom">
            <div class="text-center mb-4">
              <a href="{{url('/')}}"><img src="{{asset('uploads/images/'.config('sximo.cnf_logo_dark'))}}" class="img-fluid "alt=""></a>
            </div>

            <p class="font-15 secondary-text fw-400 text-center">{{__('public/join-now.join_us_following')}}</p>
            <div class="social-login-ico text-center mb-3">
              <a href="{{ url('/auth/facebook') }}"><i class="fb fab fa-facebook-f"></i></a>
              <a href="{{ url('/auth/google') }}"><i class="g-plus fab fa-google-plus-g"></i></a>
            </div>
            <p class="font-12 fw-400 secondary-text-light text-center">{{__('public/join-now.join_us_desc')}}</p>
          </div>

          <div class="joniNow-msg"></div>
          <div class="join-us-form pt-5">
            <form  method="POST" action="{{ route('joinNow') }}">
              {{ csrf_field() }}
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
                <input id="signup-password" type="password" class="form-control text-dark font-15 mb-3" name="password"   placeholder="{{__('public/join-now.password_placeholder')}}"  required>
             <span toggle="#password-fields" class="fa fa-fw fa-eye field-icon toggle-password"></span>
              </div>
              <div class="col-md-12">
                <div class="input-group mb-3">
                <input type="text" class="form-control font-15 text-dark" value="{{$referCode}}" name="refer_code" type="text"  placeholder="{{__('public/join-now.referral_code_placeholder')}}" value="{{ old('refer_code') }}">
                <div class="input-group-append">
                  <span class="input-group-text text-dark">{{__('public/join-now.its_optional_txt')}}
                    <i class="far fa-question-circle text-primary float-right ml-2" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="{{$ref_code_optional}}"></i>
                  </span>
                </div>
              </div>
              </div>
              <div class="fieldset mb-3">

                  <div class="col-md-12 pl-2">
                    <div class="form-group has-feedback  animated fadeInLeft delayp1">
                      <label class="text-left"> Are u human ? </label>
                      <div class="g-recaptcha" data-sitekey="{{-- config('sximo.cnf_recaptchapublickey') --}}"></div>
                      <div class="clr"></div>
                    </div>
                  </div>

              </div>
			  <input type="hidden" name="redirect_to" value="{{URL::current()}}"/>
              <div class="col-md-12 mb-4">
                <button type="submit" class="btn btn-primary btn-block font-20 fw-700 p-3 mb-3">{{__('public/join-now.create_account_btn')}}</button>
                <button type="button" class="btn btn-light btn-block text-dark font-15 fw-700 p-3 mb-3" data-toggle="modal" data-target="#login-modal" data-dismiss="modal">{{__('public/join-now.already_member_btn')}}</button>
              </div>
              <div class="col-md-12 text-center">
                  <p class="font-13 secondary-text-light fw-400"><span class="d-block d-md-inline-block">{{__('public/join-now.by_joining_txt')}}</span>
                    <a href="{{url('terms-of-use') }}" class="font-13 primary-link fw-400">{{__('public/join-now.terms_condition_txt')}}</a> {{__('public/join-now.and')}}
                    <a href="{{url('privacy') }}" class="font-13 primary-link fw-400">{{__('public/join-now.privacy_txt')}}</a>
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
<script src='https://www.google.com/recaptcha/api.js'></script>
