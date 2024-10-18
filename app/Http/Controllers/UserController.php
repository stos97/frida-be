<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        return UserResource::collection(
            User::filter(
                $request->only([
                    'role'
                ])
            )->get()
        );
    }

    public function profile()
    {
        return new UserResource(auth()->user());
    }

    public function show(User $user)
    {
        return new UserResource($user);
    }

    public function update(UpdateUserRequest $request)
    {
        $data = $request->validated();

        $user = auth()->user();

        if ($request->has('password')) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return new UserResource($user);
    }
}
