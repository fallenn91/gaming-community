<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommunityModerationLog extends Model
{
    protected $fillable = [
      'community_id',
      'user_id',
      'kicked_by_user_id',
      'reason',
      'created_at',
    ];

    public function community()
    {
      return $this->belongsTo(Community::class);
    }

    public function user()
    {
      return $this->belongsTo(User::class);
    }

    public function kickedBy()
    {
      return $this->belongsTo(User::class);
    }


}
