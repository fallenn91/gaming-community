<?php

namespace App\Policies;

use App\Models\User;

class CommunityPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }

    public function create(User $user): bool
    {
      return $user->community_unlock_level >= 1
        && $user->ownedCommunities()->count() < 3
        && $user->reputation >= 100;
    }
}
