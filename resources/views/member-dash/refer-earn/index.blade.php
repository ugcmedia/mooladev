
@extends('public.layouts.app')
@section('content')
@section('title')
  {--!! $data['page_data']->meta_title !! --}
@endsection

<?php
/*
if(isset($_GET['noytify']))
{
    $updateNotify = AppClass::updateNotification($_GET['noytify'],'tb_user_referrals_changes');
}*/

?>
  <?php/* $breadTitle =__('member/multi_lang.refer_and_earn');*/ ?>
  @include('member-dash/member-partials/title_heading_common')
<div class="main-content py-5">
   <div class="container">
    	<div class="row">
        @include('member-dash/member-partials/sidebar')
      		<div class="col-xl-9 col-lg-9 col-md-8">
      			<div class="referral-section-content border ">
              <div class="refer-section text-white border-0 shadow-sm rounded mb-4">
                <div class="referContent h-100 text-center justify-content-center">
                  <h2 class="right-refer-info pt-3 text-white fw-700">{{-- !! str_ireplace('#AMOUNT','<span class="refer_ptspan fw-800">'.config('settingConfig.mlm_split').'%</span>'  ,__('member/multi_lang.refer_desc'))!! --}} </h2>
                  <div class="card-text mb-3">{{__('member/multi_lang.refer_and_earn_desc')}}</div>
                  <div class="btn-refer mt-2">
                    <button class="btn-primary btn shadow-sm" data-toggle="modal" data-target="#referal-modal">
          					<strong>{{__('member/multi_lang.tbl_details')}}</strong>
          					</button>
                  </div>
                  <!-- <div class="btn-refer mt-2">
                      <a href="{{-- url('member/refer-and-earn') --}}" role="button" class="btn btn-primary member-btn">{{__('member/multi_lang.tbl_details')}}</a>
                  </div> -->
                </div>
                <p class="card-text referalValidity">{{-- str_replace('#DATE',date(config('sximo.cnf_date'),strtotime( Session::get('memberDetail')->referral_validity )),__('member/multi_lang.referral_validity'))--}}</p>
              </div>
					<!-- <div class="referral-logo">
						<div class="referral-icon text-white font-weight-light text-center" style="font-size: 8rem;">
							<i class="fa fa-commenting-o" aria-hidden="true"></i>
							<h3 class="font-weight-bold p-3 pb-5">
                {{-- !! str_ireplace('#AMOUNT','<span class="refer_ptspan">'.config('settingConfig.mlm_split').'%</span>'  ,__('member/multi_lang.refer_and_earn_heading'))!!--}}
                </h3>
						</div>
					</div> -->
					<!-- <h1 class="refrral-title pt-3 text-center ">{{--!! $data['page_data']->top_content !! --}}</h1> -->
					<!-- <div class="refrel-disc  text-center mb-5">
					<h5 class="text-muted font-weight-normal p-3">{{__('member/multi_lang.refer_and_earn_desc')}}</h5>
					<h4 class="text-center">{{-- str_replace('#DATE',date(config('sximo.cnf_date'),strtotime( Session::get('memberDetail')->referral_validity )),__('member/multi_lang.referral_validity')) --}}</h4>
					<button class="btn-primary btn" data-toggle="modal" data-target="#referal-modal">
					<strong>{{__('member/multi_lang.tbl_details')}}</strong>
					</button>


					</div> -->
          <!-- Modal -->
					<div class="modal fade" id="referal-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered " role="document">
					    <div class="modal-content">
					      <div class="modal-header" style="border-bottom: 0;">
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 17px; top: 20px;">
					          <span aria-hidden="true">&times;</span>
					        </button>
                  <div  class="text-center col-12">
                    <h4 align="center">{{__('member/multi_lang.referEarn_terms')}}</h4>
                  </div>
					      </div>
					      <div class="modal-body text-left">
					             {{--!! config('settingConfig.referral_terms')!! --}}
					      </div>
					      <div class="modal-footer bg-light rounded">
					       <p class="text-primary mb-0"><small>{{__('member/multi_lang.refer_and_earn_desc3')}}</small></p>
					      </div>
					      </div>
					  </div>
					</div>
					<!-- share-section -->
					<div class="share-section">
						<div class="share-mail border-bottom">
						<div class="row text-center">
							<div class="col-lg-12 col-md-12">
							<div class="email-content p-4">
							<img src="{{asset('uploads/images/email2.png')}}" class="img-fluid" alt="Responsive image">
							<h5 class="font-weight-bold my-4">{{__('member/multi_lang.invite_email')}}</h5>
							<div class="invite-m-btn">
							<form action="{{route('send.multipleemail')}}" method="post">
							    <div class="input-group input-group-lg">
							      <input type="text" name="mul_email" class="form-control" placeholder="Enter emails with commas">
							      <div class="invite-btn">
							        <button type="submit"  class="btn btn-primary p-3 font-weight-bold">{{__('member/multi_lang.invite')}}</button>
							      </div>
							    </div>
							  </form>
							</div>

							<div class="help-text pt-3 pb-4">
								<span class="mb-0">{{__('member/multi_lang.invite_desc')}}<span>
								<a href="" data-toggle="modal" data-target="#gmail-modal">
								{{__('member/multi_lang.preview_email')}}
								</a>
                <br>

					<!-- Modal -->
					<div class="modal fade" id="gmail-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
					  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
					    <div class="modal-content">
					      <div class="modal-header" style="border-bottom: 0;">
					        <h5 class="modal-title" id="exampleModalLongTitle">
							<?php
