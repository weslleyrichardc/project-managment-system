<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Response;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Task::where('user_id', auth()->id()), Response::HTTP_OK);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTaskRequest $request)
    {
        if (! auth()->check()) {
            return response()->json([
                'message' => 'You must be logged in to create a task.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $taskData = $request->validated();
        $taskData['user_id'] = auth()->id();

        $task = Task::create($taskData);

        return response()->json($task, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return response()->json($task, Response::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTaskRequest $request, Task $task)
    {
        $taskData = $request->validated();
        $taskData['user_id'] = auth()->id();
        $task->update($taskData);

        return response()->json($task, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        if (! auth()->check() || auth()->id() !== $task->project->user_id) {
            return response()->json([
                'message' => 'You must be logged in as the owner of the task to delete it.',
            ], Response::HTTP_UNAUTHORIZED);
        }

        if ($task->delete()) {
            return response()->json(null, Response::HTTP_NO_CONTENT);
        }

        return response()->json([
            'message' => 'An error occurred while deleting the task.',
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
