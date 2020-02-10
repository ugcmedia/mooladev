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
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Review Id', (isset($fields['review_id']['language'])? $fields['review_id']['language'] : array())) }}</td>
						<td>{{ $row->review_id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Vendor Code', (isset($fields['vendor_code']['language'])? $fields['vendor_code']['language'] : array())) }}</td>
						<td>{{ $row->vendor_code}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('User Id', (isset($fields['user_id']['language'])? $fields['user_id']['language'] : array())) }}</td>
						<td>{{ $row->user_id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Rating', (isset($fields['rating']['language'])? $fields['rating']['language'] : array())) }}</td>
						<td>{{ $row->rating}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Review Content', (isset($fields['review_content']['language'])? $fields['review_content']['language'] : array())) }}</td>
						<td>{{ $row->review_content}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Review Title', (isset($fields['review_title']['language'])? $fields['review_title']['language'] : array())) }}</td>
						<td>{{ $row->review_title}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Review Image', (isset($fields['review_image']['language'])? $fields['review_image']['language'] : array())) }}</td>
						<td>{{ $row->review_image}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Reviwed On', (isset($fields['reviwed_on']['language'])? $fields['reviwed_on']['language'] : array())) }}</td>
						<td>{{ $row->reviwed_on}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Review Status', (isset($fields['review_status']['language'])? $fields['review_status']['language'] : array())) }}</td>
						<td>{{ $row->review_status}} </td>
						
					</tr>
						
					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)" class="btn btn-primary"> Back To Grid <a> </td>
						
					</tr>					
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	