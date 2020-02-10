@extends('public.layouts.app')
@section('title')
  All Stores
@endsection
@section('meta')
@endsection
@section('content')

<section class="cat-main-content">

<section class=" bg-white  py-5 hit-hero-banner" style="  background-image: url('http://moola101.ga/uploads/images/category-wise-vendore.jpg');">
    <div class="container">

      <div class="page-navigation">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb p-0 mb-2">
            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('public/homepage.home') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('public/homepage.all_store') }}</li>
          </ol>
        </nav>
      </div>


      <div class="hero-banner-cont ">
        <div class="row">
          <div class="col-md-12">
            <div class="st-title">
               <h1 class="font-48"><span class="fw-700 text-white">{{__('public/homepage.all_store') }}</span></h1>
               <div class="text-white">
                   <p class="text-white font-14 fw-400 ">  {{__('public/homepage.all_store_desc') }}</p>
             </div>
          </div>
        </div>
      </div>
</section>



<section class="cat-bottom mt-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-4">


<!-- Ceetgery Start -->
        <div class="store-sidebar-cont">
          <div class="store-cb-cont p-3 bg-white rounded shadow-sm mb-4">
            <!-- <div class="card border-0 rounded mt-4">
            <div class="card-body"> -->
            <div class="filters-tab">

              <!-- <ul class="nav nav-pills nav-justified mb-0" id="pills-tab" role="tablist">
                <li class="nav-item ">
                  <a class="nav-link font-13 success-link bg-promo1 mr-2 mb-3 active show" id="pills-store-tab" data-toggle="pill" href="#pills-store" role="tab" aria-controls="pills-store" aria-selected="true">Stores</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link font-13 success-link bg-promo1 mr-2 mb-3" id="pills-cat-tab" data-toggle="pill" href="#pills-cat" role="tab" aria-controls="pills-cat" aria-selected="false">Category</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link font-13 success-link bg-promo1 mr-2 mb-3" id="pills-tag-tab" data-toggle="pill" href="#pills-tag" role="tab" aria-controls="pills-tag" aria-selected="false">Tags</a>
                </li>
              </ul> -->

                <!-- store -->
                <!-- <div class="tab-pane fade active show" id="pills-store" role="tabpanel" aria-labelledby="pills-store-tab">
                  <div class="store-filter pt-3">
                    <div class="filter-title mb-3 position-relative">
                      <h4 class="text-dark font-18 fw-700 mb-3">Filter by Store</h4>
                      <span class="icon-Search-grey-icon side-search"></span>
                      <input type="text" name="" value="" id="searchStore" class="sidebar-main-search form-control border-0 bg-promo1 mb-2" placeholder="Search filters">
                    </div>
                    <div class="filter-disc f-cont" id="store-filter">
                      <div class="custom-control custom-checkbox mb-2" id="1002">
                        <input type="checkbox" class="fstoreiDs custom-control-input " name="storeIds[]" id="customCheck1002s" value="1002">
                        <label class="custom-control-label font-15 secondary-text fw-400" for="customCheck1002s">Amazon</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-2" id="1003">
                        <input type="checkbox" class="fstoreiDs custom-control-input " name="storeIds[]" id="customCheck1003s" value="1003">
                        <label class="custom-control-label font-15 secondary-text fw-400" for="customCheck1003s">Flipkart</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-2" id="1007">
                        <input type="checkbox" class="fstoreiDs custom-control-input " name="storeIds[]" id="customCheck1007s" value="1007">
                        <label class="custom-control-label font-15 secondary-text fw-400" for="customCheck1007s">Snapdeal</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-2" id="1014">
                        <input type="checkbox" class="fstoreiDs custom-control-input " name="storeIds[]" id="customCheck1014s" value="1014">
                        <label class="custom-control-label font-15 secondary-text fw-400" for="customCheck1014s">ShopClues</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-2" id="1067">
                        <input type="checkbox" class="fstoreiDs custom-control-input " name="storeIds[]" id="customCheck1067s" value="1067">
                        <label class="custom-control-label font-15 secondary-text fw-400" for="customCheck1067s">Infibeam</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-2" id="1135">
                        <input type="checkbox" class="fstoreiDs custom-control-input " name="storeIds[]" id="customCheck1135s" value="1135">
                        <label class="custom-control-label font-15 secondary-text fw-400" for="customCheck1135s">Croma Retail</label>
                      </div>
                      <div class="custom-control custom-checkbox mb-2" id="1247">
                        <input type="checkbox" class="fstoreiDs custom-control-input " name="storeIds[]" id="customCheck1247s" value="1247">
                        <label class="custom-control-label font-15 secondary-text fw-400" for="customCheck1247s">Greendust</label>
                      </div>
                    </div>
                  </div>
                </div> -->
                <!-- Category -->
                <div class="tab-pane fade active show" id="pills-cat" role="tabpanel" aria-labelledby="pills-cat-tab">
                  <div class="cat-filter pt-3">
                    <div class="filter-title mb-3 position-relative">
                      <h4 class="text-dark font-18 fw-700 mb-3">{{__('public/allstore.filterbycategory') }} </h4>
                      <span class="icon-Search-grey-icon side-search"></span>
                      <input type="text" id="searchBrand" name="" value="" class="sidebar-main-search form-control border-0 bg-promo1 mb-2" placeholder="Search filters">
                    </div>
                    <div class="filter-disc f-cont" id="cat-filter">
                        @foreach($data['category']	 as $temp)
                        <div class="custom-control custom-checkbox mb-2" id="{{$temp->cat_id}}">
                          <input type="checkbox" class="fbrandiDs custom-control-input " name="storeIds[]" id="customCheck{{$temp->cat_id}}s" value="{{$temp->cat_id}}">
                          <label class="custom-control-label font-15 secondary-text fw-400" for="customCheck{{$temp->cat_id}}s">{{$temp->cat_name}}</label>
                        </div>
                      @endforeach
                    </div>
                  </div>

                </div>

                  <div class="cat-filter pt-3 " >
                    <div class="filter-title mb-3 position-relative">
                      <h4 class="text-dark font-18 fw-700 mb-3">{{__('public/allstore.filterbylocation') }} </h4>
                      <span class="icon-Search-grey-icon side-search"></span>
                      <input type="text" id="searchBrand" name="" value="" class="sidebar-main-search form-control border-0 bg-promo1 mb-2" placeholder="Search Locations">
                    </div>
                    <div class="filter-disc f-cont" id="cat-filter">
                        @foreach($data['locations']	 as $location)
                        <div class="custom-control custom-checkbox mb-2" id="{{$location->location_id}}">
                          <input type="checkbox" class="flocationiDs custom-control-input " name="storelocationsIDs[]" id="customCheck{{$location->location_id}}l" value="{{$location->location_id}}">
                          <label class="custom-control-label font-15 secondary-text fw-400" for="customCheck{{$location->location_id}}l">{{$location->area_name}}</label>
                        </div>
                      @endforeach
                    </div>

              </div>
            </div>
          </div>
        </div>
