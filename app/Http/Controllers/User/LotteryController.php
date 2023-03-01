<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Lottery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function add_lottery(Request $request){


        $memberInfo = expireStatus(auth()->user()->id);
        if($memberInfo['status'] == false){
            return view('dashboard.user.membership')->with(['membershipInfo'=>$memberInfo]);
        }

        if($request->has('duplicate_id')){
            $lottery_id = $request->duplicate_id;
            $lottery_id = base64_decode($lottery_id);
            $duplicate_lottery = Lottery::find($lottery_id);
            if($duplicate_lottery){
                $this->data['dup_lottery_data'] = $duplicate_lottery;
            }
        }

        $this->data['remaining_events'] = getRemainingUserEvents(auth()->user()->id);

        return view('dashboard.user.add_lottery')->with(['data'=>$this->data]);

    }
}






































