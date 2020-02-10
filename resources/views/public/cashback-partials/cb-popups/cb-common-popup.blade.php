
<!-- CB Modal -->
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content shadow-lg">
      <div class="cb-modal-header p-3 text-center">
        <button type="button" class="modal-close close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-title" id="exampleModalCenterTitle">
          @if(!Auth::guard('member')->check())
            <h5 class="font-15 success-text fw-400">{!! __('public/cb-popup.cb_missing_title') !!}</h5>
            <h2 class="font-30 success-text fw-400 my-4"> {!! __('public/cb-popup.cb_join_string',['cb_string' => $data['cashBackText']]) !!}</h2>
            <div class="cb-modal-btn pb-2">
              <button type="button"   class="btn btn-primary fw-700 mr-0 mr-lg-2 mb-3 mb-lg-0" data-toggle="modal" data-dismiss="modal" data-target="#join-us-modal">{{__('public/cb-popup.join_to_active_btn')}}</button>
              <button type="button" class="btn btn-outline-dark fw-700" data-toggle="modal" data-target="#login-modal" data-dismiss="modal">{{__('public/cb-popup.existing_user_sign_btn')}}</button>
            </div>
            @else
            <div class="modal-title" id="exampleModalCenterTitle">
              <h5 class="font-15 success-text fw-400">{!! __('public/cb-popup.congrats_txt') !!}!</h5>
              <h2 class="font-30 success-text fw-400 mt-4">{!! __('public/cb-popup.eligible_txt',['cb_string' => $data['cashBackText'],'company_name' => config('sximo.cnf_appname')]) !!}</h2>
            </div>
          @endif
        </div>

      </div>
      <div class="modal-body text-center">
        <div class="cb-modal-store div-inner-white shadow d-inline-block mx-auto p-2 rounded border my-3">
          <img src="{{$data['storelogo']}}" alt="">
        </div>
        <h4 class="text-dark font-20 fw-400 mb-4">{{$data['title']}}</h4>
        @if($data['pop_type'] == 'coupon')
          @if($data['couponType'] == 'coupon')
          <div class="get-cpn p-2 copy-code-wrapp clearfix mb-3">
            <div class="cod-wrapp float-left">
              <input class="font-30 primary-text fw-700 mb-0 code"  id="cpnCode" value="{{$data['couponCode']}}" />
            </div>
            <div class="float-right">
              <a class="btn btn-dark fw-700 modal-copy" >{{__('public/cb-popup.copy_btn')}}</a>
            </div>
          </div>
          @endif
        @endif
        <div class="mb-3">
          <div id="popup-summary">
              <p class="collapse font-15 fw-300 secondary-text text-left" id="collapsePSummary">
                  {{$data['desc']}}
              </p>
              <a class="collapsed" data-toggle="collapse" href="#collapsePSummary" aria-expanded="false" aria-controls="collapsePSummary"></a>
            </div>
        </div>
        <div class="mb-3">
          @if(!Auth::guard('member')->check())
            <a href="{{$data['outlink']}}" target="_blank">
              <button type="button" class="btn btn-light font-15 fw-700 p-3">{{__('public/cb-popup.continue_loss_btn')}} </button>
            </a>
          @else
            <a href="{{$data['outlink']}}" id="outlinklogin" target="_blank">
              <button type="button" class="btn btn-light font-15 fw-700 p-3">{{__('public/cb-popup.visit_merchant_btn')}} </button>
            </a>
          @endif
        </div>
          <!-- <ul class="list-unstyled d-inline-block m-auto">
            <li class="pop social-share font-15 primary-text py-3 px-2" data-toggle="popover" data-placement="bottom" data-content='
                <ul class="list-inline pop-social-icons mb-0">
                  <a href="#"><li class="list-inline-item"><i class="fab fa-google-plus-g"></i></li></a>
                  <a href="#"><li class="list-inline-item"><i class="fab fa-facebook-f"></i></li></a>
                  <a href="#"><li class="list-inline-item"><i class="fab fa-twitter"></i></li></a>
                </ul>
            '>
              <span class="icon-Share1-icon v-tp font-18 mr-1"></span> <span class="cpn-icon-lable">{{__('public/cb-popup.share_btn')}} </span>
            </li>
          </ul> -->
        @if(Auth::guard('member')->check())
        @php
          if(strip_tags($data['todo']) != null) {
            $termsTodo    = explode(PHP_EOL,$data['todo']);
          }
          else {
            $termsTodo    = explode(PHP_EOL, config('settingConfig.cb_terms_todo') );
          }
          if(strip_tags($data['tonotdo']) != null) {
            $termsTonotdo = explode(PHP_EOL,$data['tonotdo'] );
          }
          else {
            $termsTonotdo = explode(PHP_EOL,config('settingConfig.cb_terms_nottodo'));
          }
        @endphp
          <div class="earn-cb-list text-left">
            <ul class="">
              <h2 class="font-20 fw-400 text-dark">To earn cashback</h2>
              @foreach($termsTodo as $todo)

                <li class="font-15 fw-300 secondary-text">{!!$todo!!}</li>
              @endforeach
              @foreach($termsTonotdo as $tonotdo)
                <li class="font-15 fw-300 secondary-text">{!!$tonotdo!!}</li>
              @endforeach
            </ul>
          </div>
          @endif
      </div>
    </div>
  </div>
  <?php /*
  <script type="text/javascript">
	
        <?php if(Auth::guard('member')->check())  {?>
                window.open('<?php echo $data['outlink'] ?> ', '_blank');
        <?php  } ?>

        $(".pop").popover({ trigger: "manual" , html: true, animation:false})
            .on("mouseenter", function () {
                var _this = this;
                $(this).popover("show");
                $(".popover").on("mouseleave", function () {
                    $(_this).popover('hide');
                });
            }).on("mouseleave", function () {
                var _this = this;
                setTimeout(function () {
                    if (!$(".popover:hover").length) {
                        $(_this).popover("hide");
                    }
                }, 300);
        });
  </script>
	*/ ?>