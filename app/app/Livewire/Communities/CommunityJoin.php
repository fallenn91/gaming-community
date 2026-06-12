<?php

namespace App\Livewire\Communities;

use Livewire\Component;
use App\Services\CommunityJoinService;

class CommunityJoin extends Component
{

    public Community $community;

    public function mount()
    {
      $this->community = $community;
    }

    public function join()
    {
      app(CommunityJoinService::class)->join(auth()->user(), $this->community);
    }
    public function render()
    {
        return view('livewire.communities.community-join');
    }
}
