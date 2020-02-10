@if(count($data['getfStores'] ) > 0 || count($data['getfCats'] ) > 0 || count($data['getfBrand'] ) > 0 || count($data['getfTag'] ) > 0)
<div class="d-block d-md-none">
  <div class="cat-filter-overlap"></div>
<div id="mySidenav" class="sidenav div-inner-white ">
  <a href="javascript:void(0)" class="closebtn text-dark" onclick="closeNav()">&times;</a>

  @if(count($data['getfStores'] ) > 0)
   <div class="mob-cat-filter p-3">
     <div class="mob-cat-filter-cont border-bottom pb-3">
      <div class="mob-cat-filter-title mb-3">
        <h6 class="text-dark font-18 fw-700">{{__('public/common.side_common_filter_store')}}</h6>
        <button type="button" onclick="closeNav()" name="button" class="btn btn-primary py-1 px-3 font-13">{{__('public/common.side_common_filter_mobile')}}</button>
      </div>
      <div id="store-filter" class="store-list-tag-category mt-2">
        @foreach($data['getfStores'] as $store)
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="fstoreiDs custom-control-input " name="storeIds[]" id="customCheck{{$store->store_id}}sm" value="{{$store->store_id}}">
            <label class="custom-control-label" for="customCheck{{$store->store_id}}sm">
              <a class="success-link font-15 fw-400" >{{$store->store_name}}</a></label>
          </div>
        @endforeach
        </div>
      </div>
    </div>
    @endif

  @if(count($data['getfCats'] ) > 0)
   <div class="mob-cat-filter p-3">
     <div class="mob-cat-filter-cont border-bottom pb-3">
      <div class="mob-cat-filter-title mb-3">
        <h6 class="text-dark font-18 fw-700">{{__('public/common.side_common_filter_cat')}}</h6>
        <button type="button" onclick="closeNav()" name="button" class="btn btn-primary py-1 px-3 font-13">{{__('public/common.side_common_filter_mobile')}}</button>
      </div>
      <div  id="cat-filter" class="store-list-tag-category mt-2">
     @foreach($data['getfCats'] as $storeCat)
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input fcatiDs" id="customCheck{{$storeCat->cat_id}}cm" value="{{$storeCat->cat_id}}">
            <label class="custom-control-label" for="customCheck{{$storeCat->cat_id}}cm">
              <a  class="success-link font-15 fw-400">{{$storeCat->cat_name}}</a></label>
          </div>
        @endforeach
        </div>
      </div>
    </div>
    @endif


    @if(count($data['getfBrand'] ) > 0)
     <div class="mob-cat-filter p-3">
       <div class="mob-cat-filter-cont border-bottom pb-3">
        <div class="mob-cat-filter-title mb-3">
          <h6 class="text-dark font-18 fw-700">{{__('public/common.side_common_filter_brand')}}</h6>
          <button type="button" onclick="closeNav()" name="button" class="btn btn-primary py-1 px-3 font-13">{{__('public/common.side_common_filter_mobile')}}</button>
        </div>
        <div class="store-list-tag-category mt-2"  id="brand-filter">
          @foreach($data['getfBrand'] as $brand)
            <div class="custom-control custom-checkbox">
              <input type="checkbox" class="custom-control-input fbrandiDs" id="customCheck{{$brand->brand_id}}bm" value="{{$brand->brand_id}}">
              <label class="custom-control-label" for="customCheck{{$brand->brand_id}}bm">
                <a class="success-link font-15 fw-400">{{$brand->brand_name}}</a></label>
            </div>
          @endforeach
          </div>
        </div>
      </div>
      @endif

      @if(count($data['getfTag'] ) > 0)
       <div class="mob-cat-filter p-3">
         <div class="mob-cat-filter-cont border-bottom pb-3">
          <div class="mob-cat-filter-title mb-3">
            <h6 class="text-dark font-18 fw-700">{{__('public/common.side_common_filter_tag')}}</h6>
            <button type="button" onclick="closeNav()" name="button" class="btn btn-primary py-1 px-3 font-13">{{__('public/common.side_common_filter_mobile')}}</button>
          </div>
          <div  class="store-list-tag-category mt-2" id="tag-filter">
            @foreach($data['getfTag'] as $tag)
              <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input ftagiDs" id="customCheck{{$tag->tag_id}}tm" value="{{$tag->tag_id}}">
                <label class="custom-control-label " for="customCheck{{$tag->tag_id}}tm">
                  <a  class="success-link font-15 fw-400">{{$tag->tag_name}}</a></label>
                </div>
            @endforeach
            </div>
          </div>
        </div>
        @endif
      </div>
  <!-- <div id="main">
    <span style="font-size:30px;cursor:pointer" onclick="openNav()"><i class="fa fa-filter"></i></span>
  </div> -->
</div>
@endif
