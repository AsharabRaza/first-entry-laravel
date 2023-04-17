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
                        <h1 class="page-title">Edit lottery</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Event Lotteries</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit lottery</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header" style="place-content: space-between;">
                                <h3 class="card-title">Modify lottery - {{ ucfirst($data['title']) }} </h3>
                                <small>All times are in <strong>{{ 'selected timezone' }}</strong></small>
                            </div>
                            <div class="card-body">
                                <div class="panel panel-primary">
                                    <div class="tab-menu-heading">
                                        <div class="tabs-menu ">
                                            <!-- Tabs -->
                                            <ul class="nav panel-tabs">
                                                <li><a href="#tab1" class="me-1 active" data-bs-toggle="tab">Lottery details</a></li>
                                                @if(getMemberShipInfo(auth()->user()->id)['customize_online_forms'] === "yes")
                                                    <li {!! ($tooltip_status) ? $form_customization_tooltip : '' !!}><a href="#tab2" data-bs-toggle="tab" class="me-1">Form customization</a></li>
                                                @endif

                                                <li {!! ($tooltip_status) ? $email_custimization_tooltip : '' !!}><a href="#tab3" data-bs-toggle="tab" class="me-1">Emails customization</a></li>
                                                <li><a href="#tab4" data-bs-toggle="tab" class="me-1">Agents detail</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="panel-body tabs-menu-body">
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab1">
                                                <form method="POST" action="" id="edit_lottery_form">
                                                    <input type="hidden" value="{{ $data['lottery_id'] }}" name="lottery_id" id="lottery_id">
                                                    <div class="alert alert-danger lottery-alert" style="display: none;"></div>
                                                    <div class="form-row">
                                                        <div class="col-md-6 mb-4">
                                                            <label for="lottery_title" {!! ($tooltip_status) ? $title_tooltip : '' !!}>Title</label>
                                                            <input type="text" class="form-control" id="lottery_title" value="{{ $data['title'] }}" placeholder="Enter here..." required>
                                                        </div>
                                                        <div class="col-md-6 mb-4">
                                                            <label for="lottery_url" {!! ($tooltip_status) ? $url_tooltip : '' !!}>Lottery URL</label>
                                                            <input type="text" class="form-control is-valid" id="lottery_url" pattern="[^' ']+" title="No space" value="{{ $data['lottery_url'] }}" data-not="{{ $data['lottery_id'] }}" placeholder="Enter here..." required>
                                                            <div class="invalid-feedback" id="lottery_name_invalid_feedback"></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-lg-3 col-md-4 mb-4">
                                                            <label for="number_of_winners" {!! ($tooltip_status)?$winners_tooltip:'' !!}>Winners</label>
                                                            <input type="number" class="form-control" id="number_of_winners" value="{{ $data['total_winners'] }}" placeholder="0" required>
                                                        </div>

                                                        <div class="col-lg-6 col-md-8 mb-4">
                                                            <label for="validationServer04" {!! ($tooltip_status)?$event_date_tooltip:'' !!}>Event date-time</label>

                                                            <div class="row">
                                                                <div class="input-group col-7" style="padding-right: 5px;">
                                                                    <div class="input-group-text">
                                                                        <i class="bi bi-calendar3"></i>
                                                                    </div>
                                                                    <input class="form-control fc-datepicker" id="event_date" name="event_date" value="{{ $data['event_date'] }}" placeholder="DD-MM-YYYY" type="text" required>
                                                                </div>

                                                                <div class="input-group col-5" style="padding-left: 5px;">
                                                                    <div class="input-group-text input-icon">
                                                                        <i class="bi bi-clock"></i>
                                                                    </div>
                                                                    <input class="form-control timepicker" value="{{ $data['event_time'] }}" id="event_time" name="event_time" placeholder="00:00 AM" type="text" required>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col-lg-3 col-md-12 mb-4">
                                                            <label for="validationServer04" {!! ($tooltip_status)?$guest_tooltip:'' !!}>Guest</label>

                                                            <div class="row">
                                                                <div class="input-group" style="padding-right: 5px;">
                                                                    <select id="allow_guest" class="form-control" required>
                                                                        <option value="1" {{ ($data['allow_guest']==1) ? 'selected' : '' }}>Allow</option>
                                                                        <option value="0" {{ ($data['allow_guest']==0) ? 'selected' : '' }}>Disallow</option>
                                                                    </select>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-lg-4 col-md-4 mb-4">
                                                            <label for="scanning_option">Scanning option</label>
                                                            <select class="form-control select2" name="scanning_option" id="scanning_option" required>
                                                                <option value="QR_CODE" {{ (isset($data['scanning_option']) && $data['scanning_option'] == 'QR_CODE') ? 'selected' : '' }}>QR Code</option>
                                                                <option value="BAR_CODE" {{ (isset($data['scanning_option']) && $data['scanning_option'] == 'BAR_CODE') ? 'selected' : '' }}>Bar Code</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 mb-4 ms-4">
                                                            <div class="form-group">
                                                                <div class="form-label">Queuing option</div>
                                                                <label class="custom-switch" style="margin-top: 8px;">
                                                                    <input type="checkbox" name="queing_process" id="queing_process" class="custom-switch-input" value="1" {{ $data['queing_process']==1 ? 'checked' : '' }} >
                                                                    <span class="custom-switch-indicator" data-bs-placement="top" data-bs-toggle="tooltip-primary"></span>
                                                                    <span class="" style="margin-left: 0.5rem;">Deactive/Active</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-lg-6 col-md-6 mb-4">
                                                            <label for="countries" {{ ($tooltip_status)?$country_tooltip:'' }}>Country</label>
                                                            <select class="form-control select2" name="countries" id="countries" required>
                                                                @foreach(getCountriesNames() as $code => $country)
                                                                    <option value="{{ $code }}" {{ $data['country_code'] == $code ? 'selected' : '' }}>{{ $country }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>

                                                        <div class="col-lg-6 col-md-6 mb-4">
                                                            <label for="timezone" {{ ($tooltip_status)?$timezone_tooltip:'' }}>Timezone</label>
                                                            <select class="form-control select2" name="timezone" id="timezone">
                                                                @foreach(getTimeZone($data['country_code']) as $timezn)
                                                                    <option value="{{ $data['lott_timezone'] }}" {{ $timezn == $data['lott_timezone'] ? 'selected' : '' }}>{{ $timezn }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="form-row">
                                                        <div class="col-lg-6 col-md-6 mb-4">
                                                            <label for="validationServer04" {!! ($tooltip_status)?$start_datetime_tooltip:'' !!}>Lottery start date-time</label>

                                                            <div class="row">
                                                                <div class="input-group col-7" style="padding-right: 5px;">
                                                                    <div class="input-group-text">
                                                                        <i class="bi bi-calendar3"></i>
                                                                    </div>
                                                                    <input class="form-control fc-datepicker" id="start_date" placeholder="DD-MM-YYYY" value=" {{ $data['start_date'] }} " type="text" required>
                                                                </div>

                                                                <div class="input-group col-5" style="padding-left: 5px;">
                                                                    <div class="input-group-text input-icon">
                                                                        <i class="bi bi-clock"></i>
                                                                    </div>
                                                                    <input class="form-control timepicker" id="start_time" value="{{ $data['start_time'] }}" placeholder="00:00 AM" type="text" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 mb-4">
                                                            <label for="validationServer04" {!! ($tooltip_status)?$end_datetime_tooltip:'' !!}>Lottery end date-time</label>

                                                            <div class="row">
                                                                <div class="input-group col-7" style="padding-right: 5px;">
                                                                    <div class="input-group-text">
                                                                        <i class="bi bi-calendar3"></i>
                                                                    </div>
                                                                    <input class="form-control fc-datepicker" id="end_date" value="{{ $data['end_date'] }}" placeholder="DD-MM-YYYY" type="text" required>
                                                                </div>

                                                                <div class="input-group col-5" style="padding-left: 5px;">
                                                                    <div class="input-group-text input-icon">
                                                                        <i class="bi bi-clock"></i>
                                                                    </div>
                                                                    <input class="form-control timepicker" id="end_time" value="{{ $data['end_time'] }}" placeholder="00:00 AM" type="text" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-lg-4 col-md-4 mb-4">
                                                            <label for="" {!! ($tooltip_status)?$description_tooltip:'' !!}>Description</label>
                                                            <div class="text-center p-4 bg-light border br-5" id="description_wrap">
                                                                <a class="btn btn-primary" data-bs-target="#modalQuill" data-bs-toggle="modal" href="">Open editor</a>
                                                                <input type="hidden" name="description" value="{{ $data['description'] }}" id="description">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 mb-4">
                                                            <label for="" {!! ($tooltip_status)?$how_it_work_tooltip:'' !!}>How it works</label>
                                                            <div class="text-center p-4 bg-light border br-5" id="how_it_works_wrap">
                                                                <a class="btn btn-primary" data-bs-target="#modalQuill2" data-bs-toggle="modal" href="">Open editor</a>
                                                                <input type="hidden" name="how_it_works" value="{{ $data['how_it_works'] }}" id="how_it_works">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4 col-md-4 mb-4">
                                                            <label for="" {!! ($tooltip_status)?$term_cond_tooltip:'' !!}>Terms & Conditions</label>
                                                            <div class="text-center p-4 bg-light border br-5" id="terms_conditions_wrap">
                                                                <a class="btn btn-primary" data-bs-target="#modalQuill3" data-bs-toggle="modal" href="">Open editor</a>
                                                                <input type="hidden" name="terms_conditions" value="{{ $data['terms_conditions'] }}" id="terms_conditions">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="col-lg-6 col-md-6 mb-4">
                                                            <label for="lottery_logo" {!! ($tooltip_status)?$logo_tooltip:'' !!}>Logo <small class="text-default">(Optional)</small></label>
                                                            <input type="file" class="form-control" id="lottery_logo" accept="image/*">

                                                            <div class="mt-2 img-thumbnail {{ ($data['lottery_logo']=='') ? 'd-none' : '' }}" style="width: fit-content;position: relative;" id="preview_lottery_logo_wrap">
                                                                <img src="{{ ($data['lottery_logo']!='') ? url('assets/images/media/'.$data['lottery_logo']) : '' }}" id="preview_lottery_logo" style="width: 120px;">
                                                                <input type="hidden" id="fake_img_lottery_logo" data-value="{{ ($data['lottery_logo']!='') ? $data['lottery_logo'] : '' }}" value="{{ ($data['lottery_logo']!='') ? $data['lottery_logo'] : '' }}">
                                                                <button type="button" class="remove_btn" id="remove_img_lottery_logo"><i class="bi bi-x-circle-fill"></i></button>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 mb-4 d-none">
                                                            <label for="lottery_background_image" {!! ($tooltip_status)?$bg_image_tooltip:'' !!}>Background image <small class="text-green">(1920x1080)</small> <small class="text-default">(Optional)</small></label>
                                                            <input type="file" class="form-control" id="lottery_background_image" accept="image/*">

                                                            <div class="mt-2 img-thumbnail {{ ($data['lottery_background_image']=='' ? 'd-none' : '') }} " style="width: fit-content;position: relative;" id="preview_lottery_background_image_wrap">
                                                                <img src="{{ ($data['lottery_background_image']!='' ? url('assets/images/media/'.$data['lottery_background_image']) : '') }}" id="preview_lottery_background_image" style="width: 120px;">
                                                                <input type="hidden" id="fake_img_lottery_background_image" data-value="{{ ($data['lottery_background_image']!='') ? $data['lottery_background_image'] : '' }}" value="{{ ($data['lottery_background_image']!='') ? $data['lottery_background_image'] : '' }}">
                                                                <button type="button" class="remove_btn" id="remove_img_lottery_background_image"><i class="bi bi-x-circle-fill"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button class="btn btn-primary" type="submit" id="update_btn" style="float: right;position: relative;">
                                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;">Next/Update</span>
                                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;"><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;" role="status"></div></span>
                                                    </button>
                                                </form>
                                            </div>
                                            <div class="tab-pane" id="tab2">
                                                @if(getMemberShipInfo(auth()->user()->id)['customize_online_forms'] === "yes")
                                                    <div class="alert alert-customize" style="display: none;"></div>
                                                    <div class="card no-shadow">
                                                        <div class="card-header" style="place-content: space-between;">
                                                            <div>
                                                                <h3 class="card-title"><strong>Online form - preview</strong></h3>
                                                            </div>
                                                            <div>
                                                                <div id="customFieldsDropDown" class="dropdown btn-group">
                                                                    <button {!! ($tooltip_status)?$add_cust_field_tooltip:'' !!} type="button" class="btn btn-info dropdown-toggle" data-bs-toggle="dropdown">
                                                                        <i class="bi bi-plus-lg"></i> Add custom field
                                                                    </button>
                                                                    <div class="dropdown-menu">
                                                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-target="#modalNewFields" data-bs-toggle="modal" data-value="text_input" data-input-type="text" data-classes="" onclick="setup_input_cus(this);"><i class="bi bi-textarea-t text-white"></i> Text input</a>
                                                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-target="#modalNewFields" data-bs-toggle="modal" data-value="datetime_input" data-input-type="date" data-classes="" onclick="setup_input_cus(this);"><i class="bi bi-calendar2-day text-white"></i> Date-time input</a>
                                                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-target="#modalNewFields" data-bs-toggle="modal" data-value="selection_input" data-input-type="select" data-classes="" onclick="setup_input_cus(this);"><i class="bi bi-view-list text-white"></i> Selection input</a>
                                                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-target="#modalNewFields" data-bs-toggle="modal" data-value="text_input" data-input-type="file" data-classes="" onclick="setup_input_cus(this);"><i class="bi bi-image text-white"></i> Image input</a>
                                                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-target="#modalNewFields" data-bs-toggle="modal" data-value="text_input" data-input-type="email" data-classes="" onclick="setup_input_cus(this);"><i class="bi bi-image text-white"></i> Email input</a>
                                                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-target="#modalNewFields" data-bs-toggle="modal" data-value="text_input" data-input-type="url" data-classes="" onclick="setup_input_cus(this);"><i class="bi bi-image text-white"></i> URL input</a>
                                                                        <a class="dropdown-item" href="javascript:void(0)" data-bs-target="#modalNewFields" data-bs-toggle="modal" data-value="text_input" data-input-type="tel" data-classes="" onclick="setup_input_cus(this);"><i class="bi bi-image text-white"></i> Phone input</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="card-body" style="/*background: var(--bs-dark);*/background: var(--blue);">

                                                            <div class="">
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="wrap-input100 form-group sign-group icon-center mb-4" style="opacity: 0.5;">
                                                                            <div class="row">
                                                                                <label class="form-label" style="margin-left: 1px;">Name (must match legal name on ID) <span class="text-red">&#42;</span></label>
                                                                                <div class="col">
                                                                                    <input class="input100" type="text" name="" id="" placeholder="First name" required="" disabled readonly>
                                                                                    <span class="focus-input100"></span>
                                                                                    <span class="symbol-input100" style="padding-left: 25px;">
                                <i class="bi bi-person-fill"></i>
                            </span>
                                                                                </div>
                                                                                <div class="col last_name_col">
                                                                                    <input class="input100" type="text" name="" id="" placeholder="Last name" style="padding-left: 12px;" required="" disabled readonly>
                                                                                    <span class="focus-input100"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="wrap-input100 form-group sign-group icon-center mb-4" style="opacity: 0.5;">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <label class="form-label" style="margin-left: 1px;">Email <span class="text-red">&#42;</span></label>
                                                                                    <div class="wrap-input100 validate-input">
                                                                                        <input class="input100" type="email" name="" id="" placeholder="Email" required="" disabled readonly>
                                                                                        <span class="focus-input100"></span>
                                                                                        <span class="symbol-input100">
                                    <i class="bi bi-envelope-fill"></i>
                                </span>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <label class="form-label" style="margin-left: 1px;">Phone <span class="text-red">&#42;</span></label>
                                                                                    <div class="wrap-input100 validate-input">
                                                                                        <input class="input100 form-control" type="text" name="" id="" placeholder="Phone" required="" disabled readonly>
                                                                                        <span class="focus-input100"></span>
                                                                                        <span class="symbol-input100">
                                    <i class="bi bi-telephone-fill"></i>
                                </span>
                                                                                        <div class="invalid-feedback" id="" style="position: absolute;">Max 10 digits number.</div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="wrap-input100 form-group sign-group icon-center mb-4" id="custom_fields_wrap" style="background: var(--bs-dark);padding: 0 10px;border-radius: 5px;">
                                                                            <strong style="display: flex;place-content: center;align-items: center;height: 70px;font-size: 16px;font-style: italic;" id="custom_field_placeholder">Custom fields will be added here</strong>
                                                                            <div class="row">

                                                                            </div>
                                                                        </div>



                                                                        <div class="form-group mb-4" style="display: none;opacity: 0.5;" id="guest_">
                                                                            <div class="form-label">Do you intend to bring a guest? <span class="text-red">&#42;</span></div>
                                                                            <div class="custom-controls-stacked">
                                                                                <label class="custom-control custom-radio">
                                                                                    <input type="radio" class="custom-control-input" name="" value="1" {{ ($data['allow_guest']==0) ? '' : 'required' }} disabled readonly>
                                                                                    <span class="custom-control-label">Yes</span>
                                                                                </label>
                                                                                <label class="custom-control custom-radio">
                                                                                    <input type="radio" class="custom-control-input" name="" value="0" {{ ($data['allow_guest']==0) ? 'checked' : 'required' }} disabled readonly>
                                                                                    <span class="custom-control-label">No</span>
                                                                                </label>
                                                                            </div>
                                                                        </div>

                                                                        <div class="wrap-input100 form-group sign-group icon-center mb-4 d-none" id="bring_guest_wrap" style="opacity: 0.5;">
                                                                            <div class="row">
                                                                                <label class="form-label" style="margin-left: 1px;">Guest's Name <span class="text-red">&#42;</span></label>
                                                                                <div class="col">
                                                                                    <input class="input100" type="text" name="" id="" placeholder="First name" disabled readonly>
                                                                                    <span class="focus-input100"></span>
                                                                                    <span class="symbol-input100" style="padding-left: 25px;">
                                <i class="bi bi-person-fill"></i>
                            </span>
                                                                                </div>
                                                                                <div class="col last_name_col">
                                                                                    <input class="input100" type="text" name="" id="" placeholder="Last name" style="padding-left: 12px;" disabled readonly>
                                                                                    <span class="focus-input100"></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        <div class="form-group mb-3" style="opacity: 0.5;">
                                                                            <div class="form-label">Terms & Conditions <span class="text-red">&#42;</span></div>
                                                                            <label class="custom-switch">
                                                                                <input type="checkbox" name="" class="custom-switch-input" value="1"  disabled readonly>
                                                                                <span class="custom-switch-indicator" style="opacity: 0.5;"></span>
                                                                                <span class="" style="margin-left: 0.5rem;">I agree to the following:</span>
                                                                            </label>
                                                                        </div>
                                                                        <div class="terms_conditions_wrap" style="opacity: 0.5;">
                                                                            {{ $data['terms_conditions'] }}
                                                                        </div>

                                                                        <label class="form-label" style="margin-left: 1px;opacity: 0.5;">Captcha <span class="text-red">&#42; </span></label>
                                                                        <div class="wrap-input100 validate-input mb-4" style="opacity: 0.5;">
                                                                            <input class="input100 form-control" type="text" name="" id="" placeholder="Captcha" required="" disabled readonly>
                                                                            <span class="focus-input100"></span>
                                                                            <span class="symbol-input100">
                        <i class="bi bi-123"></i>
                    </span>
                                                                            <div class="invalid-feedback" id="" style="position: absolute;">Invalid CAPTCHA.</div>
                                                                        </div>

                                                                        <div class="container-login100-form-btn">
                                                                            <p><strong><i><-- Form submit button will be here --></i></strong></p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer text-muted">
                                                            <div class="d-flex" style="place-content: end;">
                                                                <form action="" id="form_customization_form" method="POST">
                                                                    <input type="hidden" name="lottery_id" id="cus_lottery_id" value="{{ request()->query('id') }}">
                                                                    <input type="hidden" name="customization_values" id="customization_values">
                                                                    <button class="btn btn-primary" type="submit" id="form_cus_submit_btn" style="float: right;position: relative;">
                                                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;">Update</span>
                                                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;"><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;" role="status"></div></span>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="tab-pane" id="tab3">
                                                <div class="tab_wrapper second_tab right_side2">
                                                    <ul class="tab_list">
                                                        <li class="active entry_tab_form" id="form_winners_tab">Selected entries</li>
                                                        <li id="form_loosers_tab" class="entry_tab_form">Non-selected entries</li>
                                                    </ul>

                                                    <div class="content_wrapper">
                                                        <div class="tab_content active">

                                                            <form method="POST" action="" id="modify_winners_email_form">
                                                                <input type="hidden" value="{{ $data['lottery_id'] }}" name="lottery_id" id="winners_emails_lottery_id">
                                                                <div class="alert alert-danger winners-emails-alert" style="display: none;"></div>

                                                                <div class="form-group row d-flex">
                                                                    <label class="col-md-3 col-form-label" for="winners_emails_instructions" {{ ($tooltip_status)?$instructions_tooltip:'' }}>Instructions</label>
                                                                    <div class="col-md-9" style="height: 100%;">
                                                                        <div id="winners_emails_instructions">{!! $data['winners_emails_instructions'] !!}</div>
                                                                        <!--<textarea name="instructions" id="winners_emails_instructions" class="form-control" cols="30" rows="4" required></textarea>-->
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row d-flex">
                                                                    <label class="col-md-3 col-form-label" {{ ($tooltip_status)?$reminders_tooltip:'' }} for="winners_emails_reminders">Reminders</label>
                                                                    <div class="col-md-9" style="height: 100%;">
                                                                        <div id="winners_emails_reminders">{!! $data['winners_emails_reminders'] !!}</div>
                                                                        <!--<textarea name="reminders" id="winners_emails_reminders" class="form-control" cols="30" rows="4" required></textarea>-->
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row d-flex">
                                                                    <label class="col-md-3 col-form-label" for="map_image" {{ ($tooltip_status)?$map_image_tooltip:'' }}>Map image</label>
                                                                    <div class="col-md-9">
                                                                        <input type="file" class="form-control" id="map_image" accept="image/*">

                                                                        <div class="mt-2 img-thumbnail {{ ($data['winners_emails_map_image']=='') ? 'd-none' : '' }}" style="width: fit-content;position: relative;" id="preview_map_image_wrap">
                                                                            <img src="{{ ($data['winners_emails_map_image']!='') ? url('assets/images/media/' . $data['winners_emails_map_image']) : '' }}" id="preview_map_image" style="width: 120px;">
                                                                            <input type="hidden" id="fake_img" data-value="{{ ($data['winners_emails_map_image']!='') ? $data['winners_emails_map_image'] : '' }}" value="{{ ($data['winners_emails_map_image']!='') ? $data['winners_emails_map_image'] : '' }}">
                                                                            <button type="button" class="remove_btn" id="remove_img"><i class="bi bi-x-circle-fill"></i></button>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row d-flex">
                                                                    <label class="col-md-3 col-form-label" for="winners_emails_venue_link" {{ ($tooltip_status)?$venuelink_tooltip:'' }}>Venue link</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id="winners_emails_venue_link" value="{{ $data['winners_emails_venue_link'] }}" placeholder="Enter here... (include http:// or https://)" required>
                                                                    </div>
                                                                </div>

                                                                <button class="btn btn-primary" type="submit" id="winners_emails_update_btn" style="float: right;position: relative;">
                                                                    <span style="-webkit-transition: all 0.2s;transition: all 0.2s;">Update</span>
                                                                    <span style="-webkit-transition: all 0.2s;transition: all 0.2s;"><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;" role="status"></div></span>
                                                                </button>

                                                                <div style="float: left;">
                                                                    <button {!! ($tooltip_status)?$preview_email_tooltip:'' !!} class="btn btn-info preview_btn" type="button" id="preview_btn_winner" data-template="winner" style="float: right;margin-right: 6px;">Preview</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                        <div class="tab_content">
                                                            <form method="POST" action="" id="modify_losers_email_form">
                                                                <input type="hidden" value="{{ $data['lottery_id'] }}" name="lottery_id" id="losers_emails_lottery_id">
                                                                <div class="alert alert-danger losers-emails-alert" style="display: none;"></div>

                                                                <div class="form-group row d-flex">
                                                                    <label class="col-md-3 col-form-label" for="losers_emails_instructions">Instructions</label>
                                                                    <div class="col-md-9" style="height: 100%;">
                                                                        <div id="losers_emails_instructions">{!! $data['losers_emails_instructions'] !!}</div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group row d-flex">
                                                                    <label class="col-md-3 col-form-label" for="losers_emails_venue_link">Venue link</label>
                                                                    <div class="col-md-9">
                                                                        <input type="text" class="form-control" id="losers_emails_venue_link" value="{{ $data['losers_emails_venue_link'] }}" placeholder="Enter here... (include http:// or https://)" required>
                                                                    </div>
                                                                </div>

                                                                <button class="btn btn-primary" type="submit" id="losers_emails_update_btn" style="float: right;position: relative;">
                                                                    <span style="-webkit-transition: all 0.2s;transition: all 0.2s;">Update</span>
                                                                    <span style="-webkit-transition: all 0.2s;transition: all 0.2s;"><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;" role="status"></div></span>
                                                                </button>

                                                                <div style="float: left;">
                                                                    <button {!! ($tooltip_status)?$preview_email_tooltip:'' !!} class="btn btn-info preview_btn" type="button" id="preview_btn_looser" data-template="looser" style="float: right;margin-right: 6px;">Preview</button>
                                                                </div>
                                                            </form>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab4">
                                                <form method="POST" action="" id="update_agent_detail_form">
                                                    <input type="hidden" value="{{ $data['lottery_id'] }}" name="lottery_id" id="lottery_id">
                                                    <div class="alert alert-danger lottery-alert" style="display: none;"></div>

                                                    <div class="form-row">
                                                        <div class="col-lg-6 col-md-6 mb-4">
                                                            <input type="hidden" id="old_lottery_agents" name="old_lottery_agents" value="{{ $data['old_lottery_agents'] }}" />
                                                            <label for="lottery_agents" {{ ($tooltip_status)?$lott_agent_tooltip:'' }}>Verification agents</label>
                                                            <select class="form-control select2" name="lottery_agents[]" id="lottery_agents" multiple>
                                                                @foreach ($data['users'] as $user)
                                                                    <option value="{{ $user->id }}" {{ in_array($user->id, $data['old_lottery_agents_array']) ? 'selected' : '' }}>
                                                                        {{ $user->first_name }} {{ $user->last_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 mb-4">
                                                            <div class="form-group">
                                                                <div class="form-label" {{ ($tooltip_status)?$lott_status_tooltip:'' }}>Lottery status</div>
                                                                <label class="custom-switch" style="margin-top: 8px;">
                                                                    <input type="checkbox" name="" id="lottery_status" class="custom-switch-input" value="1" {{ ($data['lottery_status']==1) ? 'checked' : '' }} >
                                                                    <span class="custom-switch-indicator lott_status_tt" data-bs-placement="top" data-bs-toggle="tooltip-primary" title="{{ ($data['lottery_status']==1) ? 'Active' : 'Deactive' }} "></span>
                                                                    <span class="" style="margin-left: 0.5rem;">Deactive/Active</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="form-row">
                                                        <div class="col-lg-6 col-md-6 mb-4">
                                                            <label for="validationServer04" {{ ($tooltip_status)?$scan_starttime_tooltip:'' }}>Scan start date-time</label>

                                                            <div class="row">
                                                                <div class="input-group col-7" style="padding-right: 5px;">
                                                                    <div class="input-group-text">
                                                                        <i class="bi bi-calendar3"></i>
                                                                    </div>
                                                                    <input class="form-control fc-datepicker" id="scan_start_date" placeholder="DD-MM-YYYY" value="{{ $data['scan_start_date'] }}" type="text" required>
                                                                </div>

                                                                <div class="input-group col-5" style="padding-left: 5px;">
                                                                    <div class="input-group-text input-icon">
                                                                        <i class="bi bi-clock"></i>
                                                                    </div>
                                                                    <input class="form-control timepicker" id="scan_start_time" value="{{ $data['scan_start_time'] }}" placeholder="00:00 AM" type="text" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 mb-4">
                                                            <label for="validationServer04" {{ ($tooltip_status)?$scan_endtime_tooltip:'' }}>Scan end date-time</label>

                                                            <div class="row">
                                                                <div class="input-group col-7" style="padding-right: 5px;">
                                                                    <div class="input-group-text">
                                                                        <i class="bi bi-calendar3"></i>
                                                                    </div>
                                                                    <input class="form-control fc-datepicker" id="scan_end_date" value="{{ $data['scan_end_date'] }}" placeholder="DD-MM-YYYY" type="text" required>
                                                                </div>

                                                                <div class="input-group col-5" style="padding-left: 5px;">
                                                                    <div class="input-group-text input-icon">
                                                                        <i class="bi bi-clock"></i>
                                                                    </div>
                                                                    <input class="form-control timepicker" id="scan_end_time" value="{{ $data['scan_end_time'] }}" placeholder="00:00 AM" type="text" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <button class="btn btn-primary" type="submit" id="update_agent_detail" style="float: right;position: relative;">
                                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;">Update</span>
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
    <div class="modal fade"  id="modalPreviewEmail">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header pd-20">
                    <h6 class="modal-title">Preview email</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body pd-0">
                    <div class="row">
                        <div class="col-lg-12" id="winner_template" style="display: none;">
                            <?php //echo $template_output->HtmlBody; ?>
                            <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; margin: 0; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #222222 !important; color: #FFFFFF !important;">
                                <tbody><tr>
                                    <td class="email-masthead" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 25px 0; text-align: center; background-color: #222222 !important; color: #FFFFFF !important;">
                                        <a href="website_url_Value" class="f-fallback email-masthead_name" style="color: #A8AAAF; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: none !important;">
                                            <img src="{{ url('assets/images/logo_black_1.png') }}" height="45" style="border: none;">
                                        </a>
                                    </td>
                                </tr>
                                <!-- Email Body -->
                                <tr>
                                    <td class="email-body" width="570" cellpadding="0" cellspacing="0" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; width: 100%; margin: 0; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #222222 !important; color: #FFFFFF !important;">
                                        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; margin: 0 auto; padding: 0; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #333333 !important; color: #FFFFFF !important;">
                                            <!-- Body content -->
                                            <tbody><tr>
                                                <td class="content-cell" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 10px 20px 20px;">
                                                    <div class="f-fallback">

                                                        <p class="align-center" style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important; text-align: center;">
                                                            <img class="second_logo_value" src="{{ $data['lottery_logo']!='' ? url('assets/images/media/' . $data['lottery_logo']) : '' }}" alt="image not found" style="width: 120px;">
                                                        </p>
                                                        <h1 class="align-center" style="margin-top: 0; color: #FFFFFF !important; font-size: 22px; font-weight: bold; text-align: center;">Congratulations!</h1>
                                                        <h2 style="margin-top: 0; color: #FFFFFF !important; font-size: 16px; font-weight: bold; text-align: left;">winner name,</h2>
                                                        <p style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important;">You have been randomly selected for {{ config('app.name') }} at {{ ucfirst($data['title']) }} on {{ date('M d, Y', strtotime($data['event_date'])).' ' . $data['event_time'] }}. Please read the instructions carefully.</p>
                                                        <p style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important;">Here's your winner information:</p>
                                                        <table class="attributes" width="100%" cellpadding="0" cellspacing="0" style="margin: 0 0 21px;">
                                                            <tbody><tr>
                                                                <td class="attributes_content" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; background-color: #222222 !important; padding: 16px;">
                                                                    <table width="100%" cellpadding="0" cellspacing="0">
                                                                        <tbody><tr>
                                                                            <td class="attributes_item" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 4px 0;"><strong>Name:</strong> winner name</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="attributes_item" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 4px 0;"><strong>Queuing No:</strong> #</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="attributes_item" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 4px 0;"><strong>UID:</strong> xxxxxxxxx</td>
                                                                        </tr>
                                                                        <tr style="guest_hide_Value">
                                                                            <td class="attributes_item" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 4px 0;"><strong>Guest's Name:</strong> guest name</td>
                                                                        </tr>
                                                                        <tr style="guest_hide_Value">
                                                                            <td class="attributes_item" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 4px 0;"><strong>Guest queuing No:</strong> #</td>
                                                                        </tr>
                                                                        </tbody></table>
                                                                </td>
                                                            </tr>
                                                            </tbody></table>
                                                        <p style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important;">{!! $data['winners_emails_instructions'] !!}</p>

                                                        <div class="align-center" style="text-align: center;"><img class="map_image_value" src="{{$data['winners_emails_map_image'] ? url('assets/images/media/' . $data['winners_emails_map_image']):'-'}}" alt="image not uploaded"></div>

                                                        {{--<p class="align-center reminders-title" style="margin: 1.1875em 0 0.4em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important; text-align: center;">Your QR Code:</p>
                                                        <div class="align-center" style="text-align: center;"><img src="../assets/images/media/dummy_qr_code.png" class="uid-img" style="width: 30%; margin: auto;"></div>--}}

                                                        <p class="align-center reminders-title" style="margin: 1.1875em 0 0.4em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important; text-align: center;">Some reminders:</p>
                                                        <div>{!! $data['winners_emails_reminders'] !!}</div>

                                                        <p style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important;">Please review the <a href="venue_link_Value" class="venue-link-color" style="color: #FFFFFF;">venue policies on prohibited items</a></p>

                                                        <p style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important;">Thank you,
                                                            <br>{{ config('app.name') }} Team</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                        <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; margin: 0 auto; padding: 0; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center; background-color: #222222 !important; color: #FFFFFF !important;">
                                            <tbody><tr>
                                                <td class="content-cell" align="center" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 10px 20px 20px;">
                                                    <p class="f-fallback sub align-center" style="margin: 0.4em 0 1.1875em; font-size: 13px; line-height: 1.625; color: #FFFFFF !important; text-align: center;"></p>
                                                    <p class="f-fallback sub align-center" style="margin: 0.4em 0 1.1875em; font-size: 13px; line-height: 1.625; color: #FFFFFF !important; text-align: center;">
                                                        This message was sent to <span style="color: #FFFFFF !important;">receiver_email_Value</span> as you signed up with {{ config('app.name') }}. Please do not reply to this email as this address is not monitored. Please <a href="contact_support_Value" style="color: #FFFFFF; text-decoration: underline;">contact support</a> for any questions.
                                                        <span class="unsubscribe_hide_Value" style="color: #FFFFFF !important;"><br>If you no longer wish to receive emails from {{ config('app.name') }}, <a href="https://subscriptions.pstmrk.it/demo/unsubscribe" style="color: #FFFFFF; text-decoration: underline;">click here</a> to unsubscribe.</span>
                                                    </p>
                                                    <p class="f-fallback sub align-center" style="margin: 0.4em 0 1.1875em; font-size: 13px; line-height: 1.625; color: #FFFFFF !important; text-align: center;">Copyright © {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>

                        <div class="col-lg-12" id="looser_template" style="display: none;">
                            <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; margin: 0; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #222222 !important; color: #FFFFFF !important;">
                                <tbody><tr>
                                    <td align="center" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                        <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; margin: 0; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #222222 !important; color: #FFFFFF !important;">
                                            <tbody><tr>
                                                <td class="email-masthead" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 25px 0; text-align: center; background-color: #222222 !important; color: #FFFFFF !important;">
                                                    <a href="website_url_Value" class="f-fallback email-masthead_name" style="color: #A8AAAF; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: none !important;">
                                                        <img src="https://lottery.snsohag.com/assets/images/logo_black_1.png" height="45" style="border: none;">
                                                    </a>
                                                </td>
                                            </tr>
                                            <!-- Email Body -->
                                            <tr>
                                                <td class="email-body" width="570" cellpadding="0" cellspacing="0" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; width: 100%; margin: 0; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #222222 !important; color: #FFFFFF !important;">
                                                    <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; margin: 0 auto; padding: 0; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #333333 !important; color: #FFFFFF !important;">
                                                        <!-- Body content -->
                                                        <tbody><tr>
                                                            <td class="content-cell" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 10px 20px 20px;">
                                                                <div class="f-fallback">

                                                                    <p class="align-center" style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important; text-align: center;">
                                                                        <img class="second_logo_value" src="{{ $data['lottery_logo']!='' ? url('../assets/images/media/' . $data['lottery_logo']) : '' }} " alt="image not found" style="width: 120px;">
                                                                    </p>
                                                                    <h1 class="align-center" style="margin-top: 0; color: #FFFFFF !important; font-size: 22px; font-weight: bold; text-align: center;">Thank you for entering {{config('app.name')}} {{ ucfirst($data['title']) }} {{ date('M d, Y', strtotime($data['event_date'])) }}</h1>
                                                                    <h2 style="margin-top: 0; color: #FFFFFF !important; font-size: 16px; font-weight: bold; text-align: left;">Not selected name,</h2>
                                                                    <p style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important;">You have not won the {{config('app.name')}} for {{ ucfirst($data['title']) }} {{ date('M d, Y', strtotime($data['event_date'])) }}, thank you for participating, please try again next time.</p>
                                                                    {!! $data['losers_emails_instructions'] !!}
                                                                    <p style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important;">Please review <a href="venue_link_Value" class="venue-link-color" style="color: #FFFFFF;">venue policies</a>.</p>

                                                                    <p style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important;">Thank you,
                                                                        <br>{{config('app.name')}} Team</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody></table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                                    <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; margin: 0 auto; padding: 0; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center; background-color: #222222 !important; color: #FFFFFF !important;">
                                                        <tbody><tr>
                                                            <td class="content-cell" align="center" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 10px 20px 20px;">
                                                                <p class="f-fallback sub align-center" style="margin: 0.4em 0 1.1875em; font-size: 13px; line-height: 1.625; color: #FFFFFF !important; text-align: center;"></p>
                                                                <p class="f-fallback sub align-center" style="margin: 0.4em 0 1.1875em; font-size: 13px; line-height: 1.625; color: #FFFFFF !important; text-align: center;">
                                                                    This message was sent to <span style="color: #FFFFFF !important;">receiver_email_Value</span> as you signed up with {{config('app.name')}}. Please do not reply to this email as this address is not monitored. Please <a href="contact_support_Value" style="color: #FFFFFF; text-decoration: underline;">contact support</a> for any questions.
                                                                    <span class="unsubscribe_hide_Value" style="color: #FFFFFF !important;"><br>If you no longer wish to receive emails from {{config('app.name')}}, <a href="https://subscriptions.pstmrk.it/demo/unsubscribe" style="color: #FFFFFF; text-decoration: underline;">click here</a> to unsubscribe.</span>
                                                                </p>
                                                                <p class="f-fallback sub align-center" style="margin: 0.4em 0 1.1875em; font-size: 13px; line-height: 1.625; color: #FFFFFF !important; text-align: center;">Copyright © {{ date('Y') }} {{config('app.name')}}. All rights reserved.</p>
                                                            </td>
                                                        </tr>
                                                        </tbody></table>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pd-20">
                    <button class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" >Close</button>
                </div>
            </div>
        </div>
    </div>
    <!--/Modal-->
    <!--Modal-->
    <div class="modal fade"  id="modalNewFields">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header pd-20">
                    <h6 class="modal-title">Custom input field</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body pd-0">
                    <div class="alert alert-add-new" style="display: none;"></div>
                    <div class="form-group row d-flex">
                        <label class="col-md-3 col-form-label" for="selected_input_field">Input field</label>
                        <div class="col-md-9">
                            <select name="" id="selected_input_field" class="form-control" disabled readonly>
                                <option value="text_input">Text input</option>
                                <option value="datetime_input">Date-time input</option>
                                <option value="selection_input">Selection input</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row d-flex">
                        <label class="col-md-3 col-form-label" for="input_label">Input label</label>
                        <div class="col-md-9">
                            <input type="text" id="input_label" placeholder="Type input label" class="form-control">
                        </div>
                    </div>

                    <div class="form-group row d-none" id="selection_items_wrap">
                        <label class="col-md-3 col-form-label" for="">Selection items</label>
                        <div class="col-md-9">
                            <select class="form-control" multiple="multiple" id="selection_items_select">

                            </select>
                        </div>
                    </div>

                    <div class="form-group row d-none" id="multi_selection_type">
                        <label class="col-md-3 col-form-label" for="">Multi selection</label>
                        <div class="col-md-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="multi_selection" id="selection_type_multi_yes" value="1">
                                <label class="form-check-label" for="selection_type_multi_yes">Yes</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="multi_selection" id="selection_type_multi_no" value="0">
                                <label class="form-check-label" for="selection_type_multi_no">No</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row d-flex">
                        <label class="col-md-3 col-form-label" for="">Input condition</label>
                        <div class="col-md-9">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="input_condition" id="input_condition_required" value="required">
                                <label class="form-check-label" for="input_condition_required">Required (<span class="text-red">&#42;</span>)</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="input_condition" id="input_condition_optional" value="optional">
                                <label class="form-check-label" for="input_condition_optional">Optional</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer pd-20">
                    <button class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" >Close</button>
                    <button class="btn btn-primary" id="input_save_changes">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!--/Modal-->

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
                            {{ $data['description'] }}
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
                            {{ $data['how_it_works'] }}
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
                            {{ $data['terms_conditions'] }}
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
        .sweet-alert button.cancel {
            color: #fff !important;
            background: #dd2540 !important;
            border-color: #df2540 !important;
        }
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
        .tab_wrapper.right_side2>ul {
            float: left !important;
            width: 25% !important;
        }

        .tab_wrapper.right_side2 .content_wrapper {
            float: right !important;
            width: 73.5% !important;
        }

        .tab_wrapper.right_side2>ul li {
            text-align: left;
        }
        .select2-container {
            width: 100% !important;
        }

        .select2-container input {
            color: #fff !important;
        }

        span.form_cus_action {
            padding-left: 8px;
            padding-right: 8px;
            font-size: 15px;
        }

        span.form_cus_action i {
            color: var(--success);
            cursor: pointer;
        }

        span.form_cus_action.delete {
            padding-left: 0;
        }

        span.form_cus_action.delete i {
            color: var(--danger);
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
    {{ Html::script('assets/plugin/sweet-alert/sweetalert.min.js') }}
    <!-- FORMEDITOR JS -->
    {{ Html::script('assets/plugin/quill/quill.min.js') }}
    {{ Html::script('user/js/add_lottery.js?t='.rand(0,10000)) }}
    {{ Html::script('user/js/emails_modify.js?t='.rand(0,10000)) }}
    {{ Html::script('assets/plugin/tabs/jquery.multipurpose_tabcontent.js') }}
    {{ Html::script('assets/plugin/tabs/tab-content.js') }}


    <script>

        var customization_form = '{{ route('user.customization-form') }}';
        var modify_emails = '{{ route('user.modify-emails') }}';
        var update_winners_emails = '{{ route('user.modify-emails',['update_winners_emails'=>true]) }}';
        var update_losers_emails = '{{ route('user.modify-emails',['update_losers_emails'=>true]) }}';
        var edit_tab_3 = '{{ route('user.edit-lottery',['id' => request()->query('id')]) }}';
        var winner_edit_tab_3 = '{{ route('user.edit-lottery',['id' => $data['lottery_id']]) }}';

        var winners_emails_edit_tab_3 = '{{ route('user.edit-lottery',['id' => $data['lottery_id']]) }}';
        var update_lottery_agents_details = '{{ route('user.update-lottery-agents-details') }}';
        var edit_tab_4 = '{{ route('user.edit-lottery',['id' => $data['lottery_id']]) }}';
        var edit_lottery_details = '{{ route('user.edit-lottery-details') }}';
        var edit_lottery_detail_run = '{{ route('user.edit-lottery-details',['edit_lottery'=>true]) }}';

        $(function() {
            'use strict'

            var tooltip = new bootstrap.Tooltip('.lott_status_tt', {
                template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
            });

            $('#lottery_status').change(function(){
                if($(this).is(':checked')) {
                    $('.lott_status_tt').attr('data-bs-original-title', 'Active');
                } else {
                    $('.lott_status_tt').attr('data-bs-original-title', 'Deactive');
                }
                tooltip.show();
            });

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
            var quill_winners_emails_instructions = new Quill('#winners_emails_instructions', {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow',
                placeholder: 'Enter instructions'
            });

            var quill_winners_emails_reminders = new Quill('#winners_emails_reminders', {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow',
                placeholder: 'Enter reminders'
            });

            var quill_losers_emails_instructions = new Quill('#losers_emails_instructions', {
                modules: {
                    toolbar: toolbarOptions
                },
                theme: 'snow',
                placeholder: 'Enter instructions'
            });

        });
    </script>

    <script>

        var tooltip_primary = $('[data-bs-toggle="tooltip-primary"]');
        for (let index = 0; index < tooltip_primary.length; index++) {
            var tooltip = new bootstrap.Tooltip(tooltip_primary[index], {
                template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
            });
        }

        <?php
        if($data['allow_guest']==1){?>
        $('#guest_').css("display","inline");
        <?php }
        ?>
        // Datepicker
        $('.fc-datepicker').datepicker({
            dateFormat: 'dd-mm-yy',
            showOtherMonths: true,
            selectOtherMonths: true
        });
        $('.timepicker').timepicker({
            timeFormat: 'h:i A'
        });
        $('a[data-bs-toggle="tab"]').click(function(){
            var href = $(this).attr('href');
            if(href == '#tab1'){
                {{--window.history.pushState({"html": $('body').html(), "pageTitle": $('title').text()},"", 'edit_lottery.php?id='+<?php echo $_GET['id'];?>+'&edit_tab=1');--}}
                window.history.pushState({"html": $('body').html(), "pageTitle": $('title').text()},"", '{{ route('user.edit-lottery',['id'=>request('id'),'edit_tab'=>1]) }}');
            }else if(href == '#tab2'){
                {{--window.history.pushState({"html": $('body').html(), "pageTitle": $('title').text()},"", 'edit_lottery.php?id='+<?php echo $_GET['id'];?>+'&edit_tab=2');--}}
                window.history.pushState({"html": $('body').html(), "pageTitle": $('title').text()},"", '{{ route('user.edit-lottery',['id'=>request('id'),'edit_tab'=>2]) }}');
            }else if(href == '#tab3'){
                {{--window.history.pushState({"html": $('body').html(), "pageTitle": $('title').text()},"", 'edit_lottery.php?id='+<?php echo $_GET['id'];?>+'&edit_tab=3');--}}
                window.history.pushState({"html": $('body').html(), "pageTitle": $('title').text()},"", '{{ route('user.edit-lottery',['id'=>request('id'),'edit_tab'=>3]) }}');
            }else if(href == '#tab4'){
                {{--window.history.pushState({"html": $('body').html(), "pageTitle": $('title').text()},"", 'edit_lottery.php?id='+<?php echo $_GET['id'];?>+'&edit_tab=4');--}}
                window.history.pushState({"html": $('body').html(), "pageTitle": $('title').text()},"", '{{ route('user.edit-lottery',['id'=>request('id'),'edit_tab'=>4]) }}');
            }
        });

        $(document).ready(function(){
            function activaTab(tab){
                if($('.panel-tabs li a[href="#' + tab + '"]').length){
                    $('.panel-tabs li a[href="#' + tab + '"]').get(0).click();
                }
            };
            {{--activaTab('tab<?php echo !empty($_GET['edit_tab']) ? $_GET['edit_tab'] : ""?>');--}}
            activaTab('tab{{ !empty(request('edit_tab')) ? request('edit_tab') : '' }}');

            $('#customFieldsDropDown').click(function(){
                $(this).find('.dropdown-menu').toggleClass('show');
            });

            var tooltipLottStatus = new bootstrap.Tooltip('.lott_status_tt', {
                template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
            });

            $('#lottery_status').change(function(){
                if($(this).is(':checked')) {
                    $('.lott_status_tt').attr('data-bs-original-title', 'Active');
                } else {
                    $('.lott_status_tt').attr('data-bs-original-title', 'Deactive');
                }
                tooltipLottStatus.show();
            });

            $('.entry_tab_form').click(function() {
                if($(this).attr('id') == 'form_loosers_tab') {
                    localStorage.setItem('form_email_entry_tab', 'not-selected');
                } else {
                    localStorage.setItem('form_email_entry_tab', 'selected');
                }
            });

            if(document.readyState == "complete") {
                var email_form_entry_tab = localStorage.getItem('form_email_entry_tab');
                if(email_form_entry_tab == 'not-selected') {
                    $('#form_loosers_tab').click();
                }
            }

        });
    </script>

    <script>
        $(function() {
            'use strict'
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

            $('.preview_btn').click(function() {
                if($(this).attr('data-template') == 'winner') {
                    $('#looser_template').hide();
                    $('#winner_template').show();
                } else {
                    $('#winner_template').hide();
                    $('#looser_template').show();
                }
                $('#modalPreviewEmail').modal('show');
            });
        });
    </script>


    <script>
        {{--var custom_input_fields = <?php if(json_encode($form_customization) == 'null' || json_encode($form_customization) == 'false'){echo '[]';}else{echo json_encode($form_customization);}?>;--}}
        var custom_input_fields = {!! (json_encode($data['form_customization']) == 'null' || json_encode($data['form_customization']) == 'false') ? '[]' : json_encode($data['form_customization']) !!};
        function setup_input_cus(e){
            $('#selected_input_field').val('');
            $('#input_label').val('');
            $('#input_label').attr('data-set-type', $(e).attr('data-input-type'));
            $('#selection_items_select').html('');
            $('[name="multi_selection"]').prop('checked', false);
            $('[name="input_condition"]').prop('checked', false);

            var data_value = $(e).attr('data-value');
            $('#selected_input_field').val(data_value);

            if(data_value == 'selection_input'){
                $('#selection_items_wrap').addClass('d-flex').removeClass('d-none');
                $('#multi_selection_type').addClass('d-flex').removeClass('d-none');
            }else{
                $('#selection_items_wrap').removeClass('d-flex').addClass('d-none');
                $('#multi_selection_type').removeClass('d-flex').addClass('d-none');
            }
            $('#input_save_changes').attr('data-type', 'new');
        }
        $('#input_save_changes').click(function(){
            var dataType = $('#input_save_changes').attr('data-type');
            var dataId = $('#input_save_changes').attr('data-id');
            var selected_input_field = $('#selected_input_field').val();
            var input_label = $('#input_label').val();
            var input_type = $('#input_label').attr('data-set-type');
            var input_condition = $('input[name="input_condition"]:checked').val();
            var error = false;
            $('.alert-add-new').fadeOut();

            if(selected_input_field != '' && input_label != '' && input_condition != '' && input_condition != undefined){
                error = false;
            }else{
                error = true;
            }

            if(selected_input_field == 'selection_input'){
                var selection_items = $('#selection_items_select').val();

                if(selection_items.length == 0){
                    error = true;
                }
                var multi_selection = $('input[name="multi_selection"]:checked').val();
                if(multi_selection != '' && multi_selection != undefined){

                }else{
                    error = true;
                }
            }

            if(error == false){
                var new_input_field = {};
                new_input_field['selected_input_field'] = selected_input_field;
                new_input_field['input_label'] = input_label;
                new_input_field['input_condition'] = input_condition;
                new_input_field['input_type'] = input_type;
                if(selected_input_field == 'selection_input'){
                    new_input_field['selection_items_select'] = selection_items;
                    new_input_field['multi_selection'] = multi_selection;
                }
                if(dataType == 'new'){
                    custom_input_fields.push(new_input_field);
                }else if(dataType == 'edit'){
                    custom_input_fields[dataId] = new_input_field;
                }


                $('#selected_input_field').val('');
                $('#input_label').val('');
                $('#selection_items_select').html('');
                $('[name="multi_selection"]').prop('checked', false);
                $('[name="input_condition"]').prop('checked', false);

                gen_new_input_fields();
            }else{
                $('.alert-add-new').html('All field are required.').addClass('alert-danger').removeClass('alert-success').fadeIn();
            }
        });

        function gen_new_input_fields(){
            $('#custom_fields_wrap').children('.row').html('');
            if(custom_input_fields.length > 0){
                $('#custom_field_placeholder').hide();
                for (let index = 0; index < custom_input_fields.length; index++) {
                    var new_input_field = custom_input_fields[index];
                    var new_input_html = `<div class="col-md-6"`;
                    if(new_input_field['selected_input_field'] == 'datetime_input'){
                        new_input_html += ` style="padding-right: 0;"`;
                    }
                    new_input_html += `>
                                        <label class="form-label" style="margin-left: 1px;">${new_input_field['input_label']}`;
                    if(new_input_field['input_condition'] == 'required'){
                        new_input_html += `<span class="text-red">&#42;</span>`;
                    }
                    new_input_html += `<span class="form_cus_action"><i class="bi bi-pencil-square" title="Edit" onclick="edit_cus_field(${index});"></i></span><span class="form_cus_action delete"><i class="bi bi-x-lg" title="Delete" onclick="delete_cus_field(${index});"></i></span></label>`;
                    if(new_input_field['selected_input_field'] == 'text_input'){
                        new_input_html += `<div class="wrap-input100 validate-input"><input class="input100 form-control" type="${new_input_field['input_type']}" name="" id="" placeholder="${new_input_field['input_label']}" style="padding-left: 12px;" disabled readonly></div>`;
                    }

                    if(new_input_field['selected_input_field'] == 'datetime_input'){
                        new_input_html += `<div class="wrap-input100 row">
                        <div class="input-group col-7" style="padding-right: 5px;">
                            <input class="form-control fc-datepicker hasDatepicker" id="" name="" placeholder="DD-MM-YYYY" type="text" required="" disabled readonly>
                        </div>
                        <div class="input-group col-5" style="padding-right: 0px;">
                            <input class="form-control timepicker ui-timepicker-input"  id="" name="" placeholder="00:00 AM" type="text" required="" autocomplete="off" disabled readonly>
                        </div>
                    </div>`
                    }

                    if(new_input_field['selected_input_field'] == 'selection_input'){
                        new_input_html += `
                    <div class="wrap-input100 validate-input"><select class="form-control" disabled readonly><option>Select ${String(new_input_field['input_label']).toLowerCase()}</option>`;
                        for (let index2 = 0; index2 < new_input_field['selection_items_select'].length; index2++) {
                            new_input_html += `<option>${new_input_field['selection_items_select'][index2]}</option>`;

                        }
                        new_input_html += `</select></div>`;
                    }

                    new_input_html += `</div>`;
                    $('#custom_fields_wrap').children('.row').append(new_input_html);
                }
                // $('#modalNewFields').modal('hide');
            }else{
                $('#custom_field_placeholder').show();
            }
            $('#customization_values').val(JSON.stringify(custom_input_fields));
        }

        function edit_cus_field(id){
            $('#selected_input_field').val('');
            $('#input_label').val('');
            $('#selection_items_select').html('');
            $('[name="multi_selection"]').prop('checked', false);
            $('[name="input_condition"]').prop('checked', false);

            var edit_item = custom_input_fields[id];
            $('#input_label').attr('data-set-type', edit_item['input_type']);
            $('#selected_input_field').val(edit_item['selected_input_field']);
            $('#input_label').val(edit_item['input_label']);

            if(edit_item['input_condition'] == 'required'){
                $('#input_condition_required').prop('checked', true);
            }else if(edit_item['input_condition'] == 'optional'){
                $('#input_condition_optional').prop('checked', true);
            }


            if(edit_item['selected_input_field'] == 'selection_input'){
                if(edit_item['multi_selection'] == '1'){
                    $('#selection_type_multi_yes').prop('checked', true);
                }else if(edit_item['multi_selection'] == '0'){
                    $('#selection_type_multi_no').prop('checked', true);
                }

                for (let index2 = 0; index2 < edit_item['selection_items_select'].length; index2++) {
                    $('#selection_items_select').append(`<option selected>${edit_item['selection_items_select'][index2]}</option>`);
                }
            }

            if(edit_item['selected_input_field'] == 'selection_input'){
                $('#selection_items_wrap').addClass('d-flex').removeClass('d-none');
                $('#multi_selection_type').addClass('d-flex').removeClass('d-none');
            }else{
                $('#selection_items_wrap').removeClass('d-flex').addClass('d-none');
                $('#multi_selection_type').removeClass('d-flex').addClass('d-none');
            }

            $('#input_save_changes').attr('data-type', 'edit');
            $('#input_save_changes').attr('data-id', id);

            $("#modalNewFields").modal("show");
        }
        function delete_cus_field(id){
            if (confirm("Are you sure you want to delete this?") == true) {
                custom_input_fields.splice(id, 1);
                gen_new_input_fields();
            }
        }

        if(custom_input_fields.length > 0){
            gen_new_input_fields();
        }
    </script>


@endpush



