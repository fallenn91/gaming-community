<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\CommentCreated;
use App\Services\XpService;
use App\Services\AchievementService;

class HandleCommentCreated implements ShouldQueue
{
    use InteractsWithQueue;
    public string $queue = 'xp';
    /**
     * Create the event listener.
     */
    public function __construct(private XpService $xpService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CommentCreated $event): void
    {
        $user = $event->comment->user;

        $this->xpService->award($user, 5, 'Comment created');

        if ($user->userStat) {
          $user->userStat->increment('comments');
        }

        app(\App\Services\AchievementService::class)->check($user, 'comments');
    }
}
