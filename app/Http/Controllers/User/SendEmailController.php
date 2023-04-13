<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lottery;
use App\Models\Lottery_Winner;
use App\Models\Lottery_Losser;
use App\Models\EmailsHistory;
use App\Models\Email_Template;
use Illuminate\Support\Facades\DB;
use Postmark\PostmarkClient;


class SendEmailController extends Controller
{
    public function send_emails(Request $request){

        $normal_user = auth()->user()->id;
        $current_datetime = now();
        $lotteryId = $request->input('lottery_id');
        $entriesType = $request->input('entries_type');
        $error_msg = '';
        $lotter_details = [];
        $send = '';
        $total_result = [];
        $email_data = [];

        //dd($request->all());

        if(request()->has('lottery_id') && request()->filled('lottery_id') && request()->has('entries_type') && request()->filled('entries_type'))
        {

            $lotter_details = Lottery::where('id', request()->input('lottery_id'))->where('user_id', $normal_user)->first();

            if($lotter_details) {

                if ($entriesType == 'Winners') {

                    $email_type = 'winners_email';

                    $total_result = Lottery_Winner::select('*')
                        ->join('entries', 'lottery_winners.entry_id', '=', 'entries.id')
                        ->where('lottery_winners.lottery_id', $lotteryId)
                        ->orderBy('lottery_winners.sorting', 'ASC')
                        ->get();

                    $totalWinners = Lottery_Winner::select('*')
                        ->join('entries', 'lottery_winners.entry_id', '=', 'entries.id')
                        ->where('lottery_winners.lottery_id', $lotteryId)
                        ->orderBy('lottery_winners.sorting', 'ASC')
                        ->count();

                    $totalEmails = Lottery_Winner::select('*')
                        ->join('entries', 'lottery_winners.entry_id', '=', 'entries.id')
                        ->where('lottery_winners.lottery_id', $lotteryId)
                        ->where('entries.has_parent', 0)
                        ->count();

                    $totalGuests = $totalWinners - $totalEmails;

                    $totalSent = EmailsHistory::where('lottery_id', $lotteryId)
                        ->where('user_id', $normal_user)
                        ->where('email_type', 'winners_email')
                        ->count();

                    $totalSent = $totalSent > 0 ? '<strong>[Already sent ' . $totalSent . ' times]</strong>' : '';

                    if ($totalWinners == 0 && $totalEmails == 0 && $totalGuests == 0) {
                        $error_msg = '<div class="alert alert-success">Based on your selection, we found <strong>' . $totalWinners . ' selected entries</strong> with <strong>' . $totalEmails . ' emails</strong> & <strong>' . $totalGuests . ' guests</strong>. ' . $totalSent . '</div>';
                    } else {
                        $send = true;
                        $error_msg = '<div class="alert alert-success">Based on your selection, we found <strong>' . $totalWinners . ' selected entries</strong> with <strong>' . $totalEmails . ' emails</strong> & <strong>' . $totalGuests . ' guests</strong>. Try sending emails now? Click the <strong>send</strong> button below ' . $totalSent . '</div>';
                    }
                }
                elseif($entriesType == 'Losers'){

                    $email_type = 'losers_email';

                    $total_result = Lottery_Losser::select('*')
                        ->join('entries', 'lottery_losers.entry_id', '=', 'entries.id')
                        ->where('lottery_losers.lottery_id', $lotteryId)
                        ->orderBy('lottery_losers.sorting', 'ASC')
                        ->get();

                    $total_losers = Lottery_Losser::select('*')
                        ->join('entries', 'lottery_losers.entry_id', '=', 'entries.id')
                        ->where('lottery_losers.lottery_id', $lotteryId)
                        ->orderBy('lottery_losers.sorting', 'ASC')
                        ->count();

                    $total_emails = Lottery_Losser::where('lottery_losers.lottery_id', $lotteryId)
                        ->join('entries', 'lottery_losers.entry_id', '=', 'entries.id')
                        ->where('entries.has_parent', 0)
                        ->count();

                    $total_guests = $total_losers - $total_emails;

                    $total_sent = EmailsHistory::where('lottery_id', $lotteryId)
                        ->where('user_id', $normal_user)
                        ->where('email_type', 'losers_email')
                        ->count();

                    if ($total_losers == 0 && $total_emails == 0 && $total_guests == 0) {
                        $error_msg = '<div class="alert alert-success">Based on your selection, we found <strong>' . $total_losers . ' non-selected entries</strong> with <strong>' . $total_emails . ' emails</strong> & <strong>' . $total_guests . ' guests</strong>. ' . $total_sent . '</div>';
                    } else {
                        $send = true;
                        $error_msg = '<div class="alert alert-success">Based on your selection, we found <strong>' . $total_losers . ' non-selected entries</strong> with <strong>' . $total_emails . ' emails</strong> & <strong>' . $total_guests . ' guests</strong>. Try sending emails now? Click the <strong>send</strong> button below ' . $total_sent . '</div>';
                    }

                }

                $email_data = Email_Template::where('lottery_id', request()->input('lottery_id'))->where('user_id', $normal_user)->where('email_type', $email_type)->first()->email_data;
                $email_data = unserialize($email_data);

            }
            else
            {
                $error_msg = '<div class="alert alert-danger">Based on your selection, we couldn\'t find any lottery. Try selecting again?</div>';
            }
        }

        $total_lotteries = Lottery::where('user_id', $normal_user)
            ->where('is_winners_selected', true)
            ->orderBy('title', 'asc')
            ->count();
        $available_l = Lottery::where('user_id', $normal_user)
            ->where('is_winners_selected', true)
            ->orderBy('title', 'asc')
            ->get();

        return view('dashboard.user.send_emails',compact('total_lotteries','available_l', 'error_msg', 'lotter_details', 'send', 'total_result', 'email_data'));

    }

