<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
<meta charset="utf-8">

<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }} | {{ config('sximo.cnf_appname') }}</title>
    <link rel="shortcut icon" href="{{ asset('uploads/images/').'/'.config('sximo.cnf_favicon')}}" type="image/x-icon">
    <!-- CSS Files -->
   <!--  <link href="{{ asset('frontend/default/app.css') }}" rel="stylesheet" />
    <link href="{{ asset('frontend/default/style.css') }}" rel="stylesheet" media="screen" /> -->

    <link href="{{ asset('sximo5/fonts/icomoon.css') }}" rel="stylesheet" />
    <link href="{{ asset('sximo5/fonts/awesome/css/font-awesome.css') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    @include('public/layouts/partials/head')
  </head>
    @include('public/layouts/partials/header')
    <section id="main-content">
        @include($pages)
    </section>
    @include('public/layouts/partials/footer')
</html>
