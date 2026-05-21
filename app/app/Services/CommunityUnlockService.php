<?php

namespace App\Services;
use App\Models\User;

class CommunityUnlockService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    private function unlockLevel(User $user): int
    {
        return match (true) {
            $user->level >= 20 => 3,
            $user->level >= 10 && $user->reputation >= 150 => 2,
            $user->achievement_level >= 5 => 1,
            default => 0,
        };
    }

    public function evaluate(User $user): void
    {
        $level = $this->unlockLevel($user);

        if ($level > 0 && $user->community_unlock_level !== $level) {
            $user->community_unlock_level = $level;
            $user->can_create_communities = true;
            $user->save();
        }
    }
}
