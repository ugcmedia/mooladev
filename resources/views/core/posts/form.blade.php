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
			
		
		 {!! Form::open(array('url'=>'core/posts?return='.$return, 'class'=>'form-vertical validated','files' => true )) !!}
			<div class="col-md-9">

						<ul class="nav nav-tabs m-b" >
						  <li class="active"><a href="#info" data-toggle="tab"> Page Content </a></li>
						  <li ><a href="#meta" data-toggle="tab"> Meta & Description </a></li>
						</ul>	

					<div class="tab-content">
						  <div class="tab-pane active m-t" id="info">

							{!! Form::hidden('pageID', $row['pageID']) !!}		
							{!! Form::hidden('pagetype', 'post') !!}
							{!! Form::hidden('pageID', $row['pageID']) !!}			
									  <div class="form-group  " >
										<label > Post Title    </label>									
										  {!! Form::text('title', $row['title'],array('class'=>'form-control', 'placeholder'=>'',   )) !!} 						
									  </div> 					
									  <div class="form-group  " >
										<label for="ipt" class=" btn-success  btn btn-sm">  {!! url('blog/')!!}  </label>							
											 
										  {!! Form::text('alias', $row['alias'],array('class'=>'form-control input-sm', 'placeholder'=>'', 'style'=>'width:150px; display:inline-block;'   )) !!} 						
											
									  </div> 					
									  <div class="form-group  " >
										<label > Post Content    </label>							
										  <textarea name='note' rows='25' id='note' class='form-control editor'  
				           >{{ $row['note'] }}</textarea> 						
									  </div> 					
									   					
							</div>
							<div class="tab-pane m-t" id="meta">	

					<div class="form-group  " >
					<label for="meta_title" > Meta Title </label>
					
					  {!! Form::text('meta_title', $row['meta_title'],array('class'=>'form-control input-sm', 'placeholder'=>''  )) !!} 
					
				  </div>

				  <div class="form-group  " >
					<label for="heading" > Heading / H1 Tag</label>
					
					  {!! Form::text('heading', $row['heading'],array('class'=>'form-control input-sm', 'placeholder'=>''  )) !!} 
					
				  </div>
				  
									  <div class="form-group  " >
										<label > Metakey    </label>
										 <textarea name='metakey' rows='5' id='metakey' class='form-control '  
				           >{{ $row['metakey'] }}</textarea> 						
									  </div> 					
									  <div class="form-group  " >
										<label > Metadesc    </label>									
										  <textarea name='metadesc' rows='5' id='metadesc' class='form-control '  
				           >{{ $row['metadesc'] }}</textarea> 						
									  </div> 	
							</div>


					</div>	
			</div>
			
			<div class="col-md-3">
			
			<div class="form-group  wrap-image  " >
										<label for="ipt" class=" control-label "> Featured Image </label>
										
										
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
						
						
							  <div class="form-group  " >
								<label> Post Status :  </label>
								<div class="">					
								  <input  type='radio' name='status'  value="enable" required class="minimal-red" 
								  @if( $row['status'] =='enable')  	checked	  @endif				  
								   /> 
								  <label>Enable</label>
								</div> 
								<div class="">					
								  <input  type='radio' name='status'  value="disable" required class="minimal-red" 
								   @if( $row['status'] =='disable')  	checked	  @endif				  
								   /> 
								  <label>Disabled</label>
								</div> 					 
							  </div>									
									   					
									  <div class="form-group  " >
										<label for="ipt" class=" control-label "> Created    </label>								  
										<div class="input-group m-b" style="width:150px !important;">
											{!! Form::text('created', $row['created'],array('class'=>'form-control input-sm date', 'style'=>'width:150px !important;')) !!}
											<span class="input-group-addon"><i class="fa fa-calendar"></i></span>
										</div>				 						
									  </div> 					

									  <div class="form-group" >
									  <label for="ipt"> Who can view this page ? </label>
									  <?php $page_access = json_decode(($row['access']),true);  ?>
										@foreach($groups as $group) 
										<div class="">					
										  <input  type='checkbox' name='group_id[{{ $group['id'] }}]' value="{{ $group['id'] }}" <?php echo ( $page_access[$group['id']] ==1 || (count($page_access)==0)) ? 'checked' : '' ;?> class="minimal-red"/> 
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



				<div class="form-group  " >
					<label > Labels    </label>									
					  <textarea name='labels' rows='2' id='labels' class='form-control '>{{ $row['labels'] }}</textarea> 						
				</div>


					
				  <div class="form-group">
					
					<button type="submit" name="apply" class="btn btn-info btn-sm btn-flat" ><i class="icon-checkmark-circle2"></i> Apply</button>
					<button type="submit" name="submit" class="btn btn-primary btn-sm btn-flat" ><i class="icon-bubble-check"></i> {{ Lang::get('core.sb_save') }}</button>
					<button type="button" onclick="location.href='{{ URL::to('core/posts?return='.$return) }}' " class="btn btn-warning btn-sm btn-flat"><i class="icon-cancel-circle2 "></i>  {{ Lang::get('core.sb_cancel') }} </button>
					<a href="{{ url('blog/'.$row['alias'])}}" target="_blank" class="btn btn-danger btn-sm btn-flat"> <i class="fa  fa-eye"></i></li> View </a>
						
				</div>	

			
			</div>
			<div style="clear:both;"></div> 
			<input type="hidden" name="action_task" value="save" />
			<input type="hidden" name="views" value="{{ $row['views']+0 }}" />
		 {!! Form::close() !!}	
	</div>
</div>		 
</div>	
		 
   <script type="text/javascript">
	$(document).ready(function() { 
		
		 

		$('.removeMultiFiles').on('click',function(){
			var removeUrl = '{{ url("posts/removefiles?file=")}}'+$(this).attr('url');
			$(this).parent().remove();
			$.get(removeUrl,function(response){});
			$(this).parent('div').empty();	
			return false;
		});		
		
	});
	</script>	
			 
@stop
