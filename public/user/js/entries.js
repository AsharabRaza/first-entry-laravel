var old_request1;
$('.remove_winners').click(function(e){
    e.preventDefault();
    var b = $(this);

    if(old_request1 == null || old_request1 == undefined){
        swal({
            title: "Are you sure?",
            text: "You want to delete this winner?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Remove',
            cancelButtonText: 'Cancel'
        }, function(isConfirmed){
            if (isConfirmed) {
                b.children('i').hide();
                b.children('div').show();

                var data = new FormData();
                data.append("lottery_id", b.attr('data-lid'));
                data.append("entry_id", b.attr('data-eid'));
                data.append("guest_id", b.attr('data-gid'));
                data.append("guest_id2", b.attr('data-gid2'));
                data.append("request_id", b.attr('data-id'));

                data.append("remove_winners", "true");
                data.append("POST", "true");

                old_request1 = $.ajax({
                    url: remove_winners,
                    type: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(res){
                        if(res.success == true){
                            $('.alert-entries').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                            setTimeout(function(){
                                window.location.reload();
                            }, 1200);
                        }else if(res.success == false){
                            $('.alert-entries').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                            b.children('i').show();
                            b.children('div').hide();
                        }else{
                            $('.alert-entries').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                            b.children('i').show();
                            b.children('div').hide();
                        }
                    },
                    error: function(){
                        $('.alert-entries').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                        b.children('i').show();
                        b.children('div').hide();
                    }
                });
            }
        });
    }
});

var old_request2;
$('.remove_entries').click(function(e){
    e.preventDefault();
    var b = $(this);

    if(old_request2 == null || old_request2 == undefined){
        swal({
            title: "Are you sure?",
            text: "You want to delete this entry?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Remove',
            cancelButtonText: 'Cancel'
        }, function(isConfirmed){
            if (isConfirmed) {
                b.children('i').hide();
                b.children('div').show();

                var data = new FormData();
                data.append("lottery_id", b.attr('data-lid'));
                data.append("entry_id", b.attr('data-eid'));
                data.append("guest_id", b.attr('data-gid'));
                data.append("guest_id2", b.attr('data-gid2'));
                data.append("request_id", b.attr('data-id'));

                data.append("remove_entries", "true");
                data.append("POST", "true");

                old_request2 = $.ajax({
                    url: remove_entries,
                    type: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(res){
                        if(res.success == true){
                            $('.alert-entries').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                            setTimeout(function(){
                                window.location.reload();
                            }, 1200);
                        }else if(res.success == false){
                            $('.alert-entries').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                            b.children('i').show();
                            b.children('div').hide();
                        }else{
                            $('.alert-entries').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                            b.children('i').show();
                            b.children('div').hide();
                        }
                    },
                    error: function(){
                        $('.alert-entries').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                        b.children('i').show();
                        b.children('div').hide();
                    }
                });
            }
        });
    }
});

var old_request3;
$('.delete_lotteries').click(function(e){
    e.preventDefault();
    var b = $(this);

    if(old_request3 == null || old_request3 == undefined){
        swal({
            title: "Are you sure?",
            text: "You want to delete this lottery?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Remove',
            cancelButtonText: 'Cancel'
        }, function(isConfirmed){
            if (isConfirmed) {
                b.children('i').hide();
                b.children('div').show();

                var data = new FormData();
                data.append("request_id", b.attr('data-id'));

                data.append("delete_lotteries", "true");
                data.append("POST", "true");

                old_request3 = $.ajax({
                    url: delete_lottery,
                    type: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(res){
                        if(res.success == true){
                            $('.alert-entries').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                            setTimeout(function(){
                                window.location.reload();
                            }, 1200);
                        }else if(res.success == false){
                            $('.alert-entries').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                            b.children('i').show();
                            b.children('div').hide();
                        }else{
                            $('.alert-entries').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                            b.children('i').show();
                            b.children('div').hide();
                        }
                    },
                    error: function(){
                        $('.alert-entries').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                        b.children('i').show();
                        b.children('div').hide();
                    }
                });
            }
        });
    }
});

