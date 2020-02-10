<!-- how it woks home -->

<section class="how-it-works-home py-5">
  <div class="container">
    <div class="row mb-4">
      <div class="col-lg-12 text-center">
        <h1 class="section-title font-24 fw-800">{{__('public/homepage.hp_how_to_get_cb')}} {{config('sximo.cnf_appname')}}?</h1>
      </div>
    </div>
    <div class="h-i-w-home-cont">
      <div class="row">
        <?php $i= 0;
          $howitWorks = AppClass::getHIW();
          $total      = count($howitWorks);
         ?>
         @foreach($howitWorks as $hiw )
         <?php $i++; ?>
            <div class="col-lg-3 mob-br col-md-6 text-center">
              <div class="h-i-w-step">
                <img data-src="{{asset('uploads/images/blocks').'/'.$hiw->block_image}}" alt="">
              </div>
              <div class="h-step-num position-relative">
                <div class="h-step-count">
                  <span>{{$i}}</span>
                </div>
                <div class="h-step-name">
                  @if($i == $total)
                    <span class="font-40 fw-700 primary-text mb-0 d-inline-block">{{$hiw->title}}</span>
                  @else
                  <p class="font-40 fw-700 primary-text mb-0 d-inline-block">{{$hiw->title}}</p>
                  @endif
                </div>
              </div>
              <p class="text-dark font-13 fw-400">{!! $hiw->block_content !!} </p>
            </div>
          @endforeach
        </div>
      <div class="text-center mt-5">
        <a href="{{url(config('pageList.howitworks'))}}" target="_blank"><button type="button" class="btn btn-primary"><i class="far fa-arrow-alt-circle-right"></i> {{__('public/homepage.hp_hiw_detail_btn')}}</button></a>
      </div>
    </div>

  </div>
</section>
