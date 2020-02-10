

		 {!! Form::open(array('url'=>'manageoffers', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Offers</legend>
				{!! Form::hidden('offer_id', $row['offer_id']) !!}					
									  <div class="form-group depen- wrap-offer_code  " >
										<label for="Offer Code" class=" control-label col-md-4 text-left"> Offer Code </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='offer_code' id='offer_code' value='{{ $row['offer_code'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_code  " >
										<label for="Vendor Code" class=" control-label col-md-4 text-left"> Vendor Code </label>
										
										
										<div class="col-md-6">
										  <select name='vendor_code' rows='5' id='vendor_code' class='select2 '    ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_title  " >
										<label for="Offer Title" class=" control-label col-md-4 text-left"> Offer Title </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='offer_title' id='offer_title' value='{{ $row['offer_title'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_desc  " >
										<label for="Offer Desc" class=" control-label col-md-4 text-left"> Offer Desc </label>
										
										
										<div class="col-md-6">
										  <textarea name='offer_desc' rows='5' id='offer_desc' class='form-control input-sm '  
				           >{{ $row['offer_desc'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_image  " >
										<label for="Offer Image" class=" control-label col-md-4 text-left"> Offer Image </label>
										
										
										<div class="col-md-6">
										  <input  type='hidden' name='offer_image' id='offer_image' value='{{ $row['offer_image'] }}' class='offer_image    form-control input-sm '    />

							<span class='input-group-btn'>
                <button class='btn btn-info' data-type='mediaUpload' data-target='.offer_image' type='button'>Choose file</button>
				<button class='btn btn-danger unUploadImage' data-type='mediaUnUpload' data-target='offer_image' type='button'>Remove File</button>
            </span>
			
							<div class='offer_image_preview'></div>
							<div class='offer_imagePreview'>
					 	<div class='img-preview'>
						{!! SiteHelpers::showUploadedFileCust($row['offer_image'],'/uploads/images/') !!}
						
						</div>					
						</div>					
					 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_gallery  " >
										<label for="Offer Gallery" class=" control-label col-md-4 text-left"> Offer Gallery </label>
										
										
										<div class="col-md-6">
										  <textarea name='offer_gallery' rows='5' id='offer_gallery' class='form-control input-sm '  
				           >{{ $row['offer_gallery'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_mrp  " >
										<label for="Offer Mrp" class=" control-label col-md-4 text-left"> Offer Mrp </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='offer_mrp' id='offer_mrp' value='{{ $row['offer_mrp'] }}' 
						     class='form-control is_decimal' onkeypress='return isNumberKey(event,this)'  /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_deal_price  " >
										<label for="Offer Deal Price" class=" control-label col-md-4 text-left"> Offer Deal Price </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='offer_deal_price' id='offer_deal_price' value='{{ $row['offer_deal_price'] }}' 
						     class='form-control is_decimal' onkeypress='return isNumberKey(event,this)'  /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_expiry  " >
										<label for="Offer Expiry" class=" control-label col-md-4 text-left"> Offer Expiry </label>
										
										
										<div class="col-md-6">
										  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('offer_expiry', $row['offer_expiry'],array('class'=>'form-control input-sm datetime', 'style'=>'width:150px !important;')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_fine_print  " >
										<label for="Offer Fine Print" class=" control-label col-md-4 text-left"> Offer Fine Print </label>
										
										
										<div class="col-md-6">
										  <textarea name='offer_fine_print' rows='5' id='editor' class='form-control input-sm editor '  
						  >{{ $row['offer_fine_print'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_instructions  " >
										<label for="Offer Instructions" class=" control-label col-md-4 text-left"> Offer Instructions </label>
										
										
										<div class="col-md-6">
										  <textarea name='offer_instructions' rows='5' id='editor' class='form-control input-sm editor '  
						  >{{ $row['offer_instructions'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_status  " >
										<label for="Offer Status" class=" control-label col-md-4 text-left"> Offer Status </label>
										
										
										<div class="col-md-6">
										  <?php $offer_status = (isset($row['offer_status'])) ? explode(",",$row['offer_status']) : array() ; ?><div class='switch-wrap'> <label class='switch'>
				    <input type='hidden' name='offer_status' value ='N' />
					<input type='checkbox' name='offer_status' value ='Y' 
					@if(in_array('Y',$offer_status))checked @endif 
					 />   <span class="slider round"></span></label></div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_tags  " >
										<label for="Offer Tags" class=" control-label col-md-4 text-left"> Offer Tags </label>
										
										
										<div class="col-md-6">
										  <select name='offer_tags[]' multiple rows='5' id='offer_tags' class='select2 '    ></select> 
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
									  </div> 					
									  <div class="form-group depen- wrap-vote_up  " >
										<label for="Vote Up" class=" control-label col-md-4 text-left"> Vote Up </label>
										
										
										<div class="col-md-6">
										  <input  type='number' name='vote_up' id='vote_up' value='{{ $row['vote_up'] }}' 
						     class='form-control is_number'  /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vote_down  " >
										<label for="Vote Down" class=" control-label col-md-4 text-left"> Vote Down </label>
										
										
										<div class="col-md-6">
										  <input  type='number' name='vote_down' id='vote_down' value='{{ $row['vote_down'] }}' 
						     class='form-control is_number'  /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_stats  " >
										<label for="Offer Stats" class=" control-label col-md-4 text-left"> Offer Stats </label>
										
										
										<div class="col-md-6">
										  <textarea name='offer_stats' rows='5' id='offer_stats' class='form-control input-sm '  
				           >{{ $row['offer_stats'] }}</textarea> 
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
		
		
		$("#vendor_code").jCombo("{!! url('manageoffers/comboselect?filter=tb_vendors:vendor_code:vendor_name|outlet_location&values='.$row["vendor_code"]) !!}",
		{  selected_value : '{{ $row["vendor_code"] }}' });
		
		$("#offer_tags").jCombo("{!! url('manageoffers/comboselect?filter=tb_tags:tag_id:tag_name&values='.$row["offer_tags"]) !!}",
		{  selected_value : '{{ $row["offer_tags"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
