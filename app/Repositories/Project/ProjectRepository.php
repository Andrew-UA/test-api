<?php
/**
 * Created by PhpStorm.
 * User: andrew
 * Date: 11.09.18
 * Time: 22:37
 */

namespace App\Repositories\Project;


use App\Models\Db\Project;
use App\Models\Db\User;

class ProjectRepository
{
    /**
     * @return Project[]|\Illuminate\Database\Eloquent\Collection
     */
    public function getAll()
    {
        return Project::all();
    }

    /**
     * @param integer $id
     *
     * @return Project|Project[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function getById($id)
    {
        return Project::find($id);
    }

    /**
     * @param User $user
     * @param array $projectData
     *
     * @return Project
     */
    public function create(User $user, $projectData)
    {
        //return Project::create();

        $project = new Project($projectData);
        $user->projects()->save($project);

        return $project;

    }

    /**
     * @param User $user
     * @param Project $project
     * @param array $projectData
     *
     * @return Project
     */
    public function update(User $user, Project $project, $projectData)
    {
        if ($user->id !== $project->user->id) {
            $project->user()->associate($user);
        }

        $project->update($projectData);

        return $project;
    }

    /**
     * @param integer $id
     *
     * @return bool|null
     * @throws \Exception
     */
    public function deleteById($id)
    {
        if ($project = $this->getById($id)) {
            return $project->delete();
        }

        return false;
    }
}