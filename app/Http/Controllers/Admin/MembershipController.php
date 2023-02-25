<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Membership;
use App\Models\Memberships_info;
use App\Models\User;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function assign_membership(Request $request){

        if($request->isMethod('post')){

            $user_id = htmlspecialchars($request->input('user_id'));
            $membership_id = $request->input('membership_id');
            $expire_date = $request->input('expire_date');
            $expire_time = $request->input('expire_time');

            $expire_date_time = date('Y-m-d H:i:s', strtotime("$expire_date $expire_time"));

            $current = date('Y-m-d H:i:s');

            $membership = Membership::find($user_id);

            $result = false;

            if($membership){
                $membership->user_id = $user_id;
                $membership->membership_id = $membership_id;
                $membership->start_date_time = $current;
                $membership->expire_date_time = $expire_date_time;
                $result =  $membership->save();
            }
            else{
                $result = Membership::create([
                    'user_id' => $user_id,
                    'membership_id' => $membership_id,
                    'start_date_time' => $current,
                    'expire_date_time' => $expire_date_time,
                ]);
            }

            //update the users table
            User::where('id',$user_id)->update([
               'status' => '2',
               'email_confirm' => '1',
               'paid_memberships' => '1',
            ]);


            if ($result == true){
                $output['success'] = true;
                $output['msg'] = 'Membership successfully added. Reloading.....';
            }else{
                $output['success'] = false;
                $output['msg'] = 'Something went wrong. Please try again later.';
            }

            return response()->json($output);

        }
        else{
            $this->data['users'] = User::where(['user_type' => 1, 'is_admin' => 0])->get();
            $this->data['memberships'] = Memberships_info::get();
            return view('dashboard.admin.assign_membership')->with(['data'=>$this->data, 'request' => $request]);
        }
    }
}
