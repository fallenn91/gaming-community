<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Game;
use App\Models\User;
use App\Models\Post;

class ExplorePage extends Component
{   
    public string $tab = 'games';

    public function setTab(string $tab)
    {
      $this->tab = $tab;
    }
    
    public function render()
    {
        return view('livewire.explore-page', [
          'games' => Game::latest()->take(12)->get(),
          'users' => User::latest()->take(12)->get(),
          'posts' => Post::latest()->take(12)->get(),
        ]);
    }
}
