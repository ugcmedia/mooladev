@extends('layouts.app')

@section('content')
{{--*/ usort($tableGrid, "SiteHelpers::_sort") /*--}}
<section class="page-header row">
	<h2> {{ $pageTitle }} <small> {{ $pageNote }} </small></h2>
	<ol class="breadcrumb">
		<li><a href="{{ url('') }}"> Dashboard </a></li>
		<li class="active"> {{ $pageTitle }} </li>		
	</ol>
</section>
<div class="page-content row">
	<div class="page-content-wrapper no-margin"> 	

		<div class="sbox">
			<div class="sbox-title"><h1> All Records <small> </small></h1></div>
			
	<div class="sbox-content "> 

	<div class="row">
		<div class="col-md-6">
			<div class="btn-group">
				<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-menu5"></i> Bulk Action </button>
		        <ul class="dropdown-menu">
		         @if($access['is_excel'] ==1)
					<li><a href="{{ url( $pageModule .'/export?do=excel&return='.$return) }}"><i class="fa fa-download"></i> Export CSV </a></li>	
				@endif
		        </ul>
		    </div>
			<a href="javascript://ajax" class="btn btn-sm btn-primary" onclick="$('.filter').toggle()"> <i class="fa fa-filter"></i></a>
		</div>

		<div class="col-md-3"> 	
					<div class="input-group filter table-actions" style="display: none;" id="<?php echo $pageModule;?>Filter">					      
					  
					<input type="hidden" name="page" value="{{ $param['page']}}" />
					<input type="hidden" name="search" value="<?php if(isset($_GET['search'])) echo $_GET['search'] ;?>" />


					<select name="rows" class="select-alt" style="width:70px; float:left;"  >
					@foreach(array(10,20,30,50); as $p) 
					<option value="{{ $p }}" 
					@if(isset($pager['rows']) && $pager['rows'] == $p) 
					selected="selected"
					@endif	
					>{{ $p }}</option>
					@endforeach
					</select>
					<select name="sort" class="select-alt" style="width:100px;float:left;" >
					<option value=""><?php echo Lang::get('core.grid_sort');?></option>	 
					@foreach($tableGrid as $field)
					@if($field['view'] =='1' && $field['sortable'] =='1') 
					<option value="{{ $field['field'] }}" 
					@if(isset($pager['sort']) && $pager['sort'] == $field['field']) 
					selected="selected"
					@endif
					>{{ $field['label'] }}</option>
					@endif	  
					@endforeach

					</select>	
					<select name="order" class="select-alt" style="width:70px;float:left;">
					<option value="">{{ Lang::get('core.grid_order') }}</option>
					@foreach(array('asc','desc');  as $o)
					<option value="{{ $o }}"
					@if(isset($pager['order']) && $pager['order'] == $o)
					selected="selected"
					@endif	
					>{{ ucwords($o) }}</option>
					@endforeach
					</select>	
					<button type="button" class="btn  btn-primary btn-sm" onclick="ajaxFilter('#<?php echo $pageModule;?>','{{ $pageUrl }}/data')" style="float:left;"><i class="fa fa-refresh"></i> GO</button>	
	 
					</div>	
				</div>	

				<div class="col-md-3 text-right">
					<div class="input-group">
					      <div class="input-group-btn">
					        <button type="button" class="btn btn-default btn-sm " 
					        onclick="SximoModal('{{ url($pageModule."/search?type=ajax") }}','Advance Search'); " ><i class="fa fa-filter"></i> Filter </button>
					      </div><!-- /btn-group -->
					      <input type="text" class="form-control input-sm onsearch" data-target="{{ url($pageModule) }}" data-div="{{ $pageModule }}" aria-label="..." placeholder=" Type And Hit Enter  ">
					    </div>
				</div> 
				
	</div>


	 {!! Form::open(array('url'=>'{class}/delete/', 'class'=>'form-horizontal' ,'id' =>'SximoTable' )) !!}
	 <div class="table-responsive" style="min-height:300px;">
	 <div id="{{ $pageModule }}Grid">
    <table class="table table-hover table-bordered  ">
        <thead>
			<tr>
				<th class="number"> No </th>			
				@foreach ($tableGrid as $t)
					@if($t['view'] =='1')
						<th>{{ $t['label'] }}</th>
					@endif
				@endforeach
			  </tr>
        </thead>

        <tbody>
						
            @foreach ($rowData as $row)
                <tr>
					<td width="30"> {{ ++$i }} </td>	
				@foreach ($tableGrid as $field)
					 @if($field['view'] =='1')
					 	<?php $limited = isset($field['limited']) ? $field['limited'] :''; ?>
					 	@if(SiteHelpers::filterColumn($limited ))
						 <td>					 
						 	{!! SiteHelpers::formatRows($row->{$field['field']},$field ,$row ) !!}						 
						 </td>
						@endif	
					 @endif					 
				 @endforeach				 
				
                </tr>
				
            @endforeach
              
        </tbody>
      
    </table>
	</div>
	<input type="hidden" name="md" value="" />
	</div>
	{!! Form::close() !!}
	@include('footer')
	</div>
</div>	
	</div>	  

@stop