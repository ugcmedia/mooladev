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
    <section class="page-hero-banner  py-3 mb-4">
      <div class="container ">
      <div class="page-navigation">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb p-0 mb-2">
            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('public/cashback.home') }}</a></li>
            <li class="breadcrumb-item"><a href="#">{{__('public/cashback.vendor') }}</a></li>
            <li class="breadcrumb-item" aria-current="page">{{$data['vendor']->vendor_name}} Discount codes</li>
          </ol>
        </nav>
      </div>

      <div class="hero-banner-cont1 bg-white rounded p-3 shadow-sm">
        <div class="row">
          <div class="col-md-3">
            <div class="store-hero-img mb-3">
              <!-- <a href="#" data-toggle="lightbox" data-gallery="gallery">
              <img src="images/st_main.png" class="w-100 rounded"  alt="">
            </a> -->
                  <a href="{{asset($data['vendor']->outlet_primary_image)}}" data-toggle="lightbox" data-gallery="gallery" >
                     <img  src="{{asset($data['vendor']->outlet_primary_image)}}" class="w-75 rounded">
                  </a>
            </div>

            <!-- <div class="store-featured-img mb-3 mb-md-0">
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

            </div> -->
          </div>

          <div class="col-md-9">
            <div class="float-left">
              <h1 class="fw-700">{{$data['vendor']->vendor_name}}</h1>
              <div class="st-location">
                <p class="secondary-text-light"><i class="fas fa-map-marker-alt"></i> {{$data['vendor']->outlet_address}}</p>
              </div>
            </div>
            <a href="#" class="float-right"><i class="fas fa-heart st-fav-icon font-24 p-2 rounded border"></i></a>
            <div class="clearfix">

            </div>
            <div class="st-title">
            </div>

            <div class="row">
              <div class="col-12">

                <div id="summary">
                  <p class="collapse" id="collapseSummary">
                    {!! $data['vendor']->vendor_desc !!}
                  </p>
                  <a class="collapsed" data-toggle="collapse" href="#collapseSummary" aria-expanded="false" aria-controls="collapseSummary"></a>
                </div>
                <div class="d-none d-sm-block">
                <div class="store-review">
                  <ul class="list-inline mb-0">
                    <li class="list-inline-item"><div class="review-count">
                      <span>{{$data['vendor']->vendor_rating}}</span>
                      <span>({{$data['vendor']->vendor_votes}} Reviews)</span>
                    </div></li>
                    <li class="list-inline-item"><i class="fas fa-star rate-star"></i></li>
                    <li class="list-inline-item"><i class="fas fa-star rate-star"></i></li>
                    <li class="list-inline-item"><i class="fas fa-star rate-star"></i></li>
                    <li class="list-inline-item"><i class="fas fa-star rate-star"></i></li>
                    <li class="list-inline-item"><i class="fas fa-star-half-alt rate-star"></i></li>

                  </ul>

                </div>
              </div>
                <div class="text-center text-sm-left mb-3 mb-md-0">










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

  @if( session()->has('chashback_tra'))
        <div class="alert alert-primary alert-dismissible fade show" role="alert">
                        {!! session()->get('chashback_tra')  !!}
                        {{ session()->forget('chashback_tra') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
        </div>
@endif

@if( session()->has('invalid_image'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {!! session()->get('invalid_image')  !!}

            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
      </div>
@endif


    <div class="row">

      <div class="col-lg-8">




        <div class="store-all-deals">
            <div class="contect-us-wrapper bg-white shadow-sm rounded p-5">
              <div class="row1">
                    <div class="col-md-81">
                    <h5 class="font-weight-bold">{{__('public/cashback.plz_uplode') }}</h5>
                          <div class="contect-us-frm mt-4">
                              <div class="contact-us-msg"> </div>



                                <form method="POST" action="{{ route('cashback') }}" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                   <input type="hidden" value="{{$data['vendor']->vendor_code}}" name="Vandor_code">

                                              <div class="form-group row">
                                                  <label for="text1" class="col-sm-3 col-form-label">{{__('public/cashback.order_id') }}</label>
                                                  <div class="col-sm-9">
                                                  <input type="text" class="form-control  " id="text1" placeholder="{{__('public/cashback.plz_order_id') }} " name="orderid" value="{{ old('orderid') }}" required>
                                                  </div>
                                              </div>

                                              <!-- <div class="form-group row">
                                                  <label for="text2" class="col-sm-3 col-form-label">Coupne Code</label>
                                                  <div class="col-sm-9">
                                                  <input type="text" class="form-control" id="text2" placeholder="Please Enter coupon Code" name="coupnecode" value="{{ old('coupnecode') }}"  required>
                                                  </div>
                                              </div> -->

                                              <div class="form-group row">
                                                  <label for="text2" class="col-sm-3 col-form-label">{{__('public/cashback.receipt_date') }} </label>
                                                  <div class="col-sm-9">
                                                  <input type="date" class="form-control" id="text2"  name="receiptdate" value="{{ old('receiptdate') }}"  required>
                                                  </div>
                                              </div>

                                              <div class="form-group row">
                                                  <label for="text3"  class="col-sm-3 col-form-label">{{__('public/cashback.transaction_amount') }}</label>
                                                  <div class="col-sm-9">
                                                  <input type="text" class="form-control" id="text3" placeholder="{{__('public/cashback.plz_transaction_amount') }}" name="transaction_amount" value="{{ old('transaction_amount') }}"   required>
                                                </div>
                                              </div>






  <div class="form-group row">
                                              <label for="text4" class="col-sm-3 col-form-label">{{__('public/cashback.uplode_file') }}</label>
                                              <div class="col-sm-9">
                                                  <div class="custom-file">
                                                <input type="file" class="custom-file-input {{ session()->has('invalid_image')  ? 'is-invalid' :' ' }} " id="filedata" name="filedata"  value="{{ old('filedata') }}" required autocomplete="filedata" autofocus >
@if( session()->has('invalid_image'))
    {{ session()->forget('invalid_image') }}
@endif


{{-- @error('filedata') --}}
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{-- $message --}}</strong>
                                    </span>
{{-- @enderror --}}


                                                <label class="custom-file-label" for="customFile">{{__('public/cashback.choose_file') }}</label>
                                              </div>
                                              </div>
                                            </div>

                                                <div class="form-group row">
                                                    <label for="text5" class="col-sm-3 col-form-label">{{__('public/cashback.write_your_message') }} </label>
                                                        <div class="col-sm-9">
                                                          <textarea class="form-control" name="msg"  id="exampleFormControlTextarea1" placeholder="{{__('public/cashback.plz_message') }}" rows="5"></textarea>
                                                      </div>
                                                </div>


                                                <div class="form-group row">
                                                    <label for="text5" class="col-sm-3 col-form-label"></label>
                                                        <div class="col-sm-9">
                                                      <button type="submit" class="btn btn-dark">&nbsp;&nbsp;&nbsp;&nbsp;submit&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                      </div>
                                                </div>





                                          </form>

                                        </div>

                                      </div>
                                    </div>
                  </div>
                </div>
      </div>











      <div class="col-lg-4 col-md-4">
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
                      <h4>{!!$fStores->vendor_name!!}</h4>
                    </div>
                  </a>

                  </div>
              @endforeach

            </div>


        </div>



        <div class="bg-white p-3 rounded shadow-sm mb-4 fStoresBox">
          <div class="mb-3">
            <h4 class="text-dark font-18 fw-700 float-left">{{__('public/cashback.trending_offers') }}</h4>
            <a class="float-right" href="#" align="right"> {{__('public/cashback.view_all')}} </a>


          </div>
          <div class="clearfix">
          </div>



  @foreach($data['offers']  as $tredingOffer )

  <div class="media mb-3">
  <img src="{{asset($tredingOffer->offer_image)}}" class="mr-2 rounded" alt="..." width="70px" >
  <div class="media-body">
    {{$tredingOffer->offer_title}}
  </div>
</div>


@endforeach

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
