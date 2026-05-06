<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
      'name',
      'type',
      'threshold',
      'xp_reward',
    ];

    public function userAchievements()
    {
        return $this->hasMany(UserAchievement::class, 'achievement_id');
    }
}
