<!-- login popup content -->
<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="join-us-modal modal-dialog modal-dialog-centered modal-sm" role="document">
    <div class="modal-content shadow-lg">
      <div class="modal-body">
        <button type="button" class="modal-close close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="join-us-modal-cont p-3">
          <div class="join-us-header pb-4">
            <div class="text-center mb-4">
              <a href="{{url('/')}}"><img src="{{asset('uploads/images/'.config('sximo.cnf_logo_dark'))}}" class="img-fluid "alt=""></a>
          </div>
            <p class="font-20 secondary-text fw-400 text-center">{{__('public/login.login_title')}}</p>
          </div>
          <div class="join-us-form">
          <div class="login" id="login"></div>


          <form class="cd-form" method="post" action="{{url('member/login')}}">
            {{ csrf_field() }}
            <div class="form-row">
              <div class="col-md-12">
                <input type="email"  name="email"  value="{{ old('email') }}" class="form-control font-15 text-dark mb-3" placeholder="{{__('public/login.email_placeholder')}}"  required>

              </div>
              <input type="hidden" name="previous_url" value="{{URL::current()}}">

              <div class="col-md-12">
                <input id="password-field" type="password" class="form-control text-dark font-15 mb-3 " placeholder="{{__('public/login.password_placeholder')}}" name="password" value="" required >
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
                <button type="button" data-dismiss="modal"  class="btn btn-light btn-block text-dark font-15 fw-700 p-3 mb-3" data-toggle="modal" data-dismiss="modal" data-target="#join-us-modal">{{__('public/login.create_account_btn')}}</button>
                <p class="text-center"><a href="" class="success-link" data-toggle="modal" data-dismiss="modal" data-target="#forgot-modal">{{__('public/login.forgot_password_txt')}}</a></p>
              </div>
            </div>
          </form>
        </div>
        <p class="text-center font-13 secondary-text-light fw-400">{{__('public/login.other_signin_option')}}</p>
        <div class="social-login-ico text-center mb-3">
          <a href="{{ url('/auth/facebook') }}"><i class="fb fab fa-facebook-f"></i></a>
          <a  href="{{ url('/auth/google') }}"><i class="g-plus fab fa-google-plus-g"></i></a>
        </div>
        <p class="font-12 fw-400 secondary-text-light text-center">{{__('public/login.permission_txt')}}</p>
        </div>
        </div>
      </div>
  </div>
</div>
