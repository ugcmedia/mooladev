<?php

$getBal = AppClass::getAllBal();
$getTips = AppClass::getTips();

  $tcashback = '';
  $treward   = '';
  $tbonus    = '';

  foreach ($getTips as $key => $value)
   {
     if($value->tip_key == 'cashback_act')
      {
      $tcashback = $value->note;
      }

      if($value->tip_key == 'rewards_act')
     {
      $treward = $value->note;
      }

    if($value->tip_key == 'bonus_act')
    {
      $tbonus = $value->note;
    }

  }
  if(isset($_GET['noytify']))
  {
      $updateNotify = AppClass::updateNotification($_GET['noytify'],'tb_user_transaction_changes');
  }

?>

@extends('public.layouts.app')
@section('content')
@section('title')
  {!! $data['page_data']->meta_title!!}
@endsection

  <?php  $breadTitle =__('member/multi_lang.cash_act');  ?>
  @include('member-dash/member-partials/title_heading_common')

<div class="main-content py-5">
   <div class="container">
    	<div class="row">

        @include('member-dash/member-partials/sidebar')
        @if(Session::get('memberDetail')->email_verified != 'Y')
          <div class="col-xl-9 col-lg-9 col-md-8">
            <div class="my-msg bg-white p-3 rounded mb-4">
                <p style="color:red"> {{__('member/multi_lang.verify_Mail')}}
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
						</div>
          @endif
      			<div class="total-earning-details">
      				<h4 class="font-weight-bold mb-3">{{__('member/multi_lang.total_earning')}}</h4>
					<?php if(config('settingConfig.module_rewards')=='Y') $col_class = 'col-lg-4'; else $col_class = 'col-lg-6'; ?>
      				<div class="row">
      					<div class="{{$col_class}}">
      						<div class="earning-card p-3 border rounded bg-white mb-4">
      							<div class="e-card-title border-bottom">
								<h5><i class="fa fa-tags"></i> {{__('member/multi_lang.cashbacks')}}</h5>

                <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="{{$tcashback}}" class="cb-tr-tooltip">
                    <i class="fa fa-question-circle-o"></i>
                  </a>
								</div>

								<div class="e-panding-bal pt-3 font-weight-bold">
									<label>{{__('member/multi_lang.pending')}}:</label>
									<span class="pull-right">{{config('sximo.cnf_currencyname')}}{{$getBal['cashback-pending'] }}{{config('sximo.cnf_currencysuffix')}}
									</span>
								</div>

								<div class="e-panding-bal font-weight-bold text-success">
									<label>{{__('member/multi_lang.confirmed')}}:</label>
									<span class="pull-right">{{config('sximo.cnf_currencyname')}}{{$getBal['cashback-confirmed']}}{{config('sximo.cnf_currencysuffix')}}
									</span>
								</div>

                <div class="e-panding-bal font-weight-bold text-muted">
                  <label>{{__('member/multi_lang.paid')}}:</label>
                  <span class="pull-right">{{config('sximo.cnf_currencyname')}}{{$getBal['Paidout'][0]->paidCashback}}{{config('sximo.cnf_currencysuffix')}}</span>
                </div>

								<div class="e-panding-bal font-weight-bold text-muted">
									<label>{{__('member/multi_lang.declined')}}:</label>
									<span class="pull-right">{{config('sximo.cnf_currencyname')}}{{$getBal['cashback-declined']}}{{config('sximo.cnf_currencysuffix')}}</span>
								</div>
      							</div>
      						</div>
							@if(config('settingConfig.module_rewards')=='Y')
      						<div class="{{$col_class}}">
      						<div class="earning-card p-3 border rounded bg-white mb-4">
      							<div class="e-card-title border-bottom">
								<h5><i class="fa fa-tags"></i> {{__('member/multi_lang.rewards')}}</h5>
                <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="{{$treward}}" class="cb-tr-tooltip">
                    <i class="fa fa-question-circle-o"></i>
                  </a>
								</div>


								<div class="e-panding-bal pt-3 font-weight-bold">
									<label>{{__('member/multi_lang.pending')}}:</label>
									<span class="pull-right">{{config('sximo.cnf_currencyname')}}{{$getBal['reward-pending']}}{{config('sximo.cnf_currencysuffix')}} </span>
								</div>

								<div class="e-panding-bal font-weight-bold text-success">
									<label>{{__('member/multi_lang.confirmed')}}:</label>
									<span class="pull-right">{{config('sximo.cnf_currencyname')}}{{$getBal['reward-confirmed'] }}{{config('sximo.cnf_currencysuffix')}}{{config('sximo.cnf_currencysuffix')}}</span>
								</div>

                <div class="e-panding-bal font-weight-bold text-muted">
                  <label>{{__('member/multi_lang.paid')}}:</label>
                  <span class="pull-right">{{config('sximo.cnf_currencyname')}}{{$getBal['Paidout'][0]->paidReward}}{{config('sximo.cnf_currencysuffix')}}</span>
                </div>

								<div class="e-panding-bal font-weight-bold text-muted">
									<label>{{__('member/multi_lang.declined')}}:</label>
									<span class="pull-right">{{config('sximo.cnf_currencyname')}}{{	$getBal['reward-declined']}}{{config('sximo.cnf_currencysuffix')}} </span>
								</div>
      							</div>
      						</div>
							@endif
      						<div class="{{$col_class}}">
      						<div class="earning-card p-3 border rounded bg-white mb-4">
      							<div class="e-card-title border-bottom">
								<h5><i class="fa fa-tags"></i> {{__('member/multi_lang.bonus')}}</h5>
                <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="{{$tbonus}}" class="cb-tr-tooltip">
                    <i class="fa fa-question-circle-o"></i>
                  </a>
								</div>

								<div class="e-panding-bal pt-3 font-weight-bold">
									<label>{{__('member/multi_lang.pending')}}:</label>
									<span class="pull-right">{{config('sximo.cnf_currencyname')}}{{$getBal['bonus-pending']}}{{config('sximo.cnf_currencysuffix')}}</span>
								</div>

								<div class="e-panding-bal font-weight-bold text-success">
									<label>{{__('member/multi_lang.confirmed')}}:</label>
									<span class="pull-right">{{config('sximo.cnf_currencyname')}}{{$getBal['bonus-confirmed']}}{{config('sximo.cnf_currencysuffix')}}</span>
								</div>

                <div class="e-panding-bal font-weight-bold text-muted">
                  <label>{{__('member/multi_lang.paid')}}:</label>
                  <span class="pull-right">{{config('sximo.cnf_currencyname')}}{{$getBal['Paidout'][0]->paidBonus}}{{config('sximo.cnf_currencysuffix')}}</span>
                </div>


								<div class="e-panding-bal font-weight-bold text-muted">
									<label>{{__('member/multi_lang.declined')}}:</label>
									<span class="pull-right">{{config('sximo.cnf_currencyname')}}{{$getBal['bonus-declined']}}{{config('sximo.cnf_currencysuffix')}}</span>
								</div>
      							</div>
      						</div>
      					</div>
      				</div>
      			<!-- </div> -->
      			<div class="cb-activity-wrapper rounded">
				<div class="recent-activity">
  					<div class="activity-content p-2">



  						<div class="activity-tabs">
			    		<ul class="nav nav-pills border-bottom" id="pills-tab" role="tablist">
						  <li class="nav-item mx-lg-auto mx-md-0 mx-sm-0">
						    <a @if(!isset($_GET['bonus'])  && !isset($_GET['refer'])) class="nav-link active p-3" @else class="nav-link p-3"   @endif id="pills-cb-tab" data-toggle="pill" href="#pills-cb" role="tab" aria-controls="pills-cb" aria-selected="true">{{__('member/multi_lang.cashbacks')}}</a>
						  </li>
						  <li class="nav-item mx-lg-auto mx-md-0 mx-sm-0">
						    <a @if(isset($_GET['bonus'])) class="nav-link active p-3"   @else class="nav-link p-3"  @endif id="pills-bonus-tab" data-toggle="pill" href="#pills-bonus" role="tab" aria-controls="pills-bonus" aria-selected="false">{{__('member/multi_lang.bonus')}}</a>
						  </li>

						  <li class="nav-item mx-lg-auto mx-md-0 mx-sm-0">
						    <a @if(isset($_GET['refer'])) class="nav-link active p-3"   @else class="nav-link p-3"  @endif id="pills-earning-tab" data-toggle="pill" href="#pills-earning" role="tab" aria-controls="pills-earning" aria-selected="false">{{__('member/multi_lang.referral_earning')}}</a>
						  </li>

						  <li class="nav-item mx-lg-auto mx-md-0 mx-sm-0">
						    <a class="nav-link p-3" id="pills-click-history-tab" data-toggle="pill" href="#pills-click-history" role="tab" aria-controls="pills-click-history" aria-selected="false">{{__('member/multi_lang.click_history')}}</a>
						  </li>

						</ul>
					<div class="tab-content p-2" id="pills-tabContent">
					  <div  @if(!isset($_GET['bonus'])  && !isset($_GET['refer'])) class="tab-pane fade show active" @else class="tab-pane fade"  @endif   id="pills-cb" role="tabpanel" aria-labelledby="pills-cb-tab"><p class="text-center">
					  	<div class="recent-activity">
  					<div class="activity-content">

  						<h4 class="activity-title font-weight-bold">{{__('member/multi_lang.cashback_purchases')}}</h4>
  						<p class="text-muted">{{__('member/multi_lang.details')}}</p>

  						<div class="cb-select-info mb-3">
  							<div class="row">
  								<div class="col-6 col-lg-2 border-lg-right">
  									<div class="form-check">

									  <input class="form-check-input" type="checkbox" value="pending" id="c-pending">
									  <label class="form-check-label" for="defaultCheck1">
									    <p class="cb-info-title mb-0">{{__('member/multi_lang.pending')}}</p>
									    <span>{{config('sximo.cnf_currencyname')}}{{$getBal['cashback-pending'] }}{{config('sximo.cnf_currencysuffix')}}</span>
									  </label>
									</div>
  								</div>
  								<div class="col-6 col-lg-2 border-lg-right">
  									<div class="form-check">
									  <input class="form-check-input" type="checkbox" value="confirmed" id="c-confirmed">
									  <label class="form-check-label" for="defaultCheck2">
									    <p class="cb-info-title mb-0 text-success">{{__('member/multi_lang.confirmed')}}</p>
									    <span>{{config('sximo.cnf_currencyname')}}{{$getBal['cashback-confirmed']}}{{config('sximo.cnf_currencysuffix')}}</span>
									  </label>
									</div>
  								</div>
  								<div class="col-6 col-lg-2 border-lg-right">
  									<div class="form-check text-muted">
									  <input class="form-check-input" type="checkbox" value="declined" id="c-declined">
									  <label class="form-check-label" for="defaultCheck3">
									    <p class="cb-info-title mb-0 text-muted">{{__('member/multi_lang.declined')}}</p>
									    <span>{{config('sximo.cnf_currencyname')}}{{$getBal['cashback-declined']}}{{config('sximo.cnf_currencysuffix')}}</span>
									  </label>
									</div>
  								</div>
  								<div class="col-6 col-lg-6 col-md-6">
  									<input type="text" class="form-control pull-lg-right" name="" id="c-search" placeholder="Search here for Merchant">
  								</div>
  							</div>
  						</div>
							<div id="cashback-data">
										@include('member-dash.member-partials.cashback-detail')
            	</div>
                <h4 class="activity-title font-weight-bold">{{__('member/multi_lang.missing_cashback_qu') }}</h4>
                <span class="text-muted">{{__('member/multi_lang.missing_cashback_detail')}}</span><br>
                <span class="text-muted"><a href="{{route('member.createClaim')}}" style="color:blue; ">{{__('member/multi_lang.clk_here')}}</a> {{__('member/multi_lang.claim_txt')}}</span>
							</div>
  				</div>

  			</div>

			<div  @if(isset($_GET['bonus'])) class="tab-pane fade show active" @else class="tab-pane fade" @endif  id="pills-bonus" role="tabpanel" aria-labelledby="pills-bonus-tab">
				<div class="recent-activity">
  					<div class="clicks-content">
  						<h4 class="activity-title font-weight-bold">{{__('member/multi_lang.bonus')}}</h4>
  						<p class="text-muted">{{__('member/multi_lang.details')}}</p>
						<div class="cb-select-info mb-3">
  							<div class="row">
  								<div class="col-6 col-lg-2 border-lg-right">
  									<div class="form-check">
									  <input class="form-check-input" type="checkbox" value="pending" id="b-pending">
									  <label class="form-check-label" for="defaultCheck1">
									    <p class="cb-info-title mb-0">{{__('member/multi_lang.pending')}}</p>
									    <span>	{{config('sximo.cnf_currencyname')}}{{$getBal['bonus-pending']}}{{config('sximo.cnf_currencysuffix')}}</span>
									  </label>
									</div>
  								</div>
  								<div class="col-6 col-lg-2 border-lg-right">
  									<div class="form-check">
									  <input class="form-check-input" type="checkbox" value="confirmed" id="b-confirmed">
									  <label class="form-check-label" for="defaultCheck2">
									    <p class="cb-info-title mb-0 text-success">{{__('member/multi_lang.confirmed')}}</p>
									    <span>	{{config('sximo.cnf_currencyname')}} {{$getBal['bonus-confirmed']}}{{config('sximo.cnf_currencysuffix')}}</span>
									  </label>
									</div>
  								</div>
  								<div class="col-6 col-lg-2 border-lg-right">
  									<div class="form-check text-muted">
									  <input class="form-check-input" type="checkbox" value="declined" id="b-declined">
									  <label class="form-check-label" for="defaultCheck3">
									    <p class="cb-info-title mb-0 text-muted">{{__('member/multi_lang.declined')}}</p>
									    <span>{{config('sximo.cnf_currencyname')}}{{$getBal['bonus-declined']}}{{config('sximo.cnf_currencysuffix')}}</span>
									  </label>
									</div>
  								</div>
  								<div class="col-6 col-lg-6">
  									<input type="text" class="form-control pull-lg-right" name="" id="b-search" placeholder="Search here for Bonus Type">
  								</div>
  							</div>
  						</div>
							<div id="bonus-data">
										@include('member-dash.member-partials.bonus-detail')
								</div>
					</div>
  				</div>

			</div>

			<div @if(isset($_GET['refer'])) class="tab-pane fade show active" @else class="tab-pane fade" @endif  id="pills-earning" role="tabpanel" aria-labelledby="pills-earning-tab">
				<div class="recent-activity">
  					<div class="clicks-content">
  						<h4 class="activity-title font-weight-bold">{{__('member/multi_lang.referral_earning')}}</h4>
  						<p class="text-muted">{{__('member/multi_lang.details')}}</p>
						<div class="cb-select-info mb-3">
  							<div class="row">
                  <div class="col-6 col-lg-6">

                  </div>
  								<div class="col-6 col-lg-6">
  									<input type="text" class="form-control pull-lg-right" name="" id="r-search" placeholder="Search here for Store Name">
  								</div>
  							</div>
  						</div>
							<div id="refer-data">
								@include('member-dash.member-partials.refer-detail')
							</div>


					</div>
  				</div>

			</div>

			<div class="tab-pane fade" id="pills-click-history" role="tabpanel" aria-labelledby="pills-click-history-tab">
				<div class="recent-activity">
  					<div class="clicks-content">
  						<h4 class="activity-title font-weight-bold">{{__('member/multi_lang.click_history')}}</h4>
  						<p class="text-muted">{{__('member/multi_lang.details')}}</p>
						<div class="cb-select-info mb-3">
  							<div class="row">
                  <div class="col-6 col-lg-6">
                  </div>
  								<div class="col-6 col-lg-6">
  									<input type="text" class="form-control pull-lg-right" name="" id="cl-search" placeholder="Search here for Merchant">
  								</div>
  							</div>
  						</div>
							<div id="click-data">
								@include('member-dash.member-partials.click-detail')
							</div>

					</div>
  				</div>

			</div>
							  </div>
				    	</div>
					</div>
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
<script type="text/javascript">


