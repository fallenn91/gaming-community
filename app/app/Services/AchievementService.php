<?php

namespace App\Services;
use App\Models\Achievement;
use App\Models\UserAchievement;

class AchievementService
{
    
    /**
     * Create a new class instance.
     */
    public function __construct(private UserStatsService $statsService)
    {
        //
    }

    public function check($user, string $type): void
    {
        $stats = $this->statsService->getStats($user);

        $achievements = Achievement::where('type', $type)
            ->whereNotIn('id', $user->achievements()->pluck('achievement_id'))
            ->get();

        foreach ($achievements as $achievement) {
            $alreadyUnlocked = UserAchievement::where('user_id', $user->id)
                ->where('achievement_id', $achievement->id)
                ->exists();

            if ($alreadyUnlocked) {
                continue;
            }
            
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
