

		 {!! Form::open(array('url'=>'faqs', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Faqs</legend>
				{!! Form::hidden('faq_id', $row['faq_id']) !!}					
									  <div class="form-group depen- wrap-faq_title  " >
										<label for="Faq Title" class=" control-label col-md-4 text-left"> Faq Title </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='faq_title' id='faq_title' value='{{ $row['faq_title'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-faq_desc  " >
										<label for="Faq Desc" class=" control-label col-md-4 text-left"> Faq Desc </label>
										
										
										<div class="col-md-6">
										  <textarea name='faq_desc' rows='5' id='editor' class='form-control input-sm editor '  
						  >{{ $row['faq_desc'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-faq_cat  " >
										<label for="Faq Cat" class=" control-label col-md-4 text-left"> Faq Cat </label>
										
										
										<div class="col-md-6">
										  <select name='faq_cat[]' multiple rows='5' id='faq_cat' class='select2 '    ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-faq_seq  " >
										<label for="Faq Seq" class=" control-label col-md-4 text-left"> Faq Seq </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='faq_seq' id='faq_seq' value='{{ $row['faq_seq'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-status  " >
										<label for="Shown?" class=" control-label col-md-4 text-left"> Shown? </label>
										
										
										<div class="col-md-6">
										  <?php $status = (isset($row['status'])) ? explode(",",$row['status']) : array() ; ?><div class='switch-wrap'> <label class='switch'>
				    <input type='hidden' name='status' value ='N' />
					<input type='checkbox' name='status' value ='Y' 
					@if(in_array('Y',$status))checked @endif 
					 />   <span class="slider round"></span></label></div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> </fieldset>
			</div>
			
			

			<div style="clear:both"></div>	
				
					
				  <div class="form-group">
					<label class="col-sm-4 text-right">&nbsp;</label>
					<div class="col-sm-8">	
					<button type="submit" name="apply" class="btn btn-info btn-sm" ><i class="fa  fa-check-circle"></i> {{ Lang::get('core.sb_apply') }}</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm" ><i class="fa  fa-save "></i> {{ Lang::get('core.sb_save') }}</button>
				  </div>	  
			
		</div> 
		 <input type="hidden" name="action_task" value="public" />
		 {!! Form::close() !!}
		 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		$("#faq_cat").jCombo("{!! url('faqs/comboselect?filter=tb_faq_cats:cat_code:cat_name&values='.$row["faq_cat"]) !!}",
		{  selected_value : '{{ $row["faq_cat"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
