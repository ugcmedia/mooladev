@extends('public.layouts.app')
@section('title')
  {!! $data['pageInfo']->title !!}
@endsection
@section('meta')
  <meta name="description"  content="{!! $data['pageInfo']->metadesc!!}" >
  <meta name="keywords" content="{!! $data['pageInfo']->metakey!!}">
  @php $img = AppClass::getMetaImg($data['pageInfo'],'pages') @endphp
  <meta property="og:image" content="{{$img}}" />
  <meta property="og:title" content="{!! $data['pageInfo']->meta_title !!}" />
  <meta property="og:url" content="{{URL::current()}}" />
  <meta property="og:description" content="{!! $data['pageInfo']->metadesc!!}" />
  <meta property="og:site_name" content="{{config('sximo.cnf_appname')}}" />
@endsection
@section('content')
<?php
$pageimage = asset('public_assets/images/page-header-bg.jpg');
if(!empty($data['pageInfo']->image))
  $pageimage = asset('uploads/images').'/'.$data['pageInfo']->image;
?>

<section class="contect-us" style="background-image:url('{{$pageimage}}')">
  <div class="merchant-banner-cont pt-3">
      <div class="container">
        <div class="row">
          <!-- <div class="col-lg-12">
            <div class="db-breadcrumb">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('public/storepage.home')}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{$data['pageInfo']->title}}</li>
                </ol>
              </nav>
            </div>
          </div>
        </div> -->

        <div class="col-lg-6 col-md-7">
          <div class="merchent-offers-title text-white">
            <h1 class="promo-text font-60 fw-900">{!! $data['pageInfo']->title!!}</h1>
            <p class="font-24 fw-400 success-text"> {!! $data['pageInfo']->note!!} </p>
          </div>
        </div>
      </div>
  </div>
</section>
<div class="container">
  <div class="contect-uss-wrapper py-5">
    <div class="row">
      <div class="col-lg-9">
        <div class="contact-us-msg">  </div>

      <form action="{{url('contact-us')}}" method="post">
        {{ csrf_field() }}

        <div class="contect-form-wrap mb-4 rounded">
          <div class="contect-form-cont p-3">
        <div class="container">
          <div class="row">
            <div class="col-lg-6 col-md-6">
              <div class="contect-form pt-4">
                <span class="mb-4 fw-800 text-dark">{{__('public/contactus.write_to_us')}}</span>

                <div class="place-hover">
                <input type="text" name="name" class="form-control" placeholder="Your Name" value="{{ old('name') }}" required>
                </div>

                <div class="place-hover">
                <input type="email" name="email" class="form-control" placeholder="Your Email" value="{{ old('email') }}" required>
                </div>
                <?php $contactReason = config('settingConfig.business_reasons');
                      $contactReason = explode(',',$contactReason);
                      ?>
                <div class="place-hover">
                <select class="form-control" name="sub_reason">
                  @foreach($contactReason as $contact)
                    <option value="{{$contact}}">{{$contact}}</option>
                  @endforeach
                </select>
                </div>

              </div>


              </div>

			 <input name="reason" type="hidden" value="Business Listing"/>

            <div class="col-lg-6 col-md-6 border-left  pt-sm-0 pt-md-4">
              <div class="msg-box py-4 py-md-0">
                <div class="msg-box-cont">
                  <p class="mb-0 fw-800 text-dark">{{__('public/contactus.write_message')}}</p>
                  <span class="msg-text">{{__('public/contactus.write_message_desc')}}</span>

                <div class="place-hover-text">
                   <textarea class="form-control" name="msg"  value="{{ old('msg') }}" id="exampleFormControlTextarea1" required>{{ old('msg') }}</textarea>
                </div>


                </div>
              </div>
            </div>
           </div>


           	<!-- new row -->
           	<div class="row">
           		<div class="col-md-6">
                <p class="fieldset">
                  <div class="row">
                      <div class="col">
                        <div class="form-group has-feedback  animated fadeInLeft delayp1">
                          <label class="text-left"> Are u human ? </label>
                          <div class="g-recaptcha" data-sitekey="{{ config('sximo.cnf_recaptchapublickey') }}"></div>
                          <div class="clr"></div>
                        </div>
                      </div>
                  </div>
                </p>

           			<!-- <div class="form-group{{ $errors->has('captcha') ? ' has-error' : '' }}">
                                <label for="password" class="control-label">Captcha</label>
                                <div class="captcha">
                                <span>{!! captcha_img() !!}</span>
                                <button type="button" class="btn btn-success btn-refresh"><i class="fa fa-refresh"></i></button>
                                </div>
                                <input id="captcha" type="text" class="form-control" placeholder="Enter Captcha" name="captcha" style="margin-top:10px;">
                                @if ($errors->has('captcha'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('captcha') }}</strong>
                                    </span>
                                @endif
                    </div> -->
           		</div>

           		<div class="col-md-6">
           			<div class="cont-us" style="float: left;">
		                  <button type="submit" class="btn btn-primary pull-right mt-3" >{{__('public/contactus.submit_btn')}}</a>
		            </div>
           		</div>
           	</div>

        </div>
      </div>
      </div>
       </form>
      </div>

      <div class="col-lg-3">
        <div class="feel-free-cont bg-white p-3 rounded">
        <span>{{__('public/contactus.connect_with_us')}}</span>

        {!! AppClass::getSocialFollow() !!}

        <div class="other-help">
          <span>{{__('public/contactus.any_assistance')}}</span>

          <a href="faq">{{__('public/contactus.Check_Faq')}} <i class="fa fa-angle-right" aria-hidden="true"></i></a>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>



<script type="text/javascript">
//captcha refersh
<?php
 if (count($errors) > 0) {
   foreach ($errors->all() as $error) {
?>
    ToasterTargetedMessages(300,"<?php echo $error; ?>",".contact-us-msg")
<?php }
}?>
<?php
 if (Session::get('error')) {
?>
ToasterTargetedMessages(300,"<?php echo Session::get('error'); ?>",".contact-us-msg")
<?php } ?>
<?php
 if (Session::get('success')) {
?>
ToasterTargetedMessages(200,"<?php echo Session::get('success'); ?>",".contact-us-msg")
<?php } ?>
</script>

@endsection
