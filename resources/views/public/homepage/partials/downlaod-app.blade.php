

<!-- download the app -->
<section class="app-details py-5">
  <div class="container">
    <div class="row justify-content-between">
      <div class="col-lg-4">
        <div class="app-feature-details">
          @foreach($data['downlaod_app'] as $appBlock)
            <div class="app-feature d-flex mb-4">
              <div class="app-icon mr-4">
                <span class="{{$appBlock->block_image}} font-60 text-dark"></span>
              </div>
              <div class="app-feature-cont">
                <p class="font-24 fw-700 text-dark">{{$appBlock->title}}</p>
                <p class="font-15 fw-400 text-dark">{!! $appBlock->block_content !!}</p>
              </div>
            </div>
          @endforeach
        </div>
      </div>

      <div class="col-lg-4">
        <div class="app-feature-details">
          <div class="feature-display">
            <img src="{{asset('public_assets/images/deals-woot-mobile-app-2.png')}}" class="img-fluid" alt="">
          </div>
        </div>
      </div>

      <div class="col-lg-4 text-center">
        <div class="app-feature-details">
        <div class="app-feature-right">
          <span class="font-40 fw-400 text-dark">{{__('public/homepage.hp_downlaod_app_txt')}}</span>
          <p class="font-15 fw-400 text-dark">{{__('public/homepage.hp_downlaod_app_description')}}</p>
          <div class="py-5">
            <div class="app-store-logo pb-3">
              <a href="{{route('download.ios.app')}}" target="_blank" title="Download App On App Store" class="d-inline-block">
                <object data="{{asset('public_assets/images/apple-store.svg')}}" type="image/svg+xml" width="160px" style="pointer-events: none;"></object>
              <!-- <img src="{{asset('public_assets/images/apple-store.svg')}}" type="image/svg+xml" alt="App Store"> -->
              </a>
            </div>
            <div class="google-play-logo">
              <a href="{{route('download.android.app')}}"  target="_blank" title="Download App On Google Play Store" class="d-inline-block">
                <object data="{{asset('public_assets/images/play-store.svg')}}" type="image/svg+xml" width="160px" style="pointer-events: none;"></object>
              <!-- <img src="{{asset('public_assets/images/play-store.svg')}}" alt="Play Store"> -->
              </a>
            </div>
          </div>

          <div class="py-4">
          <div class="sub-devider-2"></div>
          <div class="or-ico font-15">
              {{__('public/homepage.hp_downlaod_app_or_txt')}}
          </div>
        </div>
        <span class="font-15 fw-400 text-dark mob-link">{{__('public/homepage.hp_downlaod_getlink_txt')}}</span>
          <div class="mob-link-form">
            <div class="get-app-link-msg iziToast-target"></div>
            <div class="get-app-form input-group div-inner-white rounded shadow">
              <div class="input-group-prepend p-2">
                <div class="input-group-text div-inner-white border-0" >+91</div>
              </div>
              <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" class="form-control border-left" id="mobileNo" placeholder="{{__('public/homepage.hp_enter_your_mobile_no')}}">
              <button type="button" onclick="getLinkSMS('{{route('send.getlink')}}','get-app-link-msg')" class="btn btn-primary"><i class="fas fa-chevron-right"></i></button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>
</section>
