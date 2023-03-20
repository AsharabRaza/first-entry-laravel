<!--APP-SIDEBAR-->
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('admin.home') }}" style="display: flex;place-content: center;align-items: center;">
                <img src="{{ url('superAdmin/images/logo_black_1.png') }}" class="header-brand-img desktop-logo" style="    height: 50px !important;" alt="logo">
                <img src="../assets/images/logo_white_2.png" class="header-brand-img toggle-logo" alt="logo">
                <img src="../assets/images/logo_white_2.png" class="header-brand-img light-logo" style="height: 44px !important;" alt="logo">
                <img src="../assets/images/logo_white_1.png" class="header-brand-img light-logo1" alt="logo">
            </a>
            <!-- LOGO -->
        </div>
        <div class="main-sidemenu">
            <div class="slide-left disabled" id="slide-left"><svg xmlns="http://www.w3.org/2000/svg"
                                                                  fill="#7b8191" width="24" height="24" viewBox="0 0 24 24">
                    <path d="M13.293 6.293 7.586 12l5.707 5.707 1.414-1.414L10.414 12l4.293-4.293z" />
                </svg></div>
            <ul class="side-menu">
                <li class="sub-category">
                    <h3>Main</h3>
                </li>
                <li class="slide {{ setActive(['admin/home'], 'is-expanded') }}">
                    <a class="side-menu__item dashboard_item {{ setActive('admin/home', 'active') }}" data-bs-toggle="slide" href="{{ route('admin.home') }}"><i class="side-menu__icon bi bi-house-door-fill"></i><span class="side-menu__label">Dashboard</span></a>
                </li>
                <li class="sub-category">
                    <h3>LOTTERIES</h3>
                </li>
                <li class="slide {{ setActive(['admin/home'], 'is-expanded') }}">
                    <a class="side-menu__item {{ setActive('admin/home', 'active') }}" data-bs-toggle="slide" href="all_lotteries.php"><i class="side-menu__icon bi bi-stars"></i><span class="side-menu__label">All lotteries</span></a>
                </li>
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i class="side-menu__icon bi bi-person-lines-fill"></i><span class="side-menu__label">Participants</span><i class="angle bi bi-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Participants</a></li>
                        <li><a href="all_entries.php" class="slide-item"> All entries</a></li>
                        <li><a href="all_winners.php" class="slide-item"> All winners</a></li>
                        <li><a href="all_losers.php" class="slide-item"> All losers</a></li>
                    </ul>
                </li>

                <li class="sub-category">
                    <h3>MANAGEMENT</h3>
                </li>
                <li class="slide {{ setActive(['admin/all-users','admin/in-review-users'], 'is-expanded') }}">
                    <a class="side-menu__item {{ setActive(['admin/all-users','admin/in-review-users'], 'is-expanded active') }}" data-bs-toggle="slide" href="javascript:void(0);"><i class="side-menu__icon bi bi-people-fill"></i><span class="side-menu__label">Users</span><i class="angle bi bi-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Users</a></li>
                        <li><a href="{{ route('admin.all-users') }}" class="slide-item {{ setActive('admin/all-users', 'active') }}"> All users</a></li>
                        <li><a href="{{ route('admin.in-review-users') }}" class="slide-item {{ setActive('admin/in-review-users', 'active') }}">
                                In review
                                <span class="badge bg-secondary side-badge" style="position:absolute;right: 0;top: 50%;transform: translate(-50%, -50%);">{{ $data['total_in_review_users'] ? $data['total_in_review_users'] : '' }}</span>
                            </a>
                        </li>
                        <!-- <li><a href="in_review_users.php" class="slide-item"> In Review</a></li> -->
                        {{--<li><a href="trial_users.php" class="slide-item"> Trial users</a></li>
                        <li><a href="paid_users.php" class="slide-item"> Paid users</a></li>--}}
                    </ul>
                </li>
                {{-- <li class="slide in_review_main">
                                     <a class="side-menu__item" data-bs-toggle="slide" href="in_review_users.php"><i class="side-menu__icon bi bi-person-bounding-box"></i><span class="side-menu__label">In review</span><?php if($total_in_review_users > 0){ ?><span class="badge bg-secondary side-badge"><?php echo $total_in_review_users;?></span><?php } ?></a>
                                 </li> --}}
                <li class="slide {{ setActive(['admin/paid-users','admin/assign-membership'], 'is-expanded') }}">
                    <a class="side-menu__item {{ setActive(['admin/paid-users','admin/assign-membership'], 'is-expanded active') }}" data-bs-toggle="slide" href="javascript:void(0);"><i class="side-menu__icon bi bi-person-check-fill"></i><span class="side-menu__label">Memberships</span><i class="angle bi bi-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Memberships</a></li>
                        <li><a href="{{ route('admin.paid-users') }}" class="slide-item {{ setActive('admin/paid-users', 'active') }}"> All users</a></li>
                        <li><a href="{{ route('admin.assign-membership') }}" class="slide-item {{ setActive('admin/assign-membership', 'active') }}">Assign Membership</a></li>
{{--                        <li><a href="javascript:void(0);" class="slide-item"> Settings</a></li>--}}
                    </ul>
                </li>
                <li class="sub-category not_hide">
                    <h3>ADMIN</h3>
                </li>
                <li class="slide not_hide {{ setActive(['admin/view-profile','admin/edit-profile','admin/change-password'], 'is-expanded') }}">
                    <a class="side-menu__item {{ setActive(['admin/view-profile','admin/edit-profile','admin/change-password'], 'is-expanded active') }}" data-bs-toggle="slide" href="javascript:void(0);"><i class="side-menu__icon bi bi-person"></i><span class="side-menu__label">Profile</span><i class="angle bi bi-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1 not_hide"><a href="javascript:void(0)">Profile</a></li>
                        <li class="not_hide"><a href="{{ route('admin.view-profile') }}" class="slide-item {{ setActive('admin/view-profile', 'active') }}"> View profile</a></li>
                        <li class="not_hide"><a href="{{ route('admin.edit-profile') }}" class="slide-item {{ setActive('admin/edit-profile', 'active') }}"> Edit profile</a></li>
                        <li class="not_hide"><a href="{{ route('admin.change-password') }}" class="slide-item {{ setActive('admin/change-password', 'active') }}"> Change password</a></li>
                    </ul>
                </li>

            </ul>
            <div class="slide-right" id="slide-right"><svg xmlns="http://www.w3.org/2000/svg" fill="#7b8191"
                                                           width="24" height="24" viewBox="0 0 24 24">
                    <path d="M10.707 17.707 16.414 12l-5.707-5.707-1.414 1.414L13.586 12l-4.293 4.293z" />
                </svg></div>
        </div>
    </aside>
</div>
<!--/APP-SIDEBAR-->
