@extends('dashboard.user.layouts.template')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center">Welcome User</h1>
                <a href="{{ route('user.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">logout</a>
                <form action="{{ route('user.logout') }}" method="post" id="logout-form" class="d-none">@csrf</form>
            </div>
        </div>
    </div>
@endsection
