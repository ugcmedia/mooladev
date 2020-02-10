@extends('public.layouts.app')
@section('content')
@section('title')

@endsection
@include('public/partner/partials/topNav')

<section class="main-content py-5">
   <div class="container">


    <div class="member-title pt-3 pt-lg-0 pt-md-0">
     <h1 class="text-capitalize text-center">{{__('member/multi_lang.')}}<span class="learnCashTxt">
        <!-- <span class="ml-2"><img src="http://moola101.ga/html/images/cash-icon.png" alt="Available" width="22px" class="align-baseline"> <a href="http://moola101.ga/how-it-works" target="_blank"> Learn How To Earn Cashback!</a></span> </span> -->
      </h1>
     <p class="text-capitalize text-center">{{__('member/multi_lang.stay_up') }}</p>
   </div>



           <div class="row mb-3 ">
                   <div class="col text-right"><a href="#" class="btn btn-primary">{{__('member/multi_lang.claim_cashback') }}</a></div>
           </div>




<!-- <div id="cashback-data">
  <div class="col">
          <div class="row mb-3 ">
                  <div class="col text-right"><a href="#" class="btn btn-primary">Claim Cashback</a></div>
          </div>
<div class="table-responsive-lg rounded border">
<table class="table mb-0 md-table">
              <thead class="thead-dark">
                <tr>
                <th scope="col">DATE</th>
                <th scope="col">Store</th>
                <th scope="col">Location</th>
                <th scope="col">Offer</th>
                <th scope="col">Order Amount</th>
                <th scope="col">Cashback Amount</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
                </tr>
                </thead>
                  <tbody>
                  <tr class="accordion-toggle">
                  <td>27/09/18</td>
                  <td>Paytm</td>
                  <td>Ahmedabad</td>
                  <td>tets Offre</td>
                  <td>110</td>
                  <td>₹0.84</td>
                  <td>Active</td>
                    <td><a href="#"><i class="fas fa-newspaper"></i></a></td>
                  </tr>

                  <tr class="accordion-toggle">
                  <td>27/09/18</td>
                  <td>Paytm</td>
                  <td>Ahmedabad</td>
                  <td>tets Offre</td>
                  <td>110</td>
                  <td>₹0.84</td>
                  <td>Active</td>
                    <td><a href="#"><i class="fas fa-newspaper"></i></a></td>
                  </tr>

                  <tr class="accordion-toggle">
                  <td>27/09/18</td>
                  <td>Paytm</td>
                  <td>Ahmedabad</td>
                  <td>tets Offre</td>
                  <td>110</td>
                  <td>₹0.84</td>
                  <td>Active</td>
                    <td><a href="#"><i class="fas fa-newspaper"></i></a></td>
                  </tr>

                  <tr class="accordion-toggle">
                  <td>27/09/18</td>
                  <td>Paytm</td>
                  <td>Ahmedabad</td>
                  <td>tets Offre</td>
                  <td>110</td>
                  <td>₹0.84</td>
                  <td>Active</td>
                    <td><a href="#"><i class="fas fa-newspaper"></i></a></td>
                  </tr>

                  <tr class="accordion-toggle">
                  <td>27/09/18</td>
                  <td>Paytm</td>
                  <td>Ahmedabad</td>
                  <td>tets Offre</td>
                  <td>110</td>
                  <td>₹0.84</td>
                  <td>Active</td>
                    <td><a href="#"><i class="fas fa-newspaper"></i></a></td>
                  </tr>

                  <tr class="accordion-toggle">
                  <td>27/09/18</td>
                  <td>Paytm</td>
                  <td>Ahmedabad</td>
                  <td>tets Offre</td>
                  <td>110</td>
                  <td>₹0.84</td>
                  <td>Active</td>
                    <td><a href="#"><i class="fas fa-newspaper"></i></a></td>
                  </tr>








                  </tbody>
          </table>
      </div>
</div> -->




