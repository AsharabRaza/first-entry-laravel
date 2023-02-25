<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Membership extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'membership_id', 'start_date_time', 'expire_date_time'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
