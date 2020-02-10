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
<?php
  //  dd($data);
?>

<section class="sec-page-header  no-overlay" style="background-image:url('{{$pageimage}}')">
  <div class="container">
    <!-- <div class="row">
      <div class="col-lg-12">
        <div class="db-breadcrumb">
          <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('public/listing.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$data['pageInfo']->title}}</li>
          </ol>
          </nav>
        </div>
      </div>
    </div> -->
    <div class="row">
      <div class="offset-md-2 offset-lg-3 col-lg-6 col-md-8 text-center">
        <h1 class="page-title-h1 text-dark">{!! $data['pageInfo']->title!!}</h1>
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
         <p class="mb-0">{{__('public/listing.total')}} {{__('public/listing.cat')}}:</p>
         <span><strong>
          {{count(AppClass::getAllCat())}}
        </strong></span>

      </div>
      </div> -->
      @include('public.cashback-partials.allSideBar')
    </div>
    <div class="col-lg-9 col-md-8">
      <!-- <h4 class="pt-0 text-capitalize">{{__('public/listing.browse_all_categories')}}</h4> -->
      <span class="pt-0 text-capitalize h2">{{__('public/listing.browse_all_categories')}}</span>

     <div class="my-3">
       <div class="card-columns">
         @foreach($getcat as $cat)
             @if($cat->parent_id == 0)
           <div class="card border-0">
             <div class="card-body">
               <span class="card-title cat-list-title"><a href="{{url('category/'.str_slug($cat->cat_slug))}}" id="{{substr($cat->cat_name,0,1)}}">{{$cat->cat_name}}</a></span>
               <div class="card-text">
                 <div class="cat-list">
                   <ul class="text-capitalize">
                     @foreach(AppClass::childCat($cat->cat_id) as $child)
                          <li><a href="{{url('category/'.str_slug($child->cat_slug))}}">{{$child->cat_name}}</a></li>
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

        @foreach($getcat as $cat)
            @if($cat->parent_id == 0)
              <div class="col-lg-3 col-md-6 col-sm-6">
                    <h3 class="parent-cate text-capitalize"> <a href="{{url('category/'.str_slug($cat->cat_slug))}}" id="{{substr($cat->cat_name,0,1)}}">{{$cat->cat_name}}</a></h3>
                    <div class="cat-list">
                    <ul class="text-capitalize">
                      @foreach(AppClass::childCat($cat->cat_id) as $child)
                           <li><a href="{{url('category/'.str_slug($child->cat_slug))}}">{{$child->cat_name}}</a></li>
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
<div class="clearfix">

<div class="container">
  <div class="merchant-bottom">
    <div class="row">

  </div>
  </div>
</div>
</div>

@endsection
