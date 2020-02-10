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
$pageimage = asset('public_assets/images/page-header-bg.jpg');
if(!empty($data['pageInfo']->image))
  $pageimage = asset('uploads/images').'/'.$data['pageInfo']->image;
?>
<!-- <link rel="stylesheet" href="{{asset('public_assets/css/how-it-works-style.css')}}"> -->
<!-- <section class="h-i-w-banner" style="background-image:url('{{$pageimage}}')">
  <div class="container">
    <div class="h-i-w-banner-cont">
      <span class="promo-text font-60 fw-900">{{config('sximo.cnf_appname')}}</span>
      <p class="font-24 fw-400 success-text">{{$data['pageInfo']->title}}</p>
    </div>
  </div>
</section> -->

<section class=" bg-white  py-5 hit-hero-banner" style="  background-image: url('http://moola101.ga/uploads/images/main-banner.png');">
    <div class="container">



      <div class="page-navigation">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb p-0 mb-2">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$data['pageInfo']->title}}</li>
          </ol>
        </nav>
      </div>


      <div class="hero-banner-cont">
        <div class="row">
          <div class="col-md-12">
            <div class="st-title">
               <h1 class="font-48 text-white"><span class="fw-700">{{$data['pageInfo']->title}}</span></h1>
               <div class="text-white">
                   <p class="text-white font-14 fw-400 ">
                   {!!$data['pageInfo']->note!!}
                   </p>
             </div>


            </div>
          </div>
        </div>
      </div>
</section>





<!-- Tab -->
<div class="faq-section py-5">
<div class="container">
<div class="vertical-tabs">
  <div class="row">
    <div class="col-lg-3 col-md-4">
      <ul class="nav nav-tabs faqTabs bdrs11" role="tablist">
        <?php $i = 0; ?>
        @foreach( $data['faqCats']  as $faqCat)
        <li class="nav-item">
          <a class="nav-link @if($i==0) active @else deactive @endif" data-toggle="tab" href="#{{$faqCat->cat_code}}" role="tab" aria-controls="home"><span class="{{$faqCat->cat_icon}}" aria-hidden="true"></span> {{$faqCat->cat_name}}</a>
        </li>
        <?php $i++; ?>
    	@endforeach
      </ul>
    </div>

    <div class="col-lg-9 col-md-8">
      <?php $j=0; ?>
      <div class="tab-content">
        @foreach( $data['faqCats']  as $faqCat)
          <div class="tab-pane @if($j == 0) active @else deactive @endif" id="{{$faqCat->cat_code}}" role="tabpanel">
            <div class="sv-tab-panel">
              <h3>{{$faqCat->cat_name}}</h3>
              <div class="accordion" id="accordionExamplehiw">
              @foreach($data['faq'] as $faq)
               @if($faq->faq_cat == $faqCat->cat_code)
                 <div class="card round-0">
                  <div class="card-header  border-bottom-0" id="heading{{$faq->faq_id}}">
                    <span class="panel-title mb-0">

                      <button class="btn btn-link d-block w-100 text-left text-muted font-18 fw-700 px-0 collapsed" type="button"  data-toggle="collapse" data-target="#collapse{{$faq->faq_id}}" aria-expanded="@if($j == 0)  true @endif" aria-controls="collapse{{$faq->faq_id}}">
                          {{$faq->faq_title}}
                      </button>
                    </span>
                  </div>
                  <div id="collapse{{$faq->faq_id}}" class="collapse" aria-labelledby="heading{{$faq->faq_id}}" data-parent="#accordionExample">
                    <div class="card-body p-1 font-15 secondary-text fw-400">
                      {!!$faq->faq_desc !!}
                    </div>
                  </div>
                </div>
               @endif
              @endforeach
            </div>

            </div>
          </div>
          <?php $j++; ?>
        @endforeach
      </div>

    </div>
    <!--Col-md-9  -->
   </div>
   <!--.Row  -->
  </div>

  @if(trim(config('settingConfig.ads_pages_bottom'))!='')
  <div class="gbands col-md-12 text-center mt-3 mt-lg-5" id="gband-pages">
  {!! stripcslashes(config('settingConfig.ads_pages_bottom')) !!}
  </div>
  @endif

  </div>

</div>
<!-- End Tab -->



<style media="screen">
.vertical-tabs ul.nav.nav-tabs {
  display: block;
}
</style>

@endsection