$('#search_with_uid').click(function(){
    var dataType = $(this).attr('data-type');
    var uid = $('#uid').val();

    if(uid != ''){
        $('#uid').removeClass('is-invalid');

        $('.entry-alert').hide();
        $('.result_wrap').hide();
        $('.result_placeholder').show();
        $('.no_result').hide();
        $('.loading_placeholder').fadeIn();

        var data = new FormData();
        data.append("uid", 'FE-' + uid);

        data.append("get_uid_entries", "true");
        data.append("POST", "true");

        $.ajax({
            url: get_uid_entries,
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function(res){
                if(res.success == true){
                    if(user_type == 2){
                        $('#guest').parent().parent().hide();
                        $('#start_datetime').parent().parent().hide();
                        $('#end_datetime').parent().parent().hide();
                        $('#email').parent().parent().hide();
                        $('#phone').parent().parent().hide();
                        $('#entered_datetime').parent().parent().hide();
                        $('#event_datetime').parent().parent().css({border: 'none'});
                    }

                    $('.entry-alert').hide();
                    $('.result_placeholder').hide();
                    $('.loading_placeholder').hide();
                    $('.result_wrap').fadeIn();

                    $('#title').html(res.title);
                    $('#event_datetime').html(res.event_datetime);
                    $('#guest').html(res.guest);
                    $('#start_datetime').html(res.start_datetime);
                    $('#end_datetime').html(res.end_datetime);

                    $('#status').html(res.is_winner);
                    $('#result_uid').html(res.result_uid);
                    $('#first_name').html(res.first_name);
                    $('#last_name').html(res.last_name);
                    $('#email').html(res.email);
                    $('#phone').html(res.phone);
                    $('#bring_guest').html(res.bring_guest);
                    $('#entered_datetime').html(res.date_created);

                    if(res.g_first_name == undefined){
                        $('#g_first_name').parent().parent().hide();
                        if(user_type == 2){
                            $('#bring_guest').parent().parent().css({border: 'none'});
                        }
                    }else{
                        $('#g_first_name').parent().parent().show();
                        $('#g_first_name').html(res.g_first_name);

                    }

                    if(res.g_last_name == undefined){
                        $('#g_last_name').parent().parent().hide();
                    }else{
                        $('#g_last_name').parent().parent().show();
                        $('#g_last_name').html(res.g_last_name);
                    }
                    if(res.winners_no == undefined){
                        $('#winner_no').parent().parent().hide();
                        $('#entry_confirm_btn').hide().attr('data-id', '');
                        $('#submit_confirm_entry').attr('data-id', '');
                        $('#submit_confirm_entry').attr('data-type', '');
                        $('#entry_confirm_btn').prev().css({border: 'none'});
                    }else{
                        if(res.queing_option == 1) {
                            $('#winner_no').parent().parent().show();
                            $('#winner_no').html(res.winners_no);
                        } else {
                            $('#winner_no').parent().parent().hide();
                        }

                        $('#entry_confirm_btn').show().attr('data-id', res.entry_id);
                        $('#submit_confirm_entry').attr('data-id', res.entry_id);
                        $('#submit_confirm_entry').attr('data-type', dataType);
                        $('#entry_confirm_btn').prev().css({border: ''});
                    }
                    if(res.g_winner_no == undefined){
                        $('#g_winner_no').parent().parent().hide();
                    }else{
                        if(res.queing_option == 1) {
                            $('#g_winner_no').parent().parent().show();
                            $('#g_winner_no').html(res.g_winner_no);
                        } else {
                            $('#g_winner_no').parent().parent().hide();
                        }
                        if(user_type == 2){
                            $('#g_winner_no').parent().parent().css({border: ''});
                        }
                    }
                    if(res.entry_confirmed == undefined){
                        $('.entry-alert').hide();
                    }else{
                        $('.entry-alert').html('This entry is already confirmed at <strong>' + res.entry_confirmed_datetime + '</strong>').addClass('alert-success').removeClass('alert-danger').fadeIn();
                        $('#entry_confirm_btn').hide().attr('data-id', '');
                        $('#submit_confirm_entry').attr('data-id', '');
                        $('#submit_confirm_entry').attr('data-type', '');
                        $('#entry_confirm_btn').prev().css({border: 'none'});
                    }


                }else if(res.success == false){
                    $('.entry-alert').hide();
                    $('.result_wrap').hide();
                    $('.result_placeholder').show();
                    $('.no_result').fadeIn();
                    $('.no_result').children('p').html(res.msg);
                    $('.loading_placeholder').hide();
                }else{
                    $('.entry-alert').hide();
                    $('.result_wrap').hide();
                    $('.result_placeholder').show();
                    $('.no_result').fadeIn();
                    $('.no_result').children('p').html('Something went wrong, please try again later.');
                    $('.loading_placeholder').hide();
                }
            },
            error: function(){
                $('.entry-alert').hide();
                $('.result_wrap').hide();
                $('.result_placeholder').show();
                $('.no_result').fadeIn();
                $('.no_result').children('p').html('Something went wrong, please try again later.');
                $('.loading_placeholder').hide();
            }
        });
    }else{
        $('#uid').addClass('is-invalid');
        $('.no_result').fadeIn();
        $('.loading_placeholder').hide();
    }
});

$("#uid").keyup(function(event) {
    if (event.which === 13) {
        $("#search_with_uid").click();
    }
});

$('#submit_confirm_entry').click(function(){
    var dataId = $(this).attr('data-id');
    var dataType = $(this).attr('data-type');

    if(dataId != ''){
        showLoaderBtn($('#submit_confirm_entry'));

        var data = new FormData();
        data.append("entry_id", dataId);
        data.append("submit_type", dataType);

        data.append("entry_confirmed", "true");
        data.append("POST", "true");

        $.ajax({
            url: entry_confirmation,
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function(res){
                if(res.success == true){
                    $('.entry-alert').html(res.msg).addClass('alert-success').removeClass('alert-danger').fadeIn();
                    $('#submit_confirm_entry').children('span').eq(0).html('Confirmed');
                    $('#submit_confirm_entry').css('pointer-events', 'none');
                    setTimeout(function(){
                        location.reload();
                    }, 3000);
                }else if(res.success == false){
                    $('.entry-alert').html(res.msg).addClass('alert-danger').removeClass('alert-success').fadeIn();
                }else{
                    $('.entry-alert').html('Something went wrong, please try again later.').addClass('alert-danger').removeClass('alert-success').fadeIn();
                }
                hideLoaderBtn($('#submit_confirm_entry'));

                $('html, body').animate({
                    scrollTop: $(".entry-alert").position().top
                }, 300);
            },
            error: function(){
                $('.entry-alert').html('Something went wrong, please try again later.').addClass('alert-danger').removeClass('alert-success').fadeIn();
                hideLoaderBtn($('#submit_confirm_entry'));
                $('html, body').animate({
                    scrollTop: $(".entry-alert").position().top
                }, 300);
            }
        });
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
