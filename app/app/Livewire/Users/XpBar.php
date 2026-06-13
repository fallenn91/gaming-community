<?php

namespace App\Livewire\Users;

use Livewire\Component;
use Livewire\Attributes\On;

class XpBar extends Component
{
    public int $xp;
    public int $level;

    public function mount(): void
    {
      $this->refresh();
    }

    #[On('xp-updated')]
    public function refresh(): void
    {
      $user = auth()->user()->fresh();
      $this->xp = $user->xp;
      $this->level = $user->level;
    }
    
    public function render()
    {
        return view('livewire.users.xp-bar');
    }
}
