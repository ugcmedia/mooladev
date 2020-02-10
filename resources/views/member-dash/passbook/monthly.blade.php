<?php

	if(  isset($_GET['month']) )
		$month_in = explode('-',$_GET['month']);
	else
		$month_in = explode('-',date('m-Y') );

		$monthNum = $month_in[0];
		$year = $month_in[1];
		$dateObj   = DateTime::createFromFormat('!m', $monthNum);
		$monthName = $dateObj->format('F'); // March
		$curret_month = $monthName.' '.$year;


  $getTips = AppClass::getTips();
  $getBal  = AppClass::getMonthlyBal($monthNum,$year);
	$monTrans  = AppClass::getMonthlyTransaction($monthNum,$year);

  $tpassbook = '';

  foreach ($getTips as $key => $value) {
    if($value->tip_key == 'passbook') {
      $tpassbook = $value->note;
    }
  }

   $tAvailBal = '';
   $tPenBal   = '';
   $tTotal    = '';
   $tTotalpai = '';

   foreach ($getTips as $key => $value) {
     if($value->tip_key == 'dash_avl_bal') {
       $tAvailBal = $value->note;
     }
     if($value->tip_key == 'dash_pend_bal') {
       $tPenBal = $value->note;
     }
     if($value->tip_key == 'total_earned') {
       $tTotal = $value->note;
     }
     if($value->tip_key == 'total_paidout') {
       $tTotalpai = $value->note;
     }
   }
?>

@extends('public.layouts.app')
@section('content')
@section('title')
  {!! $data['page_data']->meta_title!!}
@endsection
<?php $breadTitle =__('member/multi_lang.passbook'); ?>
@include('member-dash/member-partials/title_heading_common')

