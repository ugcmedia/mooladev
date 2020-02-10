@php  $countCoupon = Count($data['returnArray']['coupons']) ; @endphp
    <div class="cat-filter d-none d-md-block">
      <ul id="tab-cat-tag-filter" class="list-inline">
      @if(count($data['returnArray']['filtered']))
        @foreach($data['returnArray']['filtered'] as $filTag)
        <li class="list-inline-item div-inner-white success-link font-12 fw-400">{{$filTag['name']}}  <i class="fa fa-times v-middle ml-2" onclick="Uncheck('{{$filTag['id']}}','{{$filTag['type']}}')"></i></li>
        @endforeach
        <li id="c-filter" onclick="uncheckAll()"  class="list-inline-item"> {{__('public/common.filter_clear_all_txt')}}</li>
        @endif
      </ul>
    </div>
@if($countCoupon > 0)
@php $item = 0; @endphp
<div class="cat-all-deals" id="cat-all-deals">
  <div class="row" id="Mydata">

@foreach($data['returnArray']['coupons'] as $fStores)
      <div class="col-lg-4 col-sm-6 mb-3">
            @include('public/cashback-partials/store-box')
      </div>
@endforeach
</div>
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
        <a href="javascript:void(0)"
          onclick="openAjaxPopup({{$data['store']->store_id}},'store','{{$data['store']->cashback_enabled}}')" class="btn btn-primary rounded" >       {!! __ ('public/storepage.visit_store',['store_name' => $data['store']->store_name])!!}</a>
      </p>
      @endif
      </div>
    </div>
  </div>

@endif


{{ $data['returnArray']['coupons']->links() }}

<script type="text/javascript">
$(function(){
  $('.ajax-commentdeals').each(function() {
    var $this = $(this);
    var cmtid = $this.attr('id').replace('cpmnt','');
    new Comments.default({
     el: '#'+$this.attr('id'),
     pageId: cmtid,
     commentableId: cmtid,
     commentableType: "App.Coupons"
   });
  });
    });
</script>
