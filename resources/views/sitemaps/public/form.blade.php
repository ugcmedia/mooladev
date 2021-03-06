

		 {!! Form::open(array('url'=>'sitemaps/savepublic', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Sitemap Settings</legend>
				{!! Form::hidden('ssid', $row['ssid']) !!}					
									  <div class="form-group depen- wrap-module  " >
										<label for="Module" class=" control-label col-md-4 text-left"> Module </label>
										
										
										<div class="col-md-6">
										  <select name='module' rows='5' id='module' class='select2 '    ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-slug  " >
										<label for="Slug" class=" control-label col-md-4 text-left"> Slug </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='slug' id='slug' value='{{ $row['slug'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-frequency  " >
										<label for="Frequency" class=" control-label col-md-4 text-left"> Frequency </label>
										<a class="adtip" data-toggle="tooltip" data-placement="bottom" title="How frequently the page is likely to change. This value provides general information to search engines and may not correlate exactly to how often they crawl the page."><i class="fa fa-info-circle"></i></a>
										
										<div class="col-md-6">
										  <?php $frequency = (isset($row['frequency'])) ? $row['frequency'] : null ; ?>
					
					<input type='radio' name='frequency' value ='always'   @if( $frequency == 'always') checked="checked" @endif class='minimal-red' > Always 
					
					<input type='radio' name='frequency' value ='hourly'   @if( $frequency == 'hourly') checked="checked" @endif class='minimal-red' > Hourly 
					
					<input type='radio' name='frequency' value ='daily'   @if( $frequency == 'daily') checked="checked" @endif class='minimal-red' > Daily 
					
					<input type='radio' name='frequency' value ='weekly'   @if( $frequency == 'weekly') checked="checked" @endif class='minimal-red' > Weekly 
					
					<input type='radio' name='frequency' value ='monthly'   @if( $frequency == 'monthly') checked="checked" @endif class='minimal-red' > Monthly 
					
					<input type='radio' name='frequency' value ='yearly'   @if( $frequency == 'yearly') checked="checked" @endif class='minimal-red' > Yearly 
					
					<input type='radio' name='frequency' value ='never'   @if( $frequency == 'never') checked="checked" @endif class='minimal-red' > Never  
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-priority  " >
										<label for="Priority" class=" control-label col-md-4 text-left"> Priority </label>
										
										
										<div class="col-md-6">
										  <?php $priority = (isset($row['priority'])) ? $row['priority'] : null ; ?>
					
					<input type='radio' name='priority' value ='1'   @if( $priority == '1') checked="checked" @endif class='minimal-red' > 1 
					
					<input type='radio' name='priority' value ='0.9'   @if( $priority == '0.9') checked="checked" @endif class='minimal-red' > 0.9 
					
					<input type='radio' name='priority' value ='0.8'   @if( $priority == '0.8') checked="checked" @endif class='minimal-red' > 0.8 
					
					<input type='radio' name='priority' value ='0.7'   @if( $priority == '0.7') checked="checked" @endif class='minimal-red' > 0.7 
					
					<input type='radio' name='priority' value ='0.6'   @if( $priority == '0.6') checked="checked" @endif class='minimal-red' > 0.6 
					
					<input type='radio' name='priority' value ='0.5'   @if( $priority == '0.5') checked="checked" @endif class='minimal-red' > 0.5 
					
					<input type='radio' name='priority' value ='0.4'   @if( $priority == '0.4') checked="checked" @endif class='minimal-red' > 0.4 
					
					<input type='radio' name='priority' value ='0.3'   @if( $priority == '0.3') checked="checked" @endif class='minimal-red' > 0.3 
					
					<input type='radio' name='priority' value ='0.2'   @if( $priority == '0.2') checked="checked" @endif class='minimal-red' > 0.2 
					
					<input type='radio' name='priority' value ='0.1'   @if( $priority == '0.1') checked="checked" @endif class='minimal-red' > 0.1  
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-enabled  " >
										<label for="Enabled" class=" control-label col-md-4 text-left"> Enabled </label>
										
										
										<div class="col-md-6">
										  <?php $enabled = (isset($row['enabled'])) ? explode(",",$row['enabled']) : array() ; ?><div class='switch-wrap'> <label class='switch'>
				    <input type='hidden' name='enabled' value ='N' />
					<input type='checkbox' name='enabled' value ='Y' 
					@if(in_array('Y',$enabled))checked @endif 
					 />   <span class="slider round"></span></label></div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-updated_date  " >
										<label for="Updated Date" class=" control-label col-md-4 text-left"> Updated Date <span class="asterix"> * </span></label>
										
										
										<div class="col-md-6">
										  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('updated_date', $row['updated_date'],array('class'=>'form-control input-sm datetime', 'style'=>'width:150px !important;')) !!}
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
		
		
		$("#module").jCombo("{!! url('sitemaps/comboselect?filter=tb_status:status_code:status_name&values='.$row["module"]) !!}&parent=status_type:",
		{  parent: '#status_type', selected_value : '{{ $row["module"] }}' });
		 

		$('.removeCurrentFiles').on('click',function(){
			var removeUrl = $(this).attr('href');
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
