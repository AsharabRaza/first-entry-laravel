@extends('dashboard.admin.layouts.template')
@section('content')

    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">

                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Change Password</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">ADMIN</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Profile</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Change Password</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="card">
                            <div class="card-header" style="place-content: space-between;">
                                <h3 class="card-title">Change Password</h3>
                            </div>
                            <form id="change_password_form" method="POST" style="display: inline-grid;">
                                <div class="card-body">
                                    <div class="alert alert-change-pwd" style="display: none;"></div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="form-group">
                                                <label for="old_pwd">Old Password</label>
                                                <input type="password" class="form-control" id="old_pwd" name="old_pwd" placeholder="Type Old Password" required>
                                                <span class="text-danger">@error('old_pwd'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="new_pwd">New Password</label>
                                                <input type="password" class="form-control" id="new_pwd" name="new_pwd" placeholder="Type New Password" required>
                                                <span class="text-danger">@error('new_pwd'){{ $message }}@enderror</span>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12">
                                            <div class="form-group">
                                                <label for="re_type_pwd">Confirm New Password</label>
                                                <input type="password" class="form-control" id="re_type_pwd" name="re_type_pwd" placeholder="Confirm New Password" required>
                                                <span class="text-danger">@error('re_type_pwd'){{ $message }}@enderror</span>
                                                <div class="invalid-feedback" id="feedback_change_pwd"></div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit" id="update_btn" style="float: right;position: relative;">
                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;">Update</span>
                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;"><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;" role="status"></div></span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- COL END -->
                </div>
                <!-- ROW-1 END -->

            </div>
            <!-- CONTAINER END -->
        </div>
    </div>

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
    </style>
@endpush
@push('js')
    <script>
        var change_password = '{{ route('admin.change-password') }}';

        $("#re_type_pwd").keyup(function(){
            var retype_pwd = $("#re_type_pwd").val();
            var new_pwd = $("#new_pwd").val();

            if(new_pwd == retype_pwd){
                $("#re_type_pwd").removeClass('is-invalid');
                $('#feedback_change_pwd').hide();
            }else{
                if(retype_pwd != '' && new_pwd != ''){
                    $("#re_type_pwd").addClass('is-invalid');
                    $('#feedback_change_pwd').html('Confirm password didn\'t match.').fadeIn();
                }
            }
        });

        $("#new_pwd").keyup(function(){
            var retype_pwd = $("#re_type_pwd").val();
            var new_pwd = $("#new_pwd").val();

            if(new_pwd == retype_pwd && retype_pwd != '' && new_pwd != ''){
                $("#re_type_pwd").removeClass('is-invalid');
                $('#feedback_change_pwd').hide();
            }else{
                if(retype_pwd != '' && new_pwd != ''){
                    $("#re_type_pwd").addClass('is-invalid');
                    $('#feedback_change_pwd').html('Confirm password didn\'t match.').fadeIn();
                }
            }
        });

        $('#change_password_form').submit(function(e){
            e.preventDefault();

            var old_pwd = $("#old_pwd").val();
            var retype_pwd = $("#re_type_pwd").val();
            var new_pwd = $("#new_pwd").val();
            var update_btn = $('#update_btn');
            if($('#old_pwd').val() != '' && $('#new_pwd').val() != '' && $('#retype_pwd').val() != ''){
                if(new_pwd == retype_pwd){
                    $("#re_type_pwd").removeClass('is-invalid');
                    $('#feedback_change_pwd').hide();
                    showLoaderBtn(update_btn);

                    var data = new FormData();
                    data.append("check_change_pwd_admins", "true");
                    data.append("old_pwd", old_pwd);
                    data.append("retype_pwd", retype_pwd);
                    data.append("new_pwd", new_pwd);
                    data.append("POST", "true");

                    $.ajax({
                        url: change_password,
                        type: 'POST',
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function(res){
                            if(res.success == true){
                                $('.alert-change-pwd').addClass('alert-success').removeClass('alert-danger').html(res.msg).fadeIn();
                                setTimeout(function(){
                                    window.location.href= '{{ route('admin.logout') }}';
                                }, 1000);
                            }else if(res.success == false){
                                $('.alert-change-pwd').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                            }else{
                                $('.alert-change-pwd').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                            }
                            hideLoaderBtn(update_btn);
                        },
                        error: function(){
                            hideLoaderBtn(update_btn);
                            $('.alert-change-pwd').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                        }
                    });
                }else{
                    $('#feedback_change_pwd').html('Confirm password didn\'t match.').fadeIn();
                    $("#re_type_pwd").focus();
                }
            }
        });

        function hideLoaderBtn(submit_btn){
            var submit_btn_height = submit_btn.height() / 2;

            submit_btn.children('span').eq(0).css({
                display: 'block',
                webkitTransform: 'translateY(0px)',
                transform: 'translateY(0px)',
                opacity: 1
            });

            submit_btn.children('span').eq(1).css({
                top: 'calc(50% + ' + submit_btn_height +'px)',
                opacity: 0
            });

            setTimeout(function(){
                submit_btn.children('span').eq(1).children().eq(0).hide();
                submit_btn.prop('disabled', false);
            }, 200);
        }

        function showLoaderBtn(submit_btn){
            submit_btn.prop('disabled', true);
            var submit_btn_height = submit_btn.height() / 2;

            submit_btn.children('span').eq(1).css({
                position: 'absolute',
                display: 'flex',
                top: 'calc(50% + ' + submit_btn_height +'px)',
                left: '50%',
                transform: 'translate(-50%, -50%)',
                opacity: 0
            });

            setTimeout(function(){
                submit_btn.children('span').eq(1).children().eq(0).show();
                submit_btn.children('span').eq(0).css({
                    display: 'block',
                    webkitTransform: 'translateY(-'+submit_btn_height+'px)',
                    transform: 'translateY(-'+submit_btn_height+'px)',
                    opacity: 0
                });
                submit_btn.children('span').eq(1).css({
                    top: '50%',
                    opacity: 1
                });
            }, 10);
        }
    </script>
@endpush


