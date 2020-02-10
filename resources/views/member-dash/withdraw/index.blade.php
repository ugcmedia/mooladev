<?php
 /*$getBal = AppClass::getAllBal();
 if(isset($_GET['noytify'])) {
     $updateNotify = AppClass::updateNotification($_GET['noytify'],'tb_user_withdrawals_changes');

 }*/
 ?>

@extends('public.layouts.app')
@section('content')
  @section('title')
    {{-- !! $data['page_data']->meta_title!! --}}
  @endsection

<?php /*
$breadTitle = __('member/multi_lang.withdraw'); */
?>
    @include('member-dash/member-partials/title_heading_common')

<div class="main-content py-5">
   <div class="container">
    	<div class="row">
        @include('member-dash/member-partials/sidebar')
        @if(Session::get('memberDetail')->email_verified != 'Y' )
          <div class="col-xl-9 col-lg-9 col-md-8">
            <div class="my-msg bg-white p-3 rounded mb-4">
                <p style="color:red">  {{-- __('member/multi_lang.verify_Mail') --}}
                   <a href="{{route('resendMail')}}">
                      {{-- __('member/multi_lang.click_here') --}}
                    </a>
                  </p>
            </div>
          </div>
      {{--    @endif --}}
        {{--  @if(Session::get('memberDetail')->email_verified == 'Y'  && (Session::get('memberDetail')->mobile_verified != 'Y'  && config('settingConfig.verify_mobile') =='Y') ) --}}
          <div class="col-xl-9 col-lg-9 col-md-8">
            <div class="my-msg bg-white p-3 rounded mb-4">
                <p style="color:red">   {{__('member/multi_lang.verify_mobile')}}
                  <a href="#" data-toggle="modal" data-target="#verifyNumber" >({{__('member/multi_lang.clk_here_verify')}})</a>
              </a>
             </p>
            </div>
          </div>
    {{--  @endif --}}
      {{--  @if(Session::get('memberDetail')->email_verified == 'Y' && ( Session::get('memberDetail')->mobile_verified == 'Y' || config('settingConfig.verify_mobile') =='N')  ) --}}
      		<div class="col-xl-9 col-lg-9 col-md-8">
          {{--  @if(strip_tags($data['page_data']->top_content) != '') --}}
              <div class="my-msg bg-white p-3 rounded mb-4">
                  {{-- !! $data['page_data']->top_content !! --}}
              </div>
          {{--  @endif --}}
      			<div class="withdrow-m-wrapperr">
      				<div class="wrapper-card rounded">
					<div class="withdrow-m-content text-center p-4 ">
				    	<h2 class="text-center">{{-- __('member/multi_lang.avail_bal') --}}:
				    	<span>
				    	<span class="cb-color">{{-- config('sximo.cnf_currencyname') --}}
                {{-- $getBal['avail_bal'] --}}
                {{-- config('sximo.cnf_currencysuffix') --}}</span></span>
				    	</h2>


              <div class="balance-details border-bottom">
                     <ul class="list-inline">
                       <li class="list-inline-item text-muted font-weight-bold">
                         {{__('member/multi_lang.cashback') }}:
                         <span class="font-weight-normal">
                       <span class="cb-color">{{ config('sximo.cnf_currencyname') }}
                         <?php  /*echo $avail_cashback  = $getBal['cashback-confirmed'] - $getBal['Paidout'][0]->paidCashback; */?>
                         {{ config('sximo.cnf_currencysuffix') }} </span></span></li>
				{{--	@if(config('settingConfig.module_rewards')=='Y') --}}
                       <li class="list-inline-item text-muted font-weight-bold">{{__('member/multi_lang.rewards') }}: <span class="font-weight-normal">
                       <span class="cb-color">{{config('sximo.cnf_currencyname')}} <?php/*  echo $avail_reward  = $getBal['reward-confirmed'] - $getBal['Paidout'][0]->paidReward; */?>{{config('sximo.cnf_currencysuffix') }} </span></span></li>
					{{--	@endif --}}
                       <li class="list-inline-item text-muted font-weight-bold">{{__('member/multi_lang.bonus') }}: <span class="font-weight-normal">
                       <span class="cb-color">{{-- config('sximo.cnf_currencyname') --}} <?php  /*echo $avail_bonus  = $getBal['bonus-confirmed'] - $getBal['Paidout'][0]->paidBonus; */?>{{config('sximo.cnf_currencysuffix')}}  </span></span></li>
                     </ul>
                   </div>


              <!-- <div class="balance-details">
              				    		<ul class="list-inline mb-0">
              				    			<li class="list-inline-item text-muted font-weight-bold">Cashback: <span class="font-weight-normal">
              				    			<span class="cb-color">{{config('sximo.cnf_currencyname')}} {{$getBal['cashback-confirmed']}}, </span></span></li>
              						    	<li class="list-inline-item text-muted font-weight-bold">Rewards: <span class="font-weight-normal">
              						    	<span class="cb-color">{{config('sximo.cnf_currencyname')}} {{$getBal['reward-confirmed']}} , </span></span></li>
              						    	<li class="list-inline-item text-muted font-weight-bold">Bonus: <span class="font-weight-normal">
              						    	<span class="cb-color">{{config('sximo.cnf_currencyname')}} {{$getBal['bonus-confirmed']}}</span></span></li>
              				    		</ul>
              				    	</div> -->
              				    	<!-- <p class="text-muted">Your balance is Rs. 250 below the minimum withdrawal limit.</p>
              				    	<div class="divider"></div>
              				    	</div>



 --><!--
 <div class="total-earning-details p-3 my-4  ">

   <div class="row">
      <div class="col-lg-4">
       <div class="earning-card p-3 border rounded bg-white mb-4 text-left">
         <div class="e-card-title border-bottom">
     <h5><i class="fa fa-tags"></i> {{__('member/multi_lang.cashbacks')}}</h5>




     </div>


     <div class="e-panding-bal font-weight-bold text-success">
       <label>Confirmed:</label>
       <span class="pull-right">{{config('sximo.cnf_currencyname')}} {{$getBal['cashback-confirmed']}}
       </span>
     </div>

     <div class="e-panding-bal font-weight-bold text-muted">
       <label>Paid:</label>
       <span class="pull-right">{{config('sximo.cnf_currencyname')}} {{$getBal['Paidout'][0]->paidCashback}}</span>
     </div>

     <div class="e-panding-bal font-weight-bold text-muted">
       <label>Available:</label>
       <span class="pull-right">{{config('sximo.cnf_currencyname')}}<?php  echo $avail_cashback  = $getBal['cashback-confirmed'] - $getBal['Paidout'][0]->paidCashback; ?> </span>
     </div>

         </div>
       </div>

       <div class="col-lg-4">
       <div class="earning-card p-3 border rounded bg-white mb-4 text-left">
         <div class="e-card-title border-bottom">
     <h5><i class="fa fa-tags"></i> {{__('member/multi_lang.rewards')}}</h5>

     </div>



     <div class="e-panding-bal font-weight-bold text-success">
       <label>Confirmed:</label>
       <span class="pull-right">{{config('sximo.cnf_currencyname')}} {{$getBal['reward-confirmed'] }}</span>
     </div>

     <div class="e-panding-bal font-weight-bold text-muted">
       <label>Paid:</label>
       <span class="pull-right">{{config('sximo.cnf_currencyname')}} {{$getBal['Paidout'][0]->paidReward}}</span>
     </div>

    <div class="e-panding-bal font-weight-bold text-muted">
      <label>Available:</label>
      <span class="pull-right">{{config('sximo.cnf_currencyname')}}<?php  echo $avail_reward  = $getBal['reward-confirmed'] - $getBal['Paidout'][0]->paidReward; ?> </span>
    </div>


         </div>
       </div>

       <div class="col-lg-4">
       <div class="earning-card p-3 border rounded bg-white mb-4 text-left">
         <div class="e-card-title border-bottom">
     <h5><i class="fa fa-tags"></i> {{__('member/multi_lang.bonus')}}</h5>

     </div>



     <div class="e-panding-bal font-weight-bold text-success">
       <label>Confirmed:</label>
       <span class="pull-right">{{config('sximo.cnf_currencyname')}} {{$getBal['bonus-confirmed']}}</span>
     </div>

     <div class="e-panding-bal font-weight-bold text-muted">
       <label>Paid:</label>
       <span class="pull-right">{{config('sximo.cnf_currencyname')}} {{$getBal['Paidout'][0]->paidBonus}}</span>
     </div>

     <div class="e-panding-bal font-weight-bold text-muted">
       <label>Available:</label>
       <span class="pull-right">{{config('sximo.cnf_currencyname')}}<?php  echo $avail_bonus  = $getBal['bonus-confirmed'] - $getBal['Paidout'][0]->paidBonus; ?> </span>
     </div>


         </div>

       </div>

     </div>-->
   </div>
				    	<div class="withdrawl-cards rounded mb-4 pb-4">
				    		<div class="container">
				    		<div class="row">

						{{--	@if(Count($data['payout_data']) > 0) --}}
						{{--	 @foreach($data['payout_data'] as $payout) --}}
									<div  class="col-lg-4 col-md-6">
										<div class="card mb-3">
											<div class=" card-body text-left p-2">
												<form action="{{route('payout.dowithdraw')}}" method="post" onsubmit="return confirm('{{__('actionMsg.payout_submit_warning')}}');">
													<input type="hidden" name="mode" value="{{$payout->code}}">

												<span class="card-title text-muted mb-0 text-uppercase">{{$payout->name}}</span>
												<div class="card-icons float-right">
													<a href="#" data-toggle="modal" data-target="#edit-modal{{$payout->name}}"><i class="fa fa-pencil-square-o mr-2"></i></a>
													<a href="{{route('delete.payout').'/'.$payout->metid}}" onclick="return confirm('Are you sure ?')"><i class="fa fa-trash"></i></a>
												</div>
												<p class="card-text mb-0 text-uppercase"><strong>{{$payout->payout_info1}}</strong></p>
												<P class="mob-no text-muted"><strong>{{$payout->payout_info2}}</strong></P>
												<div class="payout-details">
													<div class="min-payout-details">
													<span>{{__('member/multi_lang.minimum_payout')}}</span>
													<span class="cb-color float-right">
                        {{--    @if(AppClass::Isfirst_trans()) --}}
                              {{-- config('sximo.cnf_currencyname') --}}
                              {{-- $payout->minimum_first_transaction --}}
                              {{-- config('sximo.cnf_currencysuffix') --}}
                        {{--    @else --}}
                              {{config('sximo.cnf_currencyname') }}
                              {{-- $payout->minimum_transaction --}}
                              {{ config('sximo.cnf_currencysuffix') }}
                          {{--  @endif --}}
                          </span>
												</div>
											<div class="avail-payout-details ">
													<span >{{__('member/multi_lang.avaialble_for_payout')}}</span>
													<span class="cb-color float-right"> {{config('sximo.cnf_currencyname')}}
														<?php

															$availBal   = 0;

                              $getAllowed = explode(',',$payout->cashback_allowed);

															if(in_array("cashback", $getAllowed)) {
  																$availBal = $availBal + $avail_cashback;
															}
															if(in_array("reward", $getAllowed)) {
																$availBal = $availBal +	$avail_reward;
															}
															if(in_array("bonus", $getAllowed)) {
																$availBal = $availBal + $avail_bonus;
															}


														?>
														 {{$availBal}}{{config('sximo.cnf_currencysuffix')}}</span>
												</div>
                        <div class="avail-payout-details text-center bg-light p-2 mt-2 rounded border" >
                            <p class="mb-0">{{__('member/multi_lang.withdrawal_amount')}} </p>
                            <span class="cb-color "> {{config('sximo.cnf_currencyname')}}
                              <input type="number" name="withdrawal_amount"   min="@if(AppClass::Isfirst_trans()){{$payout->minimum_first_transaction}}@else{{$payout->minimum_transaction}}@endif" max = "{{$availBal}}"  class="inputForm" placeholder="{{$availBal}}">{{config('sximo.cnf_currencysuffix')}}
                          </div>

												</div>
												<input type="hidden" name="amount" value="{{$availBal}}">
												<input type="hidden" name="mode_info1" value="{{$payout->payout_info1}}">
												<input type="hidden" name="mode_info2" value="{{$payout->payout_info2}}">
												<input type="hidden" name="mode_info3" value="{{$payout->payout_info3}}">
												<input type="hidden" name="mode_info4" value="{{$payout->payout_info4}}">
												<input type="hidden" name="mode_info5" value="{{$payout->payout_info5}}">

												<div class="withdraw-btn text-center mt-3">
													@if($availBal > $payout->minimum_transaction)
														<button type="submit"  class="btn btn-primary  rounded-0">{{__('member/multi_lang.withdraw')}}</button>
													@else
														<p>{{__('member/multi_lang.withdraw_err')}}</p>
													@endif
											</form>
											</div>
											</div>
										</div>
									</div>

									<!-- Modal -->
									<div class="modal fade" id="edit-modal{{$payout->name}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="exampleModalLongTitle">{{$payout->name}}</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body text-left">
													<div class="recharge-modal-cont">
													<form action="{{route('update.payout').'/'.$payout->metid}}"	 method="post">
														<input type="hidden" name="payout_type" value="{{$payout->code}}" >
													@if($payout->info1 != null)
														@if(strtok($payout->type1,'|' ) =='radio')
															<?php $getCheckBox  = explode('|',$payout->type1);
																?>
																@for($c=1; $c<Count($getCheckBox);$c++)
																<div class="form-check form-check-inline mr-5 pr-5">
																	<input class="form-check-input"  type="radio" name="info1" value="{{$getCheckBox[$c]}}" @if($payout->payout_info1 == $getCheckBox[$c]) checked @endif required>
																	<label class="form-check-label text-muted font-weight-bold" >{{$getCheckBox[$c]}}</label>
																</div>
																@endfor

															@elseif(strtok($payout->type1,'|' ) =='number')
																<div class="form-group">
																	<label>{{$payout->info1}}</label>
																	<input  type="number"   class="form-control"  value="{{$payout->payout_info1}}" name="info1" maxlength="{{substr($payout->type1, strpos($payout->type1, "|") + 1)}}" required>
																</div>
															@else
															<div class="form-group">
																<label>{{$payout->info1}}</label>
																<input @if($payout == 'alphanumeric') type="text" @else type="{{$payout->type1}}" @endif value="{{$payout->payout_info1}}"  class="form-control" name="info1" required>
															</div>
														@endif
													@endif


													@if($payout->info2 != null)
														@if(strtok($payout->type2,'|' ) =='radio')
														<?php $getCheckBox  = explode('|',$payout->type2);
															?>
															@for($c=1; $c<Count($getCheckBox);$c++)
															<div class="form-check form-check-inline mr-5 pr-5">
																<input class="form-check-input" type="radio" name="info2"  value="{{$getCheckBox[$c]}}" @if($payout->payout_info2 == $getCheckBox[$c]) checked @endif required>
																<label class="form-check-label text-muted font-weight-bold" >{{$getCheckBox[$c]}}</label>
															</div>
															@endfor
																@elseif(strtok($payout->type2,'|' ) =='number')


																	<div class="form-group">
																		<label>{{$payout->info2}}</label>
																		<input  type="number"  class="form-control" value="{{$payout->payout_info2}}" name="info2" maxlength="{{substr($payout->type2, strpos($payout->type2, "|") + 1)}}" required>
																	</div>
																@else
																<div class="form-group">
																<label>{{$payout->info2}}</label>
																<input value="{{$payout->payout_info2}}" @if($payout == 'alphanumeric') type="text" @else type="{{$payout->type2}}" @endif  class="form-control" name="info2" required>
															</div>
														@endif
													@endif



													@if($payout->info3 != null)
														@if(strtok($payout->type3,'|' ) =='radio')
														<?php $getCheckBox  = explode('|',$payout->type3);
															?>
															@for($c=1; $c<Count($getCheckBox);$c++)
															<div class="form-check form-check-inline mr-5 pr-5">
																<input class="form-check-input" type="radio" name="info3" value="{{$getCheckBox[$c]}}"  @if($payout->payout_info3 == $getCheckBox[$c]) checked @endif required>
																<label class="form-check-label text-muted font-weight-bold" >{{$getCheckBox[$c]}}</label>
															</div>
															@endfor
																@elseif(strtok($payout->type3,'|' ) =='number')
																	<div class="form-group">
																		<label>{{$payout->info3}}</label>
																		<input  type="number"  value="{{$payout->payout_info3}}" class="form-control" name="info3" maxlength="{{substr($payout->type3, strpos($payout->type3, "|") + 1)}}" required>
																	</div>
																@else
																<div class="form-group">
																<label>{{$payout->info3}}</label>
																<input @if($payout == 'alphanumeric') type="text" @else type="{{$payout->type3}}" @endif  value="{{$payout->payout_info3}}" class="form-control" name="info3" required>
															</div>
														@endif
													@endif



													@if($payout->info4 != null)
														@if(strtok($payout->type4,'|' ) =='radio')
														<?php $getCheckBox  = explode('|',$payout->type4);
															?>
															@for($c=1; $c<Count($getCheckBox);$c++)
															<div class="form-check form-check-inline mr-5 pr-5">
																<input class="form-check-input" type="radio" name="info4" value="{{$getCheckBox[$c]}}"   @if($payout->payout_info4 == $getCheckBox[$c]) checked @endif required >
																<label class="form-check-label text-muted font-weight-bold">{{$getCheckBox[$c]}}</label>
															</div>
															@endfor
																@elseif(strtok($payout->type4,'|' ) =='number')
																	<div class="form-group">
																		<label>{{$payout->info4}}</label>
																		<input  type="number"  class="form-control" name="info4" value="{{$payout->payout_info4}}" maxlength="{{substr($payout->type4, strpos($payout->type4, "|") + 1)}}" required>
																	</div>
																@else
																 <div class="form-group">
																<label>{{$payout->info4}}</label>
																<input @if($payout == 'alphanumeric') type="text" @else type="{{$payout->type4}}" @endif  value="{{$payout->payout_info4}}" class="form-control" name="info4" required>
															</div>
														@endif
													@endif



													@if($payout->info5 != null)
														@if(strtok($payout->type5,'|' ) =='radio')
														<?php $getCheckBox  = explode('|',$payout->type5);
															?>
															@for($c=1; $c<Count($getCheckBox);$c++)
															<div class="form-check form-check-inline mr-5 pr-5">
																<input class="form-check-input" type="radio" name="info5"  value="{{$getCheckBox[$c]}}" @if($payout->payout_info5 == $getCheckBox[$c]) checked @endif required >
																<label class="form-check-label text-muted font-weight-bold" >{{$getCheckBox[$c]}}</label>
															</div>
															@endfor
														@elseif(strtok($payout->type5,'|' ) =='number')
															<div class="form-group">
																<label>{{$payout->info5}}</label>
																<input  type="number"  class="form-control" name="info5" value="{{$payout->payout_info5}}" maxlength="{{$payout->type5}}" required maxlength="{{substr($payout->type5, strpos($payout->type5, "|") + 1)}}">
															</div>
														@else
															<div class="form-group">
																<label>{{$payout->info5}}</label>
																<input @if($payout == 'alphanumeric') type="text" @else type="{{$payout->type5}}" @endif  value="{{$payout->payout_info5}}" class="form-control" name="info5" required>
															</div>
														@endif
													@endif
													 <div class="text-center mb-3">
																<button type="submit" class="btn btn-primary px-5">{{__('member/multi_lang.update_btn')}}</button>
															</div>
														</form>
													</div>
												</div>
											</div>
										</div>
									</div>

								{{-- 	@endforeach --}}
								@else
								<p class="text-center" style="margin:0 auto;">{{__('member/multi_lang.sorry_found')}}!</p>
							@endif

						</div>
					</div>
				    	</div>
