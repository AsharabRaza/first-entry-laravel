$('#admin_login').submit(function(e){
    e.preventDefault();

    $('.alert-custom').fadeOut();

    $('#submit_btn').prop('disabled', true);
    $('#submit_btn').children().eq(1).children('.button__icon').hide();
    $('#submit_btn').children().eq(1).children('.spinner-border').fadeIn();

    var data = new FormData();
    data.append("email", $('#email').val());
    data.append("pass", $('#pass').val());
    data.append("login", "true");
    data.append("POST", "true");
    request = $.ajax({
        url: 'core/admins.php',
        type: 'POST',
        data: data,
        processData: false,
        contentType: false,
        success: function(res){
            if(res.success == true){
                $('#submit_btn').children().eq(1).children('.spinner-border').hide();
                $('#submit_btn').children().eq(1).children('.button__icon').fadeIn();
                $('.alert-custom').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                setTimeout(function(){
                  window.location.reload();
                    //window.location.href = '/dashboard';
                }, 500);
            }else if(res.success == false){
                $('#submit_btn').prop('disabled', false);
                $('#submit_btn').children().eq(1).children('.spinner-border').hide();
                $('#submit_btn').children().eq(1).children('.button__icon').fadeIn();
                $('.alert-custom').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
            }else{
                $('#submit_btn').prop('disabled', false);
                $('#submit_btn').children().eq(1).children('.spinner-border').hide();
                $('#submit_btn').children().eq(1).children('.button__icon').fadeIn();
                $('.alert-custom').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
            }
        },
        error: function(){
            $('#submit_btn').prop('disabled', false);
            $('#submit_btn').children().eq(1).children('.spinner-border').hide();
            $('#submit_btn').children().eq(1).children('.button__icon').fadeIn();
            $('.alert-custom').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
        }
    });
});