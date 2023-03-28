<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lottery;
use App\Models\Entry;
use App\Models\Lottery_Losser;
use App\Models\Lottery_Winner;
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
                ->paginate(15)->withQueryString();

          //  dd($this->data['entries']);

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

    public function remove_winners(Request $request){

        $lottery_id = $request->input('lottery_id');
        $entry_id = $request->input('entry_id');
        $guest_id = $request->input('guest_id');
        $guest_id2 = $request->input('guest_id2');
        $request_id = $request->input('request_id');

        $current_datetime = now();

        $output = [];

        // Insert a record into lotteries_losers table for the entry_id and lottery_id
        $loser1 = new Lottery_Losser;
        $loser1->lottery_id = $lottery_id;
        $loser1->entry_id = $entry_id;
        $loser1->sorting = 0;
        $loser1->updated_at = $current_datetime;
        $loser1->created_at = $current_datetime;

        if ($loser1->save()) {
            // Delete the winner record from lotteries_winners table
            $winner = Lottery_Winner::find($request_id);
            if ($winner && $winner->delete()) {
                $output['success'] = true;
                $output['msg'] = 'Winner successfully removed. Reloading...';
            } else {
                $output['success'] = false;
                $output['msg'] = 'Something went wrong. Please try again later.';
            }
        } else {
            $output['success'] = false;
            $output['msg'] = 'Something went wrong. Please try again later.';
        }

        // Insert a record into lotteries_losers table for the guest_id and lottery_id
        if ($guest_id > 0 && $guest_id2 > 0) {
            $loser2 = new Lottery_Losser;
            $loser2->lottery_id = $lottery_id;
            $loser2->entry_id = $guest_id;
            $loser2->sorting = 0;
            $loser2->updated_at = $current_datetime;
            $loser2->created_at = $current_datetime;

            if ($loser2->save()) {
                // Delete the winner record from lotteries_winners table
                $winner = Lottery_Winner::find($guest_id2);
                if ($winner && $winner->delete()) {
                    $output['success'] = true;
                    $output['msg'] = 'Winner successfully removed. Reloading...';
                } else {
                    $output['success'] = false;
                    $output['msg'] = 'Something went wrong. Please try again later.';
                }
            } else {
                $output['success'] = false;
                $output['msg'] = 'Something went wrong. Please try again later.';
            }
        }

        return response()->json($output);
    }

    public function remove_entries(Request $request){

        $lottery_id = $request->input('lottery_id');
        $entry_id = $request->input('entry_id');
        $guest_id = $request->input('guest_id');
        $guest_id2 = $request->input('guest_id2');
        $request_id = $request->input('request_id');
        $current_datetime = now();

        // Deleting the entry
        $result1 = Entry::where('id', $entry_id)->delete();
        if ($result1) {
            $output['success'] = true;
            $output['msg'] = 'Entry successfully removed. Reloading...';
        } else {
            $output['success'] = false;
            $output['msg'] = 'Something went wrong. Please try again later.';
        }

        // Deleting the guest entry, if it exists
        if ($guest_id > 0) {
            $result2 = Entry::where('id', $guest_id)->delete();
            if ($result2) {
                $output['success'] = true;
                $output['msg'] = 'Entry successfully removed. Reloading...';
            } else {
                $output['success'] = false;
                $output['msg'] = 'Something went wrong. Please try again later.';
            }
        }

        return response()->json($output);
    }

    public function all_winners(Request $request){

        $normal_user = auth()->user()->id;
        $current_datetime = now();

        if($request->filled('id') && $request->input('id') != '') {

            $this->data['lottery'] = Lottery::select('id', 'title', 'lottery_url', 'is_winners_selected', 'start_datetime','event_datetime')
                ->where('user_id', $normal_user)
                ->where('id', $request->id)
                ->first();


            $this->data['winners'] = Lottery_Winner::select('lottery_winners.id as winner_tid', 'lottery_winners.*', 'entries.id as entry_tid', 'entries.*', 'e2.first_name as g_first_name', 'e2.last_name as g_last_name', 'l2.sorting as g_sorting', 'l2.id as g_id')
                ->leftJoin('entries', 'lottery_winners.entry_id', '=', 'entries.id')
                ->leftJoin('lotteries', 'lottery_winners.lottery_id', '=', 'lotteries.id')
                ->leftJoin('entries as e2', 'entries.guest_id', '=', 'e2.id')
                ->leftJoin('lottery_winners as l2', 'entries.guest_id', '=', 'l2.entry_id')
                ->where('lotteries.user_id', $normal_user)
                ->where('lottery_winners.lottery_id', $request->id)
                ->orderBy('sorting', 'ASC')
                ->get();
                //->paginate(15)->withQueryString();
            //dd($this->data['winners']);

        }else{

            $this->data['lotteries'] = Lottery::select('*')
                ->selectSub(function ($query) {
                    $query->selectRaw('COUNT(entries.id)')
                        ->from('entries')
                        ->whereColumn('lotteries.id', 'entries.lottery_id');
                }, 'selected_total_entries')
                ->selectSub(function ($query) {
                    $query->selectRaw('COUNT(lottery_winners.id)')
                        ->from('lottery_winners')
                        ->whereColumn('lotteries.id', 'lottery_winners.lottery_id');
                }, 'selected_total_winners')
                ->selectSub(function ($query) {
                    $query->selectRaw('COUNT(lottery_losers.id)')
                        ->from('lottery_losers')
                        ->whereColumn('lotteries.id', 'lottery_losers.lottery_id');
                }, 'selected_total_losers')
                ->where('user_id', $normal_user)
                ->where('end_datetime', '<', $current_datetime)
                ->where('is_winners_selected', 1)
                ->orderBy('updated_at', 'desc')
                ->get();

            // dd($this->data['lotteries']);

        }

        //  dd($this->data['winners']);
        return view('dashboard.user.all_winners',['data'=>$this->data]);
    }

    public function all_losers(Request $request){

        $normal_user = auth()->user()->id;
        $current_datetime = now();

        if($request->filled('id') && $request->input('id') != '') {

            $this->data['lottery'] = Lottery::select('id', 'title', 'lottery_url', 'is_winners_selected', 'start_datetime','event_datetime')
                ->where('user_id', $normal_user)
                ->where('id', $request->id)
                ->first();

            $this->data['losers'] = Lottery_Losser::select('lottery_losers.*', 'entries.*', 'e2.first_name as g_first_name', 'e2.last_name as g_last_name')
                ->leftJoin('entries', 'lottery_losers.entry_id', '=', 'entries.id')
                ->leftJoin('lotteries', 'lottery_losers.lottery_id', '=', 'lotteries.id')
                ->leftJoin('entries as e2', 'entries.guest_id', '=', 'e2.id')
                ->where('lotteries.user_id', '=', $normal_user)
                ->where('lottery_losers.lottery_id', '=', $request->id)
                ->orderBy('lottery_losers.id', 'ASC')
                ->paginate(15)->withQueryString();

        }else{


            $this->data['lotteries'] = Lottery::selectRaw('*, (SELECT COUNT(entries.id) FROM entries WHERE lotteries.id = entries.lottery_id) AS selected_total_entries, (SELECT COUNT(lottery_winners.id) FROM lottery_winners WHERE lotteries.id = lottery_winners.lottery_id) AS selected_total_winners, (SELECT COUNT(lottery_losers.id) FROM lottery_losers WHERE lotteries.id = lottery_losers.lottery_id) AS selected_total_losers')
                ->where('user_id', $normal_user)
                ->where('end_datetime', '<', $current_datetime)
                ->where('is_winners_selected', 1)
                ->orderBy('updated_at', 'desc')
                ->get();

        }

        return view('dashboard.user.all_losers',['data'=>$this->data]);

    }

}
