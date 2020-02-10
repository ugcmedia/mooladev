<div  id="cpn{{$coupon->coupon_id}}" data-tabtype="{{$data['type']}}" class="store-card-wrap div-inner-white rounded mb-3" data-couponid="{{$coupon->coupon_id}}" >
   <div class="store-card-top p-3">
    <div class="row">
     <div class="col-lg-2 col-3">
      <div class="store-cb-title p-2 text-center d-flex flex-column align-items-center">
        <p class="discount font-24 fw-800 mb-0 primary-text">{{$coupon->promo_text}}</p>
        <p class="discount-type font-18 fw-400 primary-text text-uppercase mb-0">
          @if($coupon->cashback != '' && $coupon->cashback != null)
            {{__('public/common.cashback_txt')}}
          @endif
        </p>
        @if($data['cat_page'])
          <img src="{{asset('uploads/images/store/').'/'.$coupon->store_logo}}" class="img-fluid" alt="">
        @endif
      </div>
      <div class="store-cb-lable primary-bg font-12 success-text text-center p-1 rounded">
        @if($coupon->coupon_type == 'coupon')

          {{__('public/common.coupon_txt')}}

        @else

          {{__('public/common.offer_txt')}}
        @endif
      </div>
    </div>
    <div class="col-lg-10 col-9">
      <div class="title-meta">
        <ul class="list-inline mb-1">
          <li class="list-inline-item secondary-text-light font-14 fw-400">
            <span class="icon-User2-icon font-14 v-top"></span>
             {{__('public/common.coupon_uses_today',['uses' => $coupon->daily_clicks])}}
           </li>
          <li class="list-inline-item">
            <span class="badge badge-danger font-14 fw-400"> {{$coupon->sale_text}} </span>
          </li>
        </ul>
      </div>

      <div class="st-offer-disc-wrap mb-2">
        <div class="st-offer-title d-flex flex-wrap">
          <h4 class="font-24 text-dark fw-400">{{$coupon->title}}</h4>
        </div>
        @php
        $cashbackstr = "";
        if($coupon->cashback_enabled == 'Y') {
          if(!empty($coupon->cashback)) {
                $cashbackstr     = AppClass::getUptoText($coupon->cashback,$coupon->cashback_type);
          } else {
            if(!empty(AppClass::getUptoText($coupon->storeCashback,$coupon->cashback_type))) {
                  $cashbackstr     = AppClass::getUptoText($coupon->storeCashback,$coupon->cashback_type);
            }
          }
        }
        @endphp
        @if($coupon->cashback_enabled == 'Y')
          @if(!empty($cashbackstr))
          <span class="s-cpn-cb font-20 primary-text fw-700 mr-2 d-inline-block">
            <span class="font-20 fw-700 icon-percentage2-icon v-middle mr-2"></span>
                {{__('public/common.coupon_cashback_str',['cashbackStr' => $cashbackstr,'appName' =>config('sximo.cnf_appname') ])}}
          </span>
		        <a href="#"  rel="HiwCpnPop" data-popover-content="#HIWpopOver" class="pop font-12 primary-text fw-600 d-none d-lg-inline-block">({{__('public/common.what_this_txt')}})</a>
          @endif
         @endif
          <div id="summary">
            <p class="collapse font-15 fw-300 secondary-text" id="collapseSummary{{$coupon->coupon_id}}">
                 {!! $coupon->description!!}
            </p>
            <a class="collapsed" data-toggle="collapse" href="#collapseSummary{{$coupon->coupon_id}}" aria-expanded="false" aria-controls="collapseSummary"></a>
          </div>
      </div>
      <div class="get-cpn-right float-right">
        <div class="mb-2">
          <span class="font-12 secondary-text-light"><span class="icon-Right-icon mr-1"></span> {{__('public/common.verified_ago',['ago' => $verifiedAgo])}} </span>
        </div>
          @if($coupon->coupon_type == 'coupon')
           <div class="get-cpn p-2">
            <div class="c-offer__cta-container">
              <a href="javascript:void(0)"  onclick="openAjaxPopup({{$coupon->coupon_id}},'coupon','{{$coupon->cashback_enabled}}')" class="c-code-cta-wrap js-offer-out">
                <span class="c-cta c-cta--tear-left text-uppercase">{{__('public/common.show_coupon_code')}}</span>
                <span class="c-cta c-cta--tear-right">
                <p class="c-cta--tear-right__text">{{substr($coupon->coupon_code, -3)}}</p>
                <span class="c-cta--tear-right__tear c-code-tear"></span>
              </span></a>
            </div>
          </div>
          @else
          <a onclick="openAjaxPopup({{$coupon->coupon_id}},'offer','{{$coupon->cashback_enabled}}')" class="btn btn btn-primary text-uppercase font-15 fw-400">
          {{__('public/common.view_offer')}}  </a>
          @endif
      </div>
    </div>
  </div>
