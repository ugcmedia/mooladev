@extends('layouts.app')

@section('content')
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
      <div class="sbox-content clearfix">

   <!-- Start blast email -->

    {!! Form::open(array('url'=>'core/users/dosmsblast/', 'class'=>'form-horizontal ')) !!}
          <div class="form-group  " >
          <label for="ipt" class=" control-label col-md-3">  </label>
          <div class="col-md-12">
              <ul class="parsley-error-list">
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
              </ul>                
           </div> 
          </div> 
      
<div class="col-sm-12">
         
          
<div class="col-sm-6">
          <div class="form-group  " >
          <div for="ipt" class=" control-label col-md-3">  Status   </div>
          <div class="col-md-9"> 

                <div class="radio radio-success">
                    <input type="radio" name="user_type" value="all" required="true" class="minimal-green" > <label> To All Users</label>
                </div>
                <div class="radio radio-success">
                    <input type="radio"  name="user_type" value="email_no" required="true" class="minimal-green"> <label> To email not verified </label>
                </div>  
                <div class="radio radio-success">
                    <input type="radio"  name="user_type" value="email_yes" required="true" class="minimal-green"> <label> To email verified users</label>
                </div>
                <div class="radio radio-success">
                    <input type="radio"  name="user_type" value="both_yes" required="true" class="minimal-green"> <label> To email & mobile verified users</label>
                </div>
				<div class="radio radio-success">
                    <input type="radio"  name="user_type" value="custom_list" required="true" class="minimal-green"> <label> Custom List</label>
                </div>                                
           </div> 

          </div>  
</div>

          
<div class="col-sm-6">
          <div class="form-group  " >
		  <div for="ipt" class=" control-label col-md-3">  {{ Lang::get('core.fr_cuslist') }}   </div>
		  <textarea name="custom_list"></textarea>
		  </div>
</div>

		  
      
</div>
 
 <div class="col-sm-12">


 
          <div class="form-group "  >
         
          <div style=" padding:10px;">
       <label for="ipt" class=" control-label "> {{ Lang::get('core.fr_smsmessage') }} </label>
           <textarea class="form-control" rows="10"   name="message"></textarea> 
       </div>
           
         
          </div> 

            
                    

          
          <div class="form-group" >
          <label for="ipt" class=" control-label col-md-3"> </label>
          <div class="col-md-9">
              <button type="submit" name="submit" class="btn btn-primary">{{ Lang::get('core.sb_send') }} SMS </button>
           </div> 
          </div> 
  </div>                     
     {!! Form::close() !!}


    <!-- / blast email -->


      </div>
    </div>
  </div>
</div>

@stop