@extends('dashboard.admin.layouts.template')
@section('content')

    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Edit profile</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Profile</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit profile</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header" style="place-content: space-between;">
                                <h3 class="card-title">Modify profile information</h3>
                                <small>Last updated: <strong>{{ $data['admin']->updated_at }}</strong></small>
                            </div>
                            <form id="edit_profile_form" method="POST" style="display: inline-grid;">
                                <div class="card-body">
                                    <div class="alert edit_profile_alert" style="display: none;"></div>
                                    <div class="row">
                                        <div class="wideget-user-desc d-sm-flex" style="display: flex;place-content: center;align-items: center;margin-bottom: 10px;">
                                            <div class="wideget-user-img">
                                                @php
                                                    if($data['admin']->profile_picture == '')
                                                        {
                                                            $image = url('assets/images/default-avatar.jpg');
                                                        }
                                                        else
                                                        {
                                                            $image = url('assets/superAdmin/images/').$data['admin']->profile_picture;
                                                        }
                                                @endphp
                                                <img class="" height="100" style="margin: 0;" src="{{ $image }}" alt="img">
                                            </div>
                                        </div>
                                        <div class="user-wrap mb-4">
                                            <h4 id="full_name2" class="text-center">{{ $data['admin']->name }}</h4>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="full_name">Full Name</label>
                                                <input type="text" class="form-control" id="full_name" name="full_name" value="{{ $data['admin']->name }}" placeholder="Enter here..." required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" id="email" name="email" value="{{ $data['admin']->email }}" placeholder="Enter here..." required disabled>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit" id="update_btn" style="float: right;position: relative;" >
                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;">Update</span>
                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;"><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;" role="status"></div></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- COL END -->
                </div>
                <!-- ROW-1 END -->

            </div>
            <!-- CONTAINER END -->
        </div>
    </div>

@endsection
@push('css')
    <style>
        .sweet-alert button.cancel {
            color: #fff !important;
            background: #dd2540 !important;
            border-color: #df2540 !important;
        }

        @media (max-width: 576px) {
            .input-icon {
                display: none;
            }
            .input-icon + .form-control {
                border-radius: 7px !important;
            }
        }
    </style>
@endpush
@push('js')
    {{ Html::script('superAdmin/js/edit_profile.js?t='.rand(0,1000)) }}
    <script>
        var edit_profile = '{{ route('admin.edit-profile') }}';
    </script>
@endpush


