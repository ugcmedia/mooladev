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
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Id', (isset($fields['vendor_id']['language'])? $fields['vendor_id']['language'] : array())) }}</td>
						<td>{{ $row->vendor_id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Code', (isset($fields['vendor_code']['language'])? $fields['vendor_code']['language'] : array())) }}</td>
						<td>{{ $row->vendor_code}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Name', (isset($fields['vendor_name']['language'])? $fields['vendor_name']['language'] : array())) }}</td>
						<td>{{ $row->vendor_name}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Contact Number', (isset($fields['vendor_contact_number']['language'])? $fields['vendor_contact_number']['language'] : array())) }}</td>
						<td>{{ $row->vendor_contact_number}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Slug', (isset($fields['vendor_slug']['language'])? $fields['vendor_slug']['language'] : array())) }}</td>
						<td>{{ $row->vendor_slug}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Logo', (isset($fields['vendor_logo']['language'])? $fields['vendor_logo']['language'] : array())) }}</td>
						<td>{!! SiteHelpers::formatRows($row->vendor_logo,$fields['vendor_logo'],$row ) !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Desc', (isset($fields['vendor_desc']['language'])? $fields['vendor_desc']['language'] : array())) }}</td>
						<td>{{ $row->vendor_desc}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Cashback', (isset($fields['vendor_cashback']['language'])? $fields['vendor_cashback']['language'] : array())) }}</td>
						<td>{{ $row->vendor_cashback}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Cashback Enabled', (isset($fields['cashback_enabled']['language'])? $fields['cashback_enabled']['language'] : array())) }}</td>
						<td>{{ $row->cashback_enabled}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Cashback Type', (isset($fields['cashback_type']['language'])? $fields['cashback_type']['language'] : array())) }}</td>
						<td>{{ $row->cashback_type}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Status', (isset($fields['vendor_status']['language'])? $fields['vendor_status']['language'] : array())) }}</td>
						<td>{{ $row->vendor_status}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Outlet Address', (isset($fields['outlet_address']['language'])? $fields['outlet_address']['language'] : array())) }}</td>
						<td>{{ $row->outlet_address}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Outlet Lat', (isset($fields['outlet_lat']['language'])? $fields['outlet_lat']['language'] : array())) }}</td>
						<td>{{ $row->outlet_lat}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Outlet Long', (isset($fields['outlet_long']['language'])? $fields['outlet_long']['language'] : array())) }}</td>
						<td>{{ $row->outlet_long}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Outlet Location', (isset($fields['outlet_location']['language'])? $fields['outlet_location']['language'] : array())) }}</td>
						<td>{{ $row->outlet_location}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Outlet Primary Image', (isset($fields['outlet_primary_image']['language'])? $fields['outlet_primary_image']['language'] : array())) }}</td>
						<td>{{ $row->outlet_primary_image}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Outlet Gallery', (isset($fields['outlet_gallery']['language'])? $fields['outlet_gallery']['language'] : array())) }}</td>
						<td>{{ $row->outlet_gallery}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Outlet Attachment', (isset($fields['outlet_attachment']['language'])? $fields['outlet_attachment']['language'] : array())) }}</td>
						<td>{{ $row->outlet_attachment}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Outlet Name', (isset($fields['outlet_name']['language'])? $fields['outlet_name']['language'] : array())) }}</td>
						<td>{{ $row->outlet_name}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Rating', (isset($fields['vendor_rating']['language'])? $fields['vendor_rating']['language'] : array())) }}</td>
						<td>{{ $row->vendor_rating}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Votes', (isset($fields['vendor_votes']['language'])? $fields['vendor_votes']['language'] : array())) }}</td>
						<td>{{ $row->vendor_votes}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Website', (isset($fields['vendor_website']['language'])? $fields['vendor_website']['language'] : array())) }}</td>
						<td>{{ $row->vendor_website}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Categories', (isset($fields['vendor_categories']['language'])? $fields['vendor_categories']['language'] : array())) }}</td>
						<td>{{ $row->vendor_categories}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Support Email', (isset($fields['vendor_support_email']['language'])? $fields['vendor_support_email']['language'] : array())) }}</td>
						<td>{{ $row->vendor_support_email}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Phnumber', (isset($fields['vendor_phnumber']['language'])? $fields['vendor_phnumber']['language'] : array())) }}</td>
						<td>{{ $row->vendor_phnumber}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Howto', (isset($fields['vendor_howto']['language'])? $fields['vendor_howto']['language'] : array())) }}</td>
						<td>{{ $row->vendor_howto}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Policy', (isset($fields['vendor_policy']['language'])? $fields['vendor_policy']['language'] : array())) }}</td>
						<td>{{ $row->vendor_policy}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Featured', (isset($fields['vendor_featured']['language'])? $fields['vendor_featured']['language'] : array())) }}</td>
						<td>{{ $row->vendor_featured}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Stats', (isset($fields['vendor_stats']['language'])? $fields['vendor_stats']['language'] : array())) }}</td>
						<td>{{ $row->vendor_stats}} </td>
						
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