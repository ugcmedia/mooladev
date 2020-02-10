
<!-- top-brands -->
<section class="top-brands py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col-lg-9">
        <h2 class="section-title font-24 fw-800 text-dark">{{__('public/homepage.hp_brand_title')}}</h2>
        <p class="section-disc font-15 fw-400">
          {{__('public/homepage.hp_brand_desc')}}
        </p>
          </div>
        <div class="col-lg-3 col-lg-3 text-left text-lg-right d-none d-md-block">
        <a href="{{url(config('pageList.allBrands'))}}"><button type="button" class="btn btn-primary"><span class="icon-Calendar-icon pr-2"></span>
          {{__('public/homepage.hp_brand_viewall_btn')}}
        </button></a>
      </div>
      </div>

    <div id="top-brands-owl">
      <div class="owl-carousel owl-theme section-inner-white pt-4 px-4 rounded">
        @foreach($data['topBrands'] as $brand)
        <?php
        $offercount = '0';
        if(!empty($brand->offers_count)) {
            $offercount = AppClass::getOffersCount($brand->offers_count)." Offers";
          }
        ?>
        <div class="item">
            <a href="{{url('brand/'.str_slug($brand->brand_slug))}}">
            <div class="top-brand-box text-center pb-4">
              <div class="top-brand-logo">
                <img  class="owl-lazy" data-src="{{asset('uploads/images/brand').'/'.$brand->brand_icon}}">
              </div>
                <p class="top-brand-name mb-0 secondary-text font-15">
                  {{$brand->brand_name}}
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
    <a href="{{url(config('pageList.allBrands'))}}">
    <button type="button" class="btn btn-primary"><span class="icon-Calendar-icon pr-2"></span>
      {{__('public/homepage.hp_brand_viewall_btn')}}
    </button>
    </a>
  </div>
    </div>
      </div>
</section>
