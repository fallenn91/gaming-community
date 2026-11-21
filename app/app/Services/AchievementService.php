<?php

namespace App\Services;

use App\Events\AchievementUnlocked;
use App\Models\Achievement;
use App\Models\UserAchievement;
use App\Models\User;

class AchievementService
{
    public function __construct(
        private XpService $xpService,
        private UserStatsService $statsService
    ) {
    }

    public function check(User $user, string $type): void
    {
        $stats = $this->statsService->getStats($user);

        $unlockedIds = UserAchievement::where('user_id', $user->id)->pluck('achievement_id');

        $achievements = Achievement::where('type', $type)
            ->whereNotIn('id', $unlockedIds)
            ->get();

        foreach ($achievements as $achievement) {
            if (($stats[$achievement->type] ?? 0) >= $achievement->threshold) {
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
                    $this->xpService->award(
                        $user,
                        $achievement->xp_reward,
                        'Achievement: ' . $achievement->name
                    );

                    event(new AchievementUnlocked($user, $achievement));
                }
            }
        }
    }
}
