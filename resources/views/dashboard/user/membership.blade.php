{{--@php
    dd(auth()->user());
@endphp--}}

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
                        <h1 class="page-title">Membership</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Membership</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->
                <div class="tab-content">
                    <div class="tab-pane active show" id="tab-51">
                        <div id="profile-log-switch">
                            <div class="card">
                                <div class="card-body">

                                    @if(isset($membershipInfo['subscription']) && $membershipInfo['subscription'] == false)
                                        <h1 class="text-danger text-center m10">You Don't Have Any Subscription Now</h1>
                                        <a href="../index.php#pricing"><button class="btn btn-success m-auto d-flex">Buy Package</button></a>
                                    @elseif(isset($membershipInfo['expire']) && $membershipInfo['expire'] == true)
                                        <h1 class="text-danger text-center m10">Your Package Expired</h1>
                                        <a href="../index.php#pricing"><button class="btn btn-success m-auto d-flex">Renew Package</button></a>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTAINER END -->
        </div>
    </div>

    <!--app-content end-->

@endsection
@push('css')
@endpush
@push('js')
@endpush
