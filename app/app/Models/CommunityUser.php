<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityUser extends Model
{
    protected $fillable = [
      'community_id',
      'user_id',
      'role',
    ];
}
