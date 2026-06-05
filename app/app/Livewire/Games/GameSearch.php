<?php

namespace App\Livewire\Games;

use Livewire\Component;
use App\Models\Game;
use App\Services\IgdbService;

class GameSearch extends Component
{
    public string $query = '';
    public string $results;
    public bool $loading = false;
    public function updatedQuery(): void
    {
      if (strlen($this->query) < 2) {
        $this->results = [];
        return;
      }

      $this->loading = true;
      $this->results = app(IgdbService::class)->search($this->query);
      $this->loading = false;
    }

    public function render()
    {
      return view('livewire.games.game-search');
    }
}