<div class="main-content py-5">
   <div class="container">

    	<div class="row">
        @include('member-dash/member-partials/sidebar')
        @if(Session::get('memberDetail')->email_verified != 'Y')
          <div class="col-xl-9 col-lg-9 col-md-8">
            <div class="my-msg bg-white p-3 rounded mb-4">
                <p style="color:red">  {{__('member/multi_lang.verify_Mail')}}
                   <a href="{{route('resendMail')}}">
                       {{__('member/multi_lang.click_here')}}
                    </a>
                  </p>
            </div>
          </div>
        @else

      		<div class="col-xl-9 col-lg-9 col-md-8">

						@if(strip_tags($data['page_data']->top_content) != '')
							<div class="my-msg bg-white p-3 rounded mb-4">
									{!! $data['page_data']->top_content !!}
									<h4>Monthly Passbook  - {{$curret_month}}</h4>
							</div>
							@else
							<h4>Monthly Passbook  - {{$curret_month}}</h4>
						@endif
            <div class="row">
               <div class="col-xl-4 col-lg-4">
                 <div class="avail-bal px-2 py-4 rounded mb-4">
                     <div class="avail-bal-cont">
                     <div class="avail-bal-header-small w-50 float-left d-flex">
                   <i class="fa fa-tags text-muted"></i>
                   <span class="text-success">{{__('member/multi_lang.total_debit')}} </span>
                 </div>
                 <div class="avail-bal-amount text-right">
                   <h2 class="a-small tot-debit font-weight-normal">{{config('sximo.cnf_currencyname')}}{{ $getBal['passbook-closing'] }}{{config('sximo.cnf_currencysuffix')}}</h2>
                 </div>

                   </div>
                 </div>
                 </div>

                 <div class="col-xl-4 col-lg-4">
                    <div class="avail-bal px-2 py-4 rounded mb-4">
                     <div class="avail-bal-cont">
                     <div class="avail-bal-header-small w-50 float-left d-flex">
                   <i class="fa fa-tags text-muted"></i>
                   <span class="text-muted">{{__('member/multi_lang.total_credit')}}</span>
                 </div>
                 <div class="avail-bal-amount text-right">
                   <h2 class="a-small cb-info-title font-weight-normal">{{config('sximo.cnf_currencyname')}}@if($getBal['Paidout'][0]->paid != '')
                     {{ $getBal['Paidout'][0]->paid }}@else 0  @endif{{config('sximo.cnf_currencysuffix')}}</h2>
                 </div>

                   </div>


                 </div>


                 </div>
                 <div class="col-xl-4 col-lg-4">
                   <div class="avail-bal px-2 py-4 rounded mb-4">
                     <div class="avail-bal-cont">
                     <div class="avail-bal-header-small w-50 float-left d-flex">
                   <i class="fa fa-tags text-muted"></i>
                   <span class="text-danger">{{__('member/multi_lang.closing_bal')}}</span>
                 </div>
                 <div class="avail-bal-amount text-right">
                   <h2 class="a-small text-danger">{{config('sximo.cnf_currencyname')}}{{ $getBal['passbook-closing'] - $getBal['Paidout'][0]->paid}}{{config('sximo.cnf_currencysuffix')}} </h2>

                 </div>
                 </div>
                 </div>
                </div>
               </div>


				<div class="passbook-wrapper p-4">
					<h3 class="font-weight-bold mb-3">{{__('member/multi_lang.passbook')}}</h3>
					<a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="{{$tpassbook}}" class="cb-tr-tooltip">
							<i class="fa fa-question-circle-o"></i>
						</a>
					<div class="table-responsive-lg" id="passbook-data">
					<table class="table border">
					    <thead class="thead-light">
					        <tr>
					            <th scope="col">{{__('member/multi_lang.transection_date')}}</th>
                      <th scope="col">{{__('member/multi_lang.title')}}</th>
                      <th scope="col">{{__('member/multi_lang.entry_type')}}</th>
                      <th scope="col">{{__('member/multi_lang.user_action')}}</th>
                      <th scope="col">{{__('member/multi_lang.amount')}}</th>


					        </tr>
					    </thead>
					    <tbody>
				@if(count($monTrans)>0)
                @foreach($monTrans as $passbook)
					        <tr data-toggle="collapse" data-target="#demo55" class="accordion-toggle">

					            <td>{{date(config('sximo.cnf_date'),strtotime($passbook->entry_date))}}</td>
					            <td>{{ucfirst($passbook->title)}}</td>
					            <td>{{ucfirst($passbook->entry_type)}}</td>
					            <td>{{ucfirst($passbook->user_action)}}</td>
								<td>{{config('sximo.cnf_currencyname')}}{{$passbook->amount}}{{config('sximo.cnf_currencysuffix')}}</td>

					        </tr>


					        <tr>
					            <td colspan="6" class="hiddenRow"><div id="demo66" class="accordian-body collapse p-3">
					            	<div class="row">
					            		<div class="col-lg-3">
					            			<div class="status-track  ml-3">
					            				<div class="top-circle text-muted">
												<i class="fa fa-circle"></i>
												<span>{{__('member/multi_lang.pending')}}</span>
											</div>

											<div class="bottom-circle text-muted">
												<i class="fa fa-circle bottom"></i>
												<span>{{__('member/multi_lang.confirmed')}}</span>
											</div>
					            			</div>
					            		</div>
					            		<div class="col-lg-9">
					            			<div class="status-details">
					            				<p class="mb-0">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed eget ipsum et augue lacinia convallis eu at diam. Sed at porta urna, quis auctor metus. Suspendisse quis nisl non ligula imperdiet pharetra. </p>
					            			</div>
					            		</div>
					            	</div>
					            </div></td>
					        </tr>
                  @endforeach
                  @else
                   <tr><td  colspan="5">{{__('member/multi_lang.sorry_found')}}!</td></tr>
                  @endif
							</tbody>
					</table>
				</div>
				</div>


				@if(strip_tags($data['page_data']->bottom_content) != '')
					<div class="my-msg bg-white p-3 rounded mb-4">
							{!! $data['page_data']->bottom_content !!}
					</div>
				@endif

      		</div>
          @endif
      	</div>
    </div>
</div>
@endsection
