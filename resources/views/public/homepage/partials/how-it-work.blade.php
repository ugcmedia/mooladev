<section class="hp-how-it-work py-5">
  <div class="container">
    <h1 class="hp-hiw-title d-block fw-700 font-36 text-muted text-center mb-5">{{__('public/homepage.hp_how_it_works')}}</h1>
    <div class="hp-hiw-inner">
      <div class="row text-center">
        @foreach($data['hp_hiw'] as $hiw)
        <?php // dd($hiw) ?>
        <div class="col-lg-3 col-md-6 mb-3 mb-lg-0">
          <div class="hp-hiw-cont">
            <div class="hp-hiw-icon mb-3">
              <img src="{{asset($hiw->block_image)}}" alt="{!! $hiw->title !!}" class="img-fluid">
            </div>
            <div class="hp-hiw-caption">
              <p class="font-20 fw-700 text-muted hoi-title">{!! $hiw->title !!}</p>
              <p class="fm-arch text-muted">{!!$hiw->block_content!!}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>
</section>
