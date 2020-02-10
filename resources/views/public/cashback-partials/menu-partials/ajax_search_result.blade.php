@if($data['storeCount'] > 0)
<div class="search-view px-2">
  <span class="text-muted font-weight-bold">IN STORES</span><span class="s-store-count text-muted font-weight-bold">({{$data['storeCount']}})</span>

  <span class="float-right"><a href="{{url('all-stores')}}" style="text-decoration: underline; color: #5679fc;">View All Stores</a></span>
</div>


<div class="s-store-list mt-3">
  <div class="row">
    @foreach($data['storeData'] as $store)
      <div class="col-6 col-lg-2">
        <div class="s-store-box p-3 bg-white rounded text-center mb-3">
          <a href="{{url('store/'.str_slug($store->store_slug))}}">
          <div class="feature-store-logo">
            <img src="{{asset('uploads/images/store').'/'.$store->store_logo}}" alt="">
          </div>
          <p class="text-capitalize mb-2">{{$store->store_name}}</p>
          <div class="s-s-avail-offers text-muted">
        <?php
            $totalDeals   = 0;
            $totalCoupons = 0;
            $getData = explode('|',$store->offers_count);
            $totalCount = $getData[0];
            $totalDeals = $getData[2];
            $totalCoupons =  $getData[1];
            ?>
            <span>{{$totalCoupons}} Coupons |</span>
            <span>{{$totalCount}} Offers </span>
          </div>
        </a>
        </div>
      </div>
    @endforeach

  </div>
</div>
@endif

@if($data['catCount'] > 0)
<div class="search-cat mt-5">
<div class="search-view px-2 mb-3">
  <span class="text-muted font-weight-bold">IN CATEGORIES</span><span class="s-store-count text-muted font-weight-bold">({{$data['catCount']}})</span>
  <span class="float-right"><a href="{{url('all-coupon-categories')}}" style="text-decoration: underline; color: #5679fc;">View All Categories</a></span>
</div>
<div class="s-cat-list">
  <ul class="list-inline">
    @foreach($data['catData'] as $cat)
    <li class="list-inline-item">
      <a href="{{url('category/'.str_slug($cat->cat_slug))}}" class="btn btn-primary mb-2">
        {{$cat->cat_name}}
      </a>
    </li>
    @endforeach
  </ul>
</div>
</div>
@endif

@if( count($data['store_catData']) > 0)
<div class="search-cat mt-5">
<div class="search-view px-2 mb-3">
  <span class="text-muted font-weight-bold">IN STORE CATEGORIES</span><span class="s-store-count text-muted font-weight-bold">({{count($data['store_catData'])}})</span>
  <span class="float-right"><a href="{{url('all-store-categories')}}" style="text-decoration: underline; color: #5679fc;">View All Store Categories</a></span>
</div>
<div class="s-cat-list">
  <ul class="list-inline">
    @foreach($data['store_catData'] as $store_cat)
    <li class="list-inline-item">
      <a href="{{url('store-category/'.str_slug($store_cat->slug))}}" class="btn btn-primary mb-2">
        {{$store_cat->store_cat_name}}
      </a>
    </li>
    @endforeach
  </ul>
</div>
</div>
@endif

@if( count($data['tagData']) > 0)
<div class="search-cat mt-5">
<div class="search-view px-2 mb-3">
  <span class="text-muted font-weight-bold">IN TAGS</span><span class="s-store-count text-muted font-weight-bold">({{count($data['tagData'])}})</span>
  <span class="float-right"><a href="{{url('all-tags')}}" style="text-decoration: underline; color: #5679fc;">View All Tags</a></span>
</div>
<div class="s-cat-list">
  <ul class="list-inline">
    @foreach($data['tagData'] as $tag)
    <li class="list-inline-item">
      <a href="{{url('tag/'.str_slug($tag->tag_slug))}}" class="btn btn-primary mb-2">
        {{$tag->tag_name}}
      </a>
    </li>
    @endforeach
  </ul>
</div>
</div>
@endif

@if( count($data['brandData']) > 0)
<div class="search-cat mt-5">
<div class="search-view px-2 mb-3">
  <span class="text-muted font-weight-bold">IN BRANDS</span><span class="s-store-count text-muted font-weight-bold">({{count($data['brandData'])}})</span>
  <span class="float-right"><a href="{{url('all-brands')}}" style="text-decoration: underline; color: #5679fc;">View All brands</a></span>
</div>
<div class="s-cat-list">
  <ul class="list-inline">
    @foreach($data['brandData'] as $brand)
    <li class="list-inline-item">
      <a href="{{url('brand/'.str_slug($brand->brand_slug))}}" class="btn btn-primary mb-2">
        {{$brand->brand_name}}
      </a>
    </li>
    @endforeach
  </ul>
</div>
</div>
@endif
