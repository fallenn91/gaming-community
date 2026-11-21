<?php

namespace Tests\Feature;

use App\Livewire\Communities\CommunityMembers;
use App\Models\Community;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CommunityOwnerModerationTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_can_kick_a_member_from_the_community(): void
    {
        $owner = User::factory()->create();
        $member = User::factory()->create(['username' => 'owner-member']);

        $community = Community::factory()->create(['owner_id' => $owner->id]);
        $community->members()->attach($member->id, ['role' => 'member']);

        Livewire::actingAs($owner)
            ->test(CommunityMembers::class, ['community' => $community])
            ->assertSee('Expulsar')
            ->call('kickMember', $member->id);

        $this->assertFalse($community->members()->where('users.id', $member->id)->exists());
    }

    public function test_owner_can_ban_a_member_from_the_community(): void
    {
        $owner = User::factory()->create();
        $member = User::factory()->create(['username' => 'owner-member-2']);

        $community = Community::factory()->create(['owner_id' => $owner->id]);
        $community->members()->attach($member->id, ['role' => 'member']);

        Livewire::actingAs($owner)
            ->test(CommunityMembers::class, ['community' => $community])
            ->call('banMember', $member->id);

        $this->assertDatabaseHas('community_users', [
            'community_id' => $community->id,
            'user_id' => $member->id,
            'is_banned' => 1,
        ]);
    }
}
