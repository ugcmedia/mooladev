
<div class="p-3 mb-4 div-inner-white rounded list-group allsidebar-links">
{{--  @if(config('settingConfig.module_brands') == 'Y') --}}
    <a href="{{-- url('all-brands') --}}" class="list-group-item
    <?php/*
     if(\Request::is('all-brands')) { echo "active"; }
     */ ?>">{{__('public/common.See_brands')}}</a>
{{-- @endif --}}
  <a href="{{--url('all-stores') --}}" class="list-group-item
  <?php/* if(\Request::is('all-stores')) { echo "active"; } ?> */">
    {{__('public/common.See_stores')}}</a>
  <a href="{{-- url('all-coupon-categories') --}}" class="list-group-item
  <?php
  /*if(\Request::is('all-coupon-categories')) { echo "active"; }*/ ?>
    ">{{__('public/common.See_categories')}}</a>
  {{-- @if(config('settingConfig.module_tags') == 'Y') --}}
    <a href="{{--url('all-tags')--}}" class="list-group-item
    <?php /*if(\Request::is('all-tags')) { echo "active"; } */?>
      ">{{__('public/common.See_tags')}}</a>
{{--   @endif --}}
  <a href="{{-- url('all-store-categories') --}}" class="list-group-item
  <?php /* if(\Request::is('all-store-categories')) { echo "active"; } */?>
    ">{{__('public/common.See_store_categories')}}</a>
</div>
{{-- @if(trim(config('settingConfig.ads_sidebar_1'))!='') --}}

		<div class="mb-4 gbands cat-filter-title border-bottom" id="gband-sidebar1">
		{{-- !! stripcslashes(config('settingConfig.ads_sidebar_1')) !! --}}
		</div>
	{{--	@endif --}}

{{--
		@php
      $Widget = AppClass::getWidget('listing');
  @endphp
  @foreach($Widget as $key=>$getStoreWidget)

     @if($getStoreWidget->widget_type == 'html')

--}}
     <div class="similer-stores-filters-sidebar p-3 mb-4 div-inner-white rounded d-none d-md-block">
          <p class="text-dark font-18 fw-700">

          {{-- !! $getStoreWidget->title !!--}}</p>
        {{-- !! $getStoreWidget->html_editor !! --}}

       </div>
{{--  @endif --}}
  {{-- @if($getStoreWidget->widget_type == 'category') --}}
     <div class="similer-stores-filters-sidebar p-3 mb-4 div-inner-white rounded d-none d-md-block">
       <p class="text-dark font-18 fw-700"> {{--!! $getStoreWidget->title !! --}}</p>
         <?php
         /* $getCats = AppClass::getCats($getStoreWidget->category_list);
         */?>
         <ul class="list-styled">
        {{--@foreach($getCats as $cat) --}}
              <li><a href="{{-- url('category/'.str_slug($cat->cat_slug)) --}}">{{-- $cat->cat_name --}}</a></li>
         {{-- @endforeach   --}}
         </ul>
       </div>
    {{--  @endif   @if($getStoreWidget->widget_type == 'store') --}}
     <div class="similer-stores-filters-sidebar p-3 mb-4 div-inner-white rounded d-none d-md-block">
          <p class="text-dark font-18 fw-700"> {{-- !! $getStoreWidget->title !! --}}</p>
         <?php
         /*
          $getStore = AppClass::getStores($getStoreWidget->store_list);
          */ ?>
         <ul  class="list-styled">

      {{--  @foreach($getStore as $store) --}}
             <li class="nav-item">
               <a href="{{--url('store/'.str_slug($store->store_slug))--}}">
               {{--$store->store_name --}}
              </a>
            </li>
{{--      @endforeach --}}

         </ul>
       </div>

