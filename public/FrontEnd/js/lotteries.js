$("#phone").keyup(function () {
  if ($("#phone").val().length != 10) {
    $("#phone").parent().addClass("mb-6").removeClass("mb-4");
    $("#phone").addClass("is-invalid");
  } else {
    $("#phone").removeClass("is-invalid");
    $("#phone").parent().removeClass("mb-6").addClass("mb-4");
  }
});

$("#email").keyup(function () {
  $("#email").bind("keyup blur", function () {
    //Illegal character regex
    var regIllegal = /[+]/;
    if (regIllegal.test($(this).val())) {
      //alert('this symbol not allowed!');
    }
    $(this).val(
      $(this)
        .val()
        .replace(/[^A-Za-z0-9-*/_()$%@.]/g, "")
    );
  });
});

$("#email").keypress(function (e) {
  if (e.key === "+") return false;
});

var old_request_captcha;
$("#captcha").keyup(function (e) {
  $(this).removeClass("is-invalid");
  $(this).removeClass("is-valid");
  if ($(this).val() != "") {
    if (old_request_captcha) {
      old_request_captcha.abort();
    }
    var data = new FormData();
    data.append("captcha", $(this).val());
    if ($(this).attr("data-not") && $(this).attr("data-not") != "") {
      data.append("not", $(this).attr("data-not"));
    }
    data.append("check_captcha", "true");
    data.append("POST", "true");

    old_request_captcha = $.ajax({
      url: captcha,
      type: "POST",
      data: data,
      processData: false,
      contentType: false,
      success: function (res) {
        if (res.success == true) {
          $("#captcha").removeClass("is-invalid");
          $("#captcha").addClass("is-valid");
          $("#captcha").parent().removeClass("mb-6").addClass("mb-4");
        } else if (res.success == false) {
          $("#captcha").parent().addClass("mb-6").removeClass("mb-4");
          $("#captcha").addClass("is-invalid");
          $("#captcha").removeClass("is-valid");
        } else {
          $("#captcha").parent().addClass("mb-6").removeClass("mb-4");
          $("#captcha").addClass("is-invalid");
          $("#captcha").removeClass("is-valid");
        }
      },
      error: function () {
        $("#captcha").parent().addClass("mb-6").removeClass("mb-4");
        $("#captcha").addClass("is-invalid");
        $("#captcha").removeClass("is-valid");
      },
    });
  } else {
    if (old_request_captcha) {
      old_request_captcha.abort();
    }
  }
});

