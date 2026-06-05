<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\LikeCreated;
use App\Events\PostCreated;
use App\Events\CommentCreated;
use App\Services\CommunityXpService;

class AwardGuildXp
{
    /**
     * Create the event listener.
     */
    public function __construct(private CommunityXpService $xpService)
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(LikeCreated | PostCreated | CommentCreated $event): void
    {
      // Match es parecido a un switch/if/else
      // Devuelve un valor
      // Usa comparación estricta ===
      [$community, $user, $xp, $source] = match (true) {
        $event instanceof PostCreated => [
          $event->post->communityPosts()->first()?->community, // Devuelve colección, no un objeto
          $event->post->user,
          15, 'post'
        ],
        $event instanceof LikeCreated => [
          $event->like->post->community,
          $event->like->user,
          2, 'like'
        ],
        $event instanceof CommentCreated => [
          $event->comment->post->community,
          $event->comment->user,
          2, 'comment'
        ],
      };

      if (!$community) return; 

      $this->xpService->addXp($community, $xp, $user, $source);
        
    }
}
