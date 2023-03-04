<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Lottery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\App;
use Torann\GeoIP\Facades\GeoIP;
use Torann\GeoIP\Location;
use Carbon\Carbon;
use App\Models\Email_Template;



class LotteryController extends Controller
{
    public function __construct(Request $request)
    {

    }

    public function all_lotteries(Request $request){

//        expireStatus();

        $result = DB::table('lotteries')
            ->leftJoin('lottery_agents', 'lotteries.id', '=', 'lottery_agents.lottery_id')
            ->leftJoin('users', 'lottery_agents.agent_id', '=', 'users.id')
            ->select('lotteries.*', DB::raw("GROUP_CONCAT(' ', CONCAT(users.first_name, ' ', users.last_name)) AS lottery_agents"),
                DB::raw("(SELECT COUNT(entries.id) FROM entries WHERE lotteries.id = entries.lottery_id) AS selected_total_entries"),
                DB::raw("(SELECT COUNT(lottery_winners.id) FROM lottery_winners WHERE lotteries.id = lottery_winners.lottery_id) AS selected_total_winners"),
                DB::raw("(SELECT COUNT(lottery_losers.id) FROM lottery_losers WHERE lotteries.id = lottery_losers.lottery_id) AS selected_total_losers"))
            ->where('lotteries.user_id', auth()->user()->id)
            ->groupBy('lotteries.id')
            ->orderByDesc('lotteries.updated_at')
            ->get();

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

                            $timezone = 'America/New_York';
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


                            $start_datetime_utc = convert_timezone($start_datetime, $timezone, 'UTC', 'Y-m-d H:i');
                            $end_datetime_utc = convert_timezone($end_datetime, $timezone, 'UTC', 'Y-m-d H:i');

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

            $memberInfo = expireStatus(auth()->user()->id);
            if ($memberInfo['status'] == false) {
                return view('dashboard.user.membership')->with(['membershipInfo' => $memberInfo]);
            }

            if ($request->has('duplicate_id')) {
                $lottery_id = $request->duplicate_id;
                $lottery_id = base64_decode($lottery_id);
                $duplicate_lottery = Lottery::find($lottery_id);
                if ($duplicate_lottery) {
                    $this->data['dup_lottery_data'] = $duplicate_lottery;
                }
            }

            $this->data['remaining_events'] = getRemainingUserEvents(auth()->user()->id);

            return view('dashboard.user.add_lottery')->with(['data' => $this->data]);

        }
    }

    public function edit_lottery(Request $request){

        $memberInfo = expireStatus(auth()->user()->id);
        if ($memberInfo['status'] == false) {
            return view('dashboard.user.membership')->with(['membershipInfo' => $memberInfo]);
        }

        $lottery_id = request()->input('id');

        $result = Lottery::leftJoin('lottery_agents', 'lotteries.id', '=', 'lottery_agents.lottery_id')
            ->select('lotteries.*', DB::raw('GROUP_CONCAT(agent_id) as agent_ids'))
            ->where('lotteries.id', '=', $lottery_id)
            ->groupBy('lotteries.id')
            ->first();

        //dd($result);

        if ($result != null) {
            $current_datetime = date('d-m-Y h:i A');
            $this->data['lottery_url'] = $result->lottery_url;
            $old_lottery_agents = $result->agent_ids;
            $this->data['country_code'] = $result->country_code;
            $this->data['lott_timezone'] = $result->timezone;
            $this->data['title'] = $result->title;
            $this->data['lottery_logo'] = $result->header_image;
            $this->data['lottery_background_image'] = $result->background_image;
            $this->data['total_winners'] = $result->total_winners;
            $this->data['allow_guest'] = $result->allow_guest;
            $form_customization = unserialize($result->form_customization);
            $lottery_status = $result->status;
            $this->data['scanning_option'] = $result->scanning_option;
            $this->data['queing_process'] = $result->queing_process;

            $this->data['start_date'] = date('d-m-Y', strtotime($result->start_datetime));
            $this->data['start_time'] = date('h:i A', strtotime($result->start_datetime));

            $this->data['end_date'] = date('d-m-Y', strtotime($result->end_datetime));
            $this->data['end_time'] = date('h:i A', strtotime($result->end_datetime));

            $this->data['event_date'] = date('d-m-Y', strtotime($result->event_datetime));
            $this->data['event_time'] = date('h:i A', strtotime($result->event_datetime));

            $scan_start_date = !empty($result->scan_start_datetime) ? date('d-m-Y', strtotime($result->scan_start_datetime)) : null;
            $scan_start_time = !empty($result->scan_start_datetime) ? date('h:i A', strtotime($result->scan_start_datetime)) : null;

            $scan_end_date = !empty($result->scan_end_datetime) ? date('d-m-Y', strtotime($result->scan_end_datetime)) : null;
            $scan_end_time = !empty($result->scan_end_datetime) ? date('h:i A', strtotime($result->scan_end_datetime)) : null;

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
                $email_data = unserialize($email_data);
                $winners_emails_instructions = $email_data['instructions'];
                $winners_emails_reminders = $email_data['reminders'];
                $winners_emails_map_image = $email_data['map_image'];
                $winners_emails_venue_link = $email_data['venue_link'];
            } else {
                $winners_emails_instructions = '';
                $winners_emails_reminders = '';
                $winners_emails_map_image = '';
                $winners_emails_venue_link = '';
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
                $winners_emails_instructions = '';
                $winners_emails_reminders = '';
                $winners_emails_map_image = '';
                $winners_emails_venue_link = '';
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
                $losers_emails_instructions = $email_data['instructions'];
                $losers_emails_venue_link = $email_data['venue_link'];
            } else {
                $losers_emails_instructions = '';
                $losers_emails_venue_link = '';
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
                $losers_emails_instructions = '';
                $losers_emails_venue_link = '';
            }
        }

        $this->data['lottery_id'] = $lottery_id;

        return view('dashboard.user.edit_lottery',['data'=>$this->data]);


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

      /*  $country_code = $request->country_code; // Replace with the country code you want to get the time zone for

        $location = new Location(GeoIP::getLocation($country_code));

        $time_zone = $location->getAttribute('timezone');
        dd($time_zone);*/
        $timeZone = ['Pacific/Pago_Pago'];
        return response()->json($timeZone);
    }



}






































