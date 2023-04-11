
@extends('dashboard.user.layouts.template')

@section('content')
    @php
    //dd($data['events']);
    @endphp

    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Add event</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Events</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add event</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header" style="place-content: space-between;">
                                <h3 class="card-title">Add event</h3>
                                <small>All times are in <strong>{{ 'selected timezone' }}</strong></small>
                            </div>
                            <form id="add_event_form" onsubmit="return false" method="POST" style="display: inline-grid;">
                                <div class="card-body">
                                    <div class="alert add_event_alert" style="display: none;"></div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card no-shadow">
                                                <div class="card-header">
                                                    <h3 class="card-title">Event information</h3>
                                                </div>
                                                <div class="card-body">

                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">Event name</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="name" id="name" value="{{ isset($dup_row->name)?$dup_row->name:'' }}" placeholder="Enter event name" class="form-control" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">Event banner image</label>
                                                        <div class="col-md-9">
                                                            <input type="file" name="image" id="image" value="" class="form-control">

                                                            <div class="mt-2 img-thumbnail {{ isset($_REQUEST['duplicate_id']) ? ($dup_row->image == '' ? 'd-none' : '') : 'd-none' }}" style="width: fit-content; position: relative;" id="preview_image_wrap">
                                                                <img src="{{ isset($dup_row->image) && $dup_row->image != '' ? url('assets/images/media/' . $dup_row->image) : '' }}" id="preview_image" style="width: 120px;">
                                                                <input type="hidden" id="fake_image" data-value="{{ isset($dup_row->image) && $dup_row->image != '' ? $dup_row->image : '' }}" value="{{ isset($dup_row->image) && $dup_row->image != '' ? $dup_row->image : '' }}">
                                                                <button type="button" class="remove_btn" id="remove_image"><i class="bi bi-x-circle-fill"></i></button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">Date</label>
                                                        <div class="col-md-9">
                                                            <input type="date" name="date" id="date" value="{{ isset($dup_row->date)?$dup_row->date:'' }}" class="form-control" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">Time</label>
                                                        <div class="col-md-9">
                                                            <input type="time" name="time" id="time" value="{{ isset($dup_row->time)?$dup_row->time:'' }}" class="form-control" required="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">Location</label>
                                                        <div class="col-md-9">
                                                            <input type="text" name="location" id="location" value="{{ isset($dup_row->location)?$dup_row->location:'' }}" class="form-control" required="">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card no-shadow">
                                                <div class="card-header">
                                                    <h3 class="card-title">Event details</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">About the event</label>
                                                        <div class="col-md-9">
                                                            <textarea class="form-control" name="about_event" id="about_event" cols="30" rows="10">{{ isset($dup_row->about_event)?$dup_row->about_event:'' }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">Event image</label>
                                                        <div class="col-md-9">
                                                            <input type="file" class="form-control" name="about_event_image" id="about_event_image">

                                                            <div class="mt-2 img-thumbnail {{ isset($_REQUEST['duplicate_id']) ? ($dup_row->about_event_image == '' ? 'd-none' : '') : 'd-none' }}" style="width: fit-content; position: relative;" id="preview_about_event_image_wrap">
                                                                <img src="{{ isset($dup_row->about_event_image) && $dup_row->about_event_image != '' ? url('assets/images/media/' . $dup_row->about_event_image) : '' }}" id="preview_about_event_image" style="width: 120px;">
                                                                <input type="hidden" id="fake_about_event_image" data-value="{{ isset($dup_row->about_event_image) && $dup_row->about_event_image != '' ? $dup_row->about_event_image : '' }}" value="{{ isset($dup_row->about_event_image) && $dup_row->about_event_image != '' ? $dup_row->about_event_image : '' }}">
                                                                <button type="button" class="remove_btn" id="remove_about_event_image"><i class="bi bi-x-circle-fill"></i></button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">How it works</label>
                                                        <div class="col-md-9">
                                                            <textarea class="form-control" name="how_it_works" id="how_it_works" cols="30" rows="10">{{ isset($dup_row->how_it_works)?$dup_row->how_it_works:'' }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit" id="add_btn" style="float: right;position: relative;">
                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;">Add</span>
                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;"><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;" role="status"></div></span>
                                    </button>
                                </div>
                            </form>
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

        @media (max-width: 576px) {
            .input-icon {
                display: none;
            }
            .input-icon + .form-control {
                border-radius: 7px !important;
            }
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
    </style>

@endpush
@push('js')
    <script>
        var add_event = '{{ route("user.add-event") }}';
    </script>

    {{ Html::script('user/js/event.js?t='.rand(0,10000)) }}
    {{ Html::script('assets/plugin/sweet-alert/sweetalert.min.js') }}


@endpush
