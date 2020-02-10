<div id="extraCashback-owl" class="ajax-owl" >
  <div class="owl-carousel owl-theme section-inner-white pt-4 px-4 rounded">
  @foreach(AppClass::getTopStoreList($store_cat_id) as $extraCashback)
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
  <div class="d-block d-md-none text-center mt-5">
    <button type="button" class="btn btn-primary"><span class="icon-Calendar-icon pr-2"></span>
      {{__('public/homepage.hp_brand_viewall_btn')}}
    </button>
  </div>
</div>
