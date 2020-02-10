

		 {!! Form::open(array('url'=>'managelocations', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Locations</legend>
				{!! Form::hidden('location_id', $row['location_id']) !!}					
									  <div class="form-group depen- wrap-area_name  " >
										<label for="Area Name" class=" control-label col-md-4 text-left"> Area Name </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='area_name' id='area_name' value='{{ $row['area_name'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-area_pincode  " >
										<label for="Area Pincode" class=" control-label col-md-4 text-left"> Area Pincode </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='area_pincode' id='area_pincode' value='{{ $row['area_pincode'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-city  " >
										<label for="City" class=" control-label col-md-4 text-left"> City </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='city' id='city' value='{{ $row['city'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-state  " >
										<label for="State" class=" control-label col-md-4 text-left"> State </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='state' id='state' value='{{ $row['state'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-location_reference  " >
										<label for="Location Reference" class=" control-label col-md-4 text-left"> Location Reference </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='location_reference' id='location_reference' value='{{ $row['location_reference'] }}' 
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
