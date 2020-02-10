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
			 {!! Form::open(array('url'=>'sximo/config/email/', 'class'=>'form-vertical row validated')) !!}
			
			<div class="col-sm-6 animated fadeInRight">
				<h3> Template Header </h3>
				<div class="form-group">
					<textarea rows="50" name="EmailHead" class="form-control input-sm  markItUp">{{ $EmailHead }}</textarea>	
				</div>  
						

				<div class="form-group">   
					<button class="btn btn-primary" type="submit"> {{ Lang::get('core.sb_savechanges') }}</button>	 
				</div>
				
			</div> 


			<div class="col-sm-6 animated fadeInRight">
				<h3> Template Footer </h3>
				
				<div class="form-group">
					<textarea rows="50" name="EmailFoot" class="form-control  input-sm markItUp">{{ $EmailFoot }}</textarea>					 
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

<style>
.note-editable {    height: 500px !important;}
</style>


@stop





