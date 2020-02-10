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
    <div class="row">
      <div class="col-lg-6 col-md-8">
        <h1 class="page-title-h1">{!! $data['pageInfo']->title!!} with <span class="primary-text">Cashback</span>, <span class="promo-text">Coupons</span> & <span class="text-green">Promo Codes</span></h1>
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
          <p class="mb-0">{{__('public/listing.total')}} {{__('public/listing.tags')}}:</p>
          <span><strong>
            {{count(AppClass::getAllTag())}}
          </strong></span>
        </div>
      </div> -->
      @include('public.cashback-partials.allSideBar')
    </div>
    <div class="col-lg-9 col-md-8">
      <span class="pt-0 text-capitalize h2">{{__('public/listing.browse_all_tags')}}</span>
	  <div class="my-3">
      <div class="card-columns">
        @foreach($gettags as $tag)
          @if($tag->parent_id == 0)
          <div class="card border-0">
            <div class="card-body">
              <span class="card-title cat-list-title"><a href="{{url('tag/'.str_slug($tag->tag_slug))}}">{{$tag->tag_name}}</a></span>
              <div class="card-text">
                <div class="cat-list">
                  <ul class="text-capitalize">
                    @foreach(AppClass::getChildTag($tag->tag_id) as $child)
                      <li><a href="{{url('tag/'.str_slug($child->tag_slug))}}">{{$child->tag_name}}</a></li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
          @endif
        @endforeach
      </div>
	  </div>
      <!-- <div class="panel-box my-5">
        <div class="all-cat-list p-3 bg-white border rounded">
          <div class="container">
            <div class="row">
          @foreach($gettags as $tag)
              @if($tag->parent_id == 0)
                <div class="col-lg-3 col-md-6 col-sm-6">
                    <h3 class="parent-cate text-capitalize"> <a href="{{url('tag/'.str_slug($tag->tag_slug))}}">{{$tag->tag_name}}</a></h3>
                    <div class="cat-list">
                    <ul class="text-capitalize">
                      @foreach(AppClass::getChildTag($tag->tag_id) as $child)
                           <li><a href="{{url('tag/'.str_slug($child->tag_slug))}}">{{$child->tag_name}}</a></li>
                      @endforeach
                    </ul>
                    </div>
                  </div>
              @endif
            @endforeach
        </div>
     </div>
  </div>
 </div> -->

  @if(trim(config('settingConfig.ads_pages_bottom'))!='')
<div class="gbands col-md-12 text-center" id="gband-pages">
{!! stripcslashes(config('settingConfig.ads_pages_bottom')) !!}
</div>
@endif

 </div>
    </div>
    </div>
  </section>




@endsection
