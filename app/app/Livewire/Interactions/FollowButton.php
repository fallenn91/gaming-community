<?php

namespace App\Livewire\Interactions;

use App\Events\UserFollowed;
use App\Events\UserUnfollowed;
use App\Models\Follow;
use App\Models\User;
use Livewire\Component;

class FollowButton extends Component
{
    public $user;
    public bool $isFollowing = false;
    public int $followersCount = 0;
    public int $followingCount = 0;

    public function mount(User $user): void
    {
        $this->user = $user;

        $authUser = auth()->user();

        if (! $authUser) {
            $this->isFollowing = false;

            return;
        }

        $this->isFollowing = Follow::where('follower_id', $authUser->id)
            ->where('following_id', $user->id)
            ->exists();
    }

    public function toggleFollow(): void
    {
        $authUser = auth()->user();

        if (! $authUser || $authUser->id === $this->user->id) {
            return;
        }

        $existing = Follow::where('follower_id', $authUser->id)
            ->where('following_id', $this->user->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $this->isFollowing = false;

            event(new UserUnfollowed($authUser, $this->user));
        } else {
            Follow::create([
                'follower_id' => $authUser->id,
                'following_id' => $this->user->id,
            ]);

            $this->isFollowing = true;

            event(new UserFollowed($authUser, $this->user));
        }

        $this->followersCount = $this->user->followers()->count();
        $this->followingCount = $this->user->following()->count();
        $this->dispatch('followUpdated', userId: $this->user->id);
    }

    public function render()
    {
        return view('livewire.interactions.follow-button');
    }
}
