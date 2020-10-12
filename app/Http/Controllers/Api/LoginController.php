<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\AuthenticateUser;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function __invoke(AuthenticateUser $request)
    {
        $credentials = $request->validated();

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json(
            [
                'token' => $token,
                'expired' => now()->addSeconds(Auth::factory()->getTTL() * 60)->format('U'),
            ],
            Response::HTTP_OK
        );
    }
}
