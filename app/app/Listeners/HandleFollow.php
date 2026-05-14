<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\FollowReward;
use App\Services\LevelService;
use App\Events\UserFollowed;

class HandleFollow
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserFollowed $event): void
    {
        $follower = $event->follower;

        $followed = $event->followed;

        $reward = FollowReward::firstOrCreate([
          'follower_id' => $follower->id,
          'followed_id' => $followed->id,
        ], [
          'rewarded_at' => now(),
        ]);
        
        // Reputación siempre
        if ($reward->wasRecentlyCreated) {
            $follower->increment('xp', 2);
        }

        $followed->increment('reputation', 1);

        // Estado actual
        $follower->increment('following_count');

        $followed->increment('followers_count');

        // Level System
        app(LevelService::class)->checkLevelUp($follower);

        // Achievements
        $achievementService = app( \App\Services\AchievementService::class);

        $achievementService->check($follower, 'follows');

        $achievementService->check($followed, 'followers_received');
    }
}
