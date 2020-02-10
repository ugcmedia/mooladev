<?php
 // $getBal  = AppClass::getAllBal();
 // $getTips = AppClass::getTips();
 // if(isset($_GET['bonus'])) {
 //     $updateNotify = AppClass::updateNotification($_GET['bnoytify'],'tb_user_bonus_changes');
 // }
 // $tAvailBal = '';
 // $tPenBal   = '';
 // $tTotal    = '';
 // $tTotalpai = '';
 //
 // foreach ($getTips as $key => $value) {
 //   if($value->tip_key == 'dash_avl_bal') {
 //     $tAvailBal = $value->note;
 //   }
 //   if($value->tip_key == 'dash_pend_bal') {
 //     $tPenBal = $value->note;
 //   }
 //   if($value->tip_key == 'total_earned') {
 //     $tTotal = $value->note;
 //   }
 //   if($value->tip_key == 'total_paidout') {
 //     $tTotalpai = $value->note;
 //   }
 // }
?>

@extends('public.layouts.app')
@section('title')
@endsection
@section('content')
  @include('partner/partial/topNav')
  <section class="main-content py-5">
     <div class="container">
              <!-- <div class="page-navigation">
                <nav aria-label="breadcrumb">
                  <ol class="breadcrumb p-0 mb-2">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Overview</li>
                  </ol>
                </nav>
              </div>  -->

     <div class="member-title pt-3 pt-lg-0 pt-md-0">
       <h1 class="text-capitalize text-center">{{__('partner/multi_lang.cashback_overview')}} <span class="learnCashTxt">
         <!-- <span class="ml-2"><img src="http://moola101.ga/html/images/cash-icon.png" alt="Available" width="22px" class="align-baseline"> <a href="http://moola101.ga/how-it-works" target="_blank"> Learn How To Earn Cashback!</a></span> </span></h1> -->
       <p class="text-capitalize text-center">{{__('partner/multi_lang.cashback_stay_up')}}</p>
     </div>

<div class="available-section">
     <div class="mb-41">

          <div class="row">

                 <div class="col-lg-3 col-sm-6 mb-4">

                 <div class="bg-white shadow-sm rounded p-3 h-100">
                 <p class="cbConfirmed h3 font-20 fw-600 mb-3 text-dark"><img src="{{url('/html/images/cash-icon.png ')}}" width="28px" class="mr-3 float-left"><span>
{{__('partner/multi_lang.total_sale')}}</span></p>
                 <div class="d-flex align-items-center pl-5">
                 <span class="fw-700 font-22 d-flex align-items-center mr-2"><span class="bxColor mr-2"></span>₹ {{$total_sale}}</span>
                 <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="This is the total sale of moola101." class="cb-tr-tooltip float-none font-16">
                 <i class="fas fa-info-circle"></i>
                  </a>
                 </div>
                 </div>
                 </div>

                 <div class="col-lg-3 col-sm-6 mb-4">
                 <div class="bg-white shadow-sm rounded p-3 h-100">
                 <p class="cbConfirmed h3 font-20 fw-600 mb-3 text-dark"><img src="{{url('/html/images/cash-icon.png')}} " width="28px" class="float-left mr-3"><span>
                {{__('partner/multi_lang.total_cashback')}}
                   <small>{{__('partner/multi_lang.paid')}}</small></span></p>
                 <div class="d-flex align-items-center pl-5">
                 <span class="fw-700 font-22 d-flex align-items-center mr-2"><span class="bxColor mr-2"></span>₹ {{ $total_cashback}}</span>
                 <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="This is the total amount paid out to you as cashback." class="cb-tr-tooltip float-none font-16">
                 <i class="fas fa-info-circle"></i>
                 </a>
                 </div>
                 </div>
                 </div>

                 <div class="col-lg-3 col-sm-6 mb-4">
                 <div class="bg-white shadow-sm rounded p-3 h-100">
                    <p class="cbConfirmed h3 font-20 fw-600 mb-3 text-dark"><img src="http://moola101.ga/html/images/cash-icon.png" width="28px" class="float-left mr-3"><span>Total Customers</span></p>
                      <div class="d-flex align-items-center pl-5">
                 <span class="fw-700 font-22 d-flex align-items-center mr-2"><span class="bxColor mr-2"></span>{{ $total_customer }}</span>
                 <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="This is the total customers of moola101." class="cb-tr-tooltip float-none font-16">
                 <i class="fas fa-info-circle"></i>
                 </a>
                 </div>
                 </div>
                 </div>

                 <div class="col-lg-3 col-sm-6 mb-4">
                     <div class="bg-white shadow-sm rounded p-3 h-100">
                     <p class="cbConfirmed h3 font-20 fw-600 mb-3 text-dark"><img src="http://moola101.ga/html/images/cash-icon.png" width="28px" class="float-left mr-3"><span>
{{__('partner/multi_lang.total_offers')}}</span></p>
                     <div class="d-flex align-items-center pl-5">
                     <span class="fw-700 font-22 d-flex align-items-center mr-2"><span class="bxColor mr-2"></span>{{  $total_offer }}</span>
                     <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="This is the total offers of moola101." class="cb-tr-tooltip float-none font-16">
                     <i class="fas fa-info-circle"></i>
                     </a>
                     </div>
                     </div>
                  </div>

              </div>
     </div>
     </div>


