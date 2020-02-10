

		 {!! Form::open(array('url'=>'currencyrates/savepublic', 'class'=>'form-horizontal','files' => true , 'parsley-validate'=>'','novalidate'=>' ')) !!}

	@if(Session::has('messagetext'))
	  
		   {!! Session::get('messagetext') !!}
	   
	@endif
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		


<div class="col-md-12">
						<fieldset><legend> Currency Rates</legend>
				{!! Form::hidden('currency_id', $row['currency_id']) !!}					
									  <div class="form-group depen- wrap-currency_code  " >
										<label for="Currency Code" class=" control-label col-md-4 text-left"> Currency Code </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='currency_code' id='currency_code' value='{{ $row['currency_code'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-currency_rate  " >
										<label for="Currency Rate" class=" control-label col-md-4 text-left"> Currency Rate </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='currency_rate' id='currency_rate' value='{{ $row['currency_rate'] }}' 
						     class='form-control is_decimal' onkeypress='return isNumberKey(event,this)'  /> 
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
