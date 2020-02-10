@extends('public.layouts.app')
@section('content')
@section('title')
  {!! $data['page_data']->meta_title!!}
@endsection

  <?php $breadTitle =__('member/multi_lang.missing_cashback'); ?>
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

      			<div class="m-cashback -wrapper border rounded ">
				<div class="m-cb-content p-3">
					<div class="important-note-wrapper">
				    	<div class="imp-note-content border rounded p-2">
				    		<div class="note-title border-bottom">
				    			<h6 class="font-weight-bold p-2">{!! $data['page_data']->heading !!}</h6>
				    		</div>
                @if(strip_tags($data['page_data']->top_content) != '')
				    		<div class="imp-note-desc">
                    {!! $data['page_data']->top_content !!}
				    		</div>
                @endif

				    	</div>

				    </div>

				    <div class="m-cb-claim-details mt-4">
				    	<div class="clearfix">
				    	<div class="m-cb-title">
				    		<h5 class="text-uppercase font-weight-bold float-left mt-2">{{__('member/multi_lang.missing_cashback_claims')}}</h5>
							<a href="{{url('member/create/missing-cashback-claim')}}" class="btn btn-primary float-right">{{__('member/multi_lang.creat_claim_btn')}}</a>
							</div>

						</div>
						<p class="text-muted">{{__('member/multi_lang.claim_details')}}</p>

				    	<div class="m-cb-table">
				    		<div class="table-responsive-lg">
  						<table class="table border text-center">
						  <thead class="thead-light">
						    <tr>
						      <th scope="col">{{__('member/multi_lang.claim_date')}}</th>
						      <th scope="col">{{__('member/multi_lang.mer')}}</th>
						      <th scope="col">{{__('member/multi_lang.click_date')}}</th>
						      <th scope="col">{{__('member/multi_lang.claim_id')}}</th>
						      <th scope="col">{{__('member/multi_lang.status')}}</th>
						      <th scope="col">{{__('member/multi_lang.tbl_details')}}</th>

						    </tr>
						  </thead>
						  <tbody>
                @if(Count($data['missingCashback']) > 0)
                  @foreach($data['missingCashback'] as $missingCash)
                  <tr>
                    <td>{{date(config('sximo.cnf_date'),strtotime($missingCash->tick_crDate))}}</td>
                    <td>{{$missingCash->store_name}}</td>
                    <td>{{date('M d,Y',strtotime($missingCash->click_time))}}</td>
                    <td>{{$missingCash->tick_pkey}}</td>
                    <td>{{ucfirst(str_replace('close','Closed',$missingCash->tick_status))}}</td>
                    <td><a href="{{url('member/viewMissing-cashback-claim').'/'.$missingCash->tick_pkey}}"><i class="fa fa-newspaper-o"></i></a></td>
                  </tr>
                  @endforeach
                  @else
                  <tr>
                    <td colspan="6">{{__('member/multi_lang.sorry_found')}}!</td>
                  </tr>
                @endif


						  </tbody>
						</table>
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
@endsection
