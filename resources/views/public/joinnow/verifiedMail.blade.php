@extends('public.layouts.app')
@section('content')
<section id="main-content">
  <section class="page-header">
    <div class="merchant-banner-cont pt-3">
    			<div class="container">
    			<div class="banner-only-title pt-3">
    			     <h1 class="text-center">{{__('public/join-now.signup_successful')}}</h1>
    			</div>
    	</div>
    </div>
  </section>
  <!-- Page Header End -->
  <section class="section " id="main-page">
  	<div class="container">
  		<div class="policy-detail rounded border my-5 bg-white p-3">
    		<p class="pt-2">{{__('public/join-now.acc_details')}}</p>
    	</div>
    </div>
  </section>
</section>

@endsection
