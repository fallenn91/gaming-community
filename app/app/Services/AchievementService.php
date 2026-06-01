<?php

namespace App\Services;
use App\Models\Achievement;
use App\Models\UserAchievement;

class AchievementService
{
    $stats = [
        'posts' => $user->posts()->count(),
        'comments' => $user->comments()->count(),
        'follows' => $user->following()->count(),
        'followers_received' => $user->followers()->count(),
        'reputation' => $user->reputation,
        'likes_received' =>
            $user->posts()->withCount('likes')->get()->sum('likes_count'),
    ];
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

    private function meetsCondition($user, $achievement)
    {
        return ($stats[$achievement->type] ?? 0) >= $achievement->threshold;
    }
}
