<?php

namespace Tests\Unit;

use App\Repositories\Project\ProjectRepository;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Db\Project;
use App\Models\Db\User;
use Event;


class ProjectTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateProject()
    {
        Event::fake();
        $user = factory(User::class)->create();
        $project = factory(Project::class)->make();
        $project->user_id = $user->id;

        $response = $this->json('POST', 'api/projects', $project->toArray());
        $response->assertStatus(201);
        $this->assertDatabaseHas('projects', $project->toArray());
    }

    public function testUpdateProject()
    {
        Event::fake();
        $user_1 = factory(User::class)->create();
        $user_2 = factory(User::class)->create();
        $project = factory(Project::class)->make();
        $user_1->projects()->save($project);

        $new_project = factory(Project::class)->make();
        $new_project->user_id = $user_2->id;

        $response = $this->json('PUT', 'api/projects/'.$project->id, $new_project->toArray());
        $response->assertStatus(202);
        $this->assertDatabaseHas('projects', $new_project->toArray());
    }

    public function testGetProjects()
    {
        Event::fake();

        factory(\App\Models\Db\User::class, 3)->create()->each(function ($u) {
            $u->projects()->save(factory(\App\Models\Db\Project::class)->make());
            $u->projects()->save(factory(\App\Models\Db\Project::class)->make());
            $u->projects()->save(factory(\App\Models\Db\Project::class)->make());
            $u->projects()->save(factory(\App\Models\Db\Project::class)->make());
        });

        $projects = Project::all();

        $response = $this->get('api/projects/');
        $response->assertStatus(200);
        $response->assertJsonFragment(['projects' => $projects->toArray()]);
        $response->assertJsonFragment(['statuses' => Project::PROJECT_STATUSES]);
    }

    public function testRemoveProject()
    {
        Event::fake();

        $user = factory(User::class)->create();
        $project = factory(Project::class)->make();
        $user->projects()->save($project);
        $response = $this->json('DELETE','api/projects/'.$project->id);
        $response->assertStatus(202);
        $this->assertDatabaseMissing('projects', $project->toArray());
    }

    public function testGetProject()
    {
        Event::fake();

        $user = factory(User::class)->create();
        $project = factory(Project::class)->make();
        $user->projects()->save($project);

        $response = $this->get('api/projects/'.$project->id);
        $response->assertStatus(200);
        $response->assertJson($project->toArray());
    }
}
