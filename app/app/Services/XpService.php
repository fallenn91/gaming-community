<?php

namespace App\Services;
use App\Models\User;
use App\Services\LevelService;
use Illuminate\Support\Facades\Cache;

class XpService
{
    private const LIMITS = [
      'Post created' => ['times' => 5, 'window' => 3600], // 50 XP/hora
      'Comment created' => ['times' => 10, 'window' => 3600], // 50 XP/hora
      'Like created' => ['times' => 20, 'window' => 3600], // 50 XP/hora
      'Followed' => ['times' => 5, 'window' => 3600], // 50 XP/hora
    ];
    /**
     * Create a new class instance.
     */
    public function __construct(private LevelService $levelService) 
    {
        //
    }

    public function award(User $user, int $amount, string $reason = ''): void
    {
      if (!$this->canEarnXp($user, $reason)) {
        return; // Acción se realiza pero sin xp
      }

      $user->increment('xp', $amount);
      $user->refresh();
      $this->levelService->checkLevelUp($user);

      event('xp-updated.' . $user->id);
    }

    private function canEarnXp(User $user, string $reason): bool
    {
      // Busca si esta razón tiene límite
      $limitKey = collect(self::LIMITS)->keys()->first(
        fn($key) => str_starts_with($reason, $key)
      );

      if (!$limitKey) {
        return true; // Sin limite configurado = permitido
      }

      $limit = self::LIMITS[$limitKey];
      $cacheKey = "xp_limit:{$user->id}:{$limitKey}";

      $count = Cache::get($cacheKey, 0);

      if ($count >= $limit['times']) {
        return false; // Límite superado
      }

      Cache::put($cacheKey, $count + 1, $limit['window']);
      return true;
    }
}
