<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
  @include('public/layouts/partials/head')
  @include('head_dev')


</head>
<body 123 >
      @php
         $isDevice = '';
        /* $mobileDetection = new MobileDetect();
        if($mobileDetection->isMobile())
          $isDevice = 'mobile';
        elseif($mobileDetection->isTablet())
          $isDevice = 'tablet';
        else
          $isDevice = 'desktop'; */
      @endphp

      <div class="div_{{$isDevice}} <?php if(Request::is('/') || Request::is('partner-thank-you')) { echo 'homepage'; }   ?>" id="div-dd">
          @include('public/layouts/partials/header')
              @yield('content')
          @include('public/layouts/partials/footer')
          @include('foot_dev')
      </div>

    </body>
</html>
