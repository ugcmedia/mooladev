
@if($setting['form-method'] =='native')
	<div class="sbox">
		<div class="sbox-title clearfix">
			<h3> Form Update </h3>
			<div class="sbox-tools" >
				<a href="javascript://ajax" onclick="ajaxViewClose('#{{ $pageModule }}')" class="tips btn btn-sm  " title="{{ __('core.btn_back') }}" ><i class="fa  fa-times"></i></a>		
			</div>
		</div>	

		<div class="sbox-content">
@endif	
			{!! Form::open(array('url'=>'{class}?return='.$return, 'class'=>'form-{form_display} validated','files' => true , 'parsley-validate'=>'','novalidate'=>' ','id'=> '{class}FormAjax')) !!}
			
			<input type="hidden" name="status_type" value="{{ $pageTitle }}" />
			
			{form_entry}									
			{masterdetailform}					
						
			<div style="clear:both"></div>	
							
			<div class="form-group">
				<label class="col-sm-4 text-right">&nbsp;</label>
				<div class="col-sm-8">	
					<button type="submit" class="btn btn-primary btn-sm "><i class="fa fa-play-circle"></i>  {{ Lang::get('core.sb_save') }} </button>
					<button type="button" onclick="ajaxViewClose('#{{ $pageModule }}')" class="btn btn-success btn-sm"><i class="fa fa-remove "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					<?php if($frontendSlug!='') {
				$fsconfig = explode('@',$frontendSlug);
				if( ($row[$fsconfig[1]]) ) 
				echo '<a  class="tips btn btn-sm btn-warning btn-fs" target="_blank"  title="FrontEnd" href="'. URL::to('/'.$fsconfig[0].'/'.$row[$fsconfig[1]]).'"><i class="fa  fa-desktop"></i> FrontEnd</a>';
				 } ?>
				</div>			
			</div> 		 
			{!! Form::close() !!}


@if($setting['form-method'] =='native')
	</div>	
</div>	
@endif	

	
</div>	
			 
<script type="text/javascript">
$(document).ready(function() { 
	{form_javascript} 		  
	
	$('.editor').summernote();
	
	$('.tips').tooltip();	
	$(".select2").select2({ width:"98%"});	
	$('.date').datepicker({format:'yyyy-mm-dd',autoClose:true})
	$('.datetime').datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'}); 		
		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("{class}/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});
				
	var form = $('#{class}FormAjax'); 
	form.parsley();
	form.submit(function(){
		
		if(form.parsley().isValid()){			
			var options = { 
				dataType:      'json', 
				beforeSubmit :  showRequest,
				success:       showResponse  
			}  
			$(this).ajaxSubmit(options); 
			return false;
						
		} else {
			return false;
		}		
	
	});

});

function showRequest()
{
		
}  
function showResponse(data)  {		
	
	if(data.status == 'success')
	{
		ajaxViewClose('#{{ $pageModule }}');
		ajaxFilter('#{{ $pageModule }}','{{ $pageUrl }}/data');
		notyMessage(data.message);	
		$('#sximo-modal').modal('hide');	
	} else {
		notyMessageError(data.message);	
		return false;
	}	
}			 

</script>		 


	@include('media::partials.media')


	<script>
        'use strict';

      $(document).ready(function () {
            $('[data-type="rv-media-standard-alone-button"]').rvMedia({
                multiple: false,
                onSelectFiles: function (files, $el) {
                    $($el.data('target')).val(files[0].basename);
					$('.img-preview img').attr('src',files[0].full_url);
                }
            });
			
			$('.switch-wrap input[type=checkbox]').each(function (){
			if(this.checked)  $('.depen-'+this.name).show();
			else $('.depen-'+this.name).hide();
		});
		
		$('.switch-wrap :checkbox').change(function () {
			if(this.checked)  $('.depen-'+this.name).show();
			else $('.depen-'+this.name).hide();
		});
		
		$('[data-toggle="tooltip"]').tooltip();
		
        });
    </script>