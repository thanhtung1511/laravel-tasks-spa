<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TaskStore;
use App\Http\Resources\Task as TaskResource;
use App\Http\Resources\TaskCollection;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\{JsonResponse, Response};
use Throwable;

class TaskController extends Controller
{
    /**
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $tasks = Task::where('assignee_id', auth()->id())->where('status', Task::STATUS_ASSIGNED)->get();

        return response()->json(new TaskCollection($tasks));
    }

    /**
     * @param TaskStore $request
     *
     * @return JsonResponse
     *
     * @throws Throwable
     */
    public function store(TaskStore $request): JsonResponse
    {
        /**@var User $user */
        $user = auth()->user()->load(['roles', 'roles.permissions']);

        if (!$user->isAdmin() && !$user->hasAllPermissions(['create-task', 'assign-task'])) {
            abort(Response::HTTP_UNAUTHORIZED, 'You do not have permission to create and assign task');
        }

        $data = $request->validated();

        /** @var Task $task */
        $task = $user->createdTasks()->make(['name' => $data['name'], 'status' => Task::STATUS_ASSIGNED]);
        $task->assignee()->associate(User::findOrFail($data['assignee']));
        $task->save();

        return response()->json(new TaskResource($task));
    }

    /**
     * @param Task $task
     *
     * @return JsonResponse
     */
    public function complete(Task $task): JsonResponse
    {
        /**@var User $user */
        $user = auth()->user()->load(['roles', 'roles.permissions']);

        if (!$user->isAdmin() && $task->assignee_id != $user->id) {
            abort(Response::HTTP_UNAUTHORIZED, 'You do not have permission to complete this task');
        }

        $task->completedBy()->associate($user)->update(['status' => Task::STATUS_COMPLETED]);

        return response()->json(new TaskResource($task));
    }
}
