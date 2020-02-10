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