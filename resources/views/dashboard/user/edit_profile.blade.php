@extends('dashboard.user.layouts.template')
@section('content')

    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Edit profile</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Managemnet</a></li>
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
                                <small>Last updated: <strong>{{ formatted_date($data['user']->updated_at). 'selected timezone' }}</strong></small>
                            </div>
                            <form id="edit_profile_form" method="POST" style="display: inline-grid;">
                                <div class="card-body">
                                    {{--@if($data['user']->user_type == 1)
                                       @if($data['user']->in_review == NULL)
                                           <div class="alert alert-warning">Please update your profile information so we can start reviewing your profile.</div>
                                       @elseif($data['user']->in_review == 1)
                                           <div class="alert alert-success">We've received your request and we are processing it. Please be patient, we will update you soon.</div>
                                       @elseif($data['user']->in_review == 0 && $data['user']->review_approves)
                                           <div class="alert alert-danger">Your request has been declined. Please contact support for any questions.</div>
                                       @elseif($data['user']->review_approves == 1 && $data['user']->review_msg_seen == 0)
                                           <div class="alert alert-success">Congratulations! Your request has been approved.</div>
                                       @endif
                                    @endif--}}
                                    <div class="alert edit_profile_alert" style="display: none;"></div>
                                    <div class="row">
                                        <div class="wideget-user-desc d-sm-flex" style="display: flex;place-content: center;align-items: center;margin-bottom: 10px;">
                                            <div class="wideget-user-img">
                                                <img class="" height="100" style="margin: 0;" src="{{ $data['user']->profile_picture=='' ? url('assets/images/default-avatar.jpg') : url('user/images/uploaded/'.$data['user']->profile_picture) }}" alt="img">
                                            </div>
                                        </div>
                                        <div class="user-wrap mb-4">
                                            <h4 id="full_name" class="text-center">{{ $data['user']->first_name . $data['user']->last_name }}</h4>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="first_name">First name</label>
                                                <input type="text" class="form-control" id="first_name" onkeyup="set_full_name();" name="first_name" value="{{ $data['user']->first_name }}" placeholder="Enter here..." @if(($data['user']->in_review == 1 || ($data['user']->in_review != NULL && $data['user']->review_approves == 0))) {{ 'disabled' }} @endif required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="last_name">Last name</label>
                                                <input type="text" class="form-control" id="last_name" onkeyup="set_full_name();" name="last_name" value="{{ $data['user']->last_name }}" placeholder="Enter here..." @if(($data['user']->in_review == 1 || ($data['user']->in_review != NULL && $data['user']->review_approves == 0))) {{ 'disabled' }} @endif required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $data['user']->phone }}" placeholder="Enter here..." @if(($data['user']->in_review == 1 || ($data['user']->in_review != NULL && $data['user']->review_approves == 0))) {{ 'disabled' }} @endif required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" id="email" name="email" value="{{ $data['user']->email }}" placeholder="Enter here..." disabled required>
                                            </div>
                                        </div>
                                    </div>
                                    @if($data['user']->user_type == 1)
                                        <div class="row">
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="company_name">Company name</label>
                                                    <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $data['user']->company_name }}" placeholder="Enter here..." @if(($data['user']->in_review == 1 || ($data['user']->in_review != NULL && $data['user']->review_approves == 0))) {{ 'disabled' }} @endif required>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12">
                                                <div class="form-group">
                                                    <label for="company_size">Company size</label>
                                                    <select class="form-control select2 form-select" id="company_size" name="company_size" @if(($data['user']->in_review == 1 || ($data['user']->in_review != NULL && $data['user']->review_approves == 0))) {{ 'disabled' }} @endif required>
                                                        <option value="">Size</option>
                                                        <option value="1 - 5" @if($data['user']->company_size == '1 - 5') {{ 'selected' }} @endif>1 - 5</option>
                                                        <option value="6 - 50" @if($data['user']->company_size == '6 - 50') {{ 'selected' }} @endif>6 - 50</option>
                                                        <option value="51 - 100" @if($data['user']->company_size == '51 - 100') {{ 'selected' }} @endif>51 - 100</option>
                                                        <option value="101 - 200" @if($data['user']->company_size == '101 - 200') {{ 'selected' }} @endif>101 - 200</option>
                                                        <option value="201 - 500" @if($data['user']->company_size == '201 - 500') {{ 'selected' }} @endif>201 - 500</option>
                                                        <option value="501 - 1000" @if($data['user']->company_size == '501 - 1000') {{ 'selected' }} @endif>501 - 1000</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="form-group">
                                        <label class="form-label" for="about_projects">About @if($data['user']->user_type == 1) {{ 'projects' }} @elseif($data['user']->user_type == 2) {{ 'me' }} @endif</label>
                                        <textarea class="form-control" rows="4" id="about_projects" name="about_projects" placeholder="Enter here..." @if(($data['user']->in_review == 1 || ($data['user']->in_review != NULL && $data['user']->review_approves == 0))) {{ 'disabled' }} @endif required>{{ $data['user']->about_projects }}</textarea>
                                    </div>

                                    <div class="row">
                                        @if($data['user']->user_type == 1)
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="website_or_social">Website or Social link</label>
                                                <input type="text" class="form-control" id="website_or_social" name="website_or_social" value="{{ $data['user']->website }}" placeholder="URL" @if(($data['user']->in_review == 1 || ($data['user']->in_review != NULL && $data['user']->review_approves == 0))) {{ 'disabled' }} @endif required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="features_or_functions">Features or functions you are looking for?</label>
                                                <select class="form-control select2 form-select" id="features_or_functions" name="features_or_functions" @if(($data['user']->in_review == 1 || ($data['user']->in_review != NULL && $data['user']->review_approves == 0))) {{ 'disabled' }} @endif required>
                                                    <option value="">Features or functions</option>
                                                    <option value="Lottery" @if($data['user']->features_functions == 'Lottery') {{ 'selected' }} @endif>Lottery</option>
                                                    <option value="Attendance" @if($data['user']->features_functions == 'Attendance') {{ 'selected' }} @endif>Attendance</option>
                                                    <option value="Organizing events" @if($data['user']->features_functions == 'Organizing events') {{ 'selected' }} @endif>Organizing events</option>
                                                    <option value="Special functions" @if($data['user']->features_functions == 'Special functions') {{ 'selected' }} @endif>Special functions - custom</option>
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-lg-6 col-md-12"></div>
                                        <div class="col-lg-6 col-md-12">
                                            <input type="text" class="form-control {{ $data['user']->features_functions != 'Special functions' ? 'd-none' : '' }}" id="please_specify_custom" name="please_specify_custom" value="{{ $data['user']->custom_features_functions }}" placeholder="Please specify" @if(($data['user']->in_review == 1 || ($data['user']->in_review != NULL && $data['user']->review_approves == 0) || ($data['user']->in_review != NULL && $data['user']->review_approves == 1))) {{ 'disabled' }} @endif>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit" id="update_btn" style="float: right;position: relative;" @if(($data['user']->in_review == 1 || ($data['user']->in_review != NULL && $data['user']->review_approves == 0))) {{ 'disabled' }} @endif >
                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;">{{ ($data['user']->in_review == NULL && $data['user']->user_type == 1) ? 'Submit' : 'Update' }} </span>
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
    <!--app-content end-->

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
    <script>
        var update_profile = '{{ route('user.edit-profile') }}';
    </script>
    <!-- FORMEDITOR JS -->
    {{ Html::script('assets/plugin/sweet-alert/sweetalert.min.js') }}

    <script>
        @if($data['user']->review_approves == 1 && $data['user']->review_msg_seen == 0)
            setTimeout(function(){
                swal('Congratulations!', 'Your account has been approved.', 'success');
            }, 500);
        @endif

        var submit_profile = '{{ ($data['user']->in_review == NULL && $data['user']->user_type == 1) ? 'true' : 'false' }}';

        function set_full_name(){
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            $('#full_name').html(first_name + ' ' + last_name);
        }
    </script>

    {{ Html::script('user/js/edit_profile.js?t='.rand(0,10000)) }}

@endpush


