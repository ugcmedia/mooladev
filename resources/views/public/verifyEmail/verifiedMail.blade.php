@extends('public.layouts.app')
@section('title')
Mail Verification
@endsection
@section('meta')
<meta property="og:url" content="{{URL::current()}}" />
<meta property="og:site_name" content="{{config('sximo.cnf_appname')}}" />
@endsection

@section('content')

<section class=" bg-light  py-5  h-100">
    <div class="container">
        <div class="shadow-sm p-5 bg-white rounded text-center">
              <h2 ><span class="fw-700 ">Email Verification</span></h2>
              <p>Your Email Verification is successfull.</p>
              <a href="{{url('/')}}"class="btn btn-primary btn-lg"role="button" aria-pressed="true">To Go Home Page</a>
        </div>
    </div>
</section>








@endsection
