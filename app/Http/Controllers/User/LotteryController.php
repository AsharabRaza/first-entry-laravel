<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\EventLottery;
use App\Models\Lottery;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Torann\GeoIP\Facades\GeoIP;
use Torann\GeoIP\Location;
use Carbon\Carbon;
use App\Models\Email_Template;
use App\Models\Lottery_Agent;
use App\Models\Entry;
use App\Models\Lottery_Winner;
use App\Models\Lottery_Losser;



class LotteryController extends Controller
{

    public function all_lotteries(Request $request){

        get_lotteries_winners_losers();

//        expireStatus();

        $this->data['lotteries'] = DB::table('lotteries')
            ->leftJoin('lottery_agents', 'lotteries.id', '=', 'lottery_agents.lottery_id')
            ->leftJoin('users', 'lottery_agents.agent_id', '=', 'users.id')
            ->select('lotteries.*', DB::raw("GROUP_CONCAT(' ', CONCAT(users.first_name, ' ', users.last_name)) AS lottery_agents"),
                DB::raw("(SELECT COUNT(entries.id) FROM entries WHERE lotteries.id = entries.lottery_id) AS selected_total_entries"),
                DB::raw("(SELECT COUNT(lottery_winners.id) FROM lottery_winners WHERE lotteries.id = lottery_winners.lottery_id) AS selected_total_winners"),
                DB::raw("(SELECT COUNT(lottery_losers.id) FROM lottery_losers WHERE lotteries.id = lottery_losers.lottery_id) AS selected_total_losers"))
            ->where('lotteries.user_id', auth()->user()->id)
            ->groupBy('lotteries.id')
            ->orderByDesc('lotteries.updated_at')
            ->paginate(15);

        //dd($result);

        return view('dashboard.user.all_lotteries')->with(['data'=>$this->data]);
    }

