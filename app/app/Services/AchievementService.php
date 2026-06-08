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

        foreach ($achievements as $achievement) {

            if (! $this->meetsCondition($user, $achievement)) {
                continue;
            }

            $userAchievement = UserAchievement::firstOrCreate(
                [
                    'user_id' => $user->id,
                    'achievement_id' => $achievement->id,
                ],
                [
                    'unlocked_at' => now(),
                ]
            );

            if ($userAchievement->wasRecentlyCreated) {
                $user->increment('xp', $achievement->xp_reward ?? 0);

                event(new \App\Events\AchievementUnlocked($user, $achievement));
            }
        }
    }

    private function meetsCondition($user, $achievement, array $stats): bool
    {
        return ($stats[$achievement->type] ?? 0) >= $achievement->threshold;
    }

    public function check($user, string $type): void
    {
      $achievements = Achievement::where('type', $type)
        ->whereNotIn('id', $user->achievements()->pluck('achievement_id'))
        ->get();

        $stats = $this->getStats($user);
        foreach ($achievements as $achievement) {
            if (($stats[$achievement->type] ?? 0) >= $achievement->threshold) {
                UserAchievement::create([
                    'user_id' => $user->id,
                    'achievement_id' => $achievement->id,
                    'unlocked_at' => now(),
                ]);

                $user->increment('xp', $achievement->xp_reward ?? 0);

                event(new \App\Events\AchievementUnlocked($user, $achievement));
            }
        }
    }

    
}
