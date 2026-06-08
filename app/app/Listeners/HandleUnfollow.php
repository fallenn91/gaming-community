<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserUnfollowed;

class HandleUnfollow implements ShouldQueue
{
    use InteractsWithQueue;

    public string $queue = 'xp';
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
    public function handle(UserUnfollowed $event): void
    {
        $follower = $event->follower;

        $followed = $event->followed;

        $followingExists = Follow::where('follower_id', $follower->id)
          ->where('following_id', $followed->id)
          ->exists();

        if (!followingExists) {
            return;
        }

        \DB::table('users')
            ->where('id', $follower->id)
            ->where('following_count', '>', 0)
            ->decrement('following_count');
 
        \DB::table('users')
            ->where('id', $followed->id)
            ->where('followers_count', '>', 0)
            ->decrement('followers_count');
 
        // Reputación 
        \DB::table('users')
            ->where('id', $followed->id)
            ->where('reputation', '>', 0)
            ->decrement('reputation');
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
