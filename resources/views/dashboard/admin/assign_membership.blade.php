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
                        <h1 class="page-title">Memberships settings</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Management</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Memberships</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Memberships settings</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 -->
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        <div class="card">
                            <form id="add_membership_form" onsubmit="return false" method="POST">
                                @csrf
                                <div class="card-header" style="place-content: space-between;">
                                    <h3 class="card-title">Assign/Update Membership</h3>
                                    <small>All times are in <strong>selected timezone</strong></small>
                                    <div class="alert add_membership_alert" style="display: none;"></div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="card no-shadow">
                                                <div class="card-header">
                                                    <h3 class="card-title">User details</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">User</label>
                                                        <div class="col-md-9">
                                                            <select name="user_id" id="user_id" class="form-control select2">
                                                                <option value="" selected disabled>Select a user</option>
                                                                @if(count($data['users']) > 0)
                                                                    @foreach($data['users'] as $user)
                                                                        <option value="{{ $user->id }}" @if($request->filled('user_id') && $request->user_id == $user->id) {{ 'selected' }} @else '' @endif>{{ $user->id . '. ' . $user->first_name.' '.$user->last_name . ' - ' . $user->email }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="card no-shadow">
                                                <div class="card-header">
                                                    <h3 class="card-title">Membership info</h3>
                                                </div>
                                                <div class="card-body">
                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">Membership package</label>
                                                        <div class="col-md-9">
                                                            <select name="membership_id" id="membership_id" class="form-control select2">
                                                                <option value="" selected disabled>Select a package</option>
                                                                @if(count($data['memberships']) > 0)
                                                                    @foreach($data['memberships'] as $member)
                                                                        @php
                                                                            if($member->membership_type == 'one_time'){
                                                                                $pricing = '$ '.$member->cost;
                                                                            }elseif($member->membership_type == 'enterprise_plus'){
                                                                                $pricing = '$ '.$member->total_yearly . '/Y';
                                                                            }else{
                                                                                $pricing = '$ '.$member->monthly . '/M';
                                                                            }

                                                                        @endphp
                                                                        <option value="{{ $member->id }}">{{ $member->membership_nicename . ' - ' . $pricing }}</option>
                                                                    @endforeach
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group row d-flex">
                                                        <label class="col-md-3 col-form-label" for="startDate">Expire date-time</label>
                                                        <div class="col-md-9 row pe-0">
                                                            <div class="col-sm-8 pe-0">
                                                                <input class="form-control fc-datepicker" id="expire_date" name="expire_date" value="" placeholder="DD-MM-YYYY" type="text" required>
                                                            </div>
                                                            <div class="col-sm-4 pe-0">
                                                                <input class="form-control timepicker" value="" name="expire_time" id="expire_time" placeholder="00:00 AM" type="text" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <!-- <a href="javascript:void(0);" class="btn btn-primary mt-1">Update</a> -->
                                    <button type="submit" class="btn btn-primary mt-1" id="add_btn">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                {{--<div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xl-12">
                        <div class="card">
                            <div class="card-header" style="place-content: space-between;">
                                <h3 class="card-title">Modify Memberships settings</h3>
                                <small>Last updated: <strong>00-00-0000 00:00 AM EST</strong></small>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="total_trial_days">Total trial days</label>
                                    <input type="number" class="form-control" id="total_trial_days" value="15" placeholder="0" required>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <a href="javascript:void(0);" class="btn btn-primary mt-1">Update</a>
                            </div>
                        </div>
                    </div>
                </div>--}}



            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!--app-content end-->


@endsection
@push('css')
@endpush
@push('js')
    <!-- TIMEPICKER JS -->
    {{ Html::script('assets/plugin/time-picker/jquery.timepicker.js') }}
    {{ Html::script('assets/plugin/date-picker/date-picker.js') }}
    {{ Html::script('assets/plugin/date-picker/jquery-ui.js') }}
    {{ Html::script('superAdmin/js/membership.js?t='.rand(0,1000))}}

    <script>
        var assign_membership = '{{ route('admin.assign-membership') }}';
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
