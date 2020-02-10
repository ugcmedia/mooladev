

<!-- subscribe -->
<section>
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-6 bg-white text-center">
        <div class="p-0 p-sm-5">
          <div class="py-5">
            <div class="sub-email-ico font-48 mb-3">
              <i class="far fa-envelope"></i>
            </div>
            <p class="subscribe-title font-32 fw-400 text-dark">{{__('public/homepage.hp_subscribe_title_txt')}}</p>
            <p class="subscribe-disc font-15 fw-400 text-dark">{{__('public/homepage.hp_subscribe_desc')}}</p>
            <div class="subscription-msg iziToast-target"></div>
            <div class="invite-m-btn border rounded p-2">
              <div class="row no-gutters">
                <div class="col-7 col-md-9">
                  <input type="text" class="form-control border-0 h-100 p-2"  id="subscriber-email" placeholder="{{__('public/homepage.subsribe_email_placeholder')}}">
                </div>
                <div class="col-5 col-md-3">
                  <button type="submit" class="btn btn-primary shadow-sm w-100 h-100">Invite</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 watsapp-sub-hp text-center">
        <div class="p-0 p-sm-5">
          <div class="py-5">
            <div class="sub-email-ico mb-3">
                <img src="{{asset('public_assets/images/whatsApp-icon.png')}}" class="img-fluid" alt="">
            </div>
            <p class="subscribe-title font-32 fw-400 success-text">{{__('public/homepage.hp_subscribe_whatsup')}}</p>
            <p class="subscribe-disc font-15 fw-400 text-dark"><a href="{{url(config('pageList.WhatsApp'))}}" class="success-link success-text"><i class="fas fa-arrow-circle-right"></i> {{__('public/homepage.hp_link_learn_hiw')}}</a></p>
            <div class="subscription-whatsapp-msg iziToast-target"></div>
            <div class="mob-link-form whats-app d-none1 d-md-none1 d-lg-block1">
              <div class="input-group div-inner-white rounded shadow" style="margin: auto;">
                <div class="input-group-prepend p-2">
                  <div class="input-group-text div-inner-white border-0">+91</div>
                </div>
                <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" id="whats_num" class="form-control border-left" placeholder=" {!! __('public/whatsapp.mobile_number_holder') !!}">
                <button type="button" onclick="subscribeWhatsApp('{{route('subsribe.whatsapp')}}','subscription-whatsapp-msg')"    class="btn btn-primary"><i  class="fas fa-chevron-right"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<?php /*
<section class="subscribe-home py-5">
  <div class="container">
    <div class="row no-gutters">
      <div class="col-lg-6 get-noti shadow text-center div-inner-white p-3 p-sm-5">
          <div class="sub-email-ico font-48 mb-3">
              <i class="far fa-envelope"></i>
        </div>
        <p class="subscribe-title font-32 fw-400 text-dark">{{__('public/homepage.hp_subscribe_title_txt')}}</p>
        <p class="subscribe-disc font-15 fw-400 text-dark">{{__('public/homepage.hp_subscribe_desc')}}</p>
        <div class="mob-link-form email d-flex flex-wrap align-items-center justify-content-center">
          <div class="subscription-msg iziToast-target"></div>
          <div class="input-group div-inner-white rounded border">
            <input type="text" class="form-control"  id="subscriber-email" placeholder="{{__('public/homepage.subsribe_email_placeholder')}}">
            <button type="button" onclick="subscribeMailChamp('{{route('subsribe.mailchamp')}}','subscription-msg')" class="btn btn-primary px-3 px-sm-5">{{__('public/homepage.hp_subscribe_btn_txt')}} </button>
          </div>
        </div>
      </div>

      <div class="col-lg-6 watsapp-sub-hp shadow text-center p-3 p-sm-5">
        <!-- <div class="py-3"> -->
          <!-- <div class="sub-devider"></div> -->

          <div class="sub-email-ico mb-3">
              <img src="{{asset('public_assets/images/whatsApp-icon.png')}}" class="img-fluid" alt="">
          </div>
        <!-- </div> -->
        <p class="subscribe-title font-32 fw-400 success-text mb-5">{{__('public/homepage.hp_subscribe_whatsup')}}</p>
          <div class="mob-link-form whats-app">
            <a href="{{url(config('pageList.WhatsApp'))}}" class="success-link success-text my-3 d-block"><i class="fas fa-arrow-circle-right"></i> {{__('public/homepage.hp_link_learn_hiw')}}</a>

            <div class="subscription-whatsapp-msg iziToast-target"></div>
            <!-- <div class="d-md-none text-center">
              <a href="whatsapp://send?text=$msg&phone=+{{config('settingConfig.social_whatsapp_number')}}&abid=+{{config('social_whatsapp_number')}}" >          <button type="button" class="btn btn-primary mb-2" ><i class="far fa-arrow-alt-circle-right"></i> {!! __('public/whatsapp.btn_subscribe') !!}</button></a>
            </div> -->

            <div class="mob-link-form whats-app d-none1 d-md-none1 d-lg-block1">
              <div class="input-group div-inner-white rounded shadow" style="margin: auto;">
            <div class="input-group-prepend p-2">
              <div class="input-group-text div-inner-white border-0">+91</div>
            </div>
            <input type="number" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="10" id="whats_num" class="form-control border-left" placeholder=" {!! __('public/whatsapp.mobile_number_holder') !!}">
            <button type="button" onclick="subscribeWhatsApp('{{route('subsribe.whatsapp')}}','subscription-whatsapp-msg')"    class="btn btn-primary"><i  class="fas fa-chevron-right"></i></button>
          </div>
        </div>
          </div>
      </div>
    </div>
  </div>
</section>
*/ ?>
