@if($setting['view-method'] =='native')
	<div class="sbox">
		<div class="sbox-title clearfix">
			<div class="sbox-tools pull-left" >
		   		<a href="{{ ($prevnext['prev'] != '' ? url('managevencategories/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips btn btn-sm" onclick="ajaxViewDetail('#managevencategories',this.href); return false; "><i class="fa fa-arrow-left"></i>  </a>	
				<a href="{{ ($prevnext['next'] != '' ? url('managevencategories/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips btn btn-sm " onclick="ajaxViewDetail('#managevencategories',this.href); return false; "> <i class="fa fa-arrow-right"></i>  </a>					
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
				
			</tbody>	
		</table>  
			
		 	
		 
@if($setting['form-method'] =='native')
	</div>	
</div>	
@endif		