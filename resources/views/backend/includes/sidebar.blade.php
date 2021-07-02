<!-- Sidemenu -->
<div class="main-sidebar main-sidebar-sticky side-menu">
    <div class="sidemenu-logo">
        <a class="main-logo" href="{{route('home')}}">
            <img src="{{asset('frontend/assets/img/favicons/favicon-32x32.png')}}" class="header-brand-img desktop-logo" alt="logo">
            <img src="{{asset('frontend/assets/img/favicons/favicon-32x32.png')}}" class="header-brand-img icon-logo" alt="logo">
            <img src="{{asset('frontend/assets/img/favicons/favicon-32x32.png')}}" class="header-brand-img desktop-logo theme-logo" alt="logo">
            <img src="{{asset('frontend/assets/img/favicons/favicon-32x32.png')}}" class="header-brand-img icon-logo theme-logo" alt="logo">
        </a>
    </div>
    <div class="main-sidebar-body">
        <ul class="nav">
            <li class="nav-header"><span class="nav-label">Dashboard</span></li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('home')}}"><span class="shape1"></span><span class="shape2"></span>
                    <i class="ti-home sidemenu-icon"></i><span class="sidemenu-label">Dashboard</span></a>

            @if(Auth::user()->hasRole("admin"))
            <li class="nav-item">
                <a class="nav-link with-sub" href="#"><span class="shape1"></span><span class="shape2"></span>
                    <i class="ti-user sidemenu-icon"></i>
                    <span class="sidemenu-label">Users</span><i class="angle fe fe-chevron-right"></i></a>
                <ul class="nav-sub">
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="{{route('admin.users.all')}}">All Users</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="{{route('admin.users.allAgents')}}">All Agents</a>
                    </li>
                    <li class="nav-sub-item">
                        <a class="nav-sub-link" href="{{route('admin.users.allCustomers')}}">All Customers</a>
                    </li>

                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.transactions.company_compte')}}"><span class="shape1"></span>
                    <span class="shape2"></span><i class="ti-money sidemenu-icon"></i><span class="sidemenu-label">Company Compte</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.transactions.index')}}"><span class="shape1"></span>
                    <span class="shape2"></span><i class="ti-receipt sidemenu-icon"></i><span class="sidemenu-label">Transactions</span></a>
            </li>
                @else



                <li class="nav-item">
                    <a class="nav-link" href="{{route('agent.clients.clientSaving')}}"><span class="shape1"></span>
                        <span class="shape2"></span><i class="ti-money sidemenu-icon"></i><span class="sidemenu-label">CLIENT SAVING</span></a>
                </li>
                <li class="nav-item bg-warning">
                    <a class="nav-link" href="{{route('agent.clients.clientPendingWithdraw')}}"><span class="shape1"></span>
                        <span class="shape2"></span><i class="ti-receipt sidemenu-icon"></i><span class="sidemenu-label">CLIENT PENDING WITHDRAW</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agent.clients.clientWithdraw')}}"><span class="shape1"></span>
                        <span class="shape2"></span><i class="ti-receipt sidemenu-icon"></i><span class="sidemenu-label">CLIENT WITHDRAW</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="{{route('agent.auth.agentTransaction')}}"><span class="shape1"></span>
                        <span class="shape2"></span><i class="ti-money sidemenu-icon"></i><span class="sidemenu-label">MY TRANSACTION</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('agent.clients.clientTransaction')}}"><span class="shape1"></span>
                        <span class="shape2"></span><i class="ti-receipt sidemenu-icon"></i><span class="sidemenu-label">CLIENT TRANSACTION</span></a>
                </li>
            @endif

        </ul>
    </div>
</div>
<!-- End Sidemenu -->        <!-- Main Header-->
