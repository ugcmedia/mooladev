@extends('public.layouts.app')
@section('title')
  {!! (!empty($pageInfo->meta_title))? $pageInfo->meta_title:$pageInfo->page_title !!}
@endsection
@section('meta')
  <meta name="description"  content="{!! $pageInfo->metadesc!!}" >
  <meta name="keywords" content="{!! $pageInfo->metakey!!}">
  @php $img = AppClass::getMetaImg($pageInfo,'pages') @endphp
  <meta property="og:image" content="{{$img}}" />
  <meta property="og:title" content="{!! $pageInfo->meta_title !!}" />
  <meta property="og:url" content="{{URL::current()}}" />
  <meta property="og:description" content="{!! $pageInfo->metadesc!!}" />
  <meta property="og:site_name" content="{{config('sximo.cnf_appname')}}" />
@endsection
@section('content')

<section class="blog-section">
	<article class="blog-artical py-5">
		<div class="container">
		<div class="row">
      <div class="col-lg-9">

  @foreach( $posts as $post)
     <div class="row">
        <div class="col-lg-12">


				<div class="artical-body">
					<div class="post-img">


                @if(file_exists('./uploads/images/'.$post->image) && $post->image !='' )
				<div class="featureimg text-center">
          <a href="{{ url('blog/'.$post->alias) }}"><img class="w-100" src="{{ asset('uploads/images/'.$post->image) }}" alt="" ></a>

				</div>
                @endif

						<div class="post-disc bg-white rounded-bottom">
						<div class="post-title text-center p-4 mb-4 mb-md-5">
							<a href="{{ url('blog/'.$post->alias) }}">
								<h3>  <a href="{{ url('blog/'.$post->alias) }}">{{ $post->title }}</a></h3>

							</a>
							<div class="art-short-cont text-left">
                {!! 	  substr($post->note, 0, 200) !!}
							</div>
              <div class="row">
                  <div class="col-12">
                    <div class="art-btn text-center">
                      <a href="{{ url('blog/'.$post->alias) }}" class="btn btn-primary rounded">{{__('public/blog.read_more')}}</a>
                    </div>
                    <?php
                      $getSocialLinks = AppClass::getSocialLinks(url('/').'/blog'.'/'.$post->alias,$post->title);
                    ?>
                    <div class="clearfix m-2">
                      <div class="post-share float-right">
                        <ul class="list-inline footer-social mb-0">
                          @php $fclass = 'fab'; $fbfa=''; @endphp
                          @foreach($getSocialLinks as $key => $value)
                          @php if($key == 'comment' || $key == 'envelope' ) { $fclass = 'far';}
                              if($key == 'facebook') { $fbfa = '-f';} else { $fbfa = '';}
                           @endphp
                              <li class="list-inline-item mb-2 btn-{{$key}}"><a href="{{$value}}" target="_blank"><i class="{{$fclass}} fa-{{$key}}{{$fbfa}}"></i> </a></li>
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
      </div>
   </div>
      @endforeach
			<div class="row text-center">
			{!!  $posts->links() !!}
			</div>

					  @if(trim(config('settingConfig.ads_pages_bottom'))!='')
<div class="gbands col-md-12 text-center" id="gband-pages">
{!! stripcslashes(config('settingConfig.ads_pages_bottom')) !!}
</div>
@endif



    </div>
			<div class="col-lg-3">
        @include('public.blogs.sidebar')
			</div>
		</div>
		</div>
	</article>
</section>
@endsection
