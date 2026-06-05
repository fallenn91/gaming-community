<?php

namespace App\Services;
use App\Models\User;
use App\Events\UserLevelUp;

class LevelService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function checkLevelUp(User $user): void
    {
      $oldLevel = $user->level;

      $newLevel = floor(sqrt($user->xp) / 50) + 1;

      if ($newLevel <= $oldLevel) {
        return;
      }

      $user->update([
        'level' => $newLevel
      ]);

      event (new UserLevelUp($user, $newLevel));
    }
}
