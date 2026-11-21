<?php

namespace Tests\Feature;

use App\Livewire\Communities\CommunityMembers;
use App\Models\Community;
use App\Models\CommunityUser;
use App\Models\Role;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CommunityModerationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_kick_a_member_from_the_community(): void
    {
        $adminRole = Role::factory()->create(['id' => 1, 'name' => 'admin']);
        $memberRole = Role::factory()->create(['name' => 'member']);

        $admin = User::factory()->create(['role_id' => $adminRole->id]);
        $owner = User::factory()->create(['role_id' => $memberRole->id]);
        $member = User::factory()->create(['username' => 'member-one', 'role_id' => $memberRole->id]);

        $community = Community::factory()->create(['owner_id' => $owner->id]);
        $community->members()->attach($member->id, ['role' => 'member']);

        Livewire::actingAs($admin)
            ->test(CommunityMembers::class, ['community' => $community])
            ->assertSee('Expulsar')
            ->assertSee('Banear')
            ->call('kickMember', $member);

        $this->assertFalse($community->members()->where('users.id', $member->id)->exists());
    }

    public function test_admin_can_ban_a_member_from_the_community(): void
    {
        $adminRole = Role::factory()->create(['id' => 1, 'name' => 'admin']);
        $memberRole = Role::factory()->create(['name' => 'member']);

        $admin = User::factory()->create(['role_id' => $adminRole->id]);
        $owner = User::factory()->create(['role_id' => $memberRole->id]);
        $member = User::factory()->create(['username' => 'member-two', 'role_id' => $memberRole->id]);

        $community = Community::factory()->create(['owner_id' => $owner->id]);
        $community->members()->attach($member->id, ['role' => 'member']);

        Livewire::actingAs($admin)
            ->test(CommunityMembers::class, ['community' => $community])
            ->call('banMember', $member);

        $this->assertTrue(
            CommunityUser::where('community_id', $community->id)
                ->where('user_id', $member->id)
                ->where('is_banned', true)
                ->exists()
        );
    }
}
