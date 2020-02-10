

		 {!! Form::open(array('url'=>'usertips/savepublic', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Front-end Tool tips</legend>
				{!! Form::hidden('tipid', $row['tipid']) !!}					
									  <div class="form-group depen- wrap-name  " >
										<label for="Name" class=" control-label col-md-4 text-left"> Name </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='name' id='name' value='{{ $row['name'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-page  " >
										<label for="Page" class=" control-label col-md-4 text-left"> Page </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='page' id='page' value='{{ $row['page'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> {!! Form::hidden('tip_key', $row['tip_key']) !!}					
									  <div class="form-group depen- wrap-note  " >
										<label for="Note" class=" control-label col-md-4 text-left"> Note </label>
										
										
										<div class="col-md-6">
										  <textarea name='note' rows='5' id='note' class='form-control input-sm '  
				           >{{ $row['note'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-enabled  " >
										<label for="Enabled" class=" control-label col-md-4 text-left"> Enabled </label>
										
										
										<div class="col-md-6">
										  <?php $enabled = (isset($row['enabled'])) ? explode(",",$row['enabled']) : array() ; ?><div class='switch-wrap'> <label class='switch'>
				    <input type='hidden' name='enabled' value ='N' />
					<input type='checkbox' name='enabled' value ='Y' 
					@if(in_array('Y',$enabled))checked @endif 
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
		
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
