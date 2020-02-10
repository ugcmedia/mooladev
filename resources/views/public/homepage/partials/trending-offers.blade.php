<section class="trending-offers py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col-lg-4">
        <h2 class="section-title font-24 fw-800">{{__('public/homepage.hp_trending_offer_title')}}</h2>
        <p class="section-disc font-15 fw-400">
          {{__('public/homepage.hp_trending_offer_desc')}}
        </p>
      </div>
      <div class="col-lg-8 justify-content-left justify-content-lg-end d-flex">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          @php
            $i = 0;
          @endphp
          @foreach($data['trending_offers'] as $trandingCat)
            @if($i == 0)
              <li class="nav-item mb-3">
                <a class="nav-link active nav-link primary-link active font-15 fw-700" id="trendingOffer-tab{{$trandingCat->status_id}}" data-toggle="pill" href="#tranding-tab{{$trandingCat->status_id}}" role="tab" aria-controls="pills-home-3" aria-selected="true">{{$trandingCat->status_name}}</a>
              </li>
            @else
              <li class="nav-item mb-3">
                <a class="nav-link  nav-link primary-link  font-15 fw-700" id="trendingOffer-tab{{$trandingCat->status_id}}" href="{{url('getTrendingOffers').'/'.$trandingCat->status_code}}" data-target="#tranding-tab{{$trandingCat->status_id}}"  data-toggle="trendingAjaxTab" role="tab" aria-controls="pills-home-3" aria-selected="true">{{$trandingCat->status_name}}</a>
              </li>
            @endif
            @php
              $i++;
            @endphp
          @endforeach
      </ul>

        <!-- <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
      <li class="nav-item mb-3">
      <a class="nav-link active nav-link primary-link active font-15 fw-700" id="pills-home-tab-3" data-toggle="pill" href="#pills-home-3" role="tab" aria-controls="pills-home-3" aria-selected="true">Fashion</a>
      </li>
      <li class="nav-item mb-3">
      <a class="nav-link nav-link primary-link font-15 fw-700" id="pills-profile-tab-3" data-toggle="pill" href="#pills-profile-3" role="tab" aria-controls="pills-profile-3" aria-selected="false">Electronics</a>
      </li>
      <li class="nav-item mb-3">
      <a class="nav-link nav-link primary-link font-15 fw-700" id="pills-contact-tab-3" data-toggle="pill" href="#pills-contact-3" role="tab" aria-controls="pills-contact-3" aria-selected="false">Travel</a>
      </li>
      <li class="nav-item mb-3">
      <a class="nav-link nav-link primary-link  font-15 fw-700" id="pills-contact-tab-4" data-toggle="pill" href="#pills-contact-4" role="tab" aria-controls="pills-contact-4" aria-selected="false">Reacharge</a>
      </li>
      </ul> -->

      </div>
    </div>

    <!-- <div class="row">
      <div class="col-12"> -->
      @php
         $j = 0;
       @endphp
        <div class="tab-content" id="pills-tabContent">
          <div class='tab-loader'><img  src="{{asset('public_assets/images/ajax-tab-loader.svg')}}" align='center' ></div>
          @foreach($data['trending_offers'] as $trandingCat)
            @if($j == 0)
            <div class="tab-pane fade show active" id="tranding-tab{{$trandingCat->status_id}}" role="tabpanel" aria-labelledby="trendingOffer-tab{{$trandingCat->status_id}}">
              <div id="trending-owl" class="trending-owl">
                <div class="owl-carousel owl-theme">
                  @foreach(AppClass::getTrendingOffers($trandingCat->status_code) as $offers)
                    <div class="item">55555
                      <div class="trending-item">
                        @if($offers->link_type == 'internal')
                              <a href="{{$offers->slider_link}}" title="{{$offers->friendly_title}}">
                            @else
                              <a href="#" onclick="openAjaxPopup({{$offers->slider_id}},'slider','Y')"  role="button">
                            @endif
                              <img class="img-fluid" src="{{asset('uploads/images/slider').'/'.$offers->slider_image}}"  alt="">
                          </a>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
            @else
              <div class="tab-pane fade"  id="tranding-tab{{$trandingCat->status_id}}" role="tabpanel" aria-labelledby="trendingOffer-tab{{$trandingCat->status_id}}">
              </div>
            @endif
            @php
              $j++;
            @endphp
          @endforeach
      </div>
      <!-- </div>
    </div> -->
</div>
</section>





