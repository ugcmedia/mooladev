@extends('public.layouts.app')
@section('title')
{{ $title }} | {{ config('sximo.cnf_appname') }}
@endsection
@section('content')
@include($pages)
@endsection
