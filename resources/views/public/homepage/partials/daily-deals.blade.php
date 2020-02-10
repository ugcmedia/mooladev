<!-- daily deals -->
<section class="top-cpn-cb-offers daily-deals primary-section py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col-lg-4">
        <h2 class="section-title success-text font-24 fw-800"> {{__('public/homepage.hp_daily_deal_title')}}</h2>
        <p class="success-text font-15 fw-400">
          {{__('public/homepage.hp_daily_deal_desc')}}
        </p>
      </div>
      <div class="col-lg-8 justify-content-start justify-content-lg-end d-flex">
          <ul class="nav nav-pills d-deal " id="deal-pills-tab" role="tablist">

            <li class="nav-item">
              <a class="nav-link primary-link active font-15 fw-700"  data-toggle="pill" href="#pills-deal-popular-tab" role="tab" aria-controls="pills-Most-used" aria-selected="true">{{__('public/homepage.hp_top_popular')}}</a>
            </li>


            <li class="nav-item">
              <a class="nav-link primary-link font-15 fw-700" href="{{url('getDailydeal').'/trending'}}" data-target="#topDealTrending"  data-toggle="dailydealAjaxTab"  role="tab"  aria-selected="true"> {{__('public/homepage.hp_top_coupons_trending')}}</a>
            </li>
            <li class="nav-item">
              <a class="nav-link primary-link  font-15 fw-700" href="{{url('getDailydeal').'/new'}}" data-target="#topDealNew"  data-toggle="dailydealAjaxTab"  role="tab"  aria-selected="true"> {{__('public/homepage.hp_top_coupons_new')}}</a>
            </li>
            @php
              $getDealCat = AppClass::getCatByList(config('settingConfig.hp_deal_cats'));
            @endphp
            @foreach($getDealCat as $dcat)
                <li class="nav-item ">
                  <a class="nav-link primary-link  font-15 fw-700" data-slug="{{$dcat->cat_slug}}" href="{{url('getDailydeal').'/'.$dcat->cat_id}}" data-target="#dealCat{{$dcat->cat_id}}"  data-toggle="dailydealAjaxTab" role="tab" aria-controls="pills-Most-used" aria-selected="true"> {{$dcat->cat_name}}</a>
                </li>
            @endforeach
          </ul>
      </div>
    </div>

    <div class="tab-content" id="deal-pills-tabContent">
      <div class='tab-loader-daily-deals'><img  src="{{asset('public_assets/images/ajax-tab-loader.svg')}}" align='center' ></div>
      <div class="tab-pane fade show active" id="pills-deal-popular-tab" role="tabpanel" aria-labelledby="deals-pills-Most-used-tab">
        <div id="daily-deals-owl">
          <div class="owl-carousel owl-theme">
            @foreach($data['dealsData'] as $deal)
              @php
                $storeimg = ($deal->store_logo != '')? asset('uploads/images/store').'/'.$deal->store_logo : asset('uploads/images/no-image.jpg');
                $dealimg = ($deal->store_logo != '')?  asset('uploads/images/products').'/'.$deal->product_image  : asset('uploads/images/no-image.jpg');
      		      $dealdisc = ($deal->mrp==0) ? 'Best Price' : round( ($deal->deal_price/$deal->mrp)*100 ).'% Off';
             @endphp
              <div class="item pt-5">
                <div class="dd-box section-inner-white p-3 rounded text-center">
                  <div class="d-store-logo div-inner-white shadow-sm rounded d-inline-flex justify-content-center p-1">
                    <a href="{{url('store/'.str_slug($deal->store_slug).'?deals')}}">
                      <img class="owl-lazy" data-src="{{$storeimg}}" alt="">
                    </a>
                  </div>
                <a href="javascript:void(0)" onclick="openAjaxPopup({{$deal->deal_id}},'deal','{{$deal->cashback_enabled}}')">
                  <div class="dd-product mb-4 d-flex">
                    <img class="owl-lazy" data-src="{{$dealimg}}" alt="">
                  </div>
                  <div class="product-disc">
                    <p class="font-15 fw-400 text-dark">
                      {{$deal->title}}
                    </p>
                  </div>
                  <div class="product-prices mb-3 d-flex align-items-center justify-content-center flex-wrap">
                    <span class="new-price font-18 fw-700 mr-2"><i class="fas fa-rupee-sign font-16"></i> {{ $deal->deal_price}}</span>
                    <span class="old-price secondary-text font-15"><i class="fas fa-rupee-sign font-14"></i>&nbsp;<del>{{$deal->mrp}}</del></span>
                  </div>
                    <div class="p-discount font-18 fw-700 primary-text mb-2">
                      @if($deal->cashback_enabled == 'Y')
                        @if($deal->cashback != '')
                          <span>{{AppClass::getUptoText($deal->cashback,$deal->cashback_type)}}</span>
                         @endif
      			              @else
				                   <span>{{$dealdisc}}</span>
		                      @endif
                    </div>
                  </a>
                </div>
              </div>

              @endforeach
              @if(!Request::is('deals-of-the-day'))
              <div class="item">
                <a href="{{url(config('pageList.DOD'))}}">
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
          @if(!Request::is('deals-of-the-day'))
          <div class="text-center mt-5">
            <a href="{{url(config('pageList.DOD'))}}">
              <button type="button" class="btn btn-success"><span class="icon-Calendar-icon pr-2"></span>{{__('public/homepage.hp_daily_deal_viewll_btn')}}</button>
            </a>
          </div>
          @endif
        </div>

        <div class="tab-pane fade" id="topDealTrending" role="tabpanel" aria-labelledby="pills-dealTrending-tab"></div>
        <div class="tab-pane fade" id="topDealNew" role="tabpanel" aria-labelledby="pills-dealNew-tab"></div>
        @foreach($getDealCat as $dcat)
          <div class="tab-pane fade" id="dealCat{{$dcat->cat_id}}"  role="tabpanel" aria-labelledby="asd-Most-used-tab">
          </div>
        @endforeach
    </div>
    <!-- <div class="text-center mt-4"><button type="button" class="btn btn-success"><span class="icon-Calendar-icon pr-2"></span> View all deals</button></div> -->
  </div>
</section>