<!-- <section class="container trending-offers py-5">
        <div class="row">
            <div class="col-md-12">


				 <div class="row mb-4">
      <div class="col-lg-4">
        <span class="section-title font-24 fw-800">{{__('public/homepage.hp_trending_offer_title')}}</span>
        <p class="section-disc font-15 fw-400">
        {{__('public/homepage.hp_trending_offer_desc')}}
        </p>
      </div>
      <div class="col-lg-8 justify-content-left justify-content-lg-end d-flex">

        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
          @php
            $i = 0;
          @endphp
          @foreach($data['trending_offers'] as $trandingCat)
            @if($i == 0)
              <li class="nav-item mb-3">
                <a class="nav-link active nav-link primary-link active font-15 fw-700" id="home-default-tab{{$trandingCat->status_id}}" data-toggle="pill" href="#tranding-tab{{$trandingCat->status_id}}" role="tab" aria-controls="pills-home-3" aria-selected="true">{{$trandingCat->status_name}}</a>
              </li>
            @else
              <li class="nav-item mb-3">
                <a class="nav-link  nav-link primary-link  font-15 fw-700" href="{{url('getTrendingOffers').'/'.$trandingCat->status_code}}" data-target="#tranding-tab{{$trandingCat->status_id}}"  data-toggle="trendingAjaxTab" role="tab" aria-controls="pills-home-3" aria-selected="true">{{$trandingCat->status_name}}</a>
              </li>
            @endif
            @php
              $i++;
            @endphp
          @endforeach
      </ul>
     </div>
    </div>

   @php
      $j = 0;
    @endphp
  <div class="tab-content" id="tabsJustifiedContent">
    @foreach($data['trending_offers'] as $trandingCat)
      @if($j == 0)
        <div class='tab-loader'><img  src="{{asset('public_assets/images/loading-tab.gif')}}" align='center' ></div>
        <div class="tab-pane fade show active" id="tranding-tab{{$trandingCat->status_id}}" role="tabpanel" aria-labelledby="pills-home-tab-3">
            <div class="container-fluid">

			  <div id="trending-owl" >
				<div class="carousel-inner row w-100 mx-auto" role="listbox">
				<?php $il = 0?>
                @foreach(AppClass::getTrendingOffers($trandingCat->status_code) as $offers)
                  <div class="carousel-item col-md-4 @if($il++ ==0) active @endif ">
                    <div class="trending-item">
                      @if($offers->link_type == 'internal')
                            <a href="{{$offers->slider_link}}" title="{{$offers->friendly_title}}">
                          @else
                            <a href="javascript:void(0)"  onclick="openAjaxPopup({{$offers->slider_id}},'slider','{{route('getAjaxPopup.common')}}')"  >
                          @endif
                            <img  class="img-fluid mx-auto d-block" src="{{asset('uploads/images/slider').'/'.$offers->slider_image}}"  alt="">
                        </a>
                    </div>
                  </div>
                @endforeach
				@foreach(AppClass::getTrendingOffers($trandingCat->status_code) as $offers)
                  <div class="carousel-item col-md-4">
                    <div class="trending-item">
                      @if($offers->link_type == 'internal')
                            <a href="{{$offers->slider_link}}" title="{{$offers->friendly_title}}">
                          @else
                            <a href="#" onclick="openAjaxPopup({{$offers->slider_id}},'slider','{{route('getAjaxPopup.common')}}')"  role="button">
                          @endif
                            <img  class="img-fluid mx-auto d-block" src="{{asset('uploads/images/slider').'/'.$offers->slider_image}}"  alt="">
                        </a>
                    </div>
                  </div>
                @endforeach
              </div>

			  <br>
			  <br>

			  <ol class="carousel-indicators">
  				<li data-target="#TOcarousel{{$trandingCat->status_code}}" data-slide-to="0" class="active"></li>
  				<li data-target="#TOcarousel{{$trandingCat->status_code}}" data-slide-to="4"></li>
  				<li data-target="#TOcarousel{{$trandingCat->status_code}}" data-slide-to="7"></li>
			  </ol>

			  <a class="carousel-control-prev" href="#TOcarousel{{$trandingCat->status_code}}" role="button" data-slide="prev">
            <i class="fa fa-chevron-left fa-lg text-muted"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next text-faded" href="#TOcarousel{{$trandingCat->status_code}}" role="button" data-slide="next">
            <i class="fa fa-chevron-right fa-lg text-muted"></i>
            <span class="sr-only">Next</span>
        </a>

			  </div>
            </div>
          </div>
      @else
        <div class="tab-pane fade"  id="tranding-tab{{$trandingCat->status_id}}" role="tabpanel" aria-labelledby="pills-home-tab-3">
        </div>
      @endif
      @php
        $j++;
      @endphp
    @endforeach

  </div>



            </div>
        </div>
    </section> -->
