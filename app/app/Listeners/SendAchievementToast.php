<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendAchievementToast
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
    public function handle(AchievementUnlocked $event): void
    {
        \Livewire\Livewire::dispatch('achievementUnlocked', [
            'name' => $event->achievement->name,
            'xp' => $event->achievement->xp_reward,
        ]);
    }
}