</div>
						<div class="payment-option p-3 wrapper-card rounded mb-4">
				    	<div class="row">

                @if(Count($data['payout_type']) > 0)
                  @foreach($data['payout_type'] as $types)
                  <div class="col-lg-6">
                    <div class="recharge border p-3 text-center mb-3">
                      <h5 class="font-weight-bold">{{$types->name}}</h5>
                      <div class="wallet-partner-logo pt-2">
                        <img class="img-fluid" @if($types->image != '') src="{{asset('uploads/images').'/'.$types->image}}" @else
                            src="{{asset('uploads/images/no-image.png')}}"
                         @endif>
                      </div>
                      <div class="payment-methd">
                        <?php
                          $allowedCash = [];
                          $allowedCash = explode(',',$types->cashback_allowed);
                          /*if($types->cashback_allowed == 'all') {
                            $showAll = true;
                          }
                          else {
                            $showAll    = false;
                          }*/
                          $showAll    = false;
                        ?>
						@if(config('settingConfig.module_rewards')=='Y')
                        @if(in_array("reward", $allowedCash) )
                          <span class="mr-3"><i class="fa fa-check text-success"></i>{{__('member/multi_lang.rewards')}}</span>
                        @else
                          <span class="mr-3"><i class="fa fa-ban text-danger"></i> {{__('member/multi_lang.rewards')}}</span>
                        @endif
						{{-- @endif--}}
                      {{--  @if(in_array("bonus", $allowedCash)  )--}}
                        <span class="mr-3"><i class="fa fa-check text-success"></i>{{__('member/multi_lang.bonus')}} </span>
                      {{--  @else --}}
                          <span class="mr-3"><i class="fa fa-ban text-danger"></i>{{__('member/multi_lang.bonus')}}</span>
                      {{--  @endif --}}
                      {{--  @if(in_array("cashback", $allowedCash)  ) --}}
                          <span class="mr-3"><i class="fa fa-check text-success"></i> {{__('member/multi_lang.cashback')}}</span>
                        {{-- @else--}}
                          <span class="mr-3"><i class="fa fa-ban text-danger"></i>{{__('member/multi_lang.cashback')}} </span>
                        {{--@endif --}}
                      </div>
                    <div class="recharge-btn py-3">

                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#recharge-modal{{$types->name}}">
                       <strong>{{-- $types->name--}} </strong>
                      </button>

                      <!-- Modal -->
                      <div class="modal fade" id="recharge-modal{{$types->name}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLongTitle">{{-- $types->name --}}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body text-left">
                              <div class="recharge-modal-cont">
															<form action="{{route('submit.payout')}}"	 method="post">
																<input type="hidden" name="payout_type" value="{{-- $types->code--}}" >
                              {{--@if($types->info1 != null)--}}
                          {{--      @if(strtok($types->type1,'|' ) =='radio')--}}
																	<?php// $getCheckBox  = explode('|',$types->type1);
																		?>
																{{--		@for($c=1; $c<Count($getCheckBox);$c++)--}}
																		<div class="form-check form-check-inline mr-5 pr-5">
																			<input class="form-check-input" type="radio" name="info1" value="{{-- $getCheckBox[$c]--}}"  required>
																			<label class="form-check-label text-muted font-weight-bold" >{{-- $getCheckBox[$c]--}}</label>
																		</div>
																		{{--@endfor--}}

																{{--	@elseif(strtok($types->type1,'|' ) =='number')--}}
																		<div class="form-group">
																			<label>{{-- $types->info1 --}}</label>
																			<input  type="number"  class="form-control" name="info1" maxlength="{{--substr($types->type1, strpos($types->type1, "|") + 1) --}}" required>
																		</div>
																	{{-- @else --}}
																	<div class="form-group">
                                    <label>{{-- $types->info1 --}}</label>
                                    <input {{--@if($types == 'alphanumeric')--}} type="text" {{--@else --}}type="{{--$types->type1--}}"{{-- @endif--}} class="form-control" name="info1" required>
                                  </div>
                                {{--@endif --}}
                              {{-- @endif --}}


                            {{--  @if($types->info2 != null) --}}
                            {{--    @if(strtok($types->type2,'|' ) =='radio') --}}
																<?php// $getCheckBox  = explode('|',$types->type2);
																	?>
																{{--	@for($c=1; $c<Count($getCheckBox);$c++) --}}
																	<div class="form-check form-check-inline mr-5 pr-5">
																		<input class="form-check-input" type="radio" name="info2"  value="{{$getCheckBox[$c]}}" required>
																		<label class="form-check-label text-muted font-weight-bold" >{{$getCheckBox[$c]}}</label>
																	</div>
																	{{-- @endfor --}}
																	{{--	@elseif(strtok($types->type2,'|' ) =='number') --}}


																			<div class="form-group">
																				<label>{{-- $types->info2 --}}</label>
																				<input  type="number"  class="form-control" name="info2" maxlength="{{substr($types->type2, strpos($types->type2, "|") + 1)}}" required>
																			</div>
																		{{--@else --}}
																		<div class="form-group">
                                    <label>{{-- $types->info2--}}</label>
                                    <input {{-- @if($types == 'alphanumeric') --}} type="text" {{--@else--}} type="{{-- $types->type2--}}" {{--@endif--}}  class="form-control" name="info2" required>
                                  </div>
                              {{--  @endif --}}
                          {{--    @endif -}}



                          {{--    @if($types->info3 != null) --}}
                                {{-- @if(strtok($types->type3,'|' ) =='radio') --}}
																<?php// $getCheckBox  = explode('|',$types->type3);
																	?>
																{{--	@for($c=1; $c<Count($getCheckBox);$c++) --}}
																	<div class="form-check form-check-inline mr-5 pr-5">
																		<input class="form-check-input" type="radio" name="info3" value="{{$getCheckBox[$c]}}" required>
																		<label class="form-check-label text-muted font-weight-bold" >{{--$getCheckBox[$c]--}}</label>
																	</div>
															{{--		@endfor--}}
																	{{--	@elseif(strtok($types->type3,'|' ) =='number')--}}
																			<div class="form-group">
																				<label>{{--$types->info3--}}</label>
																				<input  type="number"  class="form-control" name="info3" maxlength="{{substr($types->type3, strpos($types->type3, "|") + 1)}}" required>
																			</div>
																	{{--	@else --}}
																		<div class="form-group">
                                    <label>{{--$types->info3--}}</label>
                                    <input {{--@if($types == 'alphanumeric')--}} type="text" {{--@else--}} type="{{--$types->type3--}}"{{-- @endif--}}  class="form-control" name="info3" required>
                                  </div>
                              {{--  @endif--}}
                              {{-- @endif --}}



                            {{--  @if($types->info4 != null) --}}
                            {{--    @if(strtok($types->type4,'|' ) =='radio') --}}
																<?php //$getCheckBox  = explode('|',$types->type4);
																	?>
																{{--	@for($c=1; $c<Count($getCheckBox);$c++) --}}
																	<div class="form-check form-check-inline mr-5 pr-5">
																		<input class="form-check-input" type="radio" name="info4" value="{{-- $getCheckBox[$c] --}}" required >
																		<label class="form-check-label text-muted font-weight-bold" >{{-- $getCheckBox[$c] --}}</label>
																	</div>
																	{{-- @endfor --}}
															{{--			@elseif(strtok($types->type4,'|' ) =='number')--}}
																			<div class="form-group">
																				<label>{{*-- $types->info4 --}}</label>
																				<input  type="number"  class="form-control" name="info4" maxlength="{{substr($types->type4, strpos($types->type4, "|") + 1)}}" required>
																			</div>
																		@else
																		 <div class="form-group">
                                    <label>{{--$types->info4--}}</label>
                                    <input {{--@if($types == 'alphanumeric')--}} type="text"{{-- @else --}}type="{{--$types->type4 --}}" {{--@endif--}}  class="form-control" name="info4" required>
                                  </div>
                                {{-- @endif--}}
                    {{--          @endif--}}



                              {{--@if($types->info5 != null)--}}
                              {{--  @if(strtok($types->type5,'|' ) =='radio') --}}
																<?php //$getCheckBox  = explode('|',$types->type5);
																	?>
																{{--	@for($c=1; $c<Count($getCheckBox);$c++) --}}
																	<div class="form-check form-check-inline mr-5 pr-5">
																		<input class="form-check-input" type="radio" name="info5"  value="{{$getCheckBox[$c]}}" required >
																		<label class="form-check-label text-muted font-weight-bold" >{{-- $getCheckBox[$c] --}}</label>
																	</div>
															{{--		@endfor --}}
                        {{--        @elseif(strtok($types->type5,'|' ) =='number') --}}
																	<div class="form-group">
																		<label>{{-- $types->info5 --}}</label>
																		<input  type="number"  class="form-control" name="info5" maxlength="{{$types->type5}}" required maxlength="{{substr($types->type5, strpos($types->type5, "|") + 1)}}">
																	</div>
																{{-- @else --}}
                                  <div class="form-group">
                                    <label>{{-- $types->info5 --}}</label>
                                    <input @if($types == 'alphanumeric') type="text" @else type="{{$types->type5}}" @endif  class="form-control" name="info5" required>
                                  </div>
                            {{--    @endif --}}
                              {{--@endif --}}


                                  <div class="text-center mb-3">
                                    <button type="submit" class="btn btn-primary px-5">{{__('member/multi_lang.save_btn')}}</button>
                                  </div>
																</form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                        </div>


                        <div class="trans-time">
                          <img src="{{asset('uploads/images/logistics-delivery-truck.svg')}}" height="35">
                          <span class="text-muted ml-2">{{__('member/multi_lang.delivery')}}: {{$types->delivery}} {{__('member/multi_lang.business_days')}}</span>
                        </div>
                    </div>
                  </div>
            {{--      @endforeach--}}
              {{--  @endif --}}




						</div>
				</div>

				<div class="withdrow-m-wrapper p-3 mt-3 rounded">
					<h4 class="font-weight-bold mb-3">{{__('member/multi_lang.withdrawl_history')}}</h4>
          <div class="" id="withdraw-tb">


          <div class="table-responsive-lg">
					<table class="table border">
					    <thead class="thead-light">
					        <tr>

					            <th scope="col">{{__('member/multi_lang.date')}}</th>
											<th>{{__('member/multi_lang.withdraw_type')}}</th>
					            <th scope="col">{{__('member/multi_lang.estimate')}}</th>
					            <th scope="col">{{__('member/multi_lang.status')}}</th>
					            <th scope="col"></th>
					        </tr>
					    </thead>
					    <tbody>
							{{--	@if(count($data['withdraw_history']) > 0 ) --}}
			{{--					 @foreach($data['withdraw_history'] as $history) --}}
									<tr data-toggle="collapse" data-target="#wtdr{{$history->withdrawal_id}}" class="accordion-toggle collapsed"  aria-expanded="false">
									<td>{{-- date(config('sximo.cnf_date'),strtotime($history->withdrawal_request_date)) --}} </td>
											<td>{{-- $history->name--}}</td>
											<td>{{-- config('sximo.cnf_currencyname') --}} {{--$history->amount}}{{config('sximo.cnf_currencysuffix')--}}</td>
											<td>{{-- ucfirst($history->status)--}}</td>
											<td colspan="5">{{__('member/multi_lang.more_info')}} <i class="fa fa-angle-down"></i></td>
									</tr>
