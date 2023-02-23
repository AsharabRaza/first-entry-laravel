@extends('dashboard.admin.layouts.template')

@section('content')
    {{--<div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center">Admin Login Form</h1>
                <form action="{{route('admin.check')}}" method="post" autocomplete="off">
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
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <div class="screen__content__text">
                    <h3>Log In</h3>
                </div>
                <div class="screen__content__logo" style="text-align: right;">
                    <a href=""><img src="{{ url('superAdmin/images/logo_black_1.png') }}" style="width: 55px !important;" alt="Logo" /></a>
                </div>
                <form action="{{route('admin.check')}}" class="login" method="post" autocomplete="off">
                    @if(Session::get('fail'))
                        <div class="alert alert-danger">
                            {{ Session::get('fail') }}
                        </div>
                    @endif
                    @csrf
                    <div class="login__field">
                        <i class="login__icon bi bi-person-fill"></i>
                        <input type="email" id="email" class="login__input" value="{{ old('email') }}" name="email" placeholder="Email"><br>
                        <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                    </div>
                    <div class="login__field">
                        <i class="login__icon bi bi-lock-fill"></i>
                        <input type="password" class="login__input" value="{{ old('password') }}" name="password" placeholder="Password" id="pass"><br>
                        <span class="showpass" style="cursor: pointer;"><i class="bi bi-eye-fill " id="togglePassword"></i></span>
                        <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                    </div>
                    <button class="button login__submit" id="submit_btn">
                        <span class="button__text">Log In</span>
                        <span style="margin-left: 125px;display: flex;align-items: center;">
                                    <i class="button__icon bi bi-chevron-right" style="cursor: pointer;font-weight: bold;"></i>
                                    <div class="spinner-border spinner-border-sm" style="display: none;" role="status"></div>
                                </span>
                    </button>

                </form>
            </div>
            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
@endsection
@push('css')
    {{ HTML::style('superAdmin/css/admin_login.css') }}
@endpush
@push('js')
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#pass');

        togglePassword.addEventListener('click', function (e) {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('bi-eye-slash-fill');
        });
    </script>
@endpush
