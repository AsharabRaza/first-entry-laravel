<!doctype html>
<html lang="en" dir="ltr">
<head>
    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <base href="#">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('FrontEnd/images/favicon.ico') }}" />

    <!-- TITLE -->
    <title>First Entry</title>

    <!-- BOOTSTRAP CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.3/font/bootstrap-icons.min.css">
    {{ Html::style('assets/plugin/bootstrap/css/bootstrap.min.css') }}
    {{ Html::style('assets/css/style.css') }}
    {{ Html::style('assets/css/skin-modes.css') }}
    {{ Html::style('assets/css/transparent-style.css') }}
    {{ Html::style('assets/colors/color1.css') }}

    <!--- FONT-ICONS CSS -->
    <!--<link href="assets/css/icons.css" rel="stylesheet"/>-->

    <!-- COLOR SKIN CSS -->
    <link id="theme" rel="stylesheet" type="text/css" media="all" href="{{ url('assets/colors/color1.css') }}" />
    <script>
        var js_url = '{{ url('/') }}';
    </script>

</head>
<body class="dark-mode">

<!-- GLOABAL LOADER -->
{{--<div id="global-loader">
    <img src="<?php echo IMAGES ?>loader.svg" class="loader-img" alt="Loader">
</div>--}}

{{ Html::script('assets/js/jquery.min.js') }}

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<style>
    <?php
        /*
		// PHP code embedded in following class
        if($background_image != ''){
            echo "background: url('".IMAGES."media/".$background_image."');";
        }else{
            echo "background: url('".IMAGES."media/lottery-bg.jpeg');";
        }
		 */
        ?>
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


    .new_counter {
        display: inline-block;
        line-height: 1;
        padding: 20px;
        font-size: 40px;
    }

    .count-span {
        display: block;
        font-size: 20px;
        color: white;
    }

    #days {
        font-size: 100px;
        color: #db4844;
    }
    #hours {
        font-size: 100px;
        color: #f07c22;
    }
    #minutes {
        font-size: 100px;
        color: #f6da74;
    }
    #seconds {
        font-size: 50px;
        color: #abcd58;
    }
    .body-counter-css{
        font-family: 'Titillium Web', cursive;
        width: 800px;
        margin: 0 auto;
        text-align: center;
        color: white;
        background: #222;
        font-weight: 100;
    }

</style>


