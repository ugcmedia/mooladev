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
//dd($data);
$pageimage = asset('public_assets/images/page-header-bg.jpg');
if(!empty($data['pageInfo']->image))
  $pageimage = asset('uploads/images').'/'.$data['pageInfo']->image;
?>

<section class="contect-us" title="123465" style="background-image:url('{{$pageimage}}')">
  <div class="merchant-banner-cont">
      <div class="container">
         <div class="row">
          <div class="col-lg-12">
            <div class="db-breadcrumb">
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('public/storepage.home')}}</a></li>
                  <li class="breadcrumb-item active" aria-current="page">{{$data['pageInfo']->title}}</li>
                </ol>
              </nav>
            </div>
          </div>
        </div>

        <div class="row">
        <div class="col-lg-6 col-md-7">
          <div class="merchent-offers-title text-white">
            <h1 class="promo-text font-60 fw-900">{!! $data['pageInfo']->title!!}</h1>
            <p class="font-24 fw-400 success-text"> {!! $data['pageInfo']->note!!} </p>
          </div>
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
                <input type="text" name="name" class="form-control" placeholder="{{__('public/contactus.name_placeholder')}}" value="{{ old('name') }}" required>
                </div>

                <div class="place-hover">
                <input type="email" name="email" class="form-control" placeholder="{{__('public/contactus.email_placeholder')}}" value="{{ old('email') }}" required>
                </div>
                <?php $contactReason = config('settingConfig.contact_reasons');
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

			  <input name="reason" type="hidden" value="Contact Us"/>

            <div class="col-lg-6 col-md-6 border-left pt-sm-0 pt-md-4">
              <div class="msg-box py-3 py-md-0">
                <div class="msg-box-cont">
                  <p class="mb-0 fw-800 text-dark">{{__('public/contactus.write_message')}}</p>
                  <span class="msg-text">{{__('public/contactus.write_message_desc')}}</span>
                  <div class="place-hover-text">
                     <textarea  class="form-control" name="msg"  value="{{ old('msg') }}" id="exampleFormControlTextarea1" required>{{ old('msg') }}</textarea>
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
        @php
        /* $pickofday = array();
        $pickofday = AppClass::getStores(trim(config('settingConfig.store_pod')));
        if(sizeof($pickofday) > 0) {
          $pickofday = $pickofday[0];
        }

        $cashbackstr = "";
        if($pickofday->cashback_enabled == 'Y') {
          if(!empty($pickofday->cashback)) {
                $cashbackstr     = AppClass::getUptoText($pickofday->cashback, $pickofday->cashback_type);
          }
        } */

        @endphp

       <p class="text-dark font-18 fw-700">{{__('public/contactus.pick_of_day')}}</p>
        <div class="rounded shadow-sm p-3 pickoftheday mb-4">
          <div class="bg-white p-3 rounded shadow-sm">
            <a href="{{url('store/'.str_slug($pickofday->store_slug))}}">
              <div class="text-center pb-4">
                <div class="top-brand-logo">
                  <img src="{{asset('uploads/images/store').'/'.$pickofday->store_logo}}">
                </div>
                <p class="top-brand-name mb-3 h5 text-dark fw-700">
                  {{$pickofday->store_name}}
                </p>
                @if($pickofday->cashback_enabled == 'Y')
                  @if(!empty($cashbackstr))
                  <div class="s-cpn-cb font-16 primary-text fw-700">
                    <span class="font-16 fw-700 icon-percentage2-icon v-middle mr-2"></span>
                    {{__('public/common.coupon_cashback_str',['cashbackStr' => $cashbackstr,'appName' =>config('sximo.cnf_appname') ])}}
                  </div>
                  @endif
                 @endif
              </div>
            </a>
          </div>

        </div>
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



		  @if(trim(config('settingConfig.ads_pages_bottom'))!='')
<div class="gbands col-md-12 text-center pb-5" id="gband-pages">
{!! stripcslashes(config('settingConfig.ads_pages_bottom')) !!}
</div>
@endif

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