    public function add_lottery(Request $request)
    {

        if ($request->isMethod('post')) {

            if ($request->has('lottery_images_upload')) {

                if ($request->hasFile('lottery_logo')) {
                    $tmp_img = $request->file('lottery_logo')->getClientOriginalName();
                    $extention = $request->file('lottery_logo')->getClientOriginalExtension();
                    $r = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1, 15))), 1, 15);
                    $file_name = $r . '.' . $extention;
                    if($request->file('lottery_logo')->move(public_path('assets/images/media/'), $file_name)){
                        $output['success'] = true;
                        $output['lottery_logo'] = $file_name;
                        $output['msg'] = 'Image uploaded.';
                    }else {
                        $output['success'] = false;
                        $output['msg'] = 'Failed to upload image.';
                    }
                }

                if ($request->hasFile('lottery_background_image')) {
                    $tmp_img = $request->file('lottery_background_image')->getClientOriginalName();
                    $extention = $request->file('lottery_background_image')->getClientOriginalExtension();
                    $r = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1, 15))), 1, 15);
                    $file_name = $r . '.' . $extention;
                    if($request->file('lottery_background_image')->move(public_path('assets/images/media/'), $file_name)){
                        $output['success'] = true;
                        $output['lottery_background_image'] = $file_name;
                        $output['msg'] = 'Image uploaded.';
                    }else{
                        $output['success'] = false;
                        $output['msg'] = 'Failed to upload image.';
                    }

                }

                return response()->json($output);

            }



            //$request = json_decode(request()->getContent(), true);
            $data = request()->json()->all();
            if ($data[0]['POST'] == 'true') {
                if ($data[0]['add_lottery'] == 'true') {

                    $normal_user = auth()->user()->id;
                    $remaining_events = getRemainingUserEvents($normal_user);

                    if ($remaining_events > 0) {

                            //$timezone = 'America/New_York';
                            $timezone = config('app.timezone');
                            $lottery_url = $data[0]['lottery_url'];
                            $lottery_title = $data[0]['lottery_title'];
                            $lottery_logo = $data[0]['lottery_logo'];
                            $lottery_background_image = $data[0]['lottery_background_image'];
                            $number_of_winners = $data[0]['number_of_winners'];
                            $allow_guest = $data[0]['allow_guest'];

                            $start_date = $data[0]['start_date'];
                            $start_time = $data[0]['start_time'];
                            $start_datetime = date('Y-m-d H:i', strtotime($start_date . $start_time));

                            $event_date = $data[0]['event_date'];
                            $event_time = $data[0]['event_time'];
                            $event_datetime = date('Y-m-d H:i', strtotime($event_date . $event_time));

                            $end_date = $data[0]['end_date'];
                            $end_time = $data[0]['end_time'];
                            $end_datetime = date('Y-m-d H:i', strtotime($end_date . $end_time));


                            $start_datetime_utc = convert_timezone($start_datetime, $data[0]['timezone'], 'UTC', 'Y-m-d H:i');
                            $end_datetime_utc = convert_timezone($end_datetime, $data[0]['timezone'], 'UTC', 'Y-m-d H:i');

                            $description = serialize($data[1]);
                            $how_it_works = serialize($data[2]);
                            $terms_conditions = serialize($data[3]);

                            $country_code = $data[0]['country_code'];
                            $lott_timezone = $data[0]['timezone'];
                            $scanning_option = $data[0]['scanning_option'];
                            $queing_process = $data[0]['queing_process'];



                            //$current_datetime = date('Y-m-d H:i:s');

                            $get_lottery_id = DB::table('lotteries')->insertGetId([
                                'user_id' => $normal_user,
                                'lottery_url' => $lottery_url,
                                'title' => $lottery_title,
                                'header_image' => $lottery_logo,
                                'background_image' => $lottery_background_image,
                                'total_winners' => $number_of_winners,
                                'start_datetime' => $start_datetime,
                                'event_datetime' => $event_datetime,
                                'allow_guest' => $allow_guest,
                                'end_datetime' => $end_datetime,
                                'start_datetime_utc' => $start_datetime_utc,
                                'end_datetime_utc' => $end_datetime_utc,
                                'description' => $description,
                                'how_it_works' => $how_it_works,
                                'terms_conditions' => $terms_conditions,
                                'country_code' => $country_code,
                                'timezone' => $lott_timezone,
                                'scanning_option' => $scanning_option,
                                'queing_process' => $queing_process,
                                //'date_created' => $current_datetime,
                                //'last_updated' => $current_datetime,
                            ]);


                            if ($get_lottery_id) {
                                $new_lottery_id = $get_lottery_id;
                                $output['lottery_id'] = $new_lottery_id;
                                $output['url'] = route('user.edit-lottery', ['id' => $new_lottery_id, 'edit_tab' => 2]);
                                $output['success'] = true;
                                $output['msg'] = 'A new lottery successfully created. Redirecting...';

                                $current_datetime_db = Carbon::now();
                                $current_datetime = Carbon::now()->format('d-m-Y h:i A');
                                $last_updated = Carbon::now()->format('d-m-Y h:i A');
                                $email_data = ['instructions' => '', 'reminders' => '', 'map_image' => '', 'venue_link' => ''];
                                $email_data_s = serialize($email_data);
                                //$email_data_s = $email_data;

                                $email_template = new Email_Template();
                                $email_template->lottery_id = $new_lottery_id;
                                $email_template->user_id = $normal_user;
                                $email_template->email_type = 'winners_email';
                                $email_template->email_data = $email_data_s;
                                //$email_template->last_updated = $current_datetime_db;
                                //$email_template->date_created = $current_datetime_db;

                               // dd($email_template);

                                $email_template_data = $email_template->save();


                                if ($email_template_data == false) {
                                    $output['success'] = false;
                                    $output['msg'] = 'Something went wrong. Please try again later.';
                                }
                            } else {
                                $output['success'] = false;
                                $output['msg'] = 'Something went wrong. Please try again later.';
                            }
                        }else {
                            $output['success'] = false;
                            $output['msg'] = 'You already exceeded your event creation limit.';
                        }
                    return response()->json($output);

                }
            }

        }
        else {

            $dup_row = [];

            if ($request->has('duplicate_id')) {
                $lottery_id = $request->duplicate_id;
                $lottery_id = base64_decode($lottery_id);
                $dup_row = Lottery::find($lottery_id);

            }

            $this->data['remaining_events'] = getRemainingUserEvents(auth()->user()->id);

            return view('dashboard.user.add_lottery',compact('dup_row'))->with(['data' => $this->data]);

        }
    }

    public function edit_lottery(Request $request){

        $lottery_id = request()->input('id');
        $result = Lottery::leftJoin('lottery_agents', 'lotteries.id', '=', 'lottery_agents.lottery_id')
            ->select('lotteries.*', DB::raw('GROUP_CONCAT(agent_id) as agent_ids'))
            ->where('lotteries.id', '=', $lottery_id)
            ->groupBy('lotteries.id')
            ->first();

        if ($result != null) {
            $current_datetime = date('d-m-Y h:i A');
            $this->data['lottery_url'] = $result->lottery_url;
            $this->data['old_lottery_agents'] = $result->agent_ids;
            $this->data['country_code'] = $result->country_code;
            $this->data['lott_timezone'] = $result->timezone;
            $this->data['title'] = $result->title;
            $this->data['lottery_logo'] = $result->header_image;
            $this->data['lottery_background_image'] = $result->background_image;
            $this->data['total_winners'] = $result->total_winners;
            $this->data['allow_guest'] = $result->allow_guest;
            $this->data['form_customization'] = unserialize($result->form_customization);
            $this->data['lottery_status'] = $result->status;
            $this->data['scanning_option'] = $result->scanning_option;
            $this->data['queing_process'] = $result->queing_process;

            $this->data['start_date'] = date('d-m-Y', strtotime($result->start_datetime));
            $this->data['start_time'] = date('h:i A', strtotime($result->start_datetime));

            $this->data['end_date'] = date('d-m-Y', strtotime($result->end_datetime));
            $this->data['end_time'] = date('h:i A', strtotime($result->end_datetime));

            $this->data['event_date'] = date('d-m-Y', strtotime($result->event_datetime));
            $this->data['event_time'] = date('h:i A', strtotime($result->event_datetime));

            $this->data['scan_start_date'] = !empty($result->scan_start_datetime) ? date('d-m-Y', strtotime($result->scan_start_datetime)) : null;
            $this->data['scan_start_time'] = !empty($result->scan_start_datetime) ? date('h:i A', strtotime($result->scan_start_datetime)) : null;

            $this->data['scan_end_date'] = !empty($result->scan_end_datetime) ? date('d-m-Y', strtotime($result->scan_end_datetime)) : null;
            $this->data['scan_end_time'] = !empty($result->scan_end_datetime) ? date('h:i A', strtotime($result->scan_end_datetime)) : null;

            $date_created = date('d-m-Y h:i A', strtotime($result->created_at));

            $description = $result->description;
            $this->data['description'] = unserialize($description);

            $how_it_works = $result->how_it_works;
            $this->data['how_it_works'] = unserialize($how_it_works);

            $terms_conditions = $result->terms_conditions;
            $this->data['terms_conditions'] = unserialize($terms_conditions);

        } else {
            return redirect()->route('user.all-lotteries');
        }

        $normal_user = auth()->user()->id;
        $email_template = Email_Template::where('email_type', 'winners_email')
            ->where('lottery_id', $lottery_id)
            ->where('user_id', $normal_user)
            ->first();


        if ($email_template != null) {
            $current_datetime = date('d-m-Y h:i A');
            $last_updated = date('d-m-Y h:i A', strtotime($email_template->updated_at));

            $email_data = $email_template->email_data;
            if ($email_data != '') {
                //dd($email_data);
                $email_data = unserialize($email_data);
                $this->data['winners_emails_instructions'] = $email_data['instructions'];
                $this->data['winners_emails_reminders'] = $email_data['reminders'];
                $this->data['winners_emails_map_image'] = $email_data['map_image'];
                $this->data['winners_emails_venue_link'] = $email_data['venue_link'];
            } else {
                $this->data['winners_emails_instructions'] = '';
                $this->data['winners_emails_reminders'] = '';
                $this->data['winners_emails_map_image'] = '';
                $this->data['winners_emails_venue_link'] = '';
            }
        } else {
            $current_datetime_db = now();
            $current_datetime = date('d-m-Y h:i A');
            $last_updated = date('d-m-Y h:i A');
            $email_data = ['instructions' => '', 'reminders' => '', 'map_image' => '', 'venue_link' => ''];
            $email_data_s = serialize($email_data);

            $email_template = new Email_Template();
            $email_template->lottery_id = $lottery_id;
            $email_template->user_id = $normal_user;
            $email_template->email_type = 'winners_email';
            $email_template->email_data = $email_data_s;
            $email_template->updated_at = $current_datetime_db;
            $email_template->created_at = $current_datetime_db;

            $created = $email_template->save();
            if (!$created) {
                echo '<div class="alert alert-danger">Something went wrong, please try again later.</div>';
            } else {
                $this->data['winners_emails_instructions'] = '';
                $this->data['winners_emails_reminders'] = '';
                $this->data['winners_emails_map_image'] = '';
                $this->data['winners_emails_venue_link'] = '';
            }
        }


        $email_template = Email_Template::where('email_type', 'losers_email')
            ->where('lottery_id', $lottery_id)
            ->where('user_id', $normal_user)
            ->first();

        if ($email_template != null) {
            $current_datetime = date('d-m-Y h:i A');
            $last_updated = date('d-m-Y h:i A', strtotime($email_template->updated_at));

            $email_data = $email_template->email_data;
            if ($email_data != '') {
                $email_data = unserialize($email_data);
                $this->data['losers_emails_instructions'] = $email_data['instructions'];
                $this->data['losers_emails_venue_link'] = $email_data['venue_link'];
            } else {
                $this->data['losers_emails_instructions'] = '';
                $this->data['losers_emails_venue_link'] = '';
            }
        } else {
            $current_datetime_db = now();
            $current_datetime = date('d-m-Y h:i A');
            $last_updated = date('d-m-Y h:i A');
            $email_data = ['instructions' => '', 'venue_link' => ''];
            $email_data_s = serialize($email_data);

            $email_template = new Email_Template;
            $email_template->lottery_id = $lottery_id;
            $email_template->user_id = $normal_user;
            $email_template->email_type = 'losers_email';
            $email_template->email_data = $email_data_s;
            $email_template->updated_at = $current_datetime_db;
            $email_template->created_at = $current_datetime_db;

            $created = $email_template->save();
            if (!$created) {
                echo '<div class="alert alert-danger">Something went wrong, please try again later.</div>';
            } else {
                $this->data['losers_emails_instructions'] = '';
                $this->data['losers_emails_venue_link'] = '';
            }
        }

        $this->data['lottery_id'] = $lottery_id;

        $this->data['users'] = User::select('id', 'first_name', 'last_name')
            ->where('user_type', 2)
            ->where('created_by', $normal_user)
            ->orderBy('id', 'DESC')
            ->get();
        $this->data['old_lottery_agents_array'] = explode(',', $this->data['old_lottery_agents']);

        return view('dashboard.user.edit_lottery',['data'=>$this->data]);

    }

    public function edit_lottery_details(Request $request){

        if ($request->has('lottery_images_upload')) {


            if ($request->hasFile('lottery_logo')) {
                $tmp_img = $request->file('lottery_logo')->getClientOriginalName();
                $extention = $request->file('lottery_logo')->getClientOriginalExtension();
                $r = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1, 15))), 1, 15);
                $file_name = $r . '.' . $extention;
                if($request->file('lottery_logo')->move(public_path('assets/images/media/'), $file_name)){
                    $output['success'] = true;
                    $output['lottery_logo'] = $file_name;
                    $output['msg'] = 'Image uploaded.';
                }else {
                    $output['success'] = false;
                    $output['msg'] = 'Failed to upload image.';
                }
            }

            if ($request->hasFile('lottery_background_image')) {
                $tmp_img = $request->file('lottery_background_image')->getClientOriginalName();
                $extention = $request->file('lottery_background_image')->getClientOriginalExtension();
                $r = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1, 15))), 1, 15);
                $file_name = $r . '.' . $extention;
                if($request->file('lottery_background_image')->move(public_path('assets/images/media/'), $file_name)){
                    $output['success'] = true;
                    $output['lottery_background_image'] = $file_name;
                    $output['msg'] = 'Image uploaded.';
                }else{
                    $output['success'] = false;
                    $output['msg'] = 'Failed to upload image.';
                }

            }

            return response()->json($output);

        }

        $requestData = $request->json()->all();
        if ($requestData[0]['edit_lottery'] == 'true') {
            //$timezone = 'America/New_York';
            $timezone = config('app.timezone');
            $normal_user = auth()->user()->id;
            $lottery_id = $requestData[0]['lottery_id'];

            $lottery_url = $requestData[0]['lottery_url'];
            $lottery_title = $requestData[0]['lottery_title'];
            $number_of_winners = $requestData[0]['number_of_winners'];
            $allow_guest = $requestData[0]['allow_guest'];

            $start_date = $requestData[0]['start_date'];
            $start_time = $requestData[0]['start_time'];
            $start_datetime = date('Y-m-d H:i', strtotime($start_date . $start_time));

            $event_date = $requestData[0]['event_date'];
            $event_time = $requestData[0]['event_time'];
            $event_datetime = date('Y-m-d H:i', strtotime($event_date . $event_time));

            $end_date = $requestData[0]['end_date'];
            $end_time = $requestData[0]['end_time'];
            $end_datetime = date('Y-m-d H:i', strtotime($end_date . $end_time));

            $start_datetime_utc = convert_timezone($start_datetime, $requestData[0]['timezone'], 'UTC', 'Y-m-d H:i');
            $end_datetime_utc = convert_timezone($end_datetime, $requestData[0]['timezone'], 'UTC', 'Y-m-d H:i');

            $description = serialize($requestData[1]);
            $how_it_works = serialize($requestData[2]);
            $terms_conditions = serialize($requestData[3]);

            $country_code = $requestData[0]['country_code'];
            $lott_timezone = $requestData[0]['timezone'];
            $scanning_option = $requestData[0]['scanning_option'];
            $queing_process = $requestData[0]['queing_process'];

            $current_datetime = date('Y-m-d H:i:s');

            $lottery = new Lottery;

            $data = [
                'lottery_url' => $lottery_url,
                'title' => $lottery_title,
                'total_winners' => $number_of_winners,
                'start_datetime' => $start_datetime,
                'event_datetime' => $event_datetime,
                'allow_guest' => $allow_guest,
                'end_datetime' => $end_datetime,
                'start_datetime_utc' => $start_datetime_utc,
                'end_datetime_utc' => $end_datetime_utc,
                'description' => $description,
                'how_it_works' => $how_it_works,
                'terms_conditions' => $terms_conditions,
                'country_code' => $country_code,
                'timezone' => $lott_timezone,
                'scanning_option' => $scanning_option,
                'queing_process' => $queing_process,
                'updated_at' => $current_datetime,
            ];


            if (isset($requestData[0]['lottery_logo'])) {
                $lottery_logo = $requestData[0]['lottery_logo'];
                //$lottery->header_image = $lottery_logo;
                $data['header_image'] = $lottery_logo;
            }

            if (isset($requestData[0]['lottery_background_image'])) {
                $lottery_background_image = $requestData[0]['lottery_background_image'];
//              $lottery->background_image = $lottery_background_image;
                $data['background_image'] = $lottery_background_image;
            }

            $result = $lottery->where('user_id', $normal_user)
                ->where('id', $lottery_id)
                ->update($data);

            if ($result == true) {
                $output['success'] = true;
                $output['url'] = route('user.edit-lottery', ['id' => $lottery_id, 'edit_tab' => 2]);
                $output['msg'] = 'Lottery successfully updated. Redirecting...';
            } else {
                $output['success'] = false;
                $output['msg'] = 'Something went wrong. Please try again later.';
            }

            return response()->json($output);
        }



    }

    public function delete_lottery(Request $request){

        $request_id = request('request_id');
        $current_datetime = date('Y-m-d H:i:s');
        $output = array();

        if (Email_Template::where('lottery_id', $request_id)->delete()) {
            $output['success'] = true;
            $output['msg'] = 'Lottery successfully removed. Reloading...';
        } else {
            $output['success'] = false;
            $output['msg'] = 'Something went wrong. Please try again later.';
        }

        if (Lottery_Winner::where('lottery_id', $request_id)->delete()) {
            $output['success'] = true;
            $output['msg'] = 'Lottery successfully removed. Reloading...';
        } else {
            $output['success'] = false;
            $output['msg'] = 'Something went wrong. Please try again later.';
        }

        if (Lottery_Losser::where('lottery_id', $request_id)->delete()) {
            $output['success'] = true;
            $output['msg'] = 'Lottery successfully removed. Reloading...';
        } else {
            $output['success'] = false;
            $output['msg'] = 'Something went wrong. Please try again later.';
        }

        if (Lottery_Agent::where('lottery_id', $request_id)->delete()) {
            $output['success'] = true;
            $output['msg'] = 'Lottery successfully removed. Reloading...';
        } else {
            $output['success'] = false;
            $output['msg'] = 'Something went wrong. Please try again later.';
        }


        if (Entry::where('lottery_id', $request_id)->delete()) {
            $output['success'] = true;
            $output['msg'] = 'Lottery successfully removed. Reloading...';
        } else {
            $output['success'] = false;
            $output['msg'] = 'Something went wrong. Please try again later.';
        }

        if (EventLottery::where('lottery_id', $request_id)->delete()) {
            $output['success'] = true;
            $output['msg'] = 'Lottery successfully removed. Reloading...';
        } else {
            $output['success'] = false;
            $output['msg'] = 'Something went wrong. Please try again later.';
        }

        if (Lottery::where('id', $request_id)->delete()) {
            $output['success'] = true;
            $output['msg'] = 'Lottery successfully removed. Reloading...';
        } else {
            $output['success'] = false;
            $output['msg'] = 'Something went wrong. Please try again later.';
        }

        return response()->json($output);

    }

    public function customization_form(Request $request){

        $lottery_id = $request->input('cus_lottery_id');
        $customization_values = serialize(json_decode($request->input('customization_values'), true));
        $normal_user = auth()->user()->id;
        $current_datetime = date('Y-m-d H:i:s');

        $lottery = Lottery::where('user_id', $normal_user)->where('id', $lottery_id)->first();
        if ($lottery) {
            $lottery->form_customization = $customization_values;
            $lottery->updated_at = $current_datetime;
            $lottery->save();

            $output['success'] = true;
            $output['msg'] = 'Successfully form customization updated. Redirecting...';
        } else {
            $output['success'] = false;
            $output['msg'] = 'Something went wrong. Please try again later.';
        }

        return response()->json($output);
    }

    public function modify_emails(Request $request){

        $output = [];
        if ($request->has('map_image_upload')) {

            if ($request->hasFile('map_image')) {
                $file = $request->file('map_image');

                $extension = $file->getClientOriginalExtension();
                $r = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1,15))), 1, 15);
                $file_name = $r . '.' . $extension;

