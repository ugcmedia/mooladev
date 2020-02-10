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
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Lookupid', (isset($fields['lookupid']['language'])? $fields['lookupid']['language'] : array())) }}</td>
						<td>{{ $row->lookupid}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Lookup Type', (isset($fields['lookup_type']['language'])? $fields['lookup_type']['language'] : array())) }}</td>
						<td>{{ $row->lookup_type}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Lookup Key', (isset($fields['lookup_key']['language'])? $fields['lookup_key']['language'] : array())) }}</td>
						<td>{{ $row->lookup_key}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Lookup Value', (isset($fields['lookup_value']['language'])? $fields['lookup_value']['language'] : array())) }}</td>
						<td>{{ $row->lookup_value}} </td>
						
					</tr>
						
					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)" class="btn btn-primary"> Back To Grid <a> </td>
						
					</tr>					
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	