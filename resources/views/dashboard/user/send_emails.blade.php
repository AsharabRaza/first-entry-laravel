@extends('dashboard.user.layouts.template')

@section('content')

    @php
        $tooltip_status = 1;
        $tooltip_primary = 'data-bs-toggle="tooltip-primary"';
        $send_email_sel_lotts_tooltip = $tooltip_primary.' title="Select the lottery to send emails" ';
    @endphp

    <!--app-content open-->
    <div class="main-content app-content mt-0">
        <div class="side-app">

            <!-- CONTAINER -->
            <div class="main-container container-fluid">
                <!-- PAGE-HEADER -->
                <div class="page-header">
                    <div>
                        <h1 class="page-title">Send emails</h1>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Event Management</a></li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Emails</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Send emails</li>
                        </ol>
                    </div>
                </div>
                <!-- PAGE-HEADER END -->

                <!-- Row -->
                <div class="row row-sm">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header" style="place-content: space-between;">
                                <div>
                                    <h3 class="card-title">Send emails</h3>
                                    <small>All times are in <strong>{{ 'Selected Timezone' }}</strong></small>
                                </div>
                                <div>
                                    <a href="emails.php" class="btn btn-danger" id="cancel_btn">Cancel</a>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="alert alert-emails" style="display: none;"></div>
                                <form action="send_emails.php" method="GET" id="send_emails_filter">
                                    <input type="hidden" value="{{ request()->has('lottery_id') ? request('lottery_id') : ''  }}" id="lottery_id_get" name="lottery_id">
                                    <input type="hidden" value="{{ request()->has('entries_type') ? request('entries_type') : ''  }}" id="entries_type_get" name="entries_type">
                                </form>
                                <form method="POST" action="" id="send_emails_form" style="overflow: hidden;margin-bottom: 33px;">
                                    <div class="alert alert-danger lottery-alert" style="display: none;"></div>
                                    <div class="form-row">
                                        <div class="col-md-6 mb-5">
                                            <label for="lottery_id" style="display: block;"><span <?php echo ($tooltip_status) ? $send_email_sel_lotts_tooltip : ''; ?>>Lotteries</span> <small class="text-green">({{ $data['total_lotteries'] }} available)</small></label>
                                            <select name="lottery_id" id="lottery_id" class="select2">
                                                <option value="" <?php if(!isset($_GET['lottery_id']) || $_GET['lottery_id'] == ''){echo 'selected';}?> disabled>Select a lottery</option>
                                                <?php
                                                while($row = $available_l->fetch_assoc()){
                                                    echo '<option value="'.$row['id'].'"';
                                                    if(isset($_GET['lottery_id']) && $_GET['lottery_id'] == $row['id']){
                                                        echo ' selected';
                                                    }
                                                    echo '>'.$row['title'].'</option>';
                                                }
                                                ?>
                                            </select>
                                            <select name="lottery_id" id="lottery_id" class="select2">
                                                <option value="" @if(!isset($_GET['lottery_id']) || $_GET['lottery_id'] == '') selected @endif disabled >Select a lottery</option>
                                                @while($row = $available_l->fetch_assoc())
                                                    <option value="{{ $row['id'] }}" @if(isset($_GET['lottery_id']) && $_GET['lottery_id'] == $row['id']) selected @endif>{{ $row['title'] }}</option>
                                                @endwhile

                                                <option value="" @if(!isset($_GET['lottery_id']) || $_GET['lottery_id'] == '') selected @endif disabled >Select a lottery</option>
                                                @if($data['available_l'])
                                                    @foreach($data['available_l'] as $lotteries)
                                                        <option value="{{ $lotteries['id'] }}" @if(isset($_GET['lottery_id']) && $_GET['lottery_id'] == $row['id']) selected @endif>{{ $row['title'] }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>

                                        <div class="col-md-6 mb-5">
                                            <label for="lottery_url" style="display: block;"><span <?php echo ($tooltip_status) ? $send_email_sel_notsel_type_tooltip : ''; ?>>Entries type</span></label>
                                            <select name="entries_type" id="entries_type" class="select2" <?php if(!isset($_GET['lottery_id']) || $_GET['lottery_id'] == ''){echo 'disabled';}?>>
                                                <option value="" <?php if(!isset($_GET['entries_type']) || $_GET['entries_type'] == ''){echo 'selected';}?> disabled>Select a type</option>
                                                <option value="Winners" <?php if(isset($_GET['entries_type']) && $_GET['entries_type'] == 'Winners'){echo 'selected';}?>>Selected entries</option>
                                                <option value="Losers" <?php if(isset($_GET['entries_type']) && $_GET['entries_type'] == 'Losers'){echo 'selected';}?>>Non-selected entries</option>
                                            </select>
                                        </div>
                                        <?php
                                        if(isset($error_msg) && $error_msg != ''){
                                        ?>
                                        <div class="col-md-12 mb-5">
                                            <?php echo $error_msg;?>
                                        </div>
                                        <?php
                                        }
                                        ?>

                                    </div>

                                    <button class="btn btn-primary" type="button" id="<?php if(isset($_GET['entries_type']) && $_GET['entries_type'] == 'Winners'){echo 'send_winners_emails';}else if(isset($_GET['entries_type']) && $_GET['entries_type'] == 'Losers'){echo 'send_losers_email';}?>" style="float: right;position: relative;" <?php if(!isset($send) || $send == false){echo 'disabled';}?>>
                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;">Send email</span>
                                        <span style="-webkit-transition: all 0.2s;transition: all 0.2s;"><div class="spinner-border spinner-border-sm" style="display: none;place-content: center;align-items: center;" role="status"></div></span>
                                    </button>

                                    <?php if((isset($_GET['lottery_id']) || !empty($_GET['lottery_id'])) && (isset($_GET['entries_type']) || $_GET['entries_type'] != '')){
                                    ?>
                                    <div style="float: left;">
                                    <!-- <a href="edit_lottery.php?id=<?php //echo $_GET['lottery_id']?>&edit_tab=3" class="btn btn-success" id="update_email_template" style="float: right;margin-right: 6px;" <?php //if(!isset($send) || $send == false){echo 'disabled';}?>>Update</a> -->

                                        <button class="btn btn-info preview_btn" type="button" id="preview_btn" data-bs-target="#modalPreviewEmail" data-bs-toggle="modal" style="float: right;margin-right: 6px;" <?php if(!isset($send) || $send == false){echo 'disabled';}?>>Preview</button>
                                    </div>
                                    <?php
                                    }?>

                                </form>
                                <?php
                                if(isset($total_result2)){
                                ?>
                                <div class="" id="emails_sending_list_wrap">
                                    <div class="alert alert-sendings-emails-res" style="display: none;"></div>
                                    <h4 class="text-center">Emails list</h4>
                                    <ul class="list-group" id="emails_sending_list">
                                        <?php
                                        if($total_result2->num_rows > 0){
                                        while($rows = $total_result2->fetch_assoc()){
                                        if($rows['has_parent'] == 0){
                                        ?>
                                        <li class="list-group-item justify-content-between">
                                            <input class="form-check-input receivers_emails" type="checkbox" name="receivers_emails[]" value="<?php echo $rows['id'];?>" id="receivers_emails_<?php echo $rows['id'];?>" onchange="receivers_emails_checkbox(this);" checked>
                                            <label class="form-check-label" for="receivers_emails_<?php echo $rows['id'];?>">
                                                <?php echo $rows['sorting'];?>. <?php echo $rows['first_name'] . ' ' . $rows['last_name'];?> - <?php echo $rows['email'];?>
                                                <?php
                                                if($rows['guest_id'] != 0){
                                                ?>
                                                <span class="badge bg-secondary">BRING GUEST</span>
                                                <?php
                                                }
                                                ?>
                                                <div class="right_content right_content_<?php echo $rows['id'];?>"><span class="badgetext badge bg-info rounded-pill">Selected</span><div class="spinner-border spinner-border-sm" style="display: flex;place-content: center;align-items: center;float: right;top: 2px;position: relative;display: none;" role="status"></div>
                                            </label>
                                        </li>
                                        <?php
                                        }
                                        }
                                        }else{
                                            echo '<li class="list-group-item justify-content-between emails_p89">No emails available</li>';
                                        }

                                        ?>

                                    </ul>
                                </div>
                                <?php
                                }
                                ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- CONTAINER END -->
        </div>
    </div>
    <!--app-content end-->
    <!--Modal-->
    <div class="modal fade"  id="modalPreviewEmail">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header pd-20">
                    <h6 class="modal-title">Preview email</h6><button aria-label="Close" class="btn-close" data-bs-dismiss="modal" ><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body pd-0">
                    <div class="row">
                        <div class="col-lg-12" id="winner_template" style="display: none;">
                            <?php //echo $template_output->HtmlBody; ?>
                            <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; margin: 0; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #222222 !important; color: #FFFFFF !important;">
                                <tbody><tr>
                                    <td class="email-masthead" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 25px 0; text-align: center; background-color: #222222 !important; color: #FFFFFF !important;">
                                        <a href="website_url_Value" class="f-fallback email-masthead_name" style="color: #A8AAAF; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: none !important;">
                                            <img src="https://lottery.snsohag.com/assets/images/logo_black_1.png" height="45" style="border: none;">
                                        </a>
                                    </td>
                                </tr>
                                <!-- Email Body -->
                                <tr>
                                    <td class="email-body" width="570" cellpadding="0" cellspacing="0" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; width: 100%; margin: 0; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #222222 !important; color: #FFFFFF !important;">
                                        <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; margin: 0 auto; padding: 0; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #333333 !important; color: #FFFFFF !important;">
                                            <!-- Body content -->
                                            <tbody><tr>
                                                <td class="content-cell" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 10px 20px 20px;">
                                                    <div class="f-fallback">

                                                        <p class="align-center" style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important; text-align: center;">
                                                            <img class="second_logo_value" src="<?php if($lotter_details->header_image != ''){echo '../assets/images/media/' . $lotter_details->header_image;}?>" alt="image not found" style="width: 120px;">
                                                        </p>
                                                        <h1 class="align-center" style="margin-top: 0; color: #FFFFFF !important; font-size: 22px; font-weight: bold; text-align: center;">Congratulations!</h1>
                                                        <h2 style="margin-top: 0; color: #FFFFFF !important; font-size: 16px; font-weight: bold; text-align: left;">winner name,</h2>
                                                        <p style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important;">You have been randomly selected for <?php echo $site_title; ?> at <?php echo $lotter_details->title;?> on <?php echo date('M d, Y', strtotime($lotter_details->event_datetime)).' '.$lotter_details->event_time;?>. Please read the instructions carefully.</p>
                                                        <p style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important;">Here's your winner information:</p>
                                                        <table class="attributes" width="100%" cellpadding="0" cellspacing="0" style="margin: 0 0 21px;">
                                                            <tbody><tr>
                                                                <td class="attributes_content" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; background-color: #222222 !important; padding: 16px;">
                                                                    <table width="100%" cellpadding="0" cellspacing="0">
                                                                        <tbody><tr>
                                                                            <td class="attributes_item" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 4px 0;"><strong>Name:</strong> winner name</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="attributes_item" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 4px 0;"><strong>Queuing No:</strong> #</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="attributes_item" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 4px 0;"><strong>UID:</strong> xxxxxxxxx</td>
                                                                        </tr>
                                                                        <tr style="guest_hide_Value">
                                                                            <td class="attributes_item" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 4px 0;"><strong>Guest's Name:</strong> guest name</td>
                                                                        </tr>
                                                                        <tr style="guest_hide_Value">
                                                                            <td class="attributes_item" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 4px 0;"><strong>Guest queuing No:</strong> #</td>
                                                                        </tr>
                                                                        </tbody></table>
                                                                </td>
                                                            </tr>
                                                            </tbody></table>
                                                        <p style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important;"><?php echo $winners_emails_instructions;?></p>

                                                        <img class="map_image_value" src="<?php echo ($winners_emails_map_image)?'../assets/images/media/' . $winners_emails_map_image:'-';?>" alt="image not uploaded">

                                                        <p class="align-center reminders-title" style="margin: 1.1875em 0 0.4em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important; text-align: center;">Your QR Code:</p>
                                                        <div class="align-center" style="text-align: center;"><img src="../assets/images/media/dummy_qr_code.png" class="uid-img" style="width: 30%; margin: auto;"></div>

                                                        <p class="align-center reminders-title" style="margin: 1.1875em 0 0.4em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important; text-align: center;">Some reminders:</p>
                                                        <div><?php echo $winners_emails_reminders;?></div>

                                                        <p style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important;">Please review the <a href="venue_link_Value" class="venue-link-color" style="color: #FFFFFF;">venue policies on prohibited items</a></p>

                                                        <p style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important;">Thank you,
                                                            <br><?php echo $site_title; ?> Team</p>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                        <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; margin: 0 auto; padding: 0; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center; background-color: #222222 !important; color: #FFFFFF !important;">
                                            <tbody><tr>
                                                <td class="content-cell" align="center" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 10px 20px 20px;">
                                                    <p class="f-fallback sub align-center" style="margin: 0.4em 0 1.1875em; font-size: 13px; line-height: 1.625; color: #FFFFFF !important; text-align: center;"><?php echo $company_address;?></p>
                                                    <p class="f-fallback sub align-center" style="margin: 0.4em 0 1.1875em; font-size: 13px; line-height: 1.625; color: #FFFFFF !important; text-align: center;">
                                                        This message was sent to <span style="color: #FFFFFF !important;">receiver_email_Value</span> as you signed up with <?php echo $site_title; ?>. Please do not reply to this email as this address is not monitored. Please <a href="contact_support_Value" style="color: #FFFFFF; text-decoration: underline;">contact support</a> for any questions.
                                                        <span class="unsubscribe_hide_Value" style="color: #FFFFFF !important;"><br>If you no longer wish to receive emails from <?php echo $site_title; ?>, <a href="https://subscriptions.pstmrk.it/demo/unsubscribe" style="color: #FFFFFF; text-decoration: underline;">click here</a> to unsubscribe.</span>
                                                    </p>
                                                    <p class="f-fallback sub align-center" style="margin: 0.4em 0 1.1875em; font-size: 13px; line-height: 1.625; color: #FFFFFF !important; text-align: center;">Copyright © <?php echo date('Y');?> <?php echo $site_title; ?>. All rights reserved.</p>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>

                        <div class="col-lg-12" id="looser_template" style="display: none;">
                            <table class="email-wrapper" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; margin: 0; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #222222 !important; color: #FFFFFF !important;">
                                <tbody><tr>
                                    <td align="center" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                        <table class="email-content" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="width: 100%; margin: 0; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #222222 !important; color: #FFFFFF !important;">
                                            <tbody><tr>
                                                <td class="email-masthead" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 25px 0; text-align: center; background-color: #222222 !important; color: #FFFFFF !important;">
                                                    <a href="website_url_Value" class="f-fallback email-masthead_name" style="color: #A8AAAF; font-size: 16px; font-weight: bold; text-decoration: none; text-shadow: none !important;">
                                                        <img src="https://lottery.snsohag.com/assets/images/logo_black_1.png" height="45" style="border: none;">
                                                    </a>
                                                </td>
                                            </tr>
                                            <!-- Email Body -->
                                            <tr>
                                                <td class="email-body" width="570" cellpadding="0" cellspacing="0" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; width: 100%; margin: 0; padding: 0; -premailer-width: 100%; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #222222 !important; color: #FFFFFF !important;">
                                                    <table class="email-body_inner" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; margin: 0 auto; padding: 0; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; background-color: #333333 !important; color: #FFFFFF !important;">
                                                        <!-- Body content -->
                                                        <tbody><tr>
                                                            <td class="content-cell" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 10px 20px 20px;">
                                                                <div class="f-fallback">

                                                                    <p class="align-center" style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important; text-align: center;">
                                                                        <img src="<?php if($lotter_details->header_image != ''){echo '../assets/images/media/' . $lotter_details->header_image;}?>" alt="image not found" style="width: 240px;">
                                                                    </p>
                                                                    <h1 class="align-center" style="margin-top: 0; color: #FFFFFF !important; font-size: 22px; font-weight: bold; text-align: center;">Thank you for entering <?php echo $site_title; ?> <?php echo $lotter_details->title;?> <?php echo date('M d, Y', strtotime($lotter_details->event_datetime));?></h1>
                                                                    <h2 style="margin-top: 0; color: #FFFFFF !important; font-size: 16px; font-weight: bold; text-align: left;">Not selected name,</h2>
                                                                    <p style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important;">You have not won the <?php echo $site_title; ?> for <?php echo $lotter_details->title;?> <?php echo date('M d, Y', strtotime($lotter_details->event_datetime));?>, thank you for participating, please try again next time.</p>
                                                                    <?php echo $losers_emails_instructions;?>
                                                                    <p style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important;">Please review <a href="venue_link_Value" class="venue-link-color" style="color: #FFFFFF;">venue policies</a>.</p>

                                                                    <p style="margin: 0.4em 0 1.1875em; font-size: 16px; line-height: 1.625; color: #FFFFFF !important;">Thank you,
                                                                        <br><?php echo $site_title; ?> Team</p>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        </tbody></table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px;">
                                                    <table class="email-footer" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="width: 570px; margin: 0 auto; padding: 0; -premailer-width: 570px; -premailer-cellpadding: 0; -premailer-cellspacing: 0; text-align: center; background-color: #222222 !important; color: #FFFFFF !important;">
                                                        <tbody><tr>
                                                            <td class="content-cell" align="center" style="font-family: &quot;Nunito Sans&quot;, Helvetica, Arial, sans-serif; font-size: 16px; padding: 10px 20px 20px;">
                                                                <p class="f-fallback sub align-center" style="margin: 0.4em 0 1.1875em; font-size: 13px; line-height: 1.625; color: #FFFFFF !important; text-align: center;"><?php echo $company_address;?></p>
                                                                <p class="f-fallback sub align-center" style="margin: 0.4em 0 1.1875em; font-size: 13px; line-height: 1.625; color: #FFFFFF !important; text-align: center;">
                                                                    This message was sent to <span style="color: #FFFFFF !important;">receiver_email_Value</span> as you signed up with <?php echo $site_title; ?>. Please do not reply to this email as this address is not monitored. Please <a href="contact_support_Value" style="color: #FFFFFF; text-decoration: underline;">contact support</a> for any questions.
                                                                    <span class="unsubscribe_hide_Value" style="color: #FFFFFF !important;"><br>If you no longer wish to receive emails from <?php echo $site_title; ?>, <a href="https://subscriptions.pstmrk.it/demo/unsubscribe" style="color: #FFFFFF; text-decoration: underline;">click here</a> to unsubscribe.</span>
                                                                </p>
                                                                <p class="f-fallback sub align-center" style="margin: 0.4em 0 1.1875em; font-size: 13px; line-height: 1.625; color: #FFFFFF !important; text-align: center;">Copyright © <?php echo date('Y');?> <?php echo $site_title; ?>. All rights reserved.</p>
                                                            </td>
                                                        </tr>
                                                        </tbody></table>
                                                </td>
                                            </tr>
                                            </tbody></table>
                                    </td>
                                </tr>
                                </tbody></table>
                        </div>
                    </div>
                    <div class="modal-footer pd-20">
                        <button class="btn btn-light" data-bs-dismiss="modal" aria-label="Close" >Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!--/Modal-->


        @endsection
@push('css')
    <style>
        .dark-mode .lottery_list a {
            color: #aaaad8;
        }

        .dark-mode a, a:hover {
            color: #fff !important;
        }

        td a:hover, .list_a:hover {
            color: var(--primary-bg-color) !important;
        }

        .right_content {
            float: right;
        }

        .list-group-item .badge.bg-secondary {
            margin-left: 4px;
        }
        select + .select2-container {
            width: 100% !important;
        }

        #emails_sending_list li input {
            margin-left: -6px;
        }
        #emails_sending_list li label {
            margin-left: 14px;
            display: block;
        }

        .dark-mode .list-group-item:hover, .dark-mode .listorder:hover, .dark-mode .listorder1:hover, .dark-mode .listunorder:hover, .dark-mode .listunorder1:hover {
            color: #aaaad8 !important;
        }

    </style>
