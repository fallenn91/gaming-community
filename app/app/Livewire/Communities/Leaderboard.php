<?php

namespace App\Livewire\Communities;

use Livewire\Component;

class Leaderboard extends Component
{
    public function render()
    {
        return view('livewire.communities.leaderboard', [
          'communities' => Community::query()
            ->orderByDesc('level')
            ->orderByDesc('xp')
            ->limit(50)
            ->get(),
        ]);
    }
}
