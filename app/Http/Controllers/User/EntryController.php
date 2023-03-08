<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    public function all_entries(Request $request){
        return view('dashboard.user.all_entries',['data'=>$this->data]);
    }
}
