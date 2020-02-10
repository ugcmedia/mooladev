@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "SiteHelpers::_sort") /*--}}
<section class="page-header row">
	<h2> {{ $pageTitle }} <small> {{ $pageNote }} </small></h2>
	<ol class="breadcrumb">
		<li><a href="{{ url('') }}"> Dashboard </a></li>
		<li class="active"> {{ $pageTitle }} </li>		
	</ol>
</section>
<div class="page-content row">
	<div class="page-content-wrapper no-margin"> 	

		<div class="sbox">
			<div class="sbox-title"><h1> All Records <small> </small></h1></div>
			
	<div class="sbox-content "> 



	
	 <div class="table-responsive" style="min-height:300px;">
	 <div id="{{ $pageModule }}Grid">
    

            @foreach ($rowData as $row)
              <a href="{{ url('/etemplate/'.$row->email_key.'.html') }}" href="_blank" class="ListView"><h5>{{$row->purpose}}</h5></a><br>
            @endforeach
        
	</div>
	
	</div>
	
	
	</div>
</div>	
	</div>	  

@stop