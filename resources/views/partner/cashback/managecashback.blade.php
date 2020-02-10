@extends('public.layouts.app')
@section('content')
@include('partner/partial/topNav')



<!-- Edit Toast  start-->

@if(session()->has('v_updated'))

    <div aria-live="polite" aria-atomic="true" style="position: relative; min-height: 200px;">
      <div class="toast bg-secondary rounded " style="position: absolute; top: 0; right: 0;">
              <div class="toast-header ">

                <span class="fa fa-save text-danger"></span>
                <strong class="mr-auto">Note:</strong>
                <small>1 mins ago</small>
                <button type="cancle" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="toast-body bg-light">
                {{ session()->get("v_updated") }}
                {{ session()->forget("v_updated") }}
              </div>
      </div>
    </div>
@endif

<!-- Edit Toast  End-->






<section class="main-content py-5">
  <div class="container">










    <div class="row">
      <div class="col-md-8">
        <h1>{{__('partner/multi_lang.manage_cashback')}}</h1>
      </div>
      <div class="col-md-4 text-right">
        <a href="{{url('partner/offers/add')}}" class="btn btn-primary">{{__('partner/multi_lang.addoffer')}}</a>
      </div>
    </div>
    <div class="bg-white rounded p-5 mt-3">

      <table class="table table-striped table-bordered">
      <thead>
        <tr>
        <th scope="col">{{__('partner/multi_lang.user')}}</th>
          <th scope="col">{{__('partner/multi_lang.order_id')}}</th>
          <th scope="col">{{__('partner/multi_lang.transaction_date')}}</th>
          <th scope="col">{{__('partner/multi_lang.transactions_amount')}}</th>
          <th scope="col">{{__('partner/multi_lang.cashaback_amount')}}</th>
          <th scope="col">{{__('partner/multi_lang.status')}}</th>
          <th scope="col">{{__('partner/multi_lang.action')}}</th>
        </tr>
      </thead>
      <tbody>

@foreach($data as $temp)

                  <tr>
                        <td >{{ $temp->first_name}}&nbsp;&nbsp;
                                  {{ $temp->last_name}}


                        </td>
                        <td >{{ $temp->order_id}}</td>
                        <td>{{$temp->order_date}}</td>
                        <td>{{$temp->transaction_amount}}</td>
                        <td>{{$temp->cashback_amount}}</td>
                          <td>


                              @if( $temp->status =="declined")
                                          <span class="text-danger"><b>    {{ $temp->status }} </b></span>
                              @elseif( $temp->status =="confirmed")
                                            <span class="text-success"><b>    {{ $temp->status }} </b></span>

                              @else
                                          <span>   {{$temp->status }}  </span>
                              @endif

                      </td>
                    <td>

                    <a  href="#" class="btn  btn-link "  data-toggle="tooltip" data-placement="right" title="Edit - {{ $temp->first_name}} " >
                      <spna class="fas fa-pencil-alt "data-toggle="modal" data-target="#exampleModal_{{ $temp->transaction_id}}" data-whatever="@mdo"></span>
                      </a>



<!--  Model  Start-->

                <div class="modal fade" id="exampleModal_{{ $temp->transaction_id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="exampleModalLabel">New message</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">



                              <form>
                                        <div class="form-group row ">
                                          <label for="staticEmail" class="col-sm-2 col-form-label "><strong>{{__('partner/multi_lang.first_name')}}</strong></label>
                                          <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $temp->first_name}}">
                                          </div>
                                        </div>

                                        <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-2 col-form-label "><strong>{{__('partner/multi_lang.last_name')}}</strong></label>
                                          <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $temp->last_name}}">
                                          </div>
                                        </div>


                                        <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-2 col-form-label "><strong>{{__('partner/multi_lang.order_date')}}</strong></label>
                                          <div class="col-sm-10">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$temp->order_date}}">
                                          </div>
                                        </div>


                                        <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-2 col-form-label "><strong>{{__('partner/multi_lang.transactions_amount')}}</strong></label>
                                          <div class="col-sm-10 p-3">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$temp->transaction_amount}}">
                                          </div>
                                        </div>



                                        <div class="form-group row">
                                          <label for="staticEmail" class="col-sm-2 col-form-label "><strong>{{__('partner/multi_lang.cashaback_amount')}}</strong></label>
                                          <div class="col-sm-10 ">
                                            <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{$temp->cashback_amount}}">
                                          </div>
                                        </div>






                              </form>







                              <form method="post" action="{{ route('edit_cashback') }}">
                                {{ csrf_field() }}

                                <input type="hidden" value="{{ $temp->user_id}}" name="user">
                                <input type="hidden" value="{{ $temp->transaction_id}}" name="transaction">


                                            <div class="form-group">
                                              <label for="recipient-name" class="col-form-label">{{__('partner/multi_lang.status')}}:</label>

                                                  <select class="form-control" id="exampleFormControlSelect1" name="status">
                                                        <option value="pending">{{__('partner/multi_lang.pending')}}</option>
                                                        <option value="confirmed">{{__('partner/multi_lang.confirmed')}}</option>
                                                        <option value="declined">{{__('partner/multi_lang.declined')}}</option>
                                                  </select>

                                            </div>



                                            <div class="form-group">
                                              <label for="message-text" class="col-form-label">{{__('partner/multi_lang.massage')}}:</label>
                                              <textarea class="form-control" id="message-text" name="v_comment"></textarea>
                                            </div>


                                        <div class="modal-footer">
                                          <button type="cancle" class="btn btn-secondary" data-dismiss="modal">{{__('partner/multi_lang.close')}}</button>
                                          <button type="Submit" class="btn btn-primary">{{__('partner/multi_lang.save')}}</button>
                                        </div>
                              </form>


                          </div>
                        </div>
                </div>


  <!--  Model  End-->






















                      </td>

                  </tr>
@endforeach


      </tbody>
    </table>

    </div>
  </div>
</section>
@endsection
