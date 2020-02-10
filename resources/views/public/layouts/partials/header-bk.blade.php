@php $getMenu =  DB::table('tb_front_menu')->whereactive('1')->orderBy('ordering','ASC')->get(); @endphp
<header class="wsmenucontainer primary-bg sticky-top">
  <div class="headerTop">
    <div class="container">
      <div class="headerTopInner ">
        <div id="overlapblackbg"></div>
        <!-- <div class="wsmobileheader clearfix"> <a id="wsnavtoggle" class="animated-arrow"><span></span></a></div> -->
        <div class="row">
          <!-- <div class="col-xs-2 col-sm-2 d-md-none">
          </div> -->
          <div class="col-lg-6 col-md-6 col-xs-8">
            <div class="wsmobileheader clearfix"><a id="wsnavtoggle" class="animated-arrow"><span></span></a></div>
            <div class="header-logo text-md-left text-lg-left">
              <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('uploads/images/'.config('sximo.cnf_logo_light'))}}" alt=""></a>
            </div>
            <div class="mobilelogin">
              <a href="#" onclick="openSearch('{{route('getsearch-popup.ajax')}}')"><span class="icon-Magnifier-icon"></span></a>
              <?php /* @if(Auth::guard('member')->check())
              <a href="{{url('member/overview')}}"><span class="icon icon-user-icon"></span></a>
              @else
              <a href="#"  data-toggle="modal" data-target="#login-modal"><span class="icon icon-user-icon"></span></a>
              @endif */ ?>
            </div>
          </div>
          <div class="col-lg-6 col-md-6 d-sm-none d-none d-md-block text-center text-md-right">
            <ul class="topRightNav wsmenu-list">
              <li class="hidel1024">
                <a href="{{url(config('pageList.howitworks'))}}">
                  <span class="icon icon-perswentage-icon"></span> {{__('public/common.menu.earn_cb')}}
                </a>
              </li>
           @if(Auth::guard('member')->check())
           <?php
             $getBal = AppClass::getAllBal();
           ?>
             <li class="d--inline-block wsshopmyaccount clearfix"><a href="#" class="wtxaccountlink">
               <span class="icon icon-user-icon"></span> Hi,
                 @if(isset(Session::get('memberDetail')->first_name))
                   {{Session::get('memberDetail')->first_name .' '.str_limit(Session::get('memberDetail')->last_name,1,'.')}}
                  @endif
               <i class="fa  fa-angle-down"></i></a>
               <ul class="wsmenu-submenu ">
                 <li class="border-top1"><a href="{{url('member/overview')}}"><i class="micon-overview mr-2"></i> {{__('public/common.menu.overview')}} </a></li>
                 <li><a href="{{url('member/cashback-activities')}}"><i class="micon-activities mr-2"></i> {{__('public/common.menu.cash_activity')}}</a></li>
                 <li><a href="{{url('member/payout')}}"><i class="micon-payout mr-2"></i> {{__('public/common.menu.withdraw_money')}}</a></li>
                 <li><a href="{{url('member/refer-and-earn')}}"><i class="micon-refer-earn mr-2"></i>{{__('public/common.menu.refer_earn')}}</a></li>
                 <li><a href="{{url('member/notifications')}}"><i class="micon-notification mr-2"></i>{{__('member/multi_lang.all_notifications')}}</a></li>
                 <li><a href="{{url('member/favourites')}}"><i class="micon-favorites mr-2"></i>{{__('member/multi_lang.favourites')}}</a></li>
                 <li><a href="{{url('member/profile-settings')}}"><i class="micon-settings mr-2"></i>{{__('public/common.menu.profile_setting')}}</a></li>
                 <li><a href="{{url('faq')}}"><i class="micon-faq mr-2"></i>{{__('public/common.menu.helpSupport')}} </a></li>
                 <li><a href="{{url('member/logout')}}"><i class="fas fa-sign-out-alt"></i> {{__('public/common.menu.logout')}}</a></li>
             </ul>
            </li>
           @else
              <li>
                <a href="#" role="button" data-toggle="modal" data-target="#login-modal">
                  <span class="icon icon-user-icon"></span> Login
                </a>
              </li>
              <li>
                <a href="{{url(config('pageList.joinnow'))}}">
                  <button type="button" class="btn btn-secondary" >JOIN US</button>
                </a>
              </li>
              @endif
            </ul>
          </div>
          <div class="topSearch full-screen-search d-sm-none d-none d-md-block">
            <span class="icon-Magnifier-icon"></span>
            <div class="openBtn"  onclick="openSearch('{{route('getsearch-popup.ajax')}}')">
              <form class="main-search-frm" _lpchecked="1">
                <div class="searchBox">

                  <input class="form-control searchInput" type="text" placeholder="Search Deals, Coupons, Stores...">
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!--Main Navigation -->
  <div class="headerfull wsmainfull mainNav">
    <!--Main Menu HTML Code-->
    <div class="container">
    <div class="wsmain">
      <!-- <div class="smllogo"><a href="#"><img src="images/sml-logo.png" alt=""/></a></div> -->
      <nav class="wsmenu clearfix">
        <ul class="mobile-sub wsmenu-list">
          <!-- <li class="wscarticon clearfix"> <a href="#">{{__('public/common.menu.download_app')}}</a> </li> -->
          @if(Auth::guard('member')->check())
          <?php
            $getBal = AppClass::getAllBal();
          ?>

            <li class="d-block d-md-none d-lg-none wsshopmyaccount clearfix"><a href="#" class="wtxaccountlink"><i class="fa fa-user-circle-o"></i>Hi,
                @if(isset(Session::get('memberDetail')->first_name))
                  {{Session::get('memberDetail')->first_name .' '.Session::get('memberDetail')->last_name}}
                 @endif
              <i class="fa  fa-angle-down"></i></a>
              <ul class="wsmenu-submenu">
              <li class="border-top"><a href="{{url('member/overview')}}"><i class="far fa-file-alt"></i> {{__('public/common.menu.overview')}} </a></li>
              <li><a href="{{url('member/payout')}}"><i class="far fa-money-bill-alt"></i>{{__('public/common.menu.withdraw_money')}}</a></li>
              <li><a href="{{url('member/cashback-activities')}}"><i class="fas fa-chart-line"></i>{{__('public/common.menu.cash_activity')}}</a></li>
              <li><a href="{{url('member/refer-and-earn')}}"><i class="fa fa-users"></i>{{__('public/common.menu.refer_earn')}}</a></li>
              <li><a href="{{url('member/notifications')}}"><i class="fa fa-bell"></i>{{__('member/multi_lang.all_notifications')}}</a></li>
             <li><a href="{{url('member/favourites')}}"><i class="fa fa-bookmark"></i>{{__('member/multi_lang.favourites')}}</a></li>
              <li><a href="{{url('member/profile-settings')}}"><i class="fa fa-cog"></i>{{__('public/common.menu.profile_setting')}}</a></li>
              <li><a href="{{url('faq')}}"><i class="fa fa-info-circle"></i>{{__('public/common.menu.helpSupport')}} </a></li>
              <li><a href="{{url('member/logout')}}"><i class="fas fa-sign-out-alt"></i> {{__('public/common.menu.logout')}}</a></li>
            </ul>
           </li>
          @endif

          @foreach($getMenu as $menu)
          <?php $megamenuclass = (AppClass::hasChild($menu->menu_id))? 'megaMenu' : 'noDropDown'; ?>
            @if($menu->menu_type =='template')
              @if($menu->module =='topCat')
                 @include('public.cashback-partials.menu-partials.menu_catlist')
              @endif
              @if($menu->module =='topStores')
                @include('public.cashback-partials.menu-partials.menutopStore')
              @endif
              @if($menu->module =='topOffers')
                @include('public.cashback-partials.menu-partials..menu_bestOffes')
              @endif
             @else
             @if($menu->parent_id == 0)
               <li class="{{$menu->css_class}} {{$megamenuclass}}">
                 <a href="@if($menu->menu_type =='internal')  {!! url('/').'/'.$menu->module !!} @else {{url($menu->url)}} @endif" @if(AppClass::hasChild($menu->menu_id)) class="wtxaccountlink navtext" @else  class="noChild" @endif>
                   @if(AppClass::hasChild($menu->menu_id))
                    <span>{{$menu->menu_name}}</span>
                   @else
                    {{$menu->menu_name}}
                   @endif</a>
                @if(AppClass::hasChild($menu->menu_id))
                 <ul class="wsmenu-submenu">
                 @if(AppClass::getChlid($menu->menu_id))
                   @foreach(AppClass::getChlid($menu->menu_id) as $child)
                     <li><a href="{!! url('/').'/'.$child->module !!}">{{$child->menu_name}}</a></li>
                   @endforeach
                  @endif
                 </ul>
               @endif
               </li>
             @endif
           @endif
          @endforeach

          <!-- <li class="wscarticon clearfix"> <a href="#">Download App</a> </li> -->
          <!-- <li class="trendingLink wscarticon clearfix">
            <a href="#">
              <span class="icon-Clock-icon"></span> Last Minute Deals</a>
          </li>
          <li class="trendingLink wsshopmyaccount clearfix">
            <a href="#">
              <span class="icon-Clock-icon"></span> End of Season Sale</a>
          </li> -->
      </ul>

        <!-- <ul class="mobile-sub wsmenu-list">
          <li class="wscarticon clearfix"> <a href="#">{{__('public/common.menu.download_app')}}</a> </li>
        </ul> -->
      </nav>
  </div>
    </div>
    <!--Menu HTML Code-->
  </div>
  <!--Main Navigation -->
  <div id="myOverlay" class="overlay">

  </div>
