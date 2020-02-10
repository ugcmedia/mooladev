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

	{!! Form::open(array('url'=>'managetags?return='.$return, 'class'=>'form-horizontal validated','files' => true )) !!}
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
		
		
		
		$("#parent_tag").jCombo("{!! url('managetags/comboselect?filter=tb_tags:tag_id:tag_name&values='.$row["parent_tag"]) !!}",
		{  selected_value : '{{ $row["parent_tag"] }}' });
		 		 

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("managetags/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop