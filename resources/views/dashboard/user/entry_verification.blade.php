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
                        <h1 class="page-title">Entry verification</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Event Managemnet</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Entry verification</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header" style="place-content: space-between;">
                                <div class="row w-100">
                                    <div class="col-lg-5">
                                        <h3 class="card-title">Entry verification</h3>
                                        <small>All times are in <strong>{{ 'Selected Timezone' }}</strong></small>
                                    </div>
                                    <div class="col-lg-7" style="text-align: right;">

                                        @if(getAgentsPermissions('scan_qr_code') || auth()->user()->user_type == 1)
                                            <button type="button" class="btn btn-success-light" id="scan_qr_code"><i class="bi bi-qr-code-scan"></i> Open QR Scanner</button>
                                            <button type="button" class="btn btn-danger-light" id="close_scanner" style="display: none;"><i class="bi bi-x-lg"></i> Close QR Scanner</button>
                                            <button type="button" class="btn btn-success-light" id="btn_start_barcode"><i class="bi bi-qr-code-scan"></i> Open Barcode Scanner</button>
                                            <button type="button" class="btn btn-danger-light" id="btn_close_barcode" style="display: none;"><i class="bi bi-x-lg"></i> Close Barcode Scanner</button>
                                        @endif

                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="qr_scans_wrap" style="display: none;">
                                    @if(getAgentsPermissions('scan_qr_code') || auth()->user()->user_type == 1)
                                        <video id="qr_scanner_video"></video>
                                        <div class="qr_loading_placeholder">
                                            <i class="bi bi-qr-code-scan"></i>
                                            <p class="">Loading QR Scanner...</p>
                                        </div>
                                    @endif
                                </div>
                                <div class="text-center" style="">
                                    <video id="barcode_video" style="border: 1px solid gray;width: 40%;display: none;"></video>
                                </div>

                                <div class="wd-150 mg-b-30">
                                    <div class="input-group">
                                        <div class="input-group-text text-white" style="background: var(--gray);font-weight: bold;">FE-</div>
                                        <input class="form-control" id="uid" placeholder="UID" type="text" name="uid" autocomplete="off">
                                        <button class="btn btn btn-primary" id="search_with_uid" data-type="Manual"><i class="bi bi-search"></i> Search</button>
                                    </div>
                                </div>


                                <div class="result">
                                    <div class="result_placeholder" style="min-height: 300px;">
                                        <div class="no_result">
                                            <i class="bi bi-ui-radios"></i>
                                            <p>Nothing searched yet.</p>
                                        </div>
                                        <div class="loading_placeholder" style="display: none;">
                                            <div class="text-center">
                                                <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status"></div>
                                            </div>

                                            <label for="" class="d-block text-center mt-2">Searching...</label>
                                        </div>
                                    </div>

                                    <div class="result_wrap mt-6" style="display: none;">
                                        <hr class="mb-5">
                                        <div class="alert entry-alert" style="display: none;"></div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card no-shadow">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Lottery information</h3>
                                                    </div>
                                                    <div class="card-body" style="padding-top: 0;padding-bottom: 0;">

                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="">Title:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="title"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="startDate">Event date-time:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="event_datetime"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="startDate">Guest:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="guest"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="startDate">Start date-time:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="start_datetime"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="startDate">End date-time:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="end_datetime"></p>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card no-shadow">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Entry information</h3>
                                                    </div>
                                                    <div class="card-body" style="padding-top: 0;padding-bottom: 0;">

                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="startDate">Status:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="status"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="startDate">UID:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="result_uid"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="">First name:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="first_name"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="startDate">Last name:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="last_name"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="startDate">Winner no:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="winner_no"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="startDate">Email:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="email"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="startDate">Phone:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="phone"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="startDate">Bring guest:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="bring_guest"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="startDate">G. First name:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="g_first_name"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="startDate">G. Last name:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="g_last_name"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="startDate">G. Winner no:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="g_winner_no"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group form-group2 row">
                                                            <label class="col-4 col-form-label" for="startDate">Entered date-time:</label>
                                                            <div class="col-8 d-flex align-items-center">
                                                                <p class="m-0" id="entered_datetime"></p>
                                                            </div>
                                                        </div>
                                                        <div class="form-group" id="entry_confirm_btn" style="text-align: center;margin: 12px 0;">
                                                            <button class="btn btn-primary" type="submit" id="submit_confirm_entry" data-id="" style="position: relative;">
                                                                <span style="-webkit-transition: all 0.2s;transition: all 0.2s;">Confirm entry</span>
                                                                <span style="-webkit-transition: all 0.2s;transition: all 0.2s;"><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;" role="status"></div></span>
                                                            </button>
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
                    <!-- COL END -->
                </div>
                <!-- ROW-1 END -->

            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!--app-content end-->

