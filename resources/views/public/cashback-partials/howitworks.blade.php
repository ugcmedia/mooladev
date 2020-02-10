<div class="how-we-work div-inner-white py-3 mb-4 rounded">
  <ul class="list-inline mb-0">
    <li class="list-inline-item text-center hww-title">
      <h3 class="font-18 text-dark fw-700">{{__('public/storepage.how_works_txt')}}</h3>
    </li>
    @php $i=0; @endphp
    @foreach(AppClass::getHIWPOP() as $itworks)
     @php  $i++; @endphp
      <li class="list-inline-item hww-cont">
          <div class="h-w-steps d-flex justify-content-center align-items-center">
            <div class="h-w-steps-no success-text bg-promo p-2 mr-2 rounded">
              <span class="font-20 fw-700">{{$i}}</span>
            </div>
            <div class="h-w-steps-disc cpn-lable">
              <p class="font-12 mb-0">  {!!$itworks->block_content !!}</p>
            </div>
          </div>
        </li>
    @endforeach
  </ul>
</div>
