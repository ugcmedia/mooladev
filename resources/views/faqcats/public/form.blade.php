

		 {!! Form::open(array('url'=>'faqcats/savepublic', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> faqcats</legend>
				{!! Form::hidden('faq_cat_id', $row['faq_cat_id']) !!}					
									  <div class="form-group depen- wrap-cat_name  " >
										<label for="Cat Name" class=" control-label col-md-4 text-left"> Cat Name </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='cat_name' id='cat_name' value='{{ $row['cat_name'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-cat_icon  " >
										<label for="Cat Icon" class=" control-label col-md-4 text-left"> Cat Icon </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='cat_icon' id='cat_icon' value='{{ $row['cat_icon'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> {!! Form::hidden('cat_code', $row['cat_code']) !!}					
									  <div class="form-group depen- wrap-cat_sequence  " >
										<label for="Cat Sequence" class=" control-label col-md-4 text-left"> Cat Sequence </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='cat_sequence' id='cat_sequence' value='{{ $row['cat_sequence'] }}' 
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
		
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
