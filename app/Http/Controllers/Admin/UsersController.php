<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Arr;

class UsersController extends Controller
{
    public function all_users(){
        $this->data['users'] = User::where('status', '<>' ,0)->paginate(15);
        return view('dashboard.admin.all_users')->with(['data'=>$this->data]);
    }

    public function add_user(Request $request){

        if($request->isMethod('post')){

            $validatedData = $request->validate([
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users|min:8',
                'phone' => 'required|string|min:8',
                'password' => ['required', 'string', 'min:8', 'confirmed'],
                'password_confirmation' => ['required', 'string', 'min:8'],
                'email_limit' => 'required|numeric|min:0|max:99999',
                'event_limit' => 'required|numeric|min:0|max:99999',
                //'start_date' => 'required|date|after_or_equal:today',
                //'end_date' => 'required|date|after:start_date',
            ]);

            $data = $request->only(['first_name', 'last_name', 'email', 'phone', 'password', 'email_limit', 'event_limit']);

            $associativeArray = [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'user_type' => 1,
                'email' => $data['email'],
                'phone' => $data['phone'],
                'password' => bcrypt($data['password']),
                'email_limit' => $data['email_limit'],
                'event_limit' => $data['event_limit'],
                'start_date' => date('Y-m-d'),
                'end_date' => NULL,
                'is_admin' => 0,
                'status' => 1,
            ];

            User::create($associativeArray);

            return redirect()->back()->with('success', 'User registered successfully.');


        }else{
            return view('dashboard.admin.add_user')->with(['data'=>$this->data]);
        }

    }

    public function edit_user(Request $request){

        if($request->isMethod('post')){

            $validation_keys = [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|min:8',
                'phone' => 'required|string|min:8',
                'email_limit' => 'required|numeric|min:0|max:99999',
                'event_limit' => 'required|numeric|min:0|max:99999',
                //'start_date' => 'required|date|after_or_equal:today',
                //'end_date' => 'required|date|after:start_date',
            ];

            $data = $request->only(['first_name', 'last_name', 'email', 'phone', 'password', 'email_limit', 'event_limit']);

            $associativeArray = [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'user_type' => 1,
                'email' => $data['email'],
                'phone' => $data['phone'],
                'email_limit' => $data['email_limit'],
                'event_limit' => $data['event_limit'],
                'start_date' => date('Y-m-d'),
                'end_date' => NULL,
                'is_admin' => 0,
                'status' => 0,
            ];


            if($request->has('password') && $request->filled('password')){
                $validation_keys = Arr::add($validation_keys, 'password' , ['required', 'string', 'min:8', 'confirmed']);
                $validation_keys = Arr::add($validation_keys, 'password_confirmation' , ['required', 'string', 'min:8']);
                $associativeArray = Arr::add($associativeArray, 'password' , bcrypt($request->password));
            }


            $validatedData = $request->validate($validation_keys);
            User::where('id',$request->user_id)->update($associativeArray);

            return redirect()->back()->with('success', 'User updated successfully.');


        }else{

            $this->data['user'] = User::where('id','=',$request->user_id)->first();
            return view('dashboard.admin.edit_user')->with(['data'=>$this->data]);
        }

    }

    public function view_user(Request $request){

        $this->data['user'] = User::where('id','=',$request->user_id)->first();
        return view('dashboard.admin.view_user')->with(['data'=>$this->data]);


    }

    public function edit_user_profile(Request $request){


        if($request->isMethod('post')){


            $validation_keys = [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|min:8',
                'phone' => 'required|string|min:8',
                'company_name' => 'required|string|max:99999',
                'company_size' => 'required|string|max:99999',
                'about_projects' => 'required|string|max:99999',
                'website_or_social' => 'required|string|max:99999',
                'features_or_functions' => 'required|string|max:99999',
            ];

            $data = $request->only(['first_name', 'last_name', 'email', 'phone', 'company_name', 'company_size', 'about_projects', 'website_or_social', 'features_or_functions', 'please_specify_custom']);

            $associativeArray = [
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'company_name' => $data['company_name'],
                'company_size' => $data['company_size'],
                'about_projects' => $data['about_projects'],
                'features_functions' => $data['features_or_functions'],
                'website' => $data['website_or_social'],
            ];


            if($request->has('please_specify_custom') && $request->filled('please_specify_custom')){
                $validation_keys = Arr::add($validation_keys, 'please_specify_custom' , ['required', 'string', 'max:99999']);
                $associativeArray = Arr::add($associativeArray, 'please_specify_custom' , $request->please_specify_custom);
            }


            //$validatedData = $request->validate($validation_keys);
            $insert_data = User::where('id',$request->user_id)->update($associativeArray);
            if($insert_data){
                return json_encode([
                   'success' => true,
                   'msg' => 'User Profile Successfully updated. Reloading....',
                ]);
            }else{
                return json_encode([
                    'success' => false,
                ]);
            }

            //return redirect()->back()->with('success', 'User updated successfully.');


        }else{

            $this->data['user'] = User::where('id','=',$request->user_id)->first();
            return view('dashboard.admin.edit_user_profile')->with(['data'=>$this->data]);
        }

    }

    public function delete_user(Request $request){


        if($request->filled('user_id')){
            $user = User::find($request->user_id);
            if($user){
                if($user->delete()){
                   /* return response()->json([
                        'success' => true,
                        'msg' => 'User Successfully deleted. Reloading....',
                    ]);*/
                    return back()->with('success',"User Successfully deleted");
                }else{
                    /*return response()->json([
                        'success' => false,
                        'msg' => 'Something went wrong, please try again later.',
                    ]);*/
                    return back()->with('fail',"Something went wrong, please try again later.");
                }
            }
        }

    }

    //in_review_users
    public function in_review_users(){

        $this->data['users'] = User::where('status','=',1)->paginate(15);
        return view('dashboard.admin.in_review_users')->with(['data'=>$this->data]);
    }

    public function paid_users(){

        //$this->data['users'] = User::where('paid_memberships','=',1)->where('in_review','=',0)->orderBy('id', 'desc')->get();
        $this->data['users'] = User::where('paid_memberships','=',1)->orderBy('id', 'desc')->paginate(15);
        return view('dashboard.admin.paid_users')->with(['data'=>$this->data]);
    }

}












































