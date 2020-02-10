
<!-- top-brands -->
<section class="extra-cb-store py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col-lg-3">
          <h2 class="section-title font-24 fw-800 text-dark">{{__('public/homepage.hp_extra_cashback_title')}}</h2>
          <p class="section-disc font-15 fw-400">
            {{__('public/homepage.hp_extra_cashback_desc')}}
          </p>
        </div>
        <div class="col-lg-9 justify-content-end d-flex">
            <ul class="nav nav-pills mb-0 mb-lg-3 pb-3 pb-lg-0" id="pills-tab" role="tablist">
              @php
                $getTopStoreCats = AppClass::getTopStoreCat(config('settingConfig.hp_topcb_stores'),'extraCashback');
                $i = 0;
              @endphp
              @foreach($getTopStoreCats as $topStore)
                @if($i == 0)
                  <li class="nav-item">
                    <a class="nav-link active nav-link primary-link active font-15 fw-700 mr-2" id="home-default-tab" data-toggle="pill" href="#extraCashback{{$topStore->store_cat_id}}" role="tab" aria-controls="pills-home-3" aria-selected="true">{{$topStore->store_cat_name}}</a>
                  </li>
                @else
                  <li class="nav-item">
                    <a class="nav-link primary-link  font-15 fw-700 mr-2" href="{{url('getExtraCashback').'/'.$topStore->store_cat_id}}"  data-toggle="extraCashbackTab" data-target="#extraCashback-tab{{$topStore->store_cat_id}}"   role="tab" aria-controls="pills-Most-usased" aria-selected="true">{{$topStore->store_cat_name}}</a>
                  </li>
                @endif
                @php $i++; @endphp
              @endforeach
            </ul>
        </div>
    </div>

<div class="tab-content" id="pills-tabContent">
  @php
      $x = 0;
  @endphp
  @foreach($getTopStoreCats as $topStore)
    @if($x == 0)
    <div class='tab-loader'><img  src="{{asset('public_assets/images/ajax-tab-loader.svg')}}" align='center' ></div>
      <div class="tab-pane fade show active" id="extraCashback{{$topStore->store_cat_id}}" role="tabpanel" aria-labelledby="pills-Most-used-tab">
        <div id="extraCashback-owl">
          <div class="owl-carousel owl-theme section-inner-white pt-4 px-4 rounded">
            @foreach(AppClass::getTopStoreList($topStore->store_cat_id) as $extraCashback)
              <?php
              $offercount = '0';
              if(!empty($extraCashback->offers_count)) {
                  $offercount = AppClass::getOffersCount($extraCashback->offers_count)." Offers";
                }
              ?>
                <div class="item">
                <a href="{{url('store/'.str_slug($extraCashback->store_slug))}}">
                  <div class="top-brand-box text-center pb-4">
                    <div class="top-brand-logo">
                      <img  class="owl-lazy" data-src="{{asset('uploads/images/store').'/'.$extraCashback->store_logo}}">
                    </div>
                      <p class="top-brand-name mb-0 secondary-text font-15">
                        {{$extraCashback->store_name}}
                      </p>
                      <p class="top-brand-offer primary-text font-15">
                      {{  $offercount}}
                      </p>
                  </div>
                  </a>
                </div>
              @endforeach
          </div>
          <!-- mobile button -->
          <!-- <div class="d-block d-md-none text-center mt-5">
            <button type="button" class="btn btn-primary"><span class="icon-Calendar-icon pr-2"></span>
              {{__('public/homepage.hp_brand_viewall_btn')}}
            </button>
          </div> -->
        </div>
      </div>
      @else
        <div class="tab-pane fade" id="extraCashback-tab{{$topStore->store_cat_id}}" role="tabpanel" aria-labelledby="asd-Most-useassd-tab">
        </div>
      @endif
      @php $x++; @endphp
      @endforeach
  </div>
</div>
</section>
