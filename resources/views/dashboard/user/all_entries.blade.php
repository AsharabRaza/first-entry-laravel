@extends('dashboard.user.layouts.template')

@section('content')

    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                @if(request()->has('id') && request()->filled('id'))
                    {{--<script src="https://cdn.jsdelivr.net/npm/table2csv@1.1.6/src/table2csv.min.js"></script>--}}
                    <!-- PAGE-HEADER -->
                    <div class="page-header">
                        <div>
                            <h1 class="page-title"><?php echo htmlspecialchars($title);?>
                                (<?php echo date('M d, Y', strtotime($event_datetime));?>)</h1>
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Lotteries</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">Participants</a></li>
                                <li class="breadcrumb-item"><a href="javascript:void(0);">All entries</a></li>
                                <li class="breadcrumb-item active"
                                    aria-current="page"><?php echo htmlspecialchars($title);?>
                                    (<?php echo date('M d, Y', strtotime($event_datetime));?>)
                                </li>
                            </ol>
                        </div>
                    </div>
                    <!-- PAGE-HEADER END -->

                    <!-- Row -->
                    <div class="row row-sm">
                        <div class="col-lg-12">
                            <div class="card">
                                <?php
                                $sql = "SELECT entries.id as entry_tid, entries.*, e2.first_name as g_first_name, e2.last_name as g_last_name, (SELECT COUNT(lotteries_winners.id) FROM lotteries_winners WHERE entries.id = lotteries_winners.entry_id) AS winner, (SELECT lotteries_winners.id FROM lotteries_winners WHERE entries.id = lotteries_winners.entry_id) AS winner_tid, (SELECT lotteries_winners.id FROM lotteries_winners WHERE entries.guest_id = lotteries_winners.entry_id) AS g_id, (SELECT COUNT(lotteries_losers.id) FROM lotteries_losers WHERE entries.id = lotteries_losers.entry_id) AS loser FROM entries LEFT JOIN lotteries ON '" . $_GET['id'] . "' = lotteries.id LEFT JOIN entries e2 ON entries.guest_id = e2.id WHERE lotteries.user_id = '$normal_user' AND entries.lottery_id = '" . $_GET['id'] . "' ORDER BY entries.id DESC";
                                $result = $con->query($sql);
                                ?>
                                <div class="card-header" style="place-content: space-between;">
                                    <div>
                                        <h3 class="card-title">All entries - <?php echo htmlspecialchars($title);?>
                                            (<?php echo $event_datetime;?>)</h3>
                                        <small>All times are in <strong>{{ 'selected timezone' }}</strong></small>
                                    </div>

                                </div>
                                <div class="card-body">
                                    <div class="alert alert-entries" style="display: none;"></div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered text-nowrap border-bottom w-100"
                                               id="file-datatable">
                                            <thead>
                                            <tr>
                                                <th class="wd-15p border-bottom-0">SN</th>
                                                <th class="wd-15p border-bottom-0">UID</th>
                                                <th class="wd-20p border-bottom-0">First name</th>
                                                <th class="wd-15p border-bottom-0">Last name</th>
                                                <th class="wd-15p border-bottom-0">Email</th>
                                                <th class="wd-10p border-bottom-0">Phone</th>
                                                <th class="wd-10p border-bottom-0">Custom fields values</th>
                                                <th class="wd-10p border-bottom-0">Status</th>
                                                <th class="wd-10p border-bottom-0">Bring guest</th>
                                                <th class="wd-10p border-bottom-0">G. First name</th>
                                                <th class="wd-10p border-bottom-0">G. Last name</th>
                                                <th class="wd-10p border-bottom-0">Guest's SN</th>
                                                <th class="wd-20p border-bottom-0">Lottery</th>
                                                <th class="wd-25p border-bottom-0">Date entered</th>
                                                <th class="wd-25p border-bottom-0 action">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if($result == true){
                                            if($result->num_rows > 0){
                                            $i = 1;
                                            while($row = $result->fetch_assoc()){
                                            $winner_tid = $row['winner_tid'];
                                            $uid = $row['uid'];
                                            $entry_tid = $row['entry_tid'];
                                            $first_name = $row['first_name'];
                                            $last_name = $row['last_name'];
                                            $g_first_name = $row['g_first_name'];
                                            $g_last_name = $row['g_last_name'];
                                            $g_id = $row['g_id'];
                                            //var_dump($g_id);
                                            $email = $row['email'];
                                            $phone = $row['phone'];
                                            $custom_inputs_val = json_decode(unserialize($row['custom_inputs_val']), true);
                                            $guest_id = $row['guest_id'];
                                            $has_parent = $row['has_parent'];
                                            $terms_conditions_agree = $row['terms_conditions_agree'];
                                            $winner = $row['winner'];
                                            $loser = $row['loser'];
                                            $date_created = formatted_date($row['date_created']);

                                            /*$sql2 = "SELECT COUNT(id) AS total_winners FROM lotteries_winners WHERE lottery_id = '$lottery_id'";
                                            $result2 = $con->query($sql2);
                                            if($result2 == true)*/

                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i;?></td>
                                                <td class="text-center"><?php if ($uid == "") {
                                                        echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>';
                                                    } else {
                                                        echo $uid;
                                                    }?></td>
                                                <td><?php echo htmlspecialchars($first_name);?></td>
                                                <td><?php echo htmlspecialchars($last_name);?></td>
                                                <td style="vertical-align: middle;"><?php if ($email == '') {
                                                        echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>';
                                                    } else {
                                                        echo htmlspecialchars($email);
                                                    }?></td>
                                                <td style="vertical-align: middle;"><?php if ($phone == '') {
                                                        echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>';
                                                    } else {
                                                        echo htmlspecialchars($phone);
                                                    }?></td>

                                                <td class="">
                                                    <?php
                                                    foreach ($custom_inputs_val as $key => $value) {
                                                        echo '<strong>' . $key . ':</strong> ' . $value . '<br>';
                                                    }
                                                    ?>
                                                </td>

                                                <td class="text-center">
                                                    <?php
                                                    if($is_winners_selected == 1){
                                                    if($winner == 1){
                                                    ?>
                                                    <span class="badge bg-success-gradient">WINNER</span>

                                                    <?php
                                                    }else if($loser == 1){
                                                    ?>
                                                    <span class="badge bg-danger-gradient">LOSER</span>
                                                    <?php
                                                    }
                                                    }else{
                                                    ?>
                                                    <span class="badge bg-default">NO SELECTION YET</span>
                                                    <?php
                                                    }
                                                    ?>

                                                </td>

                                                <td class="text-center" style="vertical-align: middle;">
                                                    <?php
                                                    if ($guest_id == 0 && $has_parent > 0) {
                                                        echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>';
                                                    } else if ($guest_id == 0) {
                                                        echo '<span class="badge bg-default">NO</span>';
                                                    } else {
                                                        echo '<span class="badge bg-primary">YES</span>';
                                                    }
                                                    ?>
                                                </td>

                                                <td class="text-center" style="vertical-align: middle;">
                                                    <?php
                                                    if ($g_first_name != '') {
                                                        echo $g_first_name;
                                                    } else if ($guest_id == 0 && $has_parent == 0) {
                                                        echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">PRIMARY</span>';
                                                    } else {
                                                        echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>';
                                                    }
                                                    ?>
                                                </td>

                                                <td class="text-center" style="vertical-align: middle;">
                                                    <?php
                                                    if ($g_last_name != '') {
                                                        echo $g_last_name;
                                                    } else if ($guest_id == 0 && $has_parent == 0) {
                                                        echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">PRIMARY</span>';
                                                    } else {
                                                        echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>';
                                                    }
                                                    ?>
                                                </td>

                                                <td class="text-center" style="vertical-align: middle;">
                                                    <?php
                                                    if ($guest_id != 0 && $has_parent == 0) {
                                                        echo($i + 1);
                                                    } else if ($guest_id == 0 && $has_parent == 0) {
                                                        echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">PRIMARY</span>';
                                                    } else {
                                                        echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>';
                                                    }
                                                    ?>
                                                </td>

                                                <td><a href="../lotteries/<?php echo $lottery_url;?>"
                                                       target="_blank"><?php echo htmlspecialchars($title);?>
                                                        (<?php echo date('M d, Y', strtotime($start_datetime));?>) <i
                                                            class="bi bi-box-arrow-up-right"></i></a></td>

                                                <td><?php echo $date_created;?></td>

                                                <td class="text-center align-middle action">
                                                    <?php
                                                    if($is_winners_selected == 1){
                                                    if($has_parent == 0 && $winner == 1){
                                                    ?>
                                                    <div class="btn-group align-top">
                                                        <button class="btn btn-sm btn-primary badge" type="button"
                                                                id="remove_winners" data-lid="<?php echo $_GET['id'];?>"
                                                                data-id="<?php echo $winner_tid;?>"
                                                                data-eid="<?php echo $entry_tid;?>"
                                                                data-gid="<?php echo $guest_id;?>"
                                                                data-gid2="<?php echo $g_id;?>"><i
                                                                class="bi bi-trash-fill"></i>
                                                            <div class="spinner-border spinner-border-sm"
                                                                 style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;"
                                                                 role="status"></div>
                                                        </button>
                                                    </div>
                                                    <?php
                                                    }else if ($loser == 1) {
                                                        echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">LOSER</span>';
                                                    } else {
                                                        echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>';
                                                    }
                                                    }else if($is_winners_selected == 0){
                                                    if($has_parent == 0){
                                                    ?>
                                                    <div class="btn-group align-top">
                                                        <button class="btn btn-sm btn-primary badge remove_entries"
                                                                type="button" id="remove_entries"
                                                                data-lid="<?php echo $_GET['id'];?>"
                                                                data-id="<?php echo $winner_tid;?>"
                                                                data-eid="<?php echo $entry_tid;?>"
                                                                data-gid="<?php echo $guest_id;?>"
                                                                data-gid2="<?php echo $g_id;?>"><i
                                                                class="bi bi-trash-fill"></i>
                                                            <div class="spinner-border spinner-border-sm"
                                                                 style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;"
                                                                 role="status"></div>
                                                        </button>
                                                    </div>
                                                    <?php
                                                    }else {
                                                        echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">GUEST</span>';
                                                    }
                                                    }

                                                    ?>
                                                </td>
                                            </tr>
                                            <?php
                                            $i++;
                                            }
                                            }else {
                                                echo '<tr><td colspan="13" class="text-center">No data available.</td></tr>';
                                            }
                                            }else {
                                                echo '<tr><td colspan="13" class="text-center">Something went wrong, please try again later.2</td></tr>';
                                            }
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

