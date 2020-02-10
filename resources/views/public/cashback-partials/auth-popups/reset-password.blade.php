@extends('public.layouts.app')
@section('content')
<div class="clearfix">
    <div class="merchant-banner-cont pt-3">
      <div class="container">
        <div class="row">
      		<div class="col-lg-12 col-md-12">
      			<div class="merchent-offers-title text-white pb-3 text-center">
      				<h1 class=" text-capitalize">{{__('public/common.Reset_Pwd')}}</h1>
      					<p></p>
      			</div>
      		</div>
    		</div>
      </div>
    </div>
    <div class="container">
      <div class="policy-detail rounded border my-5 bg-white p-3">
        <div class="row">
          <div class="col-md-2">

          </div>
          <div class="col-md-8">

              <div class="change-password-frm w-75 p-3 mt-3 mx-auto">
              @if($rlexpire)
              <div class="text-center">
                <h3>{{__('public/common.sorry_pwd_exp')}}</h3>
                <button class="btn btn-primary"  data-toggle="modal" data-dismiss="modal" data-target="#forgotmodal">{{__('public/common.Request_Pwd')}}</button>
              </div>
              @else
              <div class="reset-password-msg"> </div>
              <form action="{{route('reset.forgotpassword').'/'.$id}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
              <div class="form-group row">
              <label for="staticname" class="col-md-4 col-form-label text-lg-right text-md-right text-sm-left">{{__('public/common.New_Pwd')}}</label>
              <div class="col-md-8">
                <input type="Password" name="password" class="form-control" id="inputname" >
              </div>
              </div>
              <input type="hidden" name="mail_token" value="{{$getUser->mail_token}}">
              <div class="form-group row">
              <label for="staticname" class="col-md-4 col-form-label text-lg-right text-md-right text-sm-left">{{__('public/common.Confirm_Pwd')}}</label>
              <div class="col-md-8">
                <input type="Password" name="confirm_password" class="form-control" id="inputname" >
                <div class="text-center mt-4">
                  <button type="submit" class="btn btn-primary btn-block rounded p-2 font-weight-bold">{{__('public/common.Reset_Pwd')}}</button>
                </div>
              </div>
              </div>
            </form>
            @endif
          </div>
          </div>
          <div class="col-md-2">

          </div>
        </div>
      </div>
    </div>

@endsection
