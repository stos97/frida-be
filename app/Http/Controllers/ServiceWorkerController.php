<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ServiceWorkerController extends Controller
{
    public function store(Request $request, User $worker)
    {
        $data = $request->validate([
            'services' => ['required', 'array'],
            'services.*.service_id' => ['required', Rule::exists('services', 'id')],
            'services.*.price' => ['required', 'integer'],
            'services.*.minutesNeeded' => ['required', 'integer'],
        ]);

        $data = collect($data['services'])->mapWithKeys(function ($item) {
            return [$item['service_id'] => [
                'price' => $item['price'],
                'minutesNeeded' => $item['minutesNeeded'],
            ]];
        });

        $worker->services()->sync($data);
    }

    public function index(User $worker)
    {
        $services = $worker->services()->get()->groupBy('category.name');

        return response()->json([
            'data' => $services,
        ]);
    }
}
