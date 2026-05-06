<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\LikeCreated;

class HandleLikeCreated
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
    public function handle(LikeCreated $event): void
    {
        $user = $event->like->post->user;

        $user->increment('xp', 2);

        if ($user->userStat) {
          $user->userStat->increment('likes');
        }

        app(\App\Services\AchievementService::class)->check($user, 'likes_received');
    }
}
