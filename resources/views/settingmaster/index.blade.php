@extends('layouts.app')

@section('content')
<section class="page-header row">
  <h3> {{ $pageTitle }} <small> {{ $pageNote }} </small></h3>
  <ol class="breadcrumb">
    <li><a href="{{ url('dashboard')}}"> Home </a></li>
    <li  class="active"> {{ $pageTitle }} </li>
  </ol>
</section>
<div class="page-content row">
	<div class="page-content-wrapper no-margin">
		<div class="resultData"></div>
		<div id="{{ $pageModule }}View"></div>			
		<div id="{{ $pageModule }}Grid"></div>
	</div>
</div>			

<script>
$(document).ready(function(){
	reloadData('#{{ $pageModule }}','{{ $pageModule }}/data');	
});	
</script>	
@endsection