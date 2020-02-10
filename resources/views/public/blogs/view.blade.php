@extends('public.layouts.app')
@section('title')
  {!! AppClass::stringReplaceSetting(config('settingConfig.blog_meta_title'),$posts->title) !!}
@endsection
@section('meta')
  <meta name="description"  content= "{!! AppClass::stringReplaceSetting(config('settingConfig.blog_meta_desc'),$posts->title) !!}" >
  @php $img = AppClass::getMetaImg($posts,'blog') @endphp
  <meta property="og:image" content="{{$img}}" />
  <meta property="og:title" content="{{ $posts->title }}" />
  <meta property="og:url" content="{{URL::current()}}" />
  <meta property="og:description" content="{{ str_limit($posts->note,200)  }}" />
  <meta property="og:site_name" content="{{config('sximo.cnf_appname')}}" />
@endsection
<?php
  $getSocialLinks = AppClass::getSocialLinks(url('/').'/blog'.'/'.$posts->alias,$posts->title);
?>
@section('content')
<section class="blog-section">
	<article class="blog-artical py-4 py-lg-5">
		<div class="container">
		<div class="row">
      <div class="col-lg-9">

        <h1 class="section-title wow  animated" style="visibility: visible;">
            {{ $posts->title}}
        </h1>
        <div class="section-tool align-middle text-muted mb-3 bg-white p-3 rounded">
            <div class="row">
              <div class="col-lg-2 col-md-3 col-6 secondary-text">
                  <small class="mr-2"><i class="fas fa-eye"></i>  <span> {{__('public/blog.views')}}  (<b> {{ $posts->views }} </b>)  </span></small>
              </div>
              <div class="col-lg-2 col-md-3 col-6 secondary-text">
                  <small class="mr-2"><i class="fas fa-user"></i>  <span>  {{ ucwords($posts->first_name) }}  </span></small>
              </div>
              <div class="col-lg-2 col-md-3 col-6 secondary-text">
                 <small class="mr-2"><i class="fas fa-calendar-alt"></i>  <span> {{ date("M j, Y " , strtotime($posts->created)) }} </span></small>
              </div>
              <div class="col-lg-2 col-md-3 col-6 secondary-text">
                <small class="mr-2"><i class="far fa-comments"></i>   <span>  {{ $posts->comments }} comment(s)  </span></small>
              </div>
              <div class="col-lg-4 mt-3 mt-lg-0">
                <div class="social-widget float-lg-right text-center">
                  <div class="pp-title">
                    <div class="post-share">
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

				<div class="artical-body">
					<div class="post-img">


                @if(file_exists('./uploads/images/'.$posts->image) && $posts->image !='' )
				     	<div class="featureimg text-center">
                <img class="w-100" src="{{ asset('uploads/images/'.$posts->image) }}" alt="" >
                </div>
                @endif

						<div class="post-disc bg-white rounded-bottom">
						<div class="post-title text-center p-4 mb-4 mb-lg-5">
						<h3><a href="#">{{ $posts->title }} </a></h3>


							<div class="art-short-cont text-left">
                {!! PostHelpers::formatContent($posts->note) !!}

							</div>

						</div>

					</div>

      </div>
      <div id="my-comments"></div>

   </div>





@if(trim(config('settingConfig.ads_pages_bottom'))!='')
						  <br>
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

<script type="text/javascript">
$('.reply-comm').hide()
function toggleReply(id) {
  $(document).ready(function() {
      $('#reply'+id).toggle();
  });
}
</script>
<script>
    new Comments.default({
      el: '#my-comments',
      pageId: {{ $posts->pageID }},
      commentableId: {{ $posts->pageID }},
      commentableType: "App.Posts"
    })
</script>

@endsection
