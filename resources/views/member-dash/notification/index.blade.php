<?php
$getNoticationText = config('');
$type = ( isset($_GET['type'])  ) ? $_GET['type'] : 'all';
$notiCounts = $data['notiCounts'];

?>

@extends('public.layouts.app')
@section('content')
@section('title')
  {{-- !! $data['page_data']->meta_title!! --}}
@endsection

    <?php $breadTitle =__('member/multi_lang.notifications'); ?>
    @include('member-dash/member-partials/title_heading_common')

<div class="main-content py-5">
      <?php
/*
       $alertTemplate = array();
       foreach($data['alerts'] as $alert)
      {
        $alertTemplate[$alert->alert_category][$alert->setting_key]['title'] = $alert->alert_title;
        $alertTemplate[$alert->alert_category][$alert->setting_key]['content'] = $alert->alert_content;
        $alertTemplate[$alert->alert_category][$alert->setting_key]['slug'] = $alert->slug;
      }
      */
      ?>
   <div class="container">


    	<div class="row">
        @include('member-dash.member-partials.sidebar')
      		<div class="col-xl-9 col-lg-9 col-md-8">

            {{-- @if(strip_tags($data['page_data']->top_content) != '') --}}

              <div class="my-msg bg-white p-3 rounded mb-4">
                  {{-- !! $data['page_data']->top_content !! --}}
              </div>
          {{--  @endif --}}
      			<div class="notification-wrapper border rounded">



				<!-- profile-navigator-start -->
					<div class="profile-navigator rounded p-2">
            <div class="row1 p-3 bg-white">
              <h5 class="d-inline-block mt-2">{{__('member/multi_lang.noti_head')}}</h5>
              <button class=" btn btn-primary float-lg-right float-md-none" id="markRead" >{{__('member/multi_lang.mark_btn')}}</button>
          </div>
						<ul class="nav nav-pills border-bottom px-3" id="pills-tab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link p-3 @if($type=='all') active show @endif " id="pills-All-tab" data-toggle="pill" href="#pills-All" role="tab" aria-controls="pills-All" aria-selected="true">{{__('member/multi_lang.all')}} <span id="nAllCount" class="badge badge-pill badge-primary">{{$notiCounts['totalCount']}}</span> </a>
						  </li>
						  <li class="nav-item ">
						    <a class="nav-link p-3 @if($type=='cashback') active show @endif" id="pills-Activity Update-tab" data-toggle="pill" href="#pills-cashback" role="tab" aria-controls="pills-profile" aria-selected="false">{{__('member/multi_lang.cashback')}} <span id="nCBCount" class="badge badge-pill badge-primary">{{-- $notiCounts['cashback'] --}}</span></a>
						  </li>
						  <li class="nav-item ">
						    <a class="nav-link p-3 @if($type=='withdrawals') active show @endif" id="pills-Withdrawal-tab" data-toggle="pill" href="#pills-Withdrawal" role="tab" aria-controls="pills-Withdrawal" aria-selected="false">{{__('member/multi_lang.withdraw')}} <span id="nAllCount" class="badge badge-pill badge-primary">{{-- $notiCounts['withdrawal'] --}}</span> </a>
						  </li>
              <li class="nav-item ">
                <a class="nav-link p-3 @if($type=='bonus') active show @endif" id="pills-Bonus-tab" data-toggle="pill" href="#pills-Bonus" role="tab" aria-controls="pills-Withdrawal" aria-selected="false">{{__('member/multi_lang.bonus')}} <span id="nBonCount" class="badge badge-pill badge-primary">{{-- $notiCounts['bonus'] --s}}</span> </a>
              </li>
						  <li class="nav-item ">
						    <a class="nav-link p-3 @if($type=='referral') active show @endif" id="pills-Referral-tab" data-toggle="pill" href="#pills-Referral" role="tab" aria-controls="pills-Referral" aria-selected="false">{{__('member/multi_lang.referral')}} <span id="nRefCount" class="badge badge-pill badge-primary">{{-- $notiCounts['referral'] --}}</span></a>
						  </li>
              <li class="nav-item ">
                <a class="nav-link p-3 @if($type=='broadcast') active show @endif" id="pills-Broadcast-tab" data-toggle="pill" href="#pills-Broadcast" role="tab" aria-controls="pills-Broadcast" aria-selected="false">{{__('member/multi_lang.broadcast')}} <span id="nBroCount" class="badge badge-pill badge-primary">{{-- $notiCounts['broad'] --}}</span></a>
              </li>
						</ul>
						<div class="tab-content  p-3" id="pills-tabContent">

              <div class="tab-pane fade @if($type=='all') active show @endif border-bottom" id="pills-All" role="tabpanel" aria-labelledby="pills-All-tab">
                <img src="{{asset('uploads/images/loading.gif')}}" class="align-center" alt="">
              </div>

			  <div id="AllNotifyPlaceHolder" style="display:none"></div>


						  <div class="tab-pane fade border-bottom  @if($type=='cashback') active show @endif" id="pills-cashback" role="tabpanel" aria-labelledby="pills-Activity Update-tab">
              {{-- @if(Count($data['notification']['cashback']) > 0) --}}

              {{{-- @foreach($data['notification']['cashback']  as $notiCash) --}}}
              <?php
                  /*
                    $cbChangeTime = $notiCash->change_time;
                      if($notiCash->change_type=='insert')
                       {
                        $cbTitle = $alertTemplate['Cashback']['insert_cashback']['title'];
                        $cbContent = $alertTemplate['Cashback']['insert_cashback']['content'];
                       }
                       else {
                         $cbTitle = $alertTemplate['Cashback']['update_cashback']['title'];
                         $cbContent = $alertTemplate['Cashback']['update_cashback']['content'];
                       }
                       $cbSlug = str_ireplace('#change_id',$notiCash->change_id,$alertTemplate['Cashback']['insert_cashback']['slug']);

                      $notAry = (array) $notiCash;
                      foreach ($notiCash as $key => $value) {
                        // code...
                        $cbTitle = str_ireplace('#'.$key,$value,$cbTitle);
                        $cbContent = str_ireplace('#'.$key,$value,$cbContent);
                      }

                      $cbTitle = str_ireplace('#username',Session::get('memberDetail')->first_name,$cbTitle);
                      $cbContent = str_ireplace('#user_name',Session::get('memberDetail')->first_name,$cbContent);
                      // $cbContent = str_ireplace('#amount',Session::get('memberDetail')->first_name,$cbContent);
                      */
                       ?>
                  <div class="notify-wrap notiUser{--{$notiCash->user_read--}}"  data-userread = "{{--$notiCash->user_read--}}"  id="cb{{--$notiCash->change_id--}}" data-sortby="{{--strtotime($notiCash->change_time)--}}">
                    @include('member-dash.member-partials.notification-partial')
                </div>
                {{-- @endforeach --}}
                  {{-- !! $data['notification']['cashback']->appends(['type' => 'cashback'])->render() !! --}}
                {{-- @else --}}
                  <div class="notify-title">
                    <a href="#"><h6>{{__('member/multi_lang.sorry_found')}}!</h6></a>
                  </div>
                {{--  @endif --}}
						  </div>




						  <div class="tab-pane fade border-bottom @if($type=='withdrawals') active show @endif" id="pills-Withdrawal" role="tabpanel" aria-labelledby="pills-Withdrawal-tab">
            {{-- @if(count($data['notification']['withdraw']) > 0) --}}

          {{--  @foreach($data['notification']['withdraw']  as $notiWithdraw) --}}

                  <?php