@endsection
@push('css')
    <style>
        .sweet-alert button.cancel {
            color: #fff !important;
            background: #dd2540 !important;
            border-color: #df2540 !important;
        }

        .result_placeholder {
            height: 100%;
            display: grid;
            align-items: center;
            place-content: center;
            text-align: center;
            min-height: 300px;
        }

        .result_placeholder i {
            font-size: 55px;
        }

        .result_placeholder p {}

        .form-group2 {
            border-bottom: 1px solid rgba(255, 255, 255, 0.12);
            margin-bottom: 0;
            padding: 6px 0 !important;
            /* margin: 0 2px !important; */
            display: flex;
        }

        .form-group2:last-child {
            border: none;
        }

        .qr_scans_wrap {
            -webkit-transition: all 0.2s;
            transition: all 0.2s;
            position: relative;
            overflow: hidden;
            text-align: center;
        }

        .qr_loading_placeholder {
            position: absolute;
            top: calc(50% - 15px);
            left: 50%;
            transform: translate(-50%, -50%);
            display: grid;
            place-content: center;
            align-items: center;
            text-align: center;
        }

        .qr_loading_placeholder p {
            margin: 0;
        }

        .qr_loading_placeholder i {
            font-size: 50px;
        }

        @media (max-width: 576px) {
            .input-icon {
                display: none;
            }
            .input-icon + .form-control {
                border-radius: 7px !important;
            }
        }
    </style>
@endpush
@push('js')

    <script>
        var entry_confirmation = '{{ route('user.entry-confirmation') }}'
        var get_uid_entries = '{{ route('user.get-uid-entries') }}'
        var user_type = '{{ auth()->user()->user_type }}';
    </script>

    <script type="text/javascript" src="https://unpkg.com/@zxing/library@latest"></script>

