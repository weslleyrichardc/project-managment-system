<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use Illuminate\Http\Response;

class ProjectController extends Controller
{
    /**
     * Display a listing of the projects.
     */
    public function index()
    {
        return response()->json(Project::where('user_id', auth()->id()), Response::HTTP_OK);
    }

    /**
     * Store a newly created project.
     */
    public function store(StoreProjectRequest $request)
    {
        $projectData = $request->validated();
        $projectData['user_id'] = auth()->id();

        $project = Project::create($projectData);

        return response()->json($project, Response::HTTP_CREATED);
    }

    /**
     * Display the specified projects.
     */
    public function show(Project $project)
    {
        return response()->json($project, Response::HTTP_OK);
    }

    /**
     * Update the specified projects in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $projectData = $request->validated();
        $projectData['user_id'] = auth()->id();
        $project->update($projectData);

        return response()->json($project, Response::HTTP_OK);
    }

    /**
     * Remove the specified project.
     */
    public function destroy(Project $project)
    {
        if (! auth()->check() || auth()->id() !== $project->user_id) {
            return response()->json([
                'message' => 'You must be logged in as the owner of the project to delete it.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($project->delete()) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }

        return response()->json([
            'message' => 'An error occurred while deleting the project.',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
