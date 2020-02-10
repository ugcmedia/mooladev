@php
  $dealsData = [];
  if($cat_id == 'trending')
    $dealsData =  AppClass::getDealTrend();
  elseif($cat_id == 'new')
    $dealsData =  AppClass::getDealNew();
  else
    $dealsData =  AppClass::getDealByCat($cat_id)
@endphp

<div id="daily-deals-owl">
<div class="owl-carousel owl-theme " >
@foreach($dealsData as $deal)
  @php
    $storeimg = ($deal->store_logo != '')? asset('uploads/images/store').'/'.$deal->store_logo : asset('uploads/images/no-image.jpg');
    $dealimg = ($deal->store_logo != '')?  asset('uploads/images/products').'/'.$deal->product_image  : asset('uploads/images/no-image.jpg');
    $dealdisc = ($deal->mrp==0) ? 'Best Price' : round( ($deal->deal_price/$deal->mrp)*100 ).'% Off';
 @endphp
  <div class="item pt-5 aaaaaa">
    <div class="dd-box section-inner-white p-3 rounded text-center">
      <div class="d-store-logo div-inner-white shadow-sm rounded d-inline-flex justify-content-center p-1">
        <a href="{{url('store/'.str_slug($deal->store_slug))}}">
          <img class="owl-lazy" data-src="{{$storeimg}}" alt="">
        </a>
      </div>
    <a href="javascript:void(0)" onclick="openAjaxPopup({{$deal->deal_id}},'deal','{{$deal->cashback_enabled}}')">
      <div class="dd-product mb-4 d-flex">
        <img class="owl-lazy" data-src="{{$dealimg}}" >
      </div>
      <div class="product-disc">
        <p class="font-15 fw-400 text-dark">
          {{$deal->title}}
        </p>
      </div>
      <div class="product-prices mb-3 d-flex align-items-center justify-content-center flex-wrap">
        <span class="new-price font-18 fw-700 mr-2"><i class="fas fa-rupee-sign font-16"></i> {{ $deal->deal_price}}</span>
        <span class="old-price secondary-text font-15"><i class="fas fa-rupee-sign font-14"></i>&nbsp;<del>{{$deal->mrp }}</del></span>
      </div>
      <div class="p-discount font-18 fw-700 primary-text mb-2">
        @if($deal->cashback_enabled == 'Y')
          @if($deal->cashback != '')
            <span>{{AppClass::getUptoText($deal->cashback,$deal->cashback_type)}}</span>
           @endif
          @else
              <span>{{$dealdisc}}</span>
          @endif
        </div>
      </a>
      </div>
    </div>
    @endforeach
    @if(!Request::is('/deals-of-the-day'))
    <div class="item" id="view-all-box">
      <a href="{{url(config('pageList.DOD'))}}">
      <div class="v-all-box d-flex flex-column align-items-center justify-content-center rounded ">
          <p class="mb-4">
            <i class="far fa-arrow-alt-circle-right font-40"></i>
          </p>
          <p class="mb-0 font-20 fw-700">{{__('public/homepage.hp_view_all')}}</p>
        </div>
          </a>
      </div>
    @endif
  </div>
  </div>
  <div class="text-center d-block d-md-none mt-5 view-all-m-link">
    <a href="#">
      <button type="button" class="btn btn-success"><span class="icon-Calendar-icon pr-2"></span>{{__('public/homepage.hp_daily_deal_viewll_btn')}}</button>
    </a>
  </div>
  <script type="text/javascript">
      $(document).ready(function(){
        var slug = $('.d-deal  .active').attr('data-slug');
        //alert(slug);
        //$('#view-all-box').hide();
        if(slug){
          //$('#view-all-box').show();
          $("#view-all-box a").attr("href", "<?php echo url('category/')?>/"+slug+"?deals");
          $(".view-all-m-link a").attr("href", "<?php echo url('category/')?>/"+slug+"?deals");
        }
      });
  </script>
