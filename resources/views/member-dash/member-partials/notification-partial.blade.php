<div class="notify-title">
  <a href="<?php /*
   if( strpos('pad'.$cbSlug,'http') || $cbSlug=='#' ) echo $cbSlug;  else  echo url('/member/'.$cbSlug); */
   ?>"><h6 class="font-weight-bold"> {{--$cbTitle--}} </h6></a>
</div>

<div class="notify-desc">
  <p>{{--!! $cbContent!! --}}</p>
</div>

<div class="notify-time">
  <p class="text-dark">{{-- date(config('sximo.cnf_date'),strtotime($cbChangeTime)) --}}</p>
</div>
