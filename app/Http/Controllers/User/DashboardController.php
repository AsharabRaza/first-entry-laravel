<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function dashboard(){
        $memberInfo = expireStatus(auth()->user()->id);
        if ($memberInfo && $memberInfo['status'] == false) {
            return view('dashboard.user.membership')->with(['membershipInfo' => $memberInfo]);
        }
        return view('dashboard.user.home')->with(['data'=>$this->data]);
    }
}
