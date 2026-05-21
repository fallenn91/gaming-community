<?php

namespace App\Livewire\Communities;

use Livewire\Component;
use App\Models\Community;

class CommunityShow extends Component
{
    public function render()
    {
        return view('livewire.communities.community-show');
    }

    public function mount(string $slug)
    {
      $community = Community::where('slug', $slug)->firstOrFail();
    }
}
