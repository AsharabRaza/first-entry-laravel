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
                        <h1 class="page-title">Profile</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Management</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Profile</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View profile</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- ROW-1 OPEN -->
                <div class="row" id="user-profile">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-none alert"></div>
                                <div class="wideget-user">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xl-6">
                                            <div class="wideget-user-desc d-sm-flex">
                                                <div class="wideget-user-img">
{{--                                                <!-- <img class="" src="<?php if($profile_pic == ''){echo '../assets/images/users/default-avatar.jpg';}else{echo '../assets/images/users/' . $profile_pic;}?>" alt="img"> -->--}}
                                                    <form class="form" id = "form" action="" enctype="multipart/form-data" method="post" onchange="handleImageUpload()">
                                                        <div class="upload">
                                                            @php
                                                            //dd($data['user']->profile_picture);
                                                                if($data['user']->profile_picture == '') {
                                                                    $image = url('assets/images/default-avatar.jpg');
                                                                }
                                                                else{
                                                                    $image = url('user/images/uploaded/'.$data['user']->profile_picture);
                                                                }
                                                               // dd($image);
                                                            @endphp
                                                            <img src="<?php echo $image; ?>" width = 125 height = 125 title="<?php echo $image; ?>">
                                                            <div class="round">
                                                                <input type="file" name="image" id = "image" accept=".jpg, .jpeg, .png">
                                                                <i class="bi bi-pen" style="font-size: 20px;"></i>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="user-wrap">
                                                    <h4>&nbsp;&nbsp;{{  $data['user']->first_name . $data['user']->last_name }} </h4>
                                                    <h6 class="text-muted mb-3">&nbsp;&nbsp;&nbsp;Member since: {{ date("M d, Y", strtotime($data['user']->date_joined)) }}</h6>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-xl-6">
                                            <div class="text-xl-right mt-4 mt-xl-0 p_right_buttons">
                                                <a href="change_password.php" class="btn btn-white">Change password</a>
                                                <a href="edit_profile.php" class="btn btn-primary">Edit Profile</a>
                                            </div>
                                            <div class="mt-5">
                                                <div class="main-profile-contact-list float-lg-end d-lg-flex row" style="width: 100%;">
                                                    <div class="col-6 col-md-4 me-5">
                                                        <div class="media">
                                                            <div class="media-icon bg-primary me-3 mt-1" style="display: flex;place-content: center;align-items: center;">
                                                                <i class="bi bi-star-fill fs-20 text-white" ></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <span class="text-muted">Lotteries</span>
                                                                <div class="fw-semibold fs-25">
                                                                    {{ $data['lottery_count'] }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-4 me-5 mt-5 mt-md-0">
                                                        <div class="media">
                                                            <div class="media-icon bg-success me-3 mt-1" style="display: flex;place-content: center;align-items: center;">
                                                                <i class="bi bi-people-fill fs-20 text-white"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <span class="text-muted">Entries</span>
                                                                <div class="fw-semibold fs-25">
                                                                    {{ '0' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-6 col-md-4 me-0 mt-5 mt-md-0">
                                                        <div class="media">
                                                            <div class="media-icon bg-orange me-3 mt-1" style="display: flex;place-content: center;align-items: center;">
                                                                <i class="bi bi-envelope-fill fs-20 text-white"></i>
                                                            </div>
                                                            <div class="media-body">
                                                                <span class="text-muted">Emails sent</span>
                                                                <div class="fw-semibold fs-25">
                                                                    {{ '0' }}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="border-top">
                                <div class="wideget-user-tab">
                                    <div class="tab-menu-heading">

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab-51">
                                <div id="profile-log-switch">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="media-heading">
                                                <h4><strong>Personal Information</strong></h4>
                                            </div>
                                            <div class="table-responsive p_data">
                                                <table class="table row table-borderless">
                                                    <tbody class="col-lg-12 col-xl-6 p-0">
                                                        <tr>
                                                            <td><strong>Full Name :</strong> {{ $data['user']->first_name . $data['user']->last_name }}</td>
                                                        </tr>
                                                    @if($data['user']->user_type == 2)
                                                        <tr>
                                                            <td><strong>Phone :</strong> <?php echo $phone; ?> </td>
                                                        </tr>
                                                    @elseif($data['user']->user_type == 1)
                                                        <tr>
                                                            <td><strong>Company :</strong> {{ $data['user']->company_name }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Company Size :</strong> {{ $data['user']->company_size }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Features or functions you are looking for? :</strong>
                                                                @if($data['user']->custom_features_functions == NULL)
                                                                    {{ $data['user']->features_functions }}
                                                                @else
                                                                    {{ $data['user']->custom_features_functions }}
                                                                @endif
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Website or Social link :</strong>
                                                                @php
                                                                    $url = '@(http(s)?)?(://)?(([a-zA-Z])([-\w]+\.)+([^\s\.]+[^\s]*)+[^,.\s])@';
                                                                    $string = preg_replace($url, '<a href="https://$4" target="_blank" title="$0">$0</a>', $data['user']->website);
                                                                    echo $string;
                                                                @endphp
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Email :</strong> {{ $data['user']->email }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td><strong>Phone :</strong> {{ $data['user']->phone }} </td>
                                                        </tr>
                                                    @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="row profie-img">
                                                <div class="col-md-12">
                                                    <div class="media-heading">
                                                        <h5><strong>About @if($data['user']->user_type==1) {{ 'projects' }} @elseif($data['user']->user_type==2) {{ 'me' }} @endif : </strong></h5>
                                                    </div>
                                                    <p>{{ $data['user']->about_projects }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- COL-END -->
                </div>
                <!-- ROW-1 CLOSED -->
            </div>
        </div>
    </div>
    <!-- CONTAINER CLOSED -->

@endsection
@push('css')
    <style>
        .p_data a {
            color: #dedefd;
            text-decoration: underline;
        }
        .main-profile-contact-list .col-6 {
            margin-right: 0 !important;
            margin-top: 0 !important;
            margin-bottom: 26px !important;
        }
        @media (max-width: 576px) {
            .wideget-user-desc, .p_right_buttons, .wideget-user-img {
                text-align: center;
            }

            .wideget-user-img {
                width: 100% !important;
            }

            .wideget-user-desc .user-wrap {
                margin-left: 0 !important;
            }

            .wideget-user-desc .wideget-user-img img {
                margin: auto !important;
            }


        }
        .upload{
            width: 125px;
            position: relative;
            margin: auto;
        }

        .upload img{
            border-radius: 50%;
            border: 8px solid #DCDCDC;
        }

        .upload .round{
            position: absolute;
            bottom: 0;
            right: 0;
            background: #00B4FF;
            width: 32px;
            height: 32px;
            line-height: 33px;
            text-align: center;
            border-radius: 50%;
            overflow: hidden;
            border: 2px solid #22223D;
        }

        .upload .round input[type = "file"]{
            position: absolute;
            transform: scale(2);
            opacity: 0;
        }

        input[type=file]::-webkit-file-upload-button{
            cursor: pointer;
        }
    </style>
@endpush
@push('js')
    <script type="text/javascript">

        function handleImageUpload(){
            var fileInput = document.getElementById('image');
            var file = fileInput.files[0];
            var formData = new FormData();
            formData.append('image', file);

            $.ajax({
                url : '{{ route('user.upload-profile-image') }}',
                type : 'post',
                data : formData,
                dataType : 'json',
                processData: false,
                contentType: false,
                success : function(resp){
                    if(resp.success == 'true'){
                       $('.alert').removeClass('d-none');
                       $('.alert').text(resp.msg);
                       $('.alert').addClass('alert-success');
                       setTimeout(function (){
                           window.location.reload();
                       },2000);

                    }
                    else if(resp.success == 'false'){
                       $('.alert').removeClass('d-none');
                       $('.alert').text(resp.msg);
                       $('.alert').addClass('alert-danger');
                        setTimeout(function (){
                            window.location.reload();
                        },2000);
                    }
                }
            });

        }

    </script>
@endpush


