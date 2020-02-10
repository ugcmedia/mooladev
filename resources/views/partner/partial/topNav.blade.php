<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <div class="navbar-nav">

      <!-- <a href="{{url('member/overview')}}" class="list-group-item d-inline-block collapsed buttonn " data-parent="#sidebar"><i class="fa fa-list-alt pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.overview')}}</span></a>
      <a href="{{url('member/my-deals')}}" class="list-group-item d-inline-block collapsed buttonn " data-parent="#sidebar"><i class="fa fa-tags pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('public/common.menu.my-deals')}}</span></a>
      <a href="{{url('member/cashback-activities')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-file-text pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.cashback_activities')}}</span></a>
      <a href="{{url('member/payout')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-money pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.cashback_payout')}}</span></a>
      <a href="{{url('member/passbook')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-th-list pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.transaction_passbook')}}</span></a>
      <a href="{{url('member/refer-and-earn')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-users pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.refer_earn')}}</span></a>
      <a href="{{url('member/faq')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-question-circle-o pr-3 text-dark" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.faqs')}}</span></a>
      <a href="{{url('member/contact-us')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-phone-square pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.contact_Us')}}</span></a>
      <a href="{{url('member/notifications')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-bell pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.all_notifications')}}</span></a>
      <a href="{{url('member/favourites')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-bookmark pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.favourites')}}</span></a>
      <a href="{{url('member/my-favourite-deals')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-bookmark pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.my_fav_deals')}}</span></a>
      <a href="{{url('member/profile-settings')}}" class="list-group-item d-inline-block collapsed" data-parent="#sidebar"><i class="fa fa-cog pr-3" aria-hidden="true"></i><span class="d-md-inline">{{__('member/multi_lang.profile_setting')}}</span></a> -->


      <a class="nav-item nav-link" href="{{ url('partner/partner-overview') }}">  <i class="fa fa-list-alt pr-2" aria-hidden="true"></i>
             {{__('partner/multi_lang.dashboard')}} <span class="sr-only">(current)</span>
           </a>


      <a class="nav-item nav-link" href="{{ url('partner/offers') }}"><i class="fa fa-tags pr-2" aria-hidden="true"></i>
             {{__('partner/multi_lang.manage_offers')}}</a>
      <a class="nav-item nav-link" href="{{ url('partner/manage-cashback') }}"><i class="fa fa-list-alt pr-2" aria-hidden="true"></i>
             {{__('partner/multi_lang.manage_cashback')}}</a>
      <a class="nav-item nav-link" href="{{ url('partner/cashback-dispuite') }}"><i class="fa fa-list-alt pr-2" aria-hidden="true"></i>
             {{__('partner/multi_lang.cachback_dispute')}}</a>
      <!-- <a class="nav-item nav-link" href="#"><i class="fa fa-th-list pr-2" aria-hidden="true"></i> Reports</a> -->

          <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <i class="fa fa-th-list pr-2" aria-hidden="true"></i>
             {{__('partner/multi_lang.reports')}}
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">
             {{__('partner/multi_lang.tp_offers')}}</a>
                    <a class="dropdown-item" href="#">
             {{__('partner/multi_lang.tp_users')}}</a>
                    <a class="dropdown-item" href="#">
             {{__('partner/multi_lang.cashback_transaction')}}</a>
                  </div>
              </li>

          <li class="nav-item dropdown">
                  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fa fa-cog pr-2" aria-hidden="true"></i>
             {{__('partner/multi_lang.settings')}}
                  </a>
                  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">
             {{__('partner/multi_lang.cashback_setting')}}</a>
                    <a class="dropdown-item" href="#">
             {{__('partner/multi_lang.profile')}}</a>

                  </div>
              </li>


      <!-- <a class="nav-item nav-link" href="#"><i class="fa fa-cog pr-2" aria-hidden="true"></i>Settings</a> -->
      <!-- <a class="nav-item nav-link" href="#"><i class="fa fa-cog pr-2" aria-hidden="true"></i> Manage Profile</a> -->
    </div>
  </div>
</nav>
