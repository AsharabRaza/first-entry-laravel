<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{
    use HasFactory;


    public function getEventsCountByUserId($userId)
    {
        return $this->where('user_id', $userId)->count();
    }
}
