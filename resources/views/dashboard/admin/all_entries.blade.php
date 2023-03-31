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
                        <h1 class="page-title"><?php echo htmlspecialchars('ALL ENTRIES');?></h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Lotteries</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Participants</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">All entries</a></li>
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
                                    <h3 class="card-title">All entries</h3>
                                    <small>All times are in <strong>{{ 'selected timezone' }}</strong></small>
                                </div>
                                @if($entries)
                                    <button type="button" class="btn btn-info" id="download_table"><i class="bi bi-download me-2"></i>Download</button>
                                @endif

                            </div>
                            <div class="card-body">
                                <div class="alert alert-entries" style="display: none;"></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered text-nowrap border-bottom w-100" id="responsive-datatable">
                                        <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0">SN</th>
                                            <th class="wd-15p border-bottom-0">UID</th>
                                            <th class="wd-20p border-bottom-0">First name</th>
                                            <th class="wd-15p border-bottom-0">Last name</th>
                                            <th class="wd-15p border-bottom-0">Email</th>
                                            <th class="wd-10p border-bottom-0">Phone</th>
                                            <th class="wd-10p border-bottom-0">Status</th>
                                            <th class="wd-10p border-bottom-0">Bring guest</th>
                                            <th class="wd-10p border-bottom-0">G. First name</th>
                                            <th class="wd-10p border-bottom-0">G. Last name</th>
                                            <th class="wd-10p border-bottom-0">Guest's SN</th>
                                            <th class="wd-20p border-bottom-0">Lottery</th>
                                            <th class="wd-20p border-bottom-0">Owner</th>

                                            <th class="wd-25p border-bottom-0">Date entered</th>
                                            <th class="wd-25p border-bottom-0 action">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if(count($entries) > 0)
                                            @foreach($entries as $entry)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
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
                                                    @php

                                                        $lottery_query = \App\Models\Lottery::where('id',$entry->lottery_id)->first();
                                                        $is_winners_selected = $lottery_query['is_winners_selected'];
                                                        $title = $lottery_query['title'];
                                                        $lottery_url = $lottery_query['lottery_url'];
                                                        $user_id = $lottery_query['user_id'];
                                                        $start_datetime = formatted_date($lottery_query['start_datetime']);

                                                        $winner = \App\Models\Lottery_Winner::where('entry_id', $entry->id)->count();
                                                        $loser = \App\Models\Lottery_Losser::where('entry_id', $entry->id)->count();

                                                    @endphp
                                                    <td class="text-center">
                                                        @if ($is_winners_selected == 1)
                                                            @if ($winner == 1)
                                                                <span class="badge bg-success-gradient">WINNER</span>
                                                            @elseif ($loser == 1)
                                                                <span class="badge bg-danger-gradient">LOSER</span>
                                                            @endif
                                                        @else
                                                            <span class="badge bg-default">NO SELECTION YET</span>
                                                        @endif
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

                                                    <td><a href="{{route('lottery-form',['url'=> $lottery_url])}}" target="_blank">{{ htmlspecialchars($title) }} ({{ date('M d, Y', strtotime($start_datetime)) }}) <i class="bi bi-box-arrow-up-right"></i></a></td>
                                                    @php
                                                        $get_name_row = \App\Models\User::select('first_name', 'last_name', 'profile_picture')->where('id',$user_id)->first();
                                                        $full_name = $get_name_row['first_name'].' '.$get_name_row['last_name'];
                                                        if($get_name_row['profile_picture']==null){
                                                            $profile_picture = 'default-avatar.jpg';
                                                        }else{
                                                            $profile_picture = $get_name_row['profile_picture'];
                                                        }
                                                    @endphp
                                                    <td align="center">
                                                        <a href="{{ route('admin.view-user',['user_id'=>$user_id]) }}">

                                                            @if($profile_picture == '' || $profile_picture == NULL)
                                                                    <img alt="image" class="avatar avatar-md br-7" src="{{ url('assets/images/default-avatar.jpg') }}">
                                                            @else
                                                                    <img alt="image" class="avatar avatar-md br-7" src="{{ url('user/images/uploaded/' . $profile_picture) }}">
                                                            @endif
                                                            <br>
                                                            {{ $full_name }}
                                                        </a>
                                                    </td>

                                                    <td>{{ formatted_date($entry->created_at) }}</td>
                                                    @php
                                                        $winner_query = \App\Models\Lottery_Winner::select('*')->where('entry_id',$entry->id)->first();
                                                        $winner_tid = '';
                                                        if($winner_query){
                                                            $winner_tid = $winner_query->id;
                                                        }
                                                        $g_winner_query = \App\Models\Lottery_Winner::select('*')->where('entry_id',$entry->guest_id)->first();
                                                        $g_id = '';
                                                        if($g_winner_query){
                                                            $g_id = $g_winner_query->id;
                                                        }

                                                    @endphp
                                                    <td class="text-center align-middle action">
                                                        @if($is_winners_selected == 1)
                                                            @if($entry->has_parent == 0 && $winner == 1)
                                                                <div class="btn-group align-top">
                                                                    <button class="btn btn-sm btn-primary badge remove_winners" type="button" id="" data-lid="{{ $entry->lottery_id }}" data-id="{{ $winner_tid }}" data-eid="{{ $entry->id }}" data-gid="{{ $entry->guest_id }}" data-gid2="{{ $g_id}}"><i class="bi bi-trash-fill"></i><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;" role="status"></div></button>
                                                                </div>
                                                            @elseif($loser == 1)
                                                                <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">LOSER</span>
                                                            @else
                                                                <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>
                                                            @endif
                                                        @elseif($is_winners_selected == 0)
                                                            @if($entry->has_parent == 0)
                                                                <div class="btn-group align-top">
                                                                    <button class="btn btn-sm btn-primary badge remove_entries" type="button" id="remove_entries" data-lid="{{ $entry->lottery_id }}" data-id="{{ $winner_tid }}" data-eid="{{ $entry->id }}" data-gid="{{ $entry->guest_id }}" data-gid2="{{ $g_id }}"><i class="bi bi-trash-fill"></i><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;" role="status"></div></button>
                                                                </div>
                                                            @else
                                                                <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>
                                                            @endif
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr><td colspan="13" class="text-center">No data available.</td></tr>
                                        @endif
                                        </tbody>
                                    </table>
                                    <div class="pagination">
                                        {{ $entries->links() }}
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
    .dark-mode .lottery_list a {
        color: #aaaad8;
    }

    .dark-mode a, a:hover {
        color: #fff !important;
    }

    td a:hover, .list_a:hover {
        color: var(--primary-bg-color) !important;
    }
