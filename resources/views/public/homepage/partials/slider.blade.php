<!-- main-banner -->
<section class="main-banner pb-3">
  <div class="container">
    <div class="section-inner-white p-0 p-md-3 shadow">
      <div class="row no-gutters row-flex">
        <div class="col-md-9">
          @if($data['device'] == 'mobile')
            @include('public/homepage/partials.mobile-main-slider')
          @else
          <?php  $i= 0; $totalSlide = Count($data['slider'] ); ?>
          <?php if($totalSlide > 0) { ?>
          <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
              @foreach($data['slider'] as $slide)
                  <li data-target="#carouselExampleIndicators" data-slide-to="{{$i}}" @if($i == 0) class="active" @endif></li>
                <?php $i++; ?>
              @endforeach
            </ol>
            <div class="carousel-inner" role="listbox">
              <?php  $j= 0;  ?>
                @foreach($data['slider'] as $slide)

                    <div   @if($j == 0) class ="carousel-item  active" @else class = "carousel-item"  @endif  @if($j == 0) style="background-image: url({{asset('uploads/images/slider').'/'.$slide->slider_image}})" @else data-bg="url({{asset('uploads/images/slider').'/'.$slide->slider_image}})" @endif >
                      @if($slide->link_type == 'internal')
                          <a href="{{$slide->slider_link}}" title="{{$slide->friendly_title}}"><div class="slempty">
                          </div> </a>
                          @else
                          <a href="#" onclick="openAjaxPopup({{$slide->slider_id}},'slider','{{$slide->cashback_enabled}}')"  role="button"><div class="slempty">

                          </div></a>
                          @endif

                      </div>
                  <?php  $j++; ?>

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
      <?php } ?>
      @endif
      </div>


      <div class="col-md-3">
        <div class="slider-cont">
          <div class="slider-right pl-0 pl-md-3 mt-3 mt-md-0">
            <?php $x = 0;  ?>
            @foreach($data['side_slider']   as $slide)
                @if($x == 0)
                <div class="right-slide pb-3">
                  @if($slide->link_type == 'internal')
                      <a href="{{$slide->slider_link}}" title="{{$slide->friendly_title}}">
                      @else
                        <a   href="#" onclick="openAjaxPopup({{$slide->slider_id}},'slider','Y')"  role="button">
                      @endif
                      <img src="{{asset('uploads/images/slider').'/'.$slide->slider_image}}" ></a>
                </div>
               @endif
               @if($x == 1)
                 <div class="right-slide">
                   @if($slide->link_type == 'internal')
                        <a href="{{$slide->slider_link}}" title="{{$slide->friendly_title}}">
                       @else
                         <a   href="#" onclick="openAjaxPopup({{$slide->slider_id}},'slider','Y')"  role="button">
                       @endif
                       <img src="{{asset('uploads/images/slider').'/'.$slide->slider_image}}" ></a>
                  </div>
                  @endif
              <?php $x++; ?>
              @endforeach
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>


</section>
