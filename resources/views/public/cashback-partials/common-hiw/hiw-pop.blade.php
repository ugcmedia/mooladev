<div class="modal fade" id="hiw-popup" tabindex="-1" role="dialog" aria-labelledby="hiw-popup" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-22 primary-text fw-700" id="hiw-popup">
          <span class="font-20 fw-700 icon-percentage2-icon v-middle mr-2"></span>
          {!! __('public/hiw-and-pop.hiw-pop-title') !!}
        </h5>
        <button type="button" class="modal-close close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row py-4">
          @php $hiwData =AppClass::getHIWPOP();$i=0; @endphp
          @foreach($hiwData as $hiw)
            <div class="col-lg-3 col-md-6 mb-3 mb-lg-0 text-center ">
              <div class=" @if($i==3) h-i-w-steps-last @else h-i-w-steps @endif mb-3">
              <img src="{{asset('uploads/images/blocks').'/'.$hiw->block_image}}" alt="">
            </div>
            <div class="cpn-lable">
              {!! $hiw->block_content !!}
            </div>
            </div>
            @php $i++; @endphp
          @endforeach
        </div>
        <div class="text-center">
          <h4 class="secondary-text fw-400 font-20 mb-4">{!! __('public/hiw-and-pop.thay_simple_txt') !!}</h4>
          @if(!Auth::guard('member')->check())
            <button type="button" class="btn btn-primary mr-0 mr-sm-5 mb-4" data-toggle="modal" data-target="#join-us-modal" data-dismiss="modal">{!! __('public/hiw-and-pop.join_us_now') !!}</button>
          @endif
          <button type="button" class="btn btn-outline-dark mb-4" data-dismiss="modal">{!! __('public/hiw-and-pop.back_to_offer') !!}</button>
        </div>
        <div class="text-center">
          <a href="{{url(config('pageList.howitworks'))}}" class="primary-text font-15 fw-700">{!! __('public/hiw-and-pop.more_about_hiw') !!}</a>
        </div>
      </div>

    </div>
  </div>
</div>
