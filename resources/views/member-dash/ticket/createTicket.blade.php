@extends('public.layouts.app')
@section('content')
@section('title')
  {!! $data['page_data']->meta_title!!}
@endsection

  <?php $breadTitle2=__('member/multi_lang.ticket'); $breadLink =url('member/support-ticket'); $breadTitle =__('member/multi_lang.cash_act');  ?>
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

			<div class="creat-cb-claim-wrap border rounded p-4">
				<h4 class="text-uppercase font-weight-bold mt-2">{{__('member/multi_lang.create')}} {{__('member/multi_lang.ticket')}}</h4>
        <div class="note-title border-bottom">
          <h6 class="font-weight-bold p-2">{!! $data['page_data']->heading !!}</h6>
        </div>
        @if(strip_tags($data['page_data']->top_content) != '')
        <div class="imp-things pt-3 border rounded">
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
            <div class="col-12 col-lg-8 mx-auto">
        		<form class="" action="{{route('store.ticket')}}" method="post">
						  <div class="form-group row">
						    <label for="Select-merchant" class="col-sm-4 col-form-label">{{__('member/multi_lang.select_merchant')}}</label>
						    <div class="col-sm-8">
						     <select class="form-control" id="merchant" name="store_id" required>
						      <option value="">Select a Merchant</option>
						      @foreach($data['getStores'] as $store)
                    <option value="{{$store->store_id}}">{{$store->store_name}} </option>
                  @endforeach
						    </select>
						    </div>
						  </div>

						  <div class="form-group row">
						    <label for="outclick" class="col-sm-4 col-form-label">{{__('member/multi_lang.transaction')}}</label>
						    <div class="col-sm-8">
						     <select class="form-control" id="trans_id" name="trans_id" required>
						      <option value="">Select Transaction</option>
						      </select>
						    </div>
						  </div>



						  <div class="form-group row">
						    <label for="outclick" class="col-sm-4 col-form-label" >{{__('member/multi_lang.reason')}}</label>
						    <div class="col-sm-8">

									<select class="form-control" name="reason">
										@foreach($data['reason'] as $reason)
											<option value="{{$reason->status_name}}">{{ucfirst($reason->status_name)}}</option>
										@endforeach
									</select>
						    </div>
						  </div>



						  <div class="form-group row">
						    <label for="outclick" class="col-sm-4 col-form-label">{{__('member/multi_lang.note')}} </label>
						    <div class="col-sm-8">
						     <textarea name="note" required class="form-control" id="exampleFormControlTextarea1" rows="5" placeholder="Description"></textarea>

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
    $(document).ready(function() {
      $('#merchant').change(function(){
          $.ajax({
            method:'get',
            cache: false,
            url:"{{route('member.createTicket')}}",
            data: {'getTrans':true,'store_id' :$(this).val(), '_token': $('input[name=_token]').val()} ,
            success:function(response){
              $('#trans_id').html(response);
            },

          });
      });
    })
</script>
@endsection
