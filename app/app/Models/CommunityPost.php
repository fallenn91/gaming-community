<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityPost extends Model
{
    protected $fillable = [
      'community_id',
      'post_id',
      'user_id',
      'context',
      'image',
    ];

    public function community()
    {
      return $this->belongsTo(Community::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function post()
    {
      return $this->belongsTo(Post::class);
    }
}