{{--  @endif       @if($getStoreWidget->widget_type == 'popular') --}}
     <!-- similer stores -->
     <div class="similer-stores-filters-sidebar p-3 mb-4 div-inner-white rounded d-none d-md-block">
         <p class="text-dark font-18 fw-700">{{__('public/storepage.hp_side_popular_txt')}}</p>

        <div class="filters-tab">
         <ul class="nav nav-pills nav-justified mb-2" id="pills-tab" role="tablist">
             <li class="nav-item">
               <a class="nav-link active font-13 success-link bg-promo1 mr-1 mb-3" id="pills-home-tab-ab" data-toggle="pill" href="#pills-home-ab" role="tab" aria-controls="pills-home-ab" aria-selected="true">{{__('public/storepage.store')}}</a>
             </li>
             {{--@if($getStoreWidget->category_list != '' && $getStoreWidget->category_list != null ) --}}

             <li class="nav-item">
               <a class="nav-link font-13 success-link bg-promo1 mr-1 mb-3" id="pills-profile-tab-pp" data-toggle="pill" href="#pills-profile-pp" role="tab" aria-controls="pills-profile-pp" aria-selected="false">{{__('public/storepage.cat')}}</a>
             </li>
          {{--  @endif --}}
           {{-- @if($getStoreWidget->brand_list != '' && $getStoreWidget->brand_list != null ) --}}

             <li class="nav-item">
               <a class="nav-link font-13 success-link bg-promo1 mb-3" id="pills-contact-tab-ot" data-toggle="pill" href="#pills-contact-ot" role="tab" aria-controls="pills-contact-ot" aria-selected="false">{{__('public/storepage.brands')}}</a>
             </li>
           {{-- @endif --}}
         </ul>
         <div class="tab-content" id="pills-tabContent">
           <div class="tab-pane fade show active" id="pills-home-ab" role="tabpanel" aria-labelledby="pills-home-tab-ab">
               <div class="smilar-store-list pb-2">
                 <div class="row no-gutters">

                  {{--  @foreach(AppClass::getStoreByList($getStoreWidget->store_list) as $store) --}}
                    {{-- @php --}}
{{--
                      // $store_widget_img = ($store->store_logo != '')? asset('uploads/images/store').'/'.$store->store_logo : asset('uploads/images/no-image.jpg');
                      // $offercount = '0';
                      // if(!empty($store->offers_count)) {
                      //   $offercount = AppClass::getOffersCount($store->offers_count);
                      // }
                      //
                      --}}
                      {{-- @endphp --}}

                                        <div class="col-lg-6">
                      <a href="{{-- url('store/'.str_slug($store->store_slug)) --}}">
                       <div class="simi-store-box text-center">
                         <img src="{{-- $store_widget_img --}}">
                         <p class="secondary-text font-15 mb-0">{{-- $store->store_name --}}</p>
                         <p class="primary-text font-15">{{-- $offercount --}} Offers</p>
                       </div>
                       </a>
                     </div>
                     {{-- @endforeach--}}
                                   </div>
               </div>
             <div class="v-all-cb-list pt-2 mt-2 border-top">
               <a href="{{-- url(config('pageList.allStores')) --}}" class="primary-link">{{__('public/storepage.View_all') --}}
                <i class="fas fa-chevron-right float-right font-13 mt-1"></i></a>
             </div>
           </div>
           {{-- @if($getStoreWidget->category_list != '' && $getStoreWidget->category_list != null ) --}}

           <div class="tab-pane fade" id="pills-profile-pp" role="tabpanel" aria-labelledby="pills-profile-tab-pp">
             <div class="smilar-store-list pb-2">
               <div class="row no-gutters">
            {{--  @foreach(AppClass::getCatByList($getStoreWidget->category_list) as $cat) --}}
                   <div class="col-lg-6">
                    <a href="{{-- url('category/'.str_slug($cat->cat_slug)) --}}">
                     <div class="simi-store-box text-center">
                       <img src="{{--asset('uploads/images/category').'/'.$cat->cat_icon--}}">
                       <p class="secondary-text font-15 mb-0">
                         {{-- @if(!empty($cat->menu_name)) --}}
                          {{-- $cat->menu_name --}}
                        {{-- @else --}}
                          {{-- $cat->cat_name --}}
                      {{-- @endif --}}
                        </p>
                     </div>
                     </a>
                   </div>
              {{-- @endforeach --}}
               </div>
             </div>
             <div class="v-all-cb-list pt-2 mt-2 border-top">
               <a href="{{-- url(config('pageList.allCats')) -- }}" class="primary-link">{{__('public/storepage.View_all')}} <i class="fas fa-chevron-right float-right font-13 mt-1"></i></a>
             </div>
           </div>
           {{-- @endif --}}
         {{--@if($getStoreWidget->brand_list != '' && $getStoreWidget->brand_list != null )--}}
           <div class="tab-pane fade" id="pills-contact-ot" role="tabpanel" aria-labelledby="pills-contact-tab-ot">
             <div class="smilar-store-list pb-2">
               <div class="row no-gutters">
                 {{--@foreach(AppClass::getBrandByList($getStoreWidget->brand_list) as $brand) --}}
                    <div class="col-lg-6">
                    <a href="{{-- url('brand/'.str_slug($brand->brand_slug)) --}}">
                     <div class="simi-brand-box text-center">
                       <img src="{{--asset('uploads/images/brand').'/'.$brand->brand_icon--}}">
                       <p class="secondary-text font-15 mb-0">{{-- $brand->brand_name --}}</p>
                     </div>
                     </a>
                   </div>
                   {{--  @endforeach --}}

               </div>
             </div>
             <div class="v-all-cb-list pt-2 mt-2 border-top">
               <a href="{{-- url(config('pageList.allBrands')) --}}" class="primary-link">{{__('public/storepage.View_all')}} <i class="fas fa-chevron-right float-right font-13 mt-1"></i></a>
             </div>
           </div>
           {{--@endif--}}
         </div>
       </div>
      </div>
    {{--  @endif --}}
{{-- @endforeach --}}



{{-- 	@if(trim(config('settingConfig.ads_sidebar_2'))!='') --}}
		<div class="mb-4 gbands cat-filter-title border-bottom" id="gband-sidebar2">
		{{-- !! stripcslashes(config('settingConfig.ads_sidebar_2')) !! --}}
		</div>
{{-- @endif --}}
