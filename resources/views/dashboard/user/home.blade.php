
@extends('dashboard.user.layouts.template')

@section('content')
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid mb-4">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Welcome</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Welcome</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row">
                    <div class="col-md-6 mt-4  pt-2 mx-auto text-center">
                        <h1 class="text-white">Welcome to</h1>
                        <img src="{{ url('user/images/logo_black_1.png') }}" rel="icon" width="250px">
                    </div>
                </div>
                <div class="row mt-2 pt-2 welcome_sc">
                    <div class="col-md-3 h-400 bg-white-w rounded-b py-3 shadow-w">
                        <div class="profile-image d-flex justify-content-center ">
                            <img class="pimg" src="{{ url('user/images/user-dp.png') }}" rel="icon">
                        </div>
                        <div class="profile-desc">
                            <label><strong>Profile Company</strong></label>
                            <p class="border-bottom"><strong> {{ auth()->user()->company_name!='' ? auth()->user()->company_name : '-' }} </strong></p>
                            <label><strong>Profile Name</strong></label>
                            <p class="border-bottom"><strong> {{ auth()->user()->first_name!='' ? auth()->user()->first_name.' '.auth()->user()->last_name : '-' }} </strong></p>
                            <label><strong>Profile Phone Number</strong></label>
                            <p class="border-bottom"><strong> {{ auth()->user()->phone_number!='' ? auth()->user()->phone_number : '-' }} </strong></p>
                            <label><strong>Profile Usage</strong></label>
                            <p class="border-bottom"><strong> --- </strong></p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row" style="margin-right: 0px; margin-left: 0px;">
                            <div class="col-md-12 bg-white-w rounded-b px-2 py-3 shadow-w">
                                <label><strong>Support Email</strong></label>
                                <a href="mailto:support@firstentry.net"><p class="border-bottom"><strong> <?php echo 'support@firstentry.net'; ?> </strong></p></a>
                                <label><strong>Billing Email</strong></label>
                                <a href="mailto:support@firstentry.net"><p class="border-bottom mb-1"><strong> <?php echo 'billing@firstentry.net'; ?> </strong></p></a>
                            </div>
                            <div class="col-md-12 bg-white-w rounded-b px-2 py-3 my-2 shadow-w">
                                <a href="profile.php" class="text-dark-wc text-decoration-none fw-bold">Edit Profile</a><br>
                                <a href="javascript:void(0);" class="text-dark-wc text-decoration-none fw-bold">Terms and Usage</a>
                            </div>
                           {{-- <div class="col-md-12 bg-white-w rounded-b px-2 py-3 shadow-w">
                                <label><strong>Membership Type</strong></label>
                                <p class="border-bottom"><strong> <?php echo !empty($_SESSION['membership_type']) ? $_SESSION['membership_type']: '-'; ?> </strong></p>
                                <label><strong>Membership Duration</strong></label>
                                <p class="border-bottom mb-1"><strong> <?php echo !empty($_SESSION['membership_duration']) ? $_SESSION['membership_duration'].' months': '-'; ?> </strong></p>
                            </div>--}}
                        </div>
                    </div>

                </div>

            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!--app-content end-->
 {{--   <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <h1 class="text-center">Welcome User</h1>
                <a href="{{ route('user.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">logout</a>
                <form action="{{ route('user.logout') }}" method="post" id="logout-form" class="d-none">@csrf</form>
            </div>
        </div>
    </div>--}}
@endsection
@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" />
    {{ Html::style('assets/css/welcome.css') }}
    <style>
        .page-card-header {
            font-size: 25px;
            font-weight: 700;
            text-align: center;
            width: 100%;
        }

        .page-card-h {
            background-color: #6259ca !important;
            color: white !important;
            border-radius: 0.25rem !important;
        }

        .rounded-b {
            border-radius: 0.25rem !important;
        }

        .bg-white-w {
            background-color: #fff !important;
        }
        #emails_chart .apexcharts-tooltip-title {
            background: #ECEFF1!important;
        }
        #emails_chart .apexcharts-tooltip.apexcharts-theme-light {
            background: #ffffff!important;
        }
        .apexcharts-toolbar {
            background-color: black;
            background: black;
        }
        #emails_chart .apexcharts-legend-text-2{
            color: #0d0c22!important;
            font-weight: 700!important;
        }
    </style>

