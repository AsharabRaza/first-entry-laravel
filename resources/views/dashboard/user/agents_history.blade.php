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
                        <h1 class="page-title">Live entry process</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Management</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Agents</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Live entry process</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header" style="place-content: space-between;">
                                <h3 class="card-title">History</h3>
                                <small>All times are in <strong>{{ 'selected timezone' }}</strong></small>
                            </div>
                            <div class="card-body">

                                <div class="row">
                                    <form action="{{ route('user.agents-history') }}" method="GET" id="live_entry_filter">
                                        <div class="col-md-4 mb-5">
                                            <label for="lottery_id" style="display: block;"><span>Lotteries</span></label>
                                            <select name="lottery_id" id="lottery_id" class="select2">
                                                <option value="" {{ (empty(request()->input('lottery_id'))) ? 'selected' : '' }} disabled>Select a lottery</option>
                                                @foreach($available_l as $row)
                                                    <option value="{{ $row->id }}" {{ (request()->input('lottery_id') == $row->id) ? 'selected' : '' }}>{{ $row->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-5">
                                            <button type="button" class="btn btn-info" style="font-size: 15px;font-weight: 900;border-radius: 20px;padding: 3px 25px;">
                                                <span>Total Scans : </span><span id="total_scans"></span>&ensp;&ensp;
                                                <span>Total Guests : </span><span id="total_guests"></span>
                                            </button>
                                        </div>
                                    </form>
                                    <div class="col-md-12 mb-5">
                                        <div class="alert alert-users" style="display: none;"></div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                                <thead>
                                                <tr>
                                                    <th class="wd-15p border-bottom-0">Entries ID</th>
                                                    <th class="wd-20p border-bottom-0">First name</th>
                                                    <th class="wd-20p border-bottom-0">Last name</th>
                                                    <th class="wd-20p border-bottom-0">G. First name</th>
                                                    <th class="wd-20p border-bottom-0">G. Last name</th>
                                                    <th class="wd-20p border-bottom-0">Entry confirmed date and time</th>
                                                    <th class="wd-20p border-bottom-0">Scanned by</th>
                                                    <th class="wd-20p border-bottom-0">Scanned via</th>
                                                    <th class="wd-20p border-bottom-0">Entry</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @php
                                                        $total_scans = $total_guests = 0;
                                                    @endphp
                                                    @if($entries && count($entries) > 0)
                                                        @foreach($entries as $entry)
                                                            @php
                                                                $total_scans++;
                                                                if($entry->guest_id > 1) {
                                                                    $total_guests++;
                                                                }
                                                                $entry_confirmed_datetime = $entry->entry_confirmed_datetime;
                                                                if($entry_confirmed_datetime == null){
                                                                    $entry_confirmed_datetime = '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">NO DATA</span>';
                                                                }else{
                                                                    $entry_confirmed_datetime = formatted_date($entry_confirmed_datetime);
                                                                }
                                                            @endphp
                                                            <tr>
                                                                <td class="align-middle text-center">{{ $entry->entries_id }}</td>
                                                                <td class="align-middle">{{ $entry->first_name }}</td>
                                                                <td class="align-middle">{{ $entry->last_name }}</td>
                                                                <td class="align-middle">{{ $entry->g_first_name }}</td>
                                                                <td class="align-middle">{{ $entry->g_last_name }}</td>
                                                                <td class="align-middle text-center">{{ $entry_confirmed_datetime }}</td>
                                                                <td class="align-middle">{{ $entry->users_first_name .' '. $entry->users_last_name }}</td>
                                                                <td class="align-middle text-center">{{ $entry->entry_confirmed_by_type_nicename }}</td>
                                                                <td class="align-middle text-center">{!! $entry->entry_confirmed == 1 ? '<span class="badge bg-primary">Confirmed</span>' : '<span class="badge bg-default">Not Confirmed</span>' !!}</td>
                                                            </tr>
                                                        @endforeach
                                                    @else
                                                        <tr><td colspan="18" class="text-center">No data available.</td></tr>
                                                    @endif
                                                </tbody>
                                            </table>
                                            <div class="pagination">
                                                @if(count($entries) > 0)
                                                    {{  $entries->links() }}
                                                @endif
                                            </div>
                                        </div>
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
        .in_review_main {
            display: none !important;
        }
        a.badge {
            color: #fff !important;
        }
        .badge-big {
            font-size: 12px !important;
        }
        #responsive-datatable_length {
            float: left;
            margin-right: 12px;
        }
    </style>
@endpush
@push('js')

    <script>
        $(function(e) {
            var total_scans  = '{{ $total_scans }}';
            var total_guests = '{{ $total_guests }}';

            $('#total_scans').html(total_scans);
            $('#total_guests').html(total_guests);

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

            $('#lottery_id').change(function() {
                $('#live_entry_filter').submit();
            });
        });
    </script>

    {{ Html::script('assets/plugin/sweet-alert/sweetalert.min.js') }}
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


    {{ Html::script('user/js/agent.js?t='.rand(0,10000)) }}

    <script>
        var table = $('#responsive-datatable').DataTable({
            "iDisplayLength": 50,
            scrollX: "100%",
            language: {
                searchPlaceholder: 'Search...',
                sSearch: '',
            }
        });

        new $.fn.dataTable.Buttons( table, {
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
        } );

        table.buttons().container()
            .appendTo( '#responsive-datatable_wrapper .col-md-6:eq(0)' );


    </script>



@endpush