$(window).on('hashchange', function() {
	if (window.location.hash) {
			var page = window.location.hash.replace('#', '');

			if (page == Number.NaN || page <= 0) {
					return false;
			}else{
				var getTab =  $('.nav-pills  .active').text();
				if(getTab == 'Cashbacks') {
						getData(page);
				}
				if(getTab == 'Bonus') {
				  	getBonusData(page);
				}
				if(getTab == 'Referral Earning') {
					 getReferData(page);
				}
				if(getTab == 'Click History') {
					 getClickData(page);
				}

			}
	}
});


$(document).ready(function()
{
	$(document).on('click', '.pagination a',function(event)
	{

			var getTab =  $('.nav-pills  .active').text();
			$('li').removeClass('active');
			$(this).parent('li').addClass('active');
			event.preventDefault();
			var myurl = $(this).attr('href');
			var page=$(this).attr('href').split('page=')[1];
    	if(getTab == 'Cashback') {
				getData(page);
			}
			if(getTab == 'Bonus') {
				getBonusData(page);
			}
			if(getTab == 'Referral Earning') {
				 getReferData(page);
			}
			if(getTab == 'Click History') {
				 getClickData(page);
			}
	});
});


//for cashback
function getData(page){

	var sconfirm  = '';
	var spending  = '';
	var sdeclined = '';
	var cSearch   = '';

	if($('#c-confirmed').is(':checked')) {
			sconfirm = $('#c-confirmed').val();
	}
	if($('#c-pending').is(':checked')) {
			spending = $('#c-pending').val();
	}
	if($('#c-declined').is(':checked')) {
			sdeclined =$('#c-declined').val();
	}
	if($('#c-search').val() != '') {
		 cSearch   = $('#c-search').val();
	}

			$.ajax(
			{
					url: '?page=' + page ,
					data:{'pending': spending,'confirmed' : sconfirm,'declined' : sdeclined,'c_search' :cSearch,'cashback':true,'_token': $('input[name=_token]').val() },
					type: "get",
					datatype: "html",
			})
			.done(function(data)
			{
					$("#cashback-data").empty().html(data);
					location.hash = page;
			})
			.fail(function(jqXHR, ajaxOptions, thrownError)
			{
						alert("{{trans('actionMsg.no_response')}}");


			});
}

