<?php

namespace App\Services;
use App\Models\User;

class ReputationService
{
    private const GAINS = [
      'post_created' => 5,
      'comment_created' => 2,
      'like_received' => 3,
      'follower_gained' => 4,
    ];

    private const LOSSES = [
      'post_deleted' => 5,
      'like_removed' => 3,
      'follower_lost' => 4,
    ];

    private const VOTES = [
      'upvote' => 10,
      'downvote' => 8,
    ];

    public function gain(User $user, string $reason): void 
    {
      $points = self::GAINS[$reason] ?? 0;

      if ($points > 0) {
        $user->increment('reputation', $points);
      }
    }

    public function lose(User $user, string $reason): void
    {
      $points = self::LOSSES[$reason] ?? 0;

      if ($points > 0) {
        $newReputation = max(0, $user->reputation - $points);
        $user->update(['reputation' => $newReputation]);
      }
    }

    public function vote(User $target, User $voter, string $type): array
    {
      if ($target->id === $voter->id) {
        return ['success' => false, 'message' => 'You can not vote for yourself.'];
      }

      $cacheKey = "rep_vote:{$voter->id}:{$target->id}";
      $lastVote = \Illuminate\Support\Facades\Cache::get($cacheKey);

      if ($lastVote) {
        return ['success' => false, 'message' => 'You have already voted this user today.'];
      }

      if ($type === 'upvote') {
        $target->increment('reputation', self::VOTES['upvote']);
      } else {
        $newReputation = max(0, $target->reputation - self::VOTES['downvote']);
        $target->update(['reputation' => $newReputation]);
      }

      \Illuminate\Support\Facades\Cache::put($cacheKey, $type, now()->addHours(24));

      return ['success' => true, 'reputation' => $target->fresh()->reputation];
    }

    public function getTitle(User $user): string
    {
      return match (true) {
          $user->reputation >= 1000 => '⭐ Leyenda',
          $user->reputation >= 500  => '💎 Experto',
          $user->reputation >= 200  => '🔥 Veterano',
          $user->reputation >= 100  => '⚡ Conocido',
          $user->reputation >= 50   => '🌱 Regular',
          default                   => '👤 Nuevo',
      };
    }
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }
}
