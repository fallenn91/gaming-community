<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use App\Models\Achievement;

class ProfileView extends Component
{
    public $user;
    public $followersCount;
    public $followingCount;
    public $likesCount;
    public $achievements;

    public $listeners = [
      'followUpdated' => 'refreshStats',
    ];

    public function mount(User $user)
    {
      
      $this->user = $user;
      
      $this->achievements = $this->user->userStat()->first();

    }

    public function render()
    {
      return view('livewire.users.profile-view', [
        'user' => $this->user,
        'achievements' => $this->achievements,
      ]);
    }

    public function refreshStats($userId)
    {
        if ($this->user->id !== $userId) {
          return;
        }

        $this->followersCount = $this->user->followers()->count();
        $this->followingCount = $this->user->following()->count();
        $this->likesCount = $this->user->likes()->count();
    }

}
