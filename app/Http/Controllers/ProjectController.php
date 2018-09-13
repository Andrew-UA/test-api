<?php

namespace App\Http\Controllers;

use App\Http\Requests\Project\ProjectRequest;
use App\Models\Db\Project;
use App\Repositories\Project\ProjectRepository;
use App\Repositories\User\UserRepository;

class ProjectController extends Controller
{
    protected $userRepository;

    protected $projectRepository;

    public function __construct(UserRepository $userRepository, ProjectRepository $projectRepository)
    {
        $this->userRepository = $userRepository;

        $this->projectRepository = $projectRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'projects' => $this->projectRepository->getAll(),
            'statuses' => Project::PROJECT_STATUSES
        ]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  ProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProjectRequest $request)
    {
        if ($user = $this->userRepository->getById($request->get('user_id'))) {
            $this->projectRepository->create($user, $request->only(['name', 'description', 'status']));

            return response()->json('Project created', 201);
        }

        return response()->json('User not found', 404);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if ($project = $this->projectRepository->getById($id)) {
            return response()->json($project->makeVisible('statuses'));
        }

        return response()->json('Project not found', 404);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  ProjectRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProjectRequest $request, $id)
    {

        if ($user = $this->userRepository->getById($request->get('user_id'))) {
           if ($project = $this->projectRepository->getById($id)) {
               $this->projectRepository->update($user, $project, $request->only(['name', 'description', 'status']));

               return response()->json('Project updated', 202);
           }

            return response()->json('Project not found', 404);
        }

        return response()->json('User not found', 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        if($this->projectRepository->deleteById($id))
        {
            return response()->json('Project deleted', 202);
        }

        return response()->json('Project not found', 404);
    }
}
