@php
$mobileDetection = new MobileDetect();
@endphp
@include('public.layouts.partials.head')
<body class="maintanencePage primary-bg">
	<section class="maintenance-wrapp text-center">
		<div class="m-msg text-white px-4">
			@if($mobileDetection->isMobile())
			<p class="mb-5"><img src="{{asset('uploads/images/'.config('sximo.cnf_logo_light'))}}" width="250px"></p>
			<p><img src="{{asset('public_assets/images/maintenance.svg')}}" width="80px"></p>
			<div class="font-40 fw-700 mt-4">
				Sorry, we are down for maintenance.
			</div>
			<div class="font-24">
				We will be back shortly.
			</div>
			@else
			<p class="mb-5"><img src="{{asset('uploads/images/'.config('sximo.cnf_logo_light'))}}" width="360px"></p>
			<p><img src="{{asset('public_assets/images/maintenance.svg')}}" width="120px"></p>
			<div class="font-48 fw-700 mt-5">
				Sorry, we are down for maintenance.
			</div>
			<div class="font-32">
				We will be back shortly.
			</div>
			@endif
		</div>
	</section>
</body>
