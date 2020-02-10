@extends('layouts.app')

@section('content')
<div class="page-content row">
	<div class="page-content-wrapper m-t">

		<div class="sbox">
			<div class="sbox-title">
				<h1> {{ $pageTitle }}  <small> {{ $pageNote }} </small> </h1>
			</div>
			<div class="sbox-content clearfix">

			@include('sximo.config.tab')
	 		{!! Form::open(array('url'=>'sximo/config/login/', 'class'=>'form-horizontal validated')) !!}

			<div class="col-sm-6">
				

		 		  <div class="form-group" style="display:none">
					<label for="ipt" class=" control-label col-sm-4">  {{ Lang::get('core.fr_emailsys') }}  </label>	
					<div class="col-sm-8 ">
							
							<div class="">
								<input type="radio" name="CNF_MAIL" value="phpmail"   @if($sximoconfig['cnf_mail'] =='phpmail') checked @endif class="minimal-red"  /> 
								<label>PHP MAIL System</label>
							</div>
							
							<div class="">
								<input type="radio" name="CNF_MAIL" value="swift"   @if($sximoconfig['cnf_mail'] =='swift') checked @endif class="minimal-red"  /> 
								<label>SWIFT Mail ( Required Configuration )</label>
							</div>			
					</div>
				</div>					
		  
				  <div class="form-group" style="display:none">
					<label for="ipt" class=" control-label col-sm-4"> {{ Lang::get('core.fr_registrationdefault') }}  </label>	
					<div class="col-sm-8">
							<div >
								
								<select class="form-control" name="CNF_GROUP">
									@foreach($groups as $group)
									<option value="{{ $group->group_id }}"
									 @if($sximoconfig['cnf_group'] == $group->group_id ) selected @endif
									>{{ $group->name }}</option>
									@endforeach
								</select>
								
							</div>				
					</div>	
							
				  </div> 
				  
				  <div class="form-group" style="display:none">
					<label for="ipt" class=" control-label col-sm-4">{{ Lang::get('core.fr_registration') }} </label>	
					<div class="col-sm-8 " >
						<div class=" radio-success">
							
							<div class="">
							<input type="radio" name="CNF_ACTIVATION" value="auto" @if($sximoconfig['cnf_activation'] =='auto') checked @endif  class="minimal-red"  /> 
							<label>{{ Lang::get('core.fr_registrationauto') }}</label>
							</div>
							
							<div class=" ">
								<input type="radio" name="CNF_ACTIVATION" value="manual" @if($sximoconfig['cnf_activation'] =='manual') checked @endif   class="minimal-red" /> 
								<label>{{ Lang::get('core.fr_registrationmanual') }}</label>
							</div>								
							<div class=" ">
								<input type="radio" name="CNF_ACTIVATION" value="confirmation" @if($sximoconfig['cnf_activation'] =='confirmation') checked @endif  class="minimal-red"  />
								<label>{{ Lang::get('core.fr_registrationemail') }}</label>
							</div>
						</div>						
									
					</div>	
							
				  </div> 
				  
		 		  <div class="form-group" style="display: none;">
					<label for="ipt" class=" control-label col-sm-4"> {{ Lang::get('core.fr_allowregistration') }} </label>	
					<div class="col-sm-8">
						<div class="">
							<input type="checkbox" name="CNF_REGIST" value="true"  @if($sximoconfig['cnf_regist'] =='true') checked @endif class="minimal-red"  /> 
							<label>{{ Lang::get('core.fr_enable') }}</label>
						</div>			
					</div>
				</div>	
				
		 		<div class="form-group" style="display: none;">
					<label for="ipt" class=" control-label col-sm-4"> {{ Lang::get('core.fr_allowfrontend') }} </label>	
					<div class="col-sm-8">
						<div class="">
							<input type="checkbox" name="CNF_FRONT" value="false" @if($sximoconfig['cnf_front'] =='true') checked @endif class="minimal-red"  /> 
							<label>{{ Lang::get('core.fr_enable') }}</label>
						</div>			
					</div>
				</div>		
			
		 		<div class="form-group">
					<label for="ipt" class=" control-label col-sm-4">Google reCaptcha </label>	
					<div class="col-sm-8">
						<div class="">
						
							<input type="checkbox" name="cnf_recaptcha" value="false" @if(config('sximo.cnf_recaptcha') =='true') checked @endif class="minimal-red"  />  {{ Lang::get('core.fr_enable') }}
							<br /><br />

							<label> Site key</label>
							<input type="text" name="cnf_recaptchapublickey" value="{{ config('sximo.cnf_recaptchapublickey') }}" class="input-sm form-control"  /> 
							<label> Secret key</label>
							<input type="text" name="cnf_recaptchaprivatekey" value="{{ config('sximo.cnf_recaptchaprivatekey') }}" class="input-sm form-control"  /> 
							
						</div>	
												
					</div>
				</div>		
				

		 		<div class="form-group" style="display: none;">
					<label for="ipt" class=" control-label col-sm-4"> Google Maps API Key </label>	
					<div class="col-sm-8">
						<div class="">
							<input type="text" name="CNF_MAPS" value="{{ config('sximo.cnf_maps') }}" class="input-sm form-control"  /> 
							<small><i>* This is required if you use google Maps form .</i></small>
						</div>	
												
					</div>
				</div>		
				

				
				
					<input name="cnf_maintenance" type="hidden" id="cnf_maintenance" value="false"/>
					<div class="form-group">
					<label for="ipt" class=" control-label col-md-4">Maintenance Mode? <br />  </label>
					<div class="col-md-8">
						<div class="">
							<input name="cnf_maintenance" type="checkbox" id="cnf_maintenance" value="true" class="minimal-red" 
							@if($sximoconfig['cnf_maintenance'] =='true') checked @endif
							  /> <label> {{ Lang::get('core.fr_enable') }} </label>
						</div>	
						<br>
						<p><small style="color:red"><i>
							Make sure that your IP address is entered under Allowed IP address field before switching maintenance mode, else, you would be locked out from accessing entire website
						</i></small></p>
						
					 </div> 
				  </div>
				  
			  	<div class="form-group">
					<label for="ipt" class=" control-label col-md-4">&nbsp;</label>
					<div class="col-md-8">
						<button class="btn btn-primary" type="submit"> {{ Lang::get('core.sb_savechanges') }}</button>
				 	</div>
			  	</div>	  
			
		 	</div>

			<div class="col-sm-6">	
				<div class="form-vertical">
				
				
					<div class="form-group">
						<label> Block / Lock Hours </label>	
						
						<p><small><i>
							How long should the IP lock be inplace  : <code> 3 days  </code>
						</i></small></p>
						<input class="form-control" name="CNF_RESTRICTTIME" value="{{ $sximoconfig['cnf_restricttime'] }}" />
					</div>
					
					
					<div class="form-group">
						<label> Offence Count </label>	
						
						<p><small><i>
							How long offences can be allowed  :  *Number Only<code> 4  </code>
						</i></small></p>
						<input class="form-control" name="CNF_RESTRICTCOUNT" value="{{ $sximoconfig['cnf_restrictcount'] }}" />
					</div>
					
					<div class="form-group">
						<label> {{ Lang::get('core.fr_restrictip') }} </label>	
						
						<p><small><i>
							
							{{ Lang::get('core.fr_restrictipsmall') }}  <br />
							{{ Lang::get('core.fr_restrictipexam') }} : <code> 192.116.134 , 194.111.606.21 </code>
						</i></small></p>
						<textarea rows="5" class="form-control" name="CNF_RESTRICIP">{{ $sximoconfig['cnf_restrictip'] }}</textarea>
					</div>
					
					<div class="form-group">
						<label> {{ Lang::get('core.fr_restrictrefer') }} </label>	
						
						<p><small><i>
							{{ Lang::get('core.fr_restrictreferexp') }} : <code> Hackerbot </code>
						</i></small></p>
						<textarea rows="5" class="form-control" name="CNF_RESTRICTREFER">{{ $sximoconfig['cnf_restrictrefer'] }}</textarea>
					</div>
					
					<div class="form-group">
						<label> {{ Lang::get('core.fr_allowip') }} </label>	
						<p><small><i>
							
							{{ Lang::get('core.fr_allowipsmall') }}  <br />
							{{ Lang::get('core.fr_allowipexam') }} : <code> 192.116.134 , 194.111.606.21 </code>
						</i></small></p>							
						<textarea rows="5" class="form-control" name="CNF_ALLOWIP">{{ $sximoconfig['cnf_allowip'] }}</textarea>
					</div>

					<p> {{ Lang::get('core.fr_ipnote') }} </p>
				</div>
			</div>
			{!! Form::close() !!}


			</div>
		</div>
	</div>
</div>


@stop




