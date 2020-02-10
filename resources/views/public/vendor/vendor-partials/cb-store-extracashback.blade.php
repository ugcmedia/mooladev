@if($data['store']->cashback_enabled == 'Y' && count($data['extra_cashback']) >0)
   <div class="st-cat-cb-list p-3 div-inner-white rounded mb-4">
     <div class="st-cat-cb-title clearfix">
       <p class="font-18 fw-700 text-dark mb-0 d-inline-block float-left">{{__('public/storepage.earn_cashback_from',['store_name' =>$data['store']->store_name ])}} </p>
     <label class="switch float-right" data-toggle="collapse" href="#cat-switch"  aria-expanded="false" aria-controls="collapseExample">
       <input type="checkbox" checked>
       <span class="slider round bg-promo-dark"></span>
     </label>
     </div>

   <div class="collapse" id="cat-switch">
     <div class="st-cat-cb-list-item pt-2">
       <div class="table-responsive-lg">
       <table class="table ">
         <tbody>
         @foreach($data['extra_cashback'] as $extCashback)
           @if(!empty($extCashback->promo_link))
             <tr>
               @if($mobileDetection->isMobile())
                 <td class="st-cat-title">
                   {{$extCashback->cb_title}}
                   <div class="st-cb-percent text-dark font-14 fw-700">
                      {{AppClass::getEarnUpto(round(($extCashback->cb_rate*$data['store']->user_split)/100,2),$data['store']->cashback_type,$extCashback->cb_type)}}
                   </div>
                 </td>
               @else
                 <td class="st-cat-title">{{$extCashback->cb_title}}</td>
                 <td class="st-cb-percent text-dark font-15 fw-900 text-right">
                    {{AppClass::getEarnUpto(round(($extCashback->cb_rate*$data['store']->user_split)/100,2),$data['store']->cashback_type,$extCashback->cb_type)}}
                 </td>
               @endif
               <td class="text-right"><button
			   onclick="openAjaxPopup({{$extCashback->store_cbid}},'store-cat','{{$data['store']->cashback_enabled}}')"
			   type="button" class="btn btn-outline-primary font-12 text-uppercase">{{__('public/storepage.btn_shop_now')}}</button></td>
             </tr>
            @endif
           @endforeach
         </tbody>
       </table>
     </div>
   </div>
 </div>
</div>
@endif