<?php// if( isset($data['withdraw_meta'][$history->withdrawal_id]) ) :?>
										<tr>
										<td colspan="6" class="hiddenRow"><div id="wtdr{{-- $history->withdrawal_id --}}" class="accordian-body p-3 collapse">

			<div class="row">
        <div class="col-md-12">
			<div class="container p-3 border rounded mb-3">
			<div class="col-121 row mb-3">
			<div class="col-4 col-md-4">
			<span class"font-weight-bold mb-0"> <strong>{{__('member/multi_lang.payout_mode')}} </strong></span>
			<p class="mb-0">{{-- $history->mode_info1 --}}</p>
			</div>
			@if($history->mode_info2!='')
			<div class="col-4 col-md-4">
			<span class"font-weight-bold mb-0"> <strong>{{__('member/multi_lang.payout_detail')}} </strong></span>
			<p class="mb-0">{{-- $history->mode_info2 --}}</p>
			</div>
	{{--		@endif --}}
			{{--@if($history->payment_reference_number!='')--}}
			<div class="col-4 col-md-4">
			<label class="mb-0"><strong>{{__('member/multi_lang.payment_reference')}}  </strong></label>
			<span> {{-$history->payment_reference_number --}}</span>
			</div>
			{{-- @endif --}}
			</div>
			<?php// if($history->payment_note!=''):?>
			<div class="row">
			<div class="col-12">
			<p class="mb-0"><strong>{{__('member/multi_lang.payment_note')}}</strong></p>
			{{-- $history->payment_note --}}
			</div>
			</div>
			<?php// endif?>
			</div>

			<?php

          //
					// $wthMeta = $data['withdraw_meta'][$history->withdrawal_id];
					// $firstMeta = $wthMeta[0];
					// if(count($wthMeta)==0)
					// 	$lastMeta = null;
					// else
					// $lastMeta = $wthMeta[ count($wthMeta)-1];
          //
					// if(count($wthMeta)>2)
					// { $withdrawMeta = $wthMeta;  unset($withdrawMeta[0]);unset($withdrawMeta[count($wthMeta)-1]);}
					// else
					// 	$withdrawMeta = array();


				?>

				<ul class="cbp_tmtimeline">

                <li>
                    <time class="cbp_tmtime" datetime="{{--$firstMeta['change_time']--}}"><span class="hidden">{{--date(config('sximo.cnf_date'),strtotime($firstMeta['change_time']))--}}</span>
					<span class="large">{{--\Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $firstMeta['change_time'])->diffForHumans()--}}</span></time>
                    <div class="cbp_tmicon"><i class="fa fa-flag"></i></div>
                    <div class="cbp_tmlabel empty"> <span>{{__('member/multi_lang.history_status')}} - {{--ucfirst($firstMeta['status'])--}}</span> </div>
                </li>

				<?php //foreach($withdrawMeta as $withDetail) {	?>

				 <li>
                    <time class="cbp_tmtime" datetime="{{--$withDetail['change_time']--}}">
					<span>{{-- date(config('sximo.cnf_date'),strtotime($withDetail['change_time'])) --}}</span>
					<span>{{-- \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $withDetail['change_time'])->diffForHumans() --}}</span></time>
                    <div class="cbp_tmicon {{AppClass::getBgClassByStatus($withDetail['status']) }}"> <i class="fa fa-step-forward"></i></div>
                    <div class="cbp_tmlabel">
					 <span>{{__('member/multi_lang.history_status')}} - {{ucfirst($withDetail['status'])}}</span>
                    </div>
                </li>


				<?php } ?>

				<?php //if($lastMeta) :?>

				 <li>
                    <time class="cbp_tmtime" datetime="{{$lastMeta['change_time']}}">
					<span>{{-- date(config('sximo.cnf_date'),strtotime($lastMeta['change_time'])) --}}</span>
					<span>{{-- \Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $lastMeta['change_time'])->diffForHumans() --}}</span></time>
                    <div class="cbp_tmicon bg-dark"><i class="fa fa-flag-checkered"></i></div>
                    <div class="cbp_tmlabel">
                        <span>{{__('member/multi_lang.history_status')}} - {{-- ucfirst($lastMeta['status']) --}}</span>
                    </div>
                </li>

				<?php //endif; ?>

				</ul>



        </div>
    </div>

										</div></td>
									</tr>
									<?php// else :?>

		<tr>
		<td colspan="6" class="hiddenRow">
		<div id="wtdr{{$history->withdrawal_id}}" class="accordian-body p-3 collapse">
		{{__('member/multi_lang.sorry_found')}}!
		</div>
		</td>
		</tr>
<?php endif;?>
							{{--		@endforeach --}}
						{{--		@else --}}
									<tr>
										<td colspan="5">{{__('member/multi_lang.sorry_found')}}!</td>
									</tr>
	{{--@endif --}}

							</tbody>
					</table>
          {{-- !! $data['withdraw_history']->render() !! --}}

				    </div>
        </div>
				</div>
			</div>
		</div>
{{-- @if(strip_tags($data['page_data']->bottom_content) != '') --}}
      <div class="my-msg bg-white p-3 rounded mb-4">
          {{-- !! $data['page_data']->bottom_content !! --}}
      </div>
{{-- @endif --}}
		</div>
  {{--  @endif --}}
	</div>
</div>
<script type="text/javascript" src="{{asset('public_assets/js/member.js')}}"></script>

@endsection