//                if ($file->storeAs('assets/images/media', $file_name)) {
                if ($file->move(public_path('assets/images/media/'), $file_name)) {
                    $output['success'] = true;
                    $output['msg'] = $file_name;
                } else {
                    $output['success'] = false;
                    $output['msg'] = 'Failed to upload map image.';
                }
            } else {
                $output['success'] = false;
                $output['msg'] = 'No map image found.';
            }

            return response()->json($output);

        }


        $requestArray = json_decode($request->getContent(), true);
        if ( isset($requestArray[0]['update_winners_emails']) && $requestArray[0]['update_winners_emails'] == 'true') {
            $normal_user = auth()->user()->id;
            $email_type = 'winners_email';
            $current_datetime_db = date('Y-m-d H:i:s');

            $lottery_id = $requestArray[0]['lottery_id'];
            $map_image = $requestArray[0]['map_image'];
            $venue_link = $requestArray[0]['venue_link'];

            $instructions = $requestArray[1];
            $reminders = $requestArray[2];

            $email_data = array('instructions' => $instructions, 'reminders' => $reminders, 'map_image' => $map_image, 'venue_link' => $venue_link);
            $email_data_s = serialize($email_data);

            $result = Email_Template::where('email_type', $email_type)
                ->where('lottery_id', $lottery_id)
                ->where('user_id', $normal_user)
                ->update(['email_data' => $email_data_s, 'updated_at' => $current_datetime_db]);

            if ($result == true) {
                $output['success'] = true;
                $output['msg'] = 'Winners email template successfully updated. Redirecting...';
            } else {
                $output['success'] = false;
                $output['msg'] = 'Something went wrong. Please try again later.';
            }

            return response()->json($output);
        }

        $requestData = $request->all();
        if ($requestData[0]['update_losers_emails'] == 'true') {
            $normal_user = auth()->user()->id;
            $email_type = 'losers_email';
            $current_datetime_db = now()->toDateTimeString();
            $lottery_id = $requestData[0]['lottery_id'];
            $venue_link = $requestData[0]['venue_link'];
            $instructions = $requestData[1];
            $email_data = array('instructions' => $instructions, 'venue_link' => $venue_link);
            $email_data_s = serialize($email_data);

            $result = Email_Template::where('email_type', '=', $email_type)
                ->where('lottery_id', '=', $lottery_id)
                ->where('user_id', '=', $normal_user)
                ->update([
                    'email_data' => $email_data_s,
                    'updated_at' => $current_datetime_db,
                ]);

            if ($result) {
                $output['success'] = true;
                $output['msg'] = 'Losers email template successfully updated. Redirecting...';
            } else {
                $output['success'] = false;
                $output['msg'] = 'Something went wrong. Please try again later.';
            }
            return response()->json($output);
        }






    }

    public function check_lottery_url(Request $request){

        $lottery_url = request('lottery_url');
        $id = request('not');

        $query = DB::table('lotteries')->where('lottery_url', $lottery_url);
        if ($id && $id != '') {
            $query->where('id', '!=', $id);
        }

        $result = $query->first();

        if ($result) {
            $output['success'] = false;
            $output['msg'] = 'That URL is not available.';
        } else {
            $output['success'] = true;
            $output['msg'] = 'Available.';
        }

        return response()->json($output);
    }

    public function get_country_timezone(Request $request){

        $country_code = $request->country_code;
        $timezones = \DateTimeZone::listIdentifiers(\DateTimeZone::PER_COUNTRY, $country_code);
        return response()->json($timezones);
    }

    public function update_lottery_agents_details(Request $request){

        $request = Request::capture();
        $normal_user = auth()->user()->id;
        $lottery_id = $request->input('lottery_id');

        $scan_start_date = $request->input('scan_start_date');
        $scan_start_time = $request->input('scan_start_time');
        $scan_start_datetime = date('Y-m-d H:i', strtotime($scan_start_date . $scan_start_time));

        $scan_end_date = $request->input('scan_end_date');
        $scan_end_time = $request->input('scan_end_time');
        $scan_end_datetime = date('Y-m-d H:i', strtotime($scan_end_date . $scan_end_time));

        $lottery_agents = $request->input('lottery_agents');
        $old_lottery_agents = $request->input('old_lottery_agents');
        if (!empty($old_lottery_agents)) {
            $old_lottery_agents = explode(',', $old_lottery_agents);
        } else {
            $old_lottery_agents = [];
        }

        $lottery_status = (int)$request->input('lottery_status');

        $current_datetime = date('Y-m-d H:i:s');

        $result = Lottery::where('user_id', '=', $normal_user)
            ->where('id', '=', $lottery_id)
            ->update([
                'status' => $lottery_status,
                'scan_start_datetime' => $scan_start_datetime,
                'scan_end_datetime' => $scan_end_datetime
            ]);

        // Adding lottery agents
        $add_lottery_agents = array_diff($lottery_agents, $old_lottery_agents);
        $remove_lottery_agents = array_diff($old_lottery_agents, $lottery_agents);

        foreach ($add_lottery_agents as $lott_agent_id) {
            Lottery_Agent::create([
                'lottery_id' => $lottery_id,
                'agent_id' => $lott_agent_id
            ]);
        }

        if (!empty($remove_lottery_agents)) {
            Lottery_Agent::where('lottery_id', '=', $lottery_id)
                ->whereIn('agent_id', $remove_lottery_agents)
                ->delete();
        }

        if ($result == true) {
            $output['success'] = true;
            $output['msg'] = 'Lottery agent section successfully updated. Redirecting...';
        } else {
            $output['success'] = false;
            $output['msg'] = 'Something went wrong. Please try again later.';
        }
        return response()->json($output);

    }


}






































