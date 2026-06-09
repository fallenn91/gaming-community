<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;
use App\Models\User;
use Livewire\Livewire;

class LikeButtonTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Post $post;
    /**
     * A basic feature test example.
     */
    protected function setUp(): void
    {
      parent::setUp();
      $this->user = User::factory()->create();
      $this->post = Post::factory()->create(['user_id' => $this->user->id]);
    }

    /**@test */
    public function test_user_can_like_a_post(): void
    {
      $this->actingAs($this->user);

      Livewire::test(\App\Livewire\Interactions\LikeButton::class, ['post' => $this->post])
        ->call('toggleLike');

      $this->assertDatabaseHas('likes', [
        'user_id' => $this->user->id,
        'post_id' => $this->post->id,
      ]);
    }

    /**@test */
    public function test_user_can_unlike_a_post(): void
    {
      $this->actingAs($this->user);

      $this->post->likes()->create(['user_id' => $this->user->id]);

      Livewire::test(\App\Livewire\Interactions\LikeButton::class, ['post' => $this->post])
        ->call('toggleLike');

      $this->assertDatabaseMissing('likes', [
        'user_id' => $this->user->id,
        'post_id' => $this->post->id,
      ]);
    }

    /**@test */
    public function test_like_count_is_correct_after_toggle(): void
    {
      $this->actingAs($this->user);

      $component = Livewire::test(\App\Livewire\Interactions\LikeButton::class, ['post' => $this->post]);

      $component->call('toggleLike'); // like
      $this->assertCount(1, $component->get('likes') ?? []);

      $component->call('toggleLike'); // unlike

      $this->assertCount(0, $component->get('likes') ?? []);
    }

    /**@test */
    public function test_like_dispacthes_like_created_event(): void
    {
      \Event::fake(\App\Events\LikeCreated::class);
        $this->actingAs($this->user);
 
        Livewire::test(\App\Livewire\Interactions\LikeButton::class, ['post' => $this->post])
            ->call('toggleLike');
 
        \Event::assertDispatched(\App\Events\LikeCreated::class);
    }

    /**@test */
    public function test_guest_cannot_like_a_post(): void
    {
       
      Livewire::test(\App\Livewire\Interactions\LikeButton::class, ['post' => $this->post])
          ->call('toggleLike')
          ->assertRedirect('/login');

    }
}