{{ Html::script('assets/plugin/sweet-alert/sweetalert.min.js') }}
{{ Html::script('user/js/entries.js?t='.rand(0,10000)) }}

    @if(getAgentsPermissions('scan_qr_code') || auth()->user()->user_type == 1)
        <script type="module">
            import QrScanner from '{{ url('assets/js/qr-scanner.min.js') }}';

            var videoElem = document.getElementById('qr_scanner_video');
            const qrScanner = new QrScanner(
                videoElem,
                result => setResult(result),
                {
                    highlightScanRegion: true,
                    highlightCodeOutline: true,
                }
            );

            function setResult(result){
                //console.log(result);
                var result_array = result.data.split('/');
                var scanned_uid = result_array[result_array.length - 1];
                if(String(scanned_uid).length == 13){
                    got_qr_uid(scanned_uid);
                    qrScanner.stop();
                }else if(scanned_uid == ''){
                    var scanned_uid = result_array[result_array.length - 2];
                    if(String(scanned_uid).length == 13){
                        got_qr_uid(scanned_uid);
                        qrScanner.stop();
                    }
                }
                else {
                    $('.no_result').children('p').html('QR code is not valid.');
                    $('.no_result').fadeIn();
                    qrScanner.stop();
                }
            }

            function got_qr_uid(scanned_uid){
                var uid = scanned_uid.substring(3);
                $('#uid').val(uid);
                $("#search_with_uid").attr('data-type', 'Scan QR Code');
                $("#search_with_uid").click();
                $('#close_scanner').hide();
                $('#scan_qr_code').fadeIn();

                $('.qr_scans_wrap').css({height: $(".qr_scans_wrap").height() + 'px'});
                setTimeout(function(){
                    $('.qr_scans_wrap').css({height: '0px', marginBottom: '0'});
                }, 7);
            }

            $('#scan_qr_code').click(function(){
                $('#barcode_video').hide();
                $('#btn_start_barcode').show();
                $('#btn_close_barcode').hide();
                $('#btn_close_barcode').click();

                $('.qr_loading_placeholder').fadeIn();
                var previousCss  = $(".qr_scans_wrap").attr("style");

                $(".qr_scans_wrap").css({
                    position:   'absolute', // Optional if .qr_scans_wrap is already absolute
                    visibility: 'hidden',
                    display:    'block'
                });

                var optionHeight = $(".qr_scans_wrap").height();

                $(".qr_scans_wrap").attr("style", previousCss ? previousCss : "");

                $('.qr_scans_wrap').show();
                $('.qr_scans_wrap').css({height: '0px'});
                setTimeout(function(){
                    $('#scan_qr_code').hide();
                    $('#close_scanner').fadeIn();
                    $('.qr_scans_wrap').css({height: optionHeight + 'px', marginBottom: '1rem'});
                    setTimeout(function(){
                        $('.qr_scans_wrap').css({height: ''});
                    }, 200);

                }, 0);

                setTimeout(function(){
                    qrScanner.start().then(() => {
                        $('.qr_loading_placeholder').fadeOut();
                    });
                }, 0);


                //
            });

            $('#close_scanner').click(function(){
                $('#close_scanner').hide();
                $('#scan_qr_code').fadeIn();

                qrScanner.stop();

                $('.qr_scans_wrap').css({height: $(".qr_scans_wrap").height() + 'px'});
                setTimeout(function(){
                    $('.qr_scans_wrap').css({height: '0px', marginBottom: '0'});
                }, 7);

                setTimeout(function(){
                    $('.qr_scans_wrap').css({display: 'none', marginBottom: '', height: ''});
                }, 210);
            });
        </script>

        <script>
            window.addEventListener('load', function () {
                let selectedDeviceId;
                const codeReader = new ZXing.BrowserBarcodeReader()

                codeReader.getVideoInputDevices()
                    .then((videoInputDevices) => {
                        const sourceSelect = document.getElementById('sourceSelect')
                        selectedDeviceId = videoInputDevices[0].deviceId
                        if (videoInputDevices.length > 1) {
                            videoInputDevices.forEach((element) => {
                                const sourceOption = document.createElement('option')
                                sourceOption.text = element.label
                                sourceOption.value = element.deviceId
                                sourceSelect.appendChild(sourceOption)
                            })

                            sourceSelect.onchange = () => {
                                selectedDeviceId = sourceSelect.value;
                            }

                            const sourceSelectPanel = document.getElementById('sourceSelectPanel')
                            sourceSelectPanel.style.display = 'block'
                        }

                        document.getElementById('btn_start_barcode').addEventListener('click', () => {
                            $('#barcode_video').show();
                            $('#btn_close_barcode').show();
                            $('#btn_start_barcode').hide();
                            $('.qr_scans_wrap').hide();
                            $('#scan_qr_code').show();
                            $('#close_scanner').hide();
                            $('#close_scanner').click

                            codeReader.decodeOnceFromVideoDevice(selectedDeviceId, 'barcode_video').then((result) => {
                                // document.getElementById('uid').value = result.text;
                                $('#barcode_video').hide();
                                $('#btn_start_barcode').show();
                                $('#btn_close_barcode').hide();
                                $('#uid').val(result.text);
                                $("#search_with_uid").attr('data-type', 'Scan BarCode');
                                $("#search_with_uid").click();
                                $('#btn_close_barcode').click();
                            }).catch((err) => {
                                console.error(err)
                            })
                        })

                        document.getElementById('btn_close_barcode').addEventListener('click', () => {
                            $('#barcode_video').hide();
                            $('#btn_start_barcode').show();
                            $('#btn_close_barcode').hide();
                            codeReader.reset();
                        })

                    })
                    .catch((err) => {
                        console.error(err)
                    })
            })
        </script>
    @endif

@endpush