@if( session()->has('all_redy'))
      <div class="alert alert-primary alert-dismissible fade show" role="alert">
                      {!! session()->get('all_redy')  !!}
                      {{ session()->forget('all_redy') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
      </div>
@endif


@if( session()->has('miss_chashback_tra'))
      <div class="alert alert-primary alert-dismissible fade show" role="alert">
                      {!! session()->get('miss_chashback_tra')  !!}
                      {{ session()->forget('miss_chashback_tra') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
      </div>
@endif

@if( session()->has('invalid_image'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {!! session()->get('invalid_image')  !!}

          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
    </div>
@endif













<div class="contect-us-wrapper bg-white shadow-sm rounded p-5">

<div class="row">
<div class="col-md-8">
<h5 class="font-weight-bold">{{__('member/multi_lang.please') }}.</h5>
<div class="contect-us-frm mt-4">
<div class="contact-us-msg"> </div>

<form action="{{ route('upload_receipt') }}"method="post" name="claim_cashback" enctype="multipart/form-data">
  {{ csrf_field() }}

  <div class="form-group row">
                  <label for="inputEmail" class="col-sm-4 col-form-label"> {{__('member/multi_lang.transaction_id')}}</label>
                <div class="col-sm-8">
                  <select class="form-control" id="transaction_id" name="transaction_id"  value="{{ old('transaction_id') }}" required>
                    @foreach($data as $temp)

                        <option value={{ $temp->transaction_id }} > {{ $temp->transaction_id }}</option>


                    @endforeach

                  </select>
                </div>
          </div>


          <!-- <div class="form-group row">
                      <label for="inputEmail" class="col-sm-4 col-form-label">Date</label>
                    <div class="col-sm-8">
                          <input type="text" name="date" class="form-control">
                    </div>
              </div>-->







              <div class="form-group row">
                      <label for="inputimage" class="col-sm-4 col-form-label"> {{__('member/multi_lang.image')}} </label>
                    <div class="col-sm-8">
                          <input type="file" id="chk_image" name="chk_image" class="form-control  {{ session()->has('invalid_image')  ? 'is-invalid' :' ' }} "  required>


                          @if( session()->has('invalid_image'))
                          {{ session()->forget('invalid_image') }}
                          @endif




                    </div>
              </div>

              <div class="form-group row">
                        <label for="inputEmail" class="col-sm-4 col-form-label"> {{__('member/multi_lang.status')}}</label>
                      <div class="col-sm-8">


                        <select class="form-control" id="status" name="status" value="{{ old('status') }}"  required>
                          <option value= "{{__('member/multi_lang.open')}}"> {{__('member/multi_lang.open')}} </option>
                          <option value="{{__('member/multi_lang.close')}}"> {{__('member/multi_lang.close')}} </option>
                          <option value=" {{__('member/multi_lang.re_open')}}"> {{__('member/multi_lang.re_open')}} </option>

                          </select>

                      </div>
              </div>

              <div class="form-group row">
                      <label for="inputEmail" class="col-sm-4 col-form-label"> {{__('member/multi_lang.comment')}} </label>
                    <div class="col-sm-8">
                       <textarea class="form-control" id="comment" name="comment" rows="3">{{ old('comment') }}</textarea>

                    </div>
              </div>




              <!-- <div class="form-group row">
                    <label for="inputEmail" class="col-sm-4 col-form-label">Offre</label>
                    <div class="col-sm-8">
                    <input type="radio" name=offer value="order_no"> Order No
                    <input type="radio" name=offer value="receipt_no"> Receipt No
                    </div>
              </div> -->




              <!-- <div class="form-group row">
                        <label for="inputEmail" class="col-sm-4 col-form-label">Cashback Amount</label>
                      <div class="col-sm-8">
                      <input type="text" name="cashback_ammount" class="form-control">
                      </div>
              </div> -->

              <!-- <div class="form-group row">
                      <label for="inputEmail" class="col-sm-4 col-form-label">Upload Receipt</label>
                    <div class="col-sm-8">
                    <input type="text" name="Upload_Receipt" class="form-control">
                    </div>
              </div> -->





              <div class="form-group row">
                  <div class="text-center mt-4">

                   <button type="submit" class="btn btn-primary btn-block rounded p-2 font-weight-bold"> {{__('member/multi_lang.upload_receipt')}}</button>
                  </div>
              </div>
              </div>
              </form>
</div>
</div>
</div>
</div>

















</div>
</section>

@endsection