/*
               $sub = AppClass::getPreviewEmail()->subject;
							 $sub  = str_ireplace('#JoiningBonusAmount ',config('settingConfig.mlm_split').'%  ',$sub);
							$sub  = str_ireplace('#WEBSITENAME',config('sximo.cnf_appname'),$sub);
							echo $sub;
*/
              ?>
							</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 17px; top: 20px;">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body text-left">
					      	<div class="ref-modal-cont p-4" style="zoom:0.6">
                    <?php
                    /*
                        $preTemp  = str_ireplace('#REFLINK',url('/').'/?referal_code='.Session::get('memberDetail')->referral_code,AppClass::getPreviewEmail()->body);
                        $preTemp  = str_ireplace('#WEBSITENAME',config('sximo.cnf_appname'),$preTemp);
                        $preTemp  = str_ireplace('#RefCode',Session::get('memberDetail')->referral_code,$preTemp);
                        $preTemp  = str_ireplace('#SUBJECT',AppClass::getPreviewEmail()->subject,$preTemp);
                        $preTemp  = str_ireplace('#JoiningBonusAmount ',config('settingConfig.mlm_split').'%  ',$preTemp);
                        $preTemp  = str_ireplace('#WEBSITENAME',config('sximo.cnf_appname'),$preTemp);
                        */
                     ?>

					  @include('EmailHead') {{--!! $preTemp !!--}} @include('EmailFoot')
					   	</div>
					      </div>
					   </div>

					  </div>
					</div>

							</div>
						</div>
							</div>
						</div>
					</div>
					<div class="or-ico position-relative">
						<div class="ico-text d-none d-sm-block">{{__('member/multi_lang.or')}}</div>
					</div>
					<!-- invite start -->
						<div class="invite pt-5 pb-4">
								<h6 class="text-center font-weight-bold">{{__('member/multi_lang.invite_via')}}</h6>
							</div>
              <?php
              /*
                $getSocialLinks = AppClass::getSocialLinks(url('/').'/'.AppClass::getPageUrl('joinnow')->alias.'?referal_code='.Session::get('memberDetail')->referral_code,'Refer AND earn');
              */?>
              <div class="share-btn border-bottom px-3 pt-3 pb-5">
              <div class="row">

          {{--  @foreach($getSocialLinks as $key => $value) --}}
                  <div class="col-lg-4 col-md-6 p-4">
                    <div class="{{--$key --}}-btn">
                      <a href="{{--$value--}}" target="_blank">
                        <button type="button" class="btn btn-primary btn-lg w-100 px-0 rounded">
                        <i class="fa fa-{{--$key--}} pr-2" aria-hidden="true"></i>{{-- ucfirst(str_replace(['comment','envelope'],['SMS','Email'],$key)) --}}
                      </button
                    </a>
                    </div>
                  </div>
                  {{--   @endforeach --}}


							</div>
						</div>
						<!-- invite-end -->

						<div class="or-ico position-relative">
						<div class="ico-text d-none d-sm-block">{{__('member/multi_lang.or')}}</div>
					</div>
						<!-- share-code-start -->
					<div class="share-cod">
						<div class="share-title p-5">
							<h6 class="text-center font-weight-bold">{{__('member/multi_lang.copy_this')}}</h6>
						</div>
						<div class="cod-control mx-auto p-3 pb-5">
							<form>
							    <div class="input-group input-group-lg">
							      <input type="text" class="form-control p-3" id="copyLink" readonly value="{{--url('/').'/'.AppClass::getPageUrl('joinnow')->alias --}}/?referal_code={{--Session::get('memberDetail')->referral_code --}}">
							      <div class="input-group-btn">
							        <button type="button" onclick="copyRefLink();" class="btn copyLinkBtn btn-primary p-4 px-3">{{__('member/multi_lang.copy_link')}}</button>
							      </div>
							    </div>
							  </form>
						</div>
					</div>
					<!-- share-code-end -->
						</div>
					</div>
					<!-- share-section end -->

