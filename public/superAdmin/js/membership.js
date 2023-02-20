$('#add_membership_form').submit(function(e){
    e.preventDefault();
    $('.add_membership_alert').fadeOut();

    var user_id = $('#user_id').val();
    var membership_id = $('#membership_id').val();
    var expire_date = $('#expire_date').val();
    var expire_time = $('#expire_time').val();
    
    var add_btn = $('#add_btn');

    $('.add_membership_alert').fadeOut();
    showLoaderBtn(add_btn);

    var data = new FormData();
    data.append("user_id", user_id);
    data.append("membership_id", membership_id);
    data.append("expire_date", expire_date);
    data.append("expire_time", expire_time);
    data.append("add_membership_btn", "true");
    data.append("POST", "true");

    request = $.ajax({
        url: 'core/membership.php',
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(res){
            console.log(res);
            if(res.success == true){
                $('#add_membership_form').get(0).reset();
                $('.add_membership_alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                setTimeout(function(){
                    window.location.reload();
                }, 1200);
            }else if(res.success == false){
                $('.add_membership_alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
            }else{
                $('.add_membership_alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
            }
            hideLoaderBtn(add_btn);
        },
        error: function(){
            hideLoaderBtn(add_btn);
            $('.add_membership_alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
        }
    });
})


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