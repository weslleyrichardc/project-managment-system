<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = auth()->attempt($credentials)) {
            return response()->json([
                'message' => 'Unauthorized',
            ], Response::HTTP_UNAUTHORIZED);
        }

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60,
        ], Response::HTTP_CREATED);
    }

    public function register(RegisterRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if (! $token = Auth::login($user)) {
            return response()->json(
                [
                    'message' => 'User cannot be created',
                ],
                Response::HTTP_BAD_REQUEST
            );
        }

        return response()->json(
            [
                'message' => 'User created successfully',
                'user' => new UserResource($user),
                'token' => $token,
                'token_type' => 'bearer',
            ],
            Response::HTTP_CREATED
        );
    }

    public function logout()
    {
        Auth::logout();

        return response()->json([
            'message' => 'Successfully logged out',
        ], Response::HTTP_OK);
    }

    public function refresh()
    {
        return response()->json([
            'user' => new UserResource(Auth::user()),
            'token_type' => 'bearer',
            'token' => Auth::refresh(),
            'expires_in' => auth()->factory()->getTTL() * 60,
        ]);
    }
}
