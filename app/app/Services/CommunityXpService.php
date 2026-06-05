<?php

namespace App\Services;
use App\Models\CommunityXpLog;
use App\Models\Community;
use App\Models\User;

class CommunityXpService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function addXp(Community $community, int $xp, ?User $user = null, string $source = 'general')
    {
      $community->increment('xp', $xp);

      CommunityXpLog::create([
        'community_id' => $community->id,
        'user_id' => $user?->id,
        'xp' => $xp,
        'source' => $source,
      ]);

      $this->checkLevelUp($community);
    }

    private function checkLevelUp(Community $community)
    {
       while ($community->xp >= $this->xpForNextLevel($community->level)) {

            $neededXp = $this->xpForNextLevel($community->level);

            $community->xp -= $neededXp;
            $community->level++;

            $community->save();
        }
    }

    private function xpForNextLevel(int $level): int
    {
      return max(200, ($level * $level) * 200);
    }
}
