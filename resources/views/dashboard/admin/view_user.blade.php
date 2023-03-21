@extends('dashboard.admin.layouts.template')
@section('content')
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Profile</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Users</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View profile</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 OPEN -->
                <div class="row" id="user-profile">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <?php /*if($in_review == 0 && $review_approves == 0){ */?><!--
                                <div class="alert alert-danger alert-users">This account has been declined.</div>
                                <?php /*}else{
                                */?>
                                <div class="alert alert-users" style="display: none;"></div>
                                --><?php
/*                                }*/?>
                                <div class="alert alert-users" style="display: none;"></div>
                                <div class="wideget-user">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xl-6">
                                            <div class="wideget-user-desc d-sm-flex">
                                                <div class="wideget-user-img">
                                                    <img class="" src="@if($data['user']->profile_picture == NULL) {{ url('assets/images/default-avatar.jpg') }} @else {{ url('user/images/uploaded/' . $data['user']->profile_picture) }} @endif" alt="img" height="120">
                                                </div>
                                                <div class="user-wrap">
                                                    <h4>{{ $data['user']->first_name .' '. $data['user']->last_name }}</h4>
                                                    <h6 class="text-muted mb-3">Member since: {{ $data['user']->created_at }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-xl-6">
                                            <div class="text-xl-right mt-4 mt-xl-0 p_right_buttons">
                                                @if($data['user']->in_review == 1)
                                                    <div class="btn-group" style="margin-right: 2px;">
                                                        <a class="btn btn-info badge" href="#" data-bs-placement="left" data-bs-toggle="tooltip-info" title="Approve" id="approve_request" data-id="{{ $data['user']->id }}" data-email="{{ $data['user']->email }}" data-fullname="{{ $data['user']->first_name .' '. $data['user']->last_name }}"><i class="bi bi-check-lg"></i><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;" role="status"></div></a>

                                                        <a class="btn btn-info badge" href="#" data-bs-placement="top" data-bs-toggle="tooltip-info" title="Decline" id="decline_request" data-id="{{ $data['user']->id }}" data-email="{{ $data['user']->email }}" data-fullname="{{ $data['user']->first_name .' '. $data['user']->last_name }}"><i class="bi bi-x-lg"></i><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;" role="status"></div></a>
                                                    </div>
                                                @endif

                                                <a href="{{ route('admin.editUserProfile',['user_id'=>$data['user']->id]) }}" class="btn btn-primary">Edit Profile</a>
                                            </div>
                                            <div class="mt-5">
                                                <div class="main-profile-contact-list float-lg-end d-lg-flex row" style="width: 100%;">
                                                    <div class="col-6 col-md-4 me-5">
                                                        <div class="media">
                                                            <div class="media-icon bg-primary me-3 mt-1" style="display: flex;place-content: center;align-items: center;">
                                                                <i class="bi bi-star-fill fs-20 text-white" ></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <span class="text-muted">Lotteries</span>
                                                                <div class="fw-semibold fs-25">
                                                                    <?php /*echo $lottery_count; */?>
                                                                    {{ '0' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-4 me-5 mt-5 mt-md-0">
                                                        <div class="media">
                                                            <div class="media-icon bg-success me-3 mt-1" style="display: flex;place-content: center;align-items: center;">
                                                                <i class="bi bi-people-fill fs-20 text-white"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <span class="text-muted">Entries</span>
                                                                <div class="fw-semibold fs-25">
                                                                    <?php /*echo $entry_count; */?>
                                                                        {{ '0' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-4 me-0 mt-5 mt-md-0">
                                                        <div class="media">
                                                            <div class="media-icon bg-orange me-3 mt-1" style="display: flex;place-content: center;align-items: center;">
                                                                <i class="bi bi-envelope-fill fs-20 text-white"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <span class="text-muted">Emails sent</span>
                                                                <div class="fw-semibold fs-25">
                                                                    <?php /*echo $email_sending_count; */?>
                                                                        {{ '0' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="wideget-user-tab">
                                    <div class="tab-menu-heading">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab-51">
                                <div id="profile-log-switch">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media-heading">
                                                <h4><strong>Personal Information</strong></h4>
                                            </div>
                                            <div class="table-responsive p_data">
                                                <table class="table row table-borderless">
                                                    <tbody class="col-lg-12 col-xl-6 p-0">
                                                    <tr>
                                                        <td><strong>Full Name :</strong> {{ $data['user']->first_name .' '. $data['user']->last_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Company :</strong> {{ $data['user']->company_name }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Company Size :</strong> {{ $data['user']->company_size }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Features or functions you are looking for? :</strong>
                                                            @if($data['user']->custom_features_functions == NULL)
                                                                {{ $data['user']->features_functions }}
                                                            @else
                                                                {{ $data['user']->custom_features_functions }}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                    <tbody class="col-lg-12 col-xl-6 p-0">
                                                    <tr>
                                                        <td><strong>Website or Social link :</strong>
                                                            @php
                                                            $url = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
                                                            $string = preg_replace($url, '<a href="https://$4" target="_blank" title="$0">$0</a>', $data['user']->website);
                                                            echo $string;
                                                            @endphp
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Email :</strong> {{ $data['user']->email }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><strong>Phone :</strong> {{ $data['user']->phone }} </td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row profie-img">
                                                <div class="col-md-12">
                                                    <div class="media-heading">
                                                        <h5><strong>About projects : </strong></h5>
                                                    </div>
                                                    <p>
                                                        {{ $data['user']->about_projects }}
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- COL-END -->
                </div>
                <!-- ROW-1 CLOSED -->
            </div>
        </div>
    </div>
@endsection
@push('css')
    <style>
        .p_data a {
            color: #dedefd;
            text-decoration: underline;
        }
        .main-profile-contact-list .col-6 {
            margin-right: 0 !important;
            margin-top: 0 !important;
            margin-bottom: 26px !important;
        }
        @media (max-width: 576px) {
            .wideget-user-desc, .p_right_buttons, .wideget-user-img {
                text-align: center;
            }

            .wideget-user-img {
                width: 100% !important;
            }

            .wideget-user-desc .user-wrap {
                margin-left: 0 !important;
            }

            .wideget-user-desc .wideget-user-img img {
                margin: auto !important;
            }


        }
    </style>
@endpush
@push('js')
    <script>
        $(document).ready(function(){
            $("input").attr("autocomplete", "off");
        });
    </script>
    <script>
        $(function(e) {
            $('#responsive-datatable').DataTable({
                "iDisplayLength": 50,
                scrollX: "100%",
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                }
            });

            var tooltip_primary = $('[data-bs-toggle="tooltip-primary"]');
            for (let index = 0; index < tooltip_primary.length; index++) {
                var tooltip = new bootstrap.Tooltip(tooltip_primary[index], {
                    template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
                });
            }
            var tooltip_info = $('[data-bs-toggle="tooltip-info"]');
            for (let index = 0; index < tooltip_info.length; index++) {
                var tooltip = new bootstrap.Tooltip(tooltip_info[index], {
                    template: '<div class="tooltip tooltip-info" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
                });
            }
            var tooltip_danger = $('[data-bs-toggle="tooltip-danger"]');
            for (let index = 0; index < tooltip_danger.length; index++) {
                var tooltip = new bootstrap.Tooltip(tooltip_danger[index], {
                    template: '<div class="tooltip tooltip-danger" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
                });
            }
        });
    </script>

@endpush


