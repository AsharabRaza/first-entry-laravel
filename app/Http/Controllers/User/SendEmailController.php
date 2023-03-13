<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lottery;

class SendEmailController extends Controller
{
    public function send_emails(Request $request){

        //check membership
        $memberInfo = expireStatus(auth()->user()->id);
        if ($memberInfo['status'] == false) {
            return view('dashboard.user.membership')->with(['membershipInfo' => $memberInfo]);
        }


        $normal_user = auth()->user()->id;
        $current_datetime = now();

        $this->data['total_lotteries'] = Lottery::where('user_id', $normal_user)
            ->where('is_winners_selected', true)
            ->orderBy('title', 'asc')
            ->count();
        $this->data['available_l'] = Lottery::where('user_id', $normal_user)
            ->where('is_winners_selected', true)
            ->orderBy('title', 'asc')
            ->get();

        return view('dashboard.user.send_emails',['data'=>$this->data]);

    }
}
