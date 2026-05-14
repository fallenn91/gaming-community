<?php

namespace App\Services;
use App\Models\User;
use App\Models\Community;
use App\Models\CommunityJoinRequest;

class CommunityJoinService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function join(User $user, Community $community)
    {
      if ($this->isMember($user, $community)) {
        return;
      }

      if ($community->visibility === 'private') {
        return $this->requestJoin($user, $community);
      }

      $community->members()->syncWithoutDetaching([
        $user->id => ['role' => 'member']
      ]);
    }

    private function requestJoin(User $user, Community $community): void
    {
      CommunityJoinRequest::firstOrCreate([
        'user_id' => $user->id,
        'community_id' => $community->id,
      ], [
        'status' => 'pending',
      ]);
    }

    private function isMember(User $user, Community $community): bool {
      return $community->members()->where('user_id', $user->id)->exists();
    }
}
