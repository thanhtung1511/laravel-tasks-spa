<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProfileController extends Controller
{
    public function __invoke(Request $request)
    {
        return response()->json(
            [
                'user' => $request->user()->load(['roles', 'roles.permissions']),
            ],
            Response::HTTP_OK
        );
    }
}
