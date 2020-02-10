@if($setting['view-method'] =='native')
	<div class="sbox">
		<div class="sbox-title clearfix">
			<div class="sbox-tools pull-left" >
		   		<a href="{{ ($prevnext['prev'] != '' ? url('auditlog/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips btn btn-sm" onclick="ajaxViewDetail('#auditlog',this.href); return false; "><i class="fa fa-arrow-left"></i>  </a>	
				<a href="{{ ($prevnext['next'] != '' ? url('auditlog/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips btn btn-sm " onclick="ajaxViewDetail('#auditlog',this.href); return false; "> <i class="fa fa-arrow-right"></i>  </a>					
			</div>	

			<div class="sbox-tools" >
				<a href="javascript://ajax" onclick="ajaxViewClose('#{{ $pageModule }}')" class="tips btn btn-sm  " title="{{ __('core.btn_back') }}"><i class="fa  fa-times"></i></a>		
			</div>
		</div>
		<div class="sbox-content">
@endif	

		<table class="table  table-striped" >
			<tbody>	
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('AuditID', (isset($fields['auditID']['language'])? $fields['auditID']['language'] : array())) }}</td>
						<td>{{ $row->auditID}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Ipaddress', (isset($fields['ipaddress']['language'])? $fields['ipaddress']['language'] : array())) }}</td>
						<td>{{ $row->ipaddress}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('User Id', (isset($fields['user_id']['language'])? $fields['user_id']['language'] : array())) }}</td>
						<td>{{ $row->user_id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Module', (isset($fields['module']['language'])? $fields['module']['language'] : array())) }}</td>
						<td>{{ $row->module}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Task', (isset($fields['task']['language'])? $fields['task']['language'] : array())) }}</td>
						<td>{{ $row->task}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Note', (isset($fields['note']['language'])? $fields['note']['language'] : array())) }}</td>
						<td>{{ $row->note}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Logdate', (isset($fields['logdate']['language'])? $fields['logdate']['language'] : array())) }}</td>
						<td>{{ $row->logdate}} </td>
						
					</tr>
				
			</tbody>	
		</table>  
			
		 	
		 
@if($setting['form-method'] =='native')
	</div>	
</div>	
@endif		