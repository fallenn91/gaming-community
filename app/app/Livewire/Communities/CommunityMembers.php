<?php

namespace App\Livewire\Communities;

use App\Models\Community;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CommunityMembers extends Component
{
    public Community $community;

    public function mount(Community $community): void
    {
        $this->community = $community;
    }

    public function kickMember($userId): void
    {
        if (! Auth::check()) {
            return;
        }

        $current = Auth::user();

        // allow if admin or community owner
        if (! ($current->isAdmin() || $current->id === $this->community->owner_id)) {
            return;
        }

        $this->community->members()->detach($userId);
    }

    public function banMember($userId): void
    {
        if (! Auth::check()) {
            return;
        }

        $current = Auth::user();

        // allow if admin or community owner
        if (! ($current->isAdmin() || $current->id === $this->community->owner_id)) {
            return;
        }

        $this->community->members()->updateExistingPivot($userId, ['is_banned' => true]);
    }

    public function render()
    {
        return view('livewire.communities.community-members', [
            'members' => $this->community->members()->withPivot(['role', 'is_banned'])->get(),
            'canModerate' => Auth::check() && (Auth::user()->isAdmin() || Auth::id() === $this->community->owner_id),
        ]);
    }
}
