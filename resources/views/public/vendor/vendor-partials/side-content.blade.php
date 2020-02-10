
@if($mobileDetection->isMobile())
  @include('public/store/store-partials.store-mobile-header')
@else
<div class="col-lg-3 col-md-4 " >
  <div class="store-info div-inner-white rounded text-center mb-4">
    <?php
    // echo asset('uploads/images/store').'/'.$data['store']->store_logo;
    // if(file_exists(asset('uploads/images/store').'/'.$data['store']->store_logo) === true) {
    //   echo 'aaa';
    // } else {
    //   echo 'nnn';
    // }
     ?>
    @php
     $storeimg = ($data['store']->store_logo != '')? asset('uploads/images/store').'/'.$data['store']->store_logo : asset('uploads/images/no-image.jpg');
    @endphp

    <div class="store-info-logo p-3">
      <div class="common-subscription-msg iziToast-target"></div>
      @if(Auth::guard('member')->check())
        <a href="#0" onclick="addSubscriber({{$data['store']->store_id}},'store','{{route('add.subscribe')}}','common-subscription-msg')">
          <i class="far fa-heart  secondary-text-light float-right s-favorite-ico "   id="not-subscribed"></i>
        </a>
        <a href="{{route('member.favourites')}}">
          <i class="fas fa-heart  secondary-text-light float-right s-favorite-ico " id="subscribed"></i>
        </a>
      @else
      <a href="javascript:void(0)" data-toggle="modal" id="not-subscribed"  data-toggle="modal" data-target="#login-modal">
        <i class="far fa-heart  secondary-text-light float-right s-favorite-ico"></i>
      </a>
      @endif
        <img src="{{$storeimg}}" alt="{{$data['store']->store_name}}">
    </div>
    <div class="store-name-wrapp">
      <div class="border"></div>
      <p class="store-name secondary-text font-15 fw-700 mb-0 div-inner-white">{{$data['store']->store_name}}</p>
    </div>
    <div class="p-3">
      @if($data['store']->cashback_enabled == 'Y' && $data['store']->cashback != '')
        <div class="store-main-cb-wrapp mb-4 d-inline-flex">
       <div class="store-main-cb border rounded">
        <p class="mb-0 store-main-cb-lable d-inline-block div-inner-white font-12 secondary-text fw-400">{!! ucfirst(__('public/storepage.cb_up_to_txt',['type' => $data['store']->cashback_type])) !!}</p>
        <p class="store-main-cb-count d-inline-block mb-2 py-2 px-3 rounded fw-900 font-18">{{AppClass::getOnlyCashbackValue($data['store']->cashback)}}</p>
        <a href="#" class="store-main-cb-view d-inline-block font-15 fw-800 primary-link div-inner-white" data-toggle="modal" data-target="#cb-details-modal">{{__('public/storepage.view_details')}}</a>
          <!-- Modal -->
            @include('public/store/store-partials/cb-model')
       </div>
    </div>
    @endif
    @if($data['store']->direct_store_link != null && $data['store']->direct_store_link != '' )
     <div class="store-visit shadow-btn mb-2">
        <a onclick="openAjaxPopup({{$data['store']->store_id}},'store','{{$data['store']->cashback_enabled}}')"
            class="shadow-btn btn btn-secondary text-uppercase font-12 fw-700 p-3 px-5">{{__('public/storepage.visit_btn')}} {{$data['store']->store_name}}
        </a>
      </div>
      @endif
    </div>
  </div>


  <div class="sidebarBox">
    <div id="stickFilter">
      <div class="coupon-filter">
        @if(count($data['returnArray']['coupons']) > 0)
          @include('public/cashback-partials/common-sidebar-filters/side-bar-filter')
        @endif
      </div>
      <div class="deal-filter" style="display:none">
        @include('public/cashback-partials/common-sidebar-filters/side-bar-filter-deal-only')
      </div>
    </div>
    <div id="stick-here"></div>

  <!-- offers sidebar -->

  @if($data['store']->cashback_enabled == 'Y')
  <div class="offers-filters-sidebar p-3 mb-4 div-inner-white rounded d-none d-md-block">
      <p class="text-dark font-18 fw-700">{{__('public/storepage.cashback')}}</p>

      <div class="filters-tab">
      <ul class="nav nav-pills nav-justified mb-0" id="pills-tab" role="tablist">
      @if(count( $data['cashbackStru'])  > 0 )
        <li class="nav-item">
          <a class="nav-link active font-13 success-link bg-promo1 mr-2 mb-3" id="pills-home-tab-cb" data-toggle="pill" href="#pills-home-cb" role="tab" aria-controls="pills-home-cb" aria-selected="true">{{__('public/storepage.cb_side_rates_txt')}} </a>
        </li>
      @endif
        <li class="nav-item">
          <a class="nav-link  <?php if(!count( $data['cashbackStru'])  > 0 || $data['store']->cashback_enabled != 'Y'){ echo  'active'; }?> font-13 success-link bg-promo1 mr-2 mb-3" id="pills-profile-tab-ht" data-toggle="pill" href="#pills-profile-ht" role="tab" aria-controls="pills-profile-ht" aria-selected="false">{{__('public/storepage.cb_side_tips_txt')}} </a>
        </li>
        <li class="nav-item">
          <a class="nav-link font-13 success-link bg-promo1 mb-3" id="pills-contact-tab-dt" data-toggle="pill" href="#pills-contact-dt" role="tab" aria-controls="pills-contact-dt" aria-selected="false">{{__('public/storepage.cb_side_states_txt')}} </a>
        </li>
      </ul>
      <div class="tab-content" id="pills-tabContent">
        @if(count( $data['cashbackStru'])  > 0)
        <div class="tab-pane show active" id="pills-home-cb" role="tabpanel" aria-labelledby="pills-home-tab-cb">
          <div class="offers-list pb-2 f-cont">
            <ul class="list-unstyled">
              @php $i=0; @endphp
              @if(count( $data['cashbackStru'])  > 0)
               @foreach( $data['cashbackStru'] as $cashStru)
               <?php // print_r($cashStru); ?>
                @php if($i == 3 ) break; @endphp
                 <li class="mb-3">
                   <div class="offers-list-items">
                     <p class="primary-text font-18 fw-700">
                       @if($cashStru->cb_type == 'percent' )
                         {{ round(($cashStru->cb_rate*$data['store']->user_split)/100,2) }}% {{ ucfirst($data['store']->cashback_type) }}
                       @else
                         {{config('sximo.cnf_currencyname')}}{{round(($cashStru->cb_rate*$data['store']->user_split)/100)}}{{config('sximo.cnf_currencysuffix')}} {{ ucfirst($data['store']->cashback_type) }}
                       @endif
                     </p>
                     <p class="secondary-text font-15 fw-400 mb-0">{{trim($cashStru->cb_title)}}</p>
                   </div>
                 </li>
                 @php $i++; @endphp
               @endforeach
              @endif
            </ul>
          </div>
          @if(count( $data['cashbackStru'])  > 3)
          <div class="v-all-cb-list pt-2 mt-2 border-top mt-2 border-top">
            <a href="#" class="primary-link" data-toggle="modal"  data-target="#cb-details-modal">{{__('public/storepage.View_all')}} <i class="fas fa-chevron-right float-right font-13 mt-1"></i></a>
          </div>
          @endif
        </div>
        @endif
        @php
          if(strip_tags($data['store']->terms_yes) != null) {
            $termsTodo    = explode(PHP_EOL,$data['store']->terms_yes);
          }
          else {
            $termsTodo    = explode(PHP_EOL, config('settingConfig.cb_terms_todo') );
          }
          if(strip_tags($data['store']->terms_no) != null) {
            $termsTonotdo = explode(PHP_EOL,$data['store']->terms_no );
          }
          else {
            $termsTonotdo = explode(PHP_EOL,config('settingConfig.cb_terms_nottodo'));
          }

        @endphp
        <div class="tab-pane <?php if(!count( $data['cashbackStru'])  > 0 || $data['store']->cashback_enabled != 'Y'){ echo  'show active'; }else {echo 'fade'; }?>  " id="pills-profile-ht" role="tabpanel" aria-labelledby="pills-profile-tab-ht">
          <div class="offers-list pb-2 f-cont">
            <div class="tips-header d-flex mb-4">
              <div class="tips-icon mr-3">
                <img src="{{asset('public_assets/images/light-on.png')}}" alt="">
              </div>
              <div class="tips-header-disc">
                <p class="mb-0 font-13 fw-700 secondary-text">{{__('public/storepage.sidebar_tips_from_lab')}}</p>
              </div>
            </div>


            <div class="what-to-do-list">
              <ul class="list-unstyled">
                @php $i = 0; @endphp
                @foreach($termsTodo as $ytodo)
                 @php if($i==2) break; @endphp
                  <li class="d-inline-flex mb-3">
                    <span><i class="fas fa-check success-text"></i></span>
                    <span class="font-13 secondary-text fw-400">
                        {{$ytodo}}
                    </span>
                  </li>
                  @php $i++; @endphp
                @endforeach
              </ul>
            </div>

            <div class="what-to-do-not-list">
              <ul class="list-unstyled ">
                @php $i = 0; @endphp
                @foreach($termsTonotdo as $ntodo)
                 @php if($i==2) break; @endphp
                  <li class="d-inline-flex mb-3 ">
                    <span><i class="fas fa-check success-text"></i></span>
                    <span class="font-13 secondary-text fw-400">
                        {{$ntodo}}
                    </span>
                  </li>
                  @php $i++; @endphp
                @endforeach
              </ul>
            </div>

          </div>
          <div class="v-all-cb-list pt-2 mt-2 border-top mt-2 border-top">
            <a href="#" class="primary-link" data-toggle="modal" data-target="#cb-terms-modal">{{__('public/storepage.View_all')}}<i class="fas fa-chevron-right float-right font-13 mt-1"></i></a>
          </div>
            @include('public/store/store-partials/terms-model')
        </div>
        @php
          $getTips = AppClass::getTips();

            $ttracks = '';
            $tclaimt = '';
            $estDate = '';
            foreach ($getTips as $key => $value) {
              if($value->tip_key == 'track_speed') {
                $ttracks = $value->note;
              }
              if($value->tip_key == 'claim_time') {
                $tclaimt = $value->note;
              }
              if($value->tip_key == 'est_date') {
                $estDate = $value->note;
              }
            }
            $claim_date ='';
            if($data['store']->claim_days != '' && $data['store']->claim_days != 0) {
              $claim_date = $data['store']->claim_days;
            }
            else {
              $claim_date = config('settingConfig.cb_claim_days');
            }
            $edate = strtotime("+$claim_date day", time());
            $estimate_date = date('M d, Y', $edate);
        @endphp
        <div class="tab-pane   " id="pills-contact-dt" role="tabpanel" aria-labelledby="pills-contact-tab-dt">
          <div class="stats-list pb-2 f-cont">
            <ul class="list-unstyled">
              <li class="mb-2">
                <div class="stats-disc d-inline-block">
                  <p class="secondary-text font-13 fw-400 mb-0">{{__('public/storepage.hp_estimate_txt')}}</p>
                  <p class="primary-text font-18 fw-700">{{$estimate_date}}</p>
                </div>
                <a href="#" class="primary-link"><i class="far fa-question-circle float-right" data-toggle="tooltip" data-placement="left" title="{{$estDate}}"></i></a>
              </li>
              <li class="mb-2">
                <div class="stats-disc d-inline-block">
                  <p class="secondary-text font-13 fw-400 mb-0">{{__('public/storepage.hp_tracking_speed_txt')}}</p>
                  <p class="primary-text font-18 fw-700">@if($data['store']->tracking_speed != '' && $data['store']->tracking_speed != 0) {{$data['store']->tracking_speed}} @else {{config('settingConfig.cb_track_speed')}} @endif {{__('public/storepage.days')}}</p>
                </div>
                <a href="#" class="primary-link"><i class="far fa-question-circle float-right"data-toggle="tooltip" data-placement="left" title="{{$ttracks}}"></i></a>
              </li>
              <li class="mb-2">
                <div class="stats-disc d-inline-block">
                  <p class="secondary-text font-13 fw-400 mb-0">{{__('public/storepage.hp_claim_txt')}}</p>
                  <p class="primary-text font-18 fw-700">{{$claim_date}}   {{__('public/storepage.days')}}</p>
                </div>
                <a href="#" class="primary-link"><i class="far fa-question-circle float-right"data-toggle="tooltip" data-placement="left" title="{{$tclaimt}}"></i></a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  @endif

  @php
      $Widget = AppClass::getWidget('store');
  @endphp
  @foreach($Widget as $key=>$getStoreWidget)
     @if($getStoreWidget->widget_type == 'html')
     <div class="similer-stores-filters-sidebar p-3 mb-4 div-inner-white rounded d-none d-md-block">
          <p class="text-dark font-18 fw-700"> {!! $getStoreWidget->title !!}</p>
         {!! $getStoreWidget->html_editor !!}
       </div>
     @endif
     @if($getStoreWidget->widget_type == 'category')
     <div class="similer-stores-filters-sidebar p-3 mb-4 div-inner-white rounded d-none d-md-block">
       <p class="text-dark font-18 fw-700"> {!! $getStoreWidget->title !!}</p>
         <?php  $getCats = AppClass::getCats($getStoreWidget->category_list); ?>
         <ul class="list-styled">
         @foreach($getCats as $cat)
              <li><a href="{{url('category/'.str_slug($cat->cat_slug))}}">{{$cat->cat_name}}</a></li>
         @endforeach
         </ul>
       </div>
     @endif
     @if($getStoreWidget->widget_type == 'store')
     <div class="similer-stores-filters-sidebar p-3 mb-4 div-inner-white rounded d-none d-md-block">
          <p class="text-dark font-18 fw-700"> {!! $getStoreWidget->title !!}</p>
         <?php  $getStore = AppClass::getStores($getStoreWidget->store_list); ?>
         <ul  class="list-styled">
         @foreach($getStore as $store)
             <li class="nav-item">
               <a href="{{url('store/'.str_slug($store->store_slug))}}">
               {{$store->store_name}}
              </a>
            </li>

         @endforeach
         </ul>
       </div>
     @endif

     @if($getStoreWidget->widget_type == 'popular')
     <!-- similer stores -->
     <div class="similer-stores-filters-sidebar p-3 mb-4 div-inner-white rounded d-none d-md-block">
         <p class="text-dark font-18 fw-700">{{__('public/storepage.hp_side_popular_txt')}}</p>

        <div class="filters-tab">
         <ul class="nav nav-pills nav-justified mb-2" id="pills-tab" role="tablist">
             <li class="nav-item">
               <a class="nav-link active font-13 success-link bg-promo1 mr-1 mb-3" id="pills-home-tab-ab" data-toggle="pill" href="#pills-home-ab" role="tab" aria-controls="pills-home-ab" aria-selected="true">{{__('public/storepage.store')}}</a>
             </li>
           @if($getStoreWidget->category_list != '' && $getStoreWidget->category_list != null )
             <li class="nav-item">
               <a class="nav-link font-13 success-link bg-promo1 mr-1 mb-3" id="pills-profile-tab-pp" data-toggle="pill" href="#pills-profile-pp" role="tab" aria-controls="pills-profile-pp" aria-selected="false">{{__('public/storepage.cat')}}</a>
             </li>
           @endif
           @if($getStoreWidget->brand_list != '' && $getStoreWidget->brand_list != null )
             <li class="nav-item">
               <a class="nav-link font-13 success-link bg-promo1 mb-3" id="pills-contact-tab-ot" data-toggle="pill" href="#pills-contact-ot" role="tab" aria-controls="pills-contact-ot" aria-selected="false">{{__('public/storepage.brands')}}</a>
             </li>
           @endif
         </ul>
         <div class="tab-content" id="pills-tabContent">
           <div class="tab-pane fade show active" id="pills-home-ab" role="tabpanel" aria-labelledby="pills-home-tab-ab">
               <div class="smilar-store-list pb-2">
                 <div class="row no-gutters">
                   @foreach(AppClass::getStoreByList($getStoreWidget->store_list) as $store)
                     @php
                      $store_widget_img = ($store->store_logo != '')? asset('uploads/images/store').'/'.$store->store_logo : asset('uploads/images/no-image.jpg');
                      $offercount = '0';
                      if(!empty($store->offers_count)) {
                        $offercount = AppClass::getOffersCount($store->offers_count);
                      }
                     @endphp
                     <div class="col-lg-6">
                      <a href="{{url('store/'.str_slug($store->store_slug))}}">
                       <div class="simi-store-box text-center">
                         <img src="{{$store_widget_img}}">
                         <p class="secondary-text font-15 mb-0">{{$store->store_name}}</p>
                         <p class="primary-text font-15">{{$offercount}} Offers</p>
                       </div>
                       </a>
                     </div>
                    @endforeach
                 </div>
               </div>
             <div class="v-all-cb-list pt-2 mt-2 border-top">
               <a href="{{url(config('pageList.allStores'))}}" class="primary-link">{{__('public/storepage.View_all')}} <i class="fas fa-chevron-right float-right font-13 mt-1"></i></a>
             </div>
           </div>
           @if($getStoreWidget->category_list != '' && $getStoreWidget->category_list != null )
           <div class="tab-pane fade" id="pills-profile-pp" role="tabpanel" aria-labelledby="pills-profile-tab-pp">
             <div class="smilar-store-list pb-2">
               <div class="row no-gutters">
                 @foreach(AppClass::getCatByList($getStoreWidget->category_list) as $cat)
                   <div class="col-lg-6">
                    <a href="{{url('category/'.str_slug($cat->cat_slug))}}">
                     <div class="simi-store-box text-center">
                       <img src="{{asset('uploads/images/category').'/'.$cat->cat_icon}}">
                       <p class="secondary-text font-15 mb-0">
                         @if(!empty($cat->menu_name))
                          {{$cat->menu_name}}
                         @else
                          {{$cat->cat_name}}
                         @endif
                        </p>
                     </div>
                     </a>
                   </div>
                  @endforeach
               </div>
             </div>
             <div class="v-all-cb-list pt-2 mt-2 border-top">
               <a href="{{url(config('pageList.allCats'))}}" class="primary-link">{{__('public/storepage.View_all')}} <i class="fas fa-chevron-right float-right font-13 mt-1"></i></a>
             </div>
           </div>
           @endif
           @if($getStoreWidget->brand_list != '' && $getStoreWidget->brand_list != null )
           <div class="tab-pane fade" id="pills-contact-ot" role="tabpanel" aria-labelledby="pills-contact-tab-ot">
             <div class="smilar-store-list pb-2">
               <div class="row no-gutters">
                 @foreach(AppClass::getBrandByList($getStoreWidget->brand_list) as $brand)
                   <div class="col-lg-6">
                    <a href="{{url('brand/'.str_slug($brand->brand_slug))}}">
                     <div class="simi-brand-box text-center">
                       <img src="{{asset('uploads/images/brand').'/'.$brand->brand_icon}}">
                       <p class="secondary-text font-15 mb-0">{{$brand->brand_name}}</p>
                     </div>
                     </a>
                   </div>
                  @endforeach
               </div>
             </div>
             <div class="v-all-cb-list pt-2 mt-2 border-top">
               <a href="{{url(config('pageList.allBrands'))}}" class="primary-link">{{__('public/storepage.View_all')}} <i class="fas fa-chevron-right float-right font-13 mt-1"></i></a>
             </div>
           </div>
           @endif
         </div>
       </div>
      </div>
     @endif
  @endforeach


  </div>
</div>
@endif
<script type="text/javascript">
$(document).ready(function(){
  checkSubscribed(<?php echo $data['store']->store_id; ?>,'store','<?php echo route('check.subscribe') ?>');
 });
</script>
