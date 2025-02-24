<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Queue\Worker;
use Illuminate\Support\Facades\Hash;

class WorkerController extends Controller
{
    public function index()
    {
        $workers = User::where(fn($q) => $q->where('role', 'worker')->orWhere('role', 'admin'))->get();

        return UserResource::collection($workers);
    }


    public function store(RegisterRequest $request)
    {
        $data = $request->validated();

        $data['password'] = Hash::make($data['password']);
        $data['role'] = 'worker';

        $worker = User::create($data);

        return response()->json([
            'worker' => new UserResource($worker),
        ]);
    }

    public function destroy(User $worker)
    {
        $worker->delete();

        return response()->noContent();
    }
}
