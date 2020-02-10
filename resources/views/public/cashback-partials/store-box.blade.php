

<div class="item h-100">
  <div class="hp-owl-card rounded h-100">

    <a href="{{url('vendor').'/'.$fStores->vendor_slug}}">
      <div class="hp-owl-card-inner  bg-white shadow-sm rounded h-100">
        <div class="owl-card-figure rounded">
          <img src="{{asset($fStores->outlet_primary_image)}}" alt="{{$fStores->outlet_name}}">
        </div>
        <div class="fd-store-logo bg-white border rounded p-1 text-center">
          <a href="{{url('vendor').'/'.$fStores->vendor_slug}}" title="{{$fStores->vendor_name}}" >
              <img src="{{asset($fStores->vendor_logo)}}" alt="{{$fStores->vendor_name}}">
          </a>
        </div>
        <div class="hp-owl-card-inner-in pb-3 text-center">
          <h4 class="text-muted fw-700 font-16">{!!$fStores->vendor_name!!}</h4>
          <p class="store-add text-muted font-14 fw-400 mb-0 px-2">{!!$fStores->outlet_address!!}</p>
        </div>
      </div>
    </a>
  </div>
</div>
