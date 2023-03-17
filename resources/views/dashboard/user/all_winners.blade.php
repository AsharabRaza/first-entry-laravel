@extends('dashboard.user.layouts.template')

@section('content')

    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                @if(request()->has('id') && request()->filled('id'))
                    <!-- PAGE-HEADER -->
                    @php
                        $is_winners_selected = $data['lottery']->is_winners_selected;
                        $lottery_url = $data['lottery']->lottery_url;
                        $event_datetime = formatted_date($data['lottery']->event_datetime, 'M d, Y');
                        $start_datetime = formatted_date($data['lottery']->start_datetime, 'M d, Y');
                    @endphp
                    <div class="page-header">
                        <div>
                            <h1 class="page-title">{{ htmlspecialchars($data['lottery']->title) }}
                                ({{ date('M d, Y', strtotime($start_datetime)) }})</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Lotteries</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Participants</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">All entries</a></li>
                                <li class="breadcrumb-item active"
                                    aria-current="page">{{ htmlspecialchars($data['lottery']->title) }}
                                    ({{ date('M d, Y', strtotime($start_datetime)) }})
                                </li>
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
                                        <h3 class="card-title">All entries - {{ htmlspecialchars($data['lottery']->title) }}
                                            ({{ date('M d, Y', strtotime($start_datetime)) }})</h3>
                                        <small>All times are in <strong>{{ 'selected timezone' }}</strong></small>
                                    </div>
                                    <div>
                                        {{--<a href="send_emails.php?lottery_id=<?php echo $data['lottery']->id;?>&entries_type=Winners" class="btn btn-primary">Send emails</a>--}}
                                        <a href="{{ route('user.send-emails',['lottery_id'=>$data['lottery']->id,'entries_type'=>'Winners']) }}" class="btn btn-primary">Send emails</a>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="alert alert-entries" style="display: none;"></div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-nowrap border-bottom w-100"
                                               id="file-datatable">
                                            <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">No</th>
                                                <th class="wd-15p border-bottom-0">UID</th>
                                                <th class="wd-20p border-bottom-0">First name</th>
                                                <th class="wd-15p border-bottom-0">Last name</th>
                                                <th class="wd-15p border-bottom-0">Email</th>
                                                <th class="wd-10p border-bottom-0">Phone</th>
                                                <th class="wd-10p border-bottom-0">Status</th>
                                                <th class="wd-10p border-bottom-0">Bring guest</th>
                                                <th class="wd-10p border-bottom-0">G. First name</th>
                                                <th class="wd-10p border-bottom-0">G. Last name</th>
                                                <th class="wd-10p border-bottom-0">Guest's No</th>
                                                <th class="wd-20p border-bottom-0">Lottery</th>
                                                <th class="wd-25p border-bottom-0">QR code</th>
                                                <th class="wd-25p border-bottom-0">Date entered</th>
                                                <th class="wd-25p border-bottom-0 action">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($data['winners']) > 0)
                                                    @foreach($data['winners'] as $entry)
                                                        <tr>
                                                            <td>{{ $entry->sorting }}</td>
                                                            <td class="text-center">
                                                                @if ($entry->uid == "")
                                                                    <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>
                                                                @else
                                                                    {{ $entry->uid }}
                                                                @endif
                                                            </td>
                                                            <td>{{ htmlspecialchars($entry->first_name) }}</td>
                                                            <td>{{ htmlspecialchars($entry->last_name) }}</td>
                                                            <td style="vertical-align: middle;">
                                                                @if ($entry->email == "")
                                                                    <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>
                                                                @else
                                                                    {{ htmlspecialchars($entry->email) }}
                                                                @endif
                                                            </td>
                                                            <td style="vertical-align: middle;">
                                                                @if ($entry->phone == "")
                                                                    <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>
                                                                @else
                                                                    {{ htmlspecialchars($entry->phone) }}
                                                                @endif
                                                            </td>
                                                            <td class="text-center">
                                                                <span class="badge bg-success-gradient">WINNER</span>
                                                            </td>
                                                            <td class="text-center" style="vertical-align: middle;">
                                                                @if ($entry->guest_id == 0 && $entry->has_parent > 0)
                                                                    <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>
                                                                @elseif ($entry->guest_id == 0)
                                                                    <span class="badge bg-default">NO</span>
                                                                @else
                                                                    <span class="badge bg-primary">YES</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center" style="vertical-align: middle;">
                                                                @if ($entry->g_first_name != '')
                                                                    {{ $entry->g_first_name }}
                                                                @elseif ($entry->guest_id == 0 && $entry->has_parent == 0)
                                                                    <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">PRIMARY</span>
                                                                @else
                                                                    <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center" style="vertical-align: middle;">
                                                                @if ($entry->g_last_name != '')
                                                                    {{ $entry->g_last_name }}
                                                                @elseif ($entry->guest_id == 0 && $entry->has_parent == 0)
                                                                    <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">PRIMARY</span>
                                                                @else
                                                                    <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>
                                                                @endif
                                                            </td>
                                                            <td class="text-center" style="vertical-align: middle;">
                                                                @if($entry->guest_id != 0 && $entry->has_parent == 0)
                                                                    {{ $loop->iteration + 1 }}
                                                                @elseif($entry->guest_id == 0 && $entry->has_parent == 0)
                                                                    <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">PRIMARY</span>
                                                                @else
                                                                    <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>
                                                                @endif
                                                            </td>
                                                            <td><a href="{{route('lottery-form',['url'=> $lottery_url])}}" target="_blank">{{ isset($data['lottery']->title) ? htmlspecialchars($data['lottery']->title) : '' }} ({{ date('M d, Y', strtotime($start_datetime)) }}) <i class="bi bi-box-arrow-up-right"></i></a></td>
                                                            <td>
                                                                @if(!empty($entry->qr_code))
                                                                    @php
                                                                        $path = public_path('assets/images/brand/'.$entry->qr_code);
                                                                        $type = pathinfo($path, PATHINFO_EXTENSION);
                                                                        $data = file_get_contents($path);
                                                                        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
                                                                    @endphp
                                                                    <img src="{{ $base64 }}" style="width: 50px;" />
                                                                @else
                                                                    QR code not found
                                                                @endif
                                                            </td>
                                                            <td>{{ formatted_date($entry->created_at) }}</td>
                                                            <td class="text-center align-middle action">

                                                                @if($entry->has_parent == 0)
                                                                    <div class="btn-group align-top">
                                                                        <button class="btn btn-sm btn-primary badge remove_winners" type="button" id="remove_winners" data-lid="{{ request('id') }}" data-id="{{ $entry->winner_tid }}" data-eid="{{ $entry->entry_tid }}" data-gid="{{ $entry->guest_id }}" data-gid2="{{ $entry->g_id }}"><i class="bi bi-trash-fill"></i><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;" role="status"></div></button>
                                                                    </div>
                                                                @else
                                                                    <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>
                                                                @endif

                                                            </td>
                                                @endforeach
                                            @else
                                                <tr><td colspan="13" class="text-center">No data available.</td></tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                           {{-- <script>
                                $('#download_table').click(function(){
                                    $("#responsive-datatable").table2csv({
                                        filename: 'Winners - {{ htmlspecialchars($data['lottery']->title) }} ({{ date('M d, Y', strtotime($start_datetime)) }}).csv',
                                        excludeColumns: '.action'
                                    });
                                });
                            </script>--}}

                    @else
                    <!-- PAGE-HEADER -->
                        <div class="page-header">
                            <div>
                                <h1 class="page-title">Selected entries</h1>
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Event Lotteries</a></li>
                                    <li class="breadcrumb-item"><a href="javascript:void(0);">Entries</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Selected entries</li>
                                </ol>
                            </div>
                        </div>
                        <!-- PAGE-HEADER END -->

                        <!-- Row -->
                        <div class="row row-sm">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="card-title">Selected entries</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="">
                                            <h5>Select a lottery</h5>
                                            <ul class="list-group lottery_list">
                                                @if(count($data['lotteries']) > 0)

                                                    @foreach($data['lotteries'] as $lottery)
                                                        @php
                                                            $current_datetime2 = date('d-m-Y h:i A');
                                                            $start_datetime = formatted_date($lottery->start_datetime);
                                                            $end_datetime = formatted_date($lottery->end_datetime);
                                                            $date_created = formatted_date($lottery->created_at);
                                                            $current_datetime = date('Y-m-d H:i:s');
                                                        @endphp
                                                        <li class="list-group-item justify-content-between">
                                                            <a class="list_a" href="{{ route('user.all-winners',['id'=>$lottery->id]) }}">
                                                                {{ htmlspecialchars($lottery->title) }} ({{ date('M d, Y', strtotime($lottery->event_datetime)) }})
                                                                @if(strtotime($current_datetime2) < strtotime($start_datetime))
                                                                    <span class="badge rounded-pill bg-warning-gradient" style="font-weight: bold;">Not started yet</span>
                                                                @elseif(strtotime($current_datetime2) >= strtotime($start_datetime) && strtotime($current_datetime2) <= strtotime($end_datetime))
                                                                    <span class="badge rounded-pill bg-success-gradient" style="font-weight: bold;">Active</span>
                                                                @elseif(strtotime($current_datetime2) > strtotime($end_datetime))
                                                                    <span class="badge rounded-pill bg-info-gradient" style="font-weight: bold;">Finished</span>
                                                                @endif
                                                            </a>
                                                            @if((strtotime($current_datetime) > strtotime($end_datetime)) OR (strtotime($current_datetime) >= strtotime($start_datetime) && strtotime($current_datetime) <= strtotime($end_datetime)))
                                                                @if(strtotime($current_datetime) > strtotime($end_datetime))
                                                                    <a href="{{ route('user.all-losers',['id'=>$lottery->id]) }}" class="badgetext badge bg-danger rounded-pill" data-bs-placement="top" data-bs-toggle="tooltip-danger" title="Total losers">{{ $lottery->selected_total_losers }}</a>

                                                                    <a href="{{ route('user.all-winners',['id'=>$lottery->id]) }}" class="badgetext badge bg-info rounded-pill" style="margin-right: 3px;" data-bs-placement="top" data-bs-toggle="tooltip-info" title="Total winners">{{ $lottery->selected_total_winners }}</a>
                                                                @endif

                                                                <a href="{{ route('user.all-entries',['id'=>$lottery->id]) }}" class="badgetext badge bg-primary rounded-pill" style="margin-right: 3px;" data-bs-placement="top" data-bs-toggle="tooltip-primary" title="Total entries">{{ $lottery->selected_total_entries }}</a>
                                                            @endif
                                                        </li>
                                                    @endforeach

                                                @else
                                                    <li class="list-group-item justify-content-between">No data available.</li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- End Row -->

                    </div>
                    <!-- CONTAINER END -->
                </div>
            </div>
            <!--app-content end-->


