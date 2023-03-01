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
                                      {{--  <tbody>
                                        <?php
                                        if($result == true){
                                        if($result->num_rows > 0){
                                        $i = 1;
                                        while($row = $result->fetch_assoc()){
                                        $lottery_id = $row['id'];
                                        $current_datetime = date('d-m-Y h:i A');
                                        $lottery_url = $row['lottery_url'];
                                        $title = $row['title'];
                                        $header_image = $row['header_image'];
                                        $selected_total_entries = $row['selected_total_entries'];
                                        $total_winners = $row['total_winners'];

                                        $lottery_agents = $row['lottery_agents'];
                                        $country = getCountriesNames($row['country_code'], true);
                                        $lott_timezone     = $row['timezone'];

                                        $selected_total_winners = $row['selected_total_winners'];
                                        $selected_total_losers = $row['selected_total_losers'];
                                        $event_datetime = formatted_date($row['event_datetime']);
                                        $start_datetime = convert_timezone($row['start_datetime_utc'], 'UTC',$lott_timezone, 'M d, Y h:i a');
                                        $end_datetime = convert_timezone($row['end_datetime_utc'], 'UTC',$lott_timezone, 'M d, Y h:i a');
                                        $date_created = formatted_date($row['date_created']);

                                        /*$sql2 = "SELECT COUNT(id) AS total_winners FROM lotteries_winners WHERE lottery_id = '$lottery_id'";
                                        $result2 = $con->query($sql2);
                                        if($result2 == true)*/

                                        ?>
                                        <tr>
                                            <td><?php echo $i;?></td>
                                            <td class="align-middle text-center">
                                                <?php
                                                if($header_image == '' || $header_image == NULL){
                                                ?>
                                                <img alt="image" class="avatar avatar-md br-7" src="../assets/images/users/default-avatar.jpg">
                                                <?php
                                                }else{
                                                ?>
                                                <img alt="image" class="avatar avatar-md br-7" src="../assets/images/media/<?php echo $header_image;?>">
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo $title;?></td>
                                            <td><?php echo $lottery_url;?></td>
                                            <td><?php echo $event_datetime;?></td>
                                            <td><?php echo $lottery_agents;?></td>
                                            <td><?php echo $country;?></td>
                                            <td><?php echo $lott_timezone;?></td>
                                            <td><?php echo '<span '.(($tooltip_status)?$all_lott_row_winners_limit_tooltip:'').'>'.$total_winners.'</span>';?><?php if((strtotime($current_datetime) > strtotime($end_datetime)) OR (strtotime($current_datetime) >= strtotime($start_datetime) && strtotime($current_datetime) <= strtotime($end_datetime))){ ?> <a href="all_entries.php?id=<?php echo $lottery_id;?>" class=" badge bg-primary rounded-pill" style="margin-right: 2px;margin-left: 4px;" data-bs-placement="top" data-bs-toggle="tooltip-primary" title="Total entries"><?php echo $selected_total_entries;?></a><?php if(strtotime($current_datetime) > strtotime($end_datetime)){ ?><a href="all_winners.php?id=<?php echo $lottery_id;?>" class=" badge bg-info rounded-pill" style="margin-right: 2px;" data-bs-placement="top" data-bs-toggle="tooltip-info" title="Total winners"><?php echo $selected_total_winners;?></a><a href="all_losers.php?id=<?php echo $lottery_id;?>" class=" badge bg-danger rounded-pill" data-bs-placement="top" data-bs-toggle="tooltip-danger" title="Total losers"><?php echo $selected_total_losers;?></a><?php } }?></td>

                                            <td class="text-center">
                                                <?php
                                                if(strtotime($current_datetime) < strtotime($start_datetime)){
                                                    echo '<span class="badge rounded-pill bg-warning-gradient" style="font-weight: bold;">Not started yet</span>';
                                                }else if(strtotime($current_datetime) >= strtotime($start_datetime) && strtotime($current_datetime) <= strtotime($end_datetime)){
                                                    echo '<span class="badge rounded-pill bg-success-gradient" style="font-weight: bold;">Active</span>';
                                                }else if(strtotime($current_datetime) > strtotime($end_datetime)){
                                                    echo '<span class="badge rounded-pill bg-info-gradient" style="font-weight: bold;">Finished</span>';
                                                }
                                                ?>
                                            </td>

                                            <td><?php echo  formatted_date($start_datetime);?></td>

                                            <td><?php echo formatted_date($end_datetime);?></td>
                                            <td class="text-center align-middle">
                                                <div class="btn-group align-top">
                                                    <a <?php echo ($tooltip_status)?$all_lott_row_view_tooltip:'';?> class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-bs-toggle="" href="../lotteries/<?php echo trim($lottery_url);?>" target="_blank"><i class="bi bi-eye-fill"></i></a>

                                                    <a <?php echo ($tooltip_status)?$all_lott_row_edit_tooltip:'';?> class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-bs-toggle="" href="edit_lottery.php?id=<?php echo $lottery_id;?>"><i class="bi bi-pencil-square"></i></a>
                                                    <a <?php echo ($tooltip_status)?$all_lott_row_duplicate_tooltip:'';?> class="btn btn-sm btn-primary badge" data-target="#user-form-modal" data-bs-toggle="" href="add_lottery.php?duplicate_id=<?php echo base64_encode($lottery_id);?>"><i class="bi bi-clipboard-plus"></i></a>

                                                    <button <?php echo ($tooltip_status)?$all_lott_row_erase_tooltip:'';?> class="btn btn-sm btn-primary badge delete_lotteries" type="button" id="delete_lotteries"  data-id="<?php echo $lottery_id;?>"><i class="bi bi-trash-fill"></i><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;" role="status"></div></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                        }
                                        }else{
                                            echo '<tr><td colspan="9" class="text-center">No data available.</td></tr>';
                                        }
                                        }else{
                                            echo '<tr><td colspan="9" class="text-center">Semething went wrong, please try again later.</td></tr>';
                                        }
                                        ?>
                                        </tbody>--}}
                                    </table>
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
    <script>
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
