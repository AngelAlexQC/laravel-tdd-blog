<?php

namespace Tests\Unit\Model;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test Test that the user model can be instantiated.
     */
    public function testUserModel()
    {
        $user = new User();
        $this->assertInstanceOf(User::class, $user);
    }
    /**
     * @test Test that the user model can be saved.
     */
    public function testUserModelSave()
    {
        $user = new User();
        $user->name = 'Test User';
        $user->email = 'test@test.com';
        $user->password = 'password';
        $user->save();
        $this->assertNotNull($user->id);
    }
    /**
     * @test Test that the user model can be deleted.
     */
    public function testUserModelDelete()
    {
        $user = new User();
        $user->name = 'Test User';
        $user->email = 'test@test.com';
        $user->password = 'password';
        $user->save();
        $this->assertNotNull($user->id);
        $user->delete();
        // Check if the user has been deleted.
        $this->assertNull(User::find($user->id));
    }
    /**
     * @test Test that the user model can be retrieved.
     */
    public function testUserModelGet()
    {
        $user = new User();
        $user->name = 'Test User';
        $user->email = 'test@test.com';
        $user->password = 'password';
        $user->save();
        $this->assertNotNull($user->id);
        $user = User::find($user->id);
        $this->assertInstanceOf(User::class, $user);
    }
    /**
     * @test Test that the user model can be retrieved by email.
     */
    public function testUserModelGetByEmail()
    {
        $user = new User();
        $user->name = 'Test User';
        $user->email = 'test@test.com';
        $user->password = 'password';
        $user->save();
        $this->assertNotNull($user->id);
        $user = User::where('email', 'test@test.com')->first();
        $this->assertInstanceOf(User::class, $user);
    }
    /**
     * @test Test that the user has Many Posts.
     */
    public function testUserModelHasManyPosts()
    {
        $user = new User();
        $user->name = 'Test User';
        $user->email = 'test@test.com';
        $user->password = 'password';
        $user->save();
        $this->assertNotNull($user->id);
        $post = Post::create(['title' => 'Test Post', 'body' => 'Test Post Body', 'user_id' => $user->id]);
        // Check if the user has been assigned to the post.
        $this->assertEquals($user->id, $post->user_id);
        // Check if the user has the post in the posts relationship.
        $this->assertInstanceOf(Collection::class, $user->posts);
    }
}
