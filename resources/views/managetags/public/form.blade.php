

		 {!! Form::open(array('url'=>'managetags', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Tags</legend>
				{!! Form::hidden('tag_id', $row['tag_id']) !!}					
									  <div class="form-group depen- wrap-tag_name  " >
										<label for="Tag Name" class=" control-label col-md-4 text-left"> Tag Name </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='tag_name' id='tag_name' value='{{ $row['tag_name'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-tag_slug  " >
										<label for="Tag Slug" class=" control-label col-md-4 text-left"> Tag Slug </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='tag_slug' id='tag_slug' value='{{ $row['tag_slug'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-parent_tag  " >
										<label for="Parent Tag" class=" control-label col-md-4 text-left"> Parent Tag </label>
										
										
										<div class="col-md-6">
										  <select name='parent_tag' rows='5' id='parent_tag' class='select2 '    ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-tag_icon  " >
										<label for="Tag Icon" class=" control-label col-md-4 text-left"> Tag Icon </label>
										
										
										<div class="col-md-6">
										  <input  type='hidden' name='tag_icon' id='tag_icon' value='{{ $row['tag_icon'] }}' class='tag_icon    form-control input-sm '    />

							<span class='input-group-btn'>
                <button class='btn btn-info' data-type='mediaUpload' data-target='.tag_icon' type='button'>Choose file</button>
				<button class='btn btn-danger unUploadImage' data-type='mediaUnUpload' data-target='tag_icon' type='button'>Remove File</button>
            </span>
			
							<div class='tag_icon_preview'></div>
							<div class='tag_iconPreview'>
					 	<div class='img-preview'>
						{!! SiteHelpers::showUploadedFileCust($row['tag_icon'],'/uploads/images/') !!}
						
						</div>					
						</div>					
					 
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
		
		
		$("#parent_tag").jCombo("{!! url('managetags/comboselect?filter=tb_tags:tag_id:tag_name&values='.$row["parent_tag"]) !!}",
		{  selected_value : '{{ $row["parent_tag"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
