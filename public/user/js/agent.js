
$('#add_agent_form').submit(function(e){
    e.preventDefault();
    $('.add_agent_alert').fadeOut();

    var first_name = $('#agent_name').val();
    var last_name = $('#agent_last_name').val();
    var email = $('#agent_email').val();
    var pass = $('#agent_password').val();
    var agent_permissions_actions = $('#agent_permissions_actions').val();
    var add_btn = $('#add_btn');

        $('.add_agent_alert').fadeOut();
        showLoaderBtn(add_btn);

        var data = new FormData();
        data.append("first_name", first_name);
        data.append("last_name", last_name);
        data.append("email", email);
        data.append("pass", pass);
        data.append("agent_permissions_actions", agent_permissions_actions);
        data.append("add_agent_btn", "true");
        data.append("POST", "true");
        request = $.ajax({
            url: add_agent,
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function(res){
                console.log(res);
                if(res.success == true){
                    $('#add_agent_form').get(0).reset();
                    $('.add_agent_alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                    setTimeout(function(){
                        window.location.reload();
                    }, 1200);
                }else if(res.success == false){
                    $('.add_agent_alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                }else{
                    $('.add_agent_alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                }
                hideLoaderBtn(add_btn);
            },
            error: function(){
                hideLoaderBtn(add_btn);
                $('.add_agent_alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
            }
        });
});
$('#edit_agent_form').submit(function(e){
    e.preventDefault();
    $('.edit_agent_alert').fadeOut();

    var first_name = $('#agent_name').val();
    var last_name = $('#agent_last_name').val();
    var email = $('#agent_email').val();
    var pass = $('#agent_password').val();
    var agent_id = $('#agent_id').val();
    var agent_permissions_actions = $('#agent_permissions_actions').val();
    var add_btn = $('#add_btn');

        $('.edit_agent_alert').fadeOut();
        showLoaderBtn(add_btn);

        var data = new FormData();
        data.append("first_name", first_name);
        data.append("last_name", last_name);
        data.append("email", email);
        data.append("pass", pass);
        data.append("agent_id", agent_id);
        data.append("agent_permissions_actions", agent_permissions_actions);
        data.append("edit_agent_btn", "true");
        data.append("POST", "true");
        request = $.ajax({
            url: edit_agent,
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function (res) {
                console.log(res)
                if(res.success == true){
                    // $('#edit_agent_form').get(0).reset();
                    $('.edit_agent_alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                    setTimeout(function(){
                        window.location.reload();
                    }, 1200);
                }else if(res.success == false){
                    $('.edit_agent_alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                }else{
                    $('.edit_agent_alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                }
                hideLoaderBtn(add_btn);
            },
            error: function () {
                hideLoaderBtn(add_btn);
                $('.edit_agent_alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
            }
        });
});
function hideLoaderBtn(add_btn){
    var add_btn_height = add_btn.height() / 2;

    add_btn.children('span').eq(0).css({
        display: 'block',
        webkitTransform: 'translateY(0px)',
        transform: 'translateY(0px)',
        opacity: 1
    });

    add_btn.children('span').eq(1).css({
        top: 'calc(50% + ' + add_btn_height +'px)',
        opacity: 0
    });

    setTimeout(function(){
        add_btn.children('span').eq(1).children().eq(0).hide();
        add_btn.prop('disabled', false);
    }, 200);
}

function showLoaderBtn(add_btn){
    add_btn.prop('disabled', true);
    var add_btn_height = add_btn.height() / 2;

    add_btn.children('span').eq(1).css({
        position: 'absolute',
        top: 'calc(50% + ' + add_btn_height +'px)',
        left: '50%',
        transform: 'translate(-50%, -50%)',
        opacity: 0
    });

    setTimeout(function(){
        add_btn.children('span').eq(1).children().eq(0).show();
        add_btn.children('span').eq(0).css({
            display: 'block',
            webkitTransform: 'translateY(-'+add_btn_height+'px)',
            transform: 'translateY(-'+add_btn_height+'px)',
            opacity: 0
        });
        add_btn.children('span').eq(1).css({
            top: '50%',
            opacity: 1
        });
    }, 10);
}

var old_request3;
$('.delete_agents').click(function(e){
    e.preventDefault();
    var b = $(this);

    if(old_request3 == null || old_request3 == undefined){
        swal({
            title: "Are you sure?",
            text: "You want to delete this agent?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Remove',
            cancelButtonText: 'Cancel'
        }, function(isConfirmed){
            if (isConfirmed) {
                console.log("confrom");
                b.children('i').hide();
                b.children('div').show();

                var data = new FormData();
                data.append("request_id", b.attr('data-id'));

                data.append("delete_agents", "true");
                data.append("POST", "true");

                old_request3 = $.ajax({
                    url: delete_agent,
                    type: 'POST',
                    data: data,
                    processData: false,
                    contentType: false,
                    success: function(res){
                        if(res.success == true){
                            $('.alert-users').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                            setTimeout(function(){
                                window.location.reload();
                            }, 1200);
                        }else if(res.success == false){
                            $('.alert-users').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                            b.children('i').show();
                            b.children('div').hide();
                        }else{
                            $('.alert-users').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                            b.children('i').show();
                            b.children('div').hide();
                        }
                    },
                    error: function(){
                        $('.alert-users').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                        b.children('i').show();
                        b.children('div').hide();
                    }
                });
            }
        });
    }
});
