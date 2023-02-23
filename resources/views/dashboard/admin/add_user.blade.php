@extends('dashboard.admin.layouts.template')
@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Add User</h1>
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
                                <h3 class="card-title">Add User</h3>
                                <small>Last updated: <strong></strong></small>
                            </div>
                            <form id="add_edit_form" method="POST" action="{{ route('admin.addUser') }}">
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
                                                <input type="text" class="form-control" id="first_name" name="first_name" value="{{ old('first_name') }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('first_name'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" class="form-control" id="last_name" name="last_name" value="{{ old('last_name') }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('last_name'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="phone">Phone</label>
                                                <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="password">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="confirm_password">Confirm Password</label>
                                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" value="{{ old('confirm_password') }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('password_confirmation'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="company_name">Company Name</label>
                                                <input type="text" class="form-control" id="company_name" name="company_name" value="{{ old('company_name') }}" placeholder="Enter here...">
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="event">Login Event</label>
                                                <select class="form-control" name="login_event" id="login_event">
                                                    <option value="select" {{ old('login_event') == 'select' ? 'selected' : '' }}>Select</option>
                                                    <option value="1" {{ old('login_event') == '1' ? 'selected' : '' }}>Lottery</option>
                                                    <option value="2" {{ old('login_event') == '2' ? 'selected' : '' }}>Movie Premiere</option>
                                                </select>
                                                <span class="text-danger">@error('login_event'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="email_limit">Email Limit</label>
                                                <input type="number" class="form-control" id="email_limit" name="email_limit" value="{{ old('email_limit') }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('email_list'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="event_limit">Event Limit</label>
                                                <input type="number" class="form-control" id="event_limit" name="event_limit" value="{{ old('event_limit') }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('email_limit'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        {{--<div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="start_date">Start Date</label>
                                                <input type="date" class="form-control" id="start_date" name="start_date" value="{{ old('start_date') }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('start_date'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="event_limit">End Ddate</label>
                                                <input type="date" class="form-control" id="end_date" name="end_date" value="{{ old('end_date') }}" placeholder="Enter here...">
                                                <span class="text-danger">@error('end_date'){{ $message }}@enderror</span>
                                            </div>
                                        </div>--}}
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit" id="">
                                        <span>Save</span>
                                        {{--<span><div class="spinner-border spinner-border-sm" role="status"></div></span>--}}
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
@endpush
@push('js')
    <script>
        $(document).ready(function(){
            $("input").attr("autocomplete", "off");
        });
    </script>

@endpush


