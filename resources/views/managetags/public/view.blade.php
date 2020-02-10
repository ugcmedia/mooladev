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
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Tag Id', (isset($fields['tag_id']['language'])? $fields['tag_id']['language'] : array())) }}</td>
						<td>{{ $row->tag_id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Tag Name', (isset($fields['tag_name']['language'])? $fields['tag_name']['language'] : array())) }}</td>
						<td>{{ $row->tag_name}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Tag Slug', (isset($fields['tag_slug']['language'])? $fields['tag_slug']['language'] : array())) }}</td>
						<td>{{ $row->tag_slug}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Parent Tag', (isset($fields['parent_tag']['language'])? $fields['parent_tag']['language'] : array())) }}</td>
						<td>{{ $row->parent_tag}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Tag Icon', (isset($fields['tag_icon']['language'])? $fields['tag_icon']['language'] : array())) }}</td>
						<td>{{ $row->tag_icon}} </td>
						
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