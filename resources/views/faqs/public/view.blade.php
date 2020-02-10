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
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('FAQ ID', (isset($fields['faq_id']['language'])? $fields['faq_id']['language'] : array())) }}</td>
						<td>{{ $row->faq_id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('FAQ Title', (isset($fields['faq_title']['language'])? $fields['faq_title']['language'] : array())) }}</td>
						<td>{{ $row->faq_title}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Faq Desc', (isset($fields['faq_desc']['language'])? $fields['faq_desc']['language'] : array())) }}</td>
						<td>{{ $row->faq_desc}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('FAQ Categories', (isset($fields['faq_cat']['language'])? $fields['faq_cat']['language'] : array())) }}</td>
						<td>{{ SiteHelpers::formatLookUp($row->faq_cat,'faq_cat','1:tb_faq_cats:faq_cat_id:cat_name') }} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('FAQ Sequence', (isset($fields['faq_seq']['language'])? $fields['faq_seq']['language'] : array())) }}</td>
						<td>{{ $row->faq_seq}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Status', (isset($fields['status']['language'])? $fields['status']['language'] : array())) }}</td>
						<td>{{ $row->status}} </td>
						
					</tr>
						
					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)" class="btn btn-primary"> Back To Grid <a> </td>
						
					</tr>					
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	