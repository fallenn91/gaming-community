<?php

namespace App\Services;
use App\Models\Achievement;
use App\Models\UserAchievement;

class AchievementService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function check($user, $type)
    {
      $achievements = Achievement::where('type', $type)->get();

      foreach($achievements as $achievement) {

        $alreadyUnlocked = UserAchievement::where([
          'user_id' => $user_id,
          'achievement_id' => $achievement->id,
        ])->exists;

        if ($alreadyUnlocked) {
          continue;
        }

        if ($this->meetsCondition($user, $achievement)) {
          UserAchievement::firstOrCreate([
            'user_id' => $user->id,
            'achievement_id' => $achievement->id,
            'unlocked_at' => now(),
          ]);

          $user->increment('xp', $achievement->xp_reward ?? 0);
        }
      }
    }

    private function meetsCondition($user, $achievement)
    {
      return match ($achievement->type) {
        'posts' => $user->posts()->count() >= $achievement->threshold,

        'comments' => $user->comments()->count() >= $achievement->threshold,

        'likes_received' =>
          $user->posts()
            ->withCount('likes')
            ->get()
            ->sum('likes_count') >= $achievement->threshold,

        default => false,
      };
    }
}