<!-- invite-section-start -->
<div class="invite-section border bg-white rounded mt-4 p-3" id="refer-tb">
	<div class="invite-title">
		<h4 class="text-center mb-4">{{__('member/multi_lang.your_referral_activity')}}</h4>
	</div>

		<div class="history-tabs border rounded mb-4">
    		<ul class="nav nav-pills border-bottom px-3" id="pills-tab" role="tablist">

			<li class="nav-item mx-lg-auto mx-md-0 mx-sm-0">
			    <a class="nav-link p-3 active show" id="pills-Signed-Up-tab" data-toggle="pill" href="#pills-Signed-Up" role="tab" aria-controls="pills-Signed-Up" aria-selected="false">{{__('member/multi_lang.signed_up')}}</a>
			  </li>

			  <li class="nav-item mx-lg-auto mx-md-0 mx-sm-0">
			    <a class="nav-link p-3 " id="pills-Invited-tab" data-toggle="pill" href="#pills-Invited" role="tab" aria-controls="pills-Invited" aria-selected="true">{{__('member/multi_lang.invited')}}</a>
			  </li>



			</ul>
			<div class="tab-content" id="pills-tabContent">

			 <div class="tab-pane fade active show" id="pills-Signed-Up" role="tabpanel" aria-labelledby="pills-Signed-Up-tab">

			{{--		@if(count($data['referedUser'] ) > 0 )--}}
						<div class="table-responsive-lg">
						<table class="table border">
						<thead class="thead-light">
                          <tr>
                              <th scope="col">{{__('member/multi_lang.referTbl_user')}}</th>
                              <th scope="col">{{__('member/multi_lang.referTbl_joined')}}</th>
                              <th scope="col">{{__('member/multi_lang.referTbl_referral')}}</th>
                          </tr>
                      </thead>
					  <tbody>
						{{--  @foreach($data['referedUser'] as $refered) --}}
						<tr>
							<td><p class="invite-person text-capitalize mb-0">{{-- $refered->first_name.' '.$refered->last_name --}}</p>
                      <p class="invite-person text-capitalize mb-0">{{-- $refered->email --}}</p></td>
							<td><p class="invite-date text-capitalize">{{-- date(config('sximo.cnf_date'),strtotime($refered->join_date))--}}</p></td>
							<td><p class="text-capitalize">{{-- $refered->referral_commission --}}% {{__('member/multi_lang.referral')}}</p></td>
							</tr>
              {{-- 			@endforeach --}}

							</tbody>
                      </table>
                      </div>

              {{-- 	@else --}}
							<p class="invite-action text-capitalize p-3 mb-0">{{__('member/multi_lang.sorry_found')}}!</p>

            {{-- @endif --}}

			  </div>

			  <div class="tab-pane fade " id="pills-Invited" role="tabpanel" aria-labelledby="pills-Invited-tab">

				{{-- 	@if(count($data['invited'] ) > 0 ) --}}		<div class="table-responsive-lg">
						<table class="table border">
						<thead class="thead-light">
                          <tr>
						  <th scope="col">{{__('member/multi_lang.referTbl_inviteEmail')}}</th>
                              <th scope="col">{{__('member/multi_lang.referTbl_invitedOn')}}</th>
                          </tr>
                      </thead>
					  <tbody>
              {{-- 	@foreach($data['invited'] as $invite) --}}

								<tr>
								<td><p class="invite-person text-capitalize mb-0">{{-- $invite->invitee_email --}}</p></td>
								<td><p class="invite-date text-capitalize">{{--!! date(config('sximo.cnf_date'),strtotime($invite->invite_date))!!--}}</p></td>
								</tr>
						{{--	@endforeach --}}
							</tbody>
                      </table>
                      </div>
						{{--	@else --}}
							<p class="invite-action text-capitalize p-3 mb-0">{{__('member/multi_lang.sorry_found')}}!</p>
					{{--	@endif --}}

			  </div>




			</div>
    	</div>

</div>
<!-- invite-section-End -->

{{-- @if(strip_tags($data['page_data']->bottom_content) != '') --}}
  <div class="my-msg bg-white p-3 rounded mb-4">
      {{-- $data['page_data']->bottom_content --}}
  </div>
{{-- @endif --}}
				</div>
			</div>
		</div>
	</div>

</div>
@endsection
