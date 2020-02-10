@if($setting['view-method'] =='native')
	<div class="sbox">
		<div class="sbox-title clearfix">
			<div class="sbox-tools pull-left" >
		   		<a href="{{ ($prevnext['prev'] != '' ? url('{class}/'.$prevnext['prev'].'?return='.$return ) : '#') }}" class="tips btn btn-sm" onclick="ajaxViewDetail('#{class}',this.href); return false; "><i class="fa fa-arrow-left"></i>  </a>	
				<a href="{{ ($prevnext['next'] != '' ? url('{class}/'.$prevnext['next'].'?return='.$return ) : '#') }}" class="tips btn btn-sm " onclick="ajaxViewDetail('#{class}',this.href); return false; "> <i class="fa fa-arrow-right"></i>  </a>					
			</div>	

			<div class="sbox-tools" >
				<a href="javascript://ajax" onclick="ajaxViewClose('#{{ $pageModule }}')" class="tips btn btn-sm  " title="{{ __('core.btn_back') }}"><i class="fa  fa-times"></i></a>		
			</div>
		</div>
		<div class="sbox-content">
@endif	

		<table class="table  table-striped" >
			<tbody>	
				{form_view}
			</tbody>	
		</table>  
			
		 {masterdetailview}	
		 
@if($setting['form-method'] =='native')
	</div>	
</div>	
@endif		