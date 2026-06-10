<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\LikeCreated;
use App\Services\XpService;
use App\Services\AchievementService;

class HandleLikeCreated implements ShouldQueue
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
    public function handle(LikeCreated $event): void
    {
        $user = $event->like->post->user;

        $this->xpService->award($user, 2, 'Like created');
        app(\App\Services\ReputationService::class)->gain($postOwner, 'like_received');

        if ($user->userStat) {
          $user->userStat->increment('likes');
        }
        
        app(\App\Services\AchievementService::class)->check($user, 'likes_received');
    }
}
