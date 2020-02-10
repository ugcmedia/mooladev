

		 {!! Form::open(array('url'=>'notification', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Notification</legend>
									
									  <div class="form-group depen- wrap-title  " >
										<label for="Title" class=" control-label col-md-4 text-left"> Title </label>
										
										
										<div class="col-md-6">
										  <textarea name='title' rows='5' id='title' class='form-control input-sm '  
				           >{{ $row['title'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-created  " >
										<label for="Date" class=" control-label col-md-4 text-left"> Date </label>
										
										
										<div class="col-md-6">
										  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('created', $row['created'],array('class'=>'form-control input-sm date')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-url  " >
										<label for="Url" class=" control-label col-md-4 text-left"> Url </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='url' id='url' value='{{ $row['url'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-note  " >
										<label for="Note" class=" control-label col-md-4 text-left"> Note </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='note' id='note' value='{{ $row['note'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-postedBy  " >
										<label for="PostedBy" class=" control-label col-md-4 text-left"> PostedBy </label>
										
										
										<div class="col-md-6">
										  <textarea name='postedBy' rows='5' id='postedBy' class='form-control input-sm '  
				           >{{ $row['postedBy'] }}</textarea> 
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
