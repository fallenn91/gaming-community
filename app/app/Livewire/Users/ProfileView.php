<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;

class ProfileView extends Component
{
    public $user;

    public function mount(User $user)
    {
      $user = auth()->user();
    }
    public function render()
    {
      return view('livewire.users.profile-view');
    }
}
