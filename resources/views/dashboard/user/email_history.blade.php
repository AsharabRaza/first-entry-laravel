@extends('dashboard.user.layouts.template')

@section('content')

    @php
        $tooltip_status = 1;
        $tooltip_primary = 'data-bs-toggle="tooltip-primary"';
        $eml_hist_sel_lott_tooltip = $tooltip_primary.' title="Select the lottery you want to view" ';
        $eml_hist_sel_notsel_type_tooltip = $tooltip_primary.' title="Select the type you want to view (selected or not selected)" ';
    @endphp

    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">History</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Event Management</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Emails</a></li>
                            <li class="breadcrumb-item active" aria-current="page">History</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header" style="place-content: space-between;">
                                <div>
                                    <h3 class="card-title">Emails history</h3>
                                    <small>All times are in <strong>{{ 'Selected Timezone' }}</strong></small>
                                </div>
                                <div>
                                    <a href="{{ route('user.send-emails') }}" class="btn btn-primary">Send emails</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-emails" style="display: none;"></div>

                                <div>
                                    <form action="{{ route('user.email-history') }}" method="GET" id="emails_history_filter">
                                        <div style="float: left;margin-right: 16px;">
                                            <label for=""><span {{ ($tooltip_status) ? $eml_hist_sel_lott_tooltip : '' }}>Selected lottery : </span></label>
                                            <select name="lottery_id" id="" class="select2">
                                                @foreach($available_l as $row)
                                                    <option value="{{ $row->id }}" {{ (request()->has('lottery_id') && request()->input('lottery_id') == $row->id) ? 'selected' : '' }}>
                                                        {{ $row->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div style="float: left;margin-right: 12px;">
                                            <label for=""><span {{ ($tooltip_status) ? $eml_hist_sel_notsel_type_tooltip : '' }}>Selected type : </span></label>
                                            <select name="entries_type" id="" class="select2">
                                                <option value="Winners" {{ (request()->has('entries_type') && request()->input('entries_type') == 'Winners') ? 'selected' : '' }}>Selected entries</option>
                                                <option value="Losers" {{ (request()->has('entries_type') && request()->input('entries_type') == 'Losers') ? 'selected' : '' }}>Non-selected entries</option>
                                            </select>
                                        </div>
                                        <div>
                                            <button type="submit" class="btn btn-info" id="filter_btn">Filter</button>
                                        </div>
                                    </form>
                                    @if (!request()->has('lottery_id') && !request()->has('entries_type'))
                                        <script>
                                            $('#filter_btn').get(0).click();
                                        </script>
                                    @endif
                                </div>
                                <hr>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                        <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">#</th>
                                            <th class="wd-20p border-bottom-0">To</th>
                                            <th class="wd-20p border-bottom-0">Received At</th>
                                            <th class="wd-20p border-bottom-0">Status</th>
                                            <th class="wd-25p border-bottom-0 action">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if (isset($emails_history_f1))
                                            @if(isset($emails_history_f1['Messages']))
                                                @foreach ($emails_history_f1['Messages'] as $key => $val)
                                                    <tr>
                                                        <td class="text-center">{{ $loop->iteration }}</td>
                                                        <td>{{ $val['To'][0]['Email'] }}</td>
                                                        <td class="text-center">{{ formatted_date($val['ReceivedAt']) }}</td>
                                                        <td class="text-center">{{ $val['Status'] }}</td>
                                                        <td class="text-center">
                                                            <div class="btn-group align-top">
                                                                <button class="btn btn-sm btn-primary badge resend_email" title="Resend email" type="button" id="" data-id="{{ $val['To'][0]['Email'] }}" data-type="{{ request('entries_type') }}" data-lid="{{ request('lottery_id') }}"><i class="bi bi-arrow-clockwise"></i></button>
                                                                <button class="btn btn-sm btn-primary badge see_analytics" title="Analytics" type="button" id="" data-id="{{ $val['messageId'] }}" data-bs-target="#modalEmailAnalytics" data-bs-toggle="modal"><i class="bi bi-graph-up-arrow"></i></button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        @else
                                            <tr><td colspan="5" class="text-center">No data available.</td></tr>
                                        @endif

                                        </tbody>
                                    </table>
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

    <!--Modal-->
    <div class="modal fade"  id="modalEmailAnalytics">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header pd-20">
                    <h6 class="modal-title">Email Analytics</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body pd-0">
                    <div id="loader_wrap" style="min-height: 200px;display: grid;place-content: center;align-items: center">
                        <div class="text-center">
                            <div class="spinner-border" style="width: 5rem; height: 5rem;" role="status"></div>
                        </div>

                        <label for="" class="d-block text-center mt-2">Loading...</label>
                    </div>

                    <div id="modalEmailAnalyticsData" style="display: none;">

                    </div>

                </div>
                <div class="modal-footer pd-20">
                    <button class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" >Close</button>
                </div>
            </div>
        </div>
    </div>

    @endsection
@push('css')
    <style>
        .dark-mode .lottery_list a {
            color: #aaaad8;
        }

        .dark-mode a, a:hover {
            color: #fff !important;
        }

        td a:hover, .list_a:hover {
            color: var(--primary-bg-color) !important;
        }

        .right_content {
            float: right;
        }

        .list-group-item .badge.bg-secondary {
            margin-left: 4px;
        }

        select + .select2-container {
            min-width: 200px !important;
        }

        @-moz-keyframes spin {
            100% { -moz-transform: rotate(360deg); }
        }

        @-webkit-keyframes spin {
            100% { -webkit-transform: rotate(360deg); }
        }

        @keyframes spin {
            100% {
                -webkit-transform: rotate(360deg);
                transform:rotate(360deg);
            }
        }

        .resend_email_animate i {
            display: block;
            -webkit-animation:spin .55s linear infinite;
            -moz-animation:spin .55s linear infinite;
            animation:spin .55s linear infinite;
        }
    </style>
@endpush
@push('js')

    <script>
        var see_analytics = '{{ route('user.see-analytics') }}';
    </script>

    {{ Html::script('assets/js/table-data.js') }}

    <script>
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

    {{ Html::script('assets/plugin/sweet-alert/sweetalert.min.js') }}

    {{ Html::script('user/js/emails_modify.js?t='.rand(0,10000)) }}

@endpush


