@endpush
@push('js')

    <script>
        var add_agent = '{{ route('user.add-agent') }}';
    </script>
    <!-- FORMEDITOR JS -->
    {{ Html::script('assets/js/table-data.js') }}


    <!-- Tooltip and Popover JS -->
    <script>
        var tooltip_primary = $('[data-bs-toggle="tooltip-primary"]');
        for (let index = 0; index < tooltip_primary.length; index++) {
            var tooltip = new bootstrap.Tooltip(tooltip_primary[index], {
                template: '<div class="tooltip tooltip-primary" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
            });
        }
        var tooltip_info = $('[data-bs-toggle="tooltip-info"]');
        for (let index = 0; index < tooltip_info.length; index++) {
            var tooltip = new bootstrap.Tooltip(tooltip_info[index], {
                template: '<div class="tooltip tooltip-info" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
            });
        }
        var tooltip_danger = $('[data-bs-toggle="tooltip-danger"]');
        for (let index = 0; index < tooltip_danger.length; index++) {
            var tooltip = new bootstrap.Tooltip(tooltip_danger[index], {
                template: '<div class="tooltip tooltip-danger" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>'
            });
        }
    </script>

            {{ Html::script('assets/plugin/sweet-alert/sweetalert.min.js') }}
            {{ Html::script('user/js/emails_modify.js'.rand(0,1000)) }}
            {{ Html::script('user/js/entries.js'.rand(0,1000)) }}

            <script>
                $(document.body).on("change", "#lottery_id",function(){
                    $('#lottery_id_get').val(this.value);
                    $('#send_emails_filter').submit();
                });
                $(document.body).on("change", "#entries_type",function(){
                    $('#entries_type_get').val(this.value);
                    $('#send_emails_filter').submit();
                });

                $('.preview_btn').click(function() {
                    if($('#entries_type').val() == 'Winners') {
                        $('#looser_template').hide();
                        $('#winner_template').show();
                    } else {
                        $('#winner_template').hide();
                        $('#looser_template').show();
                    }
                });
            </script>


@endpush


























