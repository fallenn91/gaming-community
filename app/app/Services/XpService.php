<?php

namespace App\Services;

class XpService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private LevelService $levelService) 
    {
        //
    }

    public function award(User $user, int $amount, string $reason = ''): void
    {
      $user->increament('xp', $amount);
      $user->refresh();
      $this->levelService->checkLevelUp($user);
    }
}
