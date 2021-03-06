				<!-- Toolbar Top -->
			<div class="row">
				<div class="col-md-4"> 	
				@if($access['is_add'] ==1)
					<a href="{{ url('contactsubmits/create?return='.$return) }}" class="btn btn-default btn-sm"  
						title="{{ __('core.btn_create') }}"><i class=" fa fa-plus "></i> Create New </a>
					@endif

					<div class="btn-group">
						<button type="button" class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="icon-menu5"></i> Bulk Action </button>
				        <ul class="dropdown-menu">
				         @if($access['is_excel'] ==1)
							<li><a href="{{ url( $pageModule .'/export?do=excel&return='.$return) }}"><i class="fa fa-download"></i> Export CSV </a></li>	
						@endif
						@if($access['is_add'] ==1)
							<li><a href="{{ url($pageModule .'/import?return='.$return) }}" onclick="SximoModal(this.href, 'Import CSV'); return false;"><i class="fa fa-cloud-upload"></i> Import CSV</a></li>
							<li><a href="javascript://ajax" class=" copy " title="Copy" ><i class="fa fa-copy"></i> Copy selected</a></li>
						@endif	
							<li><a href="{{ url($pageModule) }}/data" onclick="reloadData('#{{ $pageModule}}','{{ url( $pageModule) }}'); return false" ><i class="fa fa-times"></i> Clear Search </a></li>
				          	<li role="separator" class="divider"></li>
				         @if($access['is_remove'] ==1)
							 <li><a href="javascript://ajax"  class="tips delete" title="{{ __('core.btn_remove') }}"><i class="fa fa-trash-o"></i>
							Remove Selected </a></li>
						@endif 
				          
				        </ul>
				    </div> 
				    <a href="javascript://ajax" class="btn btn-sm btn-primary" onclick="$('.filter').toggle()"> <i class="fa fa-filter"></i></a>		
				    

				</div>

				<div class="col-md-4"> 	
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

				<div class="col-md-4 text-right">
					<div class="input-group">
					      <div class="input-group-btn">
					        <button type="button" class="btn btn-default btn-sm " 
					        onclick="SximoModal('{{ url($pageModule."/search?type=ajax") }}','Advance Search'); " ><i class="fa fa-filter"></i> Filter </button>
					      </div><!-- /btn-group -->
					      <input type="text" class="form-control input-sm onsearch" data-target="{{ url($pageModule) }}" data-div="{{ $pageModule }}" aria-label="..." placeholder=" Type And Hit Enter  ">
					    </div>
				</div>    
			</div>					
			<!-- End Toolbar Top -->

