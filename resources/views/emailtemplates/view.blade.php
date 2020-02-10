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
		   		<a href="{{ ($prevnext['prev'] != '' ? url('emailtemplates/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips btn btn-sm"><i class="fa fa-arrow-left"></i>  </a>	
				<a href="{{ ($prevnext['next'] != '' ? url('emailtemplates/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips btn btn-sm "> <i class="fa fa-arrow-right"></i>  </a>					
			</div>	

			<div class="sbox-tools" >
				@if($access['is_add'] ==1)
		   		<a href="{{ url('emailtemplates/'.$id.'/edit?return='.$return) }}" class="tips btn btn-sm  " title="{{ __('core.btn_edit') }}"><i class="fa  fa-pencil"></i></a>
				@endif
				<a href="{{ url('emailtemplates?return='.$return) }}" class="tips btn btn-sm  " title="{{ __('core.btn_back') }}"><i class="fa  fa-times"></i></a>		
			</div>
		</div>
		<div class="sbox-content">
			<div class="table-responsive">
				<table class="table table-striped " >
					<tbody>	
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Template Id', (isset($fields['template_id']['language'])? $fields['template_id']['language'] : array())) }}</td>
						<td>{{ $row->template_id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Template Purpose', (isset($fields['purpose']['language'])? $fields['purpose']['language'] : array())) }}</td>
						<td>{{ $row->purpose}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Body', (isset($fields['body']['language'])? $fields['body']['language'] : array())) }}</td>
						<td>{{ $row->body}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Email Subject', (isset($fields['subject']['language'])? $fields['subject']['language'] : array())) }}</td>
						<td>{{ $row->subject}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Email Key', (isset($fields['email_key']['language'])? $fields['email_key']['language'] : array())) }}</td>
						<td>{{ $row->email_key}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Module', (isset($fields['module']['language'])? $fields['module']['language'] : array())) }}</td>
						<td>{{ $row->module}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Sms Body', (isset($fields['sms_body']['language'])? $fields['sms_body']['language'] : array())) }}</td>
						<td>{{ $row->sms_body}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Status', (isset($fields['enabled']['language'])? $fields['enabled']['language'] : array())) }}</td>
						<td>{{ $row->enabled}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Sender Name', (isset($fields['sender_name']['language'])? $fields['sender_name']['language'] : array())) }}</td>
						<td>{{ $row->sender_name}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Sms Enabled', (isset($fields['sms_enabled']['language'])? $fields['sms_enabled']['language'] : array())) }}</td>
						<td>{{ $row->sms_enabled}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Sender Email', (isset($fields['sender_email']['language'])? $fields['sender_email']['language'] : array())) }}</td>
						<td>{{ $row->sender_email}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Reply To', (isset($fields['reply_to']['language'])? $fields['reply_to']['language'] : array())) }}</td>
						<td>{{ $row->reply_to}} </td>
						
					</tr>
				
					</tbody>	
				</table>   

			 	

			</div>
		</div>
	</div>
	</div>
</div>
@stop