    public function send_winners_emails(Request $request){

        $normal_user = auth()->user()->id;
        $email_type = 'winners_email';
        $current_datetime_db = date('Y-m-d H:i:s');

        $selected_emails = explode(',', $request->selected_emails);
        $lottery_id_rq = $request->lottery_id;

        $batch = array();
        foreach ($selected_emails as $key => $entry_id) {

            $result = DB::table('entries')
                ->select('entries.lottery_id', 'lotteries.title', 'lotteries.queing_process', 'entries.uid', 'entries.qr_code', 'lotteries.event_datetime', 'lotteries.header_image', 'entries.first_name', 'entries.last_name', 'entries.email', 'entries.guest_id', 'entries.has_parent', 'lottery_winners.sorting', 'e2.first_name as g_first_name', 'e2.last_name as g_last_name', 'l2.sorting as g_sorting', 'lotteries.country_code', 'lotteries.timezone')
                ->leftJoin('lotteries', 'entries.lottery_id', '=', 'lotteries.id')
                ->leftJoin('entries as e2', 'entries.guest_id', '=', 'e2.id')
                ->leftJoin('lottery_winners', 'entries.id', '=', 'lottery_winners.entry_id')
                ->leftJoin('lottery_winners as l2', 'entries.guest_id', '=', 'l2.entry_id')
                ->where('entries.id', '=', $entry_id)
                ->where('lotteries.user_id', '=', $normal_user)
                ->first();


            if ($result) {

                $row = $result;
                $email_address = $row->email;
                $title = $row->title;
                $countries = $row->title;
                $timezone = $row->title;

                $event_date = formatted_date($row->event_datetime);
                $c_logo = $row->header_image;

                $lottery_id = $row->lottery_id;
                $first_name = $row->first_name;
                $last_name = $row->last_name;
                $sorting = ($row->queing_process == 1) ? $row->sorting : '-';
                $uid = $row->uid;
                $qr_code = $row->qr_code;
                $guest_id = $row->guest_id;
                if ($guest_id == 0) {
                    $hide_guest = 'display: none';
                } else {
                    $hide_guest = '';
                }
                $has_parent = $row->has_parent;
                $g_first_name = $row->g_first_name;
                $g_last_name = $row->g_last_name;
                $g_sorting = ($row->queing_process == 1) ? $row->g_sorting : '-';

                $error = false;

                if ($error == false) {

                    $result3 = Email_Template::where('email_type', '=', 'winners_email')
                        ->where('user_id', '=', $normal_user)
                        ->where('lottery_id', '=', $lottery_id)
                        ->first();

                    if ($result3) {
                        $row3 = $result3;
                        $email_data = $row3->email_data;
                        if ($email_data != '') {
                            $email_data = unserialize($email_data);
                            $instructions = $email_data['instructions'];
                            $reminders = $email_data['reminders'];
                            $map_image = $email_data['map_image'];
                            $venue_link = $email_data['venue_link'];

                            if ($c_logo == '') {
                                $c_logo = '';
                            } else {
//                            $c_logo = "<img src=\"" . $website_url . "assets/images/media/" . $c_logo . "\" width=\"65\">";
                                $c_logo = "<img src=\"" .url('assets/images/media/'. $c_logo)  . "\" width=\"65\">";
                            }

                            $payload = array(
                                'From' => 'info@firstentry.net',
                                'To' => $email_address,
                                'Tag' => 'Winners email #' . $lottery_id,
                                'TemplateID' => '28860837',
                                'TemplateModel' => array(
                                    "website_url" => url('/'),
                                    "second_logo" => $c_logo,
                                    "winner_full_name" => $first_name . ' ' . $last_name,
                                    "company_name" => env('APP_NAME'),
                                    "event_title" => $title,
                                    "event_date" => $event_date,
                                    "winner_no" => $sorting,
                                    "winner_uid" => $uid,
                                    "qr_code_img" => url('assets/images/brand/'.$qr_code),
                                    "guest_hide" => $hide_guest,
                                    "guest_full_name" => $g_first_name . ' ' . $g_last_name,
                                    "guest_winner_no" => $g_sorting,
                                    "winner_instruction" => $instructions,
                                    "map_image" => url('assets/images/media/'.$map_image),
                                    "winner_reminders" => $reminders,
                                    "venue_link" => $venue_link,
                                    "company_address" => '',
                                    "receiver_email" => $email_address,
                                    "contact_support" => 'mailto:support@firstentry.net',
                                    "unsubscribe_hide" => '',
                                    "current_year" => date('Y'),
                                ),
                                'TrackOpens' => true,
                                'TrackLinks' => 'HtmlAndText',
                                'MessageStream' => 'broadcast'
                            );

                            $batch[] = $payload;
                        } else {
                            $output['success'] = false;
                            $output['msg'] = 'Email template empty.';
                        }
                    } else {
                        $output['success'] = false;
                        $output['msg'] = 'Email template empty.';
                    }

                }
            } else {
                $output['success'] = false;
                $output['msg'] = 'No data available.';
            }

        }
        if (sizeof($batch) > 0) {

            $output['success'] = true;
            $output['msg'] = 'Successfully emails sent. It can take up to a few minutes to deliver them all. Please be patient.';
            $response = send_email_batch_with_template($batch);

            $i = 0;
            foreach ($response as $key => $value) {
                $output['emails'][$selected_emails[$i]] = $value['errorcode'];
                $i++;
            }

            $emailHistory = new EmailsHistory();
            $emailHistory->user_id = $normal_user;
            $emailHistory->lottery_id = $lottery_id;
            $emailHistory->entry_id = $entry_id;
            $emailHistory->email_type = $email_type;
            $emailHistory->email_tag = "Winners email #$lottery_id";
            $emailHistory->updated_at = $current_datetime_db;
            $emailHistory->created_at = $current_datetime_db;
            $emailHistory->save();


        } else {
            $output['success'] = false;
            $output['msg'] = 'No emails selected.';
        }

        header('Content-Type: application/json; charset=utf-8');
        return response()->json($output);
        /*echo json_encode($output);*/
    }

