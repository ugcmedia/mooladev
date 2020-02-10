@php $countCoupon = count($data['returnArray']['coupons']);  @endphp
@if($data['returnArray']['filter'])
<div class="cat-filter ">
  <ul id="tab-cat-tag-filter" class="list-inline">
    @foreach($data['returnArray']['filtered'] as $filTag)
    <li class="list-inline-item div-inner-white success-link font-12 fw-400">{{$filTag['name']}}  <i class="fa fa-times v-middle ml-2" onclick="Uncheck('{{$filTag['id']}}','{{$filTag['type']}}')"></i></li>
    @endforeach
    <li id="c-filter" onclick="uncheckAll()"  class="list-inline-item"> {{__('public/common.filter_clear_all_txt')}}</li>
  </ul>
</div>
@endif
<!--Coupon box for Mobile  -->
@if($countCoupon > 0)
 @foreach($data['returnArray']['coupons'] as $coupon)
 @php
   $start_date = new DateTime();
   $since_start = $start_date->diff(new DateTime($coupon->updated_date));
   $diffDate = date('Y-m-d H:i:s', strtotime('-'.$since_start->days.' days'));
   $verifiedAgo = \Carbon\Carbon::createFromFormat("Y-m-d H:i:s",$diffDate)->diffForHumans();
   $item = 0;

  @endphp

  @include('public/cashback-partials/coupon-tab-content.coupon-box-mobile')
  
@php $item++; @endphp

@endforeach
<div id="render{{$data['type']}}">
  {!! $data['returnArray']['coupons']->render() !!}
</div>
@else
<div class="row" id="no-record">
  <div class="col-12">
    <div class="no-coupons bg-white p-3 rounded text-center mb-4">
      <i class="far fa-frown"></i>
      <p class="mb-0 text-capitalize">{{__('public/storepage.no_offers_available')}}</p>
      @if($data['storepage'])
       @if($data['store']->cashback_enabled == 'Y')
       {!! __ ('public/storepage.still_earn_txt',['store_name' => $data['store']->store_name])!!}
      <div class="text-center my-3">
        <?php
          $cashBackText = '';
          $cashBackText =  AppClass::getEarnUpto($data['store']->cashback,$data['store']->cashback_type);
        ?>
        <a href="javascript:void(0)"
          onclick="openAjaxPopup({{$data['store']->store_id}},'store','{{$data['store']->cashback_enabled}}')"
         class="btn btn-primary rounded" >{{__('public/storepage.Activate_Cashback')}}</a>
        @endif
      @endif

      @if($data['storepage'] && $data['store']->cashback_enabled != 'Y' )
      <p>{{__('public/storepage.cash_des')}}</p>
      <p class="text-center mb-0">
        <a href="{{url('/')}}" class="btn btn-primary rounded" >       {!! __ ('public/storepage.visit_store',['store_name' => $data['store']->store_name])!!}</a>
      </p>
      @endif
    </div>
      </div>
  </div>
</div>
@endif
