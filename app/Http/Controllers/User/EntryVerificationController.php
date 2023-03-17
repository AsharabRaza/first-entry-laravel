<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Lottery_Winner;
use Illuminate\Http\Request;
use App\Models\Entry;
use App\Models\Lottery_Agent;

class EntryVerificationController extends Controller
{
    public function entry_verification(Request $request){
        return view('dashboard.user.entry_verification');
    }
    public function entry_confirmation(Request $request){

        $entry_id = $request->input('entry_id');
        $submit_type = $request->input('submit_type');

        if ($submit_type == 'Manual') {
            $submit_type = 'manual_search';
            $submit_type_nicename = 'Manual search';
        } else if ($submit_type == 'Scan QR Code') {
            $submit_type = 'scan_qr_code';
            $submit_type_nicename = 'Scan QR Code';
        }

        $normal_user = auth()->user()->id;
        $current_datetime = now();

        $entry = Entry::find($entry_id);

        if ($entry) {
            $entry->entry_confirmed = true;
            $entry->entry_confirmed_by = $normal_user;
            $entry->entry_confirmed_by_type = $submit_type;
            $entry->entry_confirmed_by_type_nicename = $submit_type_nicename;
            $entry->entry_confirmed_datetime = $current_datetime;

            if ($entry->save()) {
                $output = [
                    'success' => true,
                    'msg' => 'Successfully entry confirmed.'
                ];
            } else {
                $output = [
                    'success' => false,
                    'msg' => 'Something went wrong. Please try again later.'
                ];
            }
        } else {
            $output = [
                'success' => false,
                'msg' => 'Entry not found.'
            ];
        }

        return response()->json($output);


    }

    public function get_uid_entries(Request $request){

        $uid = request()->input('uid');
        $user_type = auth()->user()->user_type;
        $normal_user = auth()->user()->id;

        $result = Entry::select('entries.*', 'lotteries.scan_start_datetime', 'lotteries.scan_end_datetime', 'entries.id as entry_id', 'lotteries.title', 'lotteries.allow_guest',
            'lotteries.is_winners_selected', 'lotteries.start_datetime', 'lotteries.end_datetime',
            'lotteries.event_datetime', 'lotteries.status as lottery_status', 'lottery_winners.id as winners_id', 'lottery_winners.sorting as winners_no',
            'lottery_losers.id as losers_id', 'lotteries.user_id', 'lotteries.id as lottery_id')
            ->leftJoin('lotteries', 'entries.lottery_id', '=', 'lotteries.id')
            ->leftJoin('lottery_winners', 'entries.id', '=', 'lottery_winners.entry_id')
            ->leftJoin('lottery_losers', 'entries.id', '=', 'lottery_losers.entry_id')
            ->where('entries.uid', $uid)
            ->first();

        //dd($result);

        $current_timestamp = time();

        $error = true;
        if($result){
            $row = $result;

            if($user_type == 1){
                if($row->user_id == $normal_user){
                    $error = false;
                }else{
                    $error = true;
                }
            }
            else if($user_type == 2){

                $result_check_agent = Lottery_Agent::where('lottery_id', $row->lottery_id)
                    ->where('agent_id', $normal_user)
                    ->value('agent_id');

                if($result_check_agent && $row->lottery_status == 1){
                    $error = false;
                }else{
                    $error = true;
                }
            }

            if($error == false){
                $output['title'] = $row->title;
                $output['queing_option'] = $row->queing_option;
                $output['entry_id'] = $row->entry_id;
                $output['result_uid'] = '<span class="badge bg-info">'.$row->uid.'</span>';

                if($row->allow_guest == 1){
                    $output['guest'] = '<span class="badge bg-primary">Allow</span>';
                }else if($row->allow_guest == 0){
                    $output['guest'] = '<span class="badge bg-default">Disallow</span>';
                }

                $output['is_winners_selected'] = $row->is_winners_selected;
                $output['start_datetime'] = formatted_date($row->start_datetime);
                $output['end_datetime'] = formatted_date($row->end_datetime);
                $output['event_datetime'] = formatted_date($row->event_datetime);

                if(date('Ymd') == date('Ymd', strtotime($row->event_datetime))){
                    $output['event_datetime'] .= '<span class="badge rounded-pill bg-info-gradient" style="margin-left: 5px;font-weight: bold;">TODAY</span>';
                }


                if($row->winners_id > 0){
                    $output['is_winner'] = '<span class="badge bg-success-gradient">Winner</span>';
                }

                if($row->winners_no > 0){
                    $output['winners_no'] = $row->winners_no;
                }

                if($row->losers_id > 0){
                    $output['is_winner'] = '<span class="badge bg-danger-gradient">Loser</span>';
                }

                if(empty($output['is_winner']) || $output['is_winner'] == null){
                    $output['is_winner'] = '<span class="badge bg-default">No selection yet.</span>';
                }

                $output['first_name'] = $row->first_name;
                $output['last_name'] = $row->last_name;
                $output['email'] = $row->email;
                $output['phone'] = $row->phone;
                $output['date_created'] = formatted_date($row->date_created);

                if($row->guest_id > 0){
                    $output['bring_guest'] = '<span class="badge bg-primary">Yes</span>';

                    $result2 = Entry::where('id',$row->guest_id)->first();
                    if($result2 == true){
                        $row2 = $result2->fetch_object();
                        $output['g_first_name'] = $row2->first_name;
                        $output['g_last_name'] = $row2->last_name;

                        if($row->winners_id > 0){

                            $result3 = Lottery_Winner::where('entry_id',$row2->id)->first();
                            if($result3){
                                $row3 = $result3;
                                $output['g_winner_no'] = $row3->sorting;
                            }
                        }
                    }
                }else{
                    $output['bring_guest'] = '<span class="badge bg-default">No</span>';
                }

                if($row->entry_confirmed == 1){
                    $output['entry_confirmed'] = $row->entry_confirmed;
                    $output['entry_confirmed_datetime'] = formatted_date($row->entry_confirmed_datetime);
                }

                $output['success'] = true;
                $output['msg'] = '1 result found.';
            }else{
                $output['success'] = false;
                $output['msg'] = 'No entry found with that UID.';
            }



        }else{
            $output['success'] = false;
            $output['msg'] = 'No entry found with that UID.';
        }

        return response()->json($output);

    }
}
