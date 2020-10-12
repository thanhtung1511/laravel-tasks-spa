<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Http\{JsonResponse, Response};

class UserController extends Controller
{
    /**
     * Allow admin fetching users used as assignee to assign task.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        if (!auth()->user()->isAdmin()) {
            abort(Response::HTTP_UNAUTHORIZED, 'You can not get user list');
        }
        $users = User::all();

        return response()->json(new UserCollection($users));
    }

}
