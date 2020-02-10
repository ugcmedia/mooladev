@extends('public.layouts.app')
@section('content')
@section('title')
  {!! $data['page_data']->meta_title!!}
@endsection


  <?php $breadTitle =__('member/multi_lang.home'); ?>
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
			<div class="contect-us-wrapper border rounded p-3">
				<h5 class="font-weight-bold text-center">{{__('member/multi_lang.help')}}</h5>
				<div class="contect-us-frm mt-3 mx-auto col-12 col-lg-8">


					<form action="{{route('store.contact-us')}}" method="post">
						{{ csrf_field() }}
						<?php
							$c_reason     =  explode(',',config('settingConfig.contact_reasons'));
							$csub_reason  =  explode(',',config('settingConfig.member_contact_cats'));
						 ?>
					<div class="form-group row">
					    <label for="inputEmail" class="col-sm-4 col-form-label text-lg-right text-md-right text-sm-left">{{__('member/multi_lang.select_cat')}}</label>
					    <div class="col-sm-8">
					      <select class="form-control" name="reason" required>
					      	<option value="">{{__('member/multi_lang.select_cat')}}</option>
								@foreach($c_reason as $reason)
							  	<option @if(old('reason')  ==  $reason ) selected @endif value="{{$reason}}">{{$reason}}	</option>
								@endforeach
							</select>
						    </div>
					  </div>

					  <div class="form-group row">
					    <label for="inputEmail" class="col-sm-4 col-form-label text-lg-right text-md-right text-sm-left">{{__('member/multi_lang.problem_type')}}</label>
					    <div class="col-sm-8">
					      <select class="form-control" name="sub_reason" required>
					      	<option value="">{{__('member/multi_lang.problem_type')}}</option>
									@foreach($csub_reason as $reason)
									<option @if(old('sub_reason')  ==  $reason ) selected @endif value="{{$reason}}">{{$reason}}	</option>
							  	@endforeach
							 </select>
						   </div>
					  </div>

					  <div class="form-group row">
					    <label for="inputEmail" class="col-sm-4 col-form-label text-lg-right text-md-right text-sm-left">{{__('member/multi_lang.prob_desc')}}</label>
					    <div class="col-sm-8">
					      <textarea class="prob-disc" name="message"  value="{{ old('message') }}" required></textarea>
						    <div class="text-center mt-4">
						      <button type="submit" class="btn btn-primary btn-block rounded p-2 font-weight-bold">{{__('member/multi_lang.send_btn')}}</button>
								</div>
					    </div>
					  </div>
					</form>
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