$("#lotteries_form").submit(function (e) {
  e.preventDefault();
  if ($("#phone").hasClass("is-invalid") == false) {
    if (
      $("#captcha").hasClass("is-valid") == true &&
      $("#captcha").hasClass("is-invalid") == false
    ) {
      var lottery_id = $("#lottery_id").val();
      var lottery_title = $("#lottery_title").val();
      var first_name = $("#first_name").val();
      var last_name = $("#last_name").val();
      var email = $("#email").val();
      var phone = $('#phone_code').val() + $("#phone").val();
      var captcha = $("#captcha").val();
      var bring_guest = $('input[name="bring_guest"]:checked').val();
      var guest_first_name = $("#guest_first_name").val();
      var guest_last_name = $("#guest_last_name").val();
      var terms_conditions_chekbox = $(
        'input[name="terms_conditions_chekbox"]:checked'
      ).val();
      var submit_btn = $("#submit_btn");
      showLoaderBtn(submit_btn);
      $(".lottery-alert").fadeOut();

      var custom_inputs_val_all = $('[name="custom_inputs_val[]"]');
      var custom_inputs_val_ar = {};

      for (let index = 0; index < custom_inputs_val_all.length; index++) {
        var val = custom_inputs_val_all.eq(index).val();
        var dataType = custom_inputs_val_all.eq(index).attr('data-type');
        var dataType2 = custom_inputs_val_all.eq(index).attr('data-type2');
        var dataLabel = custom_inputs_val_all.eq(index).attr('data-label');

        if(dataType2 == 'date'){
          custom_inputs_val_ar[dataLabel] = val + ' ' + custom_inputs_val_all.eq(index + 1).val();;
        }else if(dataType2 != 'time'){
          custom_inputs_val_ar[dataLabel] = val;
        }
      }

      var data = new FormData();
      data.append("lottery_id", lottery_id);
      data.append("lottery_title", lottery_title);
      data.append("first_name", first_name);
      data.append("last_name", last_name);
      data.append("email", email);
      data.append("phone", phone);
      data.append("captcha", captcha);
      data.append("bring_guest", bring_guest);
      data.append("guest_first_name", guest_first_name);
      data.append("guest_last_name", guest_last_name);
      data.append("terms_conditions_chekbox", terms_conditions_chekbox);
      data.append("custom_inputs_val", JSON.stringify(custom_inputs_val_ar));

      data.append("submit_lottery", "true");
      data.append("POST", "true");
      request = $.ajax({
        url: save_lottery_form,
        type: "POST",
        data: data,
        processData: false,
        contentType: false,
        success: function (res) {
            var res = JSON.parse(res);
          if (res.success == true) {
              //debugger;
            var parent_id = res.id;
            var added_uid = res.msg;
            var qrcode = new QRCode(document.getElementById("genqrcode"), {
                text: website_url + "status/" + res.msg,
                logo: URL_+"/assets/images/logo_white_2.png",
                logoWidth: undefined,
                logoHeight: undefined,
                logoBackgroundColor: '#ffffff',
                logoBackgroundTransparent: true,
                quietZone: 15,
                quietZoneColor: '#fff',
                onRenderingEnd(qrCodeOptions, dataURL){
                    //console.log(dataURL);

                    var data = {};
                    data['parent_id'] = parent_id;
                    data['s_qrcode'] = 'true';
                    data['uid'] = added_uid;
                    data['POST'] = 'true';

                    var data_json = {};
                    data_json[0] = data;
                    data_json[1] = dataURL;

                    $.ajax({
                        url: save_s_qrcode,
                        type: 'POST',
                        dataType: 'json',
                        data: JSON.stringify(data_json),
                        processData: false,
                        contentType: "application/json",
                        success: function(res){
                          if (res.success == true) {
                            $("#lotteries_form").get(0).reset();
                            swal("Congratulations!", res.msg, "success");
                            $(".lottery-alert").fadeOut();
                            $("#bring_guest_wrap").addClass("d-none");
                            $("#guest_first_name").removeAttr("required");
                            $("#guest_last_name").removeAttr("required");
                          }else if(res.success == false) {
                            $(".lottery-alert")
                              .removeClass("alert-success")
                              .addClass("alert-danger")
                              .html(res.msg)
                              .fadeIn();
                          }else{
                            $(".lottery-alert")
                              .removeClass("alert-success")
                              .addClass("alert-danger")
                              .html("Something went wrong, please try again later.")
                              .fadeIn();
                          }
                          hideLoaderBtn(submit_btn);
                          var d = new Date();
                          $("#captcha_img").attr(
                            "src",
                            "core/captcha.php?get=true&" + d.getTime()
                          );
                          $("#captcha").keyup();
                        },
                        error: function(){
                          hideLoaderBtn(submit_btn);
                          $(".lottery-alert")
                            .removeClass("alert-success")
                            .addClass("alert-danger")
                            .html("Something went wrong, please try again later.")
                            .fadeIn();
                          var d = new Date();
                          $("#captcha_img").attr(
                            "src",
                            "core/captcha.php?get=true&" + d.getTime()
                          );
                          $("#captcha").keyup();
                        }
                    });
                }
            });


            /*$("#lotteries_form").get(0).reset();
            swal("Congratulations!", res.msg, "success");
            $(".lottery-alert").fadeOut();
            $("#bring_guest_wrap").addClass("d-none");
            $("#guest_first_name").removeAttr("required");
            $("#guest_last_name").removeAttr("required");*/

          } else if (res.success == false) {
            $(".lottery-alert")
              .removeClass("alert-success")
              .addClass("alert-danger")
              .html(res.msg)
              .fadeIn();
            hideLoaderBtn(submit_btn);
            var d = new Date();
            $("#captcha_img").attr(
              "src",
              "core/captcha.php?get=true&" + d.getTime()
            );
            $("#captcha").keyup();
          } else {
            $(".lottery-alert")
              .removeClass("alert-success")
              .addClass("alert-danger")
              .html("Something went wrong, please try again later.")
              .fadeIn();
            hideLoaderBtn(submit_btn);
            var d = new Date();
            $("#captcha_img").attr(
              "src",
              "core/captcha.php?get=true&" + d.getTime()
            );
            $("#captcha").keyup();
          }

        },
        error: function () {
          hideLoaderBtn(submit_btn);
          $(".lottery-alert")
            .removeClass("alert-success")
            .addClass("alert-danger")
            .html("Something went wrong, please try again later.")
            .fadeIn();
          var d = new Date();
          $("#captcha_img").attr(
            "src",
            "core/captcha.php?get=true&" + d.getTime()
          );
          $("#captcha").keyup();
        },
      });
    } else {
      $("#captcha").focus();
    }
  } else {
    $("#phone").focus();
  }
});

