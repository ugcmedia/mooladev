@php
$mobileDetection = new MobileDetect();
@endphp
@extends('public.layouts.app')
@section('title')
  {!! $data['catename'] !!}

@endsection
@section('meta')
  <meta name="description" content="" >
  <meta name="keywords" content="">
  @php $img = AppClass::getMetaImg(null,'no-img') @endphp
  <meta property="og:image" content="{{$img}}" />
  <meta property="og:title" content="" />
  <meta property="og:url" content="{{URL::current()}}" />
  <meta property="og:description" content="" />
  <meta property="og:site_name" content="{{config('sximo.cnf_appname')}}" />
@endsection
@section('content')

<?php
if(!$mobileDetection->isMobile())
  $pageimage = asset('public_assets/images/page-header-bg.jpg');
else
  $pageimage = asset('public_assets/images/mobile-page-header-bg.jpg');

if(!empty($data['banner_img'])) {
  if($mobileDetection->isMobile()) {
    $pageimage = asset('uploads/images').'/mobile-'.$data['banner_img'];
  } else {
    $pageimage = asset('uploads/images').'/'.$data['banner_img'];
  }
}
?>
<section class="sec-page-header" style="background-image:url('{{$pageimage}}')">
  <div class="container">
    <!-- <div class="row">
      <div class="col-lg-12">
        <div class="db-breadcrumb">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('public/storepage.home')}}</a></li>
              <li class="breadcrumb-item"><a href="{{url('all-coupon-categories')}}">{{__('public/store_cat.store_categories')}}</a></li>
              <li class="breadcrumb-item active" aria-current="page">{{$data['catename']}}</li>
            </ol>
          </nav>
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="col-lg-7 col-md-8">
        <h1 class="page-title-h1">{{$data['catename']}} <span class="primary-text">Stores</span></h1>
        <p>{!! $data['main_desc'] !!}</p>
      </div>
    </div>
  </div>
</section>
<section class="py-5">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-4">
        <div class="category-filter clearfix bg-white rounded p-3 mb-4 list-group allsidebar-links">
          <div class="d-none1 d-md-block1 p-0">
            <p class="text-dark font-18 fw-700 mb-2">{{__('public/store_cat.store_categories')}}</p>
          <div class="cat-stores-list">
            <div class="list-group">
              <!-- <a href="#" class="list-group-item"><span class="pl-2 mb-0">{{__('public/store_cat.store_categories')}}</span></a> -->

               @foreach(AppClass::getStoreCategoryOrder( config('settingConfig.listing_storecat_order') ) as $cat)
                <a href="{{url('store-category/'.str_slug($cat->slug))}}" class="list-group-item py-2 {{($data['cateslug'] == $cat->slug) ? 'active' : '' }}">
                  <img src="{{asset('uploads/images/category/'.$cat->store_cat_icon)}}" height="20px" width="20px"> <span class="ml-2">{{$cat->store_cat_name}}</span>
                </a>
              @endforeach
            </div>
          </div>
          </div>
        </div>
      </div>
      <div class="col-lg-9 col-md-8">

	  <div class="all-store-alpha-wrapper my-3">
      <nav class="alpha-filter-nav nav py-2" id="alpha-filter">
      </nav>

		</div>

        <div class="row row-eq-height">
              @foreach($data['stores'] as $store)
                <?php
                $coupons = "No Coupons";
                $offers = "No Offers";
                if(!empty($store->offers_count)) {
                  $cp_count = explode('|',$store->offers_count);
                  if(count($cp_count) > 0) {
                    $coupons = $cp_count[1]." Coupons";
                    $offers = $cp_count[2]." Offers";
                  }

                }
                ?>

              <div class="col-lg-4 col-md-4 store-card" data-alpha="{{strtoupper(substr($store->store_name,0,1))}}">
              <div class="st-result singleStoreCat">
               <ul class="list-unstyled mb-0" style="width:100%;">
                <li><a href="{{url('store/'.str_slug($store->store_slug))}}" name="{{substr($store->store_name,0,1)}}"><strong>{{$store->store_name}}</strong></a></li>
                <li class="text-muted mt-2">{{$coupons}} | {{$offers}} </li>
                @if($store->cashback_enabled == 'Y')
                  @if($store->cashback != '')
                    <li class="mt-2"><div class="s-cpn-cb primary-text">
                      <span class="font-16 icon-percentage2-icon v-middle mr-1"></span>
                      {{AppClass::getUptoText($store->cashback,$store->cashback_type)}}
                    </div></li>
                  @else
                      <li class="mt-2"><br></li>
                  @endif
                @else
                  <li class="mt-2"><br></li>
                @endif
                <li class="mt-2 text-center text-uppercase ">
                  <!-- <a href="javascript:void(0)" onclick="openAjaxPopup(1040,'store','{{route('getAjaxPopup.common')}}')">
          <button type="button" class="shadow-btn btn btn-secondary text-uppercase font-12 fw-700 p-3 px-5">VISIT Goibibo</button>
        </a> -->
                  <a href="javascript:void(0)" onclick="openAjaxPopup({{$store->store_id}},'store','{{$store->cashback_enabled}}' )" class="btn btn-primary" role="button"> <span class="text-capitalize">{{__('public/storepage.visit_btn')}}</span>  {{$store->store_name}} </a>
                </li>
                </ul>
              </div>
              </div>
                @endforeach

             </div>

      </div>

    </div>

  </div>

