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
                    <h1 class="page-title">All users</h1>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Management</a></li>
                        <li class="breadcrumb-item"><a href="javascript:void(0);">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page">All users</li>
                    </ol>
                </div>
                <div class="ms-auto pageheader-btn">
                    <a href="add_edit_user.php" class="btn btn-primary btn-icon text-white me-2">
                        <span>
                            <i class="bi bi-plus"></i>
                        </span> Add User
                    </a>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- Row -->
            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header" style="place-content: space-between;">
                            <h3 class="card-title">All users</h3>
                            {{--                            <small>All times are in <strong><?php echo $timezoneText;?></strong></small>--}}
                            <small>All times are in <strong></strong></small>
                        </div>
                        <div class="card-body">

                            {{--                            <?php /*include_once('messages.php') */?><!----}}
                            {{--                            messages file coding below.--}}
                            {{--                            <?php /*$alertClass = empty($_GET['error']) ? "alert alert-danger" : "alert alert-success"; */?>--}}
                            {{--                            <?php /*if (!empty($_GET['message'])) :*/?>--}}
                            {{--                            <div class="alert <?php /*echo $alertClass */?>">--}}
                            {{--                                <?php /*echo  base64_decode($_GET['message']); */?>--}}
                            {{--                            </div>--}}
                            {{--                            --><?php /*endif;*/?>--}}

                            <div class="alert alert-users" style="display: none;"></div>
                            <div class="table-responsive table-lg">
                                <table class="table border table-bordered mb-0" id="responsive-datatable">
                                    <thead>
                                    <tr>
                                        <th class="wd-15p border-bottom-0">ID</th>
                                        <th class="wd-20p border-bottom-0">Photo</th>
                                        <th class="wd-20p border-bottom-0">First name</th>
                                        <th class="wd-20p border-bottom-0">Last name</th>
                                        <th class="wd-20p border-bottom-0">Email</th>
                                        <th class="wd-20p border-bottom-0">Phone</th>
                                        <th class="wd-20p border-bottom-0">Company</th>
                                        <th class="wd-20p border-bottom-0">About projects</th>
                                        <th class="wd-20p border-bottom-0">Website</th>
                                        <th class="wd-20p border-bottom-0">Features</th>
                                        <th class="wd-20p border-bottom-0">Status</th>
                                        <th class="wd-20p border-bottom-0">Trial</th>
                                        <th class="wd-20p border-bottom-0">Memberships</th>
                                        <th class="wd-20p border-bottom-0">In review</th>
                                                <th class="wd-20p border-bottom-0">Last login</th>
                                                <th class="wd-20p border-bottom-0">Last updated</th>
                                                <th class="wd-20p border-bottom-0">Date joined</th>
                                                <th class="wd-25p border-bottom-0">Action</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($data['users'])>0)
                                        @foreach ($data['users'] as $user)
                                            @php
                                                if($user->last_login == null){
                                                    $last_login = '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">NO DATA</span>';
                                                }else{
                                                    $last_login = formatted_date($user->last_login);
                                                }

                                                if($user->last_updated == null){
                                                    $last_updated = '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">NO DATA</span>';
                                                }else{
                                                    $last_updated = formatted_date($user->last_updated);
                                                }
                                                $date_joined = formatted_date($user->date_joined);
                                            @endphp
                                            <tr>
                                                <td class="align-middle text-center">{{ $user->id }}</td>
                                                <td class="align-middle text-center"><img alt="image" class="avatar avatar-md br-7" src="{{ url('assets/images/default-avatar.jpg') }}"></td>
                                                <td class="align-middle">{{ $user->name }}</td>
                                                <td class="align-middle">{{ $user->name }}</td>
                                                <td class="align-middle">{{ $user->email }}
                                                    @if($user->email_confirm == 1)
                                                        <span class="badge bg-success mx-1" style="background: #198754 !important;">Verified</span>
                                                    @elseif($user->email_confirm == 0)
                                                        <span class="badge bg-danger mx-1">Not verified</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    @if($user->phone != '')
                                                        {{ $user->phone }}
                                                    @else
                                                        <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">NO DATA</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    @if($user->company_name != '')
                                                        {{ $user->company_name.' (' .$user->company_size . ')' }}
                                                    @else
                                                        <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">NO DATA</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    @if($user->about_projects != '')
                                                        {{ $user->about_projects }}
                                                    @else
                                                        <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">NO DATA</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    @if ($user->website != '')
                                                        <a href="{{ $user->website }}">{{ $user->website }}</a>
                                                    @else
                                                        <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">NO DATA</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle">
                                                    @if($user->features_functions != '')
                                                        {{ $user->features_functions }}
                                                        @if($user->features_functions == 'Special functions')
                                                            {{ ' (' . $user->features_functions . ')' }}
                                                        @endif
                                                    @else
                                                        <span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">NO DATA</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    @if ($user->in_review == 1)
                                                        <span class="badge badge-big bg-warning-gradient">In review</span>
                                                    @elseif ($user->trial_days > 0)
                                                        <span class="badge badge-big bg-info-gradient">In trial</span>
                                                    @elseif ($user->paid_memberships == 1)
                                                        <span class="badge badge-big bg-primary">Memberships</span>
                                                    @elseif ($user->trial_days == null && $user->paid_memberships == 0 && $user->in_review == 0 && $user->in_review != null)
                                                        <span class="badge badge-big bg-success-gradient">Approved</span>
                                                    @elseif($user->trial_days == 0 && $user->trial_days != null)
                                                        <span class="badge badge-big bg-danger-gradient">Trial expired</span>
                                                    @elseif ($user->in_review == null)
                                                        <span class="badge badge-big bg-success" style="background: #198754 !important;">Email verified</span>
                                                    @else
                                                        <span class="badge badge-big bg-default">No info</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    @if($user->trial_days > 0)
                                                        <span class="badge badge-big bg-info">{{ $user->trial_days }};
                                                            @if ($user->trial_days > 1) days
                                                            @else day
                                                            left
                                                            @endif
                                                        </span>
                                                    @elseif ($user->paid_memberships == 0 && $user->trial_days == null)
                                                        <span class="badge badge-big bg-warning">Not started</span>
                                                    @elseif ($user->paid_memberships == 0 && $user->trial_days == 0)
                                                        <span class="badge badge-big bg-danger">Expired</span>
                                                    @else
                                                        <span class="badge badge-big bg-default">No</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    @if ($user->paid_memberships == 1)
                                                        <span class="badge bg-success-gradient">Yes</span>
                                                    @elseif ($user->paid_memberships == 0)
                                                        <span class="badge bg-default">No</span>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center"><span class="badge badge-big bg-success">Approved</span></td>
                                                <td class="align-middle">{!! $last_login !!}</td>
                                                <td class="align-middle">{!! $last_updated !!}</td>
                                                <td class="align-middle">{!! $date_joined !!}</td>
                                                <td class="text-center align-middle">
                                                    @if($user->in_review == 1)
                                                        <div class="btn-group align-top mb-2">
                                                            <a class="btn btn-sm btn-info badge" href="#"
                                                               data-bs-placement="left" data-bs-toggle="tooltip-info"
                                                               title="Approve" id="approve_request"
                                                               data-id="{{ $user->id }}"
                                                               data-email="{{ $user->email }}"
                                                               data-fullname="{{ $user->name }}"><i
                                                                    class="bi bi-check-lg"></i>
                                                                <div class="spinner-border spinner-border-sm"
                                                                     style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;"
                                                                     role="status"></div>
                                                            </a>

                                                            <a class="btn btn-sm btn-info badge" href="#"
                                                               data-bs-placement="top" data-bs-toggle="tooltip-info"
                                                               title="Decline" id="decline_request"
                                                               data-id="{{ $user->id }}"
                                                               data-email="{{ $user->email }}"
                                                               data-fullname="{{ $user->name }}"><i
                                                                    class="bi bi-x-lg"></i>
                                                                <div class="spinner-border spinner-border-sm"
                                                                     style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;"
                                                                     role="status"></div>
                                                            </a>
                                                        </div>
                                                        <br>
                                                    @endif
                                                    <div class="btn-group align-top">
                                                        <a class="btn btn-sm btn-primary badge"
                                                           href="users.php?id={{ $user->id }}" target="_blank"><i
                                                                class="bi bi-eye-fill"></i></a>

                                                        <a class="btn btn-sm btn-primary badge"
                                                           href="edit_user_profile.php?id={{ $user->id }}"><i
                                                                class="bi bi-pencil-square"></i></a>

                                                        <a class="btn btn-sm btn-primary badge"
                                                           href="memberships_settings.php?action=add_user&user_id={{ $user->id }}"
                                                           title="Add memberships package" target="_blank"><i
                                                                class="bi bi-person-video2"></i></a>
                                                    </div>
                                                    <div class="btn-group align-top">
                                                        <a href="add_edit_user.php?user_id={{ $user->id }}"
                                                           class="btn btn-sm btn-primary badge">Edit</a>
                                                        <a href="controllers/User.php?user_id={{ $user->id }}&deleted=true"
                                                           class="btn btn-sm btn-primary badge">
                                                            <i class="bi bi-trash-fill"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="18" class="text-center">No data available.</td>
                                        </tr>
                                    @endif
                                    </tbody>
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
@endpush
@push('js')
    {{ Html::script('assets/plugins/sweet-alert/sweetalert.min.js') }}
    {{ Html::script('superAdmin/js/user.js?t='.rand(0, 10000)) }}
    {{--<script src="js/users.js?t=<?php echo rand(0, 10000);?>"></script>--}}
    <script>
        $(function(e) {
            $('#responsive-datatable').DataTable({
                "iDisplayLength": 50,
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






{{--<tbody>
<?php
if($result == true){
if($result->num_rows > 0){
$i = 1;
while($row = $result->fetch_assoc()){
$_id = $row['id'];
$current_datetime = date('d-m-Y h:i A');
$first_name = $row['first_name'];
$last_name = $row['last_name'];
$email = $row['email'];
$profile_picture = $row['profile_picture'];
$paid_memberships = $row['paid_memberships'];
$in_review = $row['in_review'];
$email_confirm = $row['email_confirm'];
$trial_days = $row['trial_days'];
$phone = $row['phone'];
$company_name = $row['company_name'];
$company_size = $row['company_size'];
$about_projects = $row['about_projects'];
$website = $row['website'];
$features_functions = $row['features_functions'];
$custom_features_functions = $row['custom_features_functions'];

if($row['last_login'] == null){
    $last_login = '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">NO DATA</span>';
}else{
    $last_login = formatted_date($row['last_login']);
}

if($row['last_updated'] == null){
    $last_updated = '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">NO DATA</span>';
}else{
    $last_updated = formatted_date($row['last_updated']);
}

$date_joined = formatted_date($row['date_joined']);
?>
<tr>
    <td class="align-middle text-center"><?php echo $_id;?></td>
    <td class="align-middle text-center">
        <img alt="image" class="avatar avatar-md br-7" src="../assets/images/users/default-avatar.jpg">
    </td>
    <td class="align-middle">{{ $data['users']->name }}</td>
    <td class="align-middle">{{ $data['users']->name }}</td>

    <td class="align-middle"><?php echo $email;?><?php if($email_confirm == 1){echo '<span class="badge bg-success mx-1" style="background: #198754 !important;">Verified</span>';}else if($email_confirm == 0){echo '<span class="badge bg-danger mx-1">Not verified</span>';}?></td>


    <td class="align-middle"><?php if($phone != ''){echo $phone;}else{echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">NO DATA</span>';}?></td>
    <td class="align-middle"><?php if($company_name != ''){echo $company_name . ' (' . $company_size . ')';}else{echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">NO DATA</span>';}?></td>

    <td class="align-middle"><?php if($about_projects != ''){echo $about_projects;}else{echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">NO DATA</span>';}?></td>
    <td class="align-middle"><?php if($website != ''){echo '<a href="' . $website . '">' . $website . '</a>';}else{echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">NO DATA</span>';}?></td>

    <td class="align-middle"><?php if($features_functions != ''){echo $features_functions; if($features_functions == 'Special functions'){echo ' (' . $custom_features_functions . ')';}}else{echo '<span style="display: block;text-align: center;font-size: 60%;font-style: italic;font-weight: bold;">NO DATA</span>';}?></td>
    <td class="align-middle text-center">
        <?php
        if ($in_review == 1)
        {
            echo '<span class="badge badge-big bg-warning-gradient">In review</span>';
        }
        else if ($trial_days > 0)
        {
            echo '<span class="badge badge-big bg-info-gradient">In trial</span>';
        }
        else if ($paid_memberships == 1)
        {
            echo '<span class="badge badge-big bg-primary">Memberships</span>';
        }
        else if ($trial_days == null && $paid_memberships == 0 && $in_review == 0 && $in_review != null)
        {
            echo '<span class="badge badge-big bg-success-gradient">Approved</span>';
        }
        else if ($trial_days == 0 && $trial_days != null)
        {
            echo '<span class="badge badge-big bg-danger-gradient">Trial expired</span>';
        }
        else if ($in_review == null)
        {
            echo '<span class="badge badge-big bg-success" style="background: #198754 !important;">Email verified</span>';
        }
        else
        {
            echo '<span class="badge badge-big bg-default">No info</span>';
        }
        ?>
    </td>
    <td class="align-middle text-center"><?php if($trial_days > 0){echo '<span class="badge badge-big bg-info">' . $trial_days;if($trial_days > 1){echo ' days';}else{echo ' day';} echo ' left</span>';}else if($paid_memberships == 0 && $trial_days == null){echo '<span class="badge badge-big bg-warning">Not started</span>';}else if($paid_memberships == 0 && $trial_days == 0){echo '<span class="badge badge-big bg-danger">Expired</span>';}else{echo '<span class="badge badge-big bg-default">No</span>';};?></td>

    <td class="align-middle text-center"><?php if($paid_memberships == 1){echo '<span class="badge bg-success-gradient">Yes</span>';}else if($paid_memberships == 0){echo '<span class="badge bg-default">No</span>';};?></td>

    <td class="align-middle text-center"><span class="badge badge-big bg-success">Approved</span></td>

    <td class="align-middle"><?php echo $last_login;?></td>
    <td class="align-middle"><?php echo $last_updated;?></td>
    <td class="align-middle"><?php echo $date_joined;?></td>

    <td class="text-center align-middle">

        <?php if($in_review == 1){ ?>
        <div class="btn-group align-top mb-2">
            <a class="btn btn-sm btn-info badge" href="#" data-bs-placement="left" data-bs-toggle="tooltip-info" title="Approve" id="approve_request" data-id="<?php echo $_id;?>" data-email="<?php echo $email;?>" data-fullname="<?php echo $first_name . ' ' . $last_name;?>"><i class="bi bi-check-lg"></i><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;" role="status"></div></a>

            <a class="btn btn-sm btn-info badge" href="#" data-bs-placement="top" data-bs-toggle="tooltip-info" title="Decline" id="decline_request" data-id="<?php echo $_id;?>" data-email="<?php echo $email;?>" data-fullname="<?php echo $first_name . ' ' . $last_name;?>"><i class="bi bi-x-lg"></i><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;width: 10px;height: 10px;" role="status"></div></a>
        </div>
        <br>
        <?php } ?>

        <div class="btn-group align-top">
            <a class="btn btn-sm btn-primary badge" href="users.php?id=<?php echo $_id;?>" target="_blank"><i class="bi bi-eye-fill"></i></a>

            <a class="btn btn-sm btn-primary badge" href="edit_user_profile.php?id=<?php echo $_id;?>"><i class="bi bi-pencil-square"></i></a>

            <a class="btn btn-sm btn-primary badge" href="memberships_settings.php?action=add_user&user_id=<?php echo $_id;?>" title="Add memberships package" target="_blank"><i class="bi bi-person-video2"></i></a>

            <!-- <button class="btn btn-sm btn-primary badge" type="button"><i class="bi bi-trash-fill"></i></button> -->
        </div>
        <div class="btn-group align-top">
            <a href="add_edit_user.php?user_id=<?php echo $_id; ?>" class="btn btn-sm btn-primary badge">Edit</a>
            <a href="controllers/User.php?user_id=<?php echo $_id; ?>&deleted=true" class="btn btn-sm btn-primary badge">
                <i class="bi bi-trash-fill"></i>
            </a>
        </div>
    </td>
</tr>
<?php
$i++;
}
}else{
    echo '<tr><td colspan="18" class="text-center">No data available.</td></tr>';
}
}else{
    echo '<tr><td colspan="18" class="text-center">Semething went wrong, please try again later.</td></tr>';
}
?>
</tbody>--}}
