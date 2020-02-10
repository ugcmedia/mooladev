<?php $sidebar = \SiteHelpers::menus('sidebar') ;?>
<div id="sidebar-navigation">
    <div class="logo">
         <a href="<?php echo url('dashboard') ;?>">
            @if(file_exists(public_path().'/uploads/images/'.config('sximo.cnf_logo') ) && config('sximo.cnf_logo') !='')
                <img src="{{ asset('uploads/images/'.config('sximo.cnf_logo')) }}" alt="{{ config('sximo.cnf_appname') }}"  />
            @else
            {{ config('sximo.cnf_appname')}}
            @endif
        </a>
    </div>
    <div class="sidebar-collapse">
    <nav role="navigation" class="navbar-default ">
       <ul id="sidemenu" class="nav expanded-menu">
        <li class="profile-sidebar">
            <a href="{{ url('user/profile')}}">
                {!! \SiteHelpers::avatar(80)!!}
            </a>

            <div class="stats-label">


                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" data-toggle="dropdown">
                        <span class="font-extra-bold font-uppercase">{{ session('fid') }}</span>
                    </a>
                    <ul class="dropdown-menu animated flipInX m-t-xs" style="display: none">
                        <li><a href="{{ url('user/profile')}}"><i class="fa fa-vcard-o"></i>  @lang('core.m_profile')</a></li>
                        <li><a href="{{ url('user/logout')}}"><i class="fa fa-power-off"></i> @lang('core.m_logout')</a></li>
                    </ul>
                </div>
            </div>


        </li>
        @foreach ($sidebar as $menu)


             <li @if(Request::segment(1) == $menu['module']) class="active" @endif>

            @if($menu['module'] =='separator')
            <li class="separator"> <span> {{$menu['menu_name']}} </span></li>

            @else
                <a title="{{  $menu['menu_name'] }}" data-placement="right"
                    @if($menu['menu_type'] =='external')
						href="{{ str_replace('#URL',url('/'),$menu['url']) }}"
                    @else
                        href="{{ URL::to($menu['module'])}}"
                    @endif

                 @if(count($menu['childs']) > 0 ) class="expand level-closed" @endif>
                    <i class="{{$menu['menu_icons']}}"></i>
                    <span class="nav-label">
                        {{ (isset($menu['menu_lang']['title'][session('lang')]) ? $menu['menu_lang']['title'][session('lang')] : $menu['menu_name']) }}
                    </span>
                    @if(count($menu['childs']))<span class="fa arrow"></span> @endif
                </a>
                @endif
                @if(count($menu['childs']) > 0)
                    <ul class="nav nav-second-level">
                        @foreach ($menu['childs'] as $menu2)

                         <li @if(Request::segment(1) == $menu2['module']) class="active" @endif>
                            <a
                                @if($menu2['menu_type'] =='external')
                                    href="{{ str_replace('#URL',url('/'),$menu2['url']) }}"
                                @elseif ($menu2['menu_name'] =='System Setting')
                                    href="{{ route('settings').'/system_setting'}}"
                                @elseif ($menu2['menu_name'] =='Developer Setting')
                                    href="{{ route('settings').'/developer'}}"
                                @elseif ($menu2['menu_name'] =='Referral Setting')
                                    href="{{ route('settings').'/referral'}}"
                                @elseif ($menu2['menu_name'] =='Payout Setting')
                                    href="{{ route('settings').'/payout'}}"
                                @elseif ($menu2['menu_name'] =='Home page Setting')
                                    href="{{ route('settings').'/homepage'}}"
                                @else
                                    href="{{ URL::to($menu2['module'])}}"
                                @endif
                            >

                            <i class="{{$menu2['menu_icons']}}"></i>
                           {{ (isset($menu2['menu_lang']['title'][session('lang')]) ? $menu2['menu_lang']['title'][session('lang')] : $menu2['menu_name']) }}
                            </a>
                            @if(count($menu2['childs']) > 0)
                            <ul class="nav nav-third-level">
                                @foreach($menu2['childs'] as $menu3)
                                    <li @if(Request::segment(1) == $menu3['module']) class="active" @endif>
                                        <a
                                            @if($menu['menu_type'] =='external')
                                                href="{{ str_replace('#URL',url('/'),$menu3['url']) }}"
                                            @else
                                                href="{{ URL::to($menu3['module'])}}"
                                            @endif

                                        >

                                        <i class="{{$menu3['menu_icons']}}"></i>
                                        {{ (isset($menu3['menu_lang']['title'][session('lang')]) ? $menu3['menu_lang']['title'][session('lang')] : $menu3['menu_name']) }}

                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                            @endif
                        </li>
                        @endforeach
                    </ul>
                @endif
            </li>
        @endforeach

    </ul>
    </nav>
    </div>
</div>
