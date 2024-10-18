<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

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
}
