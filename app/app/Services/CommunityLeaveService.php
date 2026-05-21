<?php

namespace App\Services;

use App\Models\Community;
use App\Models\User;
use App\Services\CommunityXpService;


class CommunityLeaveService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private CommunityXpService $xpService)
    {
        //
    }

    public function leave(User $user, Community $community): void
    {
      $membership = $community->members()
        ->where('user_id', $user->id)
        ->first();

      if (!$membership) {
        return;
      }

      // Penalización

      $penalty = min(10, $membership->pivot->contribution ?? 0);

      // 1. Reputación usuario
      $user->decrement('reputation', $penalty);

      // 2. Afecta XP comunidad
      $community->decrement('xp', $penalty);

      // 3. Eliminar del grupo
      $community->members()->detach($user->id);

    }
}
