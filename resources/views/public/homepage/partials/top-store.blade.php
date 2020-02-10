<!-- top-stores -->
<section class="top-stores py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col-lg-9">
        <h2 class="section-title font-24 fw-800 text-dark">{{__('public/homepage.hp_top_store_title')}}</h2>
        <p class="section-disc font-15 fw-400">
          {{__('public/homepage.hp_top_store_desc')}}
        </p>
      </div>
      <div class="col-lg-3 text-left text-lg-right d-none d-md-block">
        <a href="{{url(config('pageList.allStores'))}}">
          <button type="button" class="btn btn-primary"><span class="icon-Calendar-icon pr-2"></span> {{__('public/homepage.hp_top_store_viewall')}}</button>
        </a>
      </div>
    </div>
    <div class="top-stores-tabs">
      <div class="row no-gutters">
        <div class="col-lg-2">
          <ul class="nav nav-pills" id="pills-tab-topstore" role="tablist">
            <?php $i=0; ?>
          @php
            $getTopStoreCats = AppClass::getTopStoreCat(config('settingConfig.hp_topstore_cats'),'topStore');
          @endphp
          @foreach($getTopStoreCats as $topStore)
             @if($i==0)
               <li class="nav-item mb-2">
                 <a class="nav-link active" href="#tab{{$topStore->store_cat_id}}" data-target="#tab{{$topStore->store_cat_id}}"   data-toggle="pill" role="tab"  aria-selected="false"><i class="{{$topStore->store_cat_menu_icon}}"></i> <span class="ml-2">{{$topStore->store_cat_name}}</span></a>
               </li>
             @else
               <li class="nav-item mb-2">
                 <a class="nav-link "  href="{{url('getTopStore').'/'.$topStore->store_cat_id}}" data-target="#ajaxtab{{$topStore->store_cat_id}}"  data-toggle="topStoreAjaxTab"  role="tab"  aria-selected="false"><i class="{{$topStore->store_cat_menu_icon}}"></i> <span class="ml-2">{{$topStore->store_cat_name}}</span></a>
               </li>
             @endif
          <?php $i++; ?>
          @endforeach
          </ul>
        </div>
        <div class="col-lg-10">
          <div class="tab-content top-store-cont section-inner-white rounded h-100" id="pills-tabContent">

          <?php $i=0; ?>
            @foreach($getTopStoreCats as $topStore)
             @if($i == 0)
               <div class="tab-pane fade show active" id="tab{{$topStore->store_cat_id}}" role="tabpanel" aria-labelledby="pills-New-tab">
                 <div class="top-store-cont p-3 ">
                 <div class="row">
				          <?php $scount = 1;?>
                  @foreach(AppClass::getTopStoreList($topStore->store_cat_id) as $store)
                  <?php   if($scount==15) break;
				            $storeimg = ($store->store_logo != '')? asset('uploads/images/store').'/'.$store->store_logo : asset('uploads/images/no-image.jpg');
                    $offercount = '0';
                    if(!empty($store->offers_count)) {
                      $offercount = AppClass::getOffersCount($store->offers_count);
                    }
                    ?>
                   <div class="col-xxl-5 col-6 col-md-3 col-sm-4">
                       <a href="{{url('store/'.str_slug($store->store_slug))}}">
                         <div class="top-store-box text-center">
                           <img data-src="{{$storeimg}}" class="mb-3" />
                           <p class="secondary-text font-15 mb-0">
                             {{$store->store_name}}
                           </p>
                           <p class="primary-text font-15 mb-2">
                             {{$offercount}} Offers
                           </p>
                        </div>
                      </a>
                    </div>
					<?php $scount++;?>
                  @endforeach
                   <div class="col-xxl-5 col-6 col-md-3 col-sm-4 d-flex align-items-center mx-auto mx-md-0">
                       <a href="{{url('store-category/'.str_slug($topStore->slug))}}" class="btn btn-primary v-all-lg-button btn-block d-flex align-items-center justify-content-center">{{__('public/homepage.hp_view_all')}}<br /> {{$topStore->store_cat_name}}
                       </a>
                   </div>
                 </div>
                 </div>
               </div>
             @else
             <div class="tab-pane fade" id="ajaxtab{{$topStore->store_cat_id}}" data-slug="{{$topStore->slug}}" data-title="{{$topStore->store_cat_name}}" role="tabpanel" aria-labelledby="pills-New-tab">
             </div>
           @endif
         <?php $i++; ?>
        @endforeach

          </div>
          <div class="d-block d-md-none text-center mt-5">
            <a href="{{url(config('pageList.allStores'))}}"><button type="button"  class="btn btn-primary"><span class="icon-Calendar-icon pr-2"></span> {{__('public/homepage.hp_top_store_viewall')}} </button></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
