<?php $mobileDetection = new MobileDetect();  ?>
@extends('public.layouts.app')
@section('title')
  {!! $data['pageInfo']->title!!}
@endsection
@section('meta')
  <meta name="description"  content="{!! $data['pageInfo']->metadesc!!}" >
  <meta name="keywords" content="{!! $data['pageInfo']->metakey!!}">
  @php $img = AppClass::getMetaImg($data['pageInfo'],'pages') @endphp
  <meta property="og:image" content="{{$img}}" />
  <meta property="og:title" content="{!! $data['pageInfo']->meta_title !!}" />
  <meta property="og:url" content="{{URL::current()}}" />
  <meta property="og:description" content="{!! $data['pageInfo']->metadesc!!}" />
  <meta property="og:site_name" content="{{config('sximo.cnf_appname')}}" />
@endsection

@section('content')
<?php
if(!$mobileDetection->isMobile())
  $pageimage = asset('public_assets/images/page-header-bg.jpg');
else
  $pageimage = asset('public_assets/images/mobile-page-header-bg.jpg');

if(!empty($data['pageInfo']->image)) {
  if($mobileDetection->isMobile()) {
    $pageimage = asset('uploads/images').'/mobile-'.$data['pageInfo']->image;
  } else {
    $pageimage = asset('uploads/images').'/'.$data['pageInfo']->image;
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
            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('public/listing.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__('public/listing.all_brands')}}</li>
          </ol>
          </nav>
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="col-lg-6 col-md-8">
        <h1 class="page-title-h1">
          {!! $data['pageInfo']->title!!} with <span class="primary-text">Cashback</span>, <span class="promo-text">Coupons</span> & <span class="text-green">Promo Codes</span></h1>
          <p>{!! $data['pageInfo']->note!!}</p>
      </div>
    </div>
  </div>
</section>

<section class="py-5">
  <div class="container">

   <div class="row">
    <div class="col-lg-3 col-md-4">
      <!-- <div class="merchant-data bg-white border-top  mb-4">
       <div class="merchant-data-cont p-3 ">
        <p class="mb-0">{{__('public/listing.total')}} {{__('public/listing.brands')}}:</p>
        <span><strong>
         {{count($getBrand)}}
        </strong></span>

      </div>
      </div> -->
      @include('public.cashback-partials.allSideBar')
    </div>
    <div class="col-lg-9 col-md-8">
      <span class="pt-0 text-capitalize h2">{{__('public/listing.browse_all_brands')}}</span>
       <div class="all-store-alpha-wrapper my-3">
      <nav class="alpha-filter-nav nav py-2" id="alpha-filter">
      </nav>

		</div>

    <div class="row">
          @foreach($getBrand->sortBy('brand_name') as $brand)
            <?php
            $coupons = "No Coupons";
            $offers = "No Offers";
            if(!empty($brand->offers_count)) {
              $cp_count = explode('|',$brand->offers_count);
              if(count($cp_count) > 0) {
                $coupons = $cp_count[1]." ".__('public/listing.coupons');
                $offers = $cp_count[2]." ".__('public/listing.offers_available');
              }

            }
            ?>
          <div class="col-6 col-lg-3 col-md-4 store-card" data-alpha="{{strtoupper(substr($brand->brand_name,0,1))}}">
		  <a href="{{url('brand/'.str_slug($brand->brand_slug))}}" name="{{substr($brand->brand_name,0,1)}}">
          <div class="st-result">
            <ul class="list-unstyled mb-0">
              <li><strong>{{$brand->brand_name}}</strong></li>
              <li class="text-muted mt-2">{{$coupons}} | {{$offers}} </li>
            </ul>
          </div>
		  </a>
          </div>
            @endforeach
         </div>
    		 @if(trim(config('settingConfig.ads_pages_bottom'))!='')
          <div class="gbands text-center" id="gband-pages">
          {!! stripcslashes(config('settingConfig.ads_pages_bottom')) !!}
          </div>
        @endif



      </div>
  </div>
</section>


<script>

Array.prototype.unique = function() {
  return this.filter(function (value, index, self) {
    return self.indexOf(value) === index;
  });
}

jQuery(function($) {
	var alphaList = [];
$('.store-card').each( function(e){
	 alphaList.push(($(this).data('alpha')).toString());
} );
alphaList= alphaList.unique().sort();

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
