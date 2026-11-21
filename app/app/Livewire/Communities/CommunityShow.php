<?php

namespace App\Livewire\Communities;

use App\Models\Community;
use Livewire\Component;

class CommunityShow extends Component
{
    public Community $community;

    public function mount(string $slug): void
    {
        $this->community = Community::where('slug', $slug)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.communities.community-show');
    }
}