</section>

<!-- <div class="merchant-banner-cont pt-3 pt-sm-0 py-3 py-sm-0">
  <div class="container">
  <div class="db-breadcrumb">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('public/storepage.home')}}</a></li>
        <li class="breadcrumb-item"><a href="{{url('all-coupon-categories')}}">{{__('public/store_cat.store_categories')}}</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{$data['catename']}}</li>
      </ol>
    </nav>
  </div>

  <div class="merchant-b-detail">
  <div class="row">
    <div class="col-lg-3 col-md-4">
        <div class="merchant-info bg-white text-center">
          <div class="merchant-title d-none d-sm-block">
            <img src="{{asset('uploads/images/category/'.$data['caticon'])}}" alt="" width="80%">
          </div>
        </div>
    </div>

    <div class="col-lg-9 col-md-8">
      <div class="merchent-offers-title mt-3 mt-lg-0 mt-md-0 text-white">
          <h1 class=" text-capitalize">{{$data['catename']}}</h1>
            <div class="d-none d-lg-inline-flex d-md-inline-flex">
                @if(strip_tags($data['main_desc']) != '' || strip_tags($data['main_desc']) != null)
        					  <div id="title-discs" class="title-main title-disc">
                          {!! $data['main_desc'] !!}
        				    </div>
                  <div class="">
                    <a class="disc-collapsed" id="read-moreDesc">{{__('public/store_cat.read_more')}}</a>
                  </div>
                  @endif
    					</div>
          </div>

          <div class="clearfix pt-3">
            <span class="subscribe-link">
              <ul class="list-inline">
                      @include('public/cashback-partials.howitworks')

                      <li class="list-inline-item text-capitalize mr-2">

                       @if(Auth::guard('member')->check())
                            <a href="#0"  id="s-subscribe-mdl" onclick="addFollow({{$data['catid']}},'store-cat','{{route('add.subscribe')}}')"><i class="fa fa-envelope-o pr-2" ></i> {{__('public/store_cat.subscribe_to',['catname' => $data['catename']])}}  </a>
                            <a href="{{route('member.favourites')}}" class="hidden"  id="already-sub"><i class="fa fa-envelope-o pr-2" ></i> {{__('public/category.already_subscribe'),['catname' => $data['catename']]}}  </a>
                         @else
                          <a href="#0" data-toggle="modal" id="s-subscribe-mdl" data-toggle="modal" data-target="#login-modal"><i class="fa fa-envelope-o pr-2" ></i> {{__('public/store_cat.subscribe_to',['catname' => $data['catename']])}} </a>
                       @endif

                      <div class="modal fade bd-example-modal-sm-s-sub-mdl" id="s-subscribe-mdl" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-header">

                              <span class="modal-title" id="exampleModalLabel">{{__('public/store_cat.subscribe_to')}} {{$data['catename']}}

                              </span>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                              </button>
                            </div>
                             <div class="modal-body">
                            <p style="font-size: 15px;">{{__('public/storepage.enter_Email_id')}}</p>
                            <input type="email" class="form-control" placeholder="Enter Email" name="">
                            <div class="my-3 text-center">
                            <button type="button" class="btn btn-primary">{{__('public/storepage.send_btn')}}</button>
            </div>
        </div>
      </div>
   </div>
  </div>
