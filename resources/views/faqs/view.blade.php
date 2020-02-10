@if($setting['view-method'] =='native')
	<div class="sbox">
		<div class="sbox-title clearfix">
			<div class="sbox-tools pull-left" >
		   		<a href="{{ ($prevnext['prev'] != '' ? url('faqs/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips btn btn-sm" onclick="ajaxViewDetail('#faqs',this.href); return false; "><i class="fa fa-arrow-left"></i>  </a>	
				<a href="{{ ($prevnext['next'] != '' ? url('faqs/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips btn btn-sm " onclick="ajaxViewDetail('#faqs',this.href); return false; "> <i class="fa fa-arrow-right"></i>  </a>					
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
				
			</tbody>	
		</table>  
			
		 	
		 
@if($setting['form-method'] =='native')
	</div>	
</div>	
@endif		