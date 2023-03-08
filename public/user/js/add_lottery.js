$('#lottery_logo').change(function(){
    if($(this).val() == ''){
        $('#fake_img_lottery_logo').val($('#fake_img_lottery_logo').attr('data-value'));
        if($('#fake_img_lottery_logo').val() != ''){
            $('#preview_lottery_logo,.second_logo_value').attr('src', '../assets/images/media/' + $('#fake_img_lottery_logo').val());
            $('#preview_lottery_logo_wrap').removeClass('d-none');
        }else{
            $('#preview_lottery_logo_wrap').addClass('d-none');
        }
    }else{
        $('#preview_lottery_logo')[0].src = (window.URL ? URL : webkitURL).createObjectURL($(this).get(0).files[0]);
        $('.second_logo_value').attr('src', (window.URL ? URL : webkitURL).createObjectURL($(this).get(0).files[0]));
        $('#fake_img_lottery_logo').val('');
        $('#preview_lottery_logo_wrap').removeClass('d-none');
        $('#lottery_logo').css({borderColor: ''});
    }
});

$('#remove_img_lottery_logo').click(function(){
    $('#fake_img_lottery_logo').val('');
    $('#fake_img_lottery_logo').attr('data-value', '');
    $('#lottery_logo').val('');
    $('#preview_lottery_logo_wrap').addClass('d-none');
    $('#preview_lottery_logo, .second_logo_value').attr('src', '');
});


$('#lottery_background_image').change(function(){
    if($(this).val() == ''){
        $('#fake_img_lottery_background_image').val($('#fake_img_lottery_background_image').attr('data-value'));
        if($('#fake_img_lottery_background_image').val() != ''){
            $('#preview_lottery_background_image').attr('src', '../assets/images/media/' + $('#fake_img_lottery_background_image').val());
            $('#preview_lottery_background_image_wrap').removeClass('d-none');
        }else{
            $('#preview_lottery_background_image_wrap').addClass('d-none');
        }
    }else{
        $('#preview_lottery_background_image')[0].src = (window.URL ? URL : webkitURL).createObjectURL($(this).get(0).files[0]);
        $('#fake_img_lottery_background_image').val('');
        $('#preview_lottery_background_image_wrap').removeClass('d-none');
        $('#lottery_background_image').css({borderColor: ''});
    }
});

$('#remove_img_lottery_background_image').click(function(){
    $('#fake_img_lottery_background_image').val('');
    $('#fake_img_lottery_background_image').attr('data-value', '');
    $('#lottery_background_image').val('');
    $('#preview_lottery_background_image_wrap').addClass('d-none');
    $('#preview_lottery_background_image').attr('src', '');
});


$('#lottery_url').keypress(function(e){
    if(e.which === 32)
        return false;
});

var old_request;
$('#lottery_url').keyup(function(e){
    $(this).removeClass('is-invalid');
    $(this).removeClass('is-valid');
    if($(this).val() != ''){
        if(old_request){
            old_request.abort();
        }
        var data = new FormData();
        data.append("lottery_url", $(this).val());
        if($(this).attr('data-not') && $(this).attr('data-not') != ''){
            data.append("not", $(this).attr('data-not'));
        }
        data.append("check_lottery_name", "true");
        data.append("POST", "true");

        old_request = $.ajax({
            url: check_lottery_url,
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function(res){
                if(res.success == true){
                    $('#lottery_url').addClass('is-valid');
                }else if(res.success == false){
                    $('#lottery_name_invalid_feedback').html(res.msg);
                    $('#lottery_url').addClass('is-invalid');
                }else{
                    $('#lottery_name_invalid_feedback').html('Something went wrong, please try again later.');
                    $('#lottery_url').addClass('is-invalid');
                }
            },
            error: function(){

            }
        });
    }else{
        if(old_request){
            old_request.abort();
        }
    }

});

