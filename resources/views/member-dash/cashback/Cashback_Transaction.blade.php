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






  <div class="col">
          <div class="row mb-3 ">
                  <div class="col text-right"><a href="http://moola101.ga/member/claim-cashback" class="btn btn-primary">{{__('member/multi_lang.claim_cashback') }}</a></div>
          </div>


</div>


<div class="col">

            <div class="bg-white shadow-sm rounded p-3  h-100 text-center">



                      <div class="table-responsive-lg border rounded">
                        <table class="table">
                        <thead class="thead-dark">
                    <tr>
                    <th scope="col"> {{__('member/multi_lang.date')}}</th>
                    <th scope="col"> {{__('member/multi_lang.store')}}</th>
                    <th scope="col"> {{__('member/multi_lang.location')}}</th>
                    <!-- <th scope="col">Offer</th> -->
                    <th scope="col"> {{__('member/multi_lang.order_amt')}}</th>
                    <th scope="col"> {{__('member/multi_lang.cashback_amt')}}</th>
                    <th scope="col"> {{__('member/multi_lang.status')}}</th>
                    <th scope="col"> {{__('member/multi_lang.action')}}</th>
                    </tr>
                    </thead>
                      <tbody>

                          @foreach($data as $temp)
                                          <tr class="accordion-toggle">
                                                <td>{{$temp ->order_date}}</td>
                                                <td>{{ $temp->vendor_name}}</td>
                                                <td>{{$temp->outlet_address}}</td>
                                                <!-- <td>tets Offre</td> -->
                                                <td>{{$temp->transaction_amount}}</td>
                                                <td>{{$temp->cashback_amount}}</td>
                                                <td>Active</td>
                                                  <td>
                                                    <button type="button" class="btn btn-link "><a href="http://moola101.ga/member/claim-cashback">Link</a></button></a>

                                                  </td>
                                          </tr>
                        @endforeach

                      </tbody>
                                          </table>

                                  </div>

              </div>
</div>














</div>
</section>

@endsection
