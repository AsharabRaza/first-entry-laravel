$('#map_image').change(function(){
    if($(this).val() == ''){
        $('#fake_img').val($('#fake_img').attr('data-value'));
        if($('#fake_img').val() != ''){
            $('#preview_map_image, .map_image_value').attr('src', '../assets/images/media/' + $('#fake_img').val());
            $('#preview_map_image_wrap').removeClass('d-none');
        }else{
            $('#preview_map_image_wrap').addClass('d-none');
        }
    }else{
        $('#preview_map_image')[0].src = (window.URL ? URL : webkitURL).createObjectURL($(this).get(0).files[0]);
        $('.map_image_value').attr('src',(window.URL ? URL : webkitURL).createObjectURL($(this).get(0).files[0]));
        $('#fake_img').val('');
        $('#preview_map_image_wrap').removeClass('d-none');
        $('#map_image').css({borderColor: ''});
    }

});

$('#remove_img').click(function(){
    $('#fake_img').val('');
    $('#fake_img').attr('data-value', '');
    $('#map_image').val('');
    $('#preview_map_image_wrap').addClass('d-none');
    $('#preview_map_image, .map_image_value').attr('src', '');
});

$('#modify_winners_email_form').submit(function(e){
    e.preventDefault();

    var instructions = $('#winners_emails_instructions').get(0).firstChild.innerHTML;
    var reminders = $('#winners_emails_reminders').get(0).firstChild.innerHTML;

    //var instructions = $('#instructions').val();
    //var reminders = $('#reminders').val();
    var map_image = $('#map_image').val();
    var venue_link = $('#winners_emails_venue_link').val();
    var winners_emails_lottery_id = $('#winners_emails_lottery_id').val();

    var update_btn = $('#winners_emails_update_btn');

    $('.winners-emails-alert').fadeOut();

    console.log(instructions);

    if(instructions != '<p><br></p>'){
        $('#winners_emails_instructions').parent().find('.ql-snow').css({borderColor: ''});
        if(reminders != '<p><br></p>'){
            $('#winners_emails_reminders').parent().find('.ql-snow').css({borderColor: ''});
            if($('#fake_img').val() == ''){
                if($('#map_image').val() != ''){
                    $('#map_image').css({borderColor: ''});
                    swal({
                        title: "Are you sure?",
                        text: "You want to update selected entries email template?",
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonText: 'Update',
                        cancelButtonText: 'Cancel'
                    }, function(isConfirmed){
                        if (isConfirmed) {
                            showLoaderBtn(update_btn);
                            var data = new FormData();
                            data.append('map_image', $('#map_image').get(0).files[0]);
                            data.append('map_image_upload', 'true');
                            data.append('POST', 'true');

                            $.ajax({
                                type:'POST',
                                url: modify_emails,
                                data: data,
                                cache: false,
                                enctype: 'multipart/form-data',
                                contentType: false,
                                processData: false,
                                success:function(res){
                                    if(res.success == true){
                                        update_winners_email(instructions, reminders, res.msg, venue_link, winners_emails_lottery_id, update_btn);
                                    }else if(res.success == false){
                                        $('.winners-emails-alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                                    }else{
                                        $('.winners-emails-alert').removeClass('alert-success').addClass('alert-danger').html('Error uploading map image.').fadeIn();
                                    }
                                    hideLoaderBtn(update_btn);
                                },
                                error: function(data){
                                    hideLoaderBtn(update_btn);
                                    $('.winners-emails-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                                }
                            });
                        }
                    });
                }else{
                    $('#map_image').get(0).style.setProperty('border-color', 'red', 'important');
                }
            }else{
                swal({
                    title: "Are you sure?",
                    text: "You want to update selected entries email template?",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonText: 'Update',
                    cancelButtonText: 'Cancel'
                }, function(isConfirmed){
                    if (isConfirmed) {
                        showLoaderBtn(update_btn);
                        update_winners_email(instructions, reminders, $('#fake_img').val(), venue_link, winners_emails_lottery_id, update_btn);
                    }
                });
            }
        }else{
            $('#winners_emails_reminders').parent().find('.ql-snow').get(0).style.setProperty('border-color', 'red', 'important');
            $('#winners_emails_reminders').parent().find('.ql-snow').get(1).style.setProperty('border-color', 'red', 'important');
        }
    }else{
        $('#winners_emails_instructions').parent().find('.ql-snow').get(0).style.setProperty('border-color', 'red', 'important');
        $('#winners_emails_instructions').parent().find('.ql-snow').get(1).style.setProperty('border-color', 'red', 'important');
    }
});

function update_winners_email(instructions, reminders, map_image, venue_link, winners_emails_lottery_id, update_btn){
    var data = {};
    data["map_image"] = map_image;
    data["venue_link"] = venue_link;
    data["lottery_id"] = winners_emails_lottery_id;

    data["update_winners_emails"] = "true";
    data["POST"] = "true";

    var data_json = {};
    data_json[0] = data;
    data_json[1] = instructions;
    data_json[2] = reminders;

    $.ajax({
        // url: 'core/modify_emails.php?update_winners_emails=true',
        url: update_winners_emails,
        type: 'POST',
        dataType: 'json',
        data: JSON.stringify(data_json),
        processData: false,
        contentType: "application/json",
        success: function(res){
            if(res.success == true){
                //$('#modify_winners_email_form').get(0).reset();
                $('.winners-emails-alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                localStorage.setItem('form_email_entry_tab', 'not-selected');
                setTimeout(function(){
                    // window.location.href = 'edit_lottery.php?id='+winners_emails_lottery_id+'&edit_tab=3';
                    window.location.href = winners_emails_edit_tab_3;
                }, 1000);
            }else if(res.success == false){
                $('.winners-emails-alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
            }else{
                $('.winners-emails-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
            }
            hideLoaderBtn(update_btn);
        },
        error: function(){
            hideLoaderBtn(update_btn);
            $('.winners-emails-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
        }
    });
}


$('#modify_losers_email_form').submit(function(e){
    e.preventDefault();

    var instructions = $('#losers_emails_instructions').get(0).firstChild.innerHTML;

    //var instructions = $('#instructions').val();
    var venue_link = $('#losers_emails_venue_link').val();
    var losers_emails_lottery_id = $('#losers_emails_lottery_id').val();

    var update_btn = $('#losers_emails_update_btn');

    $('.losers-emails-alert').fadeOut();

    if(instructions != '<p><br></p>'){
        $('#winners_emails_instructions').parent().find('.ql-snow').css({borderColor: ''});
        swal({
            title: "Are you sure?",
            text: "You want to update non-selected entries email template?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Update',
            cancelButtonText: 'Cancel'
        }, function(isConfirmed){
            if (isConfirmed) {
                showLoaderBtn(update_btn);
                var data = {};
                data["venue_link"] = venue_link;
                data["lottery_id"] = losers_emails_lottery_id;

                data["update_losers_emails"] = "true";
                data["POST"] = "true";

                var data_json = {};
                data_json[0] = data;
                data_json[1] = instructions;

                $.ajax({
                    // url: 'core/modify_emails.php?update_losers_emails=true',
                    url: update_losers_emails,
                    type: 'POST',
                    dataType: 'json',
                    data: JSON.stringify(data_json),
                    processData: false,
                    contentType: "application/json",
                    success: function(res){
                        if(res.success == true){
                            //$('#modify_winners_email_form').get(0).reset();
                            $('.losers-emails-alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                            setTimeout(function(){
                                // window.location.href = window.location.href = 'edit_lottery.php?id='+losers_emails_lottery_id+'&edit_tab=3';
                                window.location.href = winner_edit_tab_3;
                            }, 1000);
                        }else if(res.success == false){
                            $('.losers-emails-alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                        }else{
                            $('.losers-emails-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                        }
                        hideLoaderBtn(update_btn);
                    },
                    error: function(){
                        hideLoaderBtn(update_btn);
                        $('.losers-emails-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                    }
                });
            }
        });
    }else{
        $('#losers_emails_instructions').parent().find('.ql-snow').get(0).style.setProperty('border-color', 'red', 'important');
        $('#losers_emails_instructions').parent().find('.ql-snow').get(1).style.setProperty('border-color', 'red', 'important');
    }

});


$('#send_winners_emails').click(function(){
    var receivers_emails = $('.receivers_emails:checked');
    console.log(receivers_emails);
    if(receivers_emails.length == 0){
        $('.alert-sendings-emails-res').removeClass('alert-success').addClass('alert-danger').html('No emails selected.').fadeIn();
    }else{
        swal({
            title: "Are you sure?",
            text: "You want to send emails to selected entries?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Send',
            cancelButtonText: 'Cancel'
        }, function(isConfirmed){
            if (isConfirmed) {
                var send_email_btn = $('#send_winners_emails');
                var send_test_email_btn = $('#send_test_email_btn');
                var preview_btn = $('#preview_btn');
                var cancel_btn = $('#cancel_btn');

                $(preview_btn).prop('disabled', true);
                $(send_test_email_btn).prop('disabled', true);
                $(cancel_btn).prop('disabled', true);

                showLoaderBtn(send_email_btn);

                window.onbeforeunload = confirmExit;
                function confirmExit() {
                    return "You have attempted to leave this page. Are you sure?";
                }

                send_winners_emails();

            }
        });
    }
});

function send_winners_emails(){
    var checked_values = [];
    var checkboxes = $('input[name="receivers_emails[]"]:checked');
    for (let index = 0; index < checkboxes.length; index++) {
        $('.right_content_' + $(checkboxes[index]).val()).children('span').hide();
        $('.right_content_' + $(checkboxes[index]).val()).children('.spinner-border').show();
        checked_values.push($(checkboxes[index]).val());
    }
    var update_btn = $('#send_winners_emails');

    var data = new FormData();
    data.append("selected_emails", checked_values);
    data.append("lottery_id", $('#lottery_id').val());

    data.append("send_winners_emails_1", "true");
    data.append("POST", "true");

    $.ajax({
        url: send_email_to_winners,
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(res){
            window.onbeforeunload = null
            if(res.success == true){
                var val = res.emails;
                var keys = Object.keys(res.emails);

                for (let index = 0; index < keys.length; index++) {
                    if(val[keys[index]] == 0){
                        $('.right_content_' + keys[index]).children('.spinner-border').hide();;
                        $('.right_content_' + keys[index]).children('span').html('Sent').addClass('bg-success').removeClass('bg-info').show();
                    }else{
                        $('.right_content_' + keys[index]).children('.spinner-border').hide();;
                        $('.right_content_' + keys[index]).children('span').html('Failed').addClass('bg-danger').removeClass('bg-info').show();
                    }
                }
                $('.alert-sendings-emails-res').html(res.msg).addClass('alert-success').removeClass('alert-danger').fadeIn();
                hideLoaderBtn(update_btn);
                setTimeout(function(){
                    $(update_btn).prop('disabled', true);
                }, 210);
            }else if(res.success == false){
                $('.right_content').children('.spinner-border').hide();
                $('.right_content').children('span').html('Failed').addClass('bg-danger').removeClass('bg-info').show();
                $('.alert-sendings-emails-res').html(res.msg).addClass('alert-danger').removeClass('alert-success').fadeIn();
                hideLoaderBtn(update_btn);
            }else{
                $('.right_content').children('.spinner-border').hide();;
                $('.right_content').children('span').html('Failed').addClass('bg-danger').removeClass('bg-info').show();
                $('.alert-sendings-emails-res').html('Something went wrong, please try again later.').addClass('alert-danger').removeClass('alert-success').fadeIn();
                hideLoaderBtn(update_btn);
            }
        },
        error: function(){
            window.onbeforeunload = null
            $('.right_content').children('.spinner-border').hide();;
            $('.right_content').children('span').html('Failed').addClass('bg-danger').removeClass('bg-info').show();
            $('.alert-sendings-emails-res').html('Something went wrong, please try again later.').addClass('alert-danger').removeClass('alert-success').fadeIn();
            hideLoaderBtn(update_btn);
        }
    });
}


$('#send_losers_email').click(function(){
    var receivers_emails = $('.receivers_emails:checked');
    console.log(receivers_emails);
    if(receivers_emails.length == 0){
        $('.alert-sendings-emails-res').removeClass('alert-success').addClass('alert-danger').html('No emails selected.').fadeIn();
    }else{
        swal({
            title: "Are you sure?",
            text: "You want to send emails to non-selected entries?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Send',
            cancelButtonText: 'Cancel'
        }, function(isConfirmed){
            if (isConfirmed) {
                var send_email_btn = $('#send_losers_email');
                var send_test_email_btn = $('#send_test_email_btn');
                var preview_btn = $('#preview_btn');
                var cancel_btn = $('#cancel_btn');

                $(preview_btn).prop('disabled', true);
                $(send_test_email_btn).prop('disabled', true);
                $(cancel_btn).prop('disabled', true);

                showLoaderBtn(send_email_btn);

                window.onbeforeunload = confirmExit;
                function confirmExit() {
                    return "You have attempted to leave this page. Are you sure?";
                }

                send_losers_email(0, 0);

            }
        });
    }
});


function send_losers_email(start_batch, current_batch){
    var checked_values = [];
    var checkboxes = $('input[name="receivers_emails[]"]:checked');
    for (let index = 0; index < checkboxes.length; index++) {
        checked_values.push($(checkboxes[index]).val());
    }
    var update_btn = $('#send_losers_email');

    var total_batch = Math.ceil(checked_values.length / 500);

    console.log('total_batch', total_batch);
    console.log('current_batch', current_batch);
    //console.log(checked_values);

    var checked_values_data = [];

    for(var i = start_batch; i < start_batch + 500; i++){
        if(checked_values.length > i){
            checked_values_data.push(checked_values[i]);
            $('.right_content_' + $(checked_values[i]).val()).children('span').hide();
            $('.right_content_' + $(checked_values[i]).val()).children('.spinner-border').show();
        }
    }

    if(checked_values_data.length > 0){
        var data = new FormData();
        data.append("selected_emails", checked_values_data);
        data.append("lottery_id", $('#lottery_id').val());

        data.append("send_losers_emails_1", "true");
        data.append("POST", "true");

        $.ajax({
            url: send_email_to_losers,
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function(res){
                window.onbeforeunload = null
                if(res.success == true){
                    var val = res.emails;
                    var keys = Object.keys(res.emails);

                    for (let index = 0; index < keys.length; index++) {
                        if(val[keys[index]] == 0){
                            $('.right_content_19495').find('.spinner-border').hide();
                            $('.right_content_' + keys[index]).find('span').html('Sent').addClass('bg-success').removeClass('bg-info').show();
                        }else{
                            $('.right_content_' + keys[index]).find('.spinner-border').hide();
                            $('.right_content_' + keys[index]).find('span').html('Failed').addClass('bg-danger').removeClass('bg-info').show();
                        }
                    }

                    if(current_batch < total_batch){
                        send_losers_email(start_batch + 500, current_batch + 1);
                    }else{
                        $('.alert-sendings-emails-res').html(res.msg).addClass('alert-success').removeClass('alert-danger').fadeIn();
                        hideLoaderBtn(update_btn);
                        setTimeout(function(){
                            $(update_btn).prop('disabled', true);
                        }, 210);
                    }

                }else if(res.success == false){
                    $('.right_content').children('.spinner-border').hide();;
                    $('.right_content').children('span').html('Failed').addClass('bg-danger').removeClass('bg-info').show();
                    $('.alert-sendings-emails-res').html(res.msg).addClass('alert-danger').removeClass('alert-success').fadeIn();
                    hideLoaderBtn(update_btn);
                }else{
                    $('.right_content').children('.spinner-border').hide();;
                    $('.right_content').children('span').html('Failed').addClass('bg-danger').removeClass('bg-info').show();
                    $('.alert-sendings-emails-res').html('Something went wrong, please try again later.').addClass('alert-danger').removeClass('alert-success').fadeIn();
                    hideLoaderBtn(update_btn);
                }
            },
            error: function(){
                window.onbeforeunload = null
                $('.right_content').children('.spinner-border').hide();;
                $('.right_content').children('span').html('Failed').addClass('bg-danger').removeClass('bg-info').show();
                $('.alert-sendings-emails-res').html('Something went wrong, please try again later.').addClass('alert-danger').removeClass('alert-success').fadeIn();
                hideLoaderBtn(update_btn);
            }
        });
    }
}



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

function receivers_emails_checkbox(checkbox){
    console.log('SN');
    if($(checkbox).prop('checked') == true){
        $(checkbox).parent().find('.right_content').children('span').addClass('bg-info').removeClass('bg-danger').html('Selected');
    }else{
        $(checkbox).parent().find('.right_content').children('span').removeClass('bg-info').addClass('bg-danger').html('Not selected');
    }
};

$('.see_analytics').click(function(){
    $('#modalEmailAnalyticsData').hide();
    $('#loader_wrap').show();
    var data = new FormData();
    data.append("message_id", $(this).attr('data-id'));

    data.append("see_analytics", "true");
    data.append("POST", "true");

    $.ajax({
        url: 'core/modify_emails.php',
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(res){
            $('#modalEmailAnalyticsData').html(res).fadeIn();
            $('#loader_wrap').hide();
        },
        error: function(){
            $('#modalEmailAnalyticsData').html('Something went wrong, please try again later.').fadeIn();
            $('#loader_wrap').hide();
        }
    });
});

$('.resend_email').click(function(){
    if($(this).hasClass('resend_email_animate') == false){
        var message_id = $(this).attr('data-id');
        var dataLid = $(this).attr('data-lid');
        var dataType = $(this).attr('data-type');
        var resend_email = $(this);
        swal({
            title: "Are you sure?",
            text: "You want to resend this email?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Resend',
            cancelButtonText: 'Cancel'
        }, function(isConfirmed){
            if (isConfirmed) {
                if(dataType == 'Winners'){
                    resend_email.addClass('resend_email_animate');
                    window.onbeforeunload = confirmExit;
                    function confirmExit() {
                        return "You have attempted to leave this page. Are you sure?";
                    }
                    var data = new FormData();
                    data.append("selected_emails", message_id);
                    data.append("lottery_id", dataLid);

                    data.append("send_winners_emails_1", "true");
                    data.append("POST", "true");

                    $.ajax({
                        url: 'core/modify_emails.php',
                        type: 'POST',
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function(res){
                            window.onbeforeunload = null;
                            resend_email.removeClass('resend_email_animate');
                            $('.alert-emails').removeClass('alert-danger').addClass('alert-success').html('Successfully resend email. Reloading...').fadeIn();
                            setTimeout(function(){
                                window.location.reload();
                            }, 1200);
                        },
                        error: function(){
                            window.onbeforeunload = null;
                            resend_email.removeClass('resend_email_animate');
                            $('.alert-emails').removeClass('alert-success').addClass('alert-failed').html('Failed to resend email.').fadeIn();
                        }
                    });
                }else if(dataType == 'Losers'){
                    resend_email.addClass('resend_email_animate');
                    window.onbeforeunload = confirmExit;
                    function confirmExit() {
                        return "You have attempted to leave this page. Are you sure?";
                    }
                    var data = new FormData();
                    data.append("selected_emails", message_id);
                    data.append("lottery_id", dataLid);

                    data.append("send_losers_emails_1", "true");
                    data.append("POST", "true");

                    $.ajax({
                        url: 'core/modify_emails.php',
                        type: 'POST',
                        data: data,
                        processData: false,
                        contentType: false,
                        success: function(res){
                            window.onbeforeunload = null;
                            resend_email.removeClass('resend_email_animate');
                            $('.alert-emails').removeClass('alert-danger').addClass('alert-success').html('Successfully resend email. Reloading...').fadeIn();
                            setTimeout(function(){
                                window.location.reload();
                            }, 1200);
                        },
                        error: function(){
                            window.onbeforeunload = null;
                            resend_email.removeClass('resend_email_animate');
                            $('.alert-emails').removeClass('alert-success').addClass('alert-failed').html('Failed to resend email.').fadeIn();
                        }
                    });
                }

            }
        });
    }
});
