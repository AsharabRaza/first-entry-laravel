<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Lottery;


class LotteryController extends Controller
{
    public function all_lotteries(Request $request){

        get_lotteries_winners_losers();

        $this->data['lotteries'] = Lottery::select('lotteries.*','users.profile_picture')
            ->selectRaw("GROUP_CONCAT(' ', CONCAT(users.first_name, ' ', users.last_name)) AS user_name")
            ->selectRaw("(SELECT COUNT(entries.id) FROM entries WHERE lotteries.id = entries.lottery_id) AS selected_total_entries")
            ->selectRaw("(SELECT COUNT(lottery_winners.id) FROM lottery_winners WHERE lotteries.id = lottery_winners.lottery_id) AS selected_total_winners")
            ->selectRaw("(SELECT COUNT(lottery_losers.id) FROM lottery_losers WHERE lotteries.id = lottery_losers.lottery_id) AS selected_total_losers")
            //->leftJoin('lottery_agents', 'lotteries.id', '=', 'lottery_agents.lottery_id')
            ->leftJoin('users', 'users.id', '=', 'lotteries.user_id')
            ->groupBy('lotteries.id')
            ->orderByDesc('lotteries.updated_at')
            ->get();

        //dd($this->data['lotteries']);

        return view('dashboard.admin.all_lotteries')->with(['data'=>$this->data]);
    }
}
