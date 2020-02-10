

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
  <ol class="carousel-indicators">
    @php $j=0; $totalSlide = Count($data['slider'] ); @endphp
    @foreach($data['slider'] as $slide)
    <li data-target="#carouselExampleIndicators" data-slide-to="{{$j}}" @if($j == 0) class="active" @endif></li>
    @php $j++; @endphp
    @endforeach
  </ol>
  <div class="carousel-inner">
    <?php  $m= 0;  ?>
      @foreach($data['slider'] as $slide)
      <div class="carousel-item @if($m == 0) active @endif">
        @if($slide->link_type == 'internal')
          <a href="{{$slide->slider_link}}" title="{{$slide->friendly_title}}">
            <img class="d-block w-100" src="{{asset('uploads/images/slider').'/'.$slide->slider_image}}" alt="{{$slide->friendly_title}}">
          </a>
          @else
          <a href="#" onclick="openAjaxPopup({{$slide->slider_id}},'slider','Y')"  role="button">
            <img class="d-block w-100" src="{{asset('uploads/images/slider').'/'.$slide->slider_image}}" alt="{{$slide->friendly_title}}">
          </a>
          @endif
      </div>
    <?php  $m++; ?>
      @endforeach
  </div>
  <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true">‹</span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true">›</span>
    <span class="sr-only">Next</span>
  </a>
  
</div>