</style>
@endpush
@push('js')

<script src="https://cdn.jsdelivr.net/npm/table2csv@1.1.6/src/table2csv.min.js"></script>
{{ Html::script('assets/plugin/datatable/js/dataTables.buttons.min.js') }}
{{ Html::script('assets/plugin/datatable/js/buttons.bootstrap5.min.js') }}
{{ Html::script('assets/plugin/datatable/js/jszip.min.js') }}
{{ Html::script('assets/plugin/datatable/pdfmake/pdfmake.min.js') }}
{{ Html::script('assets/plugin/datatable/pdfmake/vfs_fonts.js') }}
{{ Html::script('assets/plugin/datatable/js/buttons.html5.min.js') }}
{{ Html::script('assets/plugin/datatable/js/buttons.print.min.js') }}
{{ Html::script('assets/plugin/datatable/js/buttons.colVis.min.js') }}
{{ Html::script('assets/plugin/datatable/responsive.bootstrap5.min.js') }}
{{ Html::script('assets/js/table-data.js') }}

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
    $('#download_table').click(function(){
        $("#responsive-datatable").table2csv({
            filename: 'All entries - <?php echo htmlspecialchars($title);?> (<?php echo formatted_date($start_datetime);?>).csv',
            excludeColumns: '.action'
        });
    });
</script>

<script>
    var remove_winners = '{{ route('admin.remove-winners') }}';
    var remove_entries = '{{ route('admin.remove-entries') }}';

</script>



@endpush























