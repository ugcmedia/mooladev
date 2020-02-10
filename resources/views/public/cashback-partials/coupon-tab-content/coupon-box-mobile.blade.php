<div class="containerr" id="cpn{{$coupon->coupon_id}}" data-couponid="{{$coupon->coupon_id}}">
<div class="store-card-wrap div-inner-white rounded mb-3" data-tabtype="{{$data['type']}}" data-couponid="{{$coupon->coupon_id}}" data-storeName="{{$coupon->store_name}}">
<div class="store-card-top p-3">
  <div class="row">
    <div class="col-5 col-sm-3 mb-3">
      <div class="store-cb-title p-3 text-center d-flex flex-column align-items-center">
        <p class="discount font-24 fw-800 mb-0 primary-text">{{$coupon->promo_text}}</p>
      </div>
      <div class="store-cb-lable primary-bg font-12 success-text text-center p-1 rounded">
        @if($coupon->coupon_type == 'coupon')
          {{__('public/common.coupon_txt')}}
        @else
          {{__('public/common.offer_txt')}}
        @endif
      </div>
    </div>
    <div class="col-7 col-sm-9 mb-3 px-0">
      <div class="title-meta">
        <ul class="list-inline mb-1">
          <li class="list-inline-item secondary-text-light font-14 fw-400">
            <span class="icon-User2-icon font-14 v-top"></span>
            {{__('public/common.coupon_uses_today',['uses' => $coupon->daily_clicks])}}

           </li>
          <li class="list-inline-item">
            <span class="badge badge-success  font-14 fw-400">{{$coupon->sale_text}}</span>
          </li>
        </ul>
      </div>
      <div class="st-offer-disc-wrap mb-2">
        <div class="st-offer-title d-flex flex-wrap align-items-center">
          <h4 class="font-24 text-dark fw-400 mr-3">{{$coupon->title}}</h4>
        </div>
      </div>
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
<div class="col-12">
  @if($coupon->cashback_enabled == 'Y')
    @if(!empty($cashbackstr))
      <div class="d-flex align-items-center mb-2">
        <span class="font-20 fw-700 icon-percentage2-icon mr-2"></span>
        <span class="s-cpn-cb font-20 primary-text fw-700 mb-0 mr-2 d-inline-block">
          {{__('public/common.coupon_cashback_str',['cashbackStr' => $cashbackstr,'appName' =>config('sximo.cnf_appname') ])}}</span>
      </div>
  @endif
 @endif
  <div id="summary">
    <p class="collapse font-15 fw-300 secondary-text" id="collapseSummary{{$coupon->coupon_id}}">
     {!! $coupon->description!!}
    </p>
    <a class="collapsed" data-toggle="collapse" href="#collapseSummary{{$coupon->coupon_id}}" aria-expanded="false" aria-controls="collapseSummary"></a>
  </div>
  <div class="get-cpn-right mt-2">
    <div class="mb-2">
      <span class="font-12 secondary-text-light"><span class="icon-Right-icon mr-1"></span>{{__('public/common.verified_ago',['ago' => $verifiedAgo])}} </span>
    </div>
      @if($coupon->coupon_type == 'coupon')
      <div class="get-cpn p-2">
        <div class="c-offer__cta-container">
          <a onclick="openAjaxPopup({{$coupon->coupon_id}},'coupon','{{$coupon->cashback_enabled}}')" class="c-code-cta-wrap js-offer-out">
            <span class="c-cta c-cta--tear-left text-uppercase">{{__('public/common.show_coupon_code')}}</span>
            <span class="c-cta c-cta--tear-right">
              <span class="c-cta--tear-right__text">{{$coupon->coupon_code}}</span>
              <span class="c-cta--tear-right__tear c-code-tear"></span>
            </span></a>
            </div>
        </div>
        @else
        <a  onclick="openAjaxPopup({{$coupon->coupon_id}},'offer','{{$coupon->cashback_enabled}}')" class="btn btn btn-primary text-uppercase font-15 fw-400">{{__('public/common.view_offer')}}  </a>
        @endif
        <p class="mb-0 font-13 secondary-text-light pt-3">
          <span class="icon-Clock2-icon v-tp font-18 mr-1"></span>
           {{__('public/storepage.Ends_On')}} {{date('d F Y',strtotime($coupon->expiry_date))}}
        </p>
      </div>
    </div>
  </div>
</div>
<!-- <div class="fav-unfav-cpnMsg{{$coupon->coupon_id}}"></div> -->
<div class="fav-unfav-cpnMsg{{$coupon->coupon_id}}{{$data['type']}}"></div>

