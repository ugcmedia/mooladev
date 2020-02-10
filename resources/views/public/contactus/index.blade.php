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
  $pageimage = $data['pageInfo']->image;
?>

<?php
// print_r($data);
// die();



 ?>


<section class=" bg-white  py-5 hit-hero-banner" style="  background-image: url('{{$pageimage}}');">
    <div class="container">



      <!-- <div class="page-navigation">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb p-0 mb-2">
            <li class="breadcrumb-item"><a href="{{url('/')}}">{{__('public/storepage.home')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$data['pageInfo']->title}}</li>
          </ol>
        </nav>
      </div> -->

      <div class="hero-banner-cont">
        <div class="row">
          <div class="col-md-12">
            <div class="st-title text-center">
               <h1 class="font-48"><span class="fw-700 text-white">{{$data['pageInfo']->title}}</span></h1>

               <div class="text-white">
                   <p class="text-white font-14 fw-400 ">{!!$data['pageInfo']->note!!} </p>
                 </div>
            </div>
          </div>
        </div>
      </div>





</section>

<section class="partner-section py-5 ">

<div class="container">
  <div class="row">

      <div class="col-lg-8">
          <div class="feel-free-cont bg-white p-3 rounded">
                  <div class="contact-us-msg p-4">
                      <label for="inputEmail3" class=" h6 pb-4"><strong>{{__('public/contactus.send_massage')}}</strong></label>
                        <form class="" >
<!-- <label for="inputEmail3" class="col-sm-2 col-form-label h5 form-control-title">Full Name</label> -->
                                      <div class="form-group row">
                                        <label for="inputEmail3" class="col-md-3 col-form-label ">{{__('public/contactus.full_name')}}</label>
                                        <div class="col-md-9">
                                          <input type="text" class="form-control form-control-lg" id="inputfullname1" name="fullname"  placeholder="{{__('public/contactus.plz_full_name')}} ">
                                        </div>
                                      </div>

                                        <div class="form-group row">
                                          <label for="inputPassword3" class="col-md-3 col-form-label ">{{__('public/contactus.email_address')}}</label>
                                          <div class="col-md-9">
                                            <input type="Email" class="form-control form-control-lg  " id="inputemail2" placeholder="{{__('public/contactus.plz_enter_mail')}}  ">
                                          </div>
                                        </div>

                                          <div class="form-group row">
                                            <label for="inputPassword3" class="col-md-3 col-form-label ">{{__('public/contactus.massage')}} </label>
                                            <div class="col-md-9">
                                                   <textarea class="form-control form-control-lg" id="exampleFormControlTextarea1" rows="3"placeholder=" {{__('public/contactus.type_msg')}} "></textarea>
                                            </div>
                                          </div>

                                            <div class="form-group row">
                                            <label for="inputPassword3" class="col-md-3 col-form-label"></label>
                                            <div class="col-md-9">
                                                       <button type="submit" class="btn btn-primary">&nbsp;&nbsp;&nbsp; {{__('public/contactus.send')}}  &nbsp;&nbsp;&nbsp;</button>
                                            </div>
                                          </div>
                            </form>
                    </div>
              </div>
          </div>






          <div class="col-lg-4 contectus_p_left">
                <label for="inputEmail3" class=" h6 "><strong>{{__('public/contactus.interested')}}</strong></label>
                            <p class="contectus_p"> {{__('public/contactus.if_you_like')}} </p>
              <label for="inputEmail3" class=" h6 "><strong>{{__('public/contactus.email_address')}}</strong></label>
                          <p class="text-warning contectus_p">{{__('public/contactus.moola_mail')}}</p>
              <label for="inputEmail3" class=" h6 "><strong>{{__('public/contactus.address')}}</strong></label>
                          <p class="contectus_p">
                            {{__('public/contactus.moola_address')}}
</p>
            <label for="inputEmail3" class=" h6"><strong>{{__('public/contactus.follws_us')}} </strong></label>
                              {!! AppClass::getSocialFollow() !!}






          </div>



    </div>
  </div>
</div>
</section>



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
