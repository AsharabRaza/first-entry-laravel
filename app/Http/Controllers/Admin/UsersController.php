<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function all_users(){
        $this->data['users'] = User::get();
        return view('dashboard.admin.all_users')->with(['data'=>$this->data]);
    }
}
