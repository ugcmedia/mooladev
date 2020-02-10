

		 {!! Form::open(array('url'=>'managebrands', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Brands</legend>
				{!! Form::hidden('brand_id', $row['brand_id']) !!}					
									  <div class="form-group depen- wrap-brand_name  " >
										<label for="Brand Name" class=" control-label col-md-4 text-left"> Brand Name </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='brand_name' id='brand_name' value='{{ $row['brand_name'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-brand_logo  " >
										<label for="Brand Logo" class=" control-label col-md-4 text-left"> Brand Logo </label>
										
										
										<div class="col-md-6">
										  <input  type='hidden' name='brand_logo' id='brand_logo' value='{{ $row['brand_logo'] }}' class='brand_logo    form-control input-sm '    />

							<span class='input-group-btn'>
                <button class='btn btn-info' data-type='mediaUpload' data-target='.brand_logo' type='button'>Choose file</button>
				<button class='btn btn-danger unUploadImage' data-type='mediaUnUpload' data-target='brand_logo' type='button'>Remove File</button>
            </span>
			
							<div class='brand_logo_preview'></div>
							<div class='brand_logoPreview'>
					 	<div class='img-preview'>
						{!! SiteHelpers::showUploadedFileCust($row['brand_logo'],'/uploads/images/') !!}
						
						</div>					
						</div>					
					 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_list  " >
										<label for="Vendor List" class=" control-label col-md-4 text-left"> Vendor List </label>
										
										
										<div class="col-md-6">
										  <select name='vendor_list[]' multiple rows='5' id='vendor_list' class='select2 '    ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-brand_desc  " >
										<label for="Brand Desc" class=" control-label col-md-4 text-left"> Brand Desc </label>
										
										
										<div class="col-md-6">
										  <textarea name='brand_desc' rows='5' id='editor' class='form-control input-sm editor '  
						  >{{ $row['brand_desc'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-clicks  " >
										<label for="Clicks" class=" control-label col-md-4 text-left"> Clicks </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='clicks' id='clicks' value='{{ $row['clicks'] }}' 
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
		
		
		$("#vendor_list").jCombo("{!! url('managebrands/comboselect?filter=tb_vendors:vendor_code:vendor_name|outlet_location&values='.$row["vendor_list"]) !!}",
		{  selected_value : '{{ $row["vendor_list"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
