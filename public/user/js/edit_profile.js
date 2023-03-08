$('#features_or_functions').change(function(){
    console.log($(this).val());
    if($(this).val() == 'Special functions'){
        $('#please_specify_custom').removeClass('d-none');
        $('#please_specify_custom').attr('required', '');
    }else{
        $('#please_specify_custom').addClass('d-none');
        $('#please_specify_custom').removeAttr('required');
    }
});

$('#edit_profile_form').submit(function(e){
    e.preventDefault();
    var update_btn = $('#update_btn');

    swal({
        title: "Are you sure?",
        text: "You want to update your profile?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: 'Submit',
        cancelButtonText: 'Cancel'
    }, function(isConfirmed){
        if (isConfirmed) {
            showLoaderBtn(update_btn);

            var first_name = $('#first_name').val();
            var last_name = $('#last_name').val();
            var phone = $('#phone').val();
            var email = $('#email').val();
            var company_name = $('#company_name').val();
            var company_size = $('#company_size').val();
            var about_projects = $('#about_projects').val();
            var website_or_social = $('#website_or_social').val();
            var features_or_functions = $('#features_or_functions').val();
            var please_specify_custom = $('#please_specify_custom').val();

            var data = new FormData();
            data.append("first_name", first_name);
            data.append("last_name", last_name);
            data.append("phone", phone);
            data.append("email", email);
            data.append("company_name", company_name);
            data.append("company_size", company_size);
            data.append("about_projects", about_projects);
            data.append("website_or_social", website_or_social);
            data.append("features_or_functions", features_or_functions);
            data.append("please_specify_custom", please_specify_custom);

            if(submit_profile == true){
                data.append("submit_profile", "true");
            } else {
                data.append("submit_profile", "false");
            }

            data.append("edit_profile", "true");
            data.append("POST", "true");

            old_request = $.ajax({
                url: update_profile,
                type: 'POST',
                data: data,
                processData: false,
                contentType: false,
                success: function(res){
                    $('.alert').hide();
                    if(res.success == true){
                        $('.edit_profile_alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                        setTimeout(function(){
                            window.location.reload();
                        }, 2000);
                    }else if(res.success == false){
                        $('.edit_profile_alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                    }else{
                        $('.edit_profile_alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                    }
                    hideLoaderBtn(update_btn);
                    if(submit_profile == true){
                        setTimeout(function(){
                            $('#update_btn').prop('disabled', true);
                        }, 300);
                    }
                },
                error: function () {
                    $('.alert').hide();
                    $('.edit_profile_alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                    hideLoaderBtn(update_btn);
                    if(submit_profile == true){
                        setTimeout(function(){
                            $('#update_btn').prop('disabled', true);
                        }, 300);
                    }
                }
            });
        }
    });
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
