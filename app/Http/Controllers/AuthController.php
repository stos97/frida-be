<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        $token = $user->createToken('access_token');
        $user['token'] = $token->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'access_token' => $token->plainTextToken
        ]);
    }

    public function login(LoginRequest $request)
    {
        $data = $request->validated();

        if (!Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
            return response()->json([
                'status' => 'Invalid Credentials'
            ], 401);
        }
        $user = Auth::user();
        $token = $user->createToken('access_token');
        $user['token'] = $token->plainTextToken;

        return response()->json([
            'user' => new UserResource($user),
            'access_token' => $token->plainTextToken
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response()->noContent();
    }
}
