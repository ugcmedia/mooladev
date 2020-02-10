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
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('FAQ Category ID', (isset($fields['faq_cat_id']['language'])? $fields['faq_cat_id']['language'] : array())) }}</td>
						<td>{{ $row->faq_cat_id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Category Name', (isset($fields['cat_name']['language'])? $fields['cat_name']['language'] : array())) }}</td>
						<td>{{ $row->cat_name}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Cat Code', (isset($fields['cat_code']['language'])? $fields['cat_code']['language'] : array())) }}</td>
						<td>{{ $row->cat_code}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Category Icon', (isset($fields['cat_icon']['language'])? $fields['cat_icon']['language'] : array())) }}</td>
						<td>{{ $row->cat_icon}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Category Sequence', (isset($fields['cat_sequence']['language'])? $fields['cat_sequence']['language'] : array())) }}</td>
						<td>{{ $row->cat_sequence}} </td>
						
					</tr>
						
					<tr>
						<td width='30%' class='label-view text-right'></td>
						<td> <a href="javascript:history.go(-1)" class="btn btn-primary"> Back To Grid <a> </td>
						
					</tr>					
				
			</tbody>	
		</table>   

	 
	
	</div>
</div>	