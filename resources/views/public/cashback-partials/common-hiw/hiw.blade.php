<div class="how-we-work div-inner-white py-3 mb-4 rounded">
  <ul class="list-inline mb-0">
    <li class="list-inline-item text-center hww-title">
      <div class="font-18 text-dark fw-700 h3">{{__('public/storepage.how_works_txt')}}</div>
    </li>
    @php $i=0; @endphp
    @foreach(AppClass::getHIWPOP() as $itworks)
     @php  $i++; @endphp
      <li class="list-inline-item hww-cont">
          <div class="h-w-steps d-flex justify-content-center align-items-center">
            <div class="h-w-steps-no success-text bg-promo py-1 px-2 mr-2 rounded">
              <span class="font-20 fw-700">{{$i}}</span>
            </div>
            <div class="h-w-steps-disc cpn-lable">
              <div class="font-12 mb-0">{!!$itworks->block_content !!}</div>
            </div>
          </div>
      </li>
    @endforeach
  </ul>
</div>
