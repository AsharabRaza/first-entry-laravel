<?php

namespace App\Http\Controllers\FrontEnd;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class IndexController extends Controller
{
    public function index(){
        return view('FrontEnd.index');
    }
    public function contact_us(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'msg' => $validator->errors()->first()
            ]);
        }

        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');

        $email_content = '';
        $email_content .= '<p>Name : '.$name.'</p>';
        $email_content .= '<p>Email : '.$email.'</p>';
        $email_content .= '<p>message : '.$message.'</p>';
        $email_subject = $subject;
        $tag_name   =   'Send plan email';


        if(send_email_info($email, $email_content, $email_subject, $tag_name) == true){

            $output['success'] = true;
            $output['msg'] = 'Request submitted successfully.';
        }else{
            $output['success'] = false;
            $output['msg'] = 'Something went wrong. Please try again later.';
        }

        return response()->json($output);

    }

    public function request_demo(Request $request){

        $request = Request::capture();

        $full_name      = trim($request->input('full_name'));
        $company_name   = trim($request->input('company_name'));
        $email          = trim($request->input('email'));
        $phone_number   = trim($request->input('phone_number'));
        $country        = trim($request->input('country'));
        $usage          = trim($request->input('usage'));
        $description    = trim($request->input('description'));

       /* $request->validate([
            'email' => 'required|email|unique:users,email',
        ]);*/
/*
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors(),
            ]);
        }*/

      if(empty($full_name)) {
            return response()->json(['success' => false, 'msg' => 'Please provide name.']);
        }
        if(empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return response()->json(['success' => false, 'msg' => 'Please provide valid email.']);
        }
        if(!empty($email)){
            $exist = User::where('email',$email)->first();
            if($exist){
                return response()->json(['success' => false, 'msg' => 'Email already exist']);
            }
        }
        if(empty($phone_number)) {
            return response()->json(['success' => false, 'msg' => 'Please provide phone number.']);
        }
        if(!empty($phone_number)){
            $exist = User::where('phone',$phone_number)->first();
            if($exist){
                return response()->json(['success' => false, 'msg' => 'Phone already exist']);
            }
        }
        if(empty($country)) {
            return response()->json(['success' => false, 'msg' => 'Please provide country.']);
        }
        if(empty($usage)) {
            return response()->json(['success' => false, 'msg' => 'Please provide usage.']);
        }
        if($usage == 'Others (Please Describe)' && empty($description)) {
            return response()->json(['success' => false, 'msg' => 'Please provide description.']);
        }

        $name = explode(" ", $full_name);
        $first_name = $name[0];
        $last_name = isset($name[1]) ? $name[1] : 0;
        $password = 'password';

        $user = new User();
        $user->user_type = 1;
        $user->first_name = $first_name;
        $user->last_name = $last_name;
        $user->email = $email;
        $user->password = $password;
        $user->company_name = $company_name;
        $user->status = 1;
        $user->phone = $phone_number;
        $user->country = $country;
        $user->user_usage = $usage;
        $user->save();

        $email_content = '';
        $email_content .= '<p>Name : '.$full_name.'</p>';
        $email_content .= '<p>Company : '.$company_name.'</p>';
        $email_content .= '<p>Email : '.$email.'</p>';
        $email_content .= '<p>Phone : '.$phone_number.'</p>';
        $email_content .= '<p>Country : '.$country.'</p>';
        $email_content .= '<p>Usage : '.$usage.'</p>';
        $email_content .= '<p>Description : '.$description.'</p>';
        $email_subject = 'Request for demo';
        $tag_name       =   'Request for demo';

        if(send_email_info($email, $email_content, $email_subject, $tag_name) == true){
            $output['success'] = true;
            $output['msg'] = 'Request submitted successfully.';
        }else{
            $output['success'] = false;
            $output['msg'] = 'Something went wrong. Please try again later.';
        }

        return response()->json($output);

    }

    public function event_lottery(Request $request){
        return view('FrontEnd.event_lottery');
    }
}
