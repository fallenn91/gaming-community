<?php

namespace Tests\Feature;

use App\Models\Community;
use App\Models\CommunityJoinRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommunityJoinPreventionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_cannot_re_request_after_being_rejected(): void
    {
        $owner = User::factory()->create();
        $user = User::factory()->create();

        $community = Community::factory()->create(['owner_id' => $owner->id, 'visibility' => 'private']);

        CommunityJoinRequest::create([
            'community_id' => $community->id,
            'user_id' => $user->id,
            'status' => 'rejected',
        ]);

        $response = app()->make(\App\Services\CommunityJoinService::class)->join($user, $community);

        $this->assertFalse($response);
    }

    public function test_banned_user_cannot_join_again(): void
    {
        $owner = User::factory()->create();
        $user = User::factory()->create();

        $community = Community::factory()->create(['owner_id' => $owner->id, 'visibility' => 'public']);
        $community->members()->attach($user->id, ['role' => 'member', 'is_banned' => true]);

        $response = app()->make(\App\Services\CommunityJoinService::class)->join($user, $community);

        $this->assertFalse($response);
    }
}
