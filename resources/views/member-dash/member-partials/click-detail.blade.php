<div class="table-responsive-lg">
  <table class="table border">
  <thead class="thead-light">
    <tr>

        <th scope="col">{{__('member/multi_lang.date')}}</th>
        <th scope="col">{{__('member/multi_lang.mer')}}</th>
        <th scope="col">{{__('member/multi_lang.click_id')}}</th>
        <th scope="col">{{__('member/multi_lang.type')}}</th>
        <th scope="col">{{__('member/multi_lang.clk_time')}}</th>
    </tr>
</thead>
<tbody>
  {{--@if(Count($data['click_data'] ) > 0) --}}
  {{--@foreach($data['click_data']  as $click) --}}
    <tr data-toggle="collapse" data-target="#demo13" class="accordion-toggle">

        <td>{{-- date(config('sximo.cnf_date'),strtotime($click->click_time)) --}}</td>
        <td>{{--$click->store_name --}}</td>
        <td>{{--$click->click_id--}}</td>
        <td>{{-- ucfirst($click->object_type)--}}</td>
        <td colspan="5">{{-- $click->click_time--}}</td>
    </tr>
    {{-- @endforeach--}}
    {{-- @else--}}
    <tr data-toggle="collapse" data-target="#demo13" class="accordion-toggle">
        <td colspan="6">{{__('member/multi_lang.sorry_found')}}!</td>
      </tr>
{{--      @endif--}}

    <tr>
        <td colspan="6" class="hiddenRow"><div id="demo11" class="accordian-body collapse p-3">
          <div class="row">
            <div class="col-lg-3">
              <div class="status-track  ml-3">
                <div class="top-circle text-muted">
          <i class="fa fa-circle"></i>
          <span>{{__('member/multi_lang.pending')}}</span>
        </div>

        <div class="bottom-circle text-muted">
          <i class="fa fa-circle bottom"></i>
          <span>{{__('member/multi_lang.confirmed')}}</span>
        </div>
              </div>
            </div>
            <div class="col-lg-9">
              <div class="status-details">
                <p class="mb-0">{{__('member/multi_lang.cash_desc')}}</p>
              </div>
            </div>
          </div>
        </div></td>
    </tr>
</tbody>
</table>
</div>
{{--!!   $data['click_data']->render() !!--}}