@endpush
@push('js')
    {{ Html::script('assets/js/apexcharts.js') }}

    <script>

        // chart_platform_emails('<?php //echo json_encode($email_platform_stats); ?>');

        function chart_platform_emails(data) {
            data = JSON.parse(data);

            /*-----echart1-----*/
            var options = {
                chart: {
                    height: 300,
                    type: "line",
                    stacked: false,
                    toolbar: {
                        enabled: false
                    },
                    dropShadow: {
                        enabled: true,
                        opacity: 0.1,
                    },
                },
                colors: ["#6259ca", "#09ad95", "#f82649"],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    curve: "smooth",
                    width: [3, 3, 3],
                    dashArray: [4, 0, 0],
                    lineCap: "round"
                },
                grid: {
                    padding: {
                        left: 0,
                        right: 0
                    },
                    strokeDashArray: 3
                },
                markers: {
                    size: 0,
                    hover: {
                        size: 0
                    }
                },
                series: [{
                    name: "Desktop",
                    type: 'line',
                    data: data.Desktop

                }, {
                    name: "Mobile",
                    type: 'line',
                    data: data.Mobile

                }, {
                    name: "Unknown",
                    type: 'line',
                    data: data.Unknown
                }, {
                    name: "WebMail",
                    type: 'line',
                    data: data.WebMail
                }],
                xaxis: {
                    type: "month",
                    categories: data.dates,
                    axisBorder: {
                        show: false,
                        color: 'rgba(119, 119, 142, 0.08)',
                    },
                    labels: {
                        style: {
                            color: '#8492a6',
                            fontSize: '12px',
                        },
                    },
                },
                yaxis: {
                    labels: {
                        style: {
                            color: '#8492a6',
                            fontSize: '12px',
                        },
                    },
                    axisBorder: {
                        show: false,
                        color: 'rgba(119, 119, 142, 0.08)',
                    },
                },
                fill: {
                    gradient: {
                        inverseColors: false,
                        shade: 'light',
                        type: "vertical",
                        opacityFrom: 0.85,
                        opacityTo: 0.55,
                        stops: [0, 100, 100, 100]
                    }
                },
                tooltip: {
                    show: false
                },
                legend: {
                    position: "bottom",
                    show: true
                }
            }
            document.querySelector("#platform_emails_chart").innerHTML = "";
            var chart = new ApexCharts(document.querySelector("#platform_emails_chart"), options);
            chart.render();
        }

        {{--/*chart_emails('<?php echo json_encode($chart_data); ?>');*/--}}

        function chart_emails(data) {
            data = JSON.parse(data);

            var options = {
                series: [{
                    name: "Opened",
                    data: data['opened']
                },
                    {
                        name: "Bounced",
                        data: data['bounced']
                    },
                    {
                        name: 'Sent',
                        data: data['sent']
                    }
                ],
                chart: {
                    height: 250,
                    type: 'line',
                    toolbar: {
                        enabled: true
                    }
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    width: [5, 7, 5],
                    curve: 'straight',
                    dashArray: [0, 8, 5]
                },
                legend: {
                    tooltipHoverFormatter: function(val, opts) {
                        return val + ' - ' + opts.w.globals.series[opts.seriesIndex][opts.dataPointIndex] + ''
                    }
                },
                markers: {
                    size: 0,
                    hover: {
                        sizeOffset: 6
                    }
                },
                xaxis: {
                    categories: data['dates'],
                },
                tooltip: {
                    y: [{
                        title: {
                            formatter: function(val) {
                                return val
                            }
                        }
                    },
                        {
                            title: {
                                formatter: function(val) {
                                    return val
                                }
                            }
                        },
                        {
                            title: {
                                formatter: function(val) {
                                    return val;
                                }
                            }
                        }
                    ]
                },
                grid: {
                    borderColor: '#f1f1f1',
                }
            };

            var chart = new ApexCharts(document.querySelector("#emails_chart"), options);
            chart.render();
            $('#emails_chart .apexcharts-legend-text').addClass('apexcharts-legend-text-2');
        }

    </script>

@endpush
