@extends('layouts.app')

@section('content')
<section class="page-header row">
	<h2> {{ $pageTitle }} <small> {{ $pageNote }} </small></h2>
	<ol class="breadcrumb">
		<li><a href="{{ url('') }}"> Dashboard </a></li>
		<li><a href="{{ url($pageModule) }}"> {{ $pageTitle }} </a></li>
		<li class="active"> View  </li>		
	</ol>
</section>
<div class="page-content row">
	<div class="page-content-wrapper no-margin">
	
	<div class="sbox">
		<div class="sbox-title clearfix">
			<div class="sbox-tools pull-left" >
		   		<a href="{{ ($prevnext['prev'] != '' ? url('usertips/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips btn btn-sm"><i class="fa fa-arrow-left"></i>  </a>	
				<a href="{{ ($prevnext['next'] != '' ? url('usertips/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips btn btn-sm "> <i class="fa fa-arrow-right"></i>  </a>					
			</div>	

			<div class="sbox-tools" >
				@if($access['is_add'] ==1)
		   		<a href="{{ url('usertips/'.$id.'/edit?return='.$return) }}" class="tips btn btn-sm  " title="{{ __('core.btn_edit') }}"><i class="fa  fa-pencil"></i></a>
				@endif
				<a href="{{ url('usertips?return='.$return) }}" class="tips btn btn-sm  " title="{{ __('core.btn_back') }}"><i class="fa  fa-times"></i></a>		
			</div>
		</div>
		<div class="sbox-content">
			<div class="table-responsive">
				<table class="table table-striped " >
					<tbody>	
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Tipid', (isset($fields['tipid']['language'])? $fields['tipid']['language'] : array())) }}</td>
						<td>{{ $row->tipid}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Name', (isset($fields['name']['language'])? $fields['name']['language'] : array())) }}</td>
						<td>{{ $row->name}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Page', (isset($fields['page']['language'])? $fields['page']['language'] : array())) }}</td>
						<td>{{ $row->page}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Tip Key', (isset($fields['tip_key']['language'])? $fields['tip_key']['language'] : array())) }}</td>
						<td>{{ $row->tip_key}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Note', (isset($fields['note']['language'])? $fields['note']['language'] : array())) }}</td>
						<td>{{ $row->note}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Status', (isset($fields['enabled']['language'])? $fields['enabled']['language'] : array())) }}</td>
						<td>{{ $row->enabled}} </td>
						
					</tr>
				
					</tbody>	
				</table>   

			 	

			</div>
		</div>
	</div>
	</div>
</div>
@stop