{{--                            $sql = "SELECT *, (SELECT COUNT(entries.id) FROM entries WHERE lotteries.id = entries.lottery_id) AS selected_total_entries, (SELECT COUNT(lotteries_winners.id) FROM lotteries_winners WHERE lotteries.id = lotteries_winners.lottery_id) AS selected_total_winners, (SELECT COUNT(lotteries_losers.id) FROM lotteries_losers WHERE lotteries.id = lotteries_losers.lottery_id) AS selected_total_losers FROM lotteries WHERE user_id = '$normal_user' AND ((start_datetime <= '$current_datetime' && end_datetime >= '$current_datetime') OR (end_datetime < '$current_datetime')) ORDER BY last_updated DESC";--}}
{{--                            $result = $con->query($sql);--}}

                        @else
                        <!-- PAGE-HEADER -->
                            <div class="page-header">
                                <div>
                                    <h1 class="page-title">All entries</h1>
                                    <ol class="breadcrumb">
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Lotteries</a></li>
                                        <li class="breadcrumb-item"><a href="javascript:void(0);">Participants</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">All entries</li>
                                    </ol>
                                </div>
                            </div>
                            <!-- PAGE-HEADER END -->

                            <!-- Row -->
                            <div class="row row-sm">
                                <div class="col-lg-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title">All entries</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="">
                                                <h5>Select a lottery</h5>
                                                <ul class="list-group lottery_list">
                                                    <?php
                                                    if($result == true){
                                                    if($result->num_rows > 0){
                                                    while($row = $result->fetch_assoc()){
                                                    $lottery_id = $row['id'];
                                                    $current_datetime2 = date('d-m-Y h:i A');
                                                    $lottery_url = $row['lottery_url'];
                                                    $title = $row['title'];
                                                    $selected_total_entries = $row['selected_total_entries'];
                                                    $total_winners = $row['total_winners'];
                                                    $selected_total_winners = $row['selected_total_winners'];
                                                    $selected_total_losers = $row['selected_total_losers'];
                                                    $start_datetime = formatted_date($row['start_datetime']);
                                                    $end_datetime = formatted_date($row['end_datetime']);
                                                    $date_created = formatted_date($row['date_created']);
                                                    ?>
                                                    <li class="list-group-item justify-content-between">
                                                        <a class="list_a"
                                                           href="all_entries.php?id=<?php echo $lottery_id;?>">
                                                            <?php echo htmlspecialchars($title);?>
                                                            (<?php echo date('M d, Y', strtotime($row['event_datetime']));?>
                                                            )
                                                            <?php
                                                            if (strtotime($current_datetime2) < strtotime($start_datetime)) {
                                                                echo '<span class="badge rounded-pill bg-warning-gradient" style="font-weight: bold;">Not started yet</span>';
                                                            } else if (strtotime($current_datetime2) >= strtotime($start_datetime) && strtotime($current_datetime2) <= strtotime($end_datetime)) {
                                                                echo '<span class="badge rounded-pill bg-success-gradient" style="font-weight: bold;">Active</span>';
                                                            } else if (strtotime($current_datetime2) > strtotime($end_datetime)) {
                                                                echo '<span class="badge rounded-pill bg-info-gradient" style="font-weight: bold;">Finished</span>';
                                                            }
                                                            ?>
                                                        </a>

                                                        <?php if((strtotime($current_datetime) > strtotime($end_datetime)) OR (strtotime($current_datetime) >= strtotime($start_datetime) && strtotime($current_datetime) <= strtotime($end_datetime))){ ?>
                                                        <?php if(strtotime($current_datetime) > strtotime($end_datetime)){ ?>
                                                        <a href="all_losers.php?id=<?php echo $lottery_id;?>"
                                                           class="badgetext badge bg-danger rounded-pill"
                                                           data-bs-placement="top" data-bs-toggle="tooltip-danger"
                                                           title="Total losers"><?php echo $selected_total_losers;?></a>

                                                        <a href="all_winners.php?id=<?php echo $lottery_id;?>"
                                                           class="badgetext badge bg-info rounded-pill"
                                                           style="margin-right: 3px;" data-bs-placement="top"
                                                           data-bs-toggle="tooltip-info"
                                                           title="Total winners"><?php echo $selected_total_winners;?></a>
                                                        <?php } ?>

                                                        <a href="all_entries.php?id=<?php echo $lottery_id;?>"
                                                           class="badgetext badge bg-primary rounded-pill"
                                                           style="margin-right: 3px;" data-bs-placement="top"
                                                           data-bs-toggle="tooltip-primary"
                                                           title="Total entries"><?php echo $selected_total_entries;?></a>
                                                        <?php }?>

                                                    </li>
                                                    <?php
                                                    }
                                                    }else{
                                                    ?>
                                                    <li class="list-group-item justify-content-between">No data
                                                        available.
                                                    </li>
                                                    <?php
                                                    }
                                                    }else{
                                                    ?>
                                                    <li class="list-group-item justify-content-between">Something went
                                                        wrong, please try again later.3
                                                    </li>
                                                    <?php
                                                    }
                                                    ?>
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























