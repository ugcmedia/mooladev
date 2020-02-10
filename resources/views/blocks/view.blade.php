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
		   		<a href="{{ ($prevnext['prev'] != '' ? url('blocks/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips btn btn-sm"><i class="fa fa-arrow-left"></i>  </a>	
				<a href="{{ ($prevnext['next'] != '' ? url('blocks/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips btn btn-sm "> <i class="fa fa-arrow-right"></i>  </a>					
			</div>	

			<div class="sbox-tools" >
				@if($access['is_add'] ==1)
		   		<a href="{{ url('blocks/'.$id.'/edit?return='.$return) }}" class="tips btn btn-sm  " title="{{ __('core.btn_edit') }}"><i class="fa  fa-pencil"></i></a>
				@endif
				<a href="{{ url('blocks?return='.$return) }}" class="tips btn btn-sm  " title="{{ __('core.btn_back') }}"><i class="fa  fa-times"></i></a>		
			</div>
		</div>
		<div class="sbox-content">
			<div class="table-responsive">
				<table class="table table-striped " >
					<tbody>	
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Block Id', (isset($fields['block_id']['language'])? $fields['block_id']['language'] : array())) }}</td>
						<td>{{ $row->block_id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Block Type', (isset($fields['block_type']['language'])? $fields['block_type']['language'] : array())) }}</td>
						<td>{{ SiteHelpers::formatLookUp($row->block_type,'block_type','1:tb_status:status_code:status_name') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Title', (isset($fields['title']['language'])? $fields['title']['language'] : array())) }}</td>
						<td>{{ $row->title}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Block Content', (isset($fields['block_content']['language'])? $fields['block_content']['language'] : array())) }}</td>
						<td>{{ $row->block_content}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Block Image', (isset($fields['block_image']['language'])? $fields['block_image']['language'] : array())) }}</td>
						<td>{!! SiteHelpers::formatRows($row->block_image,$fields['block_image'],$row ) !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Promo Link', (isset($fields['promo_link']['language'])? $fields['promo_link']['language'] : array())) }}</td>
						<td>{{ $row->promo_link}} </td>
						
					</tr>
				
					</tbody>	
				</table>   

			 	

			</div>
		</div>
	</div>
	</div>
</div>
@stop
