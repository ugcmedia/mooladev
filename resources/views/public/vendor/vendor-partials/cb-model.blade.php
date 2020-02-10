<div class="modal fade" id="cb-details-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-20 fw-700 text-dark" id="exampleModalLongTitle">{{__('public/storepage.cashback_model_detail')}}</h5>
        <button type="button" class="modal-close close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          @if($data['store']->cashback_type == 'reward')
            <div class="alert alert-success" role="alert">
              {{config('settingConfig.reward-info')}}
            </div>
          @endif
        <div class="cb-details-list text-left">
          <ul class="list-unstyled">
            @if(count( $data['cashbackStru'])  > 0)
             @foreach( $data['cashbackStru'] as $cashStru)
              <li class="d-flex mb-3 flex-wrap">
                <div class="md-cb-value d-flex align-items-center font-20 primary-text fw-700 ">
                  <span class="icon-percentage2-icon mr-2"></span>
                    @if($cashStru->cb_type == 'percent' )
                      {{ round(($cashStru->cb_rate*$data['store']->user_split)/100,2) }}%
                    @else
                      {{config('sximo.cnf_currencyname')}}{{round(($cashStru->cb_rate*$data['store']->user_split)/100)}}{{config('sximo.cnf_currencysuffix')}}
                    @endif
                    {{ ucfirst($data['store']->cashback_type) }}
                </div>
                <div class="md-cb-disc">
                    {{trim($cashStru->cb_desc)}}
                </div>
              </li>
              @endforeach
              @else
              <li class="d-flex mb-3 flex-wrap">
                <div class="md-cb-disc">
                  {{__('public/storepage.data_not_found_cb_model')}}
                </div>
              </li>
              @endif
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>
