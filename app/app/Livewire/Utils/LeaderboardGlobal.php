<?php

namespace App\Livewire\Utils;

use Livewire\Component;
use App\Models\User;

class LeaderboardGlobal extends Component
{
    public function render()
    {
      $leaderboard = User::query()
        ->orderByDesc('xp')
        ->orderByDesc('reputation')
        ->orderByDesc('level')
        ->limit(50)
        ->get();

    return view('livewire.utils.leaderboard-global', [
        'leaderboard' => $leaderboard,
    ]);
    }
}