$('#add_lottery_form').submit(function(e){
    e.preventDefault();

    var lottery_url = $('#lottery_url').val();
    var lottery_title = $('#lottery_title').val();
    var number_of_winners = $('#number_of_winners').val();
    var start_date = $('#start_date').val();
    var start_time = $('#start_time').val();
    var event_date = $('#event_date').val();
    var event_time = $('#event_time').val();
    var allow_guest = $('#allow_guest').val();
    var end_date = $('#end_date').val();
    var end_time = $('#end_time').val();
    var description = $('#description').val();
    var how_it_works = $('#how_it_works').val();
    var terms_conditions = $('#terms_conditions').val();
    var country_code = $('#countries').val();
    var timezone = $('#timezone').val();
    var scanning_option = $('#scanning_option').val();
    var queing_process = $('#queing_process').is(":checked") ? 1 : 0;
    var submit_btn = $('#submit_btn');

    $('.lottery-alert').fadeOut();

    if($('#lottery_url').hasClass('is-valid')){
        if(description != ''){
            console.log('Sumitted');
            $('#description_wrap').css({borderColor: ''});
            if(how_it_works != ''){
                $('#how_it_works_wrap').css({borderColor: ''});
                if(terms_conditions != ''){
                    $('#terms_conditions_wrap').css({borderColor: ''});
                    showLoaderBtn(submit_btn);


                    if($('#lottery_logo').val() != '' || $('#lottery_background_image').val() != ''){
                        var data = new FormData();

                        if($('#lottery_logo').val() != ''){
                            data.append('lottery_logo', $('#lottery_logo').get(0).files[0]);
                        }

                        if($('#lottery_background_image').val() != ''){
                            data.append('lottery_background_image', $('#lottery_background_image').get(0).files[0]);
                        }

                        data.append('lottery_images_upload', 'true');
                        data.append('POST', 'true');

                        $.ajax({
                            type:'POST',
                            url: add_lottery,
                            data: data,
                            cache: false,
                            enctype: 'multipart/form-data',
                            contentType: false,
                            processData: false,
                            success:function(res){
                                if(res.success == true){
                                    var data = {};
                                    data["lottery_url"] = lottery_url;
                                    data["lottery_title"] = lottery_title;
                                    data["number_of_winners"] = number_of_winners;
                                    data["start_date"] = start_date;
                                    data["start_time"] = start_time;
                                    data["event_date"] = event_date;
                                    data["event_time"] = event_time;
                                    data["allow_guest"] = allow_guest;
                                    data["end_date"] = end_date;
                                    data["end_time"] = end_time;
                                    data["add_lottery"] = "true";
                                    data["POST"] = "true";
                                    data["country_code"] = country_code;
                                    data["timezone"] = timezone;
                                    data["scanning_option"] = scanning_option;
                                    data["queing_process"] = queing_process;

                                    if(res.lottery_logo != undefined){
                                        data["lottery_logo"] = res.lottery_logo;
                                    }else{
                                        data["lottery_logo"] = "";
                                    }

                                    if(res.lottery_background_image != undefined){
                                        data["lottery_background_image"] = res.lottery_background_image;
                                    }else{
                                        data["lottery_background_image"] = "";
                                    }

                                    var data_json = {};
                                    data_json[0] = data;
                                    data_json[1] = description;
                                    data_json[2] = how_it_works;
                                    data_json[3] = terms_conditions;

                                    add_lottery_run(data_json, submit_btn);
                                }else if(res.success == false){
                                    $('.lottery-alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                                }else{
                                    $('.lottery-alert').removeClass('alert-success').addClass('alert-danger').html('Error uploading map image.').fadeIn();
                                }
                               // hideLoaderBtn(update_btn);
                            },
                            error: function(data){
                                //hideLoaderBtn(update_btn);
                                $('.lottery-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                            }
                        });
                    }else{
                        var data = {};
                        data["lottery_url"] = lottery_url;
                        data["lottery_title"] = lottery_title;
                        data["number_of_winners"] = number_of_winners;
                        data["start_date"] = start_date;
                        data["start_time"] = start_time;
                        data["event_date"] = event_date;
                        data["event_time"] = event_time;
                        data["allow_guest"] = allow_guest;
                        data["end_date"] = end_date;
                        data["end_time"] = end_time;
                        data["add_lottery"] = "true";
                        data["POST"] = "true";
                        data["lottery_logo"] = "";
                        data["lottery_background_image"] = "";
                        data["country_code"] = country_code;
                        data["timezone"] = timezone;
                        data["scanning_option"] = scanning_option;
                        data["queing_process"] = queing_process;
                        data["add_lottery"] = true;

                        if($('#fake_img_lottery_logo').attr('data-value') == ''){
                            data["lottery_logo"] = "";
                        }else{
                            data["lottery_logo"] = $('#fake_img_lottery_logo').attr('data-value');
                        }

                        if($('#fake_img_lottery_background_image').attr('data-value') == ''){
                            data["lottery_background_image"] = "";
                        }else{
                            data["lottery_background_image"] = $('#fake_img_lottery_background_image').attr('data-value');
                        }
                        var data_json = {};
                        data_json[0] = data;
                        data_json[1] = description;
                        data_json[2] = how_it_works;
                        data_json[3] = terms_conditions;

                        add_lottery_run(data_json, submit_btn);
                    }

                }else{
                    $('#terms_conditions_wrap').get(0).style.setProperty('border-color', 'red', 'important');
                }
            }else{
                $('#how_it_works_wrap').get(0).style.setProperty('border-color', 'red', 'important');
            }
        }else{
            $('#description_wrap').get(0).style.setProperty('border-color', 'red', 'important');
        }
    }else{
        $('#lottery_url').focus();
    }
});

$('#countries').change(function() {
    var country_code = $('#countries').val();
    $('#timezone').html();

    $.ajax({
        //url: 'core/lotteries.php?get_time_zone=true&country_code='+country_code,
        url: get_country_timezone,
        data:{'get_time_zone':'true','country_code':country_code},
        type: 'POST',
        success: function(res){
            //res = JSON.parse(res);
            let html = '';
            for(const timezone of res) {
                html += '<option value="'+timezone+'">'+timezone+'</option>';
            }
            $('#timezone').html(html);
        },
        error: function(){
        }
    });
});

function add_lottery_run(data_json, submit_btn){
    $.ajax({
        //url: 'core/lotteries.php?add_lottery=true',
        url: add_lottery,
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(data_json),
        processData: false,
        contentType: "application/json",
        success: function(res){
            if(res.success == true){
                // $('#add_lottery_form').get(0).reset();
                $('.lottery-alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                setTimeout(function(){
                    //window.location.href = 'edit_lottery.php?id='+res.lottery_id+'&edit_tab=2';
                    window.location.href = res.url;

                }, 1200);
            }else if(res.success == false){
                $('.lottery-alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
            }else{
                $('.lottery-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
            }
           // hideLoaderBtn(submit_btn);
        },
        error: function(){
           // hideLoaderBtn(submit_btn);
            $('.lottery-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
        }
    });
}


$('#edit_lottery_form').submit(function(e){
    e.preventDefault();

    var lottery_url = $('#lottery_url').val();
    var lottery_title = $('#lottery_title').val();
    var number_of_winners = $('#number_of_winners').val();
    var start_date = $('#start_date').val();
    var start_time = $('#start_time').val();
    var event_date = $('#event_date').val();
    var event_time = $('#event_time').val();
    var allow_guest = $('#allow_guest').val();
    var end_date = $('#end_date').val();
    var end_time = $('#end_time').val();
    var description = $('#description').val();
    var how_it_works = $('#how_it_works').val();
    var terms_conditions = $('#terms_conditions').val();
    var lottery_id = $('#lottery_id').val();
    var country_code = $('#countries').val();
    var timezone = $('#timezone').val();
    var scanning_option = $('#scanning_option').val();
    var queing_process = $('#queing_process').is(":checked") ? 1 : 0;
    var update_btn = $('#update_btn');

    $('.lottery-alert').fadeOut();

    if($('#lottery_url').hasClass('is-valid')){
        if(description != ''){
            $('#description_wrap').css({borderColor: ''});
            if(how_it_works != ''){
                $('#how_it_works_wrap').css({borderColor: ''});
                if(terms_conditions != ''){
                    $('#terms_conditions_wrap').css({borderColor: ''});
                    swal({
                        title: "Are you sure?",
                        text: "You want to update this lottery?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonText: 'Update',
                        cancelButtonText: 'Cancel'
                    }, function(isConfirmed){
                        if (isConfirmed) {
                            showLoaderBtn(update_btn);

                            if($('#lottery_logo').val() != '' || $('#lottery_background_image').val() != ''){
                                var data = new FormData();

                                if($('#lottery_logo').val() != ''){
                                    data.append('lottery_logo', $('#lottery_logo').get(0).files[0]);
                                }else{
                                    data["lottery_logo"] = "";
                                }

                                if($('#lottery_background_image').val() != ''){
                                    data.append('lottery_background_image', $('#lottery_background_image').get(0).files[0]);
                                }else{
                                    data["lottery_background_image"] = "";
                                }

                                data.append('lottery_images_upload', 'true');
                                data.append('POST', 'true');

                                $.ajax({
                                    type:'POST',
                                    url: 'core/lotteries.php',
                                    data: data,
                                    cache: false,
                                    enctype: 'multipart/form-data',
                                    contentType: false,
                                    processData: false,
                                    success:function(res){
                                        if(res.success == true){
                                            var data = {};
                                            data["lottery_url"] = lottery_url;
                                            data["country_code"] = country_code;
                                            data["timezone"] = timezone;
                                            data["lottery_title"] = lottery_title;
                                            data["number_of_winners"] = number_of_winners;
                                            data["start_date"] = start_date;
                                            data["start_time"] = start_time;
                                            data["event_date"] = event_date;
                                            data["event_time"] = event_time;
                                            data["allow_guest"] = allow_guest;
                                            data["end_date"] = end_date;
                                            data["end_time"] = end_time;
                                            data["lottery_id"] = lottery_id;
                                            data["edit_lottery"] = "true";
                                            data["POST"] = "true";
                                            data["scanning_option"] = scanning_option;
                                            data["queing_process"] = queing_process;

                                            if(res.lottery_logo != undefined){
                                                data["lottery_logo"] = res.lottery_logo;
                                            }

                                            if(res.lottery_background_image != undefined){
                                                data["lottery_background_image"] = res.lottery_background_image;
                                            }

                                            var data_json = {};
                                            data_json[0] = data;
                                            data_json[1] = description;
                                            data_json[2] = how_it_works;
                                            data_json[3] = terms_conditions;

                                            edit_lottery_run(data_json, update_btn);
                                        }else if(res.success == false){
                                            $('.lottery-alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                                        }else{
                                            $('.lottery-alert').removeClass('alert-success').addClass('alert-danger').html('Error uploading map image.').fadeIn();
                                        }
                                        hideLoaderBtn(update_btn);
                                    },
                                    error: function(data){
                                        hideLoaderBtn(update_btn);
                                        $('.lottery-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                                    }
                                });
                            }else{
                                var data = {};
                                data["lottery_url"] = lottery_url;
                                data["country_code"] = country_code;
                                data["timezone"] = timezone;
                                data["lottery_title"] = lottery_title;
                                data["number_of_winners"] = number_of_winners;
                                data["start_date"] = start_date;
                                data["start_time"] = start_time;
                                data["event_date"] = event_date;
                                data["event_time"] = event_time;
                                data["allow_guest"] = allow_guest;
                                data["end_date"] = end_date;
                                data["end_time"] = end_time;
                                data["lottery_id"] = lottery_id;
                                data["edit_lottery"] = "true";
                                data["POST"] = "true";
                                data["scanning_option"] = scanning_option;
                                data["queing_process"] = queing_process;

                                if($('#fake_img_lottery_logo').attr('data-value') == ''){
                                    data["lottery_logo"] = "";
                                }

                                if($('#fake_img_lottery_background_image').attr('data-value') == ''){
                                    data["lottery_background_image"] = "";
                                }

                                var data_json = {};
                                data_json[0] = data;
                                data_json[1] = description;
                                data_json[2] = how_it_works;
                                data_json[3] = terms_conditions;

                                edit_lottery_run(data_json, update_btn);
                            }


                        }
                    });
                }else{
                    $('#terms_conditions_wrap').get(0).style.setProperty('border-color', 'red', 'important');
                }
            }else{
                $('#how_it_works_wrap').get(0).style.setProperty('border-color', 'red', 'important');
            }
        }else{
            $('#description_wrap').get(0).style.setProperty('border-color', 'red', 'important');
        }
    }else{
        $('#lottery_url').focus();
    }

});

function edit_lottery_run(data_json, update_btn){
    $.ajax({
        url: 'core/lotteries.php?edit_lottery=true',
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(data_json),
        processData: false,
        contentType: "application/json",
        success: function(res){
            if(res.success == true){
                // $('#edit_lottery_form').get(0).reset();
                $('.lottery-alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                setTimeout(function(){
                    window.location.href = 'edit_lottery.php?id='+data_json[0]['lottery_id']+'&edit_tab=2';
                }, 1200);
            }else if(res.success == false){
                $('.lottery-alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
            }else{
                $('.lottery-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
            }
            hideLoaderBtn(update_btn);
        },
        error: function(){
            hideLoaderBtn(update_btn);
            $('.lottery-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
        }
    });
}

$('#update_agent_detail_form').submit(function(e) {
    e.preventDefault();
    var lottery_status = $('#lottery_status').is(":checked") ? 1 : 0;
    var lottery_agents = $('#lottery_agents').val();
    var old_lottery_agents = $('#old_lottery_agents').val();
    var scan_start_date = $('#scan_start_date').val();
    var scan_start_time = $('#scan_start_time').val();
    var scan_end_date = $('#scan_end_date').val();
    var scan_end_time = $('#scan_end_time').val();
    var lottery_id = $('#lottery_id').val();

    var update_btn = $('#update_agent_detail');

    swal({
        title: "Are you sure?",
        text: "You want to update this lottery?",
        type: "warning",
        showCancelButton: true,
        confirmButtonText: 'Update',
        cancelButtonText: 'Cancel'
    }, function(isConfirmed){
        if (isConfirmed) {
            showLoaderBtn(update_btn);

            var data = {lottery_status, lottery_agents, old_lottery_agents, scan_start_date, scan_start_time, scan_end_date,
                scan_end_time, update_lottery_agents_details: true,edit_lottery_agents: 'true',lottery_id};

            $.ajax({
                type:'POST',
                url: update_lottery_agents_details,
                data: data,
                success:function(res){
                    if(res.success == true){
                        $('.lottery-alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                        setTimeout(function(){
                            // window.location.href = 'edit_lottery.php?id='+lottery_id+'&edit_tab=4';
                            window.location.href = edit_tab_4;
                        }, 1200);
                    }else if(res.success == false){
                        $('.lottery-alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                    }else{
                        $('.lottery-alert').removeClass('alert-success').addClass('alert-danger').html('Error uploading map image.').fadeIn();
                    }
                    hideLoaderBtn(update_btn);
                },
                error: function(data){
                    hideLoaderBtn(update_btn);
                    $('.lottery-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                }
            });

        }
    });
});

$('#form_customization_form').submit(function(e){
    e.preventDefault();

    var data = new FormData();
    data.append("cus_lottery_id", $('#cus_lottery_id').val());
    data.append("customization_values", $('#customization_values').val());

    data.append("update_customization_form", "true");
    data.append("POST", "true");
    showLoaderBtn($('#form_cus_submit_btn'));

    $('.alert-customize').fadeOut();

    $.ajax({
        url: customization_form,
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(res){
            if(res.success == true){
                $('.alert-customize').html(res.msg).addClass('alert-success').removeClass('alert-danger').fadeIn();
                setTimeout(function(){
                    //window.location.href = 'edit_lottery.php?id='+$('#cus_lottery_id').val()+'&edit_tab=3';
                    window.location.href = edit_tab_3;
                }, 1200);
            }else if(res.success == false){
                $('.alert-customize').html(res.msg).addClass('alert-danger').removeClass('alert-success').fadeIn();
            }else{
                $('.alert-customize').html('Something went wrong, please try again later.').addClass('alert-danger').removeClass('alert-success').fadeIn();
            }
            hideLoaderBtn($('#form_cus_submit_btn'));
        },
        error: function(){
            $('.alert-customize').html('Something went wrong, please try again later.').addClass('alert-danger').removeClass('alert-success').fadeIn();
            hideLoaderBtn($('#form_cus_submit_btn'));
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