    public function send_losers_emails(Request $request){

        $normal_user = auth()->user()->id;
        $email_type = 'losers_email';
        $current_datetime_db = date('Y-m-d H:i:s');

        $selected_emails = explode(',', $_POST['selected_emails']);
        $lottery_id_rq = $_POST['lottery_id'];


        $batch = array();
        foreach ($selected_emails as $key => $entry_id) {

            $result = DB::table('entries')
                ->select('entries.lottery_id', 'lotteries.title', 'lotteries.queing_process', 'entries.first_name', 'lotteries.event_datetime', 'entries.last_name', 'entries.email', 'lotteries.header_image', 'entries.guest_id', 'entries.has_parent', 'lottery_losers.sorting', 'e2.first_name as g_first_name', 'e2.last_name as g_last_name', 'l2.sorting as g_sorting')
                ->leftJoin('lotteries', 'entries.lottery_id', '=', 'lotteries.id')
                ->leftJoin('entries as e2', 'entries.guest_id', '=', 'e2.id')
                ->leftJoin('lottery_losers', 'entries.id', '=', 'lottery_losers.entry_id')
                ->leftJoin('lottery_losers as l2', 'entries.guest_id', '=', 'l2.entry_id')
                ->where('entries.id', '=', $entry_id)
                ->where(function($query) use ($normal_user) {
                    $query->where('lotteries.user_id', '=', $normal_user);
                })
                ->first();

            if($result){
                $row = $result;
                $email_address = $row->email;
                $event_date = formatted_date($row->event_datetime);
                $title = $row->title;
                $c_logo = $row->header_image;
                $lottery_id = $row->lottery_id;
                $first_name = $row->first_name;
                $last_name = $row->last_name;
                $sorting = ($row->queing_process == 1) ? $row->sorting : '-';
                $guest_id = $row->guest_id;
                $has_parent = $row->has_parent;
                $g_first_name = $row->g_first_name;
                $g_last_name = $row->g_last_name;
                $g_sorting = ($row->queing_process == 1) ? $row->g_sorting : '-';

                $error = false;

                if($error == false){

                    $result3 = Email_Template::where('email_type', '=', $email_type)
                        ->where('user_id', '=', $normal_user)
                        ->where('lottery_id', '=', $lottery_id)
                        ->first();

                    //dd($result3);

                    if($result3){
                        $row3 = $result3;
                        $email_data = $row3->email_data;
                        if($email_data != ''){
                            $email_data = unserialize($email_data);
                            $instructions = $email_data['instructions'];
                            $venue_link = $email_data['venue_link'];

                            if($c_logo == ''){
                                $c_logo = '';
                            }else{
//                                $c_logo = "<img src=\"".$website_url."assets/images/media/".$c_logo."\" width=\"65\">";
                                $c_logo = "<img src=\"" .url('assets/images/media/'. $c_logo)  . "\" width=\"65\">";
                            }

                            $payload = array(
                                'From' => 'info@firstentry.net',
                                'To' => $email_address,
                                'Tag' => 'Losers email #' . $lottery_id,
                                'TemplateID' => '28878045',
                                'TemplateModel' => array(
                                    "website_url" => url('/'),
                                    "second_logo" => $c_logo,
                                    "company_name" => env('APP_NAME'),
                                    "event_title" => $title,
                                    "event_date" => $event_date,
                                    "loser_full_name" => $first_name . ' ' . $last_name,
                                    "company_address" => '',
                                    "loser_instructions" => $instructions,
                                    "venue_link" => $venue_link,
                                    "receiver_email" => $email_address,
                                    "contact_support" => 'mailto:support@firstentry.net',
                                    "unsubscribe_hide" => '',
                                    "current_year" => date('Y'),
                                ),
                                'TrackOpens' => true,
                                'TrackLinks' => 'HtmlAndText',
                                'MessageStream' => 'broadcast'
                            );

                            $batch[] = $payload;

                        }else{
                            $output['success'] = false;
                            $output['msg'] = 'Email template empty.';
                        }
                    }else{
                        $output['success'] = false;
                        $output['msg'] = 'Email template empty.';
                    }

                }
            }else{
                $output['success'] = false;
                $output['msg'] = 'No data available.';
            }
        }

        if(sizeof($batch) > 0){

            $output['success'] = true;
            $output['msg'] = 'Successfully emails sent. It can take up to a few minutes to deliver them all. Please be patient.';
            $response = send_email_batch_with_template($batch);
            $i = 0;
            foreach($response as $key => $value){
                $output['emails'][$selected_emails[$i]] = $value['errorcode'];
                $i++;
            }

            $emailHistory = new EmailsHistory();
            $emailHistory->user_id = $normal_user;
            $emailHistory->lottery_id = $lottery_id;
            $emailHistory->entry_id = $entry_id;
            $emailHistory->email_type = $email_type;
            $emailHistory->email_tag = "Losers email #$lottery_id";
            $emailHistory->updated_at = $current_datetime_db;
            $emailHistory->created_at = $current_datetime_db;
            $emailHistory->save();


        }else{
            $output['success'] = false;
            $output['msg'] = 'No emails selected.';
        }

        header('Content-Type: application/json; charset=utf-8');
        return response()->json($output);

    }

