<?php

namespace Tests\Feature;

use App\Models\Community;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommunityPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_owner_sees_their_community_in_the_personal_guild_section(): void
    {
        $user = User::factory()->create();
        $community = Community::factory()->create([
            'owner_id' => $user->id,
            'visibility' => 'private',
            'name' => 'My Guild',
        ]);

        $this->actingAs($user);

        $response = $this->get(route('community'));

        $response->assertOk();
        $response->assertSee('Your guild');
        $response->assertSee($community->name);
    }
}
