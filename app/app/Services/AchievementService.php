<?php

namespace App\Services;
use App\Models\Achievement;
use App\Models\UserAchievement;
use App\Services\XpService;

class AchievementService
{
    
    /**
     * Create a new class instance.
     */
    public function __construct(private XpService $xpService)
    {
        //
    }

    public function check($user, string $type): void
    {
        $stats = $this->statsService->getStats($user);

        $unlockedIds = UserAchievement::where('user_id', $user->id)->pluck('achievement_id');

        $achievements = Achievement::where('type', $type)
            ->whereNotIn('id', $unlockedIds)
            ->get();

        foreach ($achievements as $achievement) {            
            if (($stats[$achievement->type] ?? 0) >= $achievement->threshold) {
                $userAchivement = UserAchievement::firstOrCreate([
                    'user_id' => $user->id,
                    'achievement_id' => $achievement->id,
                ], [
                  'unlocked_at' => now(),
                ]);

                if ($userAchievement->wasRecentlyCreated) {
                  $this->xpService->award(
                    $user, 
                    $achievement->xp_reward,
                    'Achievement: ' . $achievement->name
                  );
                  event(new \App\Events\AchievementUnlocked($user, $achievement));
                }              

            }
        }
    }

    
}
