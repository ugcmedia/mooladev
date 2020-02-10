
<div class="merchant-banner-cont pt-3">
			<div class="container">
				<div class="row">
					<div class="col-lg-12">
						<div class="db-breadcrumb">
							<nav aria-label="breadcrumb">
							  <ol class="breadcrumb">
							    <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('member/multi_lang.home')}}</a></li>
									@if(isset($breadTitle2))
											<li class="breadcrumb-item" aria-current="page"><a href="{{$breadLink}}"> {{$breadTitle}}</a></li>
											<li class="breadcrumb-item active" aria-current="page">{{$breadTitle2}}</li>
										@else
											<li class="breadcrumb-item active" aria-current="page">{{-- $breadTitle --}}</li>
									@endif
							  </ol>
							</nav>
						</div>
					</div>
				</div>

				<div class="row">
		<div class="col-lg-3 col-md-4">
			<div class="merchant-info bg-white text-center">
					<div class="merchant-title1 py-2">
            @include('member-dash/member-partials/userinfo')
							</div>
				</div>
		</div>

<div class="col-lg-9 col-md-8">
  <div class="member-title pt-3 pt-lg-0 pt-md-0">
    <h1 class="text-white text-capitalize">{{-- !! $data['page_data']->page_title !!--}}  </h1>
      <p class="text-white text-capitalize">{{-- !! $data['page_data']->heading !! --}}</p>
      <div class="l-link">
        <a href="{{url('how-it-works')}}" target="_blank"><i class="fa fa-lightbulb-o"></i> {{__('member/multi_lang.learnCashTxt')}}</a>			</div>
      </div>
    </div>


		</div>

		</div>
		</div>
