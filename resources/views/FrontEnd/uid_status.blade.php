<!doctype html>
<html lang="en" dir="ltr">
<head>
    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="#">
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('FrontEnd/images/favicon.ico') }}" />
    <title>First Entry</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css">
    {{ Html::style('assets/plugin/bootstrap/css/bootstrap.min.css') }}
    {{ Html::style('assets/css/style.css') }}
    {{ Html::style('assets/css/skin-modes.css') }}
    {{ Html::style('assets/css/transparent-style.css') }}
    {{ Html::style('assets/colors/color1.css') }}

    {{ Html::style('assets/css/dark-style.css') }}


    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ url('assets/colors/color1.css') }}" />
    <script>
        var js_url = '{{ url('/') }}';
    </script>

</head>
<body class="dark-mode">
{{ Html::script('assets/js/jquery.min.js') }}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<style>
    .bg-img {
        background-size: cover;
        background-position: top left;
        background-repeat: no-repeat;
        background-attachment: fixed;
        height: 100%;
        position: absolute;
        width: 100%;
        /* filter: blur(8px);
        -webkit-filter: blur(8px); */
        transform: translate3d(0, 0, 0);
    }
    .login-img {
        opacity: 0.9;
        /*background: linear-gradient(0deg, #4b6cb7 0%, #182848 100%) !important;
        background: linear-gradient(to top, #26D0CE, #1A2980) !important;*/
        /* background: linear-gradient(to top, #057877, #1A2980) !important;*/
        min-height: 100vh;
        background: transparent !important;
    }

    .lottery_title {
        text-transform: uppercase;
        margin-bottom: 6px !important;
    }

    .lottery_date {
        text-decoration: underline;
        text-transform: uppercase;
    }

    .lottery_info {
        padding-bottom: 30px;
        position: relative;
    }

    .terms_conditions_wrap {
        font-size: 90%;
    }

    .overlay_card {
        position: absolute;
        right: -141px;
        top: 50%;
        width: 204%;
        /* height: 100%; */
        transform: translateY(-50%);
    }

    .overlay_card .card {
        /* height: calc(100% + 100px); */
        width: 345px;
        /* background: #524747 !important; */
        background: #fff;
        /* color: #000; */
        background: #6259ca;
    }

    .lottery_how_it_works {
        white-space: inherit;
        line-height: 24px !important;
    }

    .lottery_how_it_works ul, .lottery_how_it_works ol {
        padding-left: 0 !important;
    }

    .btn-facebook {
        color: #fff;
        background-color: #17A9FD;
        border-color: #17A9FD;
    }

    .select2-container .select2-selection--single {
        height: 45px !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        height: 100% !important;
        display: flex;
        align-items: center;
    }

    .dark-mode .select2-container--default .select2-selection--single .select2-selection__arrow, .dark-mode .select2-container--default.select2-container--focus .select2-selection--multiple, .select2-container .select2-selection--multiple {
        height: 100% !important;
    }

    /* Chrome, Safari, Edge, Opera */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    /* Firefox */
    input[type=number] {
        -moz-appearance: textfield;
    }

    @media (max-width: 576px) {
        .lottery_title {
            font-size: 22px;
        }
        .lottery_date {
            font-size: 16px;
        }
        .last_name_col {
            padding-left: 0 !important;
        }
    }
    .iti--allow-dropdown {
        width: 100%;
    }
</style>


<!-- BACKGROUND-IMAGE -->
<div class="login-img">
    <!-- PAGE -->
    <div class="page">
        <div class="" style="margin-top: -70px;">
            <!-- CONTAINER OPEN -->
            <div class="col col-login mx-auto">
                <div class="text-center">
                    <img src="{{ url('superAdmin/images/logo_black_1.png') }}" style="height: 60px !important" class="header-brand-img" alt="">
                </div>
            </div>
            <div class="container-login100">
                <div class="wrap-login100 p-0">
                    <div class="card-body">
                        <form method="POST" action="" id="uid_form" class="login100-form validate-form" autocomplete="off">
                            @csrf
                            <span class="login100-form-title">Search with UID</span>
                            <p class="text-muted text-center" id="desc">Provide your UID to get your information</p>
                            <div class="alert alert-success forgot-alert" style="display: none;"></div>

                            <div class="wrap-input100 validate-input" id="email_wrap">
{{--                                <input class="input100" type="text" name="uid" id="uid" value="<?php if(isset($_GET['uid']) && $_GET['uid'] != ''){echo $_GET['uid'];}?>" placeholder="UID" required>--}}
                                <input class="input100" type="text" name="uid" id="uid" value="{{ request()->segment(2) ? request()->segment(2) : ''  }}" placeholder="UID" required>
                                <span class="focus-input100"></span>
                                <span class="symbol-input100">
	                                        <i class="bi bi-123"></i>
	                                    </span>
                            </div>

                            <div class="container-login100-form-btn">
                                <button type="submit" class="login100-form-btn btn-primary signin_btn" id="find_btn">
                                    <span id="btn_text">Search</span>
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
<!-- BACKGROUND-IMAGE CLOSED -->


{{ Html::script('assets/plugin/sweet-alert/sweetalert.min.js') }}
{{ Html::script('assets/plugin/select2/select2.full.min.js') }}
{{ Html::script('assets/plugin/time-picker/jquery.timepicker.js') }}
{{ Html::script('assets/plugin/date-picker/date-picker.js') }}
{{ Html::script('assets/plugin/date-picker/jquery-ui.js') }}
{{ Html::script('assets/js/custom.js') }}


<script type="text/javascript">

    var find_uid = '{{ route('uid-status') }}';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

{{ Html::script('FrontEnd/js/easy.qrcode.js') }}
{{ Html::script('FrontEnd/js/canvas2svg.js') }}
{{ Html::script('FrontEnd/js/lotteries.js?t='.rand(0,1000)) }}
{{ Html::script('assets/plugin/bootstrap/js/popper.min.js',array('media'=>'all','rel'=>'stylesheet')) }}
{{ Html::script('assets/plugin/bootstrap/js/bootstrap.min.js') }}
{{ Html::script('FrontEnd/js/circle-progress.min.js') }}
{{ Html::script('assets/plugin/p-scroll/perfect-scrollbar.js') }}
{{ Html::script('FrontEnd/js/themeColors.js') }}
{{ Html::script('FrontEnd/js/custom.js') }}
<script>

    $(document).ready(function(){
        @php
            $segment = request()->segment(2);

        @endphp
        @if($segment)
        $('#uid_form').submit();
        @endif
    });

</script>

</body>
</html>

















