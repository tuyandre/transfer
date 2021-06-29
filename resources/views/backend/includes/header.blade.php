<!-- Main Header-->
<div class="main-header side-header sticky">
    <div class="container-fluid">
        <div class="main-header-left">
            <a class="main-header-menu-icon" href="#" id="mainSidebarToggle"><span></span></a>
        </div>
        <div class="main-header-center">
            <div class="responsive-logo">
                <a href="{{route('home')}}"><img src="{{asset('frontend/assets/img/favicons/brand.PNG')}}" class="mobile-logo" alt="logo"></a>
                <a href="{{route('home')}}"><img src="{{asset('frontend/assets/img/favicons/brand.PNG')}}" class="mobile-logo-dark" alt="logo"></a>
            </div>
        </div>
        <div class="main-header-right">
            <div class="dropdown header-search">
                <a class="nav-link icon header-search">
                    <i class="fe fe-search header-icons"></i>
                </a>
            </div>
            <div class="dropdown d-md-flex">
                <a class="nav-link icon full-screen-link" href="#">
                    <i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
                    <i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
                </a>
            </div>
            <div class="dropdown main-profile-menu">
                <a class="d-flex" href="#">
                    <span class="main-img-user" ><img alt="avatar" src="{{asset('dashboard/assets/img/users/1.jpg')}}"></span>
                </a>
                <div class="dropdown-menu">
                    <div class="header-navheading">
                        <h6 class="main-notification-title">Sonia Taylor</h6>
                        <p class="main-notification-text">Web Designer</p>
                    </div>
                    <a class="dropdown-item border-top" href="#">
                        <i class="fe fe-user"></i> My Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fe fe-edit"></i> Edit Profile
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fe fe-settings"></i> Account Settings
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fe fe-compass"></i> Activity
                    </a>
                    <a class="dropdown-item" href="#">
                        <i class="fe fe-power"></i> Sign Out
                    </a>
                </div>
            </div>
            <div class="dropdown d-md-flex header-settings">
                <a href="#" class="nav-link icon" data-toggle="sidebar-right" data-target=".sidebar-right">
                    <i class="fe fe-align-right header-icons"></i>
                </a>
            </div>
            <button class="navbar-toggler navresponsive-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent-4"
                    aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fe fe-more-vertical header-icons navbar-toggler-icon"></i>
            </button><!-- Navresponsive closed -->
        </div>
    </div>
</div>
<!-- End Main Header-->		<!-- Mobile-header -->
<div class="mobile-main-header">
    <div class="mb-1 navbar navbar-expand-lg  nav nav-item  navbar-nav-right responsive-navbar navbar-dark  ">
        <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
            <div class="d-flex order-lg-2 ml-auto">
                <div class="dropdown header-search">
                    <a class="nav-link icon header-search">
                        <i class="fe fe-search header-icons"></i>
                    </a>
                    <div class="dropdown-menu">
                        <div class="main-form-search p-2">
                            <div class="input-group">
                                <div class="input-group-btn search-panel">
                                    <select class="form-control select2-no-search">
                                        <option label="All categories">
                                        </option>
                                        <option value="IT Projects">
                                            IT Projects
                                        </option>
                                        <option value="Business Case">
                                            Business Case
                                        </option>
                                        <option value="Microsoft Project">
                                            Microsoft Project
                                        </option>
                                        <option value="Risk Management">
                                            Risk Management
                                        </option>
                                        <option value="Team Building">
                                            Team Building
                                        </option>
                                    </select>
                                </div>
                                <input type="search" class="form-control" placeholder="Search for anything...">
                                <button class="btn search-btn"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown ">
                    <a class="nav-link icon full-screen-link">
                        <i class="fe fe-maximize fullscreen-button fullscreen header-icons"></i>
                        <i class="fe fe-minimize fullscreen-button exit-fullscreen header-icons"></i>
                    </a>
                </div>
                <div class="dropdown main-profile-menu">
                    <a class="d-flex" href="#">
                        <span class="main-img-user" ><img alt="avatar" src="{{asset('dashboard/assets/img/users/1.jpg')}}"></span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="header-navheading">
                            <h6 class="main-notification-title">Sonia Taylor</h6>
                            <p class="main-notification-text">Web Designer</p>
                        </div>
                        <a class="dropdown-item border-top" href="#">
                            <i class="fe fe-user"></i> My Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fe fe-edit"></i> Edit Profile
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fe fe-settings"></i> Account Settings
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fe fe-settings"></i> Support
                        </a>
                        <a class="dropdown-item" href="profile.html">
                            <i class="fe fe-compass"></i> Activity
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fe fe-power"></i> Sign Out
                        </a>
                    </div>
                </div>
                <div class="dropdown  header-settings">
                    <a href="#" class="nav-link icon" data-toggle="sidebar-right" data-target=".sidebar-right">
                        <i class="fe fe-align-right header-icons"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Mobile-header closed -->
