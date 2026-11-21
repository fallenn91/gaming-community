<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserStat extends Model
{
    protected $fillable = [
      'user_id',
      'posts_count',
      'comment_count',
      'likes_received',
    ];

    public function User()
    {
      $this->belongsTo(User::class);
    }
}
