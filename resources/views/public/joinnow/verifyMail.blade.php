@extends('public.layouts.app')
@section('content')
@include('public.layouts.partials.notification')
<section class="bst-deals-with-extra-offer py-5">
  <div class="container">
  <div class="best-deals-title">
    <h3 class="text-capitalize mb-4">{{__('public/storepage.signup_successful')}}</h3>
  </div>
<div class="d-none d-md-block">
  <div class="row">
    <div class="col-lg-12 col-md-12">
    <p>{{__('public/storepage.thx_you_signing')}}</p>
      <p>{{__('public/storepage.check_your_email')}}</p>
       <a  class="existing-u-link" href="{{route('resendMail')}}">{{__('public/storepage.resend_email')}}</a>
      </div>
      </div>
    </div>
  </div>
</section>
@endsection
