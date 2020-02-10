<html>
<title></title>
<meta charset="UTF-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
	 <meta http-equiv="cache-control" content="max-age=0" />
 <meta http-equiv="cache-control" content="no-cache" />
 <meta http-equiv="expires" content="0" />
 <link rel="stylesheet" href="{{asset('public_assets/css/out-page.css')}}">
 <meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
 <meta http-equiv="pragma" content="no-cache" />
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <meta name="description" content="">
 <meta http-equiv="refresh" content="3;url={{$data['url']}}">
 <title>Redirecting you to Merchant Page</title>
@include('public.layouts.partials.head')
<body>
<section class="out-page-main py-5">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8">
        <div class="out-page-cont div-inner-white py-3 border rounded text-center">
          <div class="progress-wrap">
        <div class="progress">
            <div
                 class="progress-bar"
                 role="progressbar"
                 style="width: 0%;"
                 aria-valuenow="100"
                 aria-valuemin="0"
                 aria-valuemax="100">
              <span class="value-wrapper">
                <span class="value-label">0</span>%
              </span>
            </div>
        </div>
    </div>
          <div class="out-page-top py-4 border-bottom">
            @php
              $cbStr  = '';
              if(($data['record']->cashback_enabled=='Y')) {
                $cbStr  =   AppClass::getUptoText(	$data['record']->cashback,	$data['record']->StoreCashback);
				if(Auth::guard('member')->check())
                $cbStr  = __('public/cb-popup.outpage_congras_cashback_txt',['cb_out_string' =>$cbStr,'company_name' => config('sximo.cnf_appname')]);
              }
              else {
                  $cbStr = __('public/cb-popup.outpage_congras_nocb_txt',['store_name' => $data['record']->store_name]);
              }
            @endphp
            @if(Auth::guard('member')->check())
              <div class="out-header-logo mb-3">
                <img src="{{asset('public_assets/images/round.png')}}" class="img-fluid" alt="">
              </div>
              <div class="out-header-caption">

                <h2 class="font-24 fw-700 text-dark mb-4"> {!!  $cbStr !!}</h2>
				@if(($data['record']->cashback_enabled=='Y'))
                <p class="font-20 fw-400 text-dark">{!! __('public/cb-popup.outpage_desc',['company_name' => config('sximo.cnf_appname')])!!}</p>
				@endif
              </div>
            @else
              <div class="out-header-logo mb-3">
                <img src="{{asset('public_assets/images/Right-Arrow.png')}}" class="img-fluid" alt="">
                <img src="{{asset('public_assets/images/Rupee-icon.png')}}" class="img-fluid" alt="">
                <img src="{{asset('public_assets/images/Left-Arrow.png')}}" class="img-fluid" alt="">
              </div>
              <div class="out-header-caption">
				@if(($data['record']->cashback_enabled=='Y'))
                <h2 class="font-24 fw-700 text-dark mb-4">{!! __('public/cb-popup.outpage_loss_txt',['cb_out_string' =>$cbStr])!!}</h2>
				@else
				<h2 class="font-24 fw-700 text-dark mb-4">{!!__('public/cb-popup.outpage_congras_nocb_txt',['store_name' => $data['record']->store_name])!!}</h2>
				@endif	
                <p class="font-20 fw-400 text-dark">{!! __('public/cb-popup.out_login_txt') !!}</p>
              </div>
            @endif
          </div>
          <div class="out-page-bottom border-bottom py-4">
            <div class="out-store div-inner-white shadow d-inline-block mx-auto p-2 rounded border my-4">
                @if(isset($data['record']->store_logo))
                  <img src="{{asset('uploads/images/store').'/'.	$data['record']->store_logo}}" alt="">
                @endif
            </div>
            <p class="text-dark font-24 fw-600">{!! __('public/cb-popup.outpage_one_moment', ['store_name' => $data['record']->store_name]) !!}</p>
          </div>
        @if(Auth::guard('member')->check() && ($data['record']->cashback_enabled=='Y') )
          @php
              $getOutBlock  = AppClass::getBlockContent('out_page');
          @endphp
          <div class="help-us-cont py-4">
            <h3 class="text-dark font-20 fw-700 text-center mb-5">{!! __('public/cb-popup.outpage_block_heading') !!}</h3>
            <div class="row">
            @foreach($getOutBlock as $block)
                  <div class="col-sm-4">
                    <div class="help-us-cont">
                      <img src="{{asset('uploads/images/blocks/').'/'.$block->block_image}}" class="img-fluid mb-3" alt="">
                      <p class="font-15 fw-400 text-dark">{!! $block->title !!}</p>
                    </div>
                  </div>
            @endforeach
            </div>
           </div>
          @endif
        </div>
        <p class="text-dark font-15 fw-400 text-center mt-3">{!! __('public/cb-popup.outpage_taking_too_long_txt') !!} <a href="{{$data['url']}}" class="primary-link">click here</a></p>
      </div>
    </div>
  </div>
</section>
</body>
<script type="text/javascript">
jQuery(document).ready(function($) {
$('.progress-bar').each(function(i, progressBar) {
  var $progressBar = $(progressBar),
      $valueLabel = $progressBar.find('.value-label'),
      value = $(progressBar).attr('aria-valuenow');


  $({
      countNum: $valueLabel.text()
  }).animate({
      countNum: value,

  }, {
      duration: 3500,
      easing: 'linear',
      step: function() {
          $valueLabel.text(Math.floor(this.countNum));
      },
      complete: function() {
          $valueLabel.text(this.countNum);
          //alert('finished');
      }

  });

  $progressBar.css({
      'width': value + '%'
  })
})
})
</script>
