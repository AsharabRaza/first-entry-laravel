@extends('dashboard.admin.layouts.template')
@section('content')

    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Edit User profile</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Managemnet</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Profile</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit user profile</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header" style="place-content: space-between;">
                                <h3 class="card-title">Modify user profile information</h3>
                                <small>Last updated: <strong>{{ $data['user']->updated_at }}</strong></small>
                            </div>
                            <form id="edit_profile_form" method="POST" style="display: inline-grid;">
                                @if(Session::get('fail'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('fail') }}
                                    </div>
                                @elseif(Session::get('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                <input type="hidden" name="user_id" id="user_id" value="{{ $data['user']->id }}">
                                <div class="card-body">

                                    <div class="alert edit_profile_alert" style="display: none;"></div>
                                    <div class="row">
                                        <div class="wideget-user-desc d-sm-flex" style="display: flex;place-content: center;align-items: center;margin-bottom: 10px;">
                                            <div class="wideget-user-img">
                                                <img class="" height="100" style="margin: 0;" src=" @if($data['user']->profile_picture == NULL) {{ url('assets/images/default-avatar.jpg') }} @else {{ 'user/images/' . $data['user']->profile_picture }} @endif " alt="img">
                                            </div>
                                        </div>
                                        <div class="user-wrap mb-4">
                                            <h4 id="full_name" class="text-center">{{ $data['user']->first_name .' '. $data['user']->last_name }}</h4>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="first_name">First name</label>
                                                <input type="text" class="form-control" id="first_name" onkeyup="set_full_name();" name="first_name" value="{{ $data['user']->first_name }}" placeholder="Enter here..." required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="last_name">Last name</label>
                                                <input type="text" class="form-control" id="last_name" onkeyup="set_full_name();" name="last_name" value="{{ $data['user']->last_name }}" placeholder="Enter here..." required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $data['user']->phone }}" placeholder="Enter here..." required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="text" class="form-control" id="email" name="email" value="{{ $data['user']->email }}" placeholder="Enter here..." disabled required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="company_name">Company name</label>
                                                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $data['user']->company_name }}" placeholder="Enter here..." required>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="company_size">Company size</label>
                                                <select class="form-control select2 form-select" id="company_size" name="company_size" required>
                                                    <option value="">Size</option>
                                                    <option value="1 - 5" @if($data['user']->company_size == '1 - 5') {{ 'selected' }} @endif>1 - 5</option>
                                                    <option value="6 - 50" @if($data['user']->company_size == '6 - 50') {{ 'selected' }} @endif>6 - 50</option>
                                                    <option value="51 - 100" @if($data['user']->company_size == '51 - 100') {{ 'selected' }} @endif>51 - 100</option>
                                                    <option value="101 - 200" @if($data['user']->company_size == '101 - 200') {{ 'selected' }} @endif>101 - 200</option>
                                                    <option value="201 - 500" @if($data['user']->company_size == '201 - 500') {{ 'selected' }} @endif>201 - 500</option>
                                                    <option value="501 - 1000" @if($data['user']->company_size == '501 - 1000') {{ 'selected' }} @endif>501 - 1000</option>
                                                </select>
                                                <span class="text-danger">@error('company_size'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label" for="about_projects">About projects</label>
                                        <textarea class="form-control" rows="4" id="about_projects" name="about_projects" placeholder="Enter here..." required>{{ $data['user']->about_projects }}</textarea>
                                        <span class="text-danger">@error('about_projects'){{ $message }}@enderror</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="website_or_social">Website or Social link</label>
                                                <input type="text" class="form-control" id="website_or_social" name="website_or_social" value="{{ $data['user']->website }}" placeholder="URL" required>
                                                <span class="text-danger">@error('website_or_social'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="features_or_functions">Features or functions you are looking for?</label>
                                                <select class="form-control select2 form-select" id="features_or_functions" name="features_or_functions" required>
                                                    <option value="">Features or functions</option>
                                                    <option value="Lottery" @if($data['user']->features_functions == 'Lottery') {{ 'selected' }} @endif>Lottery</option>
                                                    <option value="Attendance" @if($data['user']->features_functions == 'Attendance') {{ 'selected' }} @endif>Attendance</option>
                                                    <option value="Organizing events" @if($data['user']->features_functions == 'Organizing events') {{ 'selected' }} @endif>Organizing events</option>
                                                    <option value="Special functions" @if($data['user']->features_functions == 'Special functions') {{ 'selected' }} @endif>Special functions - custom</option>
                                                </select>
                                                <span class="text-danger">@error('features_or_functions'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12"></div>
                                        <div class="col-lg-6 col-md-12">
                                            <input type="text" class="form-control @if($data['user']->features_functions != 'Special functions') {{ 'd-none' }} @endif" id="please_specify_custom" name="please_specify_custom" value="{{ $data['user']->custom_features_functions }}" placeholder="Please specify" >
                                            <span class="text-danger">@error('please_specify_custom'){{ $message }}@enderror</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit" id="update_btn" style="float: right;position: relative;">
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

    {{--<div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Edit User profile</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Admin</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">All Users</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add User</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header" style="place-content: space-between;">
                                <h3 class="card-title">Edit User</h3>
                                <small>Last updated: <strong></strong></small>
                            </div>
                            <form id="add_edit_form" method="POST" action="{{ route('admin.editUser') }}">
                                @if(Session::get('fail'))
                                    <div class="alert alert-danger">
                                        {{ Session::get('fail') }}
                                    </div>
                                @elseif(Session::get('success'))
                                    <div class="alert alert-success">
                                        {{ Session::get('success') }}
                                    </div>
                                @endif
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="full_name">First Name</label>
                                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $data['user']->first_name }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('first_name'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $data['user']->last_name }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('last_name'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ $data['user']->email }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ $data['user']->phone }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" value="" placeholder="Enter here...">
                                                <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="confirm_password">Confirm Password</label>
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="" placeholder="Enter here...">
                                                <span class="text-danger">@error('password_confirmation'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="company_name">Company Name</label>
                                                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ $data['user']->company_name }}" placeholder="Enter here...">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="event">Login Event</label>
                                                <select class="form-control" name="login_event" id="login_event">
                                                    <option value="select" {{ $data['user']->login_event == 'select' ? 'selected' : '' }}>Select</option>
                                                    <option value="1" {{ $data['user']->login_event == '1' ? 'selected' : '' }}>Lottery</option>
                                                    <option value="2" {{ $data['user']->login_event == '2' ? 'selected' : '' }}>Movie Premiere</option>
                                                </select>
                                                <span class="text-danger">@error('login_event'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="email_limit">Email Limit</label>
                                                <input type="number" class="form-control" id="email_limit" name="email_limit" value="{{ $data['user']->email_limit }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('email_list'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="event_limit">Event Limit</label>
                                                <input type="number" class="form-control" id="event_limit" name="event_limit" value="{{ $data['user']->event_limit }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('email_limit'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="start_date">Start Date</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ $data['user']->start_date }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('start_date'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="event_limit">End Ddate</label>
                                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ $data['user']->end_date }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('end_date'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                    <input type="hidden" name="user_id" value="{{ $data['user']->id }}">
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit" id="">
                                        <span>Save</span>
                                        --}}{{--<span><div class="spinner-border spinner-border-sm" role="status"></div></span>--}}{{--
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
    </div>--}}
@endsection
@push('css')
@endpush
@push('js')
    {{ Html::script('superAdmin/js/edit_user_profile.js') }}
    {{ Html::script('assets/plugin/sweet-alert/sweetalert.min.js') }}



    <script>
        var edit_user_profile = '{{ route('admin.editUserProfile') }}';

        $(document).ready(function(){
            $("input").attr("autocomplete", "off");
        });
        var submit_profile = @if($data['user']->in_review == null) {{ 'true' }} @else {{ 'false' }} @endif;

        function set_full_name(){
            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            $('#full_name').html(first_name + ' ' + last_name);
        }

    </script>

@endpush