$('#uid_form').submit(function(e) {
  e.preventDefault();
  $('.forgot-alert').fadeOut();

  var uid = $('#uid').val();
  var find_btn = $('#find_btn');

  $('.forgot-alert').fadeOut();

      showLoaderBtn(find_btn);
      var data = new FormData();
      data.append("uid", uid);
      data.append("find_uid", "true");
      data.append("POST", "true");
      request = $.ajax({
          url: 'core/lotteries.php',
          type: 'POST',
          data: data,
          processData: false,
          contentType: false,
          success: function(res)
          {
              if (res.success == true)
              {
                  $('.forgot-alert').removeClass('alert-danger').addClass('alert-success').html(res.msg).fadeIn();
                  $('#desc').hide();
                  hideLoaderBtn(find_btn);
              }
              else if (res.success == false)
              {
                  $('.forgot-alert').removeClass('alert-success').addClass('alert-danger').html(res.msg).fadeIn();
                  hideLoaderBtn(find_btn);
                  $('#desc').show();
              }
              else
              {
                  $('.forgot-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
                  hideLoaderBtn(find_btn);
                  $('#desc').show();
              }
              hideLoaderBtn(find_btn);
          },
          error: function(){
              hideLoaderBtn(find_btn);
              $('.forgot-alert').removeClass('alert-success').addClass('alert-danger').html('Something went wrong, please try again later.').fadeIn();
              $('#desc').show();
          }
      });
});

$('input[name="bring_guest"]').change(function () {
  var bring_guest = $('input[name="bring_guest"]:checked').val();
  if (bring_guest == 0) {
    $("#bring_guest_wrap").addClass("d-none");
    $("#guest_first_name").removeAttr("required");
    $("#guest_last_name").removeAttr("required");
  } else if (bring_guest == 1) {
    $("#bring_guest_wrap").removeClass("d-none");
    $("#guest_first_name").attr("required", "");
    $("#guest_last_name").attr("required", "");
  }
});

function hideLoaderBtn(submit_btn) {
  var submit_btn_height = submit_btn.height() / 2;

  submit_btn.children("span").eq(0).css({
    display: "block",
    webkitTransform: "translateY(0px)",
    transform: "translateY(0px)",
    opacity: 1,
  });

  submit_btn
    .children("span")
    .eq(1)
    .css({
      top: "calc(50% + " + submit_btn_height + "px)",
      opacity: 0,
    });

  setTimeout(function () {
    submit_btn.children("span").eq(1).children().eq(0).hide();
    submit_btn.prop("disabled", false);
  }, 200);
}

function showLoaderBtn(submit_btn) {
  submit_btn.prop("disabled", true);
  var submit_btn_height = submit_btn.height() / 2;

  submit_btn
    .children("span")
    .eq(1)
    .css({
      position: "absolute",
      display: "flex",
      top: "calc(50% + " + submit_btn_height + "px)",
      left: "50%",
      transform: "translate(-50%, -50%)",
      opacity: 0,
    });

  setTimeout(function () {
    submit_btn.children("span").eq(1).children().eq(0).show();
    submit_btn
      .children("span")
      .eq(0)
      .css({
        display: "block",
        webkitTransform: "translateY(-" + submit_btn_height + "px)",
        transform: "translateY(-" + submit_btn_height + "px)",
        opacity: 0,
      });
    submit_btn.children("span").eq(1).css({
      top: "50%",
      opacity: 1,
    });
  }, 10);
}
