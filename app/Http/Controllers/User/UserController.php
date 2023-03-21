<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Lottery;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function create(Request $request){
        $request->validate([
           'name' => 'required',
           'email' => 'required|email|unique:users,email',
            'password' => 'required|min:5|max:30',
            'cpassword' => 'required|min:5|max:30|same:password',

        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $save = $user->save();
        if($save){
            return redirect()->back()->with('success','You are now registered successfully');
        }else{
            return redirect()->back()->with('fail','Something went wrong, failed to register');
        }
    }

    public function check(Request $request){
        $request->validate([
           'email' => 'required|email|exists:users,email',
           'password' => 'required|min:5|max:30',
        ],[
            'email.exists'=>'This email does not exist'
        ]);

        $creds = $request->only('email','password');
        if(Auth::guard('web')->attempt($creds)){
            if(auth()->user()->user_type == 1){ //for user
                return redirect()->route('user.home');
            }else{ //for agent
                return redirect()->route('user.entry-verification');
            }
        }else{
            return redirect()->back()->with('fail','Incorrect credentials');
        }
    }

    public function logout(){
        Auth::guard('web')->logout();
        return redirect('/');
    }

    public function view_profile(Request $request){
        $this->data['user'] = User::find(Auth::guard('web')->id());
        $this->data['lottery_count'] = Lottery::where('user_id', auth()->user()->id)->count();
        return view('dashboard.user.view_profile')->with(['data'=>$this->data]);
    }

    public function upload_profile_image(Request $request){


            $imageName = $request->file('image')->getClientOriginalName();
            $imageSize = $request->file('image')->getSize();
            $tmpName = $request->file('image')->getPathname();

            // Image validation
            $validImageExtension = ['jpg', 'jpeg', 'png'];
            $imageExtension = strtolower($request->file('image')->getClientOriginalExtension());
            if (!in_array($imageExtension, $validImageExtension)) {
                return response()->json([
                   'success' => 'false',
                   'msg' => 'Invalid Image Extension'
                ]);
            } elseif ($imageSize > 1200000) {
                return response()->json([
                    'success' => 'false',
                    'msg' => 'Image Size Is Too Large'
                ]);
            } else {
                $newImageName = date("Y.m.d") . "-" . date("h.i.sa"); // Generate new image name
                $newImageName .= '.' . $imageExtension;

                $user = User::find(auth()->user()->id);
                $user->profile_picture = $newImageName;
                $user->save();

                $request->file('image')->move(public_path('user/images/uploaded/'), $newImageName);
                return response()->json([
                    'success' => 'true',
                    'msg' => 'Profile picture updated successfully'
                ]);
            }


    }

    public function edit_profile(Request $request){

        if($request->isMethod('post')){

            $normal_user = auth()->user()->id;
            $submit_profile = $request->input('submit_profile');
            $user_type = auth()->user()->user_type;

            $user = User::find($normal_user);

            $user->first_name = $request->input('first_name');
            $user->last_name = $request->input('last_name');
            $user->phone = $request->input('phone');
            $user->email = $request->input('email');
            $user->last_updated = now();

            if ($user_type == 1) {
                $user->company_name = $request->input('company_name');
                $user->company_size = $request->input('company_size');
                $user->about_projects = $request->input('about_projects');
                $user->website = $request->input('website_or_social');

                $features_or_functions = $request->input('features_or_functions');
                $please_specify_custom = $request->input('please_specify_custom');

                $user->features_functions = $features_or_functions;
                $user->in_review = true;

                if ($features_or_functions == 'Special functions') {
                    $user->custom_features_functions = $please_specify_custom;
                }
            } else if ($user_type == 2) {
                $user->about_projects = $request->input('about_projects');
            }

            $user->save();

            if ($submit_profile == 'true') {
                $admins = Admin::all('email');
                $admin_emails = $admins->pluck('email')->toArray();

                foreach ($admin_emails as $admin_email) {
                    Mail::to($admin_email)->send(new RequestToAdmins($normal_user));
                }

                $output['success'] = true;
                $output['msg'] = 'Your request was successfully sent.';
            } else {
                $output['success'] = true;
                $output['msg'] = 'Your profile was successfully updated.';
            }

            return response()->json($output);

        }else{

            $this->data['user'] = User::find(auth()->user()->id);

            $this->data['user']->review_msg_seen = 1;
            $this->data['user']->save();


            return view('dashboard.user.edit_profile',['data'=>$this->data]);
        }

    }

    public function change_password(Request $request){
        if($request->isMethod('post')){


            $request->validate([
                'old_pwd' => 'required',
                //'new_pwd' => 'required|min:8|confirmed',
            ]);

            $user = Auth::user();

            if (!Hash::check($request->input('old_pwd'), $user->password)) {
                return response()->json([
                    'success' => false,
                    'msg' => 'Old Password is Incorrect.'
                ]);
            }


            $user->password = Hash::make($request->input('new_pwd'));
            $pass_updated = $user->save();

            if($pass_updated){
                return response()->json([
                    'success' => true,
                    'msg' => 'Admin updated Successfully.'
                ]);
            }else{
                return response()->json([
                    'success' => false,
                    'msg' => 'Something went wrong, please try again later.'
                ]);
            }

        }else{
            $this->data['user'] = User::find(auth()->user()->id);
            return view('dashboard.user.change_password',['data'=>$this->data]);
        }
    }

}

























