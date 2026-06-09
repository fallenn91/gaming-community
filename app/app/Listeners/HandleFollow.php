<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\FollowReward;
use App\Services\LevelService;
use App\Events\UserFollowed;
use App\Services\AchievementService;
use App\Services\XpService;
use App\Notifications\NewFollowerNotification;

class HandleFollow implements ShouldQueue
{
    use InteractsWithQueue;
    public string $queue = 'xp';
    /**
     * Create the event listener.
     */
    public function __construct(private XpService $xpService, private AchievementService $achievementService)
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

        $followExists = Follow::where('follower_id', $follower->id)
          ->where('following_id', $followed->id)
          ->exists();

        if (!followExists) {
            return;
        }

        $reward = FollowReward::firstOrCreate([
          'follower_id' => $follower->id,
          'followed_id' => $followed->id,
        ], [
          'rewarded_at' => now(),
        ]);
        
        // Reputación siempre
        if ($reward->wasRecentlyCreated) {
            $this->xpService->award($follower, 2, 'Followed ' . $followed->username);
        }

        $followed->increment('reputation', 1);

        // Estado actual
        $follower->increment('following_count');

        $followed->increment('followers_count');

        $followed->notify(new NewFollowerNotification($follower));
        
        $this->achievementService->check($follower, 'follows');

        $this->achievementService->check($followed, 'followers_received');
    }

    public function failed(UserFollowed $event, \Throwable $exception): void
    {
      \Log::error('HandleFollow job failed.', [
        'follower_id' => $event->follower->id,
        'followed_id' => $event->followed->id,
        'error' => $exception->getMessage(),
      ]);
    }
}
