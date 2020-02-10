@extends('public.layouts.app')
@section('content')
@include('partner/partial/topNav')

<section class="main-content py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h1> {{__('partner/multi_lang.cashback_dispuite')}}</h1>
      </div>
      <div class="col-md-4 text-right">
        <a href="{{url('partner/offers/add')}}" class="btn btn-primary"> {{__('partner/multi_lang.addoffer')}}</a>
      </div>
    </div>
    <div class="bg-white rounded p-5 mt-3">

      <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">{{__('partner/multi_lang.username')}}</th>
          <th scope="col">{{__('partner/multi_lang.transaction Id')}}</th>
          <th scope="col">{{__('partner/multi_lang.status')}}</th>
          <th scope="col">{{__('partner/multi_lang.user_comment')}}</th>
          <th scope="col">{{__('partner/multi_lang.date')}}</th>
          <th scope="col">{{__('partner/multi_lang.action')}}</th>
        </tr>
      </thead>
      <tbody>

@foreach($data as $temp)
          <tr>
            <td>{{$temp->first_name }} {{$temp->last_name }}</td>
            <td>{{$temp->tick_transaction_id}}</td>
            <td>{{ $temp->tick_crDate }}</td>

            <td>{{$temp->tick_status}}</td>
            <td>{{$temp->user_comment}}</td>
            <td>

              <a  href="#" class="btn  btn-link "  data-toggle="tooltip" data-placement="left" title="Edit" >
                <spna class="fa fa-edit "data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"></span>
                </a>
                <a  href="#" class="btn  btn-link "  data-toggle="tooltip" data-placement="right" title="Delete" >
                  <spna class="fa fa-trash "data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo"></span>
                  </a>

              </td>

          </tr>
@endforeach
      </tbody>
    </table>

    </div>
  </div>
</section>
@endsection
