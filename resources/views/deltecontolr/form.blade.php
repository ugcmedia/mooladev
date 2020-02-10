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

	{!! Form::open(array('url'=>'deltecontolr?return='.$return, 'class'=>'form-horizontal validated','files' => true )) !!}
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
						<fieldset><legend> TItle</legend>
									
									  <div class="form-group depen- wrap-offer_id  " >
										<label for="Offer Id" class=" control-label col-md-4 text-left"> Offer Id </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='offer_id' id='offer_id' value='{{ $row['offer_id'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_code  " >
										<label for="Offer Code" class=" control-label col-md-4 text-left"> Offer Code </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='offer_code' id='offer_code' value='{{ $row['offer_code'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vendor_code  " >
										<label for="Vendor Code" class=" control-label col-md-4 text-left"> Vendor Code </label>
										
										
										<div class="col-md-6">
										  <select name='vendor_code' rows='5' id='vendor_code' class='select2 '    ></select> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_title  " >
										<label for="Offer Title" class=" control-label col-md-4 text-left"> Offer Title </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='offer_title' id='offer_title' value='{{ $row['offer_title'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_desc  " >
										<label for="Offer Desc" class=" control-label col-md-4 text-left"> Offer Desc </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='offer_desc' id='offer_desc' value='{{ $row['offer_desc'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_image  " >
										<label for="Offer Image" class=" control-label col-md-4 text-left"> Offer Image </label>
										
										
										<div class="col-md-6">
										  <input  type='hidden' name='offer_image' id='offer_image' value='{{ $row['offer_image'] }}' class='offer_image    form-control input-sm '    />

							<span class='input-group-btn'>
                <button class='btn btn-info' data-type='mediaUpload' data-target='.offer_image' type='button'>Choose file</button>
				<button class='btn btn-danger unUploadImage' data-type='mediaUnUpload' data-target='offer_image' type='button'>Remove File</button>
            </span>
			
							<div class='offer_image_preview'></div>
							<div class='offer_imagePreview'>
					 	<div class='img-preview'>
						{!! SiteHelpers::showUploadedFileCust($row['offer_image'],'') !!}
						
						</div>					
						</div>					
					 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_gallery  " >
										<label for="Offer Gallery" class=" control-label col-md-4 text-left"> Offer Gallery </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='offer_gallery' id='offer_gallery' value='{{ $row['offer_gallery'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_mrp  " >
										<label for="Offer Mrp" class=" control-label col-md-4 text-left"> Offer Mrp </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='offer_mrp' id='offer_mrp' value='{{ $row['offer_mrp'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_deal_price  " >
										<label for="Offer Deal Price" class=" control-label col-md-4 text-left"> Offer Deal Price </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='offer_deal_price' id='offer_deal_price' value='{{ $row['offer_deal_price'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_expiry  " >
										<label for="Offer Expiry" class=" control-label col-md-4 text-left"> Offer Expiry </label>
										
										
										<div class="col-md-6">
										  
				<div class="input-group m-b" style="width:150px !important;">
					{!! Form::text('offer_expiry', $row['offer_expiry'],array('class'=>'form-control input-sm datetime', 'style'=>'width:150px !important;')) !!}
					<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
				</div>
				 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_fine_print  " >
										<label for="Offer Fine Print" class=" control-label col-md-4 text-left"> Offer Fine Print </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='offer_fine_print' id='offer_fine_print' value='{{ $row['offer_fine_print'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_instructions  " >
										<label for="Offer Instructions" class=" control-label col-md-4 text-left"> Offer Instructions </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='offer_instructions' id='offer_instructions' value='{{ $row['offer_instructions'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_status  " >
										<label for="Offer Status" class=" control-label col-md-4 text-left"> Offer Status </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='offer_status' id='offer_status' value='{{ $row['offer_status'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_tags  " >
										<label for="Offer Tags" class=" control-label col-md-4 text-left"> Offer Tags </label>
										
										
										<div class="col-md-6">
										  <textarea name='offer_tags' rows='5' id='offer_tags' class='form-control input-sm '  
				           >{{ $row['offer_tags'] }}</textarea> 
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
									  </div> 					
									  <div class="form-group depen- wrap-vote_up  " >
										<label for="Vote Up" class=" control-label col-md-4 text-left"> Vote Up </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='vote_up' id='vote_up' value='{{ $row['vote_up'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-vote_down  " >
										<label for="Vote Down" class=" control-label col-md-4 text-left"> Vote Down </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='vote_down' id='vote_down' value='{{ $row['vote_down'] }}' 
						     class='form-control input-sm ' /> 
										 </div> 
										 <div class="col-md-2">
										 	
										 </div>
									  </div> 					
									  <div class="form-group depen- wrap-offer_stats  " >
										<label for="Offer Stats" class=" control-label col-md-4 text-left"> Offer Stats </label>
										
										
										<div class="col-md-6">
										  <input  type='text' name='offer_stats' id='offer_stats' value='{{ $row['offer_stats'] }}' 
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
		
		
		
		$("#vendor_code").jCombo("{!! url('deltecontolr/comboselect?filter=tb_vendors:vendor_code:vendor_name&values='.$row["vendor_code"]) !!}",
		{  selected_value : '{{ $row["vendor_code"] }}' });
		 		 

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("deltecontolr/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>		 
@stop