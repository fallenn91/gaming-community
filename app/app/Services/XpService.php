<?php

namespace App\Services;
use App\Models\User;
use App\Services\LevelService;

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
      $user->increment('xp', $amount);
      $user->refresh();
      $this->levelService->checkLevelUp($user);
    }
}
