

		 {!! Form::open(array('url'=>'vendoroutlets', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Vendor Outlets</legend>
				{!! Form::hidden('vendor_id', $row['vendor_id']) !!}					
									  <div class="form-group depen- wrap-vendor_code  " >
										<label for="Vendor Code" class=" control-label col-md-4 text-left"> Vendor Code </label>
										
										
										<div class="col-md-6">
										  <select name='vendor_code' rows='5' id='vendor_code' class='select2 '    ></select> 
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
									  <div class="form-group depen- wrap-vendor_contact_number  " >
										<label for="Vendor Contact Number" class=" control-label col-md-4 text-left"> Vendor Contact Number </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='vendor_contact_number' id='vendor_contact_number' value='{{ $row['vendor_contact_number'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_slug  " >
										<label for="Vendor Slug" class=" control-label col-md-4 text-left"> Vendor Slug </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='vendor_slug' id='vendor_slug' value='{{ $row['vendor_slug'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_logo  " >
										<label for="Vendor Logo" class=" control-label col-md-4 text-left"> Vendor Logo </label>
										
										
										<div class="col-md-6">
										  <input  type='hidden' name='vendor_logo' id='vendor_logo' value='{{ $row['vendor_logo'] }}' class='vendor_logo    form-control input-sm '    />

							<span class='input-group-btn'>
                <button class='btn btn-info' data-type='mediaUpload' data-target='.vendor_logo' type='button'>Choose file</button>
				<button class='btn btn-danger unUploadImage' data-type='mediaUnUpload' data-target='vendor_logo' type='button'>Remove File</button>
            </span>
			
							<div class='vendor_logo_preview'></div>
							<div class='vendor_logoPreview'>
					 	<div class='img-preview'>
						{!! SiteHelpers::showUploadedFileCust($row['vendor_logo'],'/uploads/images/') !!}
						
						</div>					
						</div>					
					 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_desc  " >
										<label for="Vendor Desc" class=" control-label col-md-4 text-left"> Vendor Desc </label>
										
										
										<div class="col-md-6">
										  <textarea name='vendor_desc' rows='5' id='editor' class='form-control input-sm editor '  
						  >{{ $row['vendor_desc'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_cashback  " >
										<label for="Vendor Cashback %" class=" control-label col-md-4 text-left"> Vendor Cashback % </label>
										
										
										<div class="col-md-6">
										  <input  type='number' name='vendor_cashback' id='vendor_cashback' value='{{ $row['vendor_cashback'] }}' 
						     class='form-control is_number'  /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-cashback_enabled  " >
										<label for="Cashback Status" class=" control-label col-md-4 text-left"> Cashback Status </label>
										
										
										<div class="col-md-6">
										  <?php $cashback_enabled = (isset($row['cashback_enabled'])) ? explode(",",$row['cashback_enabled']) : array() ; ?><div class='switch-wrap'> <label class='switch'>
				    <input type='hidden' name='cashback_enabled' value ='N' />
					<input type='checkbox' name='cashback_enabled' value ='Y' 
					@if(in_array('Y',$cashback_enabled))checked @endif 
					 />   <span class="slider round"></span></label></div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-cashback_type  " >
										<label for="Cashback Type" class=" control-label col-md-4 text-left"> Cashback Type </label>
										
										
										<div class="col-md-6">
										  
					<?php $cashback_type = explode(',',$row['cashback_type']);
					$cashback_type_opt = array( 'cashback' => 'Cashback' ,  'reward' => 'Reward' , ); ?>
					<select name='cashback_type' rows='5'   class='select2 '  > 
						<?php 
						foreach($cashback_type_opt as $key=>$val)
						{
							echo "<option  value ='$key' ".($row['cashback_type'] == $key ? " selected='selected' " : '' ).">$val</option>"; 						
						}						
						?></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_status  " >
										<label for="Vendor Status" class=" control-label col-md-4 text-left"> Vendor Status </label>
										
										
										<div class="col-md-6">
										  <?php $vendor_status = (isset($row['vendor_status'])) ? explode(",",$row['vendor_status']) : array() ; ?><div class='switch-wrap'> <label class='switch'>
				    <input type='hidden' name='vendor_status' value ='N' />
					<input type='checkbox' name='vendor_status' value ='Y' 
					@if(in_array('Y',$vendor_status))checked @endif 
					 />   <span class="slider round"></span></label></div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-outlet_address  " >
										<label for="Outlet Address" class=" control-label col-md-4 text-left"> Outlet Address </label>
										
										
										<div class="col-md-6">
										  <textarea name='outlet_address' rows='5' id='outlet_address' class='form-control input-sm '  
				           >{{ $row['outlet_address'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-outlet_lat  " >
										<label for="Outlet Lat" class=" control-label col-md-4 text-left"> Outlet Lat </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='outlet_lat' id='outlet_lat' value='{{ $row['outlet_lat'] }}' 
						     class='form-control is_decimal' onkeypress='return isNumberKey(event,this)'  /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-outlet_long  " >
										<label for="Outlet Long" class=" control-label col-md-4 text-left"> Outlet Long </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='outlet_long' id='outlet_long' value='{{ $row['outlet_long'] }}' 
						     class='form-control is_decimal' onkeypress='return isNumberKey(event,this)'  /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-outlet_location  " >
										<label for="Outlet Location" class=" control-label col-md-4 text-left"> Outlet Location </label>
										
										
										<div class="col-md-6">
										  <select name='outlet_location' rows='5' id='outlet_location' class='select2 '    ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-outlet_primary_image  " >
										<label for="Outlet Primary Image" class=" control-label col-md-4 text-left"> Outlet Primary Image </label>
										
										
										<div class="col-md-6">
										  <input  type='hidden' name='outlet_primary_image' id='outlet_primary_image' value='{{ $row['outlet_primary_image'] }}' class='outlet_primary_image    form-control input-sm '    />

							<span class='input-group-btn'>
                <button class='btn btn-info' data-type='mediaUpload' data-target='.outlet_primary_image' type='button'>Choose file</button>
				<button class='btn btn-danger unUploadImage' data-type='mediaUnUpload' data-target='outlet_primary_image' type='button'>Remove File</button>
            </span>
			
							<div class='outlet_primary_image_preview'></div>
							<div class='outlet_primary_imagePreview'>
					 	<div class='img-preview'>
						{!! SiteHelpers::showUploadedFileCust($row['outlet_primary_image'],'/uploads/images/') !!}
						
						</div>					
						</div>					
					 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-outlet_gallery  " >
										<label for="Outlet Gallery" class=" control-label col-md-4 text-left"> Outlet Gallery </label>
										
										
										<div class="col-md-6">
										  <textarea name='outlet_gallery' rows='5' id='outlet_gallery' class='form-control input-sm '  
				           >{{ $row['outlet_gallery'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-outlet_attachment  " >
										<label for="Outlet Attachment" class=" control-label col-md-4 text-left"> Outlet Attachment </label>
										
										
										<div class="col-md-6">
										  <input  type='file' name='outlet_attachment' id='outlet_attachment' class='inputfile  @if($row['outlet_attachment'] =='') class='required' @endif '  />

							<label for='outlet_attachment'><i class='fa fa-upload'></i> Choose a file</label>
							<div class='outlet_attachment_preview'></div>
					 	<div >
						{!! SiteHelpers::showUploadedFile($row['outlet_attachment'],'') !!}
						
						</div>					
					 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-outlet_name  " >
										<label for="Outlet Name" class=" control-label col-md-4 text-left"> Outlet Name </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='outlet_name' id='outlet_name' value='{{ $row['outlet_name'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_rating  " >
										<label for="Vendor Rating" class=" control-label col-md-4 text-left"> Vendor Rating </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='vendor_rating' id='vendor_rating' value='{{ $row['vendor_rating'] }}' 
						     class='form-control is_decimal' onkeypress='return isNumberKey(event,this)'  /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_votes  " >
										<label for="Vendor Votes" class=" control-label col-md-4 text-left"> Vendor Votes </label>
										
										
										<div class="col-md-6">
										  <input  type='number' name='vendor_votes' id='vendor_votes' value='{{ $row['vendor_votes'] }}' 
						     class='form-control is_number'  /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_categories  " >
										<label for="Vendor Categories" class=" control-label col-md-4 text-left"> Vendor Categories </label>
										
										
										<div class="col-md-6">
										  <select name='vendor_categories[]' multiple rows='5' id='vendor_categories' class='select2 '    ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_website  " >
										<label for="Vendor Website" class=" control-label col-md-4 text-left"> Vendor Website </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='vendor_website' id='vendor_website' value='{{ $row['vendor_website'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_support_email  " >
										<label for="Vendor Support Email" class=" control-label col-md-4 text-left"> Vendor Support Email </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='vendor_support_email' id='vendor_support_email' value='{{ $row['vendor_support_email'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_phnumber  " >
										<label for="Vendor Phone number" class=" control-label col-md-4 text-left"> Vendor Phone number </label>
										
										
										<div class="col-md-6">
										  <input  type='number' name='vendor_phnumber' id='vendor_phnumber' value='{{ $row['vendor_phnumber'] }}' 
						     class='form-control is_number'  /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_howto  " >
										<label for="Vendor How to" class=" control-label col-md-4 text-left"> Vendor How to </label>
										
										
										<div class="col-md-6">
										  <textarea name='vendor_howto' rows='5' id='vendor_howto' class='form-control input-sm '  
				           >{{ $row['vendor_howto'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_policy  " >
										<label for="Vendor Policy" class=" control-label col-md-4 text-left"> Vendor Policy </label>
										
										
										<div class="col-md-6">
										  <textarea name='vendor_policy' rows='5' id='vendor_policy' class='form-control input-sm '  
				           >{{ $row['vendor_policy'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_featured  " >
										<label for="Vendor Featured" class=" control-label col-md-4 text-left"> Vendor Featured </label>
										
										
										<div class="col-md-6">
										  <?php $vendor_featured = (isset($row['vendor_featured'])) ? explode(",",$row['vendor_featured']) : array() ; ?><div class='switch-wrap'> <label class='switch'>
				    <input type='hidden' name='vendor_featured' value ='N' />
					<input type='checkbox' name='vendor_featured' value ='Y' 
					@if(in_array('Y',$vendor_featured))checked @endif 
					 />   <span class="slider round"></span></label></div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_stats  " >
										<label for="Vendor Stats" class=" control-label col-md-4 text-left"> Vendor Stats </label>
										
										
										<div class="col-md-6">
										  <textarea name='vendor_stats' rows='5' id='vendor_stats' class='form-control input-sm '  
				           >{{ $row['vendor_stats'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-clicks  " >
										<label for="Clicks" class=" control-label col-md-4 text-left"> Clicks </label>
										
										
										<div class="col-md-6">
										  <input  type='number' name='clicks' id='clicks' value='{{ $row['clicks'] }}' 
						     class='form-control is_number'  /> 
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
		
		
		$("#vendor_code").jCombo("{!! url('vendoroutlets/comboselect?filter=tb_vendor_account:vendor_code:vendor_code|vendor_name&values='.$row["vendor_code"]) !!}",
		{  selected_value : '{{ $row["vendor_code"] }}' });
		
		$("#outlet_location").jCombo("{!! url('vendoroutlets/comboselect?filter=tb_location_master:location_id:area_pincode|area_name|city&values='.$row["outlet_location"]) !!}",
		{  selected_value : '{{ $row["outlet_location"] }}' });
		
		$("#vendor_categories").jCombo("{!! url('vendoroutlets/comboselect?filter=tb_vendor_categories:cat_id:cat_name&values='.$row["vendor_categories"]) !!}",
		{  selected_value : '{{ $row["vendor_categories"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
