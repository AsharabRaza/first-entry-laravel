<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Lottery;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agent_Permission;
use App\Models\Entry;

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

    public function agents_history(Request $request){

        $normal_user = auth()->user()->id;
        $entries = [];
        if($request->has('lottery_id') && $request->lottery_id != '') {
            $entries = Entry::select('entries.id as entries_id', 'entries.first_name', 'entries.last_name', 'entries.uid', 'users.first_name as users_first_name',
                'users.last_name as users_last_name', 'profile_picture', 'users.email as users_email', 'users.email_confirm as users_email_confirm',
                'entries.entry_confirmed', 'users.phone as phone', 'company_name', 'company_size', 'about_projects', 'website', 'features_functions',
                'custom_features_functions', 'trial_days', 'paid_memberships', 'in_review', 'users.date_joined as date_joined', 'users.last_updated as last_updated',
                'users.last_login as last_login', 'entries.entry_confirmed_by_type', 'entries.entry_confirmed_by_type_nicename', 'entries.guest_id', 'entries.has_parent',
                'entries.entry_confirmed_datetime', 'g_entry.first_name as g_first_name', 'g_entry.last_name as g_last_name')
                ->leftJoin('users', 'entries.entry_confirmed_by', '=', 'users.id')
                ->leftJoin('entries as g_entry', 'entries.guest_id', '=', 'g_entry.id')
                ->where('entries.entry_confirmed', '=', 1)
                ->whereNotNull('entries.entry_confirmed_by')
                ->where('entries.lottery_id', '=', $request->lottery_id)
                ->get();

//            $myfile = fopen("agents_history.txt", "w") or die("Unable to open file!");
//            fwrite($myfile, $entries->toSql());
        }

        $available_l = Lottery::select('*')->where(['user_id'=>$normal_user, 'is_winners_selected' => 1])->orderBy('id','ASC')->get();
        return view('dashboard.user.agents_history',compact('available_l','entries'));
    }


}