<!-- Ceetgery End -->


<!-- featured_stores Start -->

        <div class="bg-white p-3 rounded shadow-sm mb-4 fStoresBox">
          <div class="mb-3">
            <h4 class="text-dark font-18 fw-700 float-left"> {{__('public/cashback.featuread_store')}} </h4>
            <a class="float-right" href="#" align="right"> {{__('public/cashback.view_all')}}</a>
          </div>
          <div class="clearfix">
          </div>
          <div class="row">
            @foreach ($data['featured_stores'] as $fStores)
            <?php
            $fStoreImg = asset($fStores->outlet_primary_image);
            ?>
                <div class="col-sm-6 h-100 mb-3">
                  <a href="{{url('vendor').'/'.$fStores->vendor_slug}}">
                    <div class="storeItem py-4 rounded " style="background-image: url('{{$fStoreImg}}');">
                      <div class="overlay"></div>
                      <h4>{!!$fStores->vendor_name!!} </h4>
                    </div>
                  </a>
                </div>
              @endforeach
            </div>
        </div>

<!-- featured_stores End -->



<!-- Releted_stores Start -->

        <div class="bg-white p-3 rounded shadow-sm mb-4 fStoresBox">
          <div class="mb-3">
            <h4 class="text-dark font-18 fw-700 float-left"> {{__('public/allstore.related_store') }} </h4>
            <a class="float-right" href="#" align="right"> {{__('public/cashback.view_all')}}</a>
          </div>
          <div class="clearfix">

          </div>


          <div class="row">
            @foreach ($data['featured_stores'] as $fStores)
            <?php
            $fStoreImg = asset($fStores->outlet_primary_image);
            ?>
                <div class="col-sm-6 h-100 mb-3">
                  <a href="{{url('vendor').'/'.$fStores->vendor_slug}}">
                    <div class="storeItem py-4 rounded " style="background-image: url('{{$fStoreImg}}');">
                      <div class="overlay"></div>
                      <h4>{!!$fStores->vendor_name!!}</h4>
                    </div>
                  </a>

                  </div>
              @endforeach

            </div>


        </div>

<!-- Releted_stores End -->





  </div>


      <div class="col-lg-9 col-md-8">
            <div class="cat-all-deals" id="cat-all-deals">
                <div class="row" id="Mydata">

                      @foreach($data['returnArray']['totalRecords'] as $fStores)
                              <div class="col-lg-4 col-sm-6 mb-3">
                                    @include('public/cashback-partials/store-box')
                              </div>
                      @endforeach

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </section>
              <script type="text/javascript" src="{{asset('public_assets/js/home.js')}}" ></script>
              <script type="text/javascript" src="{{asset('public_assets/js/category.js')}}"></script>

              <script>
              // jQuery(function($) {
              //   var alphaList = [];
              //   $('.store-card').each( function(e){
              //     alphaList.push(($(this).data('alpha')));
              //   } );
              //   alphaList= jQuery.unique (alphaList).sort();
              //
              //   $('#alpha-filter').append('<a class="nav-link active" id="nlAll" href="javascript:void(0)" onClick="filterAlpha(\'#\')">All</a> ');
              //   $.each(alphaList, function( index, value ) {
              //     $('#alpha-filter').append('<a class="nav-link" id="nl'+value+'" href="javascript:void(0)" onClick="filterAlpha(\''+value+'\')">'+value+'</a> ');
              //   });
              //
              // });

              // function filterAlpha(alpha)
              // {
              //   if(alpha=='#')
              //   { $('.store-card').show(); $('.nav-link').removeClass('active'); $('#nlAll').addClass('active');  }
              //   else
              //   {
              //     $('.store-card').hide();
              //
              //     $(".store-card[data-alpha='"+alpha+"']").show();
              //
              //     $('.nav-link').removeClass('active'); $('#nl'+alpha).addClass('active');
              //   }
              //
              // }

            </script>
            @endsection
