<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lottery;
use App\Models\Entry;
use Postmark\PostmarkClient;
use Picqer\Barcode\BarcodeGeneratorJPG;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class LotteryFormController extends Controller
{
    public function lottery_form(Request $request){
        $this->data['lottery'] = Lottery::where('lottery_url', $request->segment(2))->first();
        $this->data['countEntries'] = Entry::where('lottery_id', $this->data['lottery']->id)->count();
        return view('FrontEnd.lottery_form',['data'=>$this->data]);
    }

    public function captcha(Request $request){

        if($request->isMethod('get')){
            $rand_num = rand(11111,99999);
            session()->put('cap_code', $rand_num);
            $layer = imagecreatetruecolor(60,30);
            $captcha_bg = imagecolorallocate($layer,255,160,120);
            imagefill($layer,0,0,$captcha_bg);
            $captcha_text_color = imagecolorallocate($layer,0,0,0);
            imagestring($layer,5,5,5,$rand_num,$captcha_text_color);

            ob_start();
            imagejpeg($layer);
            $captcha_image = ob_get_clean();

            session()->put('cap_image', $captcha_image);

            return response($captcha_image)->header('Content-Type', 'image/jpeg');
        }
        elseif($request->isMethod('post')){
            $output = [];
            if ($request->has('check_captcha')) {
                if (session()->get('cap_code') != $request->input('captcha')) {
                    $output['msg'] = 'Captcha incorrect!';
                    $output['success'] = false;
                } else {
                    $output['msg'] = 'Captcha correct!';
                    $output['success'] = true;
                }

                return response()->json($output);
            }
        }
    }

    public function save_lottery_form(Request $request){

        $lottery_id = $request->input('lottery_id');
        $lottery_title = $request->input('lottery_title');
        $first_name = $request->input('first_name');
        $last_name = $request->input('last_name');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $bring_guest = $request->input('bring_guest');
        $guest_first_name = $request->input('guest_first_name');
        $guest_last_name = $request->input('guest_last_name');
        $terms_conditions_chekbox = $request->input('terms_conditions_chekbox');
        $custom_inputs_val = serialize($request->input('custom_inputs_val'));
        $uid = "FE-".strtoupper(substr($lottery_title,0,2)).generateUniqueUID(8);
        $date = now();

        $lottery = Lottery::find($lottery_id);
        if($lottery){
            $start_datetime = date('d-m-Y h:i A', strtotime($lottery->start_datetime));
            $end_datetime = date('d-m-Y h:i A', strtotime($lottery->end_datetime));
            $current_datetime = date('d-m-Y h:i A');

            if(strtotime($current_datetime) < strtotime($start_datetime)){ // This lottery has not started yet.
                $output['success'] = false;
                $output['msg'] = 'This lottery has not started yet.';
            }else if(strtotime($current_datetime) >= strtotime($start_datetime) && strtotime($current_datetime) <= strtotime($end_datetime)){ // Active
                $entry = Entry::where('lottery_id', $lottery_id)
                    ->where(function ($query) use ($email, $phone) {
                        $query->where('email', $email)
                            ->orWhere('phone', $phone);
                    })->first();

                if(!$entry){
                    if($bring_guest == 0){
                        $output['success'] = true;
                    }else if($bring_guest == 1){
                        $guest = Entry::create([
                            'lottery_id' => $lottery_id,
                            'first_name' => $guest_first_name,
                            'last_name' => $guest_last_name,
                            'has_parent' => '1',
                            'updated_at' => $date,
                            'created_at' => $date,
                        ]);

                        if($guest){
                            $output['success'] = true;
                            $guest_id = $guest->id;
                        }else{
                            $output['success'] = false;
                            $output['msg'] = 'Something went wrong. Couldn\'t add guest. Please try again later.';
                        }
                    }

                    if($output['success'] == true){
                        $entry = Entry::create([
                            'lottery_id' => $lottery_id,
                            'first_name' => $first_name,
                            'last_name' => $last_name,
                            'email' => $email,
                            'phone' => $phone,
                            'terms_conditions_agree' => $terms_conditions_chekbox,
                            'custom_inputs_val' => $custom_inputs_val,
                            'updated_at' => $date,
                            'created_at' => $date,
                            'uid' => $uid,
                        ]);

                        if($bring_guest == 1){
                            $entry->guest_id = $guest_id;
                            $entry->save();
                        }

                        $output['success'] = true;
                        $output['id'] = $entry->id;
                        $output['msg'] = $uid;
                    }
                }else{
                    $output['success'] = false;
                    $output['msg'] = 'You\'ve already entered this lottery with this email or phone.';
                }
            }else if(strtotime($current_datetime) > strtotime($end_datetime)){ // This lottery time has ended.
                $output['success'] = false;
                $output['msg'] = 'This lottery time has ended.';
            }
        }else{
            $output['success'] = false;
            $output['msg'] = 'This lottery is currently unavailable.';
        }

        header('Content-Type: application/json; charset=utf-8');
        echo json_encode($output);
    }

    public function save_s_qrcode(Request $request){


        $requestData = json_decode(request()->getContent(), true);
        $sQrCode = $requestData[0]['s_qrcode'];

        if ($sQrCode === 'true') {
            //$normalUser = $_COOKIE['normal_user'];
            $parentId = $requestData[0]['parent_id'];
            $uid = $requestData[0]['uid'];
            $data = $requestData[1];

            $entry = Entry::select('entries.*', 'e2.first_name as g_name', 'e2.last_name as g_lname', 'lotteries.*', 'lotteries.id as lottery_id')
                ->leftJoin('entries as e2', 'entries.guest_id', '=', 'e2.id')
                ->leftJoin('lotteries', 'entries.lottery_id', '=', 'lotteries.id')
                ->where('entries.id', $parentId)
                ->first();

            if (!$entry) {
                $output['success'] = false;
                $output['msg'] = 'Something went wrong. Please try again later.';
                return response()->json($output);
            }

            // Handle uploaded image file
            $fileName = '';
            if ($entry->scanning_option == 'QR_CODE' || $entry->scanning_option == '') {
                if (preg_match('/^data:image\/(\w+);base64,/', $data, $type)) {
                    $data = substr($data, strpos($data, ',') + 1);
                    $type = strtolower($type[1]); // jpg, png, gif

                    if (!in_array($type, ['jpg', 'jpeg', 'gif', 'png'])) {
                        throw new \Exception('invalid image type');
                    }
                    $data = str_replace(' ', '+', $data);
                    $data = base64_decode($data);

                    if ($data === false) {
                        throw new \Exception('base64_decode failed');
                    }
                } else {
                    throw new \Exception('did not match data URI with image data');
                }

                $randomStr = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1, 15))), 1, 15);
                $fileName = "{$randomStr}.{$type}";

                $filePath = public_path('assets/images/brand/'. $fileName);
                File::put($filePath, $data);

            } elseif ($entry->scanning_option == 'BAR_CODE') {

                $randomStr = substr(str_shuffle(str_repeat('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', mt_rand(1, 15))), 1, 15);
                $fileName = "{$randomStr}.jpg";
                $uid = explode('-', $uid);
                $uid = $uid[1];

                //$generator = new Picqer\Barcode\BarcodeGeneratorJPG();
                $generator = new BarcodeGeneratorJPG();
                $filePath = public_path('assets/images/brand/'. $fileName);
                File::put($filePath, $generator->getBarcode($uid, $generator::TYPE_CODE_128, 2, 70));
                //file_put_contents(url('assets/images/brand/'.$fileName), $generator->getBarcode($uid, $generator::TYPE_CODE_128, 2, 70));
            }

            $newDate = date("Y-m-d H:i:s");
            $entry_update = Entry::where('id', $parentId)->first();

            if($entry_update) {
                $entry_update->qr_code = $fileName;
                $entry_update->updated_at = $newDate;
                $entry_update->save();

                $event_date = formatted_date($entry->event_datetime);
                $guest_id = $entry->guest_id;
                if($guest_id == 0){
                    $hide_guest = 'display: none';
                }else{
                    $hide_guest = '';
                }

                $c_logo = $entry->header_image;
                if($c_logo == ''){
                    $c_logo = '';
                }else{
                    $c_logo = "<img src=\"".url('/')."assets/images/media/".$c_logo."\" width=\"65\">";
                }

                //require_once('send_emails_new.php');

                $client = new PostmarkClient('e22698e7-1778-41ea-bddc-c4442310a7b3');
                $sendResult = $client->sendEmailWithTemplate(
                    'info@firstentry.net',
                    $entry->email,
                    28884921,
                    [
                        "website_url" => url('/'),
                        "second_logo" => $c_logo,
                        "entry_full_name" => $entry->first_name . ' ' . $entry->last_name,
                        "company_name" => env('APP_NAME'),
                        "event_title" => $entry->title,
                        "event_date" => $event_date,
                        "entry_uid" => $entry->uid,
                        "guest_hide" => $hide_guest,
                        "guest_full_name" => $entry->g_name . ' ' . $entry->g_lname,
                        "qr_code_img" => url('/')."assets/images/brand/".$entry->qr_code,
                        "action_check_status_url" => url('/')."status/".$entry->uid,
                        "company_address" => '',
                        "receiver_email" => $entry->email,
                        "contact_support" => 'mailto:support@firstentry.net',
                        "unsubscribe_hide" => 'd-none',
                        "current_year" => date('Y')
                    ],
                    true,
                    'Entry confirmation #' . $entry->lottery_id);

                $output['success'] = true;
                $output['msg'] = 'You\'ve successfully entered the lottery, you will get a confirmation email soon.';
            } else {
                $output['success'] = false;
                $output['msg'] = 'Something went wrong. Please try again later.';
            }

            return response()->json($output);

        }

    }

}




