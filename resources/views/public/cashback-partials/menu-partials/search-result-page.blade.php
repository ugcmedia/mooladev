@extends('public.layouts.app')
@section('title')
  Search Result
@endsection
@section('content')
<section class="deals-of-the-day">
  <div class="containesr">
    <div class="merchant-banner-cont pt-3">
    	<div class="container">

    <div>
    	<div class="row">
    		<div class="col-12 col-lg-12 col-md-12">
    			<div class="merchent-offers-title text-center text-white pt-3 pb-5">
    				<h1 class=" text-capitalize">{{__('public/search.Search_result')}}</h1>
            <h3>{{__('public/search.Show_result',['keyword' =>$data['keyword'] ])}}</h3>
    			</div>
    			</div>
    		</div>
      </div>
    </div>
    </div>
    <div class="row1">
      <div class="container">
      <div class="row">

      <div class="col-lg-12 col-md-12">
          @if(count($data['stores']) > 0)
          <div class="search-cat my-3">
          	<div class="row">
          		<div class="col-12">
            <div class="search-view px-2">
              {!! __('public/search.in_stores',['keyword' => $data['keyword'],'count' => count($data['stores']) ]) !!}
              <span class="float-right"><a class="primary-link" href="{{url('all-stores')}}" style="text-decoration: underline; color: #009DFE;">{{__('public/search.View_all_stores')}}</a></span>
            </div>
            </div>
            </div>

          <div class="s-store-list mt-3">
            <div class="row">
              @foreach($data['stores'] as $store)
                <div class="col-6 col-lg-2">
                  <div class="s-store-box p-3 bg-white rounded text-center mb-3">
                    <a href="{{url('store/'.str_slug($store->store_slug))}}">
                    <div class="feature-store-logo">
                      <img src="{{asset('uploads/images/store').'/'.$store->store_logo}}" alt="">
                    </div>
                    <p class="text-capitalize mb-2">{{$store->store_name}}</p>
                    <div class="s-s-avail-offers text-muted">
                  <?php
                      $totalDeals   = 0;
                      $totalCoupons = 0;
                      $getData = explode('|',$store->offers_count);
                      $totalCount = $getData[0];
                      $totalDeals = $getData[2];
                      $totalCoupons =  $getData[1];
                      ?>
                      <span>{{__('public/search.coupons',['count' =>$totalCoupons ])}}  |</span>
                      <span>{{__('public/search.offers',['count' => $totalCount])}}  </span>
                    </div>
                  </a>
                  </div>
                </div>
              @endforeach
