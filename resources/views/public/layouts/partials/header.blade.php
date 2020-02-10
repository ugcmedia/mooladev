@php $getMenu =  DB::table('tb_front_menu')->whereactive('1')->orderBy('ordering','ASC')->get(); @endphp
<header id="common-header" class="header fixedtop">
  <div class="container">
    <div class="main-menu">
      <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand" href="{{url('/')}}"><img src="{{asset('public_assets/images/'.config('sximo.cnf_logo'))}}" alt=""></a>
        <!-- <img src="images/Header_logo.png" class="img-fluid" alt=""> -->

      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><i class="fas fa-bars text-white"></i></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ml-auto">
          @foreach($getMenu as $menu)
          <?php

          $megamenuclass = (AppClass::hasChild($menu->menu_id))? 'nav-item dropdown' : 'nav-item';

           ?>

            @if($menu->parent_id == 0)
              <li class="{{$menu->css_class}} {{$megamenuclass}}">
                <a   href="@if($menu->menu_type =='internal')  {!! url('/').'/'.$menu->module !!} @else {{url($menu->url)}} @endif"
                  @if(AppClass::hasChild($menu->menu_id))
                  class="nav-link dropdown-toggle  text-white" id="navbarDropdownMenuLink{{$menu->menu_id}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                  @else  class="nav-link  text-white"
                  @endif>
                  @if(AppClass::hasChild($menu->menu_id))
                   <span>{{$menu->menu_name}}</span>
                  @else
                   {{$menu->menu_name}}
                  @endif
                </a>
               @if(AppClass::hasChild($menu->menu_id))
                <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink{{$menu->menu_id}}">
                @if(AppClass::getChlid($menu->menu_id))
                  @foreach(AppClass::getChlid($menu->menu_id) as $child)

                    <a href="{!! url('/').'/'.$child->module !!}"><li class="dropdown-item">{{ $child->menu_name  }}</li></a>
                  @endforeach
                 @endif
                </ul>

              @endif
              </li>
            @endif

          @endforeach

          @if(Auth::guard('member')->check())
          <?php
            //$getBal = AppClass::getAllBal();
          ?>

            <!-- <li class="d--inline-block wsshopmyaccount clearfix"><a href="#" class="wtxaccountlink">
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
           </li>  -->


           <li class="nav-item dropdown">
                   <a class="nav-link dropdown-toggle  text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
               <i class="fa fa-th-list pr-2" aria-hidden="true"></i>
               @if(isset(Session::get('memberDetail')->first_name))
                 {{Session::get('memberDetail')->first_name .' '.str_limit(Session::get('memberDetail')->last_name,1,'.')}}
                @endif

                   </a>
                   <div class="dropdown-menu" aria-labelledby="navbarDropdown">

                     <a class="dropdown-item" href="{{url('member/overview')}}"><i class="micon-overview mr-2"></i> {{__('public/common.menu.overview')}} </a>
                     <a class="dropdown-item" href="{{url('member/cashback-activities')}}"><i class="micon-activities mr-2"></i> {{__('public/common.menu.cash_activity')}}</a>
                    <a class="dropdown-item" href="{{url('member/payout')}}"><i class="micon-payout mr-2"></i> {{__('public/common.menu.withdraw_money')}}</a>
                     <a class="dropdown-item" href="{{url('member/refer-and-earn')}}"><i class="micon-refer-earn mr-2"></i>{{__('public/common.menu.refer_earn')}}</a>
                     <a class="dropdown-item" href="{{url('member/notifications')}}"><i class="micon-notification mr-2"></i>{{__('member/multi_lang.all_notifications')}}</a>
                     <a class="dropdown-item" href="{{url('member/favourites')}}"><i class="micon-favorites mr-2"></i>{{__('member/multi_lang.favourites')}}</a>
                     <a class="dropdown-item" href="{{url('member/profile-settings')}}"><i class="micon-settings mr-2"></i>{{__('public/common.menu.profile_setting')}}</a>
                     <a class="dropdown-item" href="{{url('faq')}}"><i class="micon-faq mr-2"></i>{{__('public/common.menu.helpSupport')}} </a>
                     <a  class="dropdown-item" href="{{url('member/logout')}}"><i class="fas fa-sign-out-alt"></i> {{__('public/common.menu.logout')}}</a>

                   </div>
               </li>

          @else
             <li class="nav-item">
               <a class="nav-link text-white" href="#" role="button" data-toggle="modal" data-target="#login-modal">
                 <span class="icon icon-user-icon"></span> {{__('public/common.menu.login')}}
               </a>
             </li>
             <!-- <li>
               <a href="{{url(config('pageList.joinnow'))}}">
                 <button type="button" class="btn btn-secondary" >JOIN US</button>
               </a>
             </li> -->
             @endif

          <!-- <li class="nav-item">
            <a class="nav-link text-white" href="#">Activate cashback</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown link
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li> -->
          <!-- <li class="nav-item">
            <a class="nav-link text-white" href="#" data-toggle="modal" data-target="#login-modal">Login</a>
          </li> -->
        </ul>
      </div>
    </nav>
    </div>
    </div>
</header>
<!--- Auth popup included here ------->
@include('public/cashback-partials/auth-popups.login-popup')
@include('public/cashback-partials/auth-popups.join-us-popup')
@include('public/cashback-partials/auth-popups.forgot-password-popup')
@include('public/cashback-partials/auth-popups.toaster_msg_js')
<!-- <script src="public/cashback-partials/auth-popups.toaster_msg_js"> -->
<script type="text/javascript">
var isLoggedin = <?php if(Auth::guard('member')->check()) { echo 1; } else { echo 0; }  ?>;
var baseUrl = '<?php echo url('/');?>';
</script>
<script>
// open the full screen search box
function openSearch(url) {
$('#myOverlay').css({'display':'block','transition':'0.5s'});
$('#myOverlay .tab-loader').css({'display':'block'});
 $.ajax({
      method:'get',
      cache: false,
      url:url,
      success:function(data){
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
$('#myOverlay .tab-loader').hide();
}
</script>
