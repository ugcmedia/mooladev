@if($setting['view-method'] =='native')
	<div class="sbox">
		<div class="sbox-title clearfix">
			<div class="sbox-tools pull-left" >
		   		<a href="{{ ($prevnext['prev'] != '' ? url('settingmaster/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips btn btn-sm" onclick="ajaxViewDetail('#settingmaster',this.href); return false; "><i class="fa fa-arrow-left"></i>  </a>	
				<a href="{{ ($prevnext['next'] != '' ? url('settingmaster/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips btn btn-sm " onclick="ajaxViewDetail('#settingmaster',this.href); return false; "> <i class="fa fa-arrow-right"></i>  </a>					
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
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Setting ID', (isset($fields['setting_id']['language'])? $fields['setting_id']['language'] : array())) }}</td>
						<td>{{ $row->setting_id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Setting UI Name', (isset($fields['setting_ui_name']['language'])? $fields['setting_ui_name']['language'] : array())) }}</td>
						<td>{{ $row->setting_ui_name}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Setting Key', (isset($fields['setting_key']['language'])? $fields['setting_key']['language'] : array())) }}</td>
						<td>{{ $row->setting_key}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Setting Value', (isset($fields['setting_value']['language'])? $fields['setting_value']['language'] : array())) }}</td>
						<td>{{ $row->setting_value}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Setting Group', (isset($fields['setting_group']['language'])? $fields['setting_group']['language'] : array())) }}</td>
						<td>{{ $row->setting_group}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Setting Dev Class', (isset($fields['setting_dev_class']['language'])? $fields['setting_dev_class']['language'] : array())) }}</td>
						<td>{{ $row->setting_dev_class}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Note', (isset($fields['note']['language'])? $fields['note']['language'] : array())) }}</td>
						<td>{{ $row->note}} </td>
						
					</tr>
				
			</tbody>	
		</table>  
			
		 	
		 
@if($setting['form-method'] =='native')
	</div>	
</div>	
@endif		