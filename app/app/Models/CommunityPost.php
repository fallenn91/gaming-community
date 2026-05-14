<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityPost extends Model
{
    protected $fillable = [
      'community_id',
      'user_id',
      'context',
      'image',
    ];
}
