<!--MAIN NAVIGATION-->
<!--===================================================-->
<nav id="mainnav-container">
    <div id="mainnav">

        <!--Menu-->
        <!--================================-->
        <div id="mainnav-menu-wrap">
            <div class="nano">
                <div class="nano-content">
                    <!--Shortcut buttons-->
                    <!--================================-->
                    <div id="mainnav-shortcut" class="hidden">
                        <ul class="list-unstyled shortcut-wrap">
                            <li class="col-xs-3" data-content="My Profile">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-mint">
                                    <i class="demo-pli-male"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Messages">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-warning">
                                    <i class="demo-pli-speech-bubble-3"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Activity">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-success">
                                    <i class="demo-pli-thunder"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="col-xs-3" data-content="Lock Screen">
                                <a class="shortcut-grid" href="#">
                                    <div class="icon-wrap icon-wrap-sm icon-circle bg-purple">
                                    <i class="demo-pli-lock-2"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!--================================-->
                    <!--End shortcut buttons-->


                    <ul id="mainnav-menu" class="list-group">
                        <!--Category name-->                
                        <li class="">
                            <a class="nav-link" href="{{route('admin.dashboard')}}">
                                <i class="fa fa-home"></i>
                                <span class="menu-title">{{translate('Dashboard')}}</span>
                            </a>
                        </li>
                        @if(Auth::user()->user_type=='admin')
                        <li>
                            <a href="#">
                                <i class="fa fa-user-plus"></i>
                                <span class="menu-title">{{translate('Agents')}}</span>
                                <i class="arrow"></i>
                            </a>

                            <!--Submenu-->
                            <ul class="collapse">
                                <li class="{{ areActiveRoutes(['agents.index', 'agents.create', 'agents.edit', 'agents.payment_history','agents.approved','agents.profile_modal'])}}">                        
                                    <a class="nav-link" href="{{route('agents.index')}}">{{translate('Agent List')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['agents.accounts'])}}">                        
                                    <a class="nav-link" href="{{route('agents.accounts')}}">{{translate('Accounts')}}</a>
                                </li>
                                <li class="{{ areActiveRoutes(['agents.accounts'])}}">                        
                                    <a class="nav-link" href="{{route('agents.instolment')}}">{{translate('instolment')}}</a>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li class="">
                            <a class="nav-link" href="{{ route('agent.index') }}">
                                <i class="fa fa-search"></i>
                                <span class="menu-title">{{translate('Account')}}</span>
                            </a>
                        </li>
                        <li class="{{ areActiveRoutes(['agents.accounts'])}}">                        
                            <a class="nav-link" href="{{route('agents.instolment')}}">{{translate('customer instolment')}}</a>
                        </li>
                        @endif                   
                    </ul>
                </div>
            </div>
        </div>
        <!--================================-->
        <!--End menu-->

    </div>
</nav>