</header>
<!-- Mobile Footer Navbar -->
<div class="mobFooterNav">
  <ul class="footerTabNav">
    @if(Auth::guard('member')->check())
    <li class="border-top">
      <a href="{{url('member/overview')}}">
        <!-- <i class="micon-overview icon"></i> -->
        <img src="{{asset('public_assets/images/user-account.svg')}}" alt="Login" width="24px">
        <span class="navlabel">My Account</span>
      </a>
    </li>
    <li>
      <a href="{{url('member/notifications')}}">
        <!-- <i class="icon micon-notification"></i> -->
        <img src="{{asset('public_assets/images/notification.svg')}}" alt="Login" width="24px">
        <span class="navlabel">Notification</span>
      </a>
    </li>
    @else
    <li>
      <a href="#" role="button" data-toggle="modal" data-target="#login-modal">
        <!-- <span class="icon icon-user-icon"></span> -->
        <img src="{{asset('public_assets/images/sign-in.svg')}}" alt="Login" width="24px">
        <span class="navlabel">Login</span>
      </a>
    </li>
    <li>
      <a href="{{url(config('pageList.joinnow'))}}">
        <!-- <span class="icon icon-user-icon"></span> -->
        <img src="{{asset('public_assets/images/Sign-up.svg')}}" alt="Join Us" width="24px">
        <span class="navlabel">Join Us</span>
      </a>
    </li>
    @endif
    <li>
      <a href="{{url(config('pageList.howitworks'))}}">
        <!-- <span class="icon icon-perswentage-icon"></span> -->
        <img src="{{asset('public_assets/images/hiw-icon.svg')}}" alt="Learn" width="24px">
        <span class="navlabel">Learn</span>
      </a>
    </li>
    <li>
      <a href="{{url(config('pageList.referearn'))}}">
        <!-- <span class="icon micon-refer-earn"></span> -->
        <img src="{{asset('public_assets/images/referral.svg')}}" alt="Refer" width="24px">
        <span class="navlabel">Refer</span>
      </a>
    </li>
    <?php if (\Request::is('store/*') || \Request::is('category/*') || \Request::is('brand/*') || \Request::is('tag/*') || \Request::is('deals-of-the-day')) {  ?>
      <li>
        <!-- <span style="font-size:30px;cursor:pointer" onclick="openNav()"><i class="fa fa-filter"></i></span> -->
        <a href="javascript:void(0)" onclick="openNav()">
          <!-- <i class="icon micon-faq"></i> -->
          <!-- <img src="{{asset('public_assets/images/help.svg')}}" alt="Refer" width="24px"> -->
          <i class="fa fa-filter font-24"></i>
          <span class="navlabel">Filter</span>
        </a>
      </li>
    <?php } else { ?>
      <li>
        <a href="{{url('faq')}}">
          <!-- <i class="icon micon-faq"></i> -->
          <img src="{{asset('public_assets/images/help.svg')}}" alt="Refer" width="24px">
          <span class="navlabel">Help</span>
        </a>
      </li>
    <?php } ?>
  </ul>
