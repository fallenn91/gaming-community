<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;

class ProfileView extends Component
{
    public $user;
    public $followersCount;
    public $followingCount;
    public $likesCount;

    public $listeners = [
      'followUpdated' => 'refreshStats',
    ];

    public function mount(User $user)
    {
      $this->user = $user;

      $this->followersCount = $user->followers()->count();
      $this->followingCount = $user->following()->count();
      $this->likesCount = $user->likes()->count();
    }
    public function render()
    {
      return view('livewire.users.profile-view');
    }

    public function refreshStats($userId)
    {
        if ($this->user->id !== $userId) {
          return;
        }

        $this->followersCount = $this->user->followers()->count();
        $this->followingCount = auth()->user()->following()->count();
        $this->likesCount = $this->user->likes()->count();
    }
}
