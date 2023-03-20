{{--<style>

    @if(auth()->user()->user_type == 1)
        @if(auth()->user()->in_review == 1 || auth()->user()->review_approves == 0)
            .side-menu li:not(.not_hide) {
                display: none !important;
            }
        @endif
    @endif

</style>--}}
<!--APP-SIDEBAR-->
<div class="sticky">
    <div class="app-sidebar__overlay" data-bs-toggle="sidebar"></div>
    <aside class="app-sidebar">
        <div class="side-header">
            <a class="header-brand1" href="{{ route('user.home') }}" style="display: flex;place-content: center;align-items: center;">
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
            <ul class="side-menu" style="padding-bottom: 50px;">
                @if(auth()->user()->user_type==1)
                <li class="slide not_hide {{ setActive(['user/home'], 'is-expanded') }}" style="margin-top: 1.5rem !important;">
                    <a class="side-menu__item dashboard_item {{ setActive('user/home', 'active') }}" data-bs-toggle="slide" href="{{ route('user.home') }}"><i class="side-menu__icon bi bi-house-door"></i><span class="side-menu__label">Dashboard</span></a>
                </li>
                <!--
                <li class="slide">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i class="side-menu__icon bi bi-graph-up-arrow"></i><span class="side-menu__label">Analytics</span><i class="angle bi bi-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1"><a href="javascript:void(0)">Analytics</a></li>
                        <li><a href="lottery_analytics.php" class="slide-item"> Lottery Analytics</a></li>
                        <li><a href="email_analytics.php" class="slide-item"> Email Analytics</a></li>
                    </ul>
                </li>
                -->
                @endif
                @if(auth()->user()->user_type==1)
                    <li class="sub-category">
                        <h3>EVENT LOTTERIES</h3>
                    </li>
                    <li class="slide not_hide {{ setActive(['user/events'], 'is-expanded') }}">
                        <a class="side-menu__item {{ setActive('user/events', 'active') }}" data-bs-toggle="slide" href="{{ route('user.events') }}"><i class="side-menu__icon bi bi-stars"></i><span class="side-menu__label">Landing Page</span></a>
                    </li>
                    <li class="slide not_hide {{ setActive(['user/all-lotteries'], 'is-expanded') }}">
                        <a class="side-menu__item {{ setActive('user/all-lotteries', 'active') }}" data-bs-toggle="slide" href="{{ route('user.all-lotteries') }}"><i class="side-menu__icon bi bi-stars"></i><span class="side-menu__label">All lotteries</span></a>
                    </li>
                    <li class="slide {{ setActive(['user/all-entries','user/all-winners','user/all-losers'], 'is-expanded') }}">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i class="side-menu__icon bi bi-people"></i><span class="side-menu__label">Entries</span><i class="angle bi bi-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Entries</a></li>
                            <li><a href="{{ route('user.all-entries') }}" class="slide-item {{ setActive('user/all-entries', 'active') }}"> All entries</a></li>
                            <li><a href="{{ route('user.all-winners') }}" class="slide-item {{ setActive('user/all-winners', 'active') }}"> Selected entries</a></li>
                            <li><a href="{{ route('user.all-losers') }}" class="slide-item {{ setActive('user/all-losers', 'active') }}"> Non-selected entries</a></li>
                        </ul>
                    </li>
                    <li class="slide {{ setActive(['user/email-history','user/send-emails'], 'is-expanded') }}">
                        <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i class="side-menu__icon bi bi-envelope"></i><span class="side-menu__label">Emails</span><i class="angle bi bi-chevron-right"></i></a>
                        <ul class="slide-menu">
                            <li class="side-menu-label1"><a href="javascript:void(0)">Emails</a></li>
                            <li><a href="{{ route('user.email-history') }}" class="slide-item {{ setActive('user/email-history', 'active') }}"> History</a></li>
                            <li><a href="{{ route('user.send-emails') }}" class="slide-item {{ setActive('user/send-emails', 'active') }}"> Send emails</a></li>
                        </ul>
                    </li>

                @endif


                <li class="sub-category not_hide">
                    <h3>Verifications</h3>
                </li>
                @if(auth()->user()->user_type==1)
                    <li class="slide not_hide {{ setActive(['user/agents-history'], 'is-expanded') }}">
                        <a class="side-menu__item {{ setActive('user/agents-history', 'active') }}" data-bs-toggle="slide" href="{{ route('user.agents-history') }}"><i class="side-menu__icon bi bi-menu-button"></i><span class="side-menu__label">Live entry process</span></a>
                    </li>
                @endif
                <li class="slide not_hide {{ setActive(['user/entry-verification'], 'is-expanded') }}">
                    <a class="side-menu__item {{ setActive('user/entry-verification', 'active') }}" data-bs-toggle="slide" href="{{ route('user.entry-verification') }}"><i class="side-menu__icon bi bi-patch-check"></i><span class="side-menu__label">Verify entry</span></a>
                </li>
                <li class="sub-category not_hide">
                    <h3>MANAGEMENT</h3>
                </li>
                @if(auth()->user()->user_type==1)
                <li class="slide not_hide {{ setActive(['user/all-agents','user/agents-history','user/add-agent'], 'is-expanded') }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i class="side-menu__icon bi bi-person-workspace"></i><span class="side-menu__label">Agents</span><i class="angle bi bi-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1 not_hide"><a href="javascript:void(0)">Agents</a></li>
                        <li class="not_hide"><a href="{{ route('user.all-agents') }}" class="slide-item {{ setActive('user/all-agents', 'active') }}"> All agents</a></li>
                        <li class="not_hide"><a href="{{ route('user.agents-history') }}" class="slide-item {{ setActive('user/agents-history', 'active') }}"> Agents history</a></li>
                        <li class="not_hide"><a href="{{ route('user.add-agent') }}" class="slide-item {{ setActive('user/add-agent', 'active') }}"> Add agent</a></li>
                    </ul>
                </li>
                @endif
                <li class="slide not_hide {{ setActive(['user/view-profile','user/edit-profile','user/change-password'], 'is-expanded') }}">
                    <a class="side-menu__item" data-bs-toggle="slide" href="javascript:void(0);"><i class="side-menu__icon bi bi-person"></i><span class="side-menu__label">Profile</span><i class="angle bi bi-chevron-right"></i></a>
                    <ul class="slide-menu">
                        <li class="side-menu-label1 not_hide"><a href="javascript:void(0)">Profile</a></li>
                        <li class="not_hide"><a href="{{ route('user.view-profile') }}" class="slide-item {{ setActive('user/view-profile', 'active') }}"> View profile</a></li>
                        <li class="not_hide"><a href="{{ route('user.edit-profile') }}" class="slide-item {{ setActive('user/edit-profile', 'active') }}"> Edit profile</a></li>
                        <li class="not_hide"><a href="{{ route('user.change-password') }}" class="slide-item {{ setActive('user/change-password', 'active') }}"> Change password</a></li>
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
