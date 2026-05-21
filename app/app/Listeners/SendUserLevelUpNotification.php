<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\UserLevelUp;
use App\Notifications\LevelUpNotification;

class SendUserLevelUpNotification
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
        $user = $event->user;

        $user->notify(new \App\Notifications\LevelUpNotification(
          $event->level
        ));
    }
}