    public function email_history(Request $request){

        $normal_user = auth()->user()->id;
        $current_datetime = now();

        $available_l = Lottery::where('user_id', $normal_user)
                    ->where('is_winners_selected', 1)
                    ->orderBy('title', 'asc')
                    ->get();

        $lottery_id = $request->lottery_id;
        $entries_type = $request->entries_type;
        $emails_history_f1 = [];

        if ($lottery_id > 0) {
            if ($entries_type == 'Winners') {
                $email_type = 'winners_email';
            } else if ($entries_type == 'Losers') {
                $email_type = 'losers_email';
            }

            $email_history = EmailsHistory::where('email_type', $email_type)
                ->where('lottery_id', $lottery_id)
                ->where('user_id', $normal_user)
                ->first();

            if ($email_history) {
                $email_tag = $email_history->email_tag;

                $client = new PostmarkClient('e22698e7-1778-41ea-bddc-c4442310a7b3');
                $emails_history_f1 = $client->getOutboundMessages($count = 100, $offset = 0, $recipient = NULL, $fromEmail = NULL, $tag = $email_tag, $subject = NULL, $status = NULL, $fromdate = NULL, $todate = NULL, $metadata = NULL, $messagestream = NULL);
                //dd($emails_history_f1['Messages']);
            }
        }

        return view('dashboard.user.email_history',compact('available_l','emails_history_f1'));
    }

