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
                        <h1 class="page-title">Dashboard</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total lotteries</h6>
                                                <h3 class="mb-2 number-font">34,516</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-primary"><i class="fa fa-chevron-circle-up text-primary me-1"></i> 3%</span> last month
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div class="counter-icon bg-primary-gradient box-shadow-primary brround ms-auto">
                                                    <i class="bi bi-stars text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total Entries</h6>
                                                <h3 class="mb-2 number-font">56,992</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-secondary"><i class="fa fa-chevron-circle-up text-secondary me-1"></i> 3%</span> last month
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div class="counter-icon bg-danger-gradient box-shadow-danger brround  ms-auto">
                                                    <i class="bi bi-people text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total emails sent</h6>
                                                <h3 class="mb-2 number-font">42,567</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-success"><i class="fa fa-chevron-circle-down text-success me-1"></i> 0.5%</span> last month
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div class="counter-icon bg-secondary-gradient box-shadow-secondary brround ms-auto">
                                                    <i class="bi bi-envelope text-white mb-5 "></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xl-3">
                                <div class="card overflow-hidden">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col">
                                                <h6 class="">Total winners</h6>
                                                <h3 class="mb-2 number-font">34,789</h3>
                                                <p class="text-muted mb-0">
                                                    <span class="text-danger"><i class="fa fa-chevron-circle-down text-danger me-1"></i> 0.2%</span> last month
                                                </p>
                                            </div>
                                            <div class="col col-auto">
                                                <div class="counter-icon bg-success-gradient box-shadow-success brround  ms-auto">
                                                    <i class="bi bi-trophy text-white mb-5 "></i>
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
            <!-- CONTAINER END -->
        </div>
    </div>
    <!--app-content end-->
@endsection
