<div class="artical-sidebar">
  <div class="popular-post-list bg-white rounded p-3 mb-4 mt-4 mt-lg-0">
    <div class="pp-title">
      <h5 class="pb-2 border-bottom">{{__('public/blog.popolar_post')}}</h5>
    </div>
    <div class="pp-list-grp">
      <ul class="list-unstyled">
    @foreach($popular as $pop)
        <li class="media mb-3">
          <a href="{{ url('blog/'.$pop->alias) }}" >
          @if(file_exists('./uploads/images/'.$pop->image) && $pop->image !='' )
          <img class="mr-3" src="{{ asset('uploads/images/'.$pop->image) }}" alt=""  width="100px" height="auto">
          @else
          <img src="{{ asset('uploads/images/no-image.png') }}" alt="" class="mr-3" width="100px" height="auto">
          @endif
          <div class="media-body">
           <div class="pp-text font-13">
             <a href="{{ url('blog/'.$pop->alias) }}">{{ mb_strimwidth($pop->title, 0, 60, "...") }}</a>
           </div>

          </div>
        </a>
        </li>
    @endforeach
      </ul>
    </div>
  </div>

  <div class="latest-post-list bg-white rounded p-3 mb-4">
    <div class="pp-title">
      <h5 class="pb-2 border-bottom">{{__('public/blog.latest_post')}}</h5>
    </div>
    <div class="pp-list-grp">
      <ul class="list-unstyled">
        @foreach($latest as $lates)

        <li class="media">
          <a href="{{ url('blog/'.$lates->alias) }}" >
          @if(file_exists('./uploads/images/'.$lates->image) && $lates->image !='' )
          <img class="mr-3" src="{{ asset('uploads/images/'.$lates->image) }}" alt="" width="100px" height="auto" >
          @else
          <img src="{{ asset('uploads/images/no-image.png') }}" alt="" class="mr-3" width="100px" height="auto">
          @endif
          <div class="media-body">
           <div class="lt-text font-13">
             <a href="{{ url('blog/'.$lates->alias) }}">{{ mb_strimwidth($lates->title, 0, 60, "...") }}</a>
            <p class="text-muted"><small> {{date('M d y',strtotime($lates->created))}}</small></p>
           </div>
          </div>
        </a>
        </li>
        @endforeach
      </ul>
    </div>
  </div>
</div>


@if(trim(config('settingConfig.ads_sidebar_1'))!='')
	<br>
		<div class="gbands latest-post-list bg-white rounded p-3 mb-4 text-center" id="gband-sidebar1">

		{!! stripcslashes(config('settingConfig.ads_sidebar_1')) !!}
		</div>
		@endif
