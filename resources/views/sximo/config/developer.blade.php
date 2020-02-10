 @extends('layouts.app')

@section('content')
<div class="page-content row">
	<div class="page-content-wrapper m-t">

		<div class="sbox">
			<div class="sbox-title">
				 <h1> {{ $pageTitle }}</h1>
			</div>
			<div class="sbox-content">


			@include('sximo.config.tab')
			 {!! Form::open(array('url'=>'sximo/config/developer/', 'class'=>'form-vertical row validated')) !!}
			
			<div class="col-sm-6 animated fadeInRight">
				<h3> Header </h3>
				<div class="form-group">
					<label for="ipt" class=" control-label"> Header </label>		
					<textarea rows="20" name="headDev" class="form-control input-sm  markItUp">{{ $headDev }}</textarea>	
				</div>  
						

				<div class="form-group">   
					<button class="btn btn-primary" type="submit"> {{ Lang::get('core.sb_savechanges') }}</button>	 
				</div>
				
			</div> 


			<div class="col-sm-6 animated fadeInRight">
				<h3> Footer </h3>
				
				<div class="form-group">
					<label for="ipt" class=" control-label ">Footer </label>					
					<textarea rows="20" name="footDev" class="form-control input-sm markItUp">{{ $footDev }}</textarea>					 
				</div> 

				<div class="form-group">
					<button class="btn btn-primary" type="submit">{{ Lang::get('core.sb_savechanges') }}</button>
				</div> 
				 
			</div>	  

			   {!! Form::close() !!}

			</div>
		</div>
	</div>
</div>



@stop