</li>

                    </ul></span></div>
                  </div>
                </div>

              </div>
            </div>
            </div> -->
<!-- <div class="container">
  <div class="row">
      <div class="col-lg-3 col-md-4">
        <div class="category-filter clearfix bg-white my-3 rounded">
          <div class=" d-none d-md-block p-0" style="position: static; top: 76px;">
          <div class="cat-stores-list">
            <div class="list-group">
              <a href="#" class="list-group-item"><span class="pl-2 mb-0">{{__('public/store_cat.store_categories')}}</span></a>
               @foreach(AppClass::getStoreCategory() as $cat)
                <a href="{{url('store-category/'.str_slug($cat->slug))}}" class="list-group-item">
                <img src="{{asset('uploads/images/category/'.$cat->store_cat_icon)}}" height="20px" width="20px"> {{$cat->store_cat_name}}
              </a>
              @endforeach
            </div>
          </div>
          </div>
        </div>
      </div>

      <div class="col-lg-9 col-md-8 my-3">

      <div class="row">
        @foreach($data['stores'] as $store)
        <?php
        // $coupons = "No Coupons";
        // $offers = "No Offers";
        // if(!empty($store->offers_count)) {
        //   $cp_count = explode('|',$store->offers_count);
        //   if(count($cp_count) > 0) {
        //     $coupons = $cp_count[1];
        //     $offers = $cp_count[2];
        //   }
        //
        // }
        ?>

        <div class="col-md-6 col-lg-4 col-sm-6">
          <div class="st-result st-result-cat">
          <ul class="list-unstyled mb-0">
            <li><strong>{{$store->store_name}}</strong></li>

            <li class="best-store">
               @if($store->cashback_enabled == 'Y')
               @if($store->cashback != '')
              <img src="{{asset('uploads/common/cash.svg')}}" alt=""> <span class="st-cb">{{AppClass::getUptoText($store->cashback,$store->cashback_type)}}</span>
               @endif
                @endif

            </li>
            <li class="text-muted mt-2"> {{__('public/store_cat.available',['coupon' => $coupons,'offer'=>$offers ])}}</li>

          </ul>
          <div class="shp-now-btn my-2 text-center">
            <a href="{{url('store/'.str_slug($store->store_slug))}}" class="btn btn-primary" role="button">{{__('public/category.shop_now_btn')}}</a>
          </div>
          </div>
          </div>
           @endforeach

          </div>


      </div>
    </div>
  </div> -->

<script type="text/javascript">

  jQuery(function($) {
  $('#already-sub').hide();
  checkSubscribed(<?php echo $data['catid']; ?>,'store-cat',"{{route('check.subscribe')}}");
  });

</script>


<script>
jQuery(function($) {
	var alphaList = [];
$('.store-card').each( function(e){
	 alphaList.push(($(this).data('alpha')));
} );
alphaList= jQuery.unique (alphaList).sort();

	$('#alpha-filter').append('<a class="nav-link active" id="nlAll" href="javascript:void(0)" onClick="filterAlpha(\'#\')">All</a> ');
	$.each(alphaList, function( index, value ) {
		$('#alpha-filter').append('<a class="nav-link" id="nl'+value+'" href="javascript:void(0)" onClick="filterAlpha(\''+value+'\')">'+value+'</a> ');
	});

});

function filterAlpha(alpha)
{
	if(alpha=='#')
	{ $('.store-card').show(); $('.nav-link').removeClass('active'); $('#nlAll').addClass('active');  }
		else
		{
			$('.store-card').hide();

			$(".store-card[data-alpha='"+alpha+"']").show();

			$('.nav-link').removeClass('active'); $('#nl'+alpha).addClass('active');
		}

}

</script>
@endsection