/*
                    $cbChangeTime = $notiWithdraw->change_time;
                      if($notiWithdraw->change_type=='insert')
                       {
                        $cbTitle = $alertTemplate['Withdrawals']['insert_withdrawal']['title'];
                        $cbContent = $alertTemplate['Withdrawals']['insert_withdrawal']['content'];
                       }
                       else {
                         $cbTitle = $alertTemplate['Withdrawals']['update_withdrawal']['title'];
                         $cbContent = $alertTemplate['Withdrawals']['update_withdrawal']['content'];
                       }
                       $cbSlug = str_ireplace('#change_id',$notiWithdraw->change_id,$alertTemplate['Withdrawals']['insert_withdrawal']['slug']);

                      $notAry = (array) $notiWithdraw;
                      foreach ($notiWithdraw as $key => $value) {
                        // code...
                        $cbTitle = str_ireplace('#'.$key,$value,$cbTitle);
                        $cbContent = str_ireplace('#'.$key,$value,$cbContent);
                      }

                      $cbTitle = str_ireplace('#username',Session::get('memberDetail')->first_name,$cbTitle);
                      $cbContent = str_ireplace('#username',Session::get('memberDetail')->first_name,$cbContent);
                      // $cbContent = str_ireplace('#amount',Session::get('memberDetail')->first_name,$cbContent);
                      */
                       ?>


                    <div class="notify-wrap notiUser{{--$notiWithdraw->user_read--}}"  data-userread = "{{--$notiWithdraw->user_read--}}"  id="wd{{--$notiWithdraw->change_id--}}" data-sortby="{{--strtotime($notiWithdraw->change_time)--}}">
                         @include('member-dash.member-partials.notification-partial')
                     </div>
              {{--  @endforeach --}}
                  {{--!! $data['notification']['withdraw']->appends(['type' => 'withdrawals'])->render() !! --}}

                    {{-- @else --}}
                      <div class="notify-title">
                        <a href="#"><h6>{{__('member/multi_lang.sorry_found')}}!</h6></a>
                      </div>
                    {{--  @endif --}}
              </div>

              <div class="tab-pane fade border-bottom @if($type=='bonus') active show @endif" id="pills-Bonus" role="tabpanel" aria-labelledby="pills-Withdrawal-tab">
          {{--
    @if(count($data['notification']['bonus']) > 0)
    @foreach($data['notification']['bonus']  as $bonus)

             --}}
                  <?php
  /*                $cbChangeTime = $bonus->change_time;

                        if($bonus->change_type=='insert')
                       {
                        $cbTitle = $alertTemplate['Bonus']['insert_bonus']['title'];
                        $cbContent = $alertTemplate['Bonus']['insert_bonus']['content'];
                       }
                       else {
                         $cbTitle = $alertTemplate['Bonus']['update_bonus']['title'];
                         $cbContent = $alertTemplate['Bonus']['update_bonus']['content'];
                       }
                       $cbSlug = str_ireplace('#change_id',$bonus->change_id,$alertTemplate['Bonus']['insert_bonus']['slug']);

                      $notAry = (array) $bonus;
                      foreach ($bonus as $key => $value) {
                        // code...
                        $cbTitle = str_ireplace('#'.$key,$value,$cbTitle);
                        $cbContent = str_ireplace('#'.$key,$value,$cbContent);
                      }

                      $cbTitle = str_ireplace('#username',Session::get('memberDetail')->first_name,$cbTitle);
                      $cbContent = str_ireplace('#username',Session::get('memberDetail')->first_name,$cbContent);
                      // $cbContent = str_ireplace('#amount',Session::get('memberDetail')->first_name,$cbContent);
*/
                       ?>


                       <div class="notify-wrap notiUser{{--$bonus->user_read --}}"  data-userread = "{{--$bonus->user_read--}}" id="bonus{{--$bonus->change_id--}}" data-sortby="{{-- strtotime($bonus->change_time)--}}">
                            @include('member-dash.member-partials.notification-partial')
                        </div>
  {{--               @endforeach --}}
      {{-- !! $data['notification']['bonus']->appends(['type' => 'bonus'])->render() !! --}}

                {{--   @else --}}
                    <div class="notify-title">
                      <a href="#"><h6>{{__('member/multi_lang.sorry_found')}}!</h6></a>
                    </div>
                 {{--   @endif --}}
              </div>

						  <div class="tab-pane fade border-bottom @if($type=='referral') active show @endif" id="pills-Referral" role="tabpanel" aria-labelledby="pills-Referral-tab">
          {{--      @if(count($data['notification']['referal']) > 0)

              @foreach($data['notification']['referal']  as $refer)
  --}}     <?php
            /*
                  $cbChangeTime = $refer->change_time;

                      if($refer->change_type=='insert')
                       {
                        $cbTitle = $alertTemplate['Referral']['insert_referral']['title'];
                        $cbContent = $alertTemplate['Referral']['insert_referral']['content'];
                       }
                       else {
                         $cbTitle = $alertTemplate['Referral']['update_referral']['title'];
                         $cbContent = $alertTemplate['Referral']['update_referral']['content'];
                       }
                       $cbSlug = str_ireplace('#change_id',$refer->change_id,$alertTemplate['Referral']['insert_referral']['slug']);

                      $notAry = (array) $refer;
                      foreach ($refer as $key => $value) {
                        // code...
                        $cbTitle = str_ireplace('#'.$key,$value,$cbTitle);
                        $cbContent = str_ireplace('#'.$key,$value,$cbContent);
                      }

                      $cbTitle = str_ireplace('#username',Session::get('memberDetail')->first_name,$cbTitle);
                      $cbContent = str_ireplace('#username',Session::get('memberDetail')->first_name,$cbContent);
                      // $cbContent = str_ireplace('#amount',Session::get('memberDetail')->first_name,$cbContent);
                        */
                       ?>


                       <div class="notify-wrap notiUser{{--$refer->user_read--}}"  data-userread = "{{--$refer->user_read--}}" id="refer{{--$refer->change_id--}}" data-sortby="{{--strtotime($refer->change_time)--}}">
                            @include('member-dash.member-partials.notification-partial')
                        </div>
                {{-- @endforeach --}}
                  {{-- !! $data['notification']['referal']->appends(['type' => 'referral'])->render() !!--}}

                       {{-- @else --}}
                        <div class="notify-title">
                          <a href="#"><h6>{{__('member/multi_lang.sorry_found')}}!</h6></a>
                        </div>
{{-- @endif --}}

						  </div>


              <div class="tab-pane fade border-bottom @if($type=='broadcast') active show @endif" id="pills-Broadcast" role="tabpanel" aria-labelledby="pills-Referral-tab">

            {{--
              @if(count($data['notification']['broadcast']) > 0)

                @foreach($data['notification']['broadcast']  as $broadcast)
              --}}
                  <?php
                  /*
                    $cbChangeTime = $broadcast->date_added;

                        //$cbSlug = str_ireplace('#change_id',$refer->change_id,$alertTemplate['Referral']['insert_referral']['slug']);
                      //
                      // $notAry = (array) $refer;
                      // foreach ($refer as $key => $value) {
                      //   // code...
                         $cbTitle = $broadcast->title;
                         $cbContent = $broadcast->message;
                         $cbSlug    = url('/goBroadcast/'.$broadcast->broadcast_id);
                      // }

                      // $cbTitle = str_ireplace('#username',Session::get('memberDetail')->first_name,$cbTitle);
                      // $cbContent = str_ireplace('#username',Session::get('memberDetail')->first_name,$cbContent);
                      // // $cbContent = str_ireplace('#amount',Session::get('memberDetail')->first_name,$cbContent);
                      */
                       ?>


                       <div class="notify-wrap notiUser {{-- $broadcast->user_read --}}"  data-userread = "{{--$broadcast->user_read--}}" id="brod {{--$broadcast->broadcast_id--}} {{--$broadcast->user_id--}}" data-sortby="{{--strtotime($broadcast->date_added) --}}">
                            @include('member-dash.member-partials.notification-partial')
                        </div>
              {{--  @endforeach --}}
                  {{-- !! $data['notification']['broadcast']->appends(['type' => 'broadcast'])->render() !! --}}

                  {{--  @else --}}
                      <div class="notify-title">
                        <a href="#"><h6>{{__('member/multi_lang.sorry_found')}}!</h6></a>
                      </div>
              {{--  @endif --}}
              </div>

						  <div class="tab-pane fade border-bottom" id="pills-m-read" role="tabpanel" aria-labelledby="pills-m-read-tab">
						  </div>
						</div>
					</div>
				    <!-- profile-navigator-end -->
				</div>
			</div>