</div>

<div class="fav-unfav-cpnMsg{{$coupon->coupon_id}}{{$data['type']}}"></div>
<div class="store-card-bottom border-top">
    <div class="row">
      <div class="col-lg-12">
        <ul class="list-inline mb-0 px-3">
          <li class="list-inline-item font-13 secondary-text-light py-3 px-2 border-right">
            <span class="icon-Clock2-icon v-tp font-18 mr-1"></span>
             {{__('public/storepage.Ends_On')}} {{date('d F Y',strtotime($coupon->expiry_date))}}
          </li>
          <li class="pop social-share list-inline-item font-13 primary-text py-3 px-2 border-right" data-popover-content="#SharePopOver" rel="CpnSharePop">
            <span class="icon-Share1-icon v-tp font-18 mr-1"></span> <span class="cpn-icon-lable">{{__("public/common.share_txt")}}</span>
          </li>

	   	@if(!Auth::guard('member')->check())
            <li class="list-inline-item font-13 secondary-text-light py-3 px-2 border-right cpn-fav-unfav">
               <a href="#0"  data-toggle="modal" data-target="#login-modal">
                 <span class="icon-Plus-icon v-tp font-18 mr-1"></span> <span class="cpn-icon-lable">{{__("public/common.add_fav_txt")}}</span></a>
             </li>
			  @else
          @php
            $dataArr = $data['coupon_follow_data'];
            $in_arr = (bool)strpos(serialize($dataArr),'i:'.$coupon->coupon_id.';');
         @endphp
             @if($in_arr)
              <li class="list-inline-item font-13  secondary-text-light py-3 px-2 border-right cpn-fav-unfav "  >
                <a  class="cpn-fav-action" data-action="remove" >
                  <span class="cpn-icon-lable  cpn-replace-label"><i class="fas fa-minus-circle"></i>  {{__("public/common.remove_fav_txt")}}</span></a>
              </li>
              @else
              <li class="list-inline-item font-13  secondary-text-light py-3 px-2 border-right cpn-fav-unfav"  >
                <a class="cpn-fav-action" data-action="add">
                     <span class="cpn-icon-lable cpn-replace-label"><i class="fas fa-plus-circle"></i> {{__("public/common.add_fav_txt")}}</span></a>
               </li>
              @endif
            @endif

		<?php
        /*
          @if(!Auth::guard('member')->check())
            <li class="list-inline-item font-13 secondary-text-light py-3 px-2 border-right">
               <a href="#0"  ata-toggle="modal" data-taget="#login">
                 <span class="icon-Plus-icon v-tp font-18 mr-1"></span> <span class="cpn-icon-lable">Add to favorite</span></a>
             </li>
          @else
          @php
            $dataArr = $data['coupon_follow_data'];
            $in_arr = (bool)strpos(serialize($dataArr),'i:'.$coupon->coupon_id.';');
         @endphp
             @if($in_arr)
              <li id="show-remove-fav-{{$coupon->coupon_id}}" class="list-inline-item font-13  secondary-text-light py-3 px-2 border-right hidden"  >
                <a href="#0" onclick="addCouponSubscriber({{$coupon->coupon_id}},'coupon','{{route('add.coupon.subscribe')}}','common-coupon-subscription-msg{{$coupon->coupon_id}}',0)">
                 <i class="fas fa-minus-circle"></i> <span class="cpn-icon-lable rm-fav-{{$coupon->coupon_id}}">Remove From favorite</span></a>
              </li>
              @else
              <li  id="show-add-fav-{{$coupon->coupon_id}}" class="list-inline-item font-13  secondary-text-light py-3 px-2 border-right"  >
                <a href="#0" onclick="addCouponSubscriber({{$coupon->coupon_id}},'coupon','{{route('add.coupon.subscribe')}}','common-coupon-subscription-msg{{$coupon->coupon_id}}',1)">
                    <i class="fas fa-plus-circle"></i></span> <span class="cpn-icon-lable">Add to favorite</span></a>
               </li>
              @endif
            @endif
		    	*/
      ?>

          <li class="cpn-coments list-inline-item font-15 primary-text float-right border-left" data-toggle="collapse"  data-target="#comments{{$coupon->coupon_id}}{{$data['type']}}" role="v-offers-tab" aria-expanded="true"><span class="icon-Message-icon v-middle font-18 mr-1"></span> {{$coupon->comment_count}} <span class="cpn-icon-lable">{{__('public/common.comment_txt')}}</span></li>
        </ul>
        <div class="common-coupon-subscription-msg{{$coupon->coupon_id}} iziToast-target"></div>

        <div id="comments{{$coupon->coupon_id}}{{$data['type']}}" class="collapse border-top">
          <!-- <a href="#0" class="comment-close" ></a> -->
            <div class="comment-box bg-white">
              <div id="cpmnt{{$coupon->coupon_id}}" class="ajax-commentdeal p-4"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
