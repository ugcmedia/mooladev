<?php
// $getBal  = AppClass::getAllBal();
 //$getTips = AppClass::getTips();
 if(isset($_GET['bonus'])) {
     $updateNotify = AppClass::updateNotification($_GET['bnoytify'],'tb_user_bonus_changes');
 }
 $tAvailBal = '';
 $tPenBal   = '';
 $tTotal    = '';
 $tTotalpai = '';

 // foreach ($getTips as $key => $value)
 //  {
 //       if($value->tip_key == 'dash_avl_bal') {
 //         $tAvailBal = $value->note;
 //       }
 //       if($value->tip_key == 'dash_pend_bal') {
 //         $tPenBal = $value->note;
 //       }
 //       if($value->tip_key == 'total_earned') {
 //         $tTotal = $value->note;
 //       }
 //       if($value->tip_key == 'total_paidout') {
 //         $tTotalpai = $value->note;
 //       }
 // }
 //
?>
@extends('public.layouts.app')
@section('content')
@section('title')
{{__('member/multi_lang.')}}
   {{-- !! $data['page_data']->meta_title!!--}}
@endsection
  @include('public/partner/partials/topNav')

<!-- Nerw DashBord Disigning Start  -->






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


              @if(Session::get('memberDetail')->email_verified  != 'Y')
            				<div class="alert alert-info alert-icon-block alert-dismissible" role="alert">
            						<div class="alert-icon">
            								<span class="icon-checkmark-circle"></span>
            						</div>
            						<strong> {{__('member/multi_lang.success')}} </strong> {{__('member/multi_lang.verify_Mail')}} <a href="{{route('resendMail')}}">
            							{{__('member/multi_lang.resend')}}.</a>
            						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span class="fa fa-times"></span></button>
            				      </div>
                @endif

     <div class="member-title pt-3 pt-lg-0 pt-md-0">
       <h1 class="text-capitalize text-center"> {{__('member/multi_lang.')}}  <span class="learnCashTxt"></h1>
         <!-- <span class="ml-2"><img src="http://moola101.ga/html/images/cash-icon.png" alt="Available" width="22px" class="align-baseline"> <a href="http://moola101.ga/how-it-works" target="_blank"> Learn How To Earn Cashback!</a></span> </span> -->
       <p class="text-capitalize text-center"> {{__('member/multi_lang.stay_up')}}</p>

     </div>