<!-- BACKGROUND-IMAGE -->
<div class=""></div>
<div class="">
    <!-- PAGE -->
    <div class="container">
        <div class="">
            <!-- CONTAINER OPEN -->

            <div class="col col-login mx-auto mb-2">
                <div class="text-center mt-2 mb-3">
                    <img src="{{ url('assets/images/logo_black_2.png') }}" class="header-brand-img" alt="">
                </div>
            </div>
            <div class="col">
                @php
                    $entriesPerEvent = 0;
                    $countEntries = $data['countEntries'];
                    $countEntries = 1;
                    //$c_time = convert_timezone_in_UTC(date('Y-m-d H:i:s'), 'Y-m-d H:i:s');
                    //$current_datetime = convert_timezone_new(date('Y-m-d H:i:s'), config('app.timezone'), $data['lottery']->timezone, 'd-m-Y h:i A');
                    //$current_datetime = date('Y-m-d H:i:s');
                    $current_datetime = date('d-m-Y h:i A');
                    $test_times = date('d-m-Y h:i A');
                    /*echo "Current Time = ". $test_times;
                    echo "<br>";*/

                    //dd($data['lottery']);

                    //dd($data['lottery']);

                    //$start_datetime = date('d-m-Y h:i A', strtotime($data['lottery']->start_datetime));
                    //$end_datetime = date('d-m-Y h:i A', strtotime($data['lottery']->end_datetime));
                    //$start_datetime = convert_timezone_new($data['lottery']->start_datetime_utc, 'UTC',$data['lottery']->timezone, 'd-m-Y h:i A');
                    //$end_datetime = convert_timezone_new($data['lottery']->end_datetime_utc, 'UTC',$data['lottery']->timezone, 'd-m-Y h:i A');
                    $start_datetime = convert_timezone_new($data['lottery']->start_datetime_utc, 'UTC',$data['lottery']->timezone, 'd-m-Y h:i A');
                    /*echo 'Start Time = '; print_r($start_datetime);
                    echo "<br>";*/


                    $date = DateTime::createFromFormat('d-m-Y h:i A', $start_datetime);
                    $count_date_format = $date->format('d F Y H:i:s');

                    $date_string = date('d-m-Y h:i A');
                    $date = \Carbon\Carbon::createFromFormat('d-m-Y h:i A', $date_string, config('app.timezone'));
                    $current_date_format = $date->format('D M d Y H:i:s \G\M\TO (T)');

                  /*  echo $current_date_format;



                    echo "<br>";*/

                    //$start = '2023-04-17 09:22:00';
                    //$end = '2023-04-17 10:00:00';

                    /*$time_difference = getTimeDifference($current_datetime, $start_datetime);
                    echo 'Time Difference = '. $time_difference;*/

                    //echo (strtotime($test_times) - strtotime($start_datetime));
                    $end_datetime = convert_timezone_new($data['lottery']->end_datetime_utc, 'UTC',$data['lottery']->timezone, 'd-m-Y h:i A');
                    $date_created = date('d-m-Y h:i A', strtotime($data['lottery']->date_created));
                    $form_customization = unserialize($data['lottery']->form_customization);
                    /*echo $current_datetime." < ";
                    echo $start_datetime;die;*/
                @endphp


                @if(strtotime($current_datetime) < strtotime($start_datetime))

                    <div class="bg-dark alert alert-success mb-0 mt-4 lottery_alert text-center col-md-6" role="alert" style="margin: auto;">
                        <span class="alert-inner--icon"><i class="bi bi-info-circle"></i></span>
                        <span class="alert-inner--text">This lottery has not started yet. Coming soon.</span>
                    </div>

                    <div class="col-md-8 mx-auto mt-6 body-counter-css">
                        {{--<div class="count-down row">
                            <div class="col-6 col-xl-3 col-md-6 countdown mb-6 mb-xl-0">
                                <span class="days text-primary ">00</span>
                                <span class="text-dark">Days</span>
                            </div>
                            <div class="col-6 col-xl-3 col-md-6 countdown mb-6 mb-xl-0">
                                <span class="hours text-primary me-3">00</span>
                                <span class="text-dark">Hrs</span>
                            </div>

                            <div class="col-6 col-xl-3 col-md-6 countdown mb-6 mb-xl-0">
                                <span class="minutes text-primary">00</span>
                                <span class="text-dark">Mins</span>
                            </div>
                            <div class="col-6 col-xl-3 col-md-6 countdown ">
                                <span class="seconds text-primary">00</span>
                                <span class="text-dark">Secs</span>
                            </div>
                        </div>--}}
                        <div id="timer" class="new_counter">
                            <table cellpadding="16" cellspacing="16">
                                <tr>
                                    <td><div id="days"></div></td>
                                    <td><div id="hours"></div></td>
                                    <td><div id="minutes"></div></td>
                                    <td><div id="seconds"></div></td>
                                </tr>
                            </table>

                        </div>

                    </div>
                    {{--@php
                        $entriesPerEvent = 0;
                        $countEntries = $data['countEntries'];
                        $countEntries = 1;
                        $current_datetime = date('d-m-Y h:i A');
                        $start_datetime = date('d-m-Y h:i A', strtotime($data['lottery']->start_datetime));
                        $end_datetime = date('d-m-Y h:i A', strtotime($data['lottery']->end_datetime));
                        $start_datetime = convert_timezone_new($data['lottery']->start_datetime_utc, 'UTC',$data['lottery']->timezone, 'd-m-Y h:i A');
                        $end_datetime = convert_timezone_new($data['lottery']->end_datetime_utc, 'UTC',$data['lottery']->timezone, 'd-m-Y h:i A');
                        $date_created = date('d-m-Y h:i A', strtotime($data['lottery']->date_created));
                        $form_customization = unserialize($data['lottery']->form_customization);
                    @endphp--}}
                @php

                    //$start_datetime = date('Y-m-d h:i:s',strtotime($data['lottery']->start_datetime));
                    //$start_datetime = convert_timezone_new($data['lottery']->start_datetime_utc, config('app.timezone'),$data['lottery']->timezone, 'd-m-Y h:i A');
                    //dd($start_datetime);
                   //$new =  convert_timezone_new($data['lottery']->start_datetime,$data['lottery']->timezone,$data['lottery']->timezone);
                  // dd(formatted_date($start_datetime));
                    //dd($data['lottery']->timezone);
                    //dd(formatted_date($start_datetime));
                @endphp

                    {{ Html::script('assets/plugin/countdown/moment.min.js') }}
                    {{ Html::script('assets/plugin/countdown/moment-timezone.min.js') }}
                    {{ Html::script('assets/plugin/countdown/moment-timezone-with-data.min.js') }}
                    {{ Html::script('assets/plugin/countdown/countdowntime.js') }}

                    <script>
                       /* $( function() {
                            $('.count-down').countdown100({
                                endtimeYear: 0,
                                endtimeMonth: 0,
                                endtimeDate: 1,
                                endtimeHours: 0,
                                endtimeMinutes: 0,
                                endtimeSeconds: 0,
                                timeZone: "",
                                timeZone2: "{{ $data['lottery']->timezone }}",
                                fullEndDateTime: '{{ formatted_date($start_datetime) }}',
                                reloadPage: true
                            });
                        });*/

                       function makeTimer() {

                           // var endTime = new Date("29 April 2018 9:56:00 GMT+01:00");
                           //var endTime = new Date("18 April 2023 20:55:00");
                           var endTime = new Date("{{ $count_date_format }}");
                           endTime = (Date.parse(endTime) / 1000);

                           var now = new Date();
                           now = now.toLocaleString("en-US", {timeZone: "America/Los_Angeles"});
                           now = new Date(now);
                          // var now = "{{ $current_date_format }}";
                          // var now = "Mon Apr 17 2023 11:40:00 GMT-0700 (PDT)";
                           //var now = "Mon Apr 17 2023 23:23:01 GMT+0500 (Pakistan Standard Time)";
                           //alert(now);
                           now = (Date.parse(now) / 1000);

                           var timeLeft = endTime - now;

                           var days = Math.floor(timeLeft / 86400);
                           var hours = Math.floor((timeLeft - (days * 86400)) / 3600);
                           var minutes = Math.floor((timeLeft - (days * 86400) - (hours * 3600 )) / 60);
                           var seconds = Math.floor((timeLeft - (days * 86400) - (hours * 3600) - (minutes * 60)));

                           if (hours < "10") { hours = "0" + hours; }
                           if (minutes < "10") { minutes = "0" + minutes; }
                           if (seconds < "10") { seconds = "0" + seconds; }

                           $("#days").html(days + "<span class='count-span'>Days</span>");
                           $("#hours").html(hours + "<span class='count-span'>Hours</span>");
                           $("#minutes").html(minutes + "<span class='count-span'>Minutes</span>");
                           $("#seconds").html(seconds + "<span class='count-span'>Seconds</span>");

                       }

                       setInterval(function() { makeTimer(); }, 1000);






                    </script>

                @elseif($entriesPerEvent > $countEntries)

                    <h1 class="text-center text-warning">Maximum number of events reached!</h1>

                @elseif(strtotime($current_datetime) >= strtotime($start_datetime) && strtotime($current_datetime) <= strtotime($end_datetime))

                    <div class="col-md-12">
                    <div class="card" style="box-shadow: rgba(0, 0, 0, 0.16) 0px 10px 36px 0px, rgba(0, 0, 0, 0.06) 0px 0px 0px 1px;">
                        <div class="card-body">
                            @if($data['lottery']->header_image != '')
                                <div class="text-center mb-4">
                                    <img src="{{ url('assets/images/media/'.$data['lottery']->header_image) }}" class="header-brand-img" style="height: 200px!important;" alt="">
                                </div>
                            @endif
                            <h2 class="text-center lottery_title">{{ htmlspecialchars($data['lottery']->title) }}</h2>
                            <div class="lottery_description mt-5">
                                {!! unserialize($data['lottery']->description) !!}
                            </div>
                            <br>
                            <div>
                                <h3>How it works:</h3>
                                <div class="lottery_how_it_works ql-editor" style="padding: 0 !important;">
                                    {!! unserialize($data['lottery']->how_it_works) !!}
                                </div>
                            </div>
                            <br>
                            <div class="lottery_info">
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="POST" id="lotteries_form">
                                            <input type="hidden" value="{{ $data['lottery']->id }}" id="lottery_id" name="lottery_id">
                                            <input type="hidden" value="{{ $data['lottery']->title }}" id="lottery_title" name="lottery_title">
                                            <!--<h3>Fill up the form:</h3>-->
                                            <div class="alert alert-success lottery-alert" style="display: none;"></div>
                                            <div class="wrap-input100 form-group sign-group icon-center mb-4">
                                                <div class="row">
                                                    <label class="form-label" style="margin-left: 1px;">Name (must match legal name on ID) <span class="text-red">&#42;</span></label>
                                                    <div class="col">
                                                        <input class="input100" type="text" name="first_name" id="first_name" placeholder="First name" required="">
                                                        <span class="focus-input100"></span>
                                                        <span class="symbol-input100" style="padding-left: 25px;">
                                                                <i class="bi bi-person-fill"></i>
                                                            </span>
                                                    </div>
                                                    <div class="col last_name_col">
                                                        <input class="input100" type="text" name="last_name" id="last_name" placeholder="Last name" style="padding-left: 12px;" required="">
                                                        <span class="focus-input100"></span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="wrap-input100 form-group sign-group icon-center mb-4">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="form-label" style="margin-left: 1px;">Email <span class="text-red">&#42;</span></label>
                                                        <div class="wrap-input100 validate-input">
                                                            <input class="input100" type="email" name="email" id="email" placeholder="Email" required="">
                                                            <span class="focus-input100"></span>
                                                            <span class="symbol-input100">
                                                                    <i class="bi bi-envelope-fill"></i>
                                                                </span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label class="form-label" style="margin-left: 1px;">Phone <span class="text-red">&#42;</span></label>
                                                        <div class="wrap-input100 validate-input">
                                                            <input type="hidden" name="phone_code" id="phone_code" value="+1" />
                                                            <input class="input100 form-control" type="tel" name="phone" id="phone" placeholder="Phone" required="">
                                                            <!-- <span class="focus-input100"></span> -->
                                                            <!-- <span class="symbol-input100">
                                                                <i class="bi bi-telephone-fill"></i>
                                                            </span> -->
                                                            <div class="invalid-feedback" id="" style="position: absolute;">Must be 10 digits number.</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="wrap-input100 form-group sign-group icon-center mb-4 {{ $form_customization == false ? 'd-none' : '' }} ">
                                                <div class="row">
                                                    @if($form_customization != '' && $form_customization != NULL)
                                                        @foreach($form_customization as $key => $value)
                                                            <div class="col-md-6" style="{{ $value['selected_input_field'] == 'datetime_input' ? 'padding-right: 0;' : '' }}">
                                                                <label class="form-label" style="margin-left: 1px;">{!! htmlspecialchars($value['input_label']) !!} {!! $value['input_condition'] == 'required' ? '<span class="text-red">&#42;</span>' : '' !!}</label>
                                                                @if($value['selected_input_field'] == 'text_input')
                                                                    <div class="wrap-input100 validate-input mb-4">
                                                                        <input class="input100 form-control" type="text" name="custom_inputs_val[]" data-type="text_input" data-label="{!! htmlspecialchars(addslashes($value['input_label'])) !!}" id="" placeholder="{!! htmlspecialchars($value['input_label']) !!}" style="padding-left: 12px;" {{ $value['input_condition'] == 'required' ? 'required' : '' }} >
                                                                    </div>
                                                                @elseif($value['selected_input_field'] == 'selection_input')
                                                                    <div class="wrap-input100 validate-input mb-4" style="{!! $value['multi_selection'] == '1' ? 'height: 40px;' : '' !!} ">
                                                                        <select class="form-control select2" name="custom_inputs_val[]" data-type="selection_input" data-label="{!! htmlspecialchars(addslashes($value['input_label'])) !!}" {{ $value['input_condition'] == 'required' ? 'required' : '' }} {{ $value['multi_selection'] == '1' ? 'multiple' : '' }}>
                                                                            @if($value['multi_selection'] == '1')
                                                                            @elseif($value['multi_selection'] == '0')
                                                                                <option value="">Select {{ strtolower($value['input_label']) }}</option>
                                                                            @endif
                                                                            @if(count($value['selection_items_select']) > 0)
                                                                               @foreach($value['selection_items_select'] as $key2 => $value2)
                                                                                    <option value="{{ $value2 }}">{{ $value2 }}</option>
                                                                               @endforeach
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                @elseif($value['selected_input_field'] == 'datetime_input')
                                                                    <div class="wrap-input100 validate-input mb-4 row">
                                                                        <div class="input-group col-7" style="padding-right: 5px;">
                                                                            <input class="form-control fc-datepicker" id="" data-type="datetime_input" data-type2="date" style="height: 45px;" data-label="{{ htmlspecialchars(addslashes($value['input_label'])) }}" name="custom_inputs_val[]" placeholder="DD-MM-YYYY" type="text" {{ $value['input_condition'] == 'required' ? 'required' : '' }} >
                                                                        </div>
                                                                        <div class="input-group col-5" style="padding-right: 0px;">
                                                                            <input class="form-control timepicker" id="" name="custom_inputs_val[]" data-type="datetime_input" style="height: 45px;" data-label="{{ htmlspecialchars(addslashes($value['input_label'])) }}" data-type2="time" placeholder="00:00 AM" type="text" {{ $value['input_condition'] == 'required' ? 'required' : '' }} autocomplete="off">
                                                                        </div>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>



                                            <div class="form-group mb-4" style="display: none;" id="guest_">
                                                <div class="form-label">Do you intend to bring a guest? <span class="text-red">&#42;</span></div>
                                                <div class="custom-controls-stacked">
                                                    <label class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" name="bring_guest" value="1" {{ $data['lottery']->allow_guest == 0 ? '' : 'required' }}>
                                                        <span class="custom-control-label">Yes</span>
                                                    </label>
                                                    <label class="custom-control custom-radio">
                                                        <input type="radio" class="custom-control-input" name="bring_guest" value="0" {{ $data['lottery']->allow_guest == 0 ? 'checked' : 'required' }} >
                                                        <span class="custom-control-label">No</span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div class="wrap-input100 form-group sign-group icon-center mb-4 d-none" id="bring_guest_wrap">
                                                <div class="row">
                                                    <label class="form-label" style="margin-left: 1px;">Guest's Name <span class="text-red">&#42;</span></label>
                                                    <div class="col">
                                                        <input class="input100" type="text" name="guest_first_name" id="guest_first_name" placeholder="First name">
                                                        <span class="focus-input100"></span>
                                                        <span class="symbol-input100" style="padding-left: 25px;">
                                                                <i class="bi bi-person-fill"></i>
                                                            </span>
                                                    </div>
                                                    <div class="col last_name_col">
                                                        <input class="input100" type="text" name="guest_last_name" id="guest_last_name" placeholder="Last name" style="padding-left: 12px;">
                                                        <span class="focus-input100"></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group mb-3">
                                                <div class="form-label">Terms & Conditions <span class="text-red">&#42;</span></div>
                                                <label class="custom-switch">
                                                    <input type="checkbox" name="terms_conditions_chekbox" class="custom-switch-input" value="1" required>
                                                    <span class="custom-switch-indicator"></span>
                                                    <span class="" style="margin-left: 0.5rem;">I agree to the following:</span>
                                                </label>
                                            </div>
                                            <div class="terms_conditions_wrap">
                                                {!! unserialize($data['lottery']->terms_conditions) !!}
                                            </div>

                                            <label class="form-label" style="margin-left: 1px;">Captcha <span class="text-red">&#42; <img src="{{ route('captcha',['get'=>true]) }}" id="captcha_img" alt="" style="margin-left: 6px;"></span></label>
                                            <div class="wrap-input100 validate-input mb-4">
                                                <input class="input100 form-control" type="text" name="captcha" id="captcha" placeholder="Captcha" required="">
                                                <span class="focus-input100"></span>
                                                <span class="symbol-input100">
                                                        <i class="bi bi-123"></i>
                                                    </span>
                                                <div class="invalid-feedback" id="" style="position: absolute;">Invalid CAPTCHA.</div>
                                            </div>

                                            <div class="container-login100-form-btn">
                                                <button type="submit" class="login100-form-btn btn-info signin_btn" id="submit_btn">
                                                    <span>Submit</span>
                                                    <span><div class="spinner-border spinner-border-sm" style="display: none;" role="status"></div></span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div id="genqrcode" class="d-none" style="display: none;"></div>
                            </div>
                        </div>
                    </div>
                </div>

                @elseif(strtotime($current_datetime) > strtotime($end_datetime))

                    <div class="bg-dark alert alert-danger mb-0 mt-4 lottery_alert text-center col-md-6" role="alert" style="margin: auto;">
                        <span class="alert-inner--icon"><i class="bi bi-info-circle"></i></span>
                        <span class="alert-inner--text">We are no longer accepting entries for this event.</span>
                    </div>

                @endif

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

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<!-- Tooltip and Popover JS -->
<script>
    var captcha = '{{ route('captcha') }}';
    var save_lottery_form = '{{ route('save-lottery-form') }}';
    var save_s_qrcode = '{{ route('save-s_qrcode',['s_qrcode'=>true]) }}';
    var tooltip_primary = $('[data-bs-toggle="tooltip-primary"]');
    for (let index = 0; index < tooltip_primary.length; index++) {
        var tooltip = new bootstrap.Tooltip(tooltip_primary[index], {
            template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
        });
    }
    var tooltip_info = $('[data-bs-toggle="tooltip-info"]');
    for (let index = 0; index < tooltip_info.length; index++) {
        var tooltip = new bootstrap.Tooltip(tooltip_info[index], {
            template: '<div class="tooltip tooltip-info" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
        });
    }
    var tooltip_danger = $('[data-bs-toggle="tooltip-danger"]');
    for (let index = 0; index < tooltip_danger.length; index++) {
        var tooltip = new bootstrap.Tooltip(tooltip_danger[index], {
            template: '<div class="tooltip tooltip-danger" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
        });
    }
</script>

<script>
    {!! $data['lottery']->allow_guest == 1 ? '$("#guest_").css("display","inline");' : '' !!}
    var website_url = '{{ url('/') }}';
    var URL_ = '{{ url('/') }}';
    $('.select2').select2({
        minimumResultsForSearch: 10
    });
    // Datepicker
    $('.fc-datepicker').datepicker({
        dateFormat: 'dd-mm-yy',
        showOtherMonths: true,
        selectOtherMonths: true
    });
    $('.timepicker').timepicker({
        timeFormat: 'h:i A'
    });

    var phone_input = $('#phone');
    var phint = intlTelInput(phone_input.get(0))

    // listen to the telephone input for changes
    phone_input.on('countrychange', function(e) {
        // change the hidden input value to the selected country code
        $('#phone_code').val('+'+phint.getSelectedCountryData().dialCode);
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


</body>
</html>

















