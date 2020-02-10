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
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Block Id', (isset($fields['block_id']['language'])? $fields['block_id']['language'] : array())) }}</td>
						<td>{{ $row->block_id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Block Type', (isset($fields['block_type']['language'])? $fields['block_type']['language'] : array())) }}</td>
						<td>{{ SiteHelpers::formatLookUp($row->block_type,'block_type','1:tb_status:status_code:status_name') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Title', (isset($fields['title']['language'])? $fields['title']['language'] : array())) }}</td>
						<td>{{ $row->title}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Block Content', (isset($fields['block_content']['language'])? $fields['block_content']['language'] : array())) }}</td>
						<td>{{ $row->block_content}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Block Image', (isset($fields['block_image']['language'])? $fields['block_image']['language'] : array())) }}</td>
						<td>{!! SiteHelpers::formatRows($row->block_image,$fields['block_image'],$row ) !!} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Promo Link', (isset($fields['promo_link']['language'])? $fields['promo_link']['language'] : array())) }}</td>
						<td>{{ $row->promo_link}} </td>
						
					</tr>
						
					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)" class="btn btn-primary"> Back To Grid <a> </td>
						
					</tr>					
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	