<?php

namespace App\Livewire\Games;

use Livewire\Component;
use App\Models\Game;

class GameSearch extends Component
{
    public string $search = '';
    public function render()
    {
        return view('livewire.games.game-search', [
          'games' => Game::whereRaw('LOWER(name) LIKE ?',
            ['%' . strtolower($this->search) . '%']
          )->get()
        ]);
    }
}
