@extends('public.layouts.app')
@section('title')
  {!! $data['pageInfo']->title !!}
@endsection
@section('meta')
  <meta name="description"  content="{!! $data['pageInfo']->metadesc!!}" >
  <meta name="keywords" content="{!! $data['pageInfo']->metakey!!}">
@endsection

@section('content')
<?php
$pageimage = asset('public_assets/images/page-header-bg.jpg');
if(!empty($data['pageInfo']->image))
  $pageimage = asset('uploads/images').'/'.$data['pageInfo']->image;
?>
<section class="sec-page-header" style="background-image:url('{{$pageimage}}')">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-8">
        <h1 class="page-title-h1">{!! $data['pageInfo']->title!!}</h1>
        <p>{!! $data['pageInfo']->note!!}</p>
      </div>
    </div>
  </div>
</section>

<div class="container">
	<div class="merchant-bottom">
		<div class="panel-box my-5">
		<div class="all-cat-list">
			<div class="card-columns">
			  <div class="card border-0 shadow-sm mb-4">
			    <div class="card-body">
			      <h3 class="parent-cate text-capitalize">{{__('public/storepage.all_pages')}}</h3>
					<div class="cat-list">
					<ul class="text-capitalize">
            @foreach($data['pages'] as $page)
						    @if( ! in_array($page->alias,array('home','restric','maintenance') ) ) <li><a href="{{url($page->alias)}}">{{$page->title}}</a></li> @endif
					  @endforeach
					</ul>
			    </div>
			  </div>
			</div>

			<div class="card border-0 shadow-sm mb-4">
			    <div class="card-body">
			      <h3 class="parent-cate text-capitalize">{{__('public/blog.blogs')}}</h3>
					<div class="cat-list">
						<ul class="text-capitalize">
              @foreach($data['posts'] as $post)
                 <li><a href="{{url('blog/'.$post->alias)}}">{{$post->title}}</a></li>
             @endforeach
						</ul>
			    </div>
			  </div>
			</div>

			<div class="card border-0 shadow-sm mb-4">
			    <div class="card-body">
			      <h3 class="parent-cate text-capitalize">{{__('public/storepage.stores')}}</h3>
					<div class="cat-list">
						<ul class="text-capitalize">
              @foreach($data['stores'] as $store)
                 <li><a href="{{url('store/'.$store->store_slug)}}">{{$store->store_name}}</a></li>
             @endforeach
						</ul>
			    </div>
			  </div>
			</div>

			<div class="card border-0 shadow-sm mb-4">
			    <div class="card-body">
			      <h3 class="parent-cate text-capitalize">{{__('public/storepage.cat')}}</h3>
					<div class="cat-list">
					<ul class="text-capitalize">
            @foreach($data['cats'] as $cat)
               <li><a href="{{url('category/'.$cat->cat_slug)}}">{{$cat->cat_name}}</a></li>
           @endforeach
					</ul>
			    </div>
			  </div>
			</div>

			<div class="card border-0 shadow-sm mb-4">
			    <div class="card-body">
			     <h3 class="parent-cate text-capitalize">{{__('public/storepage.brands')}}</h3>
					<div class="cat-list">
					<ul class="text-capitalize">
            @foreach($data['brands'] as $brand)
               <li><a href="{{url('brand/'.$brand->brand_slug)}}">{{$brand->brand_name}}</a></li>
           @endforeach
					</ul>
			    </div>
			  </div>
			</div>

			<div class="card border-0 shadow-sm mb-4">
			    <div class="card-body">
			     <h3 class="parent-cate text-capitalize">{{__('public/storepage.tags')}}</h3>
					<div class="cat-list">
						<ul class="text-capitalize">
              @foreach($data['tags'] as $tag)
                 <li><a href="{{url('tag/'.$tag->tag_slug)}}">{{$tag->tag_name}}</a></li>
             @endforeach
						</ul>
			    </div>
			  </div>
			</div>

			<div class="card border-0 shadow-sm mb-4">
			    <div class="card-body">
			     <h3 class="parent-cate text-capitalize">{{__('public/storepage.storecats')}}</h3>
					<div class="cat-list">
						<ul class="text-capitalize">
              @foreach($data['storeCats'] as $scat)
                 <li><a href="{{url('all-store-categories')}}">{{$scat->store_cat_name}}</a></li>
             @endforeach
					</ul>
			    </div>
			  </div>
			</div>

			</div>
    </div>
  </div>
</div>
</div>
</section>
@endsection
