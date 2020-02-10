@php
//$mobileDetection = new MobileDetect();
@endphp
@extends('public.layouts.app')
@section('title')
@if($data['vendor']->meta_title != '')
  {!! $data['vendor']->meta_title !!}
@else
  {!! AppClass::stringReplaceSetting(config('settingConfig.vendor_meta_title'),$data['vendor']->vendor_name)!!}
@endif
@endsection

@section('meta')
  <meta name="description" @if($data['vendor']->meta_desc != '') content= "{!! $data['vendor']->meta_desc !!}" @else  content= "{!! AppClass::stringReplaceSetting(config('settingConfig.vendor_meta_desc'),$data['vendor']->vendor_name)!!}"  @endif>
  <meta name="keywords" content="{!! $data['vendor']->meta_keywords!!}">
  @php $img = AppClass::getMetaImg($data['vendor'],'vendor') @endphp
  <meta property="og:image" content="{{$img}}" />
  <meta property="og:title" content="{!! $data['vendor']->meta_title !!}" />
  <meta property="og:url" content="{{URL::current()}}" />
  <meta property="og:description" content="{!! $data['vendor']->meta_desc!!}" />
  <meta property="og:site_name" content="{{config('sximo.cnf_appname')}}" />
@endsection

@section('content')
<?php
    //dd($data);
    //dd($data['vendor']->vendor_name);
    //  dd($data['offers']);

