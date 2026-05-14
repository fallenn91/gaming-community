<?php

namespace App\Livewire\User;

use Livewire\Component;

class Presence extends Component
{
    public function render()
    {
        return view('livewire.user.presence');
    }

    public function ping()
    {
      auth()->user()?->update([
        'last_seen' => now(),
      ]);
    }
}
