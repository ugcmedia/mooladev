@if($setting['view-method'] =='native')
	<div class="sbox">
		<div class="sbox-title clearfix">
			<div class="sbox-tools pull-left" >
		   		<a href="{{ ($prevnext['prev'] != '' ? url('managereviews/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips btn btn-sm" onclick="ajaxViewDetail('#managereviews',this.href); return false; "><i class="fa fa-arrow-left"></i>  </a>	
				<a href="{{ ($prevnext['next'] != '' ? url('managereviews/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips btn btn-sm " onclick="ajaxViewDetail('#managereviews',this.href); return false; "> <i class="fa fa-arrow-right"></i>  </a>					
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
				
			</tbody>	
		</table>  
			
		 	
		 
@if($setting['form-method'] =='native')
	</div>	
</div>	
@endif		