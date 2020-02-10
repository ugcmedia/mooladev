

		 {!! Form::open(array('url'=>'lookupmaster', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Lookup Master</legend>
									
									  <div class="form-group depen- wrap-lookupid  " >
										<label for="Lookupid" class=" control-label col-md-4 text-left"> Lookupid </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='lookupid' id='lookupid' value='{{ $row['lookupid'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-lookup_type  " >
										<label for="Lookup Type" class=" control-label col-md-4 text-left"> Lookup Type </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='lookup_type' id='lookup_type' value='{{ $row['lookup_type'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-lookup_key  " >
										<label for="Lookup Key" class=" control-label col-md-4 text-left"> Lookup Key </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='lookup_key' id='lookup_key' value='{{ $row['lookup_key'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-lookup_value  " >
										<label for="Lookup Value" class=" control-label col-md-4 text-left"> Lookup Value </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='lookup_value' id='lookup_value' value='{{ $row['lookup_value'] }}' 
						     class='form-control input-sm ' /> 
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
		
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