    public function see_analytics(Request $request){

        $message_id = $request->input('message_id');

        // Get message details using API client
        $client = new PostmarkClient('e22698e7-1778-41ea-bddc-c4442310a7b3');
        $response = $client->getOutboundMessageDetails($message_id);

        $html_body = '';
        $message_events = '';
        foreach ($response as $key => $value) {
            if(strtolower($key) == 'recipients'){
                $html_body .= '<div style="width: 50%;float: left;" class="mb-2">To:</div><div style="width: 50%;float: left;" class="mb-2">' . $value[0] . '</div>';
            }
            if(strtolower($key) == 'tag'){
                $html_body .= '<div style="width: 50%;float: left;" class="mb-2">Tag:</div><div style="width: 50%;float: left;" class="mb-2">' . $value . '</div>';
            }
            if(strtolower($key) == 'status'){
                $html_body .= '<div style="width: 50%;float: left;" class="mb-2">Status:</div><div style="width: 50%;float: left;" class="mb-2">' . $value . '</div>';
            }
            if(strtolower($key) == 'messageevents'){
                foreach ($value as $key2 => $value2) {
                    if($value2['type'] == 'Transient'){
                        $message_events .= '<div class="badge rounded-pill me-1 bg-default">' . $value2['type'] . '</div>';
                    }
                    if($value2['type'] == 'Delivered'){
                        $message_events .= '<div class="badge rounded-pill me-1 bg-success">' . $value2['type'] . '</div>';
                    }
                    if($value2['type'] == 'Bounced'){
                        $message_events .= '<div class="badge rounded-pill me-1 bg-danger">' . $value2['type'] . '</div>';
                    }
                    if($value2['type'] == 'Opened'){
                        $message_events .= '<div class="badge rounded-pill me-1 bg-primary">' . $value2['type'] . '</div>';
                    }
                    if($value2['type'] == 'LinkClicked'){
                        $message_events .= '<div class="badge rounded-pill me-1 bg-info">' . $value2['type'] . '</div>';
                    }

                }
                $html_body .= '<div style="width: 50%;float: left;" class="mb-2">Message Events:</div><div style="width: 50%;float: left;" class="mb-2">' . $message_events . '</div>';
            }
        }
        if($html_body == ''){
            echo 'No data available.';
        }else{
            echo $html_body;
        }

    }
}






































