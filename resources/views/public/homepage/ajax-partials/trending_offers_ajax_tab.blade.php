<div id="trending-owl" class="trending-owl">
  <div class="owl-carousel owl-theme">
    @foreach(AppClass::getTrendingOffers($cat_code) as $offers)
      <div class="item">
        <div class="trending-item">
          @if($offers->link_type == 'internal')
                <a href="{{$offers->slider_link}}" title="{{$offers->friendly_title}}">
              @else
                <a href="#" onclick="openAjaxPopup({{$offers->slider_id}},'slider','Y')"  role="button">
              @endif
                <img class="img-fluid" src="{{asset('uploads/images/slider').'/'.$offers->slider_image}}"  alt="">
            </a>
        </div>
      </div>
    @endforeach
  </div>
</div>


<?php /*           <div class="container-fluid">

			  <div id="TOcarousel{{$cat_code}}" class="carousel slide TOcarousel" data-ride="carousel" data-interval="9000">
				<div class="carousel-inner row w-100 mx-auto" role="listbox">
				<?php $il = 0?>
                @foreach(AppClass::getTrendingOffers($cat_code) as $offers)
                  <div class="carousel-item col-md-4 @if($il++ ==0) active @endif ">
                    <div class="trending-item">
                      @if($offers->link_type == 'internal')
                            <a href="{{$offers->slider_link}}" title="{{$offers->friendly_title}}">
                          @else
                            <a href="#" onclick="openAjaxPopup({{$offers->slider_id}},'slider','{{route('getAjaxPopup.common')}}')"  role="button">
                          @endif
                            <img  class="img-fluid mx-auto d-block" src="{{asset('uploads/images/slider').'/'.$offers->slider_image}}"  alt="">
                        </a>
                    </div>
                  </div>
                @endforeach
				@foreach(AppClass::getTrendingOffers($cat_code) as $offers)
                  <div class="carousel-item col-md-4">
                    <div class="trending-item">
                      @if($offers->link_type == 'internal')
                            <a href="{{$offers->slider_link}}" title="{{$offers->friendly_title}}">
                          @else
                            <a href="javascript:void(0)" onclick="openAjaxPopup({{$offers->slider_id}},'slider','{{route('getAjaxPopup.common')}}')"  >
                          @endif
                            <img  class="img-fluid mx-auto d-block" src="{{asset('uploads/images/slider').'/'.$offers->slider_image}}"  alt="">
                        </a>
                    </div>
                  </div>
                @endforeach
              </div>
			  <a class="carousel-control-prev" href="#TOcarousel{{$cat_code}}" role="button" data-slide="prev">
            <i class="fa fa-chevron-left fa-lg text-muted"></i>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next text-faded" href="#TOcarousel{{$cat_code}}" role="button" data-slide="next">
            <i class="fa fa-chevron-right fa-lg text-muted"></i>
            <span class="sr-only">Next</span>
        </a>

			  </div>
            </div>
*/ ?>
