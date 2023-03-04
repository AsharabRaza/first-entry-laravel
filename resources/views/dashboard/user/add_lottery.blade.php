@extends('dashboard.user.layouts.template')

@section('content')
    @php
        $tooltip_status = 1;
        $tooltip_primary = 'data-bs-toggle="tooltip-primary"';
        $form_customization_tooltip  = $tooltip_primary.' title="This area will allow you to customize the form lottery participants will fill in." ';
        $email_custimization_tooltip = $tooltip_primary.' title="This area allow you to customize the emails your participants will receive." ';
        $title_tooltip   = $tooltip_primary.' title="Title will appear on the front end web page, your participants will view." ';
        $url_tooltip     = $tooltip_primary.' title="This will be your custom web page name firstentry.net/lotteryurl" ';
        $winners_tooltip = $tooltip_primary.' title="This is the amount of winners to be chosen from all of your entries" ';
        $event_date_tooltip = $tooltip_primary.' title="This area defines the date and time of the event." ';
        $guest_tooltip = $tooltip_primary.' title="Allow the entry participant to bring in a guest." ';
        $lott_agent_tooltip = $tooltip_primary.' title="Add you agents under the Veritcal tab under, management, agents, add agent." ';
        $lott_status_tooltip = $tooltip_primary.' title="Lottery must be activated allow agents to verify entries - WARNING - only one lottery can be active at a time for verification purposes." ';
        $country_tooltip = $tooltip_primary.' title="Choose the country of the place the lottery will be held." ';
        $timezone_tooltip = $tooltip_primary.' title="Choose the timezone of the place the lottery will be held." ';
        $start_datetime_tooltip = $tooltip_primary.' title="Choose the time and date when the online form will start being visible to the participants on the custom URL you designated." ';
        $end_datetime_tooltip = $tooltip_primary.' title="Choose the time and date when the online form will be stop being visible to the participants on the custom URL you designated." ';
        $how_it_work_tooltip = $tooltip_primary.' title="Input the information of how your event will work of your event/lottery - this information will be visible to the participants on your custom URL form." ';
        $description_tooltip = $tooltip_primary.' title="Input the Description of your event/lottery - this information will be visible to the participants on your custom URL form." ';
        $term_cond_tooltip = $tooltip_primary.' title="Input the terms and conditions related to your event/lottery - this information will be visible to the participants on your custom URL form." ';
        $logo_tooltip = $tooltip_primary.' title="Upload your logo related to your event/lottery this will be visible to the participants on your custom URL form." ';
        $bg_image_tooltip = $tooltip_primary.' title="Upload a background image related to your event/lottery this will be visible to the participants on your custom URL form." ';
        $add_cust_field_tooltip = $tooltip_primary.' title="Drop down menu allows you to customize the additional information you want to include in your online form." ';

        $instructions_tooltip = $tooltip_primary.' title="This area allows you to input the instructions for the even/lottery  the emails your participants will receive" ';
        $reminders_tooltip = $tooltip_primary.' title="This area allows you to input the reminders for the even/lottery the emails your participants will receive" ';
        $map_image_tooltip = $tooltip_primary.' title="This area allows you to upload a map for the even/lottery it will appear in winner email." ';
        $venuelink_tooltip = $tooltip_primary.' title="This area allows you to input a link for the even/lottery venue  it will appear in winner email." ';
        $preview_email_tooltip = $tooltip_primary.' title="By Clicking the preview button you can view a sample of the email the winners will receive." ';

        $scan_starttime_tooltip = $tooltip_primary.' title="Set the date and time agents can start scanning for the event."';
        $scan_endtime_tooltip = $tooltip_primary.' title="Set the date and time agents stop scanning for the event."';


    @endphp
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Add Lottery</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Lotteries</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add lottery</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header" style="place-content: space-between;">
                                <h3 class="card-title">Create new lottery</h3>
                                <small  data-bs-toggle="tooltip-primary" title="the Start and end times of the lottery/event are defined by the timezone you set.">All times are in <strong>{{ 'selected timezone' }}</strong></small>
                            </div>
                            <div class="card-body">
                                <div class="panel panel-primary">
                                    <div class="tab-menu-heading">
                                        <div class="tabs-menu ">
                                            <!-- Tabs -->
                                            <ul class="nav panel-tabs">
                                                <li><a href="#tab1" class="me-1 active" data-bs-toggle="tab">Lottery details</a></li>
                                                <li {!! ($tooltip_status) ? $form_customization_tooltip : '' !!}><a class="me-1">Form customization</a></li>
                                                <li {!! ($tooltip_status) ? $email_custimization_tooltip : '' !!}><a class="me-1">Emails customization</a></li>
                                                <li><a class="me-1">Agents detail</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body tabs-menu-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab1">
                                                @if(empty($data['remaining_events']))
                                                    <div class="alert alert-danger lottery-alert">You already exceeded your event creation limit.</div>
                                                @endif
                                                <form method="POST" action="" id="add_lottery_form" {{ empty($data['remaining_events']) ? 'style="pointer-events: none; opacity: 0.5;"':'' }} novalidate>
                                                    <div class="alert alert-danger lottery-alert" style="display: none;"></div>
                                                    <div class="form-row">
                                                        <div class="col-md-6 mb-4">
                                                            <label for="lottery_title" {{ ($tooltip_status) ? $title_tooltip : '' }}>Title</label>
                                                            <input type="text" class="form-control" id="lottery_title" value="<?php if(isset($_REQUEST['duplicate_id'])){echo $dup_row->title;}?>" placeholder="Enter here..." required>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <label for="lottery_url" <?php echo ($tooltip_status) ? $url_tooltip : ''; ?>>Lottery URL</label>
                                                            <input type="text" class="form-control <?php if(isset($_REQUEST['duplicate_id'])){echo 'is-invalid';}?>" id="lottery_url" pattern="[^' ']+" title="No space" value="<?php if(isset($_REQUEST['duplicate_id'])){echo $dup_row->lottery_url;}?>" placeholder="Enter here..." required>
                                                            <div class="invalid-feedback" id="lottery_name_invalid_feedback"><?php if(isset($_REQUEST['duplicate_id'])){echo 'That URL is not available.';}?></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-lg-3 col-md-4 mb-4">
                                                            <label for="number_of_winners" <?php echo ($tooltip_status)?$winners_tooltip:'';?>>Winners</label>
                                                            <input type="number" class="form-control" id="number_of_winners" value="<?php if(isset($_REQUEST['duplicate_id'])){echo $dup_row->total_winners;}?>" placeholder="0" required>
                                                        </div>

                                                        <div class="col-lg-6 col-md-8 mb-4">
                                                            <label for="validationServer04" <?php echo ($tooltip_status)?$event_date_tooltip:'';?>>Event date-time</label>

                                                            <div class="row">
                                                                <div class="input-group col-7" style="padding-right: 5px;">
                                                                    <div class="input-group-text">
                                                                        <i class="bi bi-calendar3"></i>
                                                                    </div>
                                                                    <input class="form-control fc-datepicker" id="event_date" name="event_date" value="<?php if(isset($_REQUEST['duplicate_id'])){$original_event_date = $dup_row->event_datetime; echo date("d-m-Y", strtotime($original_event_date));}?>" placeholder="DD-MM-YYYY" type="text" required>
                                                                </div>

                                                                <div class="input-group col-5" style="padding-left: 5px;">
                                                                    <div class="input-group-text input-icon">
                                                                        <i class="bi bi-clock"></i>
                                                                    </div>
                                                                    <input class="form-control timepicker" value="<?php if(isset($_REQUEST['duplicate_id'])){$original_event_date = $dup_row->event_datetime; echo date("h:i A", strtotime($original_event_date));}?>" name="event_time" id="event_time" placeholder="00:00 AM" type="text" required>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <div class="col-lg-3 col-md-12 mb-4">
                                                            <label for="validationServer04" <?php echo ($tooltip_status)?$guest_tooltip:'';?>>Guest</label>

                                                            <div class="row">
                                                                <div class="input-group" style="padding-right: 5px;">
                                                                    <select id="allow_guest" class="form-control" required>
                                                                        <option value="1" <?php if(isset($_REQUEST['duplicate_id'])){if($allow_guest==1){echo 'Selected';}}?>>Allow</option>
                                                                        <option value="0" <?php if(isset($_REQUEST['duplicate_id'])){if($allow_guest==0){echo 'Selected';}}?>>Disallow</option>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-lg-4 col-md-4 mb-4">
                                                            <label for="scanning_option">Scanning option</label>
                                                            <select class="form-control select2" name="scanning_option" id="scanning_option" required>
                                                                <option value="QR_CODE" <?php echo (isset($scanning_option) && $scanning_option == 'QR_CODE') ? 'selected' : ''; ?>>QR Code</option>
                                                                <option value="BAR_CODE" <?php echo (isset($scanning_option) && $scanning_option == 'BAR_CODE') ? 'selected' : ''; ?>>Bar Code</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 mb-4">
                                                            <div class="form-group">
                                                                <div class="form-label">Queuing option</div>
                                                                <label class="custom-switch" style="margin-top: 8px;">
                                                                    <input type="checkbox" name="queing_process" id="queing_process" class="custom-switch-input" value="1" checked>
                                                                    <span class="custom-switch-indicator" data-bs-placement="top" data-bs-toggle="tooltip-primary"></span>
                                                                    <span class="" style="margin-left: 0.5rem;">Deactive/Active</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-lg-6 col-md-6 mb-4">
                                                            <label for="countries" <?php echo ($tooltip_status)?$country_tooltip:'';?>>Country were lottery will be held</label>
                                                            <select class="form-control select2" name="countries" id="countries" required>
                                                                <?php
                                                                foreach(getCountriesNames() as $code => $country)
                                                                {
                                                                    echo '<option value="'.$code.'" '.((!empty($country_code)) && $country_code == $code ? 'selected' : '' ).'>'.$country.'</option>';
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 mb-4">
                                                            <label for="timezone" <?php echo ($tooltip_status)?$timezone_tooltip:'';?>>Timezone of were lottery will be held</label>
                                                            <select class="form-control select2" name="timezone" id="timezone">
                                                                <?php echo !empty($lot_timezone) ? '<option value="'.$lot_timezone.'">'.$lot_timezone.'</option>':''; ?>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-lg-6 col-md-6 mb-4">
                                                            <label for="validationServer04" <?php echo ($tooltip_status)?$start_datetime_tooltip:'';?>>Lottery start date-time</label>

                                                            <div class="row">
                                                                <div class="input-group col-7" style="padding-right: 5px;">
                                                                    <div class="input-group-text">
                                                                        <i class="bi bi-calendar3"></i>
                                                                    </div>
                                                                    <input class="form-control fc-datepicker" id="start_date" value="<?php if(isset($_REQUEST['duplicate_id'])){$original_date = $dup_row->start_datetime; echo date("d-m-Y", strtotime($original_date));}?>" placeholder="DD-MM-YYYY" type="text" required>
                                                                </div>

                                                                <div class="input-group col-5" style="padding-left: 5px;">
                                                                    <div class="input-group-text input-icon">
                                                                        <i class="bi bi-clock"></i>
                                                                    </div>
                                                                    <input class="form-control timepicker" value="<?php if(isset($_REQUEST['duplicate_id'])){$original_date = $dup_row->start_datetime; echo date("h-i-sa", strtotime($original_date));}?>" id="start_time" placeholder="00:00 AM" type="text" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 mb-4">
                                                            <label for="validationServer04" <?php echo ($tooltip_status)?$end_datetime_tooltip:'';?>>Lottery end date-time</label>

                                                            <div class="row">
                                                                <div class="input-group col-7" style="padding-right: 5px;">
                                                                    <div class="input-group-text">
                                                                        <i class="bi bi-calendar3"></i>
                                                                    </div>
                                                                    <input class="form-control fc-datepicker" id="end_date" value="<?php if(isset($_REQUEST['duplicate_id'])){$original_date2 = $dup_row->end_datetime; echo date("d-m-Y", strtotime($original_date2));}?>" placeholder="DD-MM-YYYY" type="text" required>
                                                                </div>

                                                                <div class="input-group col-5" style="padding-left: 5px;">
                                                                    <div class="input-group-text input-icon">
                                                                        <i class="bi bi-clock"></i>
                                                                    </div>
                                                                    <input class="form-control timepicker" id="end_time" value="<?php if(isset($_REQUEST['duplicate_id'])){$original_date2 = $dup_row->end_datetime; echo date("h-i-sa", strtotime($original_date2));}?>" placeholder="00:00 AM" type="text" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-lg-4 col-md-4 mb-4">
                                                            <label for="description" <?php echo ($tooltip_status)?$description_tooltip:'';?>>Description</label>
                                                            <div class="text-center p-4 bg-light border br-5" id="description_wrap">
                                                                <a class="btn btn-primary" data-bs-target="#modalQuill" data-bs-toggle="modal" href="">Open editor</a>
                                                                <input type="hidden" name="description" id="description" value="<?php if(isset($_REQUEST['duplicate_id'])){echo $description;}?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 mb-4">
                                                            <label for="how_it_works" <?php echo ($tooltip_status)?$how_it_work_tooltip:'';?>>How it works</label>
                                                            <div class="text-center p-4 bg-light border br-5" id="how_it_works_wrap">
                                                                <a class="btn btn-primary" data-bs-target="#modalQuill2" data-bs-toggle="modal" href="">Open editor</a>
                                                                <input type="hidden" name="how_it_works" id="how_it_works" value="<?php if(isset($_REQUEST['duplicate_id'])){echo $how_it_works;}?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 mb-4">
                                                            <label for="terms_conditions" <?php echo ($tooltip_status)?$term_cond_tooltip:'';?>>Terms & Conditions</label>
                                                            <div class="text-center p-4 bg-light border br-5" id="terms_conditions_wrap">
                                                                <a class="btn btn-primary" data-bs-target="#modalQuill3" data-bs-toggle="modal" href="">Open editor</a>
                                                                <input type="hidden" name="terms_conditions" id="terms_conditions" value="<?php if(isset($_REQUEST['duplicate_id'])){echo $terms_conditions;}?>">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="status" value="<?php if(isset($_REQUEST['duplicate_id'])){ echo 'duplicate';}else{echo 'new';}?>">
                                                    <div class="form-row">
                                                        <div class="col-lg-6 col-md-6 mb-4">
                                                            <label for="lottery_logo" <?php echo ($tooltip_status)?$logo_tooltip:'';?>>Logo <small class="text-default">(Optional)</small></label>
                                                            <input type="file" class="form-control" id="lottery_logo" accept="image/*">

                                                            @php
                                                                $lottery_logo = '';
                                                                $lottery_background_image = '';
                                                            @endphp

                                                            <div class="mt-2 img-thumbnail <?php if(isset($_REQUEST['duplicate_id'])){if($lottery_logo == ''){echo 'd-none';}}else{echo 'd-none';}?>" style="width: fit-content;position: relative;" id="preview_lottery_logo_wrap">
                                                                <img src="<?php if($lottery_logo != ''){echo '../assets/images/media/' . $lottery_logo;}?>" id="preview_lottery_logo" style="width: 120px;">
                                                                <input type="hidden" id="fake_img_lottery_logo" data-value="<?php if($lottery_logo != ''){echo $lottery_logo;}?>" value="<?php if($lottery_logo != ''){echo $lottery_logo;}?>">
                                                                <button type="button" class="remove_btn" id="remove_img_lottery_logo"><i class="bi bi-x-circle-fill"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 mb-4">
                                                            <label for="lottery_background_image" <?php echo ($tooltip_status)?$bg_image_tooltip:'';?>>Background image <small class="text-green">(1920x1080)</small> <small class="text-default">(Optional)</small></label>
                                                            <input type="file" class="form-control" id="lottery_background_image" accept="image/*">

                                                            <div class="mt-2 img-thumbnail <?php if(isset($_REQUEST['duplicate_id'])){if($lottery_background_image == ''){echo 'd-none';}}else{echo 'd-none';}?>" style="width: fit-content;position: relative;" id="preview_lottery_background_image_wrap">
                                                                <img src="<?php if($lottery_background_image != ''){echo '../assets/images/media/' . $lottery_background_image;}?>" id="preview_lottery_background_image" style="width: 120px;">
                                                                <input type="hidden" id="fake_img_lottery_background_image" data-value="<?php if($lottery_background_image != ''){echo $lottery_background_image;}?>" value="<?php if($lottery_background_image != ''){echo $lottery_background_image;}?>">
                                                                <button type="button" class="remove_btn" id="remove_img_lottery_background_image"><i class="bi bi-x-circle-fill"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button class="btn btn-primary" type="submit" id="submit_btn" style="float: right;position: relative;">
                                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;">Next/Update</span>
                                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;"><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;" role="status"></div></span>
                                                    </button>
                                                </form>
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

    <!--Modal-->
    <div class="modal fade"  id="modalQuill">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header pd-20">
                    <h6 class="modal-title">Description - editor</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body pd-0">
                    <div class="ql-wrapper ql-wrapper-modal ht-250">
                        <div class="flex-1" id="quillEditorModal">
                            <?php if(isset($_REQUEST['duplicate_id'])){echo unserialize($dup_row->description);}?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pd-20">
                    <button class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" >Cancel</button>
                    <button class="btn btn-primary" id="description_editor_save">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--/Modal-->

    <!--Modal-->
    <div class="modal fade"  id="modalQuill2">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header pd-20">
                    <h6 class="modal-title">How it works - editor</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body pd-0">
                    <div class="ql-wrapper ql-wrapper-modal ht-250">
                        <div class="flex-1" id="quillEditorModal2">
                            <?php if(isset($_REQUEST['duplicate_id'])){echo unserialize($dup_row->how_it_works);}?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pd-20">
                    <button class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" >Cancel</button>
                    <button class="btn btn-primary" id="how_it_works_editor_save">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--/Modal-->

    <!--Modal-->
    <div class="modal fade"  id="modalQuill3">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header pd-20">
                    <h6 class="modal-title">Terms & Conditions - editor</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body pd-0">
                    <div class="ql-wrapper ql-wrapper-modal ht-250">
                        <div class="flex-1" id="quillEditorModal3">
                            <?php if(isset($_REQUEST['duplicate_id'])){echo unserialize($dup_row->terms_conditions);}?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pd-20">
                    <button class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" >Cancel</button>
                    <button class="btn btn-primary" id="terms_conditions_editor_save">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--/Modal-->

@endsection
@push('css')
    <style>
        button.remove_btn {
            position: absolute;
            right: 0;
            top: 0;
            padding: 0;
            font-size: 24px;
            height: 30px;
            width: 30px;
            display: flex;
            place-content: center;
            align-items: center;
            background: #fff;
            border-radius: 50%;
        }
        button.remove_btn:hover {
            opacity: 0.7;
        }

        button.remove_btn i {
            width: 24px;
            height: 24px;
            display: flex;
            place-content: center;
            align-items: center;
            box-shadow: 0px 0px 6px 3px #fff;
            border-radius: 50%;
        }
        form {
            overflow: hidden;
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

    <!-- TIMEPICKER JS -->
    {{ Html::script('assets/plugin/time-picker/jquery.timepicker.js') }}

    <!-- DATEPICKER JS -->
    {{ Html::script('assets/plugin/date-picker/date-picker.js') }}
    {{ Html::script('assets/plugin/date-picker/jquery-ui.js') }}


    <!-- FORMEDITOR JS -->
    {{ Html::script('assets/plugin/quill/quill.min.js') }}

    <script>
        var add_lottery = '{{ route("user.add-lottery") }}';
        var check_lottery_url = '{{ route("user.check-lottery-url") }}';
        var get_country_timezone = '{{ route("user.get-country-timezone") }}';
        $(function() {
            'use strict'

            var tooltip_primary = $('[data-bs-toggle="tooltip-primary"]');
            for (let index = 0; index < tooltip_primary.length; index++) {
                var tooltip = new bootstrap.Tooltip(tooltip_primary[index], {
                    template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
                });
            }

            var icons = Quill.import('ui/icons');
            icons['bold'] = '<i class="bi bi-type-bold" aria-hidden="true"><\/i>';
            icons['italic'] = '<i class="bi bi-type-italic" aria-hidden="true"><\/i>';
            icons['underline'] = '<i class="bi bi-type-underline" aria-hidden="true"><\/i>';
            icons['strike'] = '<i class="bi bi-type-strikethrough" aria-hidden="true"><\/i>';
            icons['list']['ordered'] = '<i class="bi bi-list-ol" aria-hidden="true"><\/i>';
            icons['list']['bullet'] = '<i class="bi bi-list-ul" aria-hidden="true"><\/i>';
            icons['link'] = '<i class="bi bi-link" aria-hidden="true"><\/i>';
            icons['image'] = '<i class="bi bi-image" aria-hidden="true"><\/i>';
            icons['video'] = '<i class="bi bi-film" aria-hidden="true"><\/i>';
            icons['code-block'] = '<i class="bi bi-code" aria-hidden="true"><\/i>';
            var toolbarOptions = [
                [{
                    'header': [1, 2, 3, 4, 5, 6, false]
                }],
                ['bold', 'italic', 'underline', 'strike'],
                [{
                    'list': 'ordered'
                }, {
                    'list': 'bullet'
                }],
                ['link']
            ];
            var quillModal = new Quill('#quillEditorModal', {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow',
                placeholder: 'Type here...'
            });
            $('#description_editor_save').click(function(){
                var editor_content = quillModal.root.innerHTML;
                if(editor_content == '<p><br></p>' || editor_content == '<p> </p>' || editor_content == '<p>  </p>' || editor_content == '<p>   </p>'){
                    editor_content = '';
                }

                $('#description').val(editor_content);
                if($('#description').val() != ''){
                    $('#description_wrap').css({borderColor: ''});
                }
                $('.modal').modal('hide');
            });

            var quillModal2 = new Quill('#quillEditorModal2', {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow',
                placeholder: 'Type here...'
            });

            $('#how_it_works_editor_save').click(function(){
                var editor_content = quillModal2.root.innerHTML;
                if(editor_content == '<p><br></p>' || editor_content == '<p> </p>' || editor_content == '<p>  </p>' || editor_content == '<p>   </p>'){
                    editor_content = '';
                }

                $('#how_it_works').val(editor_content);
                if($('#how_it_works').val() != ''){
                    $('#how_it_works_wrap').css({borderColor: ''});
                }
                $('.modal').modal('hide');
            });

            var quillModal3 = new Quill('#quillEditorModal3', {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow',
                placeholder: 'Type here...'
            });

            $('#terms_conditions_editor_save').click(function(){
                var editor_content = quillModal3.root.innerHTML;
                if(editor_content == '<p><br></p>' || editor_content == '<p> </p>' || editor_content == '<p>  </p>' || editor_content == '<p>   </p>'){
                    editor_content = '';
                }

                $('#terms_conditions').val(editor_content);
                if($('#terms_conditions').val() != ''){
                    $('#terms_conditions_wrap').css({borderColor: ''});
                }
                $('.modal').modal('hide');
            });

        });
    </script>


    {{ Html::script('user/js/add_lottery.js?t='.rand(0,10000)) }}

    <script>
        // Datepicker
        $('.fc-datepicker').datepicker({
            dateFormat: 'dd-mm-yy',
            showOtherMonths: true,
            selectOtherMonths: true
        });
        $('.timepicker').timepicker({
            timeFormat: 'h:i A'
        });
    </script>

@endpush
