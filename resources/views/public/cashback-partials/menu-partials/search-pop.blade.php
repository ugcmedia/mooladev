<!-- Search Box Popup code -->
  <span class="closebtn" onclick="closeSearch()" title="Close Overlay">×</span>

  <div class="overlay-content">
    <form class="main-search-frm" action="{{route('search.coupons-store-cat')}}" method="get">
      <!-- <button type="submit"><i class="fa fa-search"></i></button> -->
      <input type="text" placeholder="Search Coupons, Stores, Offers"  id="searchTxt" name="keyword" onkeyup="getCouponDeal()" @if(isset($_GET['keyword'])) value="{{$_GET['keyword']}}"  @endif class="form-control" >
    </form>
  </div>
  <div class="container">
    <div class="search-stores" >
      <div id="dshowData123" class="">
        <div class="container">
            <div class="row">
              <div class="col-md-12">
                <div class="best-deals-title mb-3">
                  <b class="text-capitalize s-title text-dark" >{{__('public/common.trandingNow')}}</b>
                </div>
                <ul class="list-inline mb-5 t-ul" >
                  <?php $getTrending = AppClass::getTrendings();
                  ?>
                  @foreach($getTrending['store'] as $tstore)
                    <li class="list-inline-item t-list">
                        <a href="{{url('store/'.str_slug($tstore->store_slug))}}" class="success-link" title="{{$tstore->store_name}}">{{$tstore->store_name}}</a>
                    </li>
                  @endforeach
                  @foreach($getTrending['cat'] as $tcat)
                    <li class="list-inline-item t-list">
                        <a href="{{url('category/'.str_slug($tcat->cat_slug))}}" class="success-link" title="{{$tcat->cat_name}}">{{$tcat->cat_name}}</a>
                    </li>
                  @endforeach
                  @if(config('settingConfig.module_brands') == 'Y')
                    @foreach($getTrending['brand'] as $tbrand)
                        <li class="list-inline-item t-list">
                            <a href="{{url('brand/'.str_slug($tbrand->brand_slug))}}" class="success-link" title="{{$tbrand->brand_name}}">{{$tbrand->brand_name}}</a>
                        </li>
                    @endforeach
                  @endif
                  @if(config('settingConfig.module_tags') == 'Y')
                    @foreach($getTrending['tag'] as $ttag)
                      <li class="list-inline-item t-list">
                          <a href="{{url('tag/'.str_slug($ttag->tag_slug))}}" class="success-link" title="{{$ttag->tag_name}}">{{$ttag->tag_name}}</a>
                      </li>
                    @endforeach
                  @endif
                </ul>
              </div>
            </div>
            <div class="row">

              <div class="col-lg-6">
                <div class="best-deals-title mb-3">
                  <b class="text-capitalize s-title text-dark ">{{__('public/common.featured_deal')}}</b>
                </div>
                <?php $dealData = AppClass::getfeaturedDeals(); $filter = false;$dodPage ='';$isSearch=true ?>
                  @include('public.cashback-partials.deal-partials.hottest_deal_ajax_tab')
              </div>
              <div class="col-lg-6">
              <?php $hcoupons = AppClass::getHottestCoupon(); ?>
              @if(count($hcoupons) > 0 )
                <div class="best-deals-title mb-3">
                  <b class="text-capitalize s-title text-dark">{{__('public/common.hotCoupon')}}</b>
                </div>
                <div class="row">
                <?php  $catName = '';?>
                @foreach($hcoupons as $coupon)
                  <div class="col-md-6">
                    <div class="coupon-markup">
                      <div class="dd-box coupon-detail p-3 rounded div-inner-white mb-4">
                        <!-- <div class="overlay"></div> -->
                        <div class="coupon-store-logo">
                          <a href="{{url('store/'.str_slug($coupon->store_slug).'/')}}"><img src="{{asset('uploads/images/store').'/'.$coupon->store_logo}}" alt=""></a>
                          @if($coupon->coupon_type == 'coupon')
                            <div class="cashback-labe">
                                <img src="{{asset('public_assets/images/coupon-scissors.svg')}}" alt="">
                             </div>
                            @endif
                      </div>
                        <div class="cpn-discount">
                          <p class="text-muted"><strong>{{AppClass::word_limit($coupon->promo_text,3)}}</strong></p>
                        </div>
                        <?php
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
                        ?>
                        <div class="m-store-details best-cpn d-flex align-items-center mb-2">
                          @if(!empty($cashbackstr))
                            <!-- <img src="{{asset('uploads/common/cash.svg')}}"> -->
                            <span class="font-15 fw-700 icon-percentage2-icon v-middle mr-2"></span>
                            <span class="font-15 fw-700 primary-text">{{$cashbackstr}}</span>
                          @endif
                        </div>
                        <div class="cpn-discription font-15 fw-400 text-dark text-center">
                          <p>{{$coupon->title}}</p>
                      </div>
                      <?php $cashbackstr = (!empty($cashbackstr))? "Earn ". $cashbackstr : ""; ?>

                      <div class="deals-btn text-center mb-3">

                        <a class="btn btn-primary " href="javascript:void(0)"
                        onclick="openAjaxPopup({{$coupon->coupon_id}},'{{$coupon->coupon_type}}','{{$coupon->cashback_enabled}}')">
                                                                  @if($coupon->coupon_type == 'coupon') {{__('public/common.show_coupon_btn')}}
                                                                   @else
                                                                    {{__('public/common.view_offer')}}
                                                                    @endif
                                                                  </a>
                      </div>
                      <div class="see-all-offer-link">
                        <a class="primary-link" href="{{url('store/'.str_slug($coupon->store_slug).'/')}}">{{__('public/search.see_all_offer',['store_name'  =>$coupon->store_name ])}} offer</a>
                      </div>
                  </div>
                  </div>
                    </div>
                @endforeach
                </div>
                @endif
              </div>
            </div>
          </div>
      </div>
      <div id="searchAppend">

      </div>
    </div>
  </div>
<!-- Search Box Popup code -->
<script type="text/javascript">
function getCouponDeal() {
    if($('#searchTxt').val().length > 2) {
      jQuery('#dshowData123').css("display","none");
      jQuery('#searchAppend').empty();
      $.ajax({
        method:'get',
        cache: false,
        data: {keyword:$('#searchTxt').val(),'_token': $('input[name=_token]').val()},
        url:"{{route('get.searchData')}}",
        success:function(data){
            $('#searchAppend').html(data);
        }
      });
    }
    else {
      jQuery('#dshowData123').css("display","block");
    }
    if($('#searchTxt').val().length < 2) {
          $('#searchAppend').empty()
    }
}
</script>
