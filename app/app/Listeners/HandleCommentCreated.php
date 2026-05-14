<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CommentCreated;

class HandleCommentCreated
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
    public function handle(CommentCreated $event): void
    {
        $user = $event->comment->user;

        $user->increment('xp', 5);

        if ($user->userStat) {
          $user->userStat->increment('comments');
        }

        app(\App\Services\AchievementService::class)->check($user, 'comments');
    }
}