<div class="available-section">
     <div class="mb-41">

          <div class="row">

               <div class="col-lg-3 col-sm-6 mb-4">
                 <div class="bg-white shadow-sm rounded p-3 h-100">
                 <p class="cbConfirmed h3 font-20 fw-600 mb-3 text-dark"><img src="http://moola101.ga/html/images/cash-icon.png" width="28px" class="mr-3 float-left"><span> {{__('member/multi_lang.total_earn')}}</span></p>
                 <div class="d-flex align-items-center pl-5">
                 <span class="fw-700 font-22 d-flex align-items-center mr-2"><span class="bxColor mr-2"></span> $130.15</span>
                 <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="This is the total sale of moola101." class="cb-tr-tooltip float-none font-16">
                 <i class="fas fa-info-circle"></i>
                  </a>
                 </div>
                 </div>
              </div>

              <div class="col-lg-3 col-sm-6 mb-4">
                 <div class="bg-white shadow-sm rounded p-3 h-100">
                 <p class="cbConfirmed h3 font-20 fw-600 mb-3 text-dark"><img src="http://moola101.ga/html/images/cash-icon.png" width="28px" class="float-left mr-3">
                   <span> {{__('member/multi_lang.avaliable_cashback')}}
                     <!-- <small>Paid</small> -->
                 </span></p>
                 <div class="d-flex align-items-center pl-5">
                 <span class="fw-700 font-22 d-flex align-items-center mr-2"><span class="bxColor mr-2"></span>$159.12</span>
                 <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="This is the total amount paid out to you as cashback." class="cb-tr-tooltip float-none font-16">
                 <i class="fas fa-info-circle"></i>
                 </a>
                 </div>
                 </div>
              </div>

                 <div class="col-lg-3 col-sm-6 mb-4">
                 <div class="bg-white shadow-sm rounded p-3 h-100">
                    <p class="cbConfirmed h3 font-20 fw-600 mb-3 text-dark"><img src="http://moola101.ga/html/images/cash-icon.png" width="28px" class="float-left mr-3"><span> {{__('member/multi_lang.pendingcashback')}} </span></p>
                      <div class="d-flex align-items-center pl-5">
                 <span class="fw-700 font-22 d-flex align-items-center mr-2"><span class="bxColor mr-2"></span>$1,289.27</span>
                 <a href="#" data-toggle="tooltip" data-placement="right" title="" data-original-title="This is the total customers of moola101." class="cb-tr-tooltip float-none font-16">
                 <i class="fas fa-info-circle"></i>
                 </a>
                 </div>
                 </div>
                 </div>

                 <div class="col-lg-3 col-sm-6 mb-4">
                     <div class="bg-white shadow-sm rounded p-3 h-100">
                     <p class="cbConfirmed h3 font-20 fw-600 mb-3 text-dark"><img src="http://moola101.ga/html/images/cash-icon.png" width="28px" class="float-left mr-3"><span> {{__('member/multi_lang.paidout_cashback')}} </span></p>
                     <div class="d-flex align-items-center pl-5">
                     <span class="fw-700 font-22 d-flex align-items-center mr-2"><span class="bxColor mr-2"></span>$1,000.00</span>
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
                        <div class="col">  <p class="text-dark font-18 fw-700 text-left"> {{__('member/multi_lang.recent_transaction')}} </p></div>
                        <div class="col text-right"><a href="{{url('')}}/member/cashback-transaction" class="btn btn-primary"> {{__('member/multi_lang.more_transaction')}} </a></div>
                  </div>
                      <div class="table-responsive-lg">
                            <div class="table-responsive-lg border rounded">
                                  <table class="table">
                                        <thead class="thead-dark">

                                                            <tr>
                                                            <th scope="col"> {{__('member/multi_lang.transaction_date')}} </th>
                                                            <th scope="col"> {{__('member/multi_lang.store')}} </th>
                                                            <th scope="col"> {{__('member/multi_lang.order_ammount')}} </th>
                                                            <th scope="col"> {{__('member/multi_lang.cashback')}} </th>
                                                            <th scope="col"> {{__('member/multi_lang.status')}} </th>
                                                            </tr>
                                          </thead>

                                          <tbody>

                                                @foreach($data as $temp)
                                                            <tr>
                                                            <td>{{ $temp->order_date}}</td>
                                                            <td>{{$temp->vendor_name}}</td>
                                                            <td> {{$temp->transaction_amount}}</td>
                                                             <td>{{$temp->cashback_amount}}</td>
                                                           <td>{{ $temp->status}}</td>
                                                            </tr>
                                                  @endforeach
                                          </tbody>
                              </table>
                            </div>
                      </div>
          </div>

        </div>

        <div class="col-md-6 mb-4">
            <div class="bg-white shadow-sm rounded  p-3 h-100 text-center">
                  <div class="row mb-2 ">
                  <div class="col">  <p class="text-dark font-18 fw-700 text-left"> {{__('member/multi_lang.treading_offers')}} </p> </div>
                  <div class="col text-right"><a href="http://moola101.ga/member/claim-cashback" class="btn btn-primary "> {{__('member/multi_lang.more_cashback')}}</a></div>
              </div>



                      <div class="table-responsive-lg border rounded">
                                        <table class="table  ">
                                              <thead class="thead-dark">
                                                <tr>
                                                <th scope="col"> {{__('member/multi_lang.store')}}</th>
                                                <th scope="col"> {{__('member/multi_lang.location')}} </th>
                                                <th scope="col"> {{__('member/multi_lang.offer_title')}} </th>

                                                <th scope="col"> {{__('member/multi_lang.action')}} </th>
                                                </tr>
                                                </thead>
                                          <tbody>

                                                <tr>
                                                <td >Test Store</td>
                                                <td>Ahmedabad </td>
                                                <td>test</td>
                                          <td >
                                    <button type="button" class="btn btn-link btn-sm">
                                              <a href="http://moola101.ga/member/claim-cashback">Link</a>
                                    </button>

                                          </td>
                                                </tr>

                                                <tr>
                                                <td >Test Store</td>
                                                <td>Ahmedabad </td>
                                                <td>test</td>
                                              <td>
                                           <button type="button" class="btn btn-link btn-sm">
                                              <a href="http://moola101.ga/member/claim-cashback" >Link</a>
                                             </button>
                                          </td>
                                                </tr>
                                                <tr>
                                                <td >Test Store</td>
                                                <td>Ahmedabad </td>
                                                <td>test</td>
                                              <td >
                                           <button type="button" class="btn btn-link btn-sm">
                                            <a href="http://moola101.ga/member/claim-cashback">Link</a>
                                           </button>
                                          </td>
                                                </tr>
                                                <tr>
                                                <td >Test Store</td>
                                                <td>Ahmedabad </td>
                                                <td>test</td>
                                              <td >
                                          <button type="button" class="btn btn-link btn-sm">
                                            <a href="http://moola101.ga/member/claim-cashback">Link</a>
                                          </button>
                                          </td>
                                                </tr>
                                                <tr>
                                                <td >Test Store</td>
                                                <td>Ahmedabad </td>
                                                <td>test</td>
                                              <td >

                                          <a href="http://moola101.ga/member/claim-cashback" class="btn-link">
                                                <button type="button" class="btn btn-link btn-sm">Link</button>
                                          </a>

                                          </td>
                                                </tr>




                                                </tbody>
                                          </table>

                                  </div>

              </div>
            </div>
</div>
</div>
  </section>

 <!-- Nerw DashBord Disign End  -->











@endsection
