$('#register').submit(function(e){
    e.preventDefault();
    $('.register-alert').fadeOut();

    var first_name = $('#first_name').val();
    var last_name = $('#last_name').val();
    var email = $('#email').val();
    var pass = $('#pass').val();
    var confirmPass = $('#confirmPass').val();
    var register_btn = $('#register_btn');
    
    if(pass == confirmPass){
        $('.register-alert').fadeOut();
        showLoaderBtn(register_btn);
        var data = new FormData();
        data.append("first_name", first_name);
        data.append("last_name", last_name);
        data.append("email", email);
        data.append("pass", pass);
        data.append("confirmPass", confirmPass);
        data.append("register", "true");
        data.append("POST", "true");
        request = $.ajax({
            url: js_url + 'core/accounts.php',
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function(res){
                if(res.success == true){
                    $('#register').get(0).reset();
                    $('.register-alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                }else if(res.success == false){
                    $('.register-alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                }else{
                    $('.register-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                }
                hideLoaderBtn(register_btn);
            },
            error: function(){
                hideLoaderBtn(register_btn);
                $('.register-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
            }
        });
    }else{
        $('.register-alert').removeClass('alert-success').addClass('alert-danger').html('Confirm password didn\'t match.').fadeIn();
    }
});

$('#login').submit(function(e){
    e.preventDefault();
    $('.login-alert').fadeOut();

    var email = $('#email').val();
    var pass = $('#pass').val();
    var login_btn = $('#login_btn');
    
    $('.login-alert').fadeOut();
    showLoaderBtn(login_btn);

    var data = new FormData();
    data.append("email", email);
    data.append("pass", pass);
    data.append("login", "true");
    data.append("POST", "true");
    request = $.ajax({
        url: js_url + 'core/accounts.php',
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(res){
            if(res.success == true){
                $('#login').get(0).reset();
                $('.login-alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                setTimeout(function(){
                    window.location.reload();
                }, 1000);
            }else if(res.success == false){
                $('.login-alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
            }else{
                $('.login-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
            }
            hideLoaderBtn(login_btn);
        },
        error: function(){
            hideLoaderBtn(login_btn);
            $('.login-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
        }
    });
});

$('#forgot_password').submit(function(e){
    e.preventDefault();
    $('.forgot-alert').fadeOut();

    var email = $('#email').val();
    var otp = $('#otp').val();
    var newPass = $('#newPass').val();
    var confirmNewPass = $('#confirmNewPass').val();
    var find_btn = $('#find_btn');
    
    $('.forgot-alert').fadeOut();

    if(otp == ''){
        showLoaderBtn(find_btn);
        var data = new FormData();
        data.append("email", email);
        data.append("find_email", "true");
        data.append("forgot_password", "true");
        data.append("POST", "true");
        request = $.ajax({
            url: 'core/accounts.php',
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function(res){
                if(res.success == true){
                    //$('#forgot_password').get(0).reset();
                    $('.forgot-alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                    $('#desc').html('Enter the confirmation code');
                    $('#otp').attr('required', '');
                    $('#email_wrap').hide();
                    $('#otp_wrap').show();
                    $('#btn_text').html('Verify');
                }else if(res.success == false){
                    $('.forgot-alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                }else{
                    $('.forgot-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                }
                hideLoaderBtn(find_btn);
            },
            error: function(){
                hideLoaderBtn(find_btn);
                $('.forgot-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
            }
        });
    }else{
        if((newPass == '' && confirmNewPass == '') || $('#pass_wrap').is(":hidden")){
            showLoaderBtn(find_btn);
            var data = new FormData();
            data.append("email", email);
            data.append("otp", otp);
            data.append("verify_otp", "true");
            data.append("forgot_password", "true");
            data.append("POST", "true");
            request = $.ajax({
                url: 'core/accounts.php',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(res){
                    if(res.success == true){
                        $('.forgot-alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                        $('#desc').html('Create new password');
                        $('#newPass').attr('required', '');
                        $('#newPass').val('');
                        $('#confirmNewPass').attr('required', '');
                        $('#confirmNewPass').val('');
                        $('#otp_wrap').hide();
                        $('#pass_wrap').show();
                        $('#btn_text').html('Update');
                        $('.forgot-alert').fadeOut();
                    }else if(res.success == false){
                        $('.forgot-alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                    }else{
                        $('.forgot-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                    }
                    hideLoaderBtn(find_btn);
                },
                error: function(){
                    hideLoaderBtn(find_btn);
                    $('.forgot-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                }
            });
        }else{
            showLoaderBtn(find_btn);
            var data = new FormData();
            data.append("email", email);
            data.append("otp", otp);
            data.append("newPass", newPass);
            data.append("confirmNewPass", confirmNewPass);
            data.append("create_new_password", "true");
            data.append("forgot_password", "true");
            data.append("POST", "true");
            request = $.ajax({
                url: 'core/accounts.php',
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(res){
                    if(res.success == true){
                        $('.forgot-alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                        setTimeout(function(){
                            window.location.href = 'login';
                        }, 1200);
                    }else if(res.success == false){
                        $('.forgot-alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                    }else{
                        $('.forgot-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                    }
                    hideLoaderBtn(find_btn);
                },
                error: function(){
                    hideLoaderBtn(find_btn);
                    $('.forgot-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                }
            });
        }
    }
});

function resend_email_otp(email){
    var data = new FormData();
    data.append("email", email);
    data.append("find_email", "true");
    data.append("forgot_password", "true");
    data.append("POST", "true");
    $('.resent_email').html('<div class="spinner-border spinner-border-sm" role="status"></div>');
    request = $.ajax({
        url: 'core/accounts.php',
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(res){
            if(res.success == true){
                $('.resent_email').html('SENT!').css({color: '#03d003'});
            }else if(res.success == false){
                $('.resent_email').html('FAILED!').css({color: 'red'});
            }else{
                $('.resent_email').html('FAILED!').css({color: 'red'});
            }
        },
        error: function(){
            $('.resent_email').html('FAILED!').css({color: 'red'});
        }
    });
}

function resend_email(email){
    var data = new FormData();
    data.append("email", email);
    data.append("resend_email", "true");
    data.append("POST", "true");
    $('.resent_email').html('<div class="spinner-border spinner-border-sm" role="status"></div>');
    
    request = $.ajax({
        url: 'core/accounts.php',
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(res){
            if(res.success == true){
                //$('#register').get(0).reset();
                $('.resent_email').html('SENT!').css({color: '#03d003'});
            }else if(res.success == false){
                $('.resent_email').html('FAILED!').css({color: 'red'});
            }else{
                $('.resent_email').html('FAILED!').css({color: 'red'});
            }
        },
        error: function(){
            $('.resent_email').html('FAILED!').css({color: 'red'});
        }
    });
}

function hideLoaderBtn(register_btn){
    var register_btn_height = register_btn.height() / 2;
    
    register_btn.children('span').eq(0).css({
        display: 'block',
        webkitTransform: 'translateY(0px)',
        transform: 'translateY(0px)',
        opacity: 1
    });

    register_btn.children('span').eq(1).css({
        top: 'calc(50% + ' + register_btn_height +'px)',
        opacity: 0
    });

    setTimeout(function(){
        register_btn.children('span').eq(1).children().eq(0).hide();
        register_btn.prop('disabled', false);
    }, 200);
}

function showLoaderBtn(register_btn){
    register_btn.prop('disabled', true);
    var register_btn_height = register_btn.height() / 2;
    
    register_btn.children('span').eq(1).css({
        position: 'absolute',
        top: 'calc(50% + ' + register_btn_height +'px)',
        left: '50%',
        transform: 'translate(-50%, -50%)',
        opacity: 0
    });

    setTimeout(function(){
        register_btn.children('span').eq(1).children().eq(0).show();
        register_btn.children('span').eq(0).css({
            display: 'block',
            webkitTransform: 'translateY(-'+register_btn_height+'px)',
            transform: 'translateY(-'+register_btn_height+'px)',
            opacity: 0
        });
        register_btn.children('span').eq(1).css({
            top: '50%',
            opacity: 1
        });
    }, 10);
}

function verify_email(key){
    var data = new FormData();
    data.append("key", key);
    data.append("verify_email", "true");
    data.append("POST", "true");
    request = $.ajax({
        url: 'core/accounts.php',
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(res){
            if(res.success == true){
                $('#verify').fadeOut(200);
                setTimeout(function(){
                    $('#verified').fadeIn(200);
                    animationSUCCESS.playSegments([0, 195], true);
                    setTimeout(function(){
                        $('.register-alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                    }, 4400);
                }, 180);
            }else if(res.success == false){
                $('#verify').fadeOut(200);
                setTimeout(function(){
                    $('#failed').fadeIn(200);
                    animationFAILED.playSegments([0, 240], true);
                    setTimeout(function(){
                        $('.register-alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                    }, 3000);
                }, 180);
            }else{
                $('#verify').fadeOut(200);
                setTimeout(function(){
                    $('#failed').fadeIn(200);
                    animationFAILED.playSegments([0, 240], true);
                    setTimeout(function(){
                        $('.register-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                    }, 3000);
                }, 199);
            }
        },
        error: function(){
            $('#verify').fadeOut(200);
            setTimeout(function(){
                $('#failed').fadeIn(200);
                animationFAILED.playSegments([0, 240], true);
                setTimeout(function(){
                    $('.register-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                }, 3000);
            }, 199);
        }
    });
}