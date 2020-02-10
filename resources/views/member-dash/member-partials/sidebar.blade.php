
<div class="col-xl-3 col-lg-3 col-md-4">
  <div class="main-content mb-4">
    <div class="list-group border-0 card">
      <a href="{{url('member/overview')}}" class="list-group-item d-inline-block collapsed buttonn " data-parent="#sidebar"><i class="fa fa-list-alt pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.overview')}}</span></a>
      <a href="{{url('member/my-deals')}}" class="list-group-item d-inline-block collapsed buttonn " data-parent="#sidebar"><i class="fa fa-tags pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('public/common.menu.my-deals')}}</span></a>
      <a href="{{url('member/cashback-activities')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-file-text pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.cashback_activities')}}</span></a>
      <a href="{{url('member/payout')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-money pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.cashback_payout')}}</span></a>
      <a href="{{url('member/passbook')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-th-list pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.transaction_passbook')}}</span></a>
      <a @if(Route::getCurrentRoute()->getName() == 'member.createClaim' ||
              Route::getCurrentRoute()->getName() == 'view.missingCashback' ) ||)
          class="list-group-item d-inline-block collapsed active" @else   class="list-group-item d-inline-block collapsed " @endif href="{{url('member/missing-cashback-claim')}}"  data-parent="#sidebar"><i class="fa fa-ticket pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.missing_cashback')}}</span></a>
      <a href="{{url('member/refer-and-earn')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-users pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.refer_earn')}}</span></a>
      <a href="{{url('member/faq')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-question-circle-o pr-3 text-dark" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.faqs')}}</span></a>
      <a href="{{url('member/contact-us')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-phone-square pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.contact_Us')}}</span></a>
      <a href="{{url('member/notifications')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-bell pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.all_notifications')}}</span></a>
      <a href="{{url('member/favourites')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-bookmark pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.favourites')}}</span></a>
			<a href="{{url('member/my-favourite-deals')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-bookmark pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.my_fav_deals')}}</span></a>
			<!-- <a href="{{url('member/my-deals')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-bookmark pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.my_deals')}}</span></a> -->
      <a href="{{url('member/profile-settings')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-cog pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.profile_setting')}}</span></a>
    </div>
  </div>

              {{-- @if(strip_tags($data['page_data']->widget_title1 != '') && strip_tags($data['page_data']->widget1 != '') ) --}}

                  <div class="our-benifits-cont bg-white rounded">
                    <h6 class="px-4 py-2 border-bottom" style="color: #dc3545;">{{--!! $data['page_data']->widget_title1!!--}}</h6>
                      {{--!! $data['page_data']->widget1 !!--}}
                  </div>
              {{--    @endif --}}

                  {{--   @if(strip_tags($data['page_data']->widget_title2 != '') && strip_tags($data['page_data']->widget2 != '') ) --}}
                  <div class="our-benifits-cont bg-white rounded">
                    <h6 class="px-4 py-2 border-bottom" style="color: #dc3545;">{{--!! $data['page_data']->widget_title2!! --}}</h6>
                      {{--!! $data['page_data']->widget2 !!--}}
                  </div>
              {{-- @endif--}}
            {{--    @if(strip_tags($data['page_data']->widget_title3 != '') && strip_tags($data['page_data']->widget3 != '') ) --}}
                  <div class="our-benifits-cont bg-white rounded">
                    <h6 class="px-4 py-2 border-bottom" style="color: #dc3545;">{{--!! $data['page_data']->widget_title3!! <!--  -->}}</h6>
                      {{-- !! $data['page_data']->widget3 !!--}}
                  </div>
              {{-- @endif--}}

          </div>


              <div class="modal fade bd-example-modal-sm" id="verifyNumber" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                 <div class="modal-content">
                   <div class="modal-header">
                     <h5 class="modal-title" id="exampleModalLongTitle">{{__('member/multi_lang.Verify_mobile_no')}}</h5>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                     </button>
                   </div>
                   <div class="modal-body">
                     <div id="divVerify">
                      <form  id="OTP">
                          <label>{{__('member/multi_lang.enter_Mobile')}}</label>
                              <input type="number" class="form-control" name="mobile_no" >
                              <input type="hidden" name="mem_key" value="{{encrypt(Auth::guard('member')->id())}}" >
                              <input type="submit" class="text-center btn btn-success btn-md" value="Verify">
                      </form>
                    </div>
                    <div id="divGetOtp" >
                      <form  id="VERIFYOTP">
                         <label>{{__('member/multi_lang.Enter_otp')}}</label>
                             <input type="number" class="form-control" name="otp" >
                             <input type="hidden" name="mem_key" value="{{encrypt(Auth::guard('member')->id())}}" >
                             <input type="submit" class="text-center btn btn-success btn-md" value="Verify">
                      </form>
                      <a href="#" onclick="resendOTP()" style="font-size:12px; color:blue">{{__('member/multi_lang.click_here_otp')}}</a>
                    </div>
                   </div>
                 </div>
               </div>
             </div>

<script type="text/javascript" src="{{asset('public_assets/js/member.js')}}"></script>
<script type="text/javascript">
$(function(){
    var current = location.pathname;
    $('.list-group  a').each(function(){
        var $this = $(this);
        // if the current path is like this link, make it active
        if($this.attr('href').indexOf(current) !== -1){
            $this.addClass('active');
        }
    })
  });
$(document).ready(function() {
  $('#divGetOtp').hide();
  $('#OTP').on('submit', function (e) {

    e.preventDefault();
    $.ajax({
      type: 'post',
      url: "{{route('send.otp')}}",
      data: $(this).serialize(),
      success: function (data) {

          if(data.success) {
            toastr.success(data.msg, 'Success');
            $('#divVerify').hide();
            $('#divGetOtp').show();
          }
          else {
            toastr.error(data.msg, 'Error');
          }

      }
    });
  });

  $('#VERIFYOTP').on('submit', function (e) {
    e.preventDefault();
    $.ajax({
      type: 'post',
      url: "{{route('verfiy.otp')}}",
      data: $(this).serialize(),
      success: function (data) {
          if(data.success) {
            toastr.success(data.msg, 'Success');
            $('#mobileVer').hide('hidden');
            $('#verifyNumber').modal('hide');
          }
          else {
            toastr.error(data.msg, 'Error');
          }

      }
    });
  });

});

function resendOTP() {
  var memID = "{{encrypt(Auth::guard('member')->id())}}";
  $.ajax({
    type: 'post',
    url: "{{route('resend.otp')}}",
    data: {'mem_key' : memID},
    success: function (data) {
        if(data.success) {
          toastr.success(data.msg, 'Success');
        }
        else {
          toastr.error(data.msg, 'Error');
        }

    }
  });
}
</script>
