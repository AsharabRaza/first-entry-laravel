$('#add_event_form').submit(function(e){
    e.preventDefault();
    $('.add_event_alert').fadeOut();

    var name = $('#name').val();
    var date = $('#date').val();
    var time = $('#time').val();
    var location = $('#location').val();
    var about_event = $('#about_event').val();
    var how_it_works = $('#how_it_works').val();
    var select_lotteries = $('#select_lotteries').val();
    var add_btn = $('#add_btn');

        $('.add_event_alert').fadeOut();
        showLoaderBtn(add_btn);

        var data = new FormData();


    if($('#image').val() != '' || $('#about_event_image').val() != ''){

        if($('#image').val() != ''){
            data.append("image", $('#image').get(0).files[0]);
        }else{
            //data["image"] = "";
            data.append("image", '');
        }

        if($('#about_event_image').val() != ''){
            data.append('about_event_image', $('#about_event_image').get(0).files[0]);
        }else{
            //data["about_event_image"] = "";
            data.append("about_event_image", '');
        }

    }else{

        if($('#fake_image').attr('data-value') == ''){
            //data["image"] = "";
            data.append("image", '');
        }else{
            //data["image"] = $('#fake_image').attr('data-value');
            data.append("image", $('#fake_image').attr('data-value'));
        }

        if($('#fake_about_event_image').attr('data-value') == ''){
            //data["about_event_image"] = "";
            data.append("about_event_image", '');
        }else{
            //data["about_event_image"] = $('#fake_about_event_image').attr('data-value');
            data.append("about_event_image", $('#fake_about_event_image').attr('data-value'));
        }

    }



        data.append("name", name);
        //data.append("image", $('#image').get(0).files[0]);
        data.append("date", date);
        data.append("time", time);
        data.append("location", location);
        data.append("about_event", about_event);
        //data.append("about_event_image", $('#about_event_image').get(0).files[0]);
        data.append("how_it_works", how_it_works);
        data.append("select_lotteries", select_lotteries);
        data.append("add_event_btn", "true");
        data.append("POST", "true");
        request = $.ajax({
            url: add_event,
            type: 'POST',
            data: data,
            processData: false,
            contentType: false,
            success: function(res){
                console.log(res);
                if(res.success == true){
                    $('#add_event_form').get(0).reset();
                    $('.add_event_alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                    setTimeout(function(){
                        window.location.reload();
                    }, 1200);
                }else if(res.success == false){
                    $('.add_event_alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                }else{
                    $('.add_event_alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                }
                hideLoaderBtn(add_btn);
            },
            error: function(){
                hideLoaderBtn(add_btn);
                $('.add_event_alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
            }
        });
});

$('#edit_event_form').submit(function(e){
    e.preventDefault();
    $('.add_event_alert').fadeOut();

    var name = $('#name').val();
    var date = $('#date').val();
    var time = $('#time').val();
    var event_id = $('#event_id').val();
    var location = $('#location').val();
    var about_event = $('#about_event').val();
    var how_it_works = $('#how_it_works').val();
    var select_lotteries = $('#select_lotteries').val();
    var add_btn = $('#add_btn');

    $('.add_event_alert').fadeOut();
    showLoaderBtn(add_btn);

    var data = new FormData();


    if($('#image').val() != ''){
        data.append("image", $('#image').get(0).files[0]);
    }else{
        data["image"] = "";
    }

    if($('#about_event_image').val() != ''){
        data.append('about_event_image', $('#about_event_image').get(0).files[0]);
    }else{
        data["about_event_image"] = "";
    }

    data.append('lottery_images_upload', 'true');
    data.append('POST', 'true');



    data.append("name", name);
    data.append("date", date);
    data.append("event_id", event_id);
    data.append("time", time);
    data.append("location", location);
    data.append("about_event", about_event);
    data.append("how_it_works", how_it_works);
    data.append("select_lotteries", select_lotteries);
    data.append("add_event_btn", "true");
    data.append("POST", "true");
    request = $.ajax({
        url: edit_event,
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(res){
            console.log(res);
            if(res.success == true){
                $('#edit_event_form').get(0).reset();
                $('.add_event_alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                setTimeout(function(){
                    window.location.reload();
                }, 1200);
            }else if(res.success == false){
                $('.add_event_alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
            }else{
                $('.add_event_alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
            }
            hideLoaderBtn(add_btn);
        },
        error: function(){
            hideLoaderBtn(add_btn);
            $('.add_event_alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
        }
    });
});


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

$('.copy-event-link').click(function(){

    var copyText = $(this).attr('data-url');
    // alert(copyText);
    // Select the text field
    //copyText.select();
    //copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText);

    // Alert the copied text
    alert("URL Copied !");

})


$('#remove_image').click(function(){
    $('#fake_image').val('');
    $('#fake_image').attr('data-value', '');
    $('#image').val('');
    $('#preview_image_wrap').addClass('d-none');
    $('#preview_image').attr('src', '');
});
$('#remove_about_event_image').click(function(){
    $('#fake_about_event_image').val('');
    $('#fake_about_event_image').attr('data-value', '');
    $('#about_event_image').val('');
    $('#preview_about_event_image_wrap').addClass('d-none');
    $('#preview_about_event_image').attr('src', '');
});

$('#image').change(function(){
    if($(this).val() == ''){
        $('#fake_image').val($('#fake_image').attr('data-value'));
        if($('#fake_image').val() != ''){
            $('#preview_image').attr('src', '../assets/images/media/' + $('#fake_image').val());
            $('#preview_image_wrap').removeClass('d-none');
        }else{
            $('#preview_image_wrap').addClass('d-none');
        }
    }else{
        $('#preview_image')[0].src = (window.URL ? URL : webkitURL).createObjectURL($(this).get(0).files[0]);
        // $('.second_logo_value').attr('src', (window.URL ? URL : webkitURL).createObjectURL($(this).get(0).files[0]));
        $('#fake_image').val('');
        $('#preview_image_wrap').removeClass('d-none');
        $('#image').css({borderColor: ''});
    }
});

$('#about_event_image').change(function(){
    if($(this).val() == ''){
        $('#fake_about_event_image').val($('#fake_about_event_image').attr('data-value'));
        if($('#fake_about_event_image').val() != ''){
            $('#preview_about_event_image').attr('src', '../assets/images/media/' + $('#fake_img_lottery_background_image').val());
            $('#preview_about_event_image_wrap').removeClass('d-none');
        }else{
            $('#preview_about_event_image_wrap').addClass('d-none');
        }
    }else{
        $('#preview_about_event_image')[0].src = (window.URL ? URL : webkitURL).createObjectURL($(this).get(0).files[0]);
        $('#fake_about_event_image').val('');
        $('#preview_about_event_image_wrap').removeClass('d-none');
        $('#about_event_image').css({borderColor: ''});
    }
});
