@if($filter)
 @if($dodPage)
 <div class="cat-filter   d-none d-md-block">
   <ul id="tab-cat-tag-filter" class="list-inline">
     @foreach($filtered as $filTag)
     <li class="list-inline-item div-inner-white success-link font-12 fw-400">{{$filTag['name']}}  <i class="fa fa-times v-middle ml-2" onclick="UnDODcheck('{{$filTag['id']}}','{{$filTag['type']}}')"></i></li>
     @endforeach
     <li id="c-filter" onclick="uncheckDODAll()"  class="list-inline-item"> {{__('public/common.filter_clear_all_txt')}}</li>
   </ul>
 </div>
 @else
 <div class="cat-filter  ">
   <ul id="tab-cat-tag-filter" class="list-inline">
     @foreach($filtered as $filTag)
     <li class="list-inline-item div-inner-white success-link font-12 fw-400">{{$filTag['name']}}  <i class="fa fa-times v-middle ml-2" onclick="UncheckDeal('{{$filTag['id']}}','{{$filTag['type']}}')"></i></li>
     @endforeach
     <li id="c-filter" onclick="unDealcheckAll()"  class="list-inline-item">{{__('public/common.filter_clear_all_txt')}}</li>
   </ul>
  </div>
 @endif
@endif
@if(count($dealData) > 0)
<div class="row">
  @foreach($dealData as $hdeal)

  <?php
  // echo "<pre>";
  // print_r($hdeal);
  // echo "</pre>";

  // echo $hdeal->cashback_enabled."<br>";
  // echo $hdeal->deal_cashback."<br>";
  // echo $hdeal->cashback;

  ?>

  <div class="@if(!isset($isSearch)) col-lg-3 col-sm-6 @else col-lg-6 @endif mb-4">
    <div class="dd-box section-inner-white p-3 rounded text-center h-100 @if(isset($isCat) || ($dodPage)) mt-2 @endif">
      @if(isset($isCat) || ($dodPage))
        @php $storeimg = ($hdeal->store_logo != '')? asset('uploads/images/store').'/'.$hdeal->store_logo : asset('uploads/images/no-image.jpg'); @endphp
        <div class="d-store-logo div-inner-white shadow-sm rounded d-inline-flex justify-content-center p-1">
          <a href="{{url('store/'.str_slug($hdeal->store_slug).'?deals')}}">
            <img  src="{{$storeimg}}" alt="">
          </a>
        </div>
      @endif

      <a href="javascript:void(0)" onclick="openAjaxPopup({{$hdeal->deal_id}},'deal','{{$hdeal->cashback_enabled}}')">
        <div class="dd-product mb-4 d-flex">
          @php
            $dealimg = ($hdeal->product_image != '')? asset('uploads/images/products').'/'.$hdeal->product_image : asset('uploads/images/no-image.jpg');
            $dealdisc = ($hdeal->mrp==0) ? 'Best Price' : round( ($hdeal->deal_price/$hdeal->mrp)*100 ).'% Off';
          @endphp
          <img src="{{$dealimg}}" alt="">
        </div>
        <div class="product-disc">
          <p class="font-15 fw-400 text-dark">
            {{$hdeal->title}}
          </p>
        </div>
        <div class="product-prices mb-3 d-flex align-items-center justify-content-center flex-wrap">
          <span class="new-price font-18 fw-700 mr-2"><i class="fas fa-rupee-sign font-16"></i> {{$hdeal->deal_price}}</span>
          <span class="old-price secondary-text font-15"><i class="fas fa-rupee-sign font-14"></i>&nbsp;<del>{{$hdeal->mrp}}</del></span>
        </div>
        <div class="p-discount">
          <span class="font-18 fw-700 primary-text">
            @if($hdeal->cashback_enabled == 'Y')
             @if($hdeal->deal_cashback > 0 && $hdeal->deal_cashback != '')
                <span>{{AppClass::getUptoText('flat|'.round( ($hdeal->deal_cashback*$hdeal->user_split)/100),ucfirst($hdeal->cashback_type))}}</span>
             @else
              <span>{{AppClass::getUptoText($hdeal->cashback,trim($hdeal->cashback_type))}}</span>
             @endif
              @else
              @if($hdeal->cashback != '')
                <span>{{AppClass::getUptoText($hdeal->cashback,trim($hdeal->cashback_type))}}</span>
              @else
                <span>{{$dealdisc}}</span>
              @endif
             @endif
          </span>
        </div>
      </a>
      </div>
    </div>
      @endforeach
  </div>
  @if($dodPage)
    {!! $dealData->render() !!}
  @endif
  @else
  <div class="row" id="no-record">
    <div class="col-12">
      <div class="no-coupons bg-white p-3 rounded text-center mb-4">
        <i class="far fa-frown"></i>
        <p class="mb-0 text-capitalize">{!! __('public/storepage.no_deal_available')!!}</p>

        </div>
      </div>
    </div>

  @endif