</div>
<!-- .Mobile Footer Navbar -->
<input type="hidden" id="cbPopUrl" value="<?php echo route('getAjaxPopup.common'); ?>" />


  <!--- cb common  popup included here ------->
  <div class="modal fade" id="cb-common-popup" tabindex="-1" role="dialog" aria-labelledby="common-popup" aria-hidden="true"></div>
  <!--- Auth popup included here ------->
  @include('public/cashback-partials/auth-popups.login-popup')
  @include('public/cashback-partials/auth-popups.join-us-popup')
  @include('public/cashback-partials/auth-popups.forgot-password-popup')
  @include('public/cashback-partials/auth-popups.toaster_msg_js')
<script type="text/javascript">
  var isLoggedin = <?php if(Auth::guard('member')->check()) { echo 1; } else { echo 0; }  ?>;
  var cbUrl = '<?php echo route('getAjaxPopup.common'); ?>';
  var baseUrl = '<?php echo url('/');?>';
</script>
<script>
// open the full screen search box
function openSearch(url) {
   $.ajax({
        method:'get',
        cache: false,
        url:url,
        success:function(data){
          $('#myOverlay').css({'display':'block','transition':'0.5s'});
          $('#myOverlay').html(data);
		 $("#myOverlay #searchTxt").focus();
      }
    });

	$(document).keyup(function(e) {
    if (e.which == 27) {
        closeSearch();
    }
	});

	$("#myOverlay #searchTxt").focus();
}
// Close the full screen search box
function closeSearch() {
  document.getElementById("myOverlay").style.display = "none";
}

</script>
