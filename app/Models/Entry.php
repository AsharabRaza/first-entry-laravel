<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;
    protected $fillable = ['lottery_id','first_name','last_name','has_parent','last_updated','date_created','email','date_created','phone','terms_conditions_agree','uid'];
}
