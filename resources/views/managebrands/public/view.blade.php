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
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Brand Id', (isset($fields['brand_id']['language'])? $fields['brand_id']['language'] : array())) }}</td>
						<td>{{ $row->brand_id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Brand Name', (isset($fields['brand_name']['language'])? $fields['brand_name']['language'] : array())) }}</td>
						<td>{{ $row->brand_name}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Brand Logo', (isset($fields['brand_logo']['language'])? $fields['brand_logo']['language'] : array())) }}</td>
						<td>{{ $row->brand_logo}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor List', (isset($fields['vendor_list']['language'])? $fields['vendor_list']['language'] : array())) }}</td>
						<td>{{ $row->vendor_list}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Brand Desc', (isset($fields['brand_desc']['language'])? $fields['brand_desc']['language'] : array())) }}</td>
						<td>{{ $row->brand_desc}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Clicks', (isset($fields['clicks']['language'])? $fields['clicks']['language'] : array())) }}</td>
						<td>{{ $row->clicks}} </td>
						
					</tr>
						
					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)" class="btn btn-primary"> Back To Grid <a> </td>
						
					</tr>					
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	