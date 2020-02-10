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
						
					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)" class="btn btn-primary"> Back To Grid <a> </td>
						
					</tr>					
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	