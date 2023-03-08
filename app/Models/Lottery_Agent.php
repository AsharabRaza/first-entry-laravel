<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lottery_Agent extends Model
{
    use HasFactory;
    protected $table = 'lottery_agents';
    protected $fillable = ['lottery_id','agent_id'];

}
