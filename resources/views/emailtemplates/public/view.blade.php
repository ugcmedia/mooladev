<div class="m-t" style="padding-top:25px;">	
    <div class="row m-b-lg animated fadeInDown delayp1 text-center">
        <h3> {{ $pageTitle }} <small> {{ $pageNote }} </small></h3>
        <hr />       
    </div>
</div>
<div class="m-t">
	<div class="table-responsive" > 	

		<table class="table table-striped table-bordered" >
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
						
					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)" class="btn btn-primary"> Back To Grid <a> </td>
						
					</tr>					
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	