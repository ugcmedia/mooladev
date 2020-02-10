<!-- cashback terms popup content  -->
<div class="modal fade" id="cb-terms-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered1 modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title font-20 fw-700 text-dark" id="exampleModalLongTitle">{{__('public/storepage.cashback_terms')}} </h5>
        <button type="button" class="modal-close close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="cb-terms-list">
          <div class="container">
            <div class="row">
              <div class="col-lg-6">
                <div class="what-to-do-list">
                  <h3 class="font-15 fw-700 text-dark mb-3">{{__('public/storepage.what_to_do')}}</h3>
                  <ul class="list-unstyled">
                    @foreach($termsTodo as $ytodo)
                      <li class="d-inline-flex mb-3">
                        <span><i class="fas fa-check success-text"></i></span>
                        <span class="font-15 secondary-text fw-400">
                          {{$ytodo}}
                        </span>
                      </li>
                    @endforeach
                  </ul>
                </div>
              </div>

              <div class="col-lg-6">
                <div class="what-to-do-not-list">
                  <h3 class="font-15 fw-700 text-dark mb-3"> {{__('public/storepage.what_not_to_do')}}</h3>
                  <ul class="list-unstyled">
                  @foreach($termsTonotdo as $ntodo)
                    <li class="d-inline-flex mb-3">
                      <span><i class="fas fa-check success-text"></i></span>
                      <span class="font-15 secondary-text fw-400">
                          {{$ntodo}}
                      </span>
                    </li>
                    @endforeach
                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
