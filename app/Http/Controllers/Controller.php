<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public $data = [];

    public function __construct()
    {
        $this->data['total_in_review_users'] = User::get()->where('status',1)->count();
        /*$memberInfo = expireStatus(auth()->user()->id);
        if ($memberInfo['status'] == false) {
            return view('dashboard.user.membership')->with(['membershipInfo' => $memberInfo]);
        }*/
    }
}
