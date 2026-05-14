<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PostCreated;
use App\Services\AchievementService;

class HandlePostCreated
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
    public function handle(PostCreated $event): void
    {
        $user = $event->post->user;

        $user->increment('xp', 10);

        if ($user->userStat) {
          $user->userStat->increment('posts');
        }

        app(AchievementService::class)->check($user, 'posts');
    }
}