{{--  @if(strip_tags($data['page_data']->bottom_content) != '')
     --}}         <div class="my-msg bg-white p-3 rounded mb-4">


    {{--   !! $data['page_data']->bottom_content !! --}}
        </div>
    {{-- @endif --}}  

		</div>
	</div>
</div>

<script type="text/javascript">
    $(document).ready(function() {


	function getSorted(selector, attrName,ord) {
    return jQuery(jQuery(selector).toArray().sort(function(a, b){
        var aVal = parseInt(a.getAttribute(attrName)),
            bVal = parseInt(b.getAttribute(attrName));
		if(ord==2)
        return bVal - aVal;
		else
		return  aVal - bVal;
    }));
	}




		var allNotiyHTML = ''; var allNotiyTXT = '';

		var NotiType = new Array('#pills-cashback','#pills-Withdrawal','#pills-Bonus','#pills-Referral','#pills-Broadcast');

	NotiType.forEach(function (item) {
	$(item+ ' .notify-wrap').each( function () {

		var Noti = $(this);
		if(Noti.data('userread')=='N' )
			allNotiyTXT  = allNotiyTXT + Noti[0].outerHTML;

	});
	});
	$('#AllNotifyPlaceHolder').hide();
	$('#AllNotifyPlaceHolder').html(allNotiyTXT);

	allNotiyHTML = getSorted('#AllNotifyPlaceHolder .notify-wrap','sortby',1);
	$('#pills-All').empty();
	$('#AllNotifyPlaceHolder').empty();
	$('#pills-All').html(allNotiyHTML);
  <?php if($type=='all') :?>
	$('#pills-All').show();
<?php endif;?>

  $('#markRead').click( function(){
    if( confirm("{{trans('actionMsg.notification_confirm')}}") )
    {
      $.ajax({
        type: 'post',
        url: "{{url('markNotifyRead')}}",
        data: { '_token': $('input[name=_token]').val()},
        success: function (data) {
              toastr.success(data.msg, 'Success');
        }
      });
    }
  });

    });
</script>
<script type="text/javascript">
function deleteFav(delID)
  {
    $.ajax({
      method:'post',
      cache: false,
      url: "{{url('/deleteFav')}}",
      data: {'delID':delID,'_token': $('input[name=_token]').val()} ,
      success:function(response){
      },
        complete:function(response) {
      }
    }).done(function(data)
      {
        $('#fav'+delID).remove();
      });
  }

</script>
@endsection
