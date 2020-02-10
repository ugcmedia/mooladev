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
<div class="page-content  row">
	<div class="page-content-wrapper no-margin">

	<div class="sbox">
		<div class="sbox-title">
			<h1> Form Update </h1>
			<div class="sbox-tools" >
				<a href="{{ url($pageModule.'?return='.$return) }}" class="tips btn btn-sm  "  title="{{ __('core.btn_back') }}" ><i class="fa  fa-times"></i></a> 
			</div>

		</div>	
		<div class="sbox-content">

		<ul class="parsley-error-list">
			@foreach($errors->all() as $error)
				<li>{{ $error }}</li>
			@endforeach
		</ul>			
			<div class="row">



		 {!! Form::open(array('url'=>'core/pages', 'class'=>'form-vertical validated','files' => true )) !!}		
		 

		{!! Form::hidden('pagetype', 'page') !!}		 

			<div class="col-sm-9 ">
	

						<ul class="nav nav-tabs" >
						  <li class="active"><a href="#info" data-toggle="tab"> Page Content </a></li>
						  <li ><a href="#meta" data-toggle="tab"> Meta & Description </a></li>
						</ul>	

						<div class="tab-content">
						  <div class="tab-pane active m-t" id="info">
				  <div class="form-group  " >
					<label for="ipt" > Title </label>
					
					  {!! Form::text('title', $row['title'],array('class'=>'form-control input-sm', 'placeholder'=>'', 'required'=>'true'  )) !!} 
					
				  </div> 					
				  <div class="form-group  " >
					<label for="ipt" class=" btn-primary  btn btn-sm">  {!! url('')!!}/  </label>						 
						{!! Form::text('alias', $row['alias'],array('class'=>'form-control input-sm', 'placeholder'=>'', 'style'=>'width:150px; display:inline-block;'   )) !!} 
				  </div> 

				  
							  <div class="form-group  " >
								<label for="note" > Main Content </label>
								<div class="" style="background:#fff;">
								  <textarea name='note' style="min-height: 200px;" rows='25' id='note'    class='form-control editor'  
									 >{{ $row['note'] }}</textarea> 
								 </div> 
							  </div>

							  <div class="form-group  " >
								<label for="footer_note" > Footer Content </label>
								<div class="" style="background:#fff;">
								  <textarea name='footer_note' style="min-height: 200px;" rows='25' id='footer_note'    class='form-control editor'  
									 >{{ $row['footer_note'] }}</textarea> 
								 </div> 
							  </div> 						  

						  </div>

						  <div class="tab-pane m-t" id="meta">
						  
						   <div class="form-group  " >
					<label for="meta_title" > Meta Title </label>
					
					  {!! Form::text('meta_title', $row['meta_title'],array('class'=>'form-control input-sm', 'placeholder'=>''  )) !!} 
					
				  </div>

				  <div class="form-group  ">
					<label for="heading" > Heading / H1 Tag</label>
					
					  {!! Form::text('heading', $row['heading'],array('class'=>'form-control input-sm', 'placeholder'=>''  )) !!} 
					
				  </div>
				  

					  		<div class="form-group  " >
								<label class=""> Metakey </label>
								<div class="" style="background:#fff;">
								  <textarea name='metakey' rows='5' id='metakey' class='form-control markItUp'>{{ $row['metakey'] }}</textarea> 
								 </div> 
							  </div> 

				  			<div class="form-group  " >
								<label class=""> Meta Description </label>
								<div class="" style="background:#fff;">
								  <textarea name='metadesc' rows='10' id='metadesc' class='form-control markItUp'>{{ $row['metadesc'] }}</textarea> 
								 </div> 
							  </div> 							  						  

						  </div>

						
							
						</div>  
		 	</div>		 
		 
		 	<div class="col-sm-3 ">
			
						
									  <div class="form-group  wrap-image  " >
										<label for="ipt" class=" control-label "> Featured Image  </label>
										
										
										  <input  type='hidden' name='image' id='image' value='{{ $row['image'] }}' class='image    form-control input-sm '    />

							<span class='input-group-btn'>
                <button class='btn btn-info' data-type='mediaUpload' data-target='.image' type='button'>Choose file</button>
            </span>
			
							<div class='image_preview'></div>
							<div class='imagePreview'>
					 	<div class='img-preview'>
						{!! SiteHelpers::showUploadedFileCust($row['image'],'/uploads/images/') !!}
						
						</div>					
						</div>	
						
						</div>	
						

						
					
				  <div class="form-group hidethis " style="display:none;">
					<label for="ipt" class=""> PageID </label>
					
					  {!! Form::text('pageID', $row['pageID'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 
					
				  </div> 					
					

				  <div class="form-group " >
				  <label for="ipt"> Who can view this page ? </label>
				  <?php $page_access = json_decode(($row['access']),true); ?>
					@foreach($groups as $group) 
					<div class="">					
					  <input  type='checkbox' name='group_id[{{ $group['id'] }}]'    value="{{ $group['id'] }}" <?php echo ( $page_access[$group['id']] ==1 || (count($page_access)==0)) ? 'checked' : '' ;?> class="minimal-red" /> 
					  <label>{{ $group['name'] }}</label>
					</div>  
					@endforeach	
						  
				  </div> 
				  <div class="form-group  " >
					<label> Sitemap Control </label>
					<div class="">
						<input  type='checkbox' name='allow_guest'  class="minimal-red" 
 						@if($row['allow_guest'] ==1 ) checked  @endif	
					   value="1"	/> <label> Exclude </label>  </div>
				  </div>


				  	
				<input  type='hidden' name='status'  value="enable" />
				
				  <div class="form-group  " >
					<label> Status </label>
					<div class="">					
					  <input  type='radio' name='status'  value="enable" required class="minimal-red" 
					  @if( $row['status'] =='enable')  	checked	  @endif				  
					   /> 
					  <label>Enable </label>
					</div> 
					<div class="">					
					  <input  type='radio' name='status'  value="disabled" required class="minimal-red" 
					   @if( $row['status'] =='disabled')  	checked	  @endif				  
					   /> 
					  <label> Disabled</label>
					</div> 					 
				  </div> 

				  <div class="form-group  " style="display:none">
					<label> Template </label>
					<div class="">					
					  <input  type='radio' name='template'  value="frontend" required class="minimal-red" 
					  @if( $row['template'] !='backend')  	checked	  @endif				  
					   /> 
					  <label> Frontend </label>
					</div> 
					<div class="">					
					  <input  type='radio' name='template'  value="backend" required class="minimal-red" 
					   @if( $row['template'] =='backend')  	checked	  @endif				  
					   /> 
					  <label> Backend </label>
					</div> 					 
				  </div> 	
				  
				  <input  type='hidden' name='template'  value="frontend" />

				  <div class="form-group  " >
					<label for="ipt" > Page Template </label>

					<select class="form-control input-sm" name="filename">
						<option value="page"> Select Template </option>
						@foreach($pagetemplate['template'] as $key=> $val)
							<option value="{{ $val }}" @if($row['filename'] == $val) selected @endif>{{ $key}}</option>
						@endforeach


					</select>
					
					  
					
				  </div> 

				  
			  <div class="form-group">
				
				<button type="submit" class="btn btn-sm btn-success " name="apply">  Apply </button>
				<button type="submit" class="btn btn-sm btn-primary ">  Submit </button>
				<a href="{{ url('core/pages')}}" class="btn btn-sm btn-info"> Cancel </a>
				<p></p>
				<?php if($row['alias']=='home' || $row['alias']=='homepage') : ?>
				<a href="{{ url('')}}" target="_blank" class="btn btn-danger btn-sm btn-flat"> <i class="fa  fa-eye"></i></li> View </a>
			   <?php else : ?>
			   <a href="{{ url($row['alias'])}}" target="_blank" class="btn btn-danger btn-sm btn-flat"> <i class="fa  fa-eye"></i></li> View </a>
				<?php endif;?>
				 
		
			  </div> 
						  				  
				  		
			</div>
			
			
		 	<input type="hidden" name="updated" value="{{ date('Y-m-d H:i:s') }}" />
			<input type="hidden" name="views" value="{{ $row['views']+0 }}" />
			
			<input type="hidden" name="action_task" value="save" />
		 	{!! Form::close() !!}
		</div>
	</div>
	</div>
</div>	
		 
   <script type="text/javascript">
	$(document).ready(function() { 
		 
	});
	</script>		 
@stop
