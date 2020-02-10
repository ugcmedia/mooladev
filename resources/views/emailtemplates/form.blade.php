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

	{!! Form::open(array('url'=>'emailtemplates?return='.$return, 'class'=>'form-vertical validated','files' => true )) !!}
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
<div class="col-md-6">
						<fieldset><legend> System Generated Email Configuration</legend>
									
									  <div class="form-group  depen-  wrap-purpose  " >
										<label for="ipt" class=" control-label "> Purpose    </label>
										
										
										  <input  type='text' name='purpose' id='purpose' value='{{ $row['purpose'] }}' 
						     class='form-control input-sm ' /> 						
									  </div> {!! Form::hidden('template_id', $row['template_id']) !!}					
									  <div class="form-group  depen-  wrap-subject  " >
										<label for="ipt" class=" control-label "> Subject    </label>
										
										
										  <input  type='text' name='subject' id='subject' value='{{ $row['subject'] }}' 
						     class='form-control input-sm ' /> 						
									  </div> 					
									  <div class="form-group  depen-  wrap-body  " >
										<label for="ipt" class=" control-label "> Body    </label>
										
										
										  <textarea name='body' rows='5' id='editor' class='form-control input-sm editor '  
						  >{{ $row['body'] }}</textarea> 						
									  </div> 					
									  <div class="form-group  depen-  wrap-email_key  " >
										<label for="ipt" class=" control-label "> Email Key    </label>
										
										
										  <input  type='text' name='email_key' id='email_key' value='{{ $row['email_key'] }}' 
						     class='form-control input-sm ' /> 						
									  </div> 					
									  <div class="form-group  depen-  wrap-enabled  " >
										<label for="ipt" class=" control-label "> Status    </label>
										
										
										  <?php $enabled = (isset($row['enabled'])) ? explode(",",$row['enabled']) : array() ; ?><div class='switch-wrap'> <label class='switch'>
				    <input type='hidden' name='enabled' value ='N' />
					<input type='checkbox' name='enabled' value ='Y' 
					@if(in_array('Y',$enabled))checked @endif 
					 />   <span class="slider round"></span></label></div> 						
									  </div> </fieldset>
			</div>
			
			<div class="col-md-6">
						<fieldset><legend> Additional Information</legend>
									
									  <div class="form-group  depen-  wrap-sender_name  " >
										<label for="ipt" class=" control-label "> Sender Name    </label>
										
										
										  <input  type='text' name='sender_name' id='sender_name' value='{{ $row['sender_name'] }}' 
						     class='form-control input-sm ' /> 						
									  </div> 					
									  <div class="form-group  depen-  wrap-sender_email  " >
										<label for="ipt" class=" control-label "> Sender Email    </label>
										
										
										  <input  type='text' name='sender_email' id='sender_email' value='{{ $row['sender_email'] }}' 
						     class='form-control input-sm ' /> 						
									  </div> 					
									  <div class="form-group  depen-  wrap-reply_to  " >
										<label for="ipt" class=" control-label "> Reply To    </label>
										
										
										  <input  type='text' name='reply_to' id='reply_to' value='{{ $row['reply_to'] }}' 
						     class='form-control input-sm ' /> 						
									  </div> 					
									  <div class="form-group  depen-  wrap-sms_enabled  " >
										<label for="ipt" class=" control-label "> SMS    </label>
										
										
										  <?php $sms_enabled = (isset($row['sms_enabled'])) ? explode(",",$row['sms_enabled']) : array() ; ?><div class='switch-wrap'> <label class='switch'>
				    <input type='hidden' name='sms_enabled' value ='N' />
					<input type='checkbox' name='sms_enabled' value ='Y' 
					@if(in_array('Y',$sms_enabled))checked @endif 
					 />   <span class="slider round"></span></label></div> 						
									  </div> 					
									  <div class="form-group  depen-sms_enabled  wrap-sms_body  " >
										<label for="ipt" class=" control-label "> Sms Body    </label>
										
										
										  <textarea name='sms_body' rows='5' id='sms_body' class='form-control input-sm '  
				           >{{ $row['sms_body'] }}</textarea> 						
									  </div> 					
									  <div class="form-group  depen-  wrap-module  " >
										<label for="ipt" class=" control-label "> Module    </label>
										
										
										  <select name='module' rows='5' id='module' class='select2 '    ></select> 						
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
		
		
		
		$("#module").jCombo("{!! url('emailtemplates/comboselect?filter=tb_module:module_name:module_title&values='.$row["module"]) !!}",
		{  selected_value : '{{ $row["module"] }}' });
		 		 

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("emailtemplates/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop