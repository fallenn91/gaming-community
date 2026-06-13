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
          'games' => Game::withCount('users')
            ->orderByDesc('users_count')
            ->take(12)
            ->get(),
          'users' => User::withCount('followers')
            ->orderByDesc('users.followers_count')
            ->take(12)
            ->get(),
          'posts' => Post::withCount('likes')
            ->orderByDesc('likes_count')
            ->take(12)
            ->get(),
        ]);
    }
}
