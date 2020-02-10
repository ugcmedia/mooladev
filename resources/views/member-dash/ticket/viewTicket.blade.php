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
								<p style="color:red">  {{__('member/multi_lang.verify_Mail')}}
									 <a href="{{route('resendMail')}}">
											{{__('member/multi_lang.click_here')}}
										</a>
									</p>
						</div>
					</div>
				@else
      		<div class="col-xl-9 col-lg-9 col-md-8">

            <div class="note-title border-bottom">
              <h6 class="font-weight-bold p-2">{!! $data['page_data']->heading !!}</h6>
            </div>
            @if(strip_tags($data['page_data']->top_content) != '')
              <div class="my-msg bg-white p-3 rounded mb-4">
                  {!! $data['page_data']->top_content !!}
              </div>
            @endif
			<div class="view-cb-claim-wrapper border rounded p-4">
				<h4 class="text-uppercase font-weight-bold my-2">{{__('member/multi_lang.view_your_ticket')}}</h4>
				<div class="claim-details">

					<ul class="list-unstyled text-capitalize">
						<li class="border-top border-bottom p-3">
							<div class="row">
								<div class="col-lg-3 col-md-4">
									<span class="text-muted"><strong>{{__('member/multi_lang.created')}}:</strong></span>
								</div>
								<div class="col-lg-9 col-md-8">
								<span class="text-muted"> {{date(config('sximo.cnf_date'),strtotime($ticket->raised_date))}}</span>
								</div>
							</div>
						</li>
						@if($ticket->status == 'close')
						<li class="border-bottom p-3">
							<div class="row">
								<div class="col-lg-3 col-md-4">
									<span class="text-muted"><strong>{{__('member/multi_lang.closed_by')}}:</strong></span>
								</div>
								<div class="col-lg-9 col-md-8">
									<span class="text-muted">{{$ticket->closed_by}}</span>
								</div>
							</div>
						</li>
						<li class="border-bottom p-3">
							<div class="row">
								<div class="col-lg-3 col-md-4">
									<span class="text-muted"><strong>{{__('member/multi_lang.closed_date')}}:</strong></span>
								</div>
								<div class="col-lg-9 col-md-8">
								<span class="text-muted">{{date(config('sximo.cnf_date'),strtotime($ticket->closed_date))}}</span>
								</div>
							</div>
						</li>
						@endif
						<li class="border-bottom p-3">
							<div class="row">
								<div class="col-lg-3 col-md-4">
									<span class="text-muted"><strong>{{__('member/multi_lang.ticket_status')}}:</strong></span>
								</div>
								<div class="col-lg-9 col-md-8">
									<span class="text-muted">{{ucfirst($ticket->status)}}</span>
								</div>
							</div>
						</li>
						<li class="border-bottom p-3">
							<div class="row">
								<div class="col-lg-3 col-md-4">
									<span class="text-muted"><strong>{{__('member/multi_lang.merchant')}}:</strong></span>
								</div>
								<div class="col-lg-9 col-md-8">
									<span class="text-muted">{{$ticket->store_name}}</span>
								</div>
							</div>
						</li>
						<li class="border-bottom p-3">
							<div class="row">
								<div class="col-lg-3 col-md-4">
									<span class="text-muted"><strong>{{__('member/multi_lang.order_date')}}:</strong></span>
								</div>
								<div class="col-lg-9 col-md-8">
							<span class="text-muted">{{date(config('sximo.cnf_date'),strtotime($ticket->transaction_time))}}</span>
								</div>
							</div>
						</li>

						<li class="border-bottom p-3">
							<div class="row">
								<div class="col-lg-3 col-md-4">
									<span class="text-muted"><strong>{{__('member/multi_lang.transaction_amount')}}:</strong></span>
								</div>
								<div class="col-lg-9 col-md-8">
									<span class="text-muted">{{$ticket->transaction_amount}}</span>
								</div>
							</div>
						</li>


            @if($ticket->status != 'close')
              <form action="{{route('member.close_ticket').'/'.$ticket->ticket_id}}"  onsubmit="return confirm('Do you really want to close ticket?');"  method="post">
    						<li class="text-center mt-3">
    							<button type="submit" class="btn btn-primary rounded">{{__('member/multi_lang.close_this_ticket')}}</button>
    						</li>
              </form>
              @else
              <form action="{{route('member.reopen_ticket').'/'.$ticket->ticket_id}}"  onsubmit="return confirm('Do you really want to reopen ticket?');" method="post">
                <li class="text-center mt-3">
                  <button type="submit" class="btn btn-primary rounded">{{__('member/multi_lang.reopen_ticket_btn')}}</button>
                </li>
              </form>
            @endif
					</ul>

					<div class="claim-messages">
						<p class="text-muted"><strong>{{__('member/multi_lang.msg_claim')}}</strong></p>
	      @if(Count($comments) > 0 )
            <div class="message-title bg-light p-2">
							<div class="row">
								<div class="col-6 col-lg-3 col-md-4">
									<span class="text-muted font-weight-bold">{{__('member/multi_lang.created')}}</span>
								</div>
								<div class="col-6 col-lg-9 col-md-8">
									<span class="text-muted font-weight-bold">{{__('member/multi_lang.comment')}}</span>
								</div>
							</div>
						</div>
						<ul class="list-unstyled text-capitalize">

							 @foreach($comments as $comment)
								<li class="border-bottom p-3">
									<div class="row">
										<div class="col-6 col-lg-3 col-md-4">
											<p class="msg-date text-muted">{{\Carbon\Carbon::createFromFormat("Y-m-d H:i:s", $comment->comment_time)->diffForHumans() }}</p>
											<p class="font-weight-bold">@if($comment->added_by == 'admin') {{config('sximo.cnf_appname')}} Support @else You @endif</p>
										</div>
										<div class="col-6 col-lg-9 col-md-8">
											<div class="comment">
												<span>{!!$comment->comment !!}</span>
											</div>
										</div>
									</div>
								</li>
								@endforeach
                @else
                 {{__('member/multi_lang.no_comments_found')}}
							@endif
						</ul>
						@if($ticket->status != 'close')
						<div class="claim-comment-box mt-5">
							<form action="{{route('member.store.ticketComment')}}" method="post">
								<textarea class="form-control"  name="comment" placeholder="Write your message here"></textarea>
								<input name="ticket_id" value="{{$ticket->ticket_id}}" type="hidden" >

								<div class="text-right mt-4">
									<button type="submit" class="btn btn-primary rounded">{{__('member/multi_lang.post_message_btn')}}</button>
								</div>
							</form>
						</div>
						@endif
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
