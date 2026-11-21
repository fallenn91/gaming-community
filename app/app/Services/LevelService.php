<?php

namespace App\Services;

use App\Events\UserLevelUp;
use App\Models\User;

class LevelService
{
    public function checkLevelUp(User $user): void
    {
        $oldLevel = (int) $user->level;
        $newLevel = (int) floor(sqrt((int) $user->xp) / 50) + 1;

        if ($newLevel <= $oldLevel) {
            return;
        }

        $user->update([
            'level' => $newLevel,
        ]);

        event(new UserLevelUp($user, $newLevel));
    }
}
