<?php

namespace App\Livewire\Communities;

use App\Models\Community;
use App\Models\CommunityJoinRequest;
use App\Services\CommunityJoinService;
use Livewire\Component;

class CommunityJoin extends Component
{
    public Community $community;
    public bool $isMember = false;
    public bool $isPending = false;
    public bool $isRejected = false;
    public bool $isBanned = false;

    public function mount(Community $community): void
    {
        $this->community = $community;

        $authUser = auth()->user();

        if (! $authUser) {
            return;
        }

        $this->isMember = $community->owner_id === $authUser->id
            || $community->members()->where('user_id', $authUser->id)->exists();

        $this->isPending = CommunityJoinRequest::where('community_id', $this->community->id)
            ->where('user_id', $authUser->id)
            ->where('status', 'pending')
            ->exists();

        $this->isRejected = CommunityJoinRequest::where('community_id', $this->community->id)
            ->where('user_id', $authUser->id)
            ->where('status', 'rejected')
            ->exists();

        $this->isBanned = $community->members()
            ->where('user_id', $authUser->id)
            ->wherePivot('is_banned', true)
            ->exists();
    }

    public function join(): void
    {
        $authUser = auth()->user();

        if (! $authUser || $this->isMember || $this->isPending) {
            return;
        }

        $joined = app(CommunityJoinService::class)->join($authUser, $this->community);

        $this->isMember = $joined && $this->community->visibility !== 'private';
        $this->isPending = $this->community->visibility === 'private' && $joined;

        // update rejected flag in case the service prevented re-request
        $this->isRejected = CommunityJoinRequest::where('community_id', $this->community->id)
            ->where('user_id', $authUser->id)
            ->where('status', 'rejected')
            ->exists();

        if ($this->isMember) {
            $this->dispatch('community-joined', communityId: $this->community->id);
        }
    }

    public function render()
    {
        return view('livewire.communities.community-join');
    }
}