?>
<section class="page-main-content">
    <section class="page-hero-banner bg-white py-3 mb-4">
      <div class="container">
      <div class="page-navigation">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb p-0 mb-2">
            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('public/cashback.home') }}</a></li>
            <li class="breadcrumb-item"><a href="#">{{__('public/cashback.vendor') }}</a></li>
            <li class="breadcrumb-item " aria-current="page">{{$data['vendor']->vendor_name}}</li>
          </ol>
        </nav>
      </div>

      <div class="hero-banner-cont">
        <div class="row">
          <div class="col-md-3">
            <div class="store-hero-img mb-3">
              <!-- <a href="#" data-toggle="lightbox" data-gallery="gallery">
              <img src="images/st_main.png" class="w-100 rounded"  alt="">
            </a> -->
            <a href="{{asset($data['vendor']->outlet_primary_image)}}" data-toggle="lightbox" data-gallery="gallery" >
             <img src="{{asset($data['vendor']->outlet_primary_image)}}" class="w-100 rounded">
           </a>
            </div>
            <div class="store-featured-img mb-3 mb-md-0">
              <div class="row pr-3">
                <div class="col-3 col-md-6 col-lg-3 st-fd-hero mb-0 mb-lg-0 mb-md-2">
                  <a href="{{asset($data['vendor']->outlet_primary_image)}}" data-toggle="lightbox" data-gallery="gallery" >
                   <img src="{{asset($data['vendor']->outlet_primary_image)}}" class="img-fluid rounded">
                 </a>
                </div>
                <div class="col-3 col-md-6 col-lg-3 st-fd-hero mb-0 mb-lg-0 mb-md-2">
                  <a href="{{asset($data['vendor']->outlet_primary_image)}}" data-toggle="lightbox" data-gallery="gallery" >
                   <img src="{{asset($data['vendor']->outlet_primary_image)}}" class="img-fluid rounded">
                 </a>
                </div>
                <div class="col-3 col-md-6 col-lg-3 st-fd-hero mb-0 mb-lg-0 mb-md-2">
                  <a href="{{asset($data['vendor']->outlet_primary_image)}}" data-toggle="lightbox" data-gallery="gallery" >
                   <img src="{{asset($data['vendor']->outlet_primary_image)}}" class="img-fluid rounded">
                 </a>
                </div>
                <div class="col-3 col-md-6 col-lg-3 st-fd-hero mb-0 mb-lg-0 mb-md-2">
                  <a href="{{asset($data['vendor']->outlet_primary_image)}}" data-toggle="lightbox" data-gallery="gallery" >
                   <img src="{{asset($data['vendor']->outlet_primary_image)}}" class="img-fluid rounded">
                 </a>
                </div>
              </div>
              <!-- <ul class="list-inline">
                <li class="list-inline-item">
                  <a href="images/st_main.png" data-toggle="lightbox" data-gallery="gallery" >
                   <img src="images/st_main.png" class=" rounded">
                 </a>
                </li>
                <li class="list-inline-item">
                  <a href="images/st_main.png" data-toggle="lightbox" data-gallery="gallery" >
                   <img src="images/st_main.png" class=" rounded">
                 </a>
                </li>
                <li class="list-inline-item">
                  <a href="images/st_main.png" data-toggle="lightbox" data-gallery="gallery" >
                   <img src="images/st_main.png" class=" rounded">
                 </a>
                </li>
                <li class="list-inline-item">
                  <a href="images/st_main.png" data-toggle="lightbox" data-gallery="gallery" >
                   <img src="images/st_main.png" class=" rounded">
                 </a>
                </li>
              </ul> -->
            </div>
          </div>

          <div class="col-md-9">
            <div class="st-title">
              <div class="row">

                      <div class="col-lg-9 col-md-8 d-flex justify-content-between text-muted">
                        <h1 class="">
                          <span class="fw-700">
                            {{$data['vendor']->vendor_name}}
                          </span>
                          <span class="fw-400">
                            {{__('public/cashback.discount_codes') }}
                          </span>
                        </h1>
                        <a href="#">
                        <i class="fas fa-heart st-fav-icon font-24 p-2 rounded border"></i>
                        </a>
                      </div>


                <div class="col-lg-3 col-md-4 d-none d-md-block">
                  <div class="store-review text-right">
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item"><i class="fas fa-star rate-star"></i></li>
                      <li class="list-inline-item"><i class="fas fa-star rate-star"></i></li>
                      <li class="list-inline-item"><i class="fas fa-star rate-star"></i></li>
                      <li class="list-inline-item"><i class="fas fa-star rate-star"></i></li>
                      <li class="list-inline-item"><i class="fas fa-star-half-alt rate-star"></i></li>
                    </ul>
                    <div class="review-count">
                      <span>{{ $data['vendor']->vendor_rating }}</span>
                      <span>({{ $data['vendor']->vendor_votes}} Reviews)</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-12">
                <div class="st-location">
                  <p class="secondary-text-light"><i class="fas fa-map-marker-alt"></i> {{$data['vendor']->outlet_address}}</p>
                </div>
                <div id="summary">
                  <p class="collapse" id="collapseSummary">
                    {!! $data['vendor']->vendor_desc !!}
                  </p>
                  <a class="collapsed" data-toggle="collapse" href="#collapseSummary" aria-expanded="false" aria-controls="collapseSummary"></a>
                </div>
                <div class="text-center text-sm-left mb-3 mb-md-0">


                  @if(! isset(Session::get('memberDetail')->first_name))
                            <button type="button" class="btn btn-primary" name="button" data-toggle="modal" data-target="#login-modal">
                            Activate Cashback
                          </button>
                  @else
                          <a  class="btn btn-primary button" name="button" href="{{ url('vendor-cashback').'/'.$data['vendor']->vendor_slug }}"  role="button">Activate Cashback
                          </a>
                  @endif







                </div>
                <!-- Mobile store review -->
                <div class="col-12 d-block d-md-none">
                  <div class="store-review text-center">
                    <ul class="list-inline mb-0">
                      <li class="list-inline-item"><i class="fas fa-star rate-star"></i></li>
                      <li class="list-inline-item"><i class="fas fa-star rate-star"></i></li>
                      <li class="list-inline-item"><i class="fas fa-star rate-star"></i></li>
                      <li class="list-inline-item"><i class="fas fa-star rate-star"></i></li>
                      <li class="list-inline-item"><i class="fas fa-star-half-alt rate-star"></i></li>
                    </ul>
                    <div class="review-count">
                      <span>{{$data['vendor']->vendor_rating}}</span>
                      <span>({{$data['vendor']->vendor_votes}} Reviews)</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<section class="page-bottom">
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-md-4 order-2 order-md-1">
        <div class="store-sidebar-cont">
          <div class="store-cb-cont p-3 bg-white rounded shadow-sm mb-4">
            <div id="profile-description">
              <div class="text show-more-height">
                <h5 class="text-muted font-16 fw-700 mb-3">Available Moola</h5>
                  <ul class="list-unstyled">
                    <li class="border-bottom pb-1">
                      <span class="float-left font-14 text-muted">Activites</span>
                      <span class="float-right text-secondary font-14 fw-700">6.00%</span>
                    </li>
                    <li class="border-bottom pb-1">
                      <span class="float-left font-14 text-muted">Activites</span>
                      <span class="float-right text-secondary font-14 fw-700">6.00%</span>
                    </li>
                    <li class="border-bottom pb-1">
                      <span class="float-left font-14 text-muted">Activites</span>
                      <span class="float-right text-secondary font-14 fw-700">6.00%</span>
                    </li>
                    <li class="border-bottom pb-1">
                      <span class="float-left font-14 text-muted">Activites</span>
                      <span class="float-right text-secondary font-14 fw-700">6.00%</span>
                    </li>
                    <li class="border-bottom pb-1">
                      <span class="float-left font-14 text-muted">Activites</span>
                      <span class="float-right text-secondary font-14 fw-700">6.00%</span>
                    </li>
                    <li class="border-bottom pb-1">
                      <span class="float-left font-14 text-muted">Activites</span>
                      <span class="float-right text-secondary font-14 fw-700">6.00%</span>

                    </li>
                    <li class="border-bottom pb-1">
                      <span class="float-left font-14 text-muted">Activites</span>
                      <span class="float-right text-secondary font-14 fw-700">6.00%</span>
                    </li>
                  </ul>
              </div>
              <div class="show-more fw-700">Show More</div>
              </div>
          </div>


          <div class="hint-tips p-3 rounded bg-white shadow-sm mb-4">
            <h5 class="mb-3 text-muted font-16 fw-700">Hint & Tips</h5>
            <div class="ht-header clearfix mb-3">
              {{$data['vendor']->vendor_howto}}
             <!-- <div class="ht-cont font-14 text-muted">
                Book perfect days out and
                save some money in the
                process with our hints and
                tips for Virgin Experience
                Days:
              </div> -->
              <!-- <div class="ht-icon">
                <img src="images/bulb_icon.png" class="" alt="">
              </div> -->
            </div>

            <!-- <div class="ht-list">
              <ul class="list-unstyled ml-3 position-relative">
                <li class="font-14 text-muted mb-2">
                  With instant delivery on great e-vouchers and refunds or exchanges available on most products, you’ll never have to panic over gift giving again with Virgin Experience Days.
                </li>
                <li class="font-14 text-muted mb-2">
                  Sign up to the mailing list for new product updates, the greatest experience days, ideas. Virgin Experience Days discount codes and some exclusive offers or even a Virgin Experience Days voucher.
                </li>
              </ul>
            </div> -->
          </div>

        </div>
      </div>
      <div class="col-lg-9 col-md-8 order-1 order-md-2">
        <div class="store-all-deals">
          <div class="row">
           @foreach($data['offers'] as $offer)
                <div class="col-lg-4 col-sm-6 mb-3">
                  <div class="item h-100 rounded">
                    <div class="hp-owl-card h-100">
                      <a href="#">
                        <div class="hp-owl-card-inner  bg-white shadow-sm rounded h-100">
                          <div class="owl-card-figure rounded">
                            <img src="{{asset($offer->offer_image)}}" alt="">
                          </div>
                            <div class="fd-store-logo bg-white border rounded p-1 text-center">
                              <img src="{{asset($offer->vendor_logo)}}" alt="">
                            </div>
                          <div class="hp-owl-card-inner-in pb-3 px-3 text-center">
                            <h4 class="text-muted fw-700 font-16">{!!$offer->vendor_name!!}</h4>
                            <p class="store-add text-muted font-14 fw-400">{{$offer->offer_title}}</p>
                            <div class="discount-lable text-center">
                              <p class="d-lable-text p-2 px-3 rounded d-inline-block mb-0 font-14 fw-400">{{$offer->vendor_cashback}}  %  MOOLA</p>
                            </div>
                          </div>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
            @endforeach

          </div>

        </div>
      </div>
    </div>
  </div>
</section>
  </div>

</section>

<script type="text/javascript">
$(".show-more").click(function () {
  $(this).text("Show Less");
$(".text").toggleClass("show-more-height");
});

$(document).on("click", '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox();
});
</script>
@endsection
