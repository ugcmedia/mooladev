<!-- forgot password popup -->
<div class="modal fade" id="forgot-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
            <p class="font-15 secondary-text fw-400 text-center">{!! __('public/forgot-password.forgot_password_title') !!}</p>
          </div>
          <div class="join-us-form">
            <div class="forgot-password-msg"></div>
            <form action="{{route('forgot.password')}}" method="post">
              {{ csrf_field() }}
            <div class="form-row">
              <div class="col-md-12">
                <input type="email" class="form-control font-15 text-dark mb-3" placeholder="{!!__('public/forgot-password.forgot_pass_place_holder')!!}"  name="email" required>
              </div>
              </div>
              <div class="col-md-12 my-4 border-bottom">
                <button type="submit" class="btn btn-primary btn-block font-20 fw-700 p-3 mb-3">{!! __('public/forgot-password.reset_password_txt') !!}</button>
                <button type="button" data-toggle="modal" data-target="#login-modal" data-dismiss="modal" class="btn btn-light btn-block text-dark font-15 fw-700 p-3 mb-3">{!! __('public/forgot-password.btn_sign_in') !!}</button>
              </div>
          </form>
        </div>
        <p class="text-center font-13 secondary-text-light fw-400">{!! __('public/forgot-password.other_sign_option') !!}</p>
        <div class="social-login-ico text-center mb-3">
          <a href="{{ url('/auth/facebook') }}"><i class="fb fab fa-facebook-f"></i></a>
          <a  href="{{ url('/auth/google') }}"><i class="g-plus fab fa-google-plus-g"></i></a>
        </div>
        <p class="font-12 fw-400 secondary-text-light text-center">{!! __('public/forgot-password.forgot_pass_txt') !!}</p>
        </div>
        </div>
      </div>
  </div>
</div>
