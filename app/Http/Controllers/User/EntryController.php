<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lottery;
use App\Models\Entry;
use Illuminate\Support\Facades\DB;

class EntryController extends Controller
{
    public function all_entries(Request $request){

        $normal_user = auth()->user()->id;
        $current_datetime = date('Y-m-d H:i:s');
        if($request->has('id') && $request->input('id') != '') {

            $this->data['lottery'] = Lottery::where('user_id', $normal_user)->where('id', $request->input('id'))->first();

            $this->data['entries'] = Entry::select(
                'entries.id as entry_tid',
                'entries.*',
                'e2.first_name as g_first_name',
                'e2.last_name as g_last_name',
                DB::raw('(SELECT COUNT(lottery_winners.id) FROM lottery_winners WHERE entries.id = lottery_winners.entry_id) AS winner'),
                DB::raw('(SELECT lottery_winners.id FROM lottery_winners WHERE entries.id = lottery_winners.entry_id) AS winner_tid'),
                DB::raw('(SELECT lottery_winners.id FROM lottery_winners WHERE entries.guest_id = lottery_winners.entry_id) AS g_id'),
                DB::raw('(SELECT COUNT(lottery_losers.id) FROM lottery_losers WHERE entries.id = lottery_losers.entry_id) AS loser')
            )
                ->leftJoin('lotteries', 'lotteries.id', '=', 'entries.lottery_id')
                ->leftJoin('entries as e2', 'entries.guest_id', '=', 'e2.id')
                ->where('lotteries.user_id', $normal_user)
                ->where('entries.lottery_id', $request->input('id'))
                ->orderByDesc('entries.id')
                ->get();

        }else{

            $this->data['lotteries'] = Lottery::select('*', DB::raw('(SELECT COUNT(entries.id) FROM entries WHERE lotteries.id = entries.lottery_id) AS selected_total_entries'), DB::raw('(SELECT COUNT(lottery_winners.id) FROM lottery_winners WHERE lotteries.id = lottery_winners.lottery_id) AS selected_total_winners'), DB::raw('(SELECT COUNT(lottery_losers.id) FROM lottery_losers WHERE lotteries.id = lottery_losers.lottery_id) AS selected_total_losers'))
                ->where('user_id', $normal_user)
                ->where(function ($query) use ($current_datetime) {
                    $query->where('start_datetime', '<=', $current_datetime)
                        ->where('end_datetime', '>=', $current_datetime)
                        ->orWhere('end_datetime', '<', $current_datetime);
                })
                ->orderBy('updated_at', 'desc')
                ->get();
        }

        return view('dashboard.user.all_entries',['data'=>$this->data]);
    }
}
