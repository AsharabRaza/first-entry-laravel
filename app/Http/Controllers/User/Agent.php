<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agent_Permission;

class Agent extends Controller
{
    public function all_agents(){
        //check membership
        $memberInfo = expireStatus(auth()->user()->id);
        if ($memberInfo['status'] == false) {
            return view('dashboard.user.membership')->with(['membershipInfo' => $memberInfo]);
        }

        $normal_user = auth()->user()->id;
        $this->data['agents'] = User::where('user_type', 2)
            ->where('created_by', $normal_user)
            ->orderBy('id', 'DESC')
            ->get();

        return view('dashboard.user.all_agents',['data'=>$this->data]);
    }

    public function add_agent(Request $request){

        //check membership
        $memberInfo = expireStatus(auth()->user()->id);
        if ($memberInfo['status'] == false) {
            return view('dashboard.user.membership')->with(['membershipInfo' => $memberInfo]);
        }

        if($request->isMethod('post')){

            $first_name = $request->input('first_name');
            $last_name = $request->input('last_name');
            $email = $request->input('email');
            $pass = $request->input('pass');
            $agent_permissions_actions_array = explode(",", $request->input('agent_permissions_actions'));
            $agent_permissions_actions = serialize($agent_permissions_actions_array);
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);
            $date = date("Y-m-d H:i:s");

            $check_user = User::where('email', $email)->first();
            if(!$check_user){
                $insert_data = [
                    'first_name' => $first_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'password' => $hashed_password,
                    'permissions' => $agent_permissions_actions,
                    'created_by' => auth()->user()->id,
                    'date_joined' => $date,
                    'start_date' => $date,
                    'user_type' => '2',
                    'email_confirm' => '1'
                ];
                $result = User::create($insert_data);
                if($result){
                    $output['success'] = true;
                    $output['msg'] = 'Agent successfully added. Reloading.....';
                }else{
                    $output['success'] = false;
                    $output['msg'] = 'Something went wrong. Please try again later.';
                }
            }else{
                $output['success'] = false;
                $output['msg'] = 'This email already exist, please try again with another email.';
            }

            return response()->json($output);

        }else{
            $this->data['agentsPermissions'] = Agent_Permission::all();
            return view('dashboard.user.add_agent',['data'=>$this->data]);
        }


    }

    public function edit_agent(Request $request){


        if($request->isMethod('post')){

            if (isset($_POST['edit_agent_btn'])) {
                if ($request->has('edit_agent_btn')) {
                    $agent_id = $request->input('agent_id');
                    $agent = User::where('id', $agent_id)->first();
                    $agentPassword = $agent->password;
                    $agentPermissions = $agent->permissions;
                    $first_name = $request->input('first_name');
                    $last_name = $request->input('last_name');
                    $email = $request->input('email');

                    if ($request->input('pass') == "") {
                        $hashed_password = $agentPassword;
                    } else {
                        $pass = $request->input('pass');
                        $hashed_password = bcrypt($pass);
                    }

                    $agent_permissions_actions_array = explode(",", $request->input('agent_permissions_actions'));
                    $agent_permissions_actions = serialize($agent_permissions_actions_array);

                    $agent->first_name = $first_name;
                    $agent->last_name = $last_name;
                    $agent->email = $email;
                    $agent->password = $hashed_password;
                    $agent->permissions = $agent_permissions_actions;

                    if ($agent->save()) {
                        $output['success'] = true;
                        $output['msg'] = 'Agent successfully edited. Reloading.....';
                    } else {
                        $output['success'] = false;
                        $output['msg'] = 'Something went wrong. Please try again later.';
                    }
                }

                return response()->json($output);
            }

        }else{
            $agentId = $request->id;
            $this->data['agent'] = User::find($agentId);
            $this->data['agentsPermissions'] = Agent_Permission::get();
            return view('dashboard.user.edit_agent',['data'=>$this->data]);
        }

    }

    public function delete_agent(Request $request){

        $request_id = $request->input('request_id');

        $user = User::find($request_id);

        if ($user) {
            $user->delete();
            $output['success'] = true;
            $output['msg'] = 'Agent successfully removed. Reloading...';
        } else {
            $output['success'] = false;
            $output['msg'] = 'Something went wrong. Please try again later.';
        }

        return response()->json($output);

    }



}























