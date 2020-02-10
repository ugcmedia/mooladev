@extends('public.layouts.app')
@section('content')
@section('title')
  {!! $data['page_data']->meta_title!!}
@endsection

  <?php $breadTitle2=__('member/multi_lang.missing_cashback'); $breadLink = url('member/missing-cashback-claim'); $breadTitle =__('member/multi_lang.cash_act');  ?>
  @include('member-dash/member-partials/title_heading_common')
<div class="main-content py-5">
   <div class="container">
    	<div class="row">
        @include('member-dash/member-partials/sidebar')
      		<div class="col-xl-9 col-lg-9 col-md-8">

			<div class="creat-cb-claim-wrap border rounded p-4">
        <h4 class="text-uppercase font-weight-bold mt-2">{{__('member/multi_lang.create_claim')}}</h4>
        <div class="note-title border-bottom">
          <h6 class="font-weight-bold p-2">{!! $data['page_data']->heading !!}</h6>
        </div>
        @if(strip_tags($data['page_data']->top_content) != '')
				 <div class="imp-things p-3 border rounded">
				      <div class="m-cb-claims-points">
                {!! $data['page_data']->top_content !!}
				          </div>
                </div>
          @endif
				<div class="claim-issue-content">


					<div class="issue-form-list my-5">
						<div class="cb-not-track-form">
					<div id="not-track-form" >
						<p class="issue-title font-weight-bold mb-0">{{__('member/multi_lang.cashback_not_tracked')}}</p>
						<p class="text-muted">{{__('member/multi_lang.cashback_not_tracked_desc')}}</p>
            <div class="row">
            <div class="col-12 col-lg-8 mx-auto">
            <form  action="{{route('store.missingCashback')}}" method="post" enctype="multipart/form-data">
						  <div class="form-group row">
						    <label for="Select-merchant" class="col-sm-4 col-form-label">{{__('member/multi_lang.select_merchant')}}</label>
						    <div class="col-sm-8">
						     <select class="form-control" id="merchant" name="store_id" required>
						      <option>Select a Merchant</option>
						      @foreach($data['getStores'] as $store)
                    <option value="{{$store->store_id}}">{{$store->store_name}} </option>
                  @endforeach
						    </select>
						    </div>
						  </div>

						  <div class="form-group row">
						    <label for="outclick" class="col-sm-4 col-form-label">{{__('member/multi_lang.click_time')}}</label>
						    <div class="col-sm-8">
						     <select class="form-control" id="click_id" name="click_id" required>
						      <option>Select {{__('member/multi_lang.click_time')}}</option>
						      </select>
						    </div>
						  </div>

						  <div class="form-group row">
						    <label for="outclick" class="col-sm-4 col-form-label" >{{__('member/multi_lang.where_did_you_transact?')}}</label>
						    <div class="col-sm-8">
						     <select class="form-control" id="merchant" name="from" required>
						      <option value="Website">Website</option>
						      <option value="mobile-web">Mobile Website</option>
						      <option value="android-app">Android App</option>
						      <option value="ios-app">iOS App</option>
						      </select>
						    </div>
						  </div>

						  <div class="form-group row">
						    <label for="outclick" class="col-sm-4 col-form-label" >{{__('member/multi_lang.order_id')}}</label>
						    <div class="col-sm-8">
						     <input type="text" name="order_id" class="form-control" required  placeholder="Enter the order id given to you by Merchant"style="font-size: 11px; line-height: 2.2;" >
						    </div>
						  </div>

						  <div class="form-group row">
						    <label for="outclick" class="col-sm-4 col-form-label">{{__('member/multi_lang.grand_total')}}</label>
						    <div class="col-sm-8">
								 <input type="number" class="form-control"  required name="total_amt" min="1"  step="any"  pattern="^\d+(?:\.\d{1,2})?$" >

						    </div>
						  </div>

						  <div class="form-group row">
						    <label for="outclick" class="col-sm-4 col-form-label">{{__('member/multi_lang.dop')}}</label>
						    <div class="col-sm-8">
						     <input type="date" name="date_purchase" required class="form-control" min="{{date('Y-m-d', strtotime('now - '.config("settingConfig.cb_claim_max_days").' days' ) ) }}" max="{{date('Y-m-d', strtotime('now - '.config("settingConfig.cb_claim_min_days").' days' ) ) }}" placeholder="enter date of purchase">
						    </div>
						  </div>

							<div class="form-group row">
								<label for="outclick" class="col-sm-4 col-form-label">{{__('member/multi_lang.comment')}}</label>
								<div class="col-sm-8">
									<textarea name="user_comment"  class="form-control"  rows="5" placeholder="Add comment"></textarea>
								</div>
							</div>

						  <div class="form-group row">
						    <label for="outclick" class="col-sm-4 col-form-label">{{__('member/multi_lang.pop')}}</label>
						    <div class="col-sm-8">

						      <input type="file" name="ticket_image" value="" class="form-control" id="input-img" >
						      <button type="submit" class="btn btn-primary btn-block rounded mt-5">{{__('member/multi_lang.submit_btn')}}</button>
						    </div>
							</div>


						</form>
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
      	</div>
     </div>
</div>

<script type="text/javascript" src="{{asset('public_assets/js/member.js')}}"></script>

@endsection
