<?php

namespace App\Services;

use App\Models\Community;
use App\Models\CommunityJoinRequest;
use App\Models\User;

class CommunityJoinService
{
    public function join(User $user, Community $community): bool
    {
        if ($this->isMember($user, $community)) {
            return false;
        }

        // Prevent banned users from joining again
        $isBanned = $community->members()
            ->where('user_id', $user->id)
            ->wherePivot('is_banned', true)
            ->exists();

        if ($isBanned) {
            return false;
        }

        // Prevent users from re-requesting if they were explicitly rejected
        $previousRejected = CommunityJoinRequest::where('user_id', $user->id)
            ->where('community_id', $community->id)
            ->where('status', 'rejected')
            ->exists();

        if ($previousRejected) {
            return false;
        }

        if ($community->visibility === 'private') {
            $this->requestJoin($user, $community);

            return true;
        }

        $community->members()->syncWithoutDetaching([
            $user->id => ['role' => 'member'],
        ]);

        $community->refresh();

        return true;
    }

    private function requestJoin(User $user, Community $community): void
    {
        // Only create a pending request if there isn't a previous rejected or pending record
        $existing = CommunityJoinRequest::where('user_id', $user->id)
            ->where('community_id', $community->id)
            ->first();

        if ($existing) {
            // If it's rejected, don't recreate; if pending/approved, leave as-is
            return;
        }

        CommunityJoinRequest::create([
            'user_id' => $user->id,
            'community_id' => $community->id,
            'status' => 'pending',
        ]);
    }

    private function isMember(User $user, Community $community): bool
    {
        return $community->members()->where('user_id', $user->id)->exists();
    }
}
