<?php

namespace Tests\Feature;

use App\Models\Community;
use App\Models\CommunityJoinRequest;
use App\Models\User;
use App\Services\CommunityJoinService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommunityJoinTest extends TestCase
{
    use RefreshDatabase;

    public function test_public_community_adds_member_immediately(): void
    {
        $user = User::factory()->create();
        $community = Community::factory()->create(['visibility' => 'public']);

        $service = app(CommunityJoinService::class);
        $result = $service->join($user, $community);

        $this->assertTrue($result);
        $this->assertTrue($community->members()->where('user_id', $user->id)->exists());
        $this->assertDatabaseMissing('community_join_requests', [
            'community_id' => $community->id,
            'user_id' => $user->id,
        ]);
    }

    public function test_private_community_creates_pending_request(): void
    {
        $user = User::factory()->create();
        $community = Community::factory()->create(['visibility' => 'private']);

        $service = app(CommunityJoinService::class);
        $result = $service->join($user, $community);

        $this->assertTrue($result);
        $this->assertDatabaseHas('community_join_requests', [
            'community_id' => $community->id,
            'user_id' => $user->id,
            'status' => 'pending',
        ]);
        $this->assertFalse($community->members()->where('user_id', $user->id)->exists());
    }
}
