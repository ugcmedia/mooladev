@extends('public.layouts.app')
<?php
// $mobileDetection = new MobileDetect();
// if(!$mobileDetection->isMobile())
  $pageimage = asset('public_assets/images/page-header-bg.jpg');
// else
  // $pageimage = asset('public_assets/images/mobile-page-header-bg.jpg');

if(!empty($image)) {
  if($mobileDetection->isMobile()) {
    $pageimage = asset('uploads/images').'/mobile-'.$image;
  } else {
    $pageimage = asset('uploads/images').'/'.$image;
  }
}
// $pageimage = asset('public_assets/images/page-header-bg.jpg');
// if(!empty($image))
//   $pageimage = asset('uploads/images').'/'.$image;
?>

<section class="sec-page-header" style="background-image:url('{{$pageimage}}')">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-8">
        <h1 class="page-title-h1 promo-text">{{$title}}</h1>
        <p class="font-24 fw-400 success-text">{!! $subtitle !!}</p>
      </div>
    </div>
  </div>
</section>
<!-- Page Header End -->
<section class="section py-5" id="main-page">
	<div class="container">
		<div class="policy-detail rounded  bg-white p-5">
  		<?php echo $content ;?>
		</div>
  	</div>
</section>
