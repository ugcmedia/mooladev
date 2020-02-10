@extends('layouts.app')

@section('content')
<section class="page-header row">
	<h2> {{ $pageTitle }} <small> {{ $pageNote }} </small></h2>
	<ol class="breadcrumb">
		<li><a href="{{ url('') }}"> Dashboard </a></li>
		<li><a href="{{ url($pageModule) }}"> {{ $pageTitle }} </a></li>
		<li class="active"> Form  </li>		
	</ol>
</section>
<div class="page-content row">
	<div class="page-content-wrapper no-margin">

	{!! Form::open(array('url'=>'settingmaster?return='.$return, 'class'=>'form-horizontal validated','files' => true )) !!}
	<input type="hidden" name="status_type" value="{{ $pageTitle }}" />
	
	<div class="sbox">
		<div class="sbox-title clearfix">
			<div class="sbox-tools " >
				<a href="{{ url($pageModule.'?return='.$return) }}" class="tips btn btn-sm "  title="{{ __('core.btn_back') }}" ><i class="fa  fa-times"></i></a> 
			</div>
			<div class="sbox-tools pull-left" >
				<button name="apply" class="tips btn btn-sm btn-apply  "  title="{{ __('core.btn_back') }}" ><i class="fa  fa-check"></i> {{ __('core.sb_apply') }} </button>
				<button name="save" class="tips btn btn-sm btn-save"  title="{{ __('core.btn_back') }}" ><i class="fa  fa-paste"></i> {{ __('core.sb_save') }} </button> 
				<?php if($frontendSlug!='') {
				$fsconfig = explode('@',$frontendSlug);
				if( ($row[$fsconfig[1]]) ) 
				echo '<a  class="tips btn btn-sm btn-warning btn-fs" target="_blank"  title="FrontEnd" href="'. URL::to('/'.$fsconfig[0].'/'.$row[$fsconfig[1]]).'"><i class="fa  fa-desktop"></i> FrontEnd</a>';
				 } ?>
			</div>
		</div>	
		<div class="sbox-content clearfix">
	<ul class="parsley-error-list">
		@foreach($errors->all() as $error)
			<li>{{ $error }}</li>
		@endforeach
	</ul>		
<div class="col-md-12">
						<fieldset><legend> Settings Master</legend>
				{!! Form::hidden('setting_id', $row['setting_id']) !!}					
									  <div class="form-group depen- wrap-setting_ui_name  " >
										<label for="Setting UI Name" class=" control-label col-md-4 text-left"> Setting UI Name </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='setting_ui_name' id='setting_ui_name' value='{{ $row['setting_ui_name'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-setting_key  " >
										<label for="Setting Key" class=" control-label col-md-4 text-left"> Setting Key </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='setting_key' id='setting_key' value='{{ $row['setting_key'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-setting_value  " >
										<label for="Setting Value" class=" control-label col-md-4 text-left"> Setting Value </label>
										
										
										<div class="col-md-6">
										  <textarea name='setting_value' rows='5' id='setting_value' class='form-control input-sm '  
				           >{{ $row['setting_value'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-setting_group  " >
										<label for="Setting Group" class=" control-label col-md-4 text-left"> Setting Group </label>
										
										
										<div class="col-md-6">
										  <?php $setting_group = (isset($row['setting_group'])) ? $row['setting_group'] : null ; ?>
					
					<input type='radio' name='setting_group' value ='General'   @if( $setting_group == 'General') checked="checked" @endif class='minimal-red' > General 
					
					<input type='radio' name='setting_group' value ='Cashback'   @if( $setting_group == 'Cashback') checked="checked" @endif class='minimal-red' > Cashback 
					
					<input type='radio' name='setting_group' value ='Developer'   @if( $setting_group == 'Developer') checked="checked" @endif class='minimal-red' > Developer 
					
					<input type='radio' name='setting_group' value ='Homepage'   @if( $setting_group == 'Homepage') checked="checked" @endif class='minimal-red' > Homepage 
					
					<input type='radio' name='setting_group' value ='Payout'   @if( $setting_group == 'Payout') checked="checked" @endif class='minimal-red' > Payout 
					
					<input type='radio' name='setting_group' value ='SEO'   @if( $setting_group == 'SEO') checked="checked" @endif class='minimal-red' > SEO 
					
					<input type='radio' name='setting_group' value ='Listing'   @if( $setting_group == 'Listing') checked="checked" @endif class='minimal-red' > Listing 
					
					<input type='radio' name='setting_group' value ='Referral'   @if( $setting_group == 'Referral') checked="checked" @endif class='minimal-red' > Referral 
					
					<input type='radio' name='setting_group' value ='Module'   @if( $setting_group == 'Module') checked="checked" @endif class='minimal-red' > Module 
					
					<input type='radio' name='setting_group' value ='Social'   @if( $setting_group == 'Social') checked="checked" @endif class='minimal-red' > Social 
					
					<input type='radio' name='setting_group' value ='Ads'   @if( $setting_group == 'Ads') checked="checked" @endif class='minimal-red' > Ads 
					
					<input type='radio' name='setting_group' value ='App'   @if( $setting_group == 'App') checked="checked" @endif class='minimal-red' > App 
					
					<input type='radio' name='setting_group' value ='Vendor'   @if( $setting_group == 'Vendor') checked="checked" @endif class='minimal-red' > Vendor  
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-setting_dev_class  " >
										<label for="Setting Dev Class" class=" control-label col-md-4 text-left"> Setting Dev Class </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='setting_dev_class' id='setting_dev_class' value='{{ $row['setting_dev_class'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-note  " >
										<label for="Note" class=" control-label col-md-4 text-left"> Note </label>
										
										
										<div class="col-md-6">
										  <textarea name='note' rows='5' id='note' class='form-control input-sm '  
				           >{{ $row['note'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> </fieldset>
			</div>
			
			


		</div>
		
		<div class="sbox-title clearfix">
			<div class="sbox-tools " >
				<a href="{{ url($pageModule.'?return='.$return) }}" class="tips btn btn-sm "  title="{{ __('core.btn_back') }}" ><i class="fa  fa-times"></i></a> 
			</div>
			<div class="sbox-tools pull-left" >
				<button name="apply" class="tips btn btn-sm btn-apply  "  title="{{ __('core.btn_back') }}" ><i class="fa  fa-check"></i> {{ __('core.sb_apply') }} </button>
				<button name="save" class="tips btn btn-sm btn-save"  title="{{ __('core.btn_back') }}" ><i class="fa  fa-paste"></i> {{ __('core.sb_save') }} </button> 
			</div>
		</div>	
		
	</div>
	
	<input type="hidden" name="action_task" value="save" />
	{!! Form::close() !!}
	</div>
</div>		
	
		 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		
		 		 

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("settingmaster/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop