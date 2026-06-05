<?php

namespace App\Services;

use App\Models\Community;
use App\Models\User;
use Illuminate\Support\Str;

class CommunityCreationService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    private function checkCooldown(User $user): void
    {
      if (
        $user->ownedCommunities()->where('created_at', '>=', now()->subDays(7))->exists()
      ) {
        abort(403, 'Cooldown active (7 days)');
      }
    }

    public function create(User $user, array $data): Community
    {
      $this->checkCooldown($user);
      $this->checkPermissions($user);

      return Community::Create([
        'owner_id' => $user->id,
        'game_id' => $data['game_id'] ?? null,
        'name' => $data['name'],
        'slug' => Str::slug($data['name']) . '-' . uniqid(),
        'description' => $data['description'] ?? null,
        'visibility' => $data['visibility'],
        'image' => $data['image'] ?? null,
      ]);
    }

    private function checkPermissions(User $user): void
    {
      dd($user->is_admin);
      if ((bool) $user->is_admin) {
        return;
      }
      if (
        $user->level < 10 ||
        $user->reputation < 100 ||
        $user->achievement_level < 5
      ) {
        abort(403, 'You do not meet the requirements to create a community.');
      }
    }
}
