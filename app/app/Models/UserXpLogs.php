<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserXpLogs extends Model
{
    protected $fillable = [
        'user_id',
        'xp',
        'source',
        'created_at',
    ];

    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
