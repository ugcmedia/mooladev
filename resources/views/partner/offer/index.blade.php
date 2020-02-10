@extends('public.layouts.app')
@section('content')
@include('partner/partial/topNav')
<section class="main-content py-5">
  <div class="container">
    <div class="row">
      <div class="col-md-8">
        <h1>{{__('partner/multi_lang.manage_offers')}}</h1>
      </div>
      <div class="col-md-4 text-right">
        <a href="{{url('partner/offers/add')}}" class="btn btn-primary">{{__('partner/multi_lang.addoffer')}}</a>
      </div>
    </div>
    <div class="bg-white rounded p-5 mt-3">
      @if(count($data['offers']) > 0)
      <table class="table table-striped table-bordered">
      <thead>
        <tr>
          <th scope="col">{{__('partner/multi_lang.code')}}</th>
          <th scope="col">{{__('partner/multi_lang.title')}}</th>
          <th scope="col">{{__('partner/multi_lang.expiry')}}</th>
          <th scope="col">{{__('partner/multi_lang.status')}}</th>
          <th scope="col">{{__('partner/multi_lang.clicks')}}</th>
          <th scope="col">{{__('partner/multi_lang.action')}}</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($data['offers'] as $offer): ?>
          <?php // print_r($offer); ?>
          <tr>
            <td>{{$offer->offer_code}}</td>
            <td>{{$offer->offer_title}}</td>
            <td>{{$offer->offer_expiry}}</td>
            <td>{{$offer->offer_status}}</td>
            <td>{{$offer->clicks}}</td>
            <td>
            <a href="{{url('partner/offers/edit').'/'.$offer->offer_id}}">Edit</a>
            <a href="{{url('partner/offers/delete').'/'.$offer->offer_id}}">Delete
            </a>

              </td>

          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    @else
      No offer found
    @endif

    {{ $data['offers']->links() }}



    </div>
  </div>
</section>
@endsection
