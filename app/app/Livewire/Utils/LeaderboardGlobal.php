<?php

namespace App\Livewire\Utils;

use Livewire\Component;
use App\Models\User;

class LeaderboardGlobal extends Component
{
    public function render()
    {
        return view('livewire.utils.leaderboard-global', [
            'users' => User::query()
                ->orderByDesc('level')
                ->orderByDesc('xp')
                ->orderByDesc('reputation')
                ->limit(50)
                ->get(),
        ]);
    }
}
