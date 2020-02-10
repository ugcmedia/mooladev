@php
 $getCounter =explode(PHP_EOL,config('settingConfig.hp_stats'));
@endphp
<section class="user-stats primary-section py-5">
<div class="container">
  <div class="row">
    <div class="col-6 col-lg-3 col-sm-6 text-center mb-5 mb-lg-0">
      <div class="u-stats-icon mb-3">
        <i class="fas fa-handshake success-text font-48"></i>
      </div>
      <div class="u-stats-count mb-3">
        @php $stat0 = explode('|',$getCounter[0]); @endphp
        <span class="success-text font-48 fw-400">{{$stat0[1]}} +</span>
      </div>
      <div class="u-stats-title mb-3">
        <span class="success-text font-22 fw-400">{{$stat0[0]}}</span>
      </div>
    </div>
    @php $stat1 = explode('|',$getCounter[1]); @endphp
    <div class="col-6 col-lg-3 col-sm-6 text-center mb-5 mb-lg-0">
      <div class="u-stats-icon mb-3">
        <i class="fas fa-exchange-alt success-text font-48"></i>
      </div>
      <div class="u-stats-count mb-3">
        <span class="success-text font-48 fw-400">{{$stat1[1]}} +</span>
      </div>
      <div class="u-stats-title mb-3">
        <span class="success-text font-22 fw-400">{{$stat1[0]}} </span>
      </div>
    </div>
    @php $stat2 = explode('|',$getCounter[2]); @endphp
    <div class="col-6 col-lg-3 col-sm-6 text-center ">
      <div class="u-stats-icon mb-3">
        <i class="fas fa-users success-text font-48"></i>
      </div>
      <div class="u-stats-count mb-3">
        <span class="success-text font-48 fw-400">{{$stat2[1]}} +</span>
      </div>
      <div class="u-stats-title mb-3">
        <span class="success-text font-22 fw-400">{{$stat2[0]}}</span>
      </div>
    </div>
    @php $stat3 = explode('|',$getCounter[3]); @endphp
    <div class="col-6 col-lg-3 col-sm-6 text-center ">
      <div class="u-stats-icon mb-3">
        <i class="fas fa-shopping-bag success-text font-48"></i>
      </div>
      <div class="u-stats-count mb-3">
        <span class="success-text font-48 fw-400">{{$stat3[1]}} +</span>
      </div>
      <div class="u-stats-title mb-3">
        <span class="success-text font-22 fw-400">{{$stat3[0]}}</span>
      </div>
    </div>
  </div>
 </div>
</section>
