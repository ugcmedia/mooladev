@extends('public.layouts.app')
<?php /* @section('title')
  {!! $data['pageInfo']->title!!}
@endsection */ ?>
<!-- <link rel="stylesheet" href="jquerysteps.css"> -->
<script type="text/javascript" src="{{asset('public_assets/js/jquery-3.2.1.min.js')}}"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.js"></script>
<script type="text/javascript" src="{{asset('public_assets/js/jquery.steps.min.js')}}"></script>
<!-- <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.3.min.js"></script> -->
<script type="text/javascript">
  $("#wizard").steps();
</script>


@section('content')

<section class="sp-login-page py-5">
 <div class="container">
  <div class="title py-2">
   <h3>Complete Profile</h3>
  </div>
  <div class="row justify-content-center">
   <div class="col-md-12">
    <div class="vendor-model  bg-white rounded shadow-sm">
     <div class="vendor-header pb-4">
      <!--tabs  -->
      <div class="row">
       <div class="col-md-12 ">
        <ul class="nav nav-pills nav-fill">
         <li class="nav-item">
          <a class="nav-item nav-link active" id="nav-vendor-tab" data-toggle="tab" href="#nav-vendor" role="tab" aria-controls="nav-vendor" aria-selected="true">Partner Information
                      </a>
         </li>
         <li class="nav-item">
          <a class="nav-item nav-link" id="nav-outlet -tab" data-toggle="tab" href="#nav-outlet" role="tab" aria-controls="nav-outlet" aria-selected="false">Outlet Information</a>
         </li>
         <li class="nav-item">
          <a class="nav-item nav-link" id="nav-cashback-tab" data-toggle="tab" href="#nav-cashback" role="tab" aria-controls="nav-cashback" aria-selected="false">Cashback Setting
                       </a>
         </li>
         <li class="nav-item">
          <a class="nav-item nav-link" id="nav-other-tab" data-toggle="tab" href="#nav-other" role="tab" aria-controls="nav-other" aria-selected="false">Other Informations</a>
         </li>
        </ul>

        <div class="tab-content p-4" id="nav-tabContent">
         <!--.Partner tab  -->
         <div class="tab-pane fade show active" id="nav-vendor" role="tabpanel" aria-labelledby="nav-vendor-tab">
          <!--Form-1  -->
          <form>
           <div class="form-row">
            <div class="form-group col-md-6">
             <label for="Vname">Partner Name</label>
             <input type="text" class="form-control" name="vendor_name">
            </div>
            <div class="form-group col-md-6">
             <label for="inputContact">Partner Contact Number</label>
             <input type="text" class="form-control" name="vendor_contact_number">
            </div>
           </div>

           <div class="form-row">
            <div class="form-group col-md-6">
             <label for="inputEmail4">Partner Support Email</label>
             <input type="email" class="form-control" name="vendor_support_email">
            </div>

            <div class="form-group col-md-6">
             <label for="inputWebsite">Partner Website
                     </label>
             <input type="text" class="form-control" name="vendor_website">
            </div>
           </div>
           <!-- <div class="form-group">
            <label for="inputSlug">Partner Slug</label>
            <input type="text" class="form-control" name="vendor_slug">
           </div> -->
           <div class="form-row">
            <div class="form-group col-md-12">
             <label for="inputDesc">Partner Desc
                    </label>
             <textarea class="form-control" id="exampleFormControlTextarea1" name="vendor_desc" rows="3"></textarea>
            </div>
           </div>
           <div class="form-group">
            <label for="inputlogo">Partner Logo</label>
            <input type="file" class="form-control-file" name="vendor_logo" id="exampleFormControlFile1">
           </div>

           <button type="submit" class="btn btn-primary mt-3">Update Partner Information</button>
          </form>

          <!--.Form-1  -->
         </div>
         <!--.Partner tab  -->


         <!--Outlet tab  -->
         <div class="tab-pane fade" id="nav-outlet" role="tabpanel" aria-labelledby="nav-outlet-tab">

          <form>
           <div class="form-row">
            <div class="form-group col-md-12">
             <label for="Vname">Outlet Name</label>
             <input type="text" class="form-control" name="outlet_name">
            </div>
           </div>

           <div class="form-row">
            <div class="form-group col-md-12">
             <label for="inputDesc">Outlet Address
                   </label>
             <textarea class="form-control" id="exampleFormControlTextarea1" name="outlet_address" rows="3"></textarea>
            </div>
           </div>

           <div class="form-row">
            <div class="form-group col-md-6">
             <label for="inputLati">Outlet Latitude</label>
             <input type="text" class="form-control" name="outlet_lat">
            </div>

            <div class="form-group col-md-6">
             <label for="inputLong">Outlet Longtitude</label>
             <input type="text" class="form-control" name="outlet_long">
            </div>
           </div>

          <div class="form-row">
           <div class="form-group col-md-6">
            <label for="inputImage">Outlet Primary Image</label>
            <input type="file" class="form-control-file" name="outlet_primary_image" id="exampleFormControlFile1">
           </div>


            <div class="form-group col-md-6">
             <label for="inputDesc">Outlet Attachment
                  </label>
             <input type="file" class="form-control-file" name="outlet_attachment" id="exampleFormControlFile1">

            </div>
           </div>

           <div class="form-row">
            <div class="form-group col-md-12">
             <label for="inputDesc">Outlet Gallery
                  </label>
             <textarea class="form-control" id="exampleFormControlTextarea1" name="outlet_gallery" rows="3"></textarea>
            </div>
           </div>



           <button type="submit" class="btn btn-primary mt-3">Update Outlet Information</button>
          </form>

         </div>
         <!--.outlet tab  -->




         <!--Cashback tab  -->
         <div class="tab-pane fade" id="nav-cashback" role="tabpanel" aria-labelledby="nav-cashback-tab">

          <form>
           <div class="form-row">
            <div class="form-group col-md-6">
             <label for="Vname">Cashback Status</label>
             <label class="switch">
              <input type="checkbox" name="cashback_enabled" value="Y">
              <span class="slider round"></span>
            </label>
             <!-- <input type="text" class="form-control" name="cashback_status"> -->
            </div>
           </div>

           <div class="form-row">
            <div class="form-group col-md-6">
             <label for="inputDesc">Partner Cashback %</label>
             <input type="text" class="form-control" name="vendor_cashback">
            </div>
           </div>

           <div class="form-row">
            <div class="form-group col-md-6">
             <label for="inputLati">Cashback Type</label>
             <select class="form-control" id="exampleFormControlSelect1" name="cashback_type">
                           <option value="flat">FLat</option>
                           <option value="percent">Percent</option>
                     </select>
            </div>
           </div>
           <button type="submit" class="btn btn-primary mt-3">Update Cashback Setting</button>
          </form>
         </div>
         <!--.Cashback tab  -->


         <!--Tab Other  -->
         <div class="tab-pane fade" id="nav-other" role="tabpanel" aria-labelledby="nav-other-tab">
          <form>
           <div class="form-row">
            <div class="form-group col-md-12">
             <label for="Vname">Partner Phone Number</label>
             <input type="text" class="form-control" name="vendor_phnumber">
            </div>
           </div>

           <div class="form-row">
            <div class="form-group col-md-12">
             <label for="inputDesc">Partner How To</label>
             <textarea class="form-control" id="exampleFormControlTextarea1" name="vendor_howto" rows="3"></textarea>
            </div>
           </div>


           <div class="form-row">
            <div class="form-group col-md-12">
             <label for="inputDesc">Partner Policy</label>
             <textarea class="form-control" id="exampleFormControlTextarea1" name="vendor_policy" rows="3"></textarea>
            </div>
           </div>

           <div class="form-row">
            <div class="form-group col-md-12">
             <label for="inputDesc">Partner Stats</label>
             <textarea class="form-control" id="exampleFormControlTextarea1" name="vendor_stats" rows="3"></textarea>
            </div>
           </div>
           <button type="submit" class="btn btn-primary mt-3">Update Other Informations</button>
          </form>
         </div>
         <!--.Other Tab  -->

        </div>

       </div>
      </div>

     </div>
    </div>
    <!--.tabs  -->
   </div>
  </div>
 </div>
 </div>
 </div>
</section>


@endsection
