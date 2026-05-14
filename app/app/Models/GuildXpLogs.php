<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuildXpLogs extends Model
{
    protected $fillable = [
      'community_id',
      'user_id',
      'xp',
      'source',
    ];
}
