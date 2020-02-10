

		 {!! Form::open(array('url'=>'managevendors', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Vendors</legend>
				{!! Form::hidden('vendor_id', $row['vendor_id']) !!}					
									  <div class="form-group depen- wrap-email  " >
										<label for="Email" class=" control-label col-md-4 text-left"> Email <span class="asterix"> * </span></label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='email' id='email' value='{{ $row['email'] }}' 
						required     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_name  " >
										<label for="Vendor Name" class=" control-label col-md-4 text-left"> Vendor Name </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='vendor_name' id='vendor_name' value='{{ $row['vendor_name'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-email_verified  " >
										<label for="Email Verified" class=" control-label col-md-4 text-left"> Email Verified </label>
										
										
										<div class="col-md-6">
										  <?php $email_verified = (isset($row['email_verified'])) ? explode(",",$row['email_verified']) : array() ; ?><div class='switch-wrap'> <label class='switch'>
				    <input type='hidden' name='email_verified' value ='N' />
					<input type='checkbox' name='email_verified' value ='Y' 
					@if(in_array('Y',$email_verified))checked @endif 
					 />   <span class="slider round"></span></label></div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-account_status  " >
										<label for="Account Status" class=" control-label col-md-4 text-left"> Account Status </label>
										
										
										<div class="col-md-6">
										  
					<?php $account_status = explode(',',$row['account_status']);
					$account_status_opt = array( 'pending' => 'Pending' ,  'suspended' => 'Suspended' ,  'active' => 'Active' ,  'deactive' => 'Deactive' , ); ?>
					<select name='account_status' rows='5'   class='select2 '  > 
						<?php 
						foreach($account_status_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['account_status'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-joined  " >
										<label for="Joined" class=" control-label col-md-4 text-left"> Joined </label>
										
										
										<div class="col-md-6">
										  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('joined', $row['joined'],array('class'=>'form-control input-sm datetime', 'style'=>'width:150px !important;')) !!}
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
