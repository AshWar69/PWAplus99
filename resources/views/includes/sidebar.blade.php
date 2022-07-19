
        <!-- ========== App Menu ========== -->
        <div class="app-menu navbar-menu">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <!-- Dark Logo-->
                <a href="index.html" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{asset('images/logo.png')}}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('images/logo.png')}}" alt="" height="100">
                    </span>
                </a>
                <!-- Light Logo-->
                <a href="index.html" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{asset('images/logo.png')}}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{asset('images/logo.png')}}" alt="" height="100">
                    </span>
                </a>
                <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover" id="vertical-hover">
                    <i class="ri-record-circle-line"></i>
                </button>
            </div>

            <div id="scrollbar">
                <div class="container-fluid">

                    <div id="two-column-menu">
                    </div>
                    <ul class="navbar-nav" id="navbar-nav">
                        <li class="menu-title"><span data-key="t-menu">Menu</span></li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{URL::to('/')}}">
                                <i class="ri-dashboard-2-line"></i> <span data-key="t-dashboards">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{URL::to('Users')}}">
                                <i class="ri-user-2-fill"></i> <span data-key="t-users">Users</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{URL::to('Banners')}}">
                                <i class="ri-image-2-fill"></i> <span data-key="t-banners">Banners</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{URL::to('Categories')}}">
                                <i class="ri-git-merge-fill"></i> <span data-key="t-categories">Categories</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link menu-link" href="{{URL::to('Orders')}}">
                                <i class="ri-store-3-fill"></i> <span data-key="t-orders">Orders</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Sidebar -->
            </div>
        </div>
        <!-- Left Sidebar End -->
        <!-- Vertical Overlay-->
        <div class="vertical-overlay"></div>