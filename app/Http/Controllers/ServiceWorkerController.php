<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceWorker\ServiceWorkerStoreRequest;
use App\Models\ServiceWorker;
use App\Models\User;

class ServiceWorkerController extends Controller
{
    public function store(ServiceWorkerStoreRequest $request, User $worker)
    {
        $data = $request->validated();
        $worker->services()->attach($data['service_id'], [
            'price' => $data['price'],
            'minutesNeeded' => $data['minutesNeeded'],
        ]);

        $serviceWorker = ServiceWorker::where('worker_id', $worker->id)->where('service_id', $data['service_id'])->firstOrFail();

        foreach ($data['additional_services'] as $additional_service) {
            $serviceWorker->additionalServices()->create([
                'service_worker_id' => $serviceWorker->id,
                'additional_service_id' => $additional_service['additional_service_id'],
                'price' => $additional_service['price'],
                'minutesNeeded' => $additional_service['minutesNeeded'],
            ]);
        }

        return response()->noContent();
    }

    public function index(User $worker)
    {
        $services = ServiceWorker::with('service', 'service.category', 'additionalServices', 'additionalServices.additionalService')
            ->where('worker_id', '=', $worker->id)
            ->get()
            ->groupBy('service.category.name');

        return response()->json([
            'data' => $services,
        ]);
    }
}
