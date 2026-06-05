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

        if ($followed->reputation > 0) {
          $followed->decrement('reputation');
        }

        if ($follower->following_count > 0) {
          $follower->decrement('following_count');
        }

        if ($followed->followers_count > 0) {
          $followed->decrement('followers_count');
        }
    }
}
