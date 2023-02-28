<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Testing\Fluent\Concerns\Has;

class AdminController extends Controller
{
    public function check(Request $request){
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:5|max:30',
        ],[
            'email.exists'=>'This email does not exist'
        ]);

        $creds = $request->only('email','password');
//        dd(Hash::make('123456'));
        if(Auth::guard('admin')->attempt($creds)){
            return redirect()->route('admin.home');
        }else{
            return redirect()->back()->with('fail','Incorrect credentials');
        }
    }

    public function view_profile(Request $request){
        $this->data['admin'] = Admin::find(Auth::guard('admin')->id());
        return view('dashboard.admin.view_profile')->with(['data'=>$this->data]);
    }

    public function edit_profile(Request $request){
        if($request->isMethod('post')){
            $update_admin = Admin::where('id',Auth::guard('admin')->id())->update([
                'name' => $request->full_name,
            ]);
            if($update_admin){
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
            $this->data['admin'] = Admin::find(Auth::guard('admin')->id());
            return view('dashboard.admin.edit_profile')->with(['data'=>$this->data]);
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
            $this->data['admin'] = Admin::find(Auth::guard('admin')->id());
            return view('dashboard.admin.change_password')->with(['data'=>$this->data]);
        }

    }


    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
