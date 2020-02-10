@if(count($data['getfStores'] ) > 0 || count($data['getfCats'] ) > 0 || count($data['getfBrand'] ) > 0 || count($data['getfTag'] ) > 0)
<div class="scrollingBox filters-sidebar p-3 mb-4 div-inner-white rounded d-none d-md-block">
   <div class="sidebar-main-search">
       <p class="text-dark font-18 fw-700">{{__('public/common.side_common_filter')}}</p>
   </div>
   <div class="filters-tab">
    <ul class="nav nav-pills nav-justified mb-0" id="pills-tab" role="tablist">
     @if(count($data['getfStores']) > 0)
       <li class="nav-item">
         <a class="nav-link @if($data['activeStore']) active @endif font-13 success-link bg-promo1 mr-2 mb-3" id="pills-store-tab" data-toggle="pill" href="#pills-store" role="tab" aria-controls="pills-store" aria-selected="true">{{__('public/common.common_store_name')}}</a>
       </li>
     @endif
     @if(count($data['getfCats'] ) > 0)
       <li class="nav-item">
         <a class="nav-link @if($data['activeCats']) active @endif font-13 success-link bg-promo1 mr-2 mb-3" id="pills-cat-tab" data-toggle="pill" href="#pills-cat" role="tab" aria-controls="pills-cat" aria-selected="true">{{__('public/common.common_cat_name')}}</a>
       </li>
     @endif
     @if(count($data['getfBrand'] ) > 0)
       <li class="nav-item">
         <a class="nav-link @if($data['activeBrand']) active @endif font-13 success-link bg-promo1 mr-2 mb-3" id="pills-brand-tab" data-toggle="pill" href="#pills-brand" role="tab" aria-controls="pills-brand" aria-selected="true">{{__('public/common.common_brand_name')}}</a>
       </li>
     @endif
     @if(count($data['getfTag'] ) > 0)
       <li class="nav-item">
         <a class="nav-link @if($data['activeTag']) active @endif font-13 success-link bg-promo1 mr-2 mb-3" id="pills-tag-tab" data-toggle="pill" href="#pills-tag" role="tab" aria-controls="pills-tag" aria-selected="true">{{__('public/common.common_tag_name')}}</a>
       </li>
     @endif
   </ul>

   <div class="tab-content" id="pills-tabContent">
      @if(count($data['getfStores'] ) > 0)
       <div class="tab-pane fade @if($data['activeStore']) show active @endif" id="pills-store" role="tabpanel" aria-labelledby="pills-store-tab">
        <div class="store-filter pt-3">
          <div class="filter-title mb-3 position-relative">
            <h4 class="text-dark font-18 fw-700 mb-3">{{__('public/common.side_common_filter_store')}}</h4>
            <span class="icon-Search-grey-icon side-search"></span>
            <input type="text" name="" value=""    id="searchStore" class="sidebar-main-search form-control border-0 bg-promo1 mb-2" placeholder="{{__('public/common.side_common_search_placeholder')}}">
          </div>
          <div class="filter-disc f-cont" id="store-filter">
            @foreach( $data['getfStores'] as $store)
               <div class="custom-control custom-checkbox mb-2" id="{{$store->store_id}}" >
                 <input type="checkbox" class="fstoreiDs custom-control-input " name="storeIds[]" id="customCheck{{$store->store_id}}s" value="{{$store->store_id}}">
                 <label class="custom-control-label font-15 secondary-text fw-400" for="customCheck{{$store->store_id}}s">{{$store->store_name}}</label>
               </div>
            @endforeach
          </div>
        </div>
      </div>
      @endif
      @if(count($data['getfCats'] ) > 0)
       <div class="tab-pane fade @if($data['activeCats']) show active @endif" id="pills-cat" role="tabpanel" aria-labelledby="pills-cat-tab">
        <div class="cat-filter pt-3">
          <div class="filter-title mb-3 position-relative">
            <h4 class="text-dark font-18 fw-700 mb-3">{{__('public/common.side_common_filter_cat')}}</h4>
            <span class="icon-Search-grey-icon side-search" ></span>
            <input type="text" id="searchCat" name="" value="" class="sidebar-main-search form-control border-0 bg-promo1 mb-2" placeholder="{{__('public/common.side_common_search_placeholder')}}">
          </div>
          <div class="filter-disc f-cont"  id="cat-filter">
            @foreach($data['getfCats'] as $storeCat)
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input fcatiDs" id="customCheck{{$storeCat->cat_id}}c" value="{{$storeCat->cat_id}}">
                <label class="custom-control-label font-15 secondary-text fw-400" for="customCheck{{$storeCat->cat_id}}c">{{$storeCat->cat_name}}</label>
              </div>
          @endforeach
          </div>
        </div>
      </div>
      @endif
      @if(count($data['getfBrand'] ) > 0)
       <div class="tab-pane fade @if($data['activeBrand']) show active @endif" id="pills-brand" role="tabpanel" aria-labelledby="pills-brand-tab">
        <div class="brand-filter pt-3">
          <div class="filter-title mb-3 position-relative">
            <h4 class="text-dark font-18 fw-700 mb-3">{{__('public/common.side_common_filter_brand')}}</h4>
            <span class="icon-Search-grey-icon side-search"></span>
            <input type="text"  id="searchBrand" name="" value="" class="sidebar-main-search form-control border-0 bg-promo1 mb-2" placeholder="{{__('public/common.side_common_search_placeholder')}}">
          </div>
          <div class="filter-disc f-cont"   id="brand-filter">
            @foreach($data['getfBrand'] as $brand)
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input fbrandiDs" id="customCheck{{$brand->brand_id}}b" value="{{$brand->brand_id}}">
                <label class="custom-control-label font-15 secondary-text fw-400" for="customCheck{{$brand->brand_id}}b">{{$brand->brand_name}}</label>
              </div>
          @endforeach
          </div>
        </div>
      </div>
      @endif
      @if(count($data['getfTag'] ) > 0)
       <div class="tab-pane fade @if($data['activeTag']) show active @endif" id="pills-tag" role="tabpanel" aria-labelledby="pills-tag-tab">
        <div class="tag-filter pt-3">
          <div class="filter-title mb-3 position-relative">
            <h4 class="text-dark font-18 fw-700 mb-3">{{__('public/common.side_common_filter_tag')}}</h4>
            <span class="icon-Search-grey-icon side-search"></span>
            <input type="text"    id="searchTag" name="" value="" class="sidebar-main-search form-control border-0 bg-promo1 mb-2" placeholder="{{__('public/common.side_common_search_placeholder')}}">
          </div>
          <div class="filter-disc f-cont"  id="tag-filter">
           @foreach($data['getfTag'] as $tag)
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input ftagiDs" id="customCheck{{$tag->tag_id}}t" value="{{$tag->tag_id}}">
                <label class="custom-control-label font-15 secondary-text fw-400" for="customCheck{{$tag->tag_id}}t">{{$tag->tag_name}}</label>
              </div>
          @endforeach
          </div>
        </div>
      </div>
      @endif
   </div>
 </div>
</div>
@endif
