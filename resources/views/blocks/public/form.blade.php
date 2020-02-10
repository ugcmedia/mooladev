

		 {!! Form::open(array('url'=>'blocks/savepublic', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Blocks</legend>
				{!! Form::hidden('block_id', $row['block_id']) !!}					
									  <div class="form-group depen- wrap-block_type  " >
										<label for="Block Type" class=" control-label col-md-4 text-left"> Block Type </label>
										
										
										<div class="col-md-6">
										  <select name='block_type' rows='5' id='block_type' class='select2 '    ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-title  " >
										<label for="Title" class=" control-label col-md-4 text-left"> Title </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='title' id='title' value='{{ $row['title'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-block_content  " >
										<label for="Block Content" class=" control-label col-md-4 text-left"> Block Content </label>
										
										
										<div class="col-md-6">
										  <textarea name='block_content' rows='5' id='editor' class='form-control input-sm editor '  
						  >{{ $row['block_content'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-block_image  " >
										<label for="Block Image" class=" control-label col-md-4 text-left"> Block Image </label>
										
										
										<div class="col-md-6">
										  <input  type='hidden' name='block_image' id='block_image' value='{{ $row['block_image'] }}' class='block_image    form-control input-sm '    />

							<span class='input-group-btn'>
                <button class='btn btn-info' data-type='mediaUpload' data-target='.block_image' type='button'>Choose file</button>
				<button class='btn btn-danger unUploadImage' data-type='mediaUnUpload' data-target='block_image' type='button'>Remove File</button>
            </span>
			
							<div class='block_image_preview'></div>
							<div class='block_imagePreview'>
					 	<div class='img-preview'>
						{!! SiteHelpers::showUploadedFileCust($row['block_image'],'/uploads/images/blocks/') !!}
						
						</div>					
						</div>					
					 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-promo_link  " >
										<label for="Promo Link" class=" control-label col-md-4 text-left"> Promo Link </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='promo_link' id='promo_link' value='{{ $row['promo_link'] }}' 
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
		
		
		$("#block_type").jCombo("{!! url('blocks/comboselect?filter=tb_lookups:lookup_key:lookup_value&values='.$row["block_type"]) !!}&parent=lookup_type:",
		{  parent: '#lookup_type', selected_value : '{{ $row["block_type"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
