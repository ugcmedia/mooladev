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
		   		<a href="{{ ($prevnext['prev'] != '' ? url('deltecontolr/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips btn btn-sm"><i class="fa fa-arrow-left"></i>  </a>	
				<a href="{{ ($prevnext['next'] != '' ? url('deltecontolr/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips btn btn-sm "> <i class="fa fa-arrow-right"></i>  </a>					
			</div>	

			<div class="sbox-tools" >
				@if($access['is_add'] ==1)
		   		<a href="{{ url('deltecontolr/'.$id.'/edit?return='.$return) }}" class="tips btn btn-sm  " title="{{ __('core.btn_edit') }}"><i class="fa  fa-pencil"></i></a>
				@endif
				<a href="{{ url('deltecontolr?return='.$return) }}" class="tips btn btn-sm  " title="{{ __('core.btn_back') }}"><i class="fa  fa-times"></i></a>		
			</div>
		</div>
		<div class="sbox-content">
			<div class="table-responsive">
				<table class="table table-striped " >
					<tbody>	
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Offer Id', (isset($fields['offer_id']['language'])? $fields['offer_id']['language'] : array())) }}</td>
						<td>{{ $row->offer_id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Offer Code', (isset($fields['offer_code']['language'])? $fields['offer_code']['language'] : array())) }}</td>
						<td>{{ $row->offer_code}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Code', (isset($fields['vendor_code']['language'])? $fields['vendor_code']['language'] : array())) }}</td>
						<td>{{ $row->vendor_code}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Offer Title', (isset($fields['offer_title']['language'])? $fields['offer_title']['language'] : array())) }}</td>
						<td>{{ $row->offer_title}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Offer Desc', (isset($fields['offer_desc']['language'])? $fields['offer_desc']['language'] : array())) }}</td>
						<td>{{ $row->offer_desc}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Offer Image', (isset($fields['offer_image']['language'])? $fields['offer_image']['language'] : array())) }}</td>
						<td>{{ $row->offer_image}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Offer Gallery', (isset($fields['offer_gallery']['language'])? $fields['offer_gallery']['language'] : array())) }}</td>
						<td>{{ $row->offer_gallery}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Offer Mrp', (isset($fields['offer_mrp']['language'])? $fields['offer_mrp']['language'] : array())) }}</td>
						<td>{{ $row->offer_mrp}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Offer Deal Price', (isset($fields['offer_deal_price']['language'])? $fields['offer_deal_price']['language'] : array())) }}</td>
						<td>{{ $row->offer_deal_price}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Offer Expiry', (isset($fields['offer_expiry']['language'])? $fields['offer_expiry']['language'] : array())) }}</td>
						<td>{{ $row->offer_expiry}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Offer Fine Print', (isset($fields['offer_fine_print']['language'])? $fields['offer_fine_print']['language'] : array())) }}</td>
						<td>{{ $row->offer_fine_print}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Offer Instructions', (isset($fields['offer_instructions']['language'])? $fields['offer_instructions']['language'] : array())) }}</td>
						<td>{{ $row->offer_instructions}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Offer Status', (isset($fields['offer_status']['language'])? $fields['offer_status']['language'] : array())) }}</td>
						<td>{{ $row->offer_status}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Offer Tags', (isset($fields['offer_tags']['language'])? $fields['offer_tags']['language'] : array())) }}</td>
						<td>{{ $row->offer_tags}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Clicks', (isset($fields['clicks']['language'])? $fields['clicks']['language'] : array())) }}</td>
						<td>{{ $row->clicks}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vote Up', (isset($fields['vote_up']['language'])? $fields['vote_up']['language'] : array())) }}</td>
						<td>{{ $row->vote_up}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vote Down', (isset($fields['vote_down']['language'])? $fields['vote_down']['language'] : array())) }}</td>
						<td>{{ $row->vote_down}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Offer Stats', (isset($fields['offer_stats']['language'])? $fields['offer_stats']['language'] : array())) }}</td>
						<td>{{ $row->offer_stats}} </td>
						
					</tr>
				
					</tbody>	
				</table>   

			 	

			</div>
		</div>
	</div>
	</div>
</div>
@stop
