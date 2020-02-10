

		 {!! Form::open(array('url'=>'managereviews', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> User Reviews</legend>
				{!! Form::hidden('review_id', $row['review_id']) !!}					
									  <div class="form-group depen- wrap-vendor_code  " >
										<label for="Vendor Code" class=" control-label col-md-4 text-left"> Vendor Code </label>
										
										
										<div class="col-md-6">
										  <select name='vendor_code' rows='5' id='vendor_code' class='select2 '    ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-user_id  " >
										<label for="User Id" class=" control-label col-md-4 text-left"> User Id </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='user_id' id='user_id' value='{{ $row['user_id'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-rating  " >
										<label for="Rating" class=" control-label col-md-4 text-left"> Rating </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='rating' id='rating' value='{{ $row['rating'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-review_content  " >
										<label for="Review Content" class=" control-label col-md-4 text-left"> Review Content </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='review_content' id='review_content' value='{{ $row['review_content'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-review_title  " >
										<label for="Review Title" class=" control-label col-md-4 text-left"> Review Title </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='review_title' id='review_title' value='{{ $row['review_title'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-review_image  " >
										<label for="Review Image" class=" control-label col-md-4 text-left"> Review Image </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='review_image' id='review_image' value='{{ $row['review_image'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-reviwed_on  " >
										<label for="Reviwed On" class=" control-label col-md-4 text-left"> Reviwed On </label>
										
										
										<div class="col-md-6">
										  <textarea name='reviwed_on' rows='5' id='reviwed_on' class='form-control input-sm '  
				           >{{ $row['reviwed_on'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-review_status  " >
										<label for="Review Status" class=" control-label col-md-4 text-left"> Review Status </label>
										
										
										<div class="col-md-6">
										  <textarea name='review_status' rows='5' id='review_status' class='form-control input-sm '  
				           >{{ $row['review_status'] }}</textarea> 
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
		
		
		$("#vendor_code").jCombo("{!! url('managereviews/comboselect?filter=tb_vendors:vendor_code:vendor_name|outlet_location&values='.$row["vendor_code"]) !!}",
		{  selected_value : '{{ $row["vendor_code"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
