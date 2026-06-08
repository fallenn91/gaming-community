<?php

namespace App\Services;
use App\Models\User;

class UserStatsService
{
    public function getStats(User $user): array
    {
        return [
            'posts' => $user->posts()->count(),
            'comments' => $user->comments()->count(),
            'follows' => $user->following()->count(),
            'followers_received' => $user->followers()->count(),
            'reputation' => $user->reputation,
            'likes_received' => $this->getLikesReceived($user),
        ];
    }

    private function getLikesReceived(User $user): int
    {
        return $user->posts()
            ->withCount('likes')
            ->sum('likes_count');
    }
}
