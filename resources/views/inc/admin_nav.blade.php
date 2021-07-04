<header id="navbar">
    <div id="navbar-container" class="boxed">

        @php
            $generalsetting = \App\GeneralSetting::first();
        @endphp


        <div class="navbar-header">
            <a href="{{route('admin.dashboard')}}" class="navbar-brand">
                @if($generalsetting->logo != null)
                    <img loading="lazy"  src="{{ my_asset($generalsetting->admin_logo) }}" class="brand-icon" alt="{{ $generalsetting->site_name }}">
                @else
                    <img loading="lazy"  src="{{ my_asset('img/logo_shop.png') }}" class="brand-icon" alt="{{ $generalsetting->site_name }}">
                @endif
                <div class="brand-title">
                    <span class="brand-text">{{ 'Employe Mangement' }}</span>
                </div>
            </a>
        </div>

        <div class="navbar-content">

            <ul class="nav navbar-top-links">

                <li class="tgl-menu-btn">
                    <a class="mainnav-toggle" href="#">
                        <i class="demo-pli-list-view"></i>
                    </a>
                </li>

                @if (\App\Addon::where('unique_identifier', 'pos_system')->first() != null && \App\Addon::where('unique_identifier', 'pos_system')->first()->activated)
                <li class="" data-toggle="tooltip" data-placement="bottom" data-original-title="POS">
                    <a class="" href="{{ route('poin-of-sales.index') }}">
                        <i class="fa fa-print"></i>
                    </a>
                </li>
                @endif
                <li class="" data-toggle="tooltip" data-placement="bottom" data-original-title="Browse Frontend">
                    <a target="_blank" href="">
                        <i class="fa fa-globe"></i>
                    </a>
                </li>


            </ul>
            <ul class="nav navbar-top-links">

            
                <li class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle" aria-expanded="true">
                        <i class="demo-pli-bell"></i>                      
                            <span class="badge badge-header badge-danger"></span>                   
                    </a>

                    <!--Notification dropdown menu-->
                    <div class="dropdown-menu dropdown-menu-md dropdown-menu-right" style="opacity: 1;">
                        <div class="nano scrollable has-scrollbar" style="height: 265px;">
                            <div class="nano-content" tabindex="0" style="right: -17px;">
                                <ul class="head-list">                                 
                                       
                                </ul>
                            </div>
                            <div class="nano-pane" style="">
                                <div class="nano-slider" style="height: 170px; transform: translate(0px, 0px);"></div>
                            </div>
                        </div>
                    </div>
                </li>

                <!--User dropdown-->
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <li id="dropdown-user" class="dropdown">
                    <a href="#" data-toggle="dropdown" class="dropdown-toggle text-right">
                        <span class="ic-user pull-right">

                            <i class="demo-pli-male"></i>
                        </span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right panel-default">
                        <ul class="head-list">
                            <li>
                                <a href="{{ route('profile.index') }}"><i class="demo-pli-male icon-lg icon-fw"></i> {{translate('Profile')}}</a>
                            </li>
                            <li>
                                <a href="{{ route('logout')}}"><i class="demo-pli-unlock icon-lg icon-fw"></i> {{translate('Logout')}}</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
                <!--End user dropdown-->
            </ul>
        </div>
        <!--================================-->
        <!--End Navbar Dropdown-->

    </div>
</header>
