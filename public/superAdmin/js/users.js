var old_request1;
$('#approve_request').click(function(e){
    e.preventDefault();
    var b = $(this);

    if(old_request1 == null){
        swal({
            title: "Are you sure?",
            text: "You want to approve this user?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Approve',
            cancelButtonText: 'Cancel'
        }, function(isConfirmed){
            if (isConfirmed) {
                b.children('i').hide();
                b.children('div').show();

                var data = new FormData();
                data.append("email", b.attr('data-email'));
                data.append("fullname", b.attr('data-fullname'));
                data.append("request_id", b.attr('data-id'));
                
                data.append("approve_request", "true");
                data.append("POST", "true");

                old_request1 = $.ajax({
                    url: 'core/users.php',
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

var old_request2;
$('#decline_request').click(function(e){
    e.preventDefault();
    var b = $(this);

    if(old_request2 == null){
        swal({
            title: "Are you sure?",
            text: "You want to decline this user?",
            type: "warning",
            showCancelButton: true,
            confirmButtonText: 'Decline',
            cancelButtonText: 'Cancel'
        }, function(isConfirmed){
            if (isConfirmed) {
                b.children('i').hide();
                b.children('div').show();

                var data = new FormData();
                data.append("email", b.attr('data-email'));
                data.append("fullname", b.attr('data-fullname'));
                data.append("request_id", b.attr('data-id'));
                
                data.append("decline_request", "true");
                data.append("POST", "true");

                old_request2 = $.ajax({
                    url: 'core/users.php',
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