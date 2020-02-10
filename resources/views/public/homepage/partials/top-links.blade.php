<section class="footer pt-5">
  <div class="container">
    <div class="footer-top py-5">
      <div class="row">
      @php
        $topFooter = AppClass::getTopFooter();
      @endphp
      @foreach($topFooter as $tfooter)
        <div class="col-6 col-lg-2 col-md-3">
          <div class="ft-link">
            <span class="text-dark fw-700">{{$tfooter->title}}</span>
              <ul class="list-unstyled">
                @if($tfooter->list_type == 'stores')
                    @foreach(AppClass::getStoreByList($tfooter->stores) as $ftstores)
                      <li><a href="{{url('store/'.str_slug($ftstores->store_slug))}}" class="success-link font-13 fw-400">{{$ftstores->store_name}} offers</a></li>
                    @endforeach
                 @elseif($tfooter->list_type == 'categories')
                     @foreach(AppClass::getCatByList($tfooter->categories) as $ftcat)
                       <li><a href="{{url('category/'.str_slug($ftcat->cat_slug))}}" class="success-link font-13 fw-400">{{$ftcat->cat_name}} offers</a></li>
                     @endforeach
                  @elseif($tfooter->list_type == 'brand')
                      @foreach(AppClass::getBrandByList($tfooter->brands) as $ftbrand)
                        <li><a href="{{url('brand/'.str_slug($ftbrand->brand_slug))}}" class="success-link font-13 fw-400">{{$ftbrand->brand_name}} offers</a></li>
                      @endforeach
                  @elseif($tfooter->list_type == 'tag')
                     @foreach(AppClass::getTagsByList($tfooter->tags) as $ftags)
                       <li><a href="{{url('tag/'.str_slug($ftags->tag_slug))}}" class="success-link font-13 fw-400">{{$ftags->tag_name}} offers</a></li>
                     @endforeach
                 @endif
            </ul>
          </div>
        </div>
        @endforeach
      </div>
  </section>
