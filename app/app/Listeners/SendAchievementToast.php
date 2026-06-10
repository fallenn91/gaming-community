<?php

namespace App\Listeners;

use App\Events\AchievementUnlocked;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

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
        // Guarda el achievement pendiente en caché para que Livewire lo recoja
        $key = 'achievement_toast:' . $event->user->id;

        $pending = Cache::get($key, []);
        $pending[] = [
          'name' => $event->achievement->name,
          'xp' => $event->achievement->xp_reward ?? 0,
        ];

        Cache::put($key, $pending, 60); // Expire en 60 segundos
        
    }
}
