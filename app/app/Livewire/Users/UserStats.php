<?php

namespace App\Livewire\Users;

use Livewire\Component;

class UserStats extends Component
{
    public $postsCount;
    public $likesCount;

    public function mount()
    {
      $this->postsCount = Post::where('user_id', Auth::id())->count();
      $this->likesCount = Post::where('user_id', Auth::id()->sum('likes'));
    }

    public function render()
    {
        return view('livewire.users.user-stats');
    }
}
