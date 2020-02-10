<section class="refer-main d-flex align-items-top align-items-lg-center">
  @php
    $str = str_ireplace('#AMT',config('settingConfig.ref_min_transaction'),__('public/homepage.hp_refer_earn_descrition'));
    $str = str_ireplace('#DAYS ',config('settingConfig.refer_redeem_days'),$str);
  @endphp
    <div class="container">
    <div class="refer-main-cont py-3">
      <p class="success-text font-32 fw-400 mb-0">{{__('public/homepage.hp_refer_earn_title')}}<p>
      <p class="font-60 fw-800 text-dark mb-0 font-sm-40"><strong>{{__('public/homepage.hp_assured_cashback')}} <strong></p>
      <p class="refer-msg success-text font-20 fw-400">{{$str}}<p>
      <a href="{{url(config('pageList.referearn'))}}">
        <button type="button" class="btn btn-secondary fw-700 mb-3">{{__('public/homepage.hp_refer_earn_invite_txt')}}</button>
      </a>
      <p class="success-text"><small>{{str_ireplace('#VALID',config('settingConfig.referral_valid_date'),__('public/homepage.hp_refer_earn_valid_txt'))}}</small></p>
    </div>
  </div>
</section>
