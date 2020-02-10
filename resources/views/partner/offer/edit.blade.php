@extends('public.layouts.app')
@section('content')
@include('partner/partial/topNav')
<section class="main-content py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <h1>Edit  Offer</h1>
      </div>
    </div>

    <div class="bg-white rounded p-5 mt-3 add-offer-sec">
      <div class="contact-us-msg">  </div>
      <form action="{{route('partner.offerUpdate').'/'.$data->offer_id}}" id="addOffer" method="post" enctype="multipart/form-data">
        <input type="hidden" name="old_file_name" value="{{$data->offer_image}}">
        <div class="form-row">
          <div class="form-group col-md-12">
            <label for="inputOfferTitle">Offer Title *</label>
            <input type="text" class="form-control required" id="offer_title" value="{{$data->offer_title}}" name="offer_title">
          </div>
        </div>

        <div class="form-row">
          <div class="form-group col-md-4">
            <label for="inputMRP">MRP *</label>
            <input type="text" class="form-control required" id="mrp" value="{{$data->offer_mrp}}"  name="offer_mrp">
          </div>
          <div class="form-group col-md-4">
            <label for="inputDealPrice">Deal Price *</label>
            <input type="text" class="form-control required" name="offer_deal_price"
             value="{{$data->offer_deal_price}}"
            id="deal_price" class="form-control">
          </div>
          <div class="form-group col-md-4">
            <label for="inputExpiryDate">Expiry Date *</label>
            <input type="date" class="form-control required" id="offer_expiry"
            name="offer_expiry">
          </div>
        </div>

        <div class="form-group">
          <label for="inputOfferDescription">Offer Description</label>
          <textarea class="form-control" id="offer_description" name="offer_desc"

          rows="3"> {{$data->offer_desc}}
</textarea>
        </div>

        <div class="form-group">
          <label for="inputOfferInstruction">Offer Instruction</label>
          <textarea class="form-control" id="offer_instruction" name="offer_instruction"

          rows="3">
          {{$data->offer_instructions}}
        </textarea>
        </div>

        <div class="form-row">
          <div class="form-group col-md-6">

            @if($data->offer_image != null)
              <image src="{{asset('uploads/vendor_offer_images').'/'.$data->offer_image}}" height="100" >
            @endif

            <label for="exampleOfferImage">Offer Image</label>
            <input type="file" class="form-control-file" id="image" name="image">
          </div>
          <div class="form-check col-md-6">

            <label for="Cashback Type">  Offer Status</label>
            <select class="form-control" id="exampleFormControlSelect1" name="offer_status">
                          <option value="pending"  @if($data->offer_status == 'pending') selected @endif >Pending</option>
                          <option value="live"  @if($data->offer_status == 'live') selected @endif >Live</option>
                          <option value="pause"  @if($data->offer_status == 'pause') selected @endif>Pause</option>
                          <option value="trash"  @if($data->offer_status == 'trash') selected @endif>Trash</option>
              </select>
          </div>

        </div>

        <button type="submit" class="btn btn-primary">Save</button>
      </form>
    </div>
  </div>

  <script>
  var form = $("#addOffer");
      form.validate({
          errorPlacement: function errorPlacement(error, element) { element.before(error); }
      });

  </script>

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
