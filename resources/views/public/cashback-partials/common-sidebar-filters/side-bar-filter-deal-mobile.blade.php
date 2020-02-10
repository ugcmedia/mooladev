@if( count($data['getfDealCats'] ) > 0)
<div class="d-block d-md-none">
  <div class="cat-filter-overlap "></div>
<div id="mySidenavdeal" class="sidenav div-inner-white ">
  <a href="javascript:void(0)" class="closebtn text-dark" onclick="closeNav()">&times;</a>
  @if(count($data['getfDealCats'] ) > 0)
   <div class="mob-cat-filter p-3">
     <div class="mob-cat-filter-cont border-bottom pb-3">
      <div class="mob-cat-filter-title mb-3">
        <h6 class="text-dark font-18 fw-700">{{__('public/common.side_common_filter_cat')}}</h6>
        <button type="button" onclick="closeNav()" name="button" class="btn btn-primary py-1 px-3 font-13">{{__('public/common.side_common_filter_mobile')}}</button>
      </div>
      <div  id="cat-filter" class="store-list-tag-category mt-2">
     @foreach($data['getfDealCats'] as $storeCat)
          <div class="custom-control custom-checkbox">
            <input type="checkbox" class="custom-control-input fdealcatiDs" id="customDealCheck{{$storeCat->cat_id}}dcm" value="{{$storeCat->cat_id}}">
            <label class="custom-control-label" for="customDealCheck{{$storeCat->cat_id}}dcm">
              <a  class="success-link font-15 fw-400">{{$storeCat->cat_name}}</a></label>
          </div>
        @endforeach
        </div>
      </div>
    </div>
    @endif
    </div>

<div id="main">
  <span style="font-size:30px;cursor:pointer" onclick="openNav()"><i class="fa fa-filter"></i></span>
</div>
</div>
@endif