/*$newDate = date("Y-m-d H:i:s");
$sql = "UPDATE entries SET qr_code = '$file_name', last_updated = '$newDate' WHERE id = '$parent_id'";
$result_update = $con->query($sql);
if($result_update == true){

    $event_date = formatted_date($row->event_datetime);
    $guest_id = $row->guest_id;
    if($guest_id == 0){
        $hide_guest = 'display: none';
    }else{
        $hide_guest = '';
    }

    $c_logo = $row->header_image;
    if($c_logo == ''){
        $c_logo = '';
    }else{
        $c_logo = "<img src=\"".$website_url."assets/images/media/".$c_logo."\" width=\"65\">";
    }

    require_once('send_emails_new.php');
    $sendResult = $client->sendEmailWithTemplate(
        $from_email,
        $row->email,
        28884921,
        [
            "website_url" => $website_url,
            "second_logo" => $c_logo,
            "entry_full_name" => $row->first_name . ' ' . $row->last_name,
            "company_name" => $site_title,
            "event_title" => $row->title,
            "event_date" => $event_date,
            "entry_uid" => $row->uid,
            "guest_hide" => $hide_guest,
            "guest_full_name" => $row->g_name . ' ' . $row->g_lname,
            "qr_code_img" => $website_url."assets/images/brand/".$row->qr_code,
            "action_check_status_url" => $website_url."status/".$row->uid,
            "company_address" => $company_address,
            "receiver_email" => $row->email,
            "contact_support" => $contact_support_url,
            "unsubscribe_hide" => 'd-none',
            "current_year" => date('Y')
        ],
        true,
        'Entry confirmation #' . $row->lottery_id);

    $output['success'] = true;
    $output['msg'] = 'You\'ve successfully entered the lottery, you will get a confirmation email soon.';

}else{
    $output['success'] = false;
    $output['msg'] = 'Something went wrong. Please try again later.';
}

header('Content-Type: application/json; charset=utf-8');
echo json_encode($output);*/
