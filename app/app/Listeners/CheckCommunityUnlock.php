<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserLevelUp;
use App\Services\CommunityUnlockService;

class CheckCommunityUnlock
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
    public function handle(UserLevelUp $event): void
    {
        app(CommunityUnlockService::class)->evaluate(event(new CommunityUnlocked($event->user)));
    }
}
