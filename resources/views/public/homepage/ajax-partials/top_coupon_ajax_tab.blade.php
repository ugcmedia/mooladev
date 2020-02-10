<div id="top-cpn-and-cb-owl" class="ajax-owl">
  <div class="owl-carousel owl-theme">
    @foreach($couponData as $mostUsed)
    <?php   $storeimg = ($mostUsed->store_logo != '')? asset('uploads/images/store').'/'.$mostUsed->store_logo : asset('uploads/images/no-image.jpg'); ?>
      <div class="item mb-3">
        <div class="top-cpn-box bg-promo1 p-3 mb-3 text-center">
          <div class="cpn-store-logo mb-3">
            <a href="{{url('store/'.str_slug($mostUsed->store_slug))}}">
            <img  class="owl-lazy" data-src="{{$storeimg}}" alt=""></a>
          </div>
        <a href="javascript:void(0)" onclick="openAjaxPopup({{$mostUsed->coupon_id}},'{{$mostUsed->coupon_type}}','{{$mostUsed->cashback_enabled}}')" >
          @if($mostUsed->coupon_type == 'coupon')
            <div class="cpn-lable mb-2">
              <span class="badge badge-primary primary-text font-13 fw-400">{{__('public/homepage.hp_top_coupons_code')}}</span>
            </div>
            @else
            <div class="cpn-lable mb-2">
              <span class="badge badge-secondary secondary-text font-13 fw-400">{{__('public/homepage.hp_top_coupons_offer')}}</span>
            </div>
          @endif
          <div class="top-cpn-title">
            <p class="primary-text font-22 fw-700">
              <?php
              $cashbackstr = "";
              if($mostUsed->cashback_enabled == 'Y') {
                if(!empty($mostUsed->cashback)) {
                    $cashbackstr =       AppClass::getUptoText($mostUsed->cashback,$mostUsed->cashback_type);
                } else {
                  if(!empty($mostUsed->storeCashback)) {
                    $cashbackstr =       AppClass::getUptoText($mostUsed->storeCashback,$mostUsed->cashback_type);
                  }
                }
              }
			  if( strlen(trim($cashbackstr)) == 0 ) $cashbackstr = $mostUsed->promo_text;
              ?>
              {{$cashbackstr}}
            </p>
          </div>

          <div class="cpn-disc">
            <p class="font-14 fw-400 secondary-text">{{$mostUsed->title}}</p>
          </div>

          <div class="uses-count">
            <span class="secondary-text fw-400 font-13"><i class="fas fa-users"></i> {{$mostUsed->daily_clicks}} {{__('public/homepage.hp_uses_today_txt')}}</span>
          </div>
        </a>
        </div>
        <div class="v-more-store-offers text-center">
          <a href="{{url('store/'.str_slug($mostUsed->store_slug))}}" class="primary-link font-15 fw-400">{{__('public/homepage.hp_view_all')}} {{$mostUsed->store_name}} Offers ({{AppClass::getOffersCount($mostUsed->offers_count)}})</a>
        </div>
      </div>
    @endforeach
 @if($viewAll)
    <div class="item">
      <a href="{{url('category/'.str_slug($slug))}}">
      <div class="v-all-box  d-flex flex-column align-items-center justify-content-center rounded">
          <p class="mb-4">
            <i class="far fa-arrow-alt-circle-right font-40"></i>
          </p>
          <p class="mb-0 font-20 fw-700">{{__('public/homepage.hp_view_all')}}</p>
        </div>
          </a>
      </div>
      @endif
  </div>
</div>
