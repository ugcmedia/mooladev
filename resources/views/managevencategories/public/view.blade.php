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
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Cat Id', (isset($fields['cat_id']['language'])? $fields['cat_id']['language'] : array())) }}</td>
						<td>{{ $row->cat_id}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Cat Name', (isset($fields['cat_name']['language'])? $fields['cat_name']['language'] : array())) }}</td>
						<td>{{ $row->cat_name}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Cat Slug', (isset($fields['cat_slug']['language'])? $fields['cat_slug']['language'] : array())) }}</td>
						<td>{{ $row->cat_slug}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Parent Cat', (isset($fields['parent_cat']['language'])? $fields['parent_cat']['language'] : array())) }}</td>
						<td>{{ $row->parent_cat}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Cat Icon', (isset($fields['cat_icon']['language'])? $fields['cat_icon']['language'] : array())) }}</td>
						<td>{{ $row->cat_icon}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Cat Featured', (isset($fields['cat_featured']['language'])? $fields['cat_featured']['language'] : array())) }}</td>
						<td>{{ $row->cat_featured}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Cat Desc', (isset($fields['cat_desc']['language'])? $fields['cat_desc']['language'] : array())) }}</td>
						<td>{{ $row->cat_desc}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Cat H1', (isset($fields['cat_h1']['language'])? $fields['cat_h1']['language'] : array())) }}</td>
						<td>{{ $row->cat_h1}} </td>
						
					</tr>
				
					<tr>
						<td width='30%' class='label-view text-right'>{{ SiteHelpers::activeLang('Cat H2', (isset($fields['cat_h2']['language'])? $fields['cat_h2']['language'] : array())) }}</td>
						<td>{{ $row->cat_h2}} </td>
						
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