$(document).ready(function() {

		var page = window.location.hash.replace('#', '');
		$('#c-confirmed').change(function(e1) {
				getData(page);
		});
		$('#c-pending').change(function() {
				getData(page);
		});
		$('#c-declined').change(function() {
				getData(page);
		});
		$('#c-search').keyup(function(){
			getData(page);
		});
});

//for bonus
function getBonusData(page){
	var sconfirm  = '';
	var spending  = '';
	var sdeclined = '';
	var cSearch   = '';

	if($('#b-confirmed').is(':checked')) {
			sconfirm = $('#b-confirmed').val();
	}
	if($('#b-pending').is(':checked')) {
			spending = $('#b-pending').val();
	}
	if($('#b-declined').is(':checked')) {
			sdeclined =$('#b-declined').val();
	}
	if($('#b-search').val() != '') {
		 cSearch   = $('#b-search').val();
	}

			$.ajax(
			{
					url: '?page=' + page ,
					data:{'pending': spending,'confirmed' : sconfirm,'declined' : sdeclined,'c_search' :cSearch,'bonus' : true,'_token': $('input[name=_token]').val() },
					type: "get",
					datatype: "html",
			})
			.done(function(data)
			{
					$("#bonus-data").empty().html(data);
					location.hash = page;
			})
			.fail(function(jqXHR, ajaxOptions, thrownError)
			{
						alert("{{trans('actionMsg.no_response')}}");
			});
}

