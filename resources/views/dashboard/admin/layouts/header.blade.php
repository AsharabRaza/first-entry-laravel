
<!-- GLOBAL-LOADER -->
{{--<div id="global-loader">
    <img src="{{ url('assets/images/loader.svg') }}" class="loader-img" alt="Loader">

</div>--}}
<!-- /GLOBAL-LOADER -->
<!-- app-Header -->
<div class="app-header header sticky">
    <div class="container-fluid main-container">
        <div class="d-flex align-items-center">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0);"></a>
            <div class="responsive-logo">
                <a href="index.php" class="header-logo" style="display: flex;place-content: center;align-items: center;top: 8px;">
                    <img src="../assets/images/logo_white_1.png" style="height: 60px;" class="mobile-logo logo-1" alt="logo">
                    <img src="../assets/images/logo_black_1.png" style="height: 50px;" class="mobile-logo dark-logo-1" alt="logo">
                </a>
            </div>
            <!-- sidebar-toggle-->
            <a class="logo-horizontal " href="index.php" style="place-content: center;align-items: center;">
                <img src="../assets/images/logo_white_1.png" style="height: 60px;" class="header-brand-img desktop-logo" alt="logo">
                <img src="../assets/images/logo_white_1.png" style="height: 60px;" class="header-brand-img light-logo1"
                     alt="logo">
            </a>
            <!-- LOGO -->
            <div class="d-flex order-lg-2 ms-auto header-right-icons">
                <!-- SEARCH -->
                <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4" aria-controls="navbarSupportedContent-4" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon bi bi-three-dots-vertical text-dark"></span>
                </button>
                <div class="navbar navbar-collapse responsive-navbar p-0">
                    <div class="collapse navbar-collapse" id="navbarSupportedContent-4">
                        <div class="d-flex order-lg-2" style="place-content: center;">
                            <div class="dropdown d-md-flex">
                                <a class="nav-link icon theme-layout nav-link-bg layout-setting">
                                    <span class="dark-layout"><i class="bi bi-moon"></i></span>
                                    <span class="light-layout"><i class="bi bi-brightness-high"></i></span>
                                </a>
                            </div>
                            <!-- Theme-Layout -->
                            <div class="dropdown d-md-flex">
                                <a class="nav-link icon full-screen-link nav-link-bg">
                                    <i class="bi bi-fullscreen-exit fullscreen-button" id="myvideo"></i>
                                </a>
                            </div>
                            <!-- FULL-SCREEN -->
                            <div class="dropdown d-md-flex notifications">
                                <a class="nav-link icon" data-bs-toggle="dropdown"><i class="bi bi-bell"></i><span class=" pulse"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow ">
                                    <div class="drop-heading border-bottom">
                                        <div class="d-flex">
                                            <h6 class="mt-1 mb-0 fs-16 fw-semibold">You have Notification</h6>
                                            <div class="ms-auto">
                                                <span class="badge bg-success rounded-pill">3</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="notifications-menu">
                                        <a class="dropdown-item d-flex" href="chat.html">
                                            <div class="me-3 notifyimg  bg-primary-gradient brround box-shadow-primary">
                                                <i class="fe fe-message-square"></i>
                                            </div>
                                            <div class="mt-1 wd-80p">
                                                <h5 class="notification-label mb-1">New review received</h5>
                                                <span class="notification-subtext">2 hours ago</span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex" href="chat.html">
                                            <div class="me-3 notifyimg  bg-secondary-gradient brround box-shadow-primary">
                                                <i class="fe fe-mail"></i>
                                            </div>
                                            <div class="mt-1 wd-80p">
                                                <h5 class="notification-label mb-1">New Mails Received</h5>
                                                <span class="notification-subtext">1 week ago</span>
                                            </div>
                                        </a>
                                        <a class="dropdown-item d-flex" href="cart.html">
                                            <div class="me-3 notifyimg  bg-success-gradient brround box-shadow-primary">
                                                <i class="fe fe-shopping-cart"></i>
                                            </div>
                                            <div class="mt-1 wd-80p">
                                                <h5 class="notification-label mb-1">New Order Received</h5>
                                                <span class="notification-subtext">1 day ago</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a href="javascript:void(0);" class="dropdown-item text-center p-3 text-muted">View all Notification</a>
                                </div>
                            </div>
                            <!-- MESSAGE-BOX -->
                            <div class="dropdown d-md-flex profile-1">
                                <span data-bs-toggle="dropdown" class="dropdown-toggle2 d-none"></span>
                                <a href="javascript:void(0);" class="nav-link leading-none d-flex px-1" id="open_right_toggle">
                                                <span>
                                                    @if(auth()->user()->profile_picture == '')
                                                        <i class="bi bi-person avatar profile-user brround cover-image" style="background: var(--color-one);box-shadow: 0px 2px 3px #1a1a2f;font-size: 20px;display: flex;place-content: center;align-items: center;"></i>
                                                    @else
                                                        <img src="{{ url('superAdmin/images/uploaded/'.auth()->user()->profile_picture) }}" alt="profile-user" class="avatar  profile-user brround cover-image">
                                                    @endif
                                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <div class="drop-heading">
                                        <div class="text-center">

                                            <h5 class="text-dark mb-0">{{ auth()->user()->name }}</h5>
                                            <small class="text-muted">Trial</small>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item" href="{{ route('admin.view-profile') }}">
                                        <i class="dropdown-icon bi bi-person"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="javascript:void(0);">
                                        <i class="dropdown-icon bi bi-gear"></i> Settings
                                    </a>
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="dropdown-icon bi bi-box-arrow-right"></i> Log out
                                    </a>
                                    <form action="{{ route('admin.logout') }}" method="post" id="logout-form" class="d-none">@csrf</form>
                                </div>
                            </div>
                            <!-- SIDE-MENU -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /app-Header -->
