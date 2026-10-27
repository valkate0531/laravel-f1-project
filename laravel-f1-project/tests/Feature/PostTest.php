<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_a_guest_can_create_a_post(): void
    {
        $response = $this->postJson('/api/posts', [
            'message' => 'A post created by the feature test.',
        ]);

        $response->assertCreated()
            ->assertJsonPath('message', 'A post created by the feature test.')
            ->assertJsonPath('user', null);

        $this->assertDatabaseHas('posts', [
            'post' => 'A post created by the feature test.',
            'user_id' => null,
        ]);
    }
}
