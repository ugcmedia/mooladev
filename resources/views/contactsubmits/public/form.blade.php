

		 {!! Form::open(array('url'=>'contactsubmits', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Contact Submissions</legend>
				{!! Form::hidden('contact_id', $row['contact_id']) !!}					
									  <div class="form-group depen- wrap-name  " >
										<label for="Name" class=" control-label col-md-4 text-left"> Name <span class="asterix"> * </span></label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='name' id='name' value='{{ $row['name'] }}' 
						required   readonly    class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-email  " >
										<label for="Email" class=" control-label col-md-4 text-left"> Email <span class="asterix"> * </span></label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='email' id='email' value='{{ $row['email'] }}' 
						required   readonly    class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-message  " >
										<label for="Message" class=" control-label col-md-4 text-left"> Message <span class="asterix"> * </span></label>
										
										
										<div class="col-md-6">
										  <textarea name='message' rows='5' id='message' class='form-control input-sm '  
				         required   readonly >{{ $row['message'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-reason  " >
										<label for="Reason" class=" control-label col-md-4 text-left"> Reason <span class="asterix"> * </span></label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='reason' id='reason' value='{{ $row['reason'] }}' 
						required   readonly    class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-sub_reason  " >
										<label for="Sub Reason" class=" control-label col-md-4 text-left"> Sub Reason <span class="asterix"> * </span></label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='sub_reason' id='sub_reason' value='{{ $row['sub_reason'] }}' 
						required   readonly    class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-submitted  " >
										<label for="Submitted" class=" control-label col-md-4 text-left"> Submitted <span class="asterix"> * </span></label>
										
										
										<div class="col-md-6">
										  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('submitted', $row['submitted'],array('class'=>'form-control input-sm datetime', 'style'=>'width:150px !important;')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				 
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
