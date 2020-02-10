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
			<div class="sbox-title">
				<h1> All Records <small> </small></h1>
				<div class="sbox-tools">
					@if(Session::get('gid') ==1)
						<a href="{{ URL::to('sximo/module/config/'.$pageModule) }}" class="tips btn btn-sm  " title=" {{ __('core.btn_config') }}" ><i class="fa  fa-ellipsis-v"></i></a>
					@endif 	
				</div>				
			</div>
			<div class="sbox-content">
			

			<!-- Table Grid -->
			<div class="table-responsive" style="padding-bottom: 70px;">
 			{!! Form::open(array('url'=>'notification?'.$return, 'class'=>'form-horizontal m-t' ,'id' =>'SximoTable' )) !!}
			
		    <table class="table table-striped table-hover " id="{{ $pageModule }}Table">
		        <thead>
					<tr>
						<th style="width: 3% !important;" class="number"> No </th>
						<th  style="width: 3% !important;"> <input type="checkbox" class="checkall minimal-green" /></th>
						<th  style="width: 10% !important;">{{ __('core.btn_action') }}</th>
						
						@foreach ($tableGrid as $t)
							@if($t['view'] =='1')				
								<?php $limited = isset($t['limited']) ? $t['limited'] :''; 
								if(SiteHelpers::filterColumn($limited ))
								{
									$addClass='class="tbl-sorting" ';
									if($insort ==$t['field'])
									{
										$dir_order = ($inorder =='desc' ? 'sort-desc' : 'sort-asc'); 
										$addClass='class="tbl-sorting '.$dir_order.'" ';
									}
									echo '<th align="'.$t['align'].'" '.$addClass.' width="'.$t['width'].'">'.\SiteHelpers::activeLang($t['label'],(isset($t['language'])? $t['language'] : array())).'</th>';				
								} 
								?>
							@endif
						@endforeach
						
					  </tr>
		        </thead>

		        <tbody>        			
					<?php $rowData = array_reverse($rowData); ?>
		            @foreach ($rowData as $row)
		                <tr id="form-{{ $row->id }}">
							<td > {{ ++$i }} </td>
							<td ><input type="checkbox" class="ids minimal-green" name="ids[]" value="{{ $row->id }}" id="del{{ $row->id }}" />  </td>
							<td>

							 	<div class="actions">
								  <ul class="actions-menu" style="    list-style-type: none;margin: 0;padding-left: 0;">
								 	@if($access['is_detail'] ==1)
									<li><a href="{{ url($row->url)}}" class="tips action-view btn btn-sm btn-primary btn-fs" title="{{ __('core.btn_view') }}">
<i class="fa  fa-eye"></i>								</a></li>
									@endif
									<li class="divider" role="separator"></li>
									@if($access['is_remove'] ==1)
										 <li><a href="javascript://ajax" onclick="SximoDeleteP('del{{ $row->id }}');" class="tips action-delete btn btn-sm btn-danger btn-fs" title="{{ __('core.btn_remove') }}">
										<i class="fa  fa-trash"></i> </a></li>
									@endif 
								  </ul>
								</div>

							</td>														
						 @foreach ($tableGrid as $field)
							 @if($field['view'] =='1')
							 	<?php $limited = isset($field['limited']) ? $field['limited'] :''; ?>
							 	@if(SiteHelpers::filterColumn($limited ))
							 	 <?php $addClass= ($insort ==$field['field'] ? 'class="tbl-sorting-active" ' : ''); ?>
								 <td align="{{ $field['align'] }}" width=" {{ $field['width'] }}"  {!! $addClass !!} >					 
								 	{!! SiteHelpers::formatRows($row->{$field['field']},$field ,$row ) !!}						 
								 </td>
								@endif	
							 @endif					 
						 @endforeach			 
		                </tr>
						
		            @endforeach
		              
		        </tbody>
		      
		    </table>
			<input type="hidden" name="action_task" value="" />
			
			{!! Form::close() !!}
			@include('footer')
			</div>

			<!-- End Table Grid -->


			</div>
		</div>
	</div>
</div>


<script>
$(document).ready(function(){
	$('.copy').click(function() {
		var total = $('input[class="ids"]:checkbox:checked').length;
		if(confirm('are u sure Copy selected rows ?'))
		{
			$('input[name="action_task"]').val('copy');
			$('#SximoTable').submit();// do the rest here	
		}
	})	
	
});	
</script>	
	
@stop
