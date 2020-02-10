<?php

  function getCombo($table,$id,$name,$values) {

      $temp = [];
      $get  = DB::table($table)->select('*')->orderByRaw( "FIELD({$id},{$values} )" )->get();
      foreach ($get as $key => $value) {
          $temp[$value->$id] = ucfirst($value->$name);
      }
      return $temp;

  }

?>

@extends('layouts.app')
@section('content')
<section class="page-header row">
    <h1> {{ $pageTitle }} <small> {{ $pageNote }} </small></h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      <li  class="active"> {{ $pageTitle }} </li>
    </ol>
  </section>

  <style>
  .expl{    margin-top: 5px;
    display: block;
    font-weight: 700;
    color: #fb3c4a;
    font-size: 13px;}
	.no-margin {margin-right: 0 !important;
    margin-left: 0 !important ;}
  </style>
  
<div class="page-content row">
  <div class="page-content-wrapper" style="margin-top:20px">
    {!! Form::open(array('url'=>'updateSetting', 'class'=>'form-horizontal validated','files' => true ,'Method' => 'post')) !!}

    <div class="sbox">
      <div class="sbox-title clearfix">

        <div class="sbox-tools pull-left" >
          <button name="apply" class="tips btn btn-sm btn-apply  "  title="{{ __('core.btn_back') }}" ><i class="fa  fa-check"></i> {{ __('core.sb_apply') }} </button>
          <!-- <button name="save" class="tips btn btn-sm btn-save"  title="{{ __('core.btn_back') }}" ><i class="fa  fa-paste"></i> {{ __('core.sb_save') }} </button> -->
        </div>
      </div>

      <div class="sbox-content clearfix">
        <ul class="parsley-error-list">
      		@foreach($errors->all() as $error)
      			<li>{{ $error }}</li>
      		@endforeach
      	</ul>
        <div class="col-md-12">
      				<fieldset><legend>{{$pageTitle}} </legend>


                @foreach($fields as $field)
                  <div class="col-md-6" >
				  <div class="form-group no-margin">
				  <div class="col-md-12 ">
                    <input type="hidden" value="{{$field->setting_id}}"  name="ids[]">
                    <label id="{{$field->setting_key}}" class="control-label text-left">{{$field->setting_ui_name}}</label>
					<a class="adtip" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="<?php echo $field->note;?>"><i class="fa fa-info-circle"></i></a>
					</div>
                    <div class="col-md-12 ">
                      @if($field->setting_dev_class =='textarea')
                        <textarea  rows='3'  class='form-control input-sm ' name="setting_value[<?php echo $field->setting_key; ?>]"
                >{{$field->setting_value}}</textarea>
                      @elseif($field->setting_dev_class =='editor')
                        <textarea name='setting_value[<?php echo $field->setting_key; ?>]' rows='5' id='editor' class='form-control input-sm editor'
                          >{{ $field->setting_value }}</textarea>
                      @elseif($field->setting_dev_class == 'isInteger' || $field->setting_dev_class == 'isNumber')
                        <input  type='number' name='setting_value[<?php echo $field->setting_key; ?>]'  value='{{$field->setting_value}}' class='form-control input-sm ' />
						@elseif($field->setting_dev_class == 'date')
                        <input  type='date' name='setting_value[<?php echo $field->setting_key; ?>]'  value='{{$field->setting_value}}' class='form-control input-sm ' />
                      @elseif($field->setting_dev_class == 'jscolor')
                        <input  type='color' name='setting_value[<?php echo $field->setting_key; ?>]'  value='{{$field->setting_value}}' class='form-control input-sm colorpicker' />
                      @elseif($field->setting_dev_class == '')
                        <input  type='text' name='setting_value[<?php echo $field->setting_key; ?>]'  value='{{$field->setting_value}}' class='form-control input-sm ' />
                      @elseif(strtok($field->setting_dev_class,'|' ) =='select')
                        <?php
                            $selectBData = explode('|',$field->setting_dev_class);
                            $type = $selectBData[count($selectBData)-1];
                            $table       = $selectBData[1];
                            $pKey        = $selectBData[2];
                            $fieldname   = $selectBData[3];
                            $options     = getCombo($table,$pKey,$fieldname,$field->setting_value);
                            $selected    = explode(',',$field->setting_value);
                          ?>
                            @if($type == 'm')
                              <select name='setting_value[<?php echo $field->setting_key; ?>][]'  class='select2' multiple="multiple" >
                                @foreach($options as $key=>$value)
                                  <option value="{{$key}}" @foreach($selected as $selectedd) @if($key == $selectedd) selected @endif @endforeach>{{$value}}</option>
                                @endforeach
                              </select>
                            @else
                              <select name='setting_value[<?php echo $field->setting_key; ?>]'  class='select2' >
                                @foreach($options as $key=>$value)
                                  <option value="{{$key}}"  @if($key == $field->setting_value) selected @endif >{{$value}}</option>
                                @endforeach
                              </select>
                            @endif
                      @elseif($field->setting_dev_class == 'switch')
                          <!-- <label class="switch">
                            <input type="checkbox" name="setting_value[<?php echo $field->setting_key; ?>]" class="checkall minimal-green"  @if($field->setting_value == 'Y') checked @endif />
                          </label> -->
						  <input type="hidden" name="setting_value[<?php echo $field->setting_key; ?>]" value ='N' />
						  <div class='switch-wrap'> <label class='switch'> 
						  <input type='checkbox' name="setting_value[<?php echo $field->setting_key; ?>]" value ='Y' @if($field->setting_value == 'Y') checked @endif  />   <span class="slider round"></span></label>
						  </div> 
					
					@elseif(strtok($field->setting_dev_class,'|' ) =='jsonRadio')
                        <?php
                            $selectBData = explode('|',$field->setting_dev_class);
                            $options     = json_decode($selectBData[count($selectBData)-1]);
                            $selected    = explode(',',$field->setting_value);
                          ?>
                            
                              <select name='setting_value[<?php echo $field->setting_key; ?>]'  class='select2' >
                                @foreach($options as $key=>$value)
                                  <option value="{{$value}}"  @if($value == $field->setting_value) selected @endif >{{$key}}</option>
                                @endforeach
                              </select>
                        
                        @else
                         <input  type='{{$field->setting_dev_class}}' name='setting_value[<?php echo $field->setting_key; ?>]' class='form-control input-sm '  value='{{$field->setting_value }}'>
                       @endif
					   
					   
                    </div>
                  </div>
				  </div>
				  <br>
                @endforeach
            </div>
          </div>
      <div class="sbox-title clearfix">

  			<div class="sbox-tools pull-left" >
  				<button name="apply" class="tips btn btn-sm btn-apply  "  title="{{ __('core.btn_back') }}" ><i class="fa  fa-check"></i> {{ __('core.sb_apply') }} </button>
  				<!-- <button name="save" class="tips btn btn-sm btn-save"  title="{{ __('core.btn_back') }}" ><i class="fa  fa-paste"></i> {{ __('core.sb_save') }} </button> -->
  			</div>
  		</div>
    </div>
    	<input type="hidden" name="action_task" value="save" />
    	{!! Form::close() !!}
  </div>
</div>



@stop
