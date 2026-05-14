<?php

namespace App\Services;

class CommunityRankService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function updateRank(Community $community)
    {
      $community->rank = match (true) {
        $community->level >= 50 => 'Legend',
        $community->level >= 30 => 'Diamond',
        $community->level >= 15 => 'gold',
        $community->level >= 5 => 'Silver',
        default => 'Bronze',
      };

      $community->save();
      
    }
}
