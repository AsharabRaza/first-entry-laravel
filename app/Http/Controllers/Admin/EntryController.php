<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use App\Models\Lottery_Losser;
use App\Models\Lottery_Winner;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function all_entries(Request $request){

        $entries = Entry::orderByDesc('id')->paginate(15);

        return view('dashboard.admin.all_entries',compact('entries'));
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

        $winners = Lottery_Winner::orderByDesc('id')->paginate(15);

        return view('dashboard.admin.all_winners',compact('winners'));
    }

    public function all_losers(Request $request){

        $losers = Lottery_Losser::orderBy('id', 'asc')->paginate(15);
        return view('dashboard.admin.all_losers',compact('losers'));
    }
}
