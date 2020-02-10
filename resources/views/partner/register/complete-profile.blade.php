@extends('public.layouts.app')
<script type="text/javascript" src="{{asset('public_assets/js/jquery-3.2.1.min.js')}}"></script>
<script type="text/javascript" src="{{asset('public_assets/js/jquery.steps.min.js')}}"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<link rel="stylesheet" href="{{asset('public_assets/css/jquerysteps.css')}}">

@section('content')
<section class="sp-login-page py-5">
<div class="container">
  <div class="title py-2">
   <h3>Complete Profile</h3>
  </div>
  <div class="contact-us-msg">  </div>

    <form id="contact" action="{{route('partner.completeProfile')}}" method="post" enctype="multipart/form-data" >

    <div id="profile-form">
        <fieldset>Partner Information</fieldset>
        <section>
          <div class="form-row">
             <div class="form-group col-md-6">
              <label for="Partner Name">Partner Name *</label>
              <input type="text" class="form-control required" name="vendor_name">
             </div>
             <div class="form-group col-md-6">
              <label for="Partner Contact Number">Partner Contact Number</label>
              <input type="number" class="form-control" name="vendor_contact_number">
             </div>
            </div>

            <div class="form-row">
             <div class="form-group col-md-6">
              <label for="Partner Support Email">Partner Support Email *</label>
              <input type="email" class="form-control required email" name="vendor_support_email" class="required">
             </div>

             <div class="form-group col-md-6">
              <label for="Partner Website">Partner Website</label>
              <input type="url" class="form-control" name="vendor_website">
             </div>
            </div>
            <!-- <div class="form-group">
             <label for="inputSlug">Partner Slug</label>
             <input type="text" class="form-control" name="vendor_slug">
            </div> -->
            <div class="form-row">
             <div class="form-group col-md-12">
              <label for="Partner Description">Partner Description</label>
              <textarea class="form-control" id="exampleFormControlTextarea1" name="vendor_desc" rows="3"></textarea>
             </div>
            </div>
            <div class="form-group">
             <label for="Partner Logo">Partner Logo *</label>
             <input type="file" class="form-control-file" name="logo" required id="exampleFormControlFile1">
            </div>
        </section>
        <fieldset>Outlet Information</fieldset>
        <section>
            <!-- <p>(*) Mandatory</p> -->

             <div class="form-row">
              <div class="form-group col-md-12">
               <label for="Outlet Name">Outlet Name *</label>
               <input type="text" class="form-control required" name="outlet_name">
              </div>
             </div>

             <div class="form-row">
              <div class="form-group col-md-12">
               <label for="inputDesc">Outlet Address</label>
               <textarea class="form-control" id="exampleFormControlTextarea1" name="outlet_address" rows="3"></textarea>
              </div>
             </div>

             <div class="form-row">
              <div class="form-group col-md-6">
               <label for="Outlet Latitude">Outlet Latitude *</label>
               <input type="text" class="form-control required" name="outlet_lat">
              </div>

              <div class="form-group col-md-6">
               <label for="Outlet Longtitude">Outlet Longtitude *</label>
               <input type="text" class="form-control required" name="outlet_long">
              </div>
             </div>

            <div class="form-row">
             <div class="form-group col-md-6">
              <label for="Outlet Primary Image">Outlet Primary Image *</label>
              <input type="file" class="form-control-file" name="primary_image" required id="exampleFormControlFile1">
             </div>
             <div class="form-group col-md-6">
               <label for="Outlet Attachment">Outlet Attachment</label>
               <input type="file" class="form-control-file" name="attachment"   id="exampleFormControlFile1">
              </div>

             </div>

             <div class="form-row">
              <div class="form-group col-md-12">
               <label for="Outlet Gallery">Outlet Gallery</label>
               <textarea class="form-control" id="exampleFormControlTextarea1" name="outlet_gallery" rows="3"></textarea>
              </div>
             </div>

        </section>
        <fieldset>Cashback Setting</fieldset>
        <section>

             <div class="form-row">
              <div class="form-group col-md-6">
               <label for="Cashback Status">Cashback Status </label>
               <label class="switch">
                 <input type="checkbox" name="cashback_enabled" value="Y">
                <span class="slider round"></span>
              </label>

              </div>
             </div>

             <div class="form-row">
              <div class="form-group col-md-6">
               <label for="Partner Cashback">Partner Cashback %</label>
               <input type="text" class="form-control" name="vendor_cashback">
              </div>
             </div>

             <div class="form-row">
              <div class="form-group col-md-6">
               <label for="Cashback Type">Cashback Type</label>
               <select class="form-control" id="exampleFormControlSelect1" name="cashback_type">
                             <option value="flat">FLat</option>
                             <option value="percent">Percent</option>
                       </select>
              </div>
             </div>

        </section>
        <fieldset>Other Informations</fieldset>
        <section>
            <div class="form-row">
                <div class="form-group col-md-12">
                 <label for="Partner Phone Number">Partner Phone Number</label>
                 <input type="text" class="form-control" name="vendor_phnumber">
                </div>
            </div>

             <div class="form-row">
              <div class="form-group col-md-12">
               <label for="Partner How To">Partner How To</label>
               <textarea class="form-control" id="exampleFormControlTextarea1" name="vendor_howto" rows="3"></textarea>
              </div>
             </div>


             <div class="form-row">
              <div class="form-group col-md-12">
               <label for="Partner Policy">Partner Policy</label>
               <textarea class="form-control" id="exampleFormControlTextarea1" name="vendor_policy" rows="3"></textarea>
              </div>
             </div>

             <div class="form-row">
              <div class="form-group col-md-12">
               <label for="Partner Stats">Partner Stats</label>
               <textarea class="form-control" id="exampleFormControlTextarea1" name="vendor_stats" rows="3"></textarea>
              </div>
             </div>

        </section>
    </div>
</form>
</div>
</section>
<script>
var form = $("#contact");
    form.validate({
        errorPlacement: function errorPlacement(error, element) { element.before(error); },
        rules: {

            confirm: {
                equalTo: "#password"
            }
        }
    });
    form.children("div").steps({
        headerTag: "fieldset",
        bodyTag: "section",
        transitionEffect: "slideLeft",
        onStepChanging: function (event, currentIndex, newIndex)
        {
            if(currentIndex == 0) {
              console.log('hello')
            }
            form.validate().settings.ignore = ":disabled,:hidden";
            return form.valid();
        },
        onFinishing: function (event, currentIndex)
        {
            form.validate().settings.ignore = ":disabled";
            return form.valid();
        },
        onFinished: function (event, currentIndex)
        {
          $("#contact").submit();
        }
    });


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
