<?php

namespace App\Livewire\Games;

use Livewire\Component;
use App\Models\Game;
use App\Services\IgdbService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class GameSearch extends Component
{
    public string $query = '';
    public string $results;
    public bool $loading = false;

    public function updatedQuery(): void
    {
      if (strlen($this->query) < 2) return;

      $cacheKey = 'igdb:search' . md5($this->query);
      $this->results = Cache::remember($cacheKey, 3600, function () {
        return rescue(
          fn() => app(IgdbService::class)->searchGames($this->query), []
        );
      });
    }

    public function render()
    {
      return view('livewire.games.game-search');
    }
}
