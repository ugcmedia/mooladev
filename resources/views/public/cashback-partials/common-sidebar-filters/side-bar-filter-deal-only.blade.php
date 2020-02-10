@if( count($data['getfDealCats'] ) > 0 )

<div class="scrollingBox filters-sidebar p-3 mb-4 div-inner-white rounded d-none d-md-block ">
   <div class="sidebar-main-search">
       <!-- <p class="text-dark font-18 fw-700">{{__('public/common.side_common_filter')}}</p> -->
   </div>
   <div class="filters-tab">
    <!-- <ul class="nav nav-pills nav-justified mb-0" id="pills-tab" role="tablist">

     @if(count($data['getfDealCats'] ) > 0)
       <li class="nav-item">
         <a class="nav-link  active font-13 success-link bg-promo1 mr-2 mb-3" id="pills-cat-tab" data-toggle="pill" href="#pills-cat" role="tab" aria-controls="pills-cat" aria-selected="true">{{__('public/common.common_cat_name')}}</a>
       </li>
     @endif
   </ul> -->

   <div class="tab-content" id="pills-tabContent">
      @if(count($data['getfDealCats'] ) > 0)
       <div class="tab-pane fadeshow active " id="pills-cat" role="tabpanel" aria-labelledby="pills-cat-tab">
        <div class="cat-filter pt-3">
          <div class="filter-title mb-3 position-relative">
            <h4 class="text-dark font-18 fw-700 mb-3">{{__('public/common.side_common_filter_cat')}}</h4>
            <span class="icon-Search-grey-icon side-search" ></span>
            <input type="text" id="search-deal-Cat" name="" value="" class="sidebar-main-search form-control border-0 bg-promo1 mb-2" placeholder=" {{__('public/common.side_common_search_placeholder')}}">
          </div>
          <div class="filter-disc f-cont"  id="deal-cat-filter">
            @foreach($data['getfDealCats'] as $storeCat)
              <div class="custom-control custom-checkbox mb-2">
                <input type="checkbox" class="custom-control-input fdealcatiDs" id="customDealCheck{{$storeCat->cat_id}}c" value="{{$storeCat->cat_id}}">
                <label class="custom-control-label font-15 secondary-text fw-400" for="customDealCheck{{$storeCat->cat_id}}c">{{$storeCat->cat_name}}</label>
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
