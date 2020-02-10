<!-- top coupons & cashback offers -->
<section class="top-cpn-cb-offers section-inner-white py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col-lg-4">
        <h2 class="section-title font-24 fw-800">{{__('public/homepage.hp_top_coupons_title')}}</h2>
        <p class="section-disc font-15 fw-400">
          {{__('public/homepage.hp_top_coupons_desc')}}
        </p>
      </div>
      <div class="col-lg-8 justify-content-end d-flex">
          <ul class="nav nav-pills mb-0 mb-lg-3 pb-3 pb-lg-0" id="pills-tab" role="tablist">
            <li class="nav-item">
              <a class="nav-link primary-link active font-15 fw-700"  data-toggle="pill" href="#pills-popular-tab" role="tab" aria-controls="pills-Most-used" aria-selected="true">{{__('public/homepage.hp_top_popular')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link primary-link font-15 fw-700" href="{{url('getTopCoupons').'/trending'}}" data-target="#topCouponTrending"  data-toggle="topCouponsAjaxTab"  role="tab" aria-controls="pills-Most-used" aria-selected="true"> {{__('public/homepage.hp_top_coupons_trending')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link primary-link  font-15 fw-700" href="{{url('getTopCoupons').'/new'}}" data-target="#topCouponNew"  data-toggle="topCouponsAjaxTab"  role="tab" aria-controls="pills-Most-used" aria-selected="true"> {{__('public/homepage.hp_top_coupons_new')}}</a>
            </li>
            <?php $getTopCats = AppClass::getTopCats(config('settingConfig.hp_coupon_cats'));?>
            @foreach($getTopCats as $cat)
              <li class="nav-item">
                <a class="nav-link primary-link  font-15 fw-700" href="{{url('getTopCoupons').'/'.$cat->cat_id.'/'.$cat->cat_slug}}" data-target="#topCoupon{{$cat->cat_id}}"  data-toggle="topCouponsAjaxTab"   role="tab" aria-controls="pills-Most-used" aria-selected="true">{{$cat->cat_name}}</a>
              </li>
            @endforeach
          </ul>
      </div>
    </div>

    <div class="tab-content" id="pills-tabContent">
      <div class='tab-loader'><img  src="{{asset('public_assets/images/ajax-tab-loader.svg')}}" align='center' ></div>
      <div class="tab-pane fade show active" id="pills-popular-tab" role="tabpanel" aria-labelledby="pills-Most-used-tab">
        <div id="top-cpn-and-cb-owl">
          <div class="owl-carousel owl-theme">
            @foreach($data['top_coupon_popular'] as $mostUsed)
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
                      <span class="badge badge-primary primary-text font-13 fw-400"> {{__('public/homepage.hp_top_coupons_code')}}</span>
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
                    <span class="secondary-text fw-400 font-13"><i class="fas fa-users"></i> {{$mostUsed->daily_clicks}} {{__('public/homepage.hp_uses_today_txt')}} </span>
                  </div>
                </div>
              </a>
                <div class="v-more-store-offers text-center">
                  <a href="{{url('store/'.str_slug($mostUsed->store_slug))}}" class="primary-link font-15 fw-400">{{__('public/homepage.hp_view_all')}} {{$mostUsed->store_name}} Offers  ({{AppClass::getOffersCount($mostUsed->offers_count)}})</a>
                </div>
              </div>
            @endforeach
          </div>
        </div>
      </div>

        <div class="tab-pane fade" id="topCouponTrending" role="tabpanel" aria-labelledby="pills-topCouponTrending-tab"></div>
        <div class="tab-pane fade" id="topCouponNew" role="tabpanel" aria-labelledby="pills-topCouponNew-tab"></div>
        @foreach($getTopCats as $cat)
          <div class="tab-pane fade" id="topCoupon{{$cat->cat_id}}" role="tabpanel" aria-labelledby="pills-{{$cat->cat_name}}-tab">
          </div>
        @endforeach
    </div>
  </div>
</section>
