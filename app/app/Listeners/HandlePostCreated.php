<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\PostCreated;
use App\Services\AchievementService;
use App\Services\XpService;

class HandlePostCreated implements ShouldQueue
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
    public function handle(PostCreated $event): void
    {
        $user = $event->post->user;

        $this->xpService->award($user, 10, 'Post created');
        app(\App\Services\ReputationService::class)->gain($user, 'post_created');

        $user->userStat()->firstOrCreate()->increment('posts_count');
        
        app(AchievementService::class)->check($user, 'posts');
    }
}
