$('#add_event_form').submit(function(e){
    e.preventDefault();
    $('.add_event_alert').fadeOut();

    var name = $('#name').val();
    var date = $('#date').val();
    var time = $('#time').val();
    var location = $('#location').val();
    var about_event = $('#about_event').val();
    var how_it_works = $('#how_it_works').val();
    var add_btn = $('#add_btn');

        $('.add_event_alert').fadeOut();
        showLoaderBtn(add_btn);

        var data = new FormData();
        data.append("name", name);
        data.append("image", $('#image').get(0).files[0]);
        data.append("date", date);
        data.append("time", time);
        data.append("location", location);
        data.append("about_event", about_event);
        data.append("about_event_image", $('#about_event_image').get(0).files[0]);
        data.append("how_it_works", how_it_works);
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
    copyText.select();
    copyText.setSelectionRange(0, 99999); // For mobile devices

    // Copy the text inside the text field
    navigator.clipboard.writeText(copyText);

    // Alert the copied text
    alert("Copied the text: " + copyText);

})
