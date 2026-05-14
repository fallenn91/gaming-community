<?php

namespace App\Livewire\Games;

use Livewire\Component;

class GameLibrary extends Component
{
    public string $filter = 'playing';

    public function getGamesProperty()
    {
      return auth()->user()->games()->wherePivot('status', $this->filter)->get();
    }
    public function render()
    {
        return view('livewire.games.game-library');
    }
}
