@extends('public.layouts.app')
@section('content')
@section('title')
  {{--  !! $data['page_data']->meta_title!! --}}
@edsection


    <?php $breadTitle =__('member/multi_lang.profile'); ?>
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
              </div>
            @endif
      			<div class="bg-white rounded">

      				<div class="history-tabs p-2">
				    		<ul class="nav nav-pills bg-white border-bottom px-3" id="pills-tab" role="tablist">
							  <li class="nav-item  mx-lg-auto mx-md-0 mx-sm-0">
							    <a class="nav-link active p-3" id="pills-p-info-tab" data-toggle="pill" href="#pills-p-info" role="tab" aria-controls="pills-p-info" aria-selected="true">{{__('member/multi_lang.personal_info')}}</a>
							  </li>
							  <li class="nav-item mx-lg-auto mx-md-0 mx-sm-0">
							    <a class="nav-link p-3" id="pills-c-pass-tab" data-toggle="pill" href="#pills-c-pass" role="tab" aria-controls="pills-c-pass" aria-selected="false">{{__('member/multi_lang.chg_pwd')}}</a>
							  </li>

							</ul>
							<div class="tab-content" id="pills-tabContent">
							  <div class="tab-pane fade show active" id="pills-p-info" role="tabpanel" aria-labelledby="pills-p-info-tab">

                	<div class="user-profile-info mx-auto p-3 mt-3 col-12 col-lg-8">
									<?php $msg = Session::get('change_pass'); ?>
									@if($msg != 'changepass')
                    @include('public.layouts.partials.notification')
								  @endif
				    	<div class="info-frm">
                <form action="{{route('update.profile').'/'.Session::get('memberDetail')->member_id}}" method="post" enctype="multipart/form-data">
							  <div class="form-group row">
							    <label for="staticname" class="col-sm-4 col-form-label text-lg-right text-md-right text-sm-left">{{__('member/multi_lang.name')}}</label>
							    <div class="col-sm-8">
							      <input type="name" name="first_name" value="{{Session::get('memberDetail')->first_name}}" class="form-control"  placeholder="Enter Your Name">
							    </div>
							  </div>
							  <div class="form-group row">
							    <label for="inputEmail" class="col-sm-4 col-form-label text-lg-right text-md-right text-sm-left">{{__('member/multi_lang.email')}}</label>
							    <div class="col-sm-8">
							      <input type="email" name="email" disabled class="form-control" value="{{Session::get('memberDetail')->email}}"  placeholder="Enter Your Email id">
                    @if(Session::get('memberDetail')->email_verified != 'Y'  )
                    <p style="color:red">  {{__('member/multi_lang.verify_Mail')}}
                       <a href="{{route('resendMail')}}">
                          {{__('member/multi_lang.click_here')}}
                        </a>
                      </p>
                    @endif
                  </div>
							  </div>


							  <div class="form-group row">
							    <label for="inputEmail" class="col-sm-4 col-form-label text-lg-right text-md-right text-sm-left">{{__('member/multi_lang.sec_email')}}</label>
							    <div class="col-sm-8">
							      <input type="email" name="s_email" class="form-control bg-light" value="{{Session::get('memberDetail')->s_email}}" placeholder="Enter Your Email id">
							    </div>
							  </div>

							 @if(config('settingConfig.verify_mobile') =='Y' )
							  <div class="form-group row">
							    <label for="input-p-num"  class="col-sm-4 col-form-label text-lg-right text-md-right text-sm-left">{{__('member/multi_lang.phone_num')}} <span class="text-muted"><small>{{__('member/multi_lang.phone_num_desc')}}</small></span></label>

							    <div class="col-sm-8">
							      <input type="-p-num" disabled name="mobile_number" value="{{Session::get('memberDetail')->mobile_number}}" class="form-control" id="input-p-num" placeholder="Enter Your 10 Digit Phone Number">
                    @if( Session::get('memberDetail')->mobile_verified != 'Y')
                    <p style="color:red">   {{__('member/multi_lang.verify_mobile')}}<br>
                      <a href="#" data-toggle="modal" data-target="#verifyNumber" >({{__('member/multi_lang.click_mobile')}})</a>
                    </p>
                    @else
                    <p style="color:red">   {{__('member/multi_lang.change_number')}}<br>
                      <a href="#"  data-toggle="modal" data-target="#verifyNumber" >({{__('member/multi_lang.click_mobile_chang')}})</a>
                    </p>
                  @endif

                  </div>
							  </div>
							  @endif

                <div class="form-group row">
                  <label for="inputEmail" class="col-sm-4 col-form-label text-lg-right text-md-right text-sm-left"></label>
                <div class="col-sm-8">
                	<div class="user-info">
                  @if(Session::get('memberDetail')->creation_mode == 'D' || (Session::get('memberDetail')->profile_picture != null && Session::get('memberDetail')->profile_picture != '') )
                		@if(Session::get('memberDetail')->profile_picture !='' && Session::get('memberDetail')->profile_picture != null)
                			<img src="{{asset('uploads/images/user'.'/'.Session::get('memberDetail')->profile_picture)}}" >
                			@else
                			<img src="{{asset('uploads/images/user_default.png')}}" >
                		@endif
                	@else
                		<img src="{{Session::get('memberDetail')->social_link}}" >
                	@endif
                	</div>
                </div>
              </div>
							  <div class="form-group row">

							    <label for="input-img"  class="col-sm-4 col-form-label text-lg-right text-md-right text-sm-left">{{__('member/multi_lang.profile')}}</label>

							    <div class="col-sm-8">
							    <input type="file" name="profile" value="" class="form-control" id="input-img">
								 <div class="text-center mt-4">
								<button type="submit" class="btn btn-primary btn-block rounded p-2 font-weight-bold">{{__('member/multi_lang.save_btn')}} </button>
		                    </div>
								</div>
							  </div>


							</form>
				    	</div>
						 </div>
							  </div>

							  <div class="tab-pane fade" id="pills-c-pass" role="tabpanel" aria-labelledby="pills-c-pass-tab">
								<?php $msg = Session::get('change_pass'); ?>
									@if($msg == 'changepass')
						  			@include('public.layouts.partials.notification')
									@endif
							  	<div class="change-password-frm p-3 mt-3 col-12 col-lg-8 mx-auto">
               @if(Session::get('memberDetail')->creation_mode != 'D')
                <p>{{__('public/common.cantchangePassMsg')}}</p>
               @else
                	<form action="{{route('member.change_password')}}" method="post" enctype="multipart/form-data">
							  	<div class="form-group row">
							    <label for="staticname" class="col-sm-4 col-form-label text-lg-right text-md-right text-sm-left">{{__('member/multi_lang.old_pwd')}}</label>
							    <div class="col-sm-8">
							      <input type="Password" name="old_password" class="form-control"  >
							    </div>
							  	</div>

							  	<div class="form-group row">
							    <label for="staticname" class="col-sm-4 col-form-label text-lg-right text-md-right text-sm-left">{{__('member/multi_lang.new_pwd')}}</label>
							    <div class="col-sm-8">
							      <input type="Password" name="password" class="form-control"  >
							    </div>
							  	</div>

							  	<div class="form-group row">
							    <label for="staticname" class="col-sm-4 col-form-label text-lg-right text-md-right text-sm-left">{{__('member/multi_lang.con_pwd')}}</label>
							    <div class="col-sm-8">
							      <input type="Password" name="confirm_password" class="form-control"  >
							      <div class="text-center mt-4">
								      <button type="submit" class="btn btn-primary btn-block rounded p-2 font-weight-bold">{{__('member/multi_lang.cng_pwd_btn')}} </button>
										</div>
							    </div>
							  	</div>
							  </form>
                @endif
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


<script type="text/javascript" src="{{asset('public_assets/js/member.js')}}"></script>

@endsection