<div class="store-card-bottom border-top">
  <div class="container1">
    <div class="row">
      <div class="col-lg-12">
        <ul class="list-inline d-flex justify-content-between mb-0 px-3">
          <li class="pop social-share list-inline-item font-13 primary-text py-3 px-2" data-toggle="popover" data-placement="bottom" data-popover-content="#SharePopOver" rel="CpnSharePop">
            <span class="icon-Share1-icon v-tp font-18 mr-1"></span>
            <span class="cpn-icon-lable">{{__("public/common.share_txt")}}</span>
          </li>
          @if(!Auth::guard('member')->check())
               <li class="list-inline-item font-13 secondary-text-light py-3 px-2  cpn-fav-unfav">
                  <a href="#0"  data-toggle="modal" data-target="#login-modal">
                    <span class="icon-Plus-icon v-tp font-18 mr-1"></span> <span class="cpn-icon-lable">{{__("public/common.add_fav_txt")}}</span></a>
                </li>
          @else
             @php
               $dataArr = $data['coupon_follow_data'];
               $in_arr = (bool)strpos(serialize($dataArr),'i:'.$coupon->coupon_id.';');
            @endphp
                @if($in_arr)
                 <li class="list-inline-item font-13  secondary-text-light py-3 px-2  cpn-fav-unfav "  >
                   <a  class="cpn-fav-action" data-action="remove" >
                     <span class=" cpn-replace-label v-tp font-18 mr-1"><i class="fas fa-minus-circle"></i></span> <span class="cpn-icon-lable">{{__("public/common.remove_fav_txt")}}</span></a>
                 </li>
                 @else
                 <li class="list-inline-item font-13  secondary-text-light py-3 px-2  cpn-fav-unfav"  >
                   <a class="cpn-fav-action" data-action="add">
                        <span class="cpn-replace-label v-tp font-18 mr-1"><i class="fas fa-plus-circle"></i></span> <span class="cpn-icon-lable"> {{__("public/common.add_fav_txt")}}</span></a>
                  </li>
                 @endif
               @endif

      	<?php /* @if(!Auth::guard('member')->check())
          <li class="list-inline-item font-13 secondary-text-light py-3 px-2" data-toggle="modal" data-target="#login-modal"><span class="icon-Plus-icon v-tp font-18 mr-1"></span>
            <span class="cpn-icon-lable">{{__("public/common.add_fav_txt")}}</span></li>
        @else
          @php
            $dataArr = $data['coupon_follow_data'];
            $in_arr = (bool)strpos(serialize($dataArr),'i:'.$coupon->coupon_id.';');
         @endphp
          @if($in_arr)
            <li class="list-inline-item font-13 secondary-text-light py-3 px-2 cpn-fav-unfav ">
              <a  class="cpn-fav-action" data-action="remove" >
              <span class="  v-tp font-18 mr-1 cpn-replace-label"><i class="fas fa-minus-circle"></i> </span></a></li>
          @else
          <li class="list-inline-item font-13 secondary-text-light py-3 px-2 cpn-fav-unfav ">
            <a  class="cpn-fav-action" data-action="add" >
            <span class="  v-tp font-18 mr-1 cpn-replace-label"><i class="fas fa-plus-circle"></i></span></a></li>
         @endif
        @endif */ ?>
          <li class="cpn-coments list-inline-item font-15 primary-text"  data-toggle="collapse" data-target="#comments{{$coupon->coupon_id}}{{$data['type']}}"><span class="icon-Message-icon v-middle font-18 mr-1"></span> {{$coupon->comment_count}}  <span class="cpn-icon-lable">{{__('public/common.comment_txt')}}</span></li>
        </ul>
        <div class="common-coupon-subscription-msg{{$coupon->coupon_id}} iziToast-target"></div>
        <div id="comments{{$coupon->coupon_id}}{{$data['type']}}"   class="collapse border-top">
              <div id="cpmnt{{$coupon->coupon_id}}" class="ajax-comment p-4"></div>
          </div>
      </div>
    </div>
    </div>
</div>
</div>

@if(($countCoupon > 4 && $item === 3 && $data['type'] == 'all') || ($countCoupon < 4 && $item == $countCoupon-1  && $data['type'] == 'all'))
  <!-- get the deal banner -->
  <div class="get-deal-banner my-4">
    <div class="container">
    <div class="row py-4">
      <div class="col-lg-9">
      <h2 class="font-30 fw-700 text-dark">{{AppClass::getHTag($h2Data[0],$h2Data[1],$h2Data[2],$h2Data[3],$h2Data[4])}}</h2>
      <p class="font-15 fw-300 secondary-text mb-0">{{__('public/storepage.join_now_desc')}}</p>
      </div>
        @if(!Auth::guard('member')->check())
          <div class="col-lg-3 m-auto text-center text-lg-right shadow-btn">
          <button type="button" data-target="#join-us-modal" data-toggle="modal" class="btn btn-secondary text-uppercase font-15 fw-700">{{__('public/storepage.join_now_btn')}} </button>
          </div>
        @endif
    </div>
    </div>
  </div>
@endif
</div>