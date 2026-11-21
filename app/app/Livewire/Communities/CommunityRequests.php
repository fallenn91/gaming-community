<?php

namespace App\Livewire\Communities;

use App\Models\Community;
use App\Models\CommunityJoinRequest;
use App\Notifications\CommunityJoinRejectedNotification;
use Livewire\Component;

class CommunityRequests extends Component
{
    public Community $community;
    public $requests;

    public function mount(Community $community): void
    {
        $this->community = $community;
        $this->loadRequests();
    }

    public function loadRequests(): void
    {
        $this->requests = $this->community->joinRequests()->where('status', 'pending')->with('user')->get();
    }

    public function approve(int $requestId): void
    {
        $request = CommunityJoinRequest::where('id', $requestId)
            ->where('community_id', $this->community->id)
            ->first();

        if (! $request || auth()->id() !== $this->community->owner_id) {
            return;
        }

        $request->update(['status' => 'approved']);

        $this->community->members()->syncWithoutDetaching([
            $request->user_id => ['role' => 'member'],
        ]);

        $this->loadRequests();
    }

    public function deny(int $requestId): void
    {
        $request = CommunityJoinRequest::where('id', $requestId)
            ->where('community_id', $this->community->id)
            ->first();

        if (! $request || auth()->id() !== $this->community->owner_id) {
            return;
        }

        $request->update(['status' => 'rejected']);

        $request->user?->notify(new CommunityJoinRejectedNotification($this->community));

        $this->loadRequests();
    }

    public function render()
    {
        return view('livewire.communities.community-requests');
    }
}
