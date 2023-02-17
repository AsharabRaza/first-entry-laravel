<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function all_users(){
        $this->data['users'] = User::get();
        dd($this->data['users']);
        return view('dashboard.admin.all_users',['data'=>$this->data]);
    }
}
