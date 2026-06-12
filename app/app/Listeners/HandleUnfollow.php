<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserUnfollowed;
use App\Models\Follow;
use App\Services\ReputationService;

class HandleUnfollow implements ShouldQueue
{
    use InteractsWithQueue;

    public string $queue = 'xp';
    /**
     * Create the event listener.
     */
    public function __construct(protected ReputationService $reputationService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserUnfollowed $event): void
    {
        $follower = $event->follower;

        $followed = $event->followed;

        \DB::table('users')
            ->where('id', $follower->id)
            ->where('following_count', '>', 0)
            ->decrement('following_count');
 
        \DB::table('users')
            ->where('id', $followed->id)
            ->where('followers_count', '>', 0)
            ->decrement('followers_count');
 
        // Reputación 
        $this->reputationService->lose($followed, 'follower_lost');
    }

    public function failed(UserUnfollowed $event, \Throwable $exception): void
    {
      \Log::error('HandleUnfollow job failed.', [
        'follower_id' => $event->follower->id,
        'followed_id' => $event->followed->id,
        'error' => $exception->getMessage(),
      ]);
    }
}