</div>
            </div>
             </div>
          </div>
        </div>
      @endif


          @if(count($data['categories']) > 0)
          <div class="top-cat-wrap">
          	<div class="row">
          		<div class="col-12 my-3">
            <div class="search-view px-2">
              {!! __('public/search.in_categories',['keyword' => $data['keyword'],'count' => count($data['categories']) ]) !!}
              <span class="float-right"><a class="primary-link" href="{{url('all-coupon-categories')}}" style="text-decoration: underline; color: #009DFE;">{{__('public/search.View_all_categories')}}</a></span>
            </div>
        </div>
    </div>
             <div class="row">
               @foreach($data['categories'] as $cat)
               <?php
               $hpimg = asset('uploads/images/no-image.png');
               if(!empty($cat->homepage_image)) {
                 $hpimg = asset('uploads/images/category').'/'.$cat->homepage_image;
               }
               ?>
                 <div class="col-6 col-lg-2">

                   <div class="top-cat-box text-center rounded">
                     <div class="top-cat-cont">
                      <a href="{{url('category/'.str_slug($cat->cat_slug))}}">
                        <img src="{{$hpimg}}" alt="{{$cat->cat_name}}">
                        <p class="text-capitalize">@if($cat->menu_name != '' || $cat->menu_name != null) {{str_limit($cat->menu_name,20)}}@else {{str_limit($cat->cat_name,20)}} @endif</p>
                      </a>
                   </div>
                   </div>
                 </div>
               @endforeach

           <!-- /top-cat-row-3 -->
           </div>
       </div>

          @endif
          @if(count($data['deals']) > 0)
          <div class="top-cat-wrap">
          	<div class="row">
          		<div class="col-12 my-3">
            <div class="search-view px-2">
              {!! __('public/search.in_deals',['keyword' => $data['keyword'],'count' => count($data['deals']) ]) !!}
            </div>
             </div>
              </div>
            <div class="row">
              <?php $dealData = $data['deals'] ; $filter = false;$dodPage =''; ?>
                @include('public.cashback-partials.deal-partials.hottest_deal_ajax_tab')
             </div>
             @endif
          <div class="search-cat my-3">
            <div class="search-view px-2">
              {!! __('public/search.in_Coupons_Offers',['keyword' => $data['keyword'] ]) !!}
            </div>
          </div>

   @if(count($data['coupons'] ) > 0)
   <div id="ajaxSearch">


     <div class="row">
     <?php  $catName = '';?>
     @foreach($data['coupons'] as $coupon)
       <div class="col-lg-4 col-md-4 mb-3">
         <div class="coupon-markup py-31">
           <div class="dd-box div-inner-white coupon-detail p-3 rounded h-100">
             <!-- <div class="overlay"></div> -->
             <div class="coupon-store-logo">
               <a href="{{url('store/'.str_slug($coupon->store_slug).'/')}}"><img src="{{asset('uploads/images/store').'/'.$coupon->store_logo}}" alt=""></a>
               @if($coupon->coupon_type == 'coupon')
                 <div class="cashback-labe">
                     <img src="{{asset('public_assets/images/coupon-scissors.svg')}}" alt="">
                  </div>
                 @endif
           </div>
             <div class="cpn-discount">
               <p class="mb-0 text-muted"><strong>{{AppClass::word_limit($coupon->promo_text,3)}}</strong></p>
             </div>
             <?php
             $cashbackstr = "";
             if($coupon->cashback_enabled == 'Y') {
               if(!empty($coupon->cashback)) {
                 $cashbackstr = 'Upto '.$coupon->cashback .' '.$coupon->cashback_type;
               } else {
                 if(!empty(AppClass::getOnlyCashbackValue($coupon->storeCashback))) {
                   $cashbackstr =  'Upto '.AppClass::getOnlyCashbackValue($coupon->storeCashback) .' '.$coupon->cashback_type;
                 }
               }
             }
             ?>

             <div class="m-store-details best-cpn text-center mb-2">
               @if(!empty($cashbackstr))
                 <span class="font-15 fw-700 icon-percentage2-icon v-middle mr-2"></span>
                 <span class="font-15 fw-700 primary-text">{{$cashbackstr}}</span>
               @endif
             </div>
             <div class="cpn-discription text-dark">
               <p>{{$coupon->title}}</p>
           </div>
           <?php $cashbackstr = (!empty($cashbackstr))? "Earn ". $cashbackstr : ""; ?>

           <div class="deals-btn text-center mb-3">
             <a class="btn btn-primary " id="cpn{{$coupon->coupon_id}}"  href="#"
                        onclick="openAjaxPopup({{$coupon->coupon_id}},'{{$coupon->coupon_type}}','{{$coupon->cashback_enabled}}')"
                                                     role="button">
                                                       @if($coupon->coupon_type == 'coupon') {{__('public/common.show_coupon_btn')}} @else
                                                         {{__('public/common.view_offer')}}
                                                         @endif
                                                       </a>
           </div>
           <div class="see-all-offer-link">
             <a class="primary-link" href="{{url('store/'.str_slug($coupon->store_slug).'/')}}">{{__('public/search.see_all_offer',['store_name' => $coupon->store_name])}} </a>
           </div>
       </div>
       </div>
     </div>
     @endforeach
   </div>

</div>
    {!! $data['coupons']->render() !!}
  @else
  <div class="row">
    <div class="col-md-12">
      <div class="no-coupons bg-white p-3 rounded text-center mb-4">
        <i class="fa fa-frown-o" aria-hidden="true"></i>
        <p class="mb-0 text-capitalize">{{__('public/search.no_offers_available')}}</p>
      </div>
    </div>
  </div>
  @endif
</div>
  </div>
</div>
</div>
</section>



@endsection
