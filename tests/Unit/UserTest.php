<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Db\User;
use Event;

class UserTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateUser()
    {
        Event::fake();

        $user = factory(User::class)->make();

        $response = $this->json('POST', 'api/users', $user->makeVisible('password')->toArray());
        $response->assertStatus(201);
        $this->assertDatabaseHas('users', $user->toArray());
    }

    public function testGetUser()
    {
        Event::fake();

        $user = factory(User::class)->create();

        $response = $this->get('api/users/'.$user->id);
        $response->assertStatus(200);
        $response->assertJson($user->toArray());
    }

    public function testGetUsers()
    {
        Event::fake();

        $users = factory(User::class, 10)->create();
        $response = $this->get('api/users/');
        $response->assertStatus(200);
        $response->assertJson($users->toArray());
    }

    public function testRemoveUser()
    {
        Event::fake();

        $user = factory(User::class)->create();
        $response = $this->json('DELETE','api/users/'.$user->id);
        $response->assertStatus(202);
        $this->assertDatabaseMissing('users', $user->toArray());
    }
}
