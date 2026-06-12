<?php

namespace App\Livewire\Games;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use App\Models\Game;

class GameActions extends Component
{
    public Game $game;
    public $userGame;
    public bool $showStatuses = true;

    public function toggleLibrary()
    {
      $user = Auth::user();

      $exists = $user->games()->where('game_id', $this->game->id)->exists();

      if ($exists) {
        $user->games()->detach($this->game->id);
      } else {
        $user->games()->attach($this->game->id, [
          'status' => 'playing',
          'hours_played' => 0
        ]);
      }
      $this->game->refresh();
    }

    public function setStatus(string $status)
    {
      $user = auth()->user();

      $user->games()->updateExistingPivot(
        $this->game->id,
        ['status' => $status]
      );

      $this->userGame = $user->games()->where('game_id', $this->game->id)->first();
    }

    public function render()
    {
        $userGame = Auth::user()->games()->where('game_id', $this->game->id)->first();

        return view('livewire.games.game-actions', [
          'userGame' => $userGame
        ]);
    }
}