<div class="row">
        <div class="col-md-6 mb-4">

            <div class="bg-white shadow-sm rounded  p-3 h-100 text-center">
              <div class="row mb-2 ">
                  <div class="col">  <p class="text-dark font-18 fw-700 text-left">Top Performing Offers</p></div>
                  <div class="col text-right"><a href={{ url('/partner/offers') }} class="btn btn-primary">{{__('partner/multi_lang.more_offers')}}</a></div>
              </div>

                <!-- <div class=" text-right">
                  <a href="http://moola101.ga/partner/offers/add" class="btn btn-primary">Add Offers</a>
                  </div> -->
                      <div class="table-responsive-lg">
        <div class="table-responsive-lg border rounded">
                              <table class="table">
                      <thead class="thead-dark">

                                <tr>
                                <th scope="col">{{__('partner/multi_lang.srno')}}</th>
                                <th scope="col">{{__('partner/multi_lang.offer_title')}}</th>
                                <th scope="col">{{__('partner/multi_lang.clicks')}}</th>
                                <th scope="col">{{__('partner/multi_lang.action')}}</th>
                                </tr>
                                </thead>

                                <tbody>
                                    @foreach($my_offer as $temp)
                                              <tr>
                                                      <td>{{ $temp->offer_id }}</td>
                                                      <td>{{ $temp->offer_title}}</td>
                                                      <td>{{ $temp->clicks }}</td>
                                                      <td><a href="http://moola101.ga/partner/offers"><i class="fas fa-newspaper"></i></a></td>
                                              </tr>
                                      @endforeach







                                </tbody>
                              </table>
          </div>
</div>
                    </div>

        </div>

    <div class="col-md-6 mb-4">

            <div class="bg-white shadow-sm rounded p-3  h-100 text-center">
              <div class="row mb-2">
                  <div class="col">  <p class="text-dark font-18 fw-700 text-left">Recent Cashback Claim's</p> </div>
                  <div class="col text-right"><a href="http://moola101.ga/partner/manage-cashback" class="btn btn-primary">{{__('partner/multi_lang.more_cashback')}}</a></div>
              </div>



                      <div class="table-responsive-lg border rounded">
                                        <table class="table  ">
                                              <thead class="thead-dark">
                                                <tr>
                                                <th scope="col">{{__('partner/multi_lang.user')}}</th>
                                                <th scope="col">{{__('partner/multi_lang.transaction_date')}}</th>
                                                <th scope="col">{{__('partner/multi_lang.transactions_amount')}}</th>
                                                <th scope="col">{{__('partner/multi_lang.cashaback_amount')}}</th>
                                                <th scope="col">{{__('partner/multi_lang.action')}}</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                  @foreach($data as $temp)
                                                    <tr>
                                                              <td >{{ $temp->first_name}}</td>
                                                              <td>{{$temp->order_date}}</td>
                                                              <td>{{$temp->transaction_amount}}</td>
                                                              <td>{{$temp->cashback_amount}}</td>

                                                            <td><a href="http://moola101.ga/partner/manage-cashback"><i class="fas fa-newspaper"></i></a></td>
                                                      </tr>
                                                    @endforeach
                                                <!-- <tr>
                                                <td>user2</td>
                                                <td>Test Offre </td>
                                                <td>test</td>
                                                <td>Test</td>
                                                <td><a href="http://moola101.ga/partner/manage-cashback"><i class="fas fa-newspaper"></i></a></td>
                                                </tr>
                                                <tr>
                                                <td >user3</td>
                                                <td>Test Offre </td>
                                                <td>test</td>
                                                <td>Test</td>
                                              <td><a href="http://moola101.ga/partner/manage-cashback"><i class="fas fa-newspaper"></i></a></td>
                                                </tr>
                                                <tr>
                                                <td >user4</td>
                                                <td>Test Offre </td>
                                                <td>test</td>
                                                <td>Test</td>
                                              <td><a href="http://moola101.ga/partner/manage-cashback"><i class="fas fa-newspaper"></i></a></td>
                                                </tr>
                                                <tr>
                                                <td >user5</td>
                                                <td>Test Offre </td>
                                                <td>test</td>
                                                <td>Test</td>
                                          <td><a href="http://moola101.ga/partner/manage-cashback"><i class="fas fa-newspaper"></i></a></td>
                                                </tr> -->




                                                </tbody>
                                          </table>

                                  </div>

              </div>
</div>
</div>


</div>
  </section>
@endsection