{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

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
                                #file-datatable_length {
                                    float: left;
                                    margin-right: 12px;
                                }
                                .dropdown-item {
                                    background: var(--danger);
                                }

                                .dropdown-item:hover {
                                    background: var(--danger) !important;
                                }
                            </style>
@endpush
@push('js')


{{ Html::script('assets/plugin/datatable/js/jquery.dataTables.min.js') }}
{{ Html::script('assets/plugin/datatable/js/dataTables.bootstrap5.js') }}
{{ Html::script('assets/plugin/datatable/js/dataTables.buttons.min.js') }}
{{ Html::script('assets/plugin/datatable/js/buttons.bootstrap5.min.js') }}
{{ Html::script('assets/plugin/datatable/js/jszip.min.js') }}
{{ Html::script('assets/plugin/datatable/pdfmake/pdfmake.min.js') }}
{{ Html::script('assets/plugin/datatable/pdfmake/vfs_fonts.js') }}
{{ Html::script('assets/plugin/datatable/js/buttons.html5.min.js') }}
{{ Html::script('assets/plugin/datatable/js/buttons.print.min.js') }}
{{ Html::script('assets/plugin/datatable/js/buttons.colVis.min.js') }}
{{ Html::script('assets/plugin/datatable/dataTables.responsive.min.js') }}
{{ Html::script('assets/plugin/datatable/responsive.bootstrap5.min.js') }}

<!-- Tooltip and Popover JS -->
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
{{ Html::script('user/js/entries.js?t='.rand(0,10000)) }}

<script>
    var remove_winners = '{{ route('user.remove-winners') }}'
    var remove_entries = '{{ route('user.remove-entries') }}'
    var table = $('#file-datatable').DataTable({
        scrollX: "100%",
        language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
        }
    });

    new $.fn.dataTable.Buttons(table, {
        buttons: [
            {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ],
    });

    table.buttons().container()
        .appendTo('#file-datatable_wrapper .col-md-6:eq(0)');
</script>



@endpush























