<?php

namespace Tests\Unit\Model;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Test post has  a title & body & has One user
     */
    public function testPostHasATitleAndBodyAndHasOneUser()
    {
        $user = User::factory()->create();
        $post = Post::factory()->create([
            'user_id' => $user->id,
            'title' => 'Test Title',
            'body' => 'Test Body',
            'user_id' => $user->id,
        ]);
        $this->assertEquals($post->title, 'Test Title');
        $this->assertEquals($post->body, 'Test Body');
        $this->assertEquals($post->user_id, $user->id);
    }
}
