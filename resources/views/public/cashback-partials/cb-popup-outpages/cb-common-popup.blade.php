
<!-- CB Modal -->
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content shadow-lg">
      <div class="cb-modal-header p-3 text-center">
        <button type="button" class="modal-close close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <div class="modal-title" id="exampleModalCenterTitle">
          @if(!Auth::guard('member')->check())
			@if($data['cashback_enabled']=='Y')  
            <h5 class="font-15 success-text fw-400">{!! __('public/cb-popup.cb_missing_title') !!}</h5>
			@endif
            <h2 class="font-30 success-text fw-400 my-4"> @if($data['cashback_enabled']=='Y') {!! __('public/cb-popup.cb_join_string',['cb_string' => $data['cashBackText']]) !!} @else {!! __('public/cb-popup.no_cb_join_string') !!} @endif </h2>
            <div class="cb-modal-btn pb-2">
              <button type="button"   class="btn btn-primary fw-700 mr-0 mr-lg-2 mb-3 mb-lg-0" data-toggle="modal" data-dismiss="modal" data-target="#join-us-modal">@if($data['cashback_enabled']=='Y') {{__('public/cb-popup.join_to_active_btn')}} @else {{__('public/cb-popup.join_no_cashback')}} @endif</button>
              <button type="button" class="btn btn-outline-dark fw-700" data-toggle="modal" data-target="#login-modal" data-dismiss="modal">{{__('public/cb-popup.existing_user_sign_btn')}}</button>
            </div>
            @else
            <div class="modal-title" id="exampleModalCenterTitle">
              <h5 class="font-15 success-text fw-400">{!! __('public/cb-popup.congrats_txt') !!}!</h5>
			  @if($data['cashback_enabled']=='Y')
              <h2 class="font-30 success-text fw-400 mt-4">{!! __('public/cb-popup.eligible_txt',['cb_string' => $data['cashBackText'],'company_name' => config('sximo.cnf_appname')]) !!}</h2>
				@else
			  <h2 class="font-30 success-text fw-400 mt-4">{!! __('public/cb-popup.outpage_congras_nocb_txt',['store_name' => $data['storeName']]) !!}</h2>
			@endif
            </div>
          @endif
        </div>

      </div>
      <div class="modal-body text-center">
        <div class="cb-modal-store div-inner-white shadow d-inline-block mx-auto p-2 rounded border my-3">
          <img src="{{$data['storelogo']}}" alt="">
        </div>
        @if($data['pop_type'] != 'deal')
        <h4 class="text-dark font-20 fw-400 mb-4">{{$data['title']}}</h4>
        @if($data['pop_type'] == 'coupon')
          @if($data['couponType'] == 'coupon')
          <div class="get-cpn p-2 copy-code-wrapp clearfix mb-3">
            <!--  <div class="bg-white border rounded p-2">
              <div class="row">
                <div class="col-md-8">
                  <input type="text" class="form-control h-100 w-100 border-0" name="" value="">
                </div>
                <div class="col-md-4">
                  <button type="button" class="btn btn-primary shadow-sm" name="button"></button>
                </div>

              </div>

            </div> -->

            <div class="cod-wrapp float-left">
              <!-- <h2 class="font-30 primary-text fw-700 mb-0 " id="cpnCode">{{$data['couponCode']}}</h2> -->
			           <input class="font-30 primary-text fw-700 mb-0 code"  id="cpn_Code" value="{{$data['couponCode']}}" readonly />
            </div>
            <div class="float-right">
              <button class="btn btn-dark fw-700 modal-copy">{{__('public/cb-popup.copy_btn')}}</button>
            </div>
          </div>
          @endif
        @endif
        <div class="mb-3">
          @if(strip_tags($data['desc']) != '' && strip_tags($data['desc']) != null )
            <div id="popup-summary">
              <p class="collapse font-15 fw-300 secondary-text text-left" id="collapsePSummary">
                  {{$data['desc']}}
              </p>
              <a class="collapsed" data-toggle="collapse" href="#collapsePSummary" aria-expanded="false" aria-controls="collapsePSummary"></a>
            </div>
          @endif
        </div>
        <div class="mb-3">
          @if(!Auth::guard('member')->check() && $data['cashback_enabled']=='Y')
            <a href="{{$data['outlink']}}" target="_blank">
              <button type="button" class="btn btn-light font-15 fw-700 p-3">{{__('public/cb-popup.continue_loss_btn')}} </button>
            </a>
          @else
            <a href="{{$data['outlink']}}" id="outlinklogin" target="_blank">
              <button type="button" class="btn btn-primary   font-15 fw-700 ">{{__('public/cb-popup.visit_merchant_btn')}} </button>
            </a>
          @endif
        </div>
        @else
          <div class="my-3">
            <div class="row">
            <div class="col-sm-4">
              <div class="dd-product mb-4 d-flex">
                    <img src="{{asset('uploads/images/products').'/'.$data['product_image']}}" alt="">
                  </div>
            </div>
            <div class="col-sm-8 d-flex flex-column justify-content-center align-items-center align-items-sm-start">
              <div class="product-discr">
                  <p class="font-15 fw-400 text-dark">
                  {{$data['title']}}
                  </p>
                </div>
                <div class="product-prices mb-3 d-flex align-items-center justify-content-center flex-wrap">
                  <span class="new-price font-20 fw-700 mr-2"><i class="fas fa-rupee-sign"></i> {{$data['deal_price']}}</span>
                  <span class="old-price secondary-text font-15"><i class="fas fa-rupee-sign"></i> <del>{{$data['mrp']}}</del></span>
                </div>
                @if(!Auth::guard('member')->check() && $data['cashback_enabled']=='Y')
                  <a href="{{$data['outlink']}}" target="_blank">
                    <button type="button" class="btn btn-light font-15 fw-700 p-3">{{__('public/cb-popup.continue_loss_btn')}} </button>
                  </a>
                @else
                  <a href="{{$data['outlink']}}" id="outlinklogin" target="_blank">
                    <button type="button" class="btn btn-primary   font-15 fw-700 ">{{__('public/cb-popup.visit_merchant_btn')}} </button>
                  </a>
                @endif
             </div>
            </div>
          </div>
        @endif

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
              <input type="checkbox" class="read-more-state" id="post-2" />
              <h2 class="font-20 fw-400 text-dark ">To earn cashback</h2>
              <ul class="read-more-wrap">
              @php $i = 0; @endphp
              @foreach($termsTodo as $todo)
                <li class="font-15 fw-300 secondary-text @if($i != 1) read-more-target @endif">{!!$todo!!}</li>
                @php $i++;  @endphp
              @endforeach
              @php $j = 0; @endphp
              @foreach($termsTonotdo as $tonotdo)
                <li class="font-15 fw-300 secondary-text @if($j != 1) read-more-target @endif">{!!$tonotdo!!}</li>
                @php $j++; @endphp
              @endforeach
            </ul>
            <label for="post-2" class="read-more-trigger primary-text "></label>

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
 */
 ?>