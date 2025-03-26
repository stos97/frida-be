<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServiceWorker\ServiceWorkerStoreRequest;
use App\Http\Requests\ServiceWorkerUpdateRequest;
use App\Models\Service;
use App\Models\ServiceWorker;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        if ($data['additions'] ?? false) {
            foreach ($data['additions'] as $addition) {
                $serviceWorker->additions()->create([
                    'service_worker_id' => $serviceWorker->id,
                    'addition_id' => $addition['addition_id'],
                    'price' => $addition['price'],
                    'minutesNeeded' => $addition['minutesNeeded'],
                ]);
            }
        }

        return response()->noContent();
    }

    public function update(ServiceWorkerUpdateRequest $request, User $worker, Service $service)
    {
        $data = $request->validated();

        $serviceWorker = ServiceWorker::where('worker_id', $worker->id)
            ->where('service_id', $service->id)
            ->firstOrFail();

        $serviceWorker->update($data);

        $serviceWorker->additions()->delete();

        if ($data['additions'] ?? false) {
            foreach ($data['additions'] as $addition) {
                $serviceWorker->additions()->create([
                    'service_worker_id' => $serviceWorker->id,
                    'addition_id' => $addition['addition_id'],
                    'price' => $addition['price'],
                    'minutesNeeded' => $addition['minutesNeeded'],
                ]);
            }
        }

        return response()->noContent();
    }

    public function destroy(Request $request, User $worker)
    {
        $data = $request->validate([
            'service_id' => ['required', 'exists:services,id', function ($attribute, $value, $fail) use ($worker) {
                if (! DB::table('service_worker')
                    ->where('service_id', $value)
                    ->where('worker_id', $worker->id)
                    ->exists()) {
                    $fail('The selected service is not associated worker.');
                }
            }],
        ]);
        $worker->services()->detach($data['service_id']);

        return response()->noContent();
    }

    public function index(User $worker)
    {
        $services = ServiceWorker::with('service', 'service.category', 'additions', 'additions.addition')
            ->where('worker_id', '=', $worker->id)
            ->get()
            ->groupBy('service.category.name');

        return response()->json([
            'data' => $services,
        ]);
    }

    public function show(User $worker, Service $service)
    {
        $serviceWorker = ServiceWorker::with('service', 'service.category', 'additions', 'additions.addition')
            ->where('worker_id', $worker->id)
            ->where('service_id', $service->id)
            ->firstOrFail();

        return response()->json([
            'data' => $serviceWorker,
        ]);
    }
}