$(document).ready(function() {

		var page = window.location.hash.replace('#', '');
		$('#b-confirmed').change(function(e1) {
				getBonusData(page);
		});
		$('#b-pending').change(function() {
				getBonusData(page);
		});
		$('#b-declined').change(function() {
				getBonusData(page);
		});
		$('#b-search').keyup(function(){
		  	getBonusData(page);
		});
});


//for refer
function getReferData(page){
	var cSearch   = '';

	if($('#r-search').val() != '') {
		 cSearch   = $('#r-search').val();
	}

			$.ajax(
			{
					url: '?page=' + page ,
					data:{'c_search' :cSearch,'refer' : true,'_token': $('input[name=_token]').val() },
					type: "get",
					datatype: "html",
			})
			.done(function(data)
			{
					$("#refer-data").empty().html(data);
					location.hash = page;
			})
			.fail(function(jqXHR, ajaxOptions, thrownError)
			{
						alert("{{trans('actionMsg.no_response')}}");
			});
}

$(document).ready(function() {
	var page = window.location.hash.replace('#', '');

		$('#r-search').keyup(function(){
		  	getReferData(page);
		});
});


//for click
function getClickData(page){
	var cSearch   = '';

	if($('#cl-search').val() != '') {
		 cSearch   = $('#cl-search').val();
	}

			$.ajax(
			{
					url: '?page=' + page ,
					data:{'c_search' :cSearch,'click' : true,'_token': $('input[name=_token]').val() },
					type: "get",
					datatype: "html",
			})
			.done(function(data)
			{
					$("#click-data").empty().html(data);
					location.hash = page;
			})
			.fail(function(jqXHR, ajaxOptions, thrownError)
			{
						alert("{{trans('actionMsg.no_response')}}");
			});
}

$(document).ready(function() {
	var page = window.location.hash.replace('#', '');

		$('#cl-search').keyup(function(){
		  	getClickData(page);
		});
});


</script>

@endsection
