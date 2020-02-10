<link rel="stylesheet" href="{{asset('public_assets/css/store-mobile-header.css')}}">
<section class="store-header-mobile py-4 ">
<div class="container">
<div class="st-mob-header-cont p-2 div-inner-white rounded">
  @php
   $storeimg = ($data['store']->store_logo != '')? asset('uploads/images/store').'/'.$data['store']->store_logo : asset('uploads/images/no-image.jpg');
  @endphp
    <div class="row">
      <div class="col-12">
        <div class="store-brd">
          <nav aria-label="breadcrumb p-0">
            <ol class="breadcrumb p-0">
              <li class="breadcrumb-item secondary-text-dark font-13 fw-300"><a href="{{url('/')}}" class="secondary-text-dark">{{__('public/storepage.home')}}</a></li>
              <li class="breadcrumb-item secondary-text-dark font-13 fw-300"><a href="{{url('all-stores')}}" class="secondary-text-dark">{{__('public/storepage.stores')}}</a></li>
              <li class="breadcrumb-item active font-13 fw-300" aria-current="page">{{$data['store']->store_name}}</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="col-5">
        <a href="#">
        <div class="store-info div-inner-white rounded text-center mb-4">
          <div class="store-info-logo p-3">
            <img src="{{$storeimg}}" alt="">
          </div>

          <div class="p-31">
          <div class="store-main-cb-wrapp d-inline-flex1">
            @if($data['store']->cashback_enabled == 'Y' && $data['store']->cashback != '')
            <div class="store-main-cb border rounded px-3">
              <p class="mb-0 store-main-cb-lable d-inline-block1 div-inner-white font-12 secondary-text fw-400">{!! ucfirst(__('public/storepage.cb_up_to_txt',['type' => $data['store']->cashback_type])) !!}</p>
              <p class="store-main-cb-count d-inline-block1 mb-2 py-2 px-3 rounded fw-900 font-12">{{AppClass::getOnlyCashbackValue($data['store']->cashback)}}</p>
              <p  class="mb-0 store-main-cb-view d-inline-block1 font-15 fw-800 primary-link div-inner-white" data-toggle="modal" data-target="#cb-details-modal">{{__('public/storepage.view_details')}}</p>
                  @include('public/store/store-partials/cb-model')
             </div>
            @endif
          </div>


          </div>
        </div>
        </a>
      </div>
      <div class="col-7">
        <div class="store-title">
          <div class="common-subscription-msg iziToast-target"></div>

          @if(Auth::guard('member')->check())
            <a href="#0" onclick="addSubscriber({{$data['store']->store_id}},'store','{{route('add.subscribe')}}','common-subscription-msg')">
              <i class="far fa-heart  secondary-text-light float-right s-favorite-ico "   id="not-subscribed"></i>
            </a>
            <a href="{{route('member.favourites')}}">
              <i class="fas fa-heart  secondary-text-light float-right s-favorite-ico " id="subscribed"></i>
            </a>
          @else
            <i class="far fa-heart  secondary-text-light float-right s-favorite-ico "  data-toggle="modal" id="not-subscribed"  data-toggle="modal" data-target="#login-modal"></i>
          @endif
            <h1 class="font-32 text-dark fw-400">{{AppClass::getHTag($data['store']->store_name,$data['store']->h1_tag,'store','h1')}}</h1>
          </div>
          @if(strip_tags($data['store']->main_desc) != '' || strip_tags($data['store']->main_desc) != null)
          <div class="store-meta-disc">
            <p class="mb-2 mb-lg-0 font-12 secondary-text">
              {!! mb_strimwidth($data['store']->main_desc, 0, 182, "...")!!}
            </p>
          </div>
          @endif
          <div class="store-review-star">
        <input type="hidden" name="storeRate" value="{{round($data['store']->rate_vote)}}"/>
            <ul class="list-inline mb-0" id="storeRating">

               <?php for($ri=1;$ri<6;$ri++){
               if(round($data['store']->rate_vote) >= $ri)
               echo '<li class="list-inline-item ratestar rating_highlight" id="rali'.$ri.'"><a ><i class="fas fa-star promo-text"></i></a></li>';
             else
               echo '<li class="list-inline-item ratestar" id="rali'.$ri.'"><a ><i class="far fa-star promo-text"></i></a></li>';
                } ?>
            </ul>
          </div>
          <div class="store-reviews-count">
            <span class="primary-text font-13 fw-700 mb-3"><span class="ratingVal">{{round($data['store']->rate_vote)}} ({{$data['store']->rate_count}} </span>{{__('public/storepage.reviews')}})</span>
          </div>

          @if($data['store']->direct_store_link != null && $data['store']->direct_store_link != '' )
           <div class="store-visit shadow-btn mt-4 mb-2">
              <a href="javascript:void(0)" onclick="openAjaxPopup({{$data['store']->store_id}},'store','{{$data['store']->cashback_enabled}}')"
                  class="shadow-btn btn btn-secondary text-uppercase font-12 fw-700">{{__('public/storepage.visit_btn')}} {{$data['store']->store_name}}
              </a>
            </div>
            @endif
      </div>
    </div>
  </div>
</div>
</section>
