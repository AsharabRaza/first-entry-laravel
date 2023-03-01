<!-- app-Header -->
<div class="app-header header sticky">
    <div class="container-fluid main-container">
        <div class="d-flex align-items-center">
            <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar" href="javascript:void(0);"></a>
            <div class="responsive-logo">
                <a href="index.php" class="header-logo" style="display: flex;place-content: center;align-items: center;top: 8px;">
                    <img src="../assets/images/logo_white_1.png" style="height: 60px;" class="mobile-logo logo-1" alt="logo">
                    <img src="../assets/images/logo_black_1.png" style="height: 50px !important;" class="mobile-logo dark-logo-1" alt="logo">
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
                            <!-- Theme-Layout -->

                            <div class="dropdown d-md-flex notifications">
                                <a class="nav-link icon" data-bs-toggle="dropdown"><i class="bi bi-bell"></i><span class=" pulse"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow ">
                                    <div class="drop-heading border-bottom">
                                        <div class="d-flex">
                                            <h6 class="mt-1 mb-0 fs-16 fw-semibold">Notifications</h6>
                                            <div class="ms-auto">
                                                <span class="badge bg-success rounded-pill">0</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="notifications-menu">
                                        <h5 class="mt-2 text-center"><i>Coming soon</i></h5>
                                    </div>
                                </div>
                            </div>
                            <!-- MESSAGE-BOX -->
                            <div class="dropdown d-md-flex profile-1">
                                <span data-bs-toggle="dropdown" class="dropdown-toggle2 d-none"></span>
                                <a href="javascript:void(0);" class="nav-link leading-none d-flex px-1" id="open_right_toggle">
                                                <span>
                                                    <i class="bi bi-person avatar profile-user brround cover-image" style="background: #30304d;box-shadow: 0px 2px 3px #1a1a2f;font-size: 20px;display: flex;place-content: center;align-items: center;"></i>
                                        {{--            <?php
                                                    if($_SESSION['normal_profile_picture'] == ''){
                                                    ?>
                                                        <i class="bi bi-person avatar profile-user brround cover-image" style="background: #30304d;box-shadow: 0px 2px 3px #1a1a2f;font-size: 20px;display: flex;place-content: center;align-items: center;"></i>
                                                        <?php
                                                    }else{
                                                    ?>
                                                        <img src="../assets/images/users/<?php echo $_SESSION['normal_profile_picture'];?>" alt="profile-user" class="avatar  profile-user brround cover-image">
                                                        <?php
                                                    }
                                                    ?>--}}
                                                    </span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end dropdown-menu-arrow" id="right_dropdown">
                                    <div class="drop-heading">
                                        <div class="text-center">
                                            <h5 class="text-dark mb-0">{{ auth()->user()->first_name.' '.auth()->user()->last_name }}</h5>
                                            <small class="text-muted"></small>
                                        </div>
                                    </div>
                                    <div class="dropdown-divider m-0"></div>
                                    <a class="dropdown-item" href="profile.php">
                                        <i class="dropdown-icon bi bi-person"></i> Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('user.logout') }}">
                                        <i class="dropdown-icon bi bi-box-arrow-right"></i> Log out
                                    </a>
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
