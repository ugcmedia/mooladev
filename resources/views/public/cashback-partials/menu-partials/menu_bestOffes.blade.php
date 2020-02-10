<li class="megaMenu"><a href="#" class="navtext"><span>{{$menu->menu_name}}</span></a>
  <div class="wsshoptabing wtsbrandmenu clearfix">
    <div class="container">
    <div class="wsshoptabingwp clearfix">
      <ul class="wstabitem02">
        <?php $i  = 0;
              $fa = 1;
        ?>
        @foreach(AppClass::getbestOffers() as $offer )
          <?php $i++;
          $j = 0; ?>

          <li @if($i == 1) class="wsshoplink-active" @endif><a href="#"><i class="{{$offer->menu_icon}} brandcolor{{$fa}}" aria-hidden="true"></i></i>{{$offer->item_name}} </a>
          <div class="wsshoptab-active wstbrandbottom clearfix">
            <div class="container">
              <div class="row">
                @foreach(AppClass::getbestOffersCoupons($offer->coupons_list) as $coupon)

                  <div class="col-lg-2 col-md-12 menuCpBox">
                    <ul class="wstliststy02 clearfix">
                       <li>
                         <?php   $coupon_cashback = false;
                                 $string          = '';
                          ?>
                           @if($coupon->cashback != null || $coupon->cashback != '')
                               <?php   $coupon_cashback = true;
                                        $string = AppClass::getEarnUpto($coupon->cashback,$coupon->cashback_type);
                                    //   $string     =  'Earn Upto '.$coupon->cashback .' '.$coupon->cashback_type;
                               ?>
                           @else
                            @if(AppClass::getOnlyCashbackValue($coupon->storeCashback) != '')
                               <?php   $coupon_cashback = true;
                                       $string = AppClass::getEarnUpto($coupon->storeCashback,$coupon->cashback_type);
                                       //$string     =  'Earn Upto '.AppClass::getOnlyCashbackValue($coupon->storeCashback) .' '.$coupon->cashback_type;
                                ?>
                             @endif
                           @endif
                         <a
                                href="javascript:void(0)"
                                onclick="openAjaxPopup({{$coupon->coupon_id}},'{{$coupon->coupon_type}}','{{$coupon->cashback_enabled}}')"
                                id="btn{{$coupon->coupon_id}}"
                             >
                            <div class="menu-store-cont">
                              <div class="menu-cphead">
                                <div class="storename">
                                  <span class="cptype {{(trim($coupon->coupon_type) == 'coupon') ? 'code' : 'deal'}}">{{(trim($coupon->coupon_type) == 'coupon') ? 'code' : 'deal'}}</span>
                                  <span class="cpSname">{{$coupon->store_name}}</span>
                                </div>
                                <div class="storelogo">
                                  <img src="{{asset('uploads/images/store').'/'.$coupon->store_logo}}" class="hidden-md-down hidden-sm-down">
                                </div>
                              </div>
                              <div class="m-store-details">
                                <div class="cptitle">{{AppClass::word_limit($coupon->promo_text,3)}}</div>
                                @if($coupon_cashback)
                                  <div class="mb-1">
                                    <span class="font-14 fw-700 icon-percentage2-icon v-middle mr-2"></span>
                                    <span class="cashback">
                                        {{$string}}
                                    </span>
                                  </div>
                                @endif
                                <?php /* <p class="m-offers-disc mb-0">{{$coupon->description}}</p> */?>
                                <p class="m-offers-disc mb-0">{{AppClass::word_limit($coupon->title,11)}}</p>
                               </div>
                             </div>
                          </a>
                        </li>
                      </div>
                    @endforeach
                  </div>
            </div>
          </div>
        </li>
        <?php $fa++; ?>
    @endforeach

      </ul>
    </div>
  </div>
  </div>
</li>
