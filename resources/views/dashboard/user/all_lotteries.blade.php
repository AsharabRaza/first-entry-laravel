@extends('dashboard.user.layouts.template')

@section('content')
    @php
        $tooltip_status = 1;
        $tooltip_primary = 'data-bs-toggle="tooltip-primary"';
        $all_lott_row_winners_limit_tooltip = $tooltip_primary.' title="Quantity of winners to be selected" ';
        $all_lott_row_view_tooltip = $tooltip_primary.' title="view your online form" ';
        $all_lott_row_edit_tooltip = $tooltip_primary.' title="edit your event/lottery" ';
        $all_lott_row_duplicate_tooltip = $tooltip_primary.' title="Duplicate your event/lottery" ';
        $all_lott_row_erase_tooltip = $tooltip_primary.' title="Erase your event/lottery" ';
        $all_lott_row_winners_limit_tooltip = $tooltip_primary.' title="Quantity of winners to be selected" ';
    @endphp
    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">All Lotteries</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Event Lotteries</a></li>
                            <li class="breadcrumb-item active" aria-current="page">All Lotteries</li>
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
                                    <h3 class="card-title">All Lotteries</h3>
                                    <small>All times are in <strong>{{ 'selected timezone' }}</strong></small>
                                </div>
                                <div>
                                    <a href="{{ route('user.add-lottery') }}" class="btn btn-primary">Create lottery</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-entries" style="display: none;"></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                        <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">SN</th>
                                            <th class="wd-20p border-bottom-0">Logo</th>
                                            <th class="wd-20p border-bottom-0">Title</th>
                                            <th class="wd-15p border-bottom-0">Lottery URL</th>
                                            <th class="wd-25p border-bottom-0">Date of event</th>
                                            <th class="wd-15p border-bottom-0">Verification agents</th>
                                            <th class="wd-15p border-bottom-0">Country</th>
                                            <th class="wd-15p border-bottom-0">Timezone</th>
                                            <th class="wd-15p border-bottom-0">Winners</th>
                                            <th class="wd-10p border-bottom-0">Status</th>
                                            <th class="wd-10p border-bottom-0">Lottery - Start date and time</th>
                                            <th class="wd-10p border-bottom-0">Lottery - End date and time</th>
                                            <th class="wd-25p border-bottom-0">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($data['lotteries']) > 0)
                                                @foreach($data['lotteries'] as $lottery)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td class="align-middle text-center">
                                                            @if($lottery->header_image == '' || $lottery->header_image == NULL)
                                                                <img alt="image" class="avatar avatar-md br-7" src="{{ url('assets/images/default-avatar.jpg') }}">
                                                            @else
                                                                <img alt="image" class="avatar avatar-md br-7" src="{{ url('assets/images/media/'.$lottery->header_image) }}">
                                                            @endif
                                                        </td>
                                                        <td>{{ $lottery->title }}</td>
                                                        <td>{{ $lottery->lottery_url }}</td>
                                                        <td>{{ $lottery->event_datetime }}</td>
                                                        <td>{{ $lottery->lottery_agents }}</td>
                                                        <td>{{ getCountriesNames($lottery->country_code, true) }}</td>
                                                        <td>{{ $lottery->timezone }}</td>
                                                        @php
                                                            $current_datetime = date('d-m-Y h:i A');
                                                            $end_datetime = convert_timezone_new($lottery->end_datetime_utc, 'UTC',$lottery->timezone, 'M d, Y h:i a');
                                                            $start_datetime = convert_timezone_new($lottery->start_datetime_utc, 'UTC',$lottery->timezone, 'M d, Y h:i a');
                                                        @endphp
                                                        <td>
                                                            <span @if($tooltip_status){{$all_lott_row_winners_limit_tooltip}}@endif>{{$lottery->total_winners}}</span>
                                                            @if(strtotime($current_datetime) > strtotime($end_datetime) || (strtotime($current_datetime) >= strtotime($start_datetime) && strtotime($current_datetime) <= strtotime($end_datetime)))
                                                                <a href="{{route('user.all-entries', ['id' => $lottery->id])}}" class="badge bg-primary rounded-pill" style="margin-right: 2px;margin-left: 4px;" data-bs-placement="top" data-bs-toggle="tooltip-primary" title="Total entries">{{$lottery->selected_total_entries}}</a>
                                                                @if(strtotime($current_datetime) > strtotime($end_datetime))
                                                                    <a href="{{route('user.all-winners', ['id' => $lottery->id])}}" class="badge bg-info rounded-pill" style="margin-right: 2px;" data-bs-placement="top" data-bs-toggle="tooltip-info" title="Total winners">{{$lottery->selected_total_winners}}</a>
                                                                    <a href="{{route('user.all-losers', ['id' => $lottery->id])}}" class="badge bg-danger rounded-pill" data-bs-placement="top" data-bs-toggle="tooltip-danger" title="Total losers">{{$lottery->selected_total_losers}}</a>
                                                                @endif
                                                            @endif
                                                        </td>
                                                        <td class="text-center">
                                                            @if(strtotime($current_datetime) < strtotime($start_datetime))
                                                                <span class="badge rounded-pill bg-warning-gradient" style="font-weight: bold;">Not started yet</span>
                                                            @elseif(strtotime($current_datetime) >= strtotime($start_datetime) && strtotime($current_datetime) <= strtotime($end_datetime))
                                                                <span class="badge rounded-pill bg-success-gradient" style="font-weight: bold;">Active</span>
                                                            @elseif(strtotime($current_datetime) > strtotime($end_datetime))
                                                                <span class="badge rounded-pill bg-info-gradient" style="font-weight: bold;">Finished</span>
                                                            @endif

                                                        </td>
                                                        <td>{{ formatted_date($start_datetime) }}</td>
                                                        <td>{{ formatted_date($end_datetime) }}</td>
                                                            <td class="text-center align-middle">
                                                                <div class="btn-group align-top">
    {{--                                                                <a {{ ($tooltip_status)?$all_lott_row_view_tooltip:'' }} class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-bs-toggle="" href="../lotteries/<?php echo trim($lottery_url);?>" target="_blank"><i class="bi bi-eye-fill"></i></a>--}}
                                                                    <a {!! ($tooltip_status)?$all_lott_row_view_tooltip:'' !!}  class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-bs-toggle="" href="{{ route('lottery-form', ['url' => trim($lottery->lottery_url)]) }}" target="_blank"><i class="bi bi-eye-fill"></i></a>

                                                                    <a {!! ($tooltip_status)?$all_lott_row_edit_tooltip:'' !!} class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-bs-toggle="" href="{{ route('user.edit-lottery',['id'=>$lottery->id]) }}"><i class="bi bi-pencil-square"></i></a>
                                                                    <a {!! ($tooltip_status)?$all_lott_row_duplicate_tooltip:'' !!} class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-bs-toggle="" href="{{ route('user.add-lottery',['duplicate_id'=>base64_encode($lottery->id)]) }}"><i class="bi bi-clipboard-plus"></i></a>

                                                                    <button {!! ($tooltip_status)?$all_lott_row_erase_tooltip:'' !!} class="btn btn-sm btn-primary badge delete_lotteries" type="button" id="delete_lotteries"  data-id="{{ $lottery->id }}"><i class="bi bi-trash-fill"></i><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;" role="status"></div></button>
                                                                </div>
                                                            </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr><td colspan="9" class="text-center">No data available.</td></tr>
                                            @endif
                                        </tbody>
                                    </table>
                                    <div class="pagination">
                                        {{ $data['lotteries']->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Row -->

            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!--app-content end-->

@endsection
@push('css')
    <style>
        a.badge {
            color: #fff !important;
        }
    </style>
@endpush
@push('js')
    {{ Html::script('user/js/entries.js?t='.rand(0,10000)) }}
    {{ Html::script('assets/plugin/sweet-alert/sweetalert.min.js') }}
    <script>
        var delete_lottery = '{{ route('user.delete-lottery') }}';
        $(function(e) {
            $('#responsive-datatable').DataTable({
                scrollX: "100%",
                language: {
                    searchPlaceholder: 'Search...',
                    sSearch: '',
                }
            });

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
        });
    </script>
@endpush
