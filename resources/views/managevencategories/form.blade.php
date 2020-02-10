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

	{!! Form::open(array('url'=>'managevencategories?return='.$return, 'class'=>'form-horizontal validated','files' => true )) !!}
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
						<fieldset><legend> Vendor Categories</legend>
				{!! Form::hidden('cat_id', $row['cat_id']) !!}					
									  <div class="form-group depen- wrap-cat_name  " >
										<label for="Cat Name" class=" control-label col-md-4 text-left"> Cat Name </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='cat_name' id='cat_name' value='{{ $row['cat_name'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-cat_slug  " >
										<label for="Cat Slug" class=" control-label col-md-4 text-left"> Cat Slug </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='cat_slug' id='cat_slug' value='{{ $row['cat_slug'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-parent_cat  " >
										<label for="Parent Cat" class=" control-label col-md-4 text-left"> Parent Cat </label>
										
										
										<div class="col-md-6">
										  <select name='parent_cat' rows='5' id='parent_cat' class='select2 '    ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-cat_icon  " >
										<label for="Cat Icon" class=" control-label col-md-4 text-left"> Cat Icon </label>
										
										
										<div class="col-md-6">
										  <input  type='hidden' name='cat_icon' id='cat_icon' value='{{ $row['cat_icon'] }}' class='cat_icon    form-control input-sm '    />

							<span class='input-group-btn'>
                <button class='btn btn-info' data-type='mediaUpload' data-target='.cat_icon' type='button'>Choose file</button>
				<button class='btn btn-danger unUploadImage' data-type='mediaUnUpload' data-target='cat_icon' type='button'>Remove File</button>
            </span>
			
							<div class='cat_icon_preview'></div>
							<div class='cat_iconPreview'>
					 	<div class='img-preview'>
						{!! SiteHelpers::showUploadedFileCust($row['cat_icon'],'/uploads/images/') !!}
						
						</div>					
						</div>					
					 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-cat_featured  " >
										<label for="Cat Featured" class=" control-label col-md-4 text-left"> Cat Featured </label>
										
										
										<div class="col-md-6">
										  <?php $cat_featured = (isset($row['cat_featured'])) ? explode(",",$row['cat_featured']) : array() ; ?><div class='switch-wrap'> <label class='switch'>
				    <input type='hidden' name='cat_featured' value ='N' />
					<input type='checkbox' name='cat_featured' value ='Y' 
					@if(in_array('Y',$cat_featured))checked @endif 
					 />   <span class="slider round"></span></label></div> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-cat_desc  " >
										<label for="Cat Desc" class=" control-label col-md-4 text-left"> Cat Desc </label>
										
										
										<div class="col-md-6">
										  <textarea name='cat_desc' rows='5' id='editor' class='form-control input-sm editor '  
						  >{{ $row['cat_desc'] }}</textarea> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-cat_h1  " >
										<label for="Cat H1" class=" control-label col-md-4 text-left"> Cat H1 </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='cat_h1' id='cat_h1' value='{{ $row['cat_h1'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-cat_h2  " >
										<label for="Cat H2" class=" control-label col-md-4 text-left"> Cat H2 </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='cat_h2' id='cat_h2' value='{{ $row['cat_h2'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-clicks  " >
										<label for="Clicks" class=" control-label col-md-4 text-left"> Clicks </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='clicks' id='clicks' value='{{ $row['clicks'] }}' 
						     class='form-control input-sm ' /> 
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
		
		
		
		$("#parent_cat").jCombo("{!! url('managevencategories/comboselect?filter=tb_vendor_categories:cat_id:cat_name&values='.$row["parent_cat"]) !!}",
		{  selected_value : '{{ $row["parent_cat"] }}' });
		 		 

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("managevencategories/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop