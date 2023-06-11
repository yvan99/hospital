<nav class="nav navbar navbar-expand-xl navbar-light iq-navbar">
    <div class="container-fluid navbar-inner">
        <a href="index.html" class="navbar-brand">

            <!--Logo start-->
            <div class="logo-main">
                <div class="logo-normal">
                    <svg class="text-primary icon-30" viewBox="0 0 32 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.25333 2H22.0444L29.7244 15.2103L22.0444 28.1333H7.25333L0 15.2103L7.25333 2ZM11.2356 9.32316H18.0622L21.3334 15.2103L18.0622 20.9539H11.2356L8.10669 15.2103L11.2356 9.32316Z"
                            fill="currentColor" />
                        <path d="M23.751 30L13.2266 15.2103H21.4755L31.9999 30H23.751Z" fill="#3FF0B9" />
                    </svg>
                </div>
                <div class="logo-mini">
                    <svg class="text-primary icon-30" viewBox="0 0 32 32" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M7.25333 2H22.0444L29.7244 15.2103L22.0444 28.1333H7.25333L0 15.2103L7.25333 2ZM11.2356 9.32316H18.0622L21.3334 15.2103L18.0622 20.9539H11.2356L8.10669 15.2103L11.2356 9.32316Z"
                            fill="currentColor" />
                        <path d="M23.751 30L13.2266 15.2103H21.4755L31.9999 30H23.751Z" fill="#3FF0B9" />
                    </svg>
                </div>
            </div>
            <!--logo End-->
            <h4 class="logo-title d-block d-xl-none" data-setting="app_name">CROP MIS </h4>
        </a>
        <div class="sidebar-toggle" data-toggle="sidebar" data-active="true">
            <i class="icon d-flex">
                <svg class="icon-20" width="20" viewBox="0 0 24 24">
                    <path fill="currentColor"
                        d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z" />
                </svg>
            </i>
        </div>
        <div class="d-flex align-items-center justify-content-between product-offcanvas">
            <div class="breadcrumb-title border-end me-3 pe-3 d-none d-xl-block">
                <small class="mb-0 text-capitalize">Home</small>
            </div>
            <div class="offcanvas offcanvas-end shadow-none iq-product-menu-responsive" tabindex="-1"
                id="offcanvasBottom">
                <div class="offcanvas-body">
                    <ul class="iq-nav-menu list-unstyled">
                        <li class="nav-item ">
                            <a class="nav-link menu-arrow justify-content-start active"
                                data-bs-toggle="collapse" href="#homeData" role="button" aria-expanded="false"
                                aria-controls="homeData">
                                <svg class="icon-20" width="20" viewBox="0 0 24 24" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M9.14373 20.7821V17.7152C9.14372 16.9381 9.77567 16.3067 10.5584 16.3018H13.4326C14.2189 16.3018 14.8563 16.9346 14.8563 17.7152V20.7732C14.8562 21.4473 15.404 21.9951 16.0829 22H18.0438C18.9596 22.0023 19.8388 21.6428 20.4872 21.0007C21.1356 20.3586 21.5 19.4868 21.5 18.5775V9.86585C21.5 9.13139 21.1721 8.43471 20.6046 7.9635L13.943 2.67427C12.7785 1.74912 11.1154 1.77901 9.98539 2.74538L3.46701 7.9635C2.87274 8.42082 2.51755 9.11956 2.5 9.86585V18.5686C2.5 20.4637 4.04738 22 5.95617 22H7.87229C8.19917 22.0023 8.51349 21.8751 8.74547 21.6464C8.97746 21.4178 9.10793 21.1067 9.10792 20.7821H9.14373Z"
                                        fill="currentColor" />
                                </svg>
                                <span class="nav-text ms-2">{{env("APP_NAME")}}</span>
                            </a>
                            {{-- <ul class="iq-header-sub-menu list-unstyled collapse" id="homeData">
                                <li class="nav-item"><a class="nav-link active" href="index.html">Dashboard</a>
                                </li>
                                <li class="nav-item"><a class="nav-link "
                                        href="analytics-dashboard.html">Analytics</a></li>
                                <li class="nav-item"><a class="nav-link "
                                        href="crypto-dashboard.html">Crypto</a></li>
                                <li class="nav-item">
                                    <a class="nav-link menu-arrow" data-bs-toggle="collapse" href="#menuStyles"
                                        role="button" aria-expanded="false" aria-controls="menuStyles">
                                        Menu Style
                                        <i class="right-icon">
                                            <svg class="icon-20" width="20" viewBox="0 0 24 24"
                                                fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M8.5 5L15.5 12L8.5 19" stroke="currentColor"
                                                    stroke-width="1.5" stroke-linecap="round"
                                                    stroke-linejoin="round"></path>
                                            </svg>
                                        </i>
                                    </a>
                                    <ul aria-expanded="false"
                                        class="iq-header-sub-menu left list-unstyled collapse" id="menuStyles">
                                        <li class="nav-item"><a class="nav-link "
                                                href="index-horizontal.html">Horizontal Dashboard</a></li>
                                        <li class="nav-item"><a class="nav-link "
                                                href="index-dual-compact.html">Dual Compact</a></li>
                                        <li class="nav-item"><a class="nav-link "
                                                href="index-boxed.html">Boxed Horizontal</a></li>
                                    </ul>
                                </li>
                            </ul> --}}
                        </li>
                    
                    </ul>
                </div>
            </div>
        </div>
        <div class="d-flex align-items-center">
            <button id="navbar-toggle" class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon">
                    <span class="navbar-toggler-bar bar1 mt-1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="mb-2 navbar-nav ms-auto align-items-center navbar-list mb-lg-0 ">
                <li class="nav-item dropdown">
                    <a class="py-0 nav-link d-flex align-items-center ps-3" href="#"
                        id="profile-setting" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{asset('dashboard/images/avatars/01.png')}}" alt="User-Profile"
                            class="img-fluid avatar avatar-50 avatar-rounded" loading="lazy">
                        <div class="caption ms-3 d-none d-md-block ">
                            <h6 class="mb-0 caption-title">{{ Auth::user()->name }}</h6>
                            {{-- <h4>Logged in as ({{ Auth::getDefaultDriver() }})</h4> --}}
                            <p class="mb-0 caption-sub-title">{{ Auth::user()->names }}</p>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile-setting">
                        {{-- <li><a class="dropdown-item" href="app/user-profile.html">Profile</a></li>
                        <li><a class="dropdown-item" href="app/user-privacy-setting.html">Privacy
                                Setting</a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li> --}}
                        <li><a class="dropdown-item" href="/{{ Auth::getDefaultDriver() }}/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>