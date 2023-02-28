@extends('dashboard.user.layouts.template')

@section('content')
    {{--<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center">User Login Form</h1>
                <form action="{{route('user.check')}}" method="post" autocomplete="off">
                    @if(Session::get('fail'))
                        <div class="alert alert-success">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" placeholder="Enter your email">
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" value="{{ old('password') }}" placeholder="Enter your password">
                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>--}}

    <div class="login-img">
        <!-- PAGE -->
        <div class="page">
            <div class="" style="margin-top: -70px;">
                <!-- CONTAINER OPEN -->
                <div class="col col-login mx-auto">
                    <div class="text-center">
                        <img src="{{ url('user/images/logo_black_1.png') }}" style="height: 60px !important" class="header-brand-img" alt="">
                    </div>
                </div>
                <div class="container-login100">
                    <div class="wrap-login100 p-0">
                        <div class="card-body">
                            <form method="POST" action="{{route('user.check')}}" {{--id="login"--}} class="login100-form validate-form">
                                @if(Session::get('fail'))
                                    <div class="alert alert-success">
                                        {{ Session::get('fail') }}
                                    </div>
                                @endif
                                @csrf
                                <span class="login100-form-title"> Login </span>
                                <div class="alert alert-success login-alert" style="display: none;"></div>

                                <div class="wrap-input100 validate-input" data-bs-validate="Valid email is required: ex@abc.xyz">
                                    <input class="input100" type="email" name="email" id="email" value="{{ old('email') }}" placeholder="Email" required>
                                    <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="bi bi-envelope-fill"></i>
                                    </span>
                                </div>
                                <div class="wrap-input100 validate-input" data-bs-validate="Password is required">
                                    <input class="input100" type="password" name="password" id="pass" value="{{ old('password') }}" placeholder="Password" required>
                                    <span class="text-danger">@error('pass'){{ $message }}@enderror</span>
                                    <span class="focus-input100"></span>
                                    <span class="symbol-input100">
                                        <i class="bi bi-lock-fill"></i>
                                    </span>
                                </div>
                                {{--<div class="text-end pt-1">
                                    <p class="mb-0"><a href="forgot-password" class="text-primary ms-1">Forgot Password?</a></p>
                                </div>--}}
                                <div class="container-login100-form-btn">
                                    <button type="submit" class="login100-form-btn btn-primary signin_btn" id="login_btn">
                                        <span>Login</span>
                                        <span><div class="spinner-border spinner-border-sm" style="display: none;" role="status"></div></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- END PAGE -->

    </div>
@endsection
@push('css')
@endpush
@push('js')
    {{ Html::script('user/login.js?t='.rand(0,10000)) }}

@endpush
