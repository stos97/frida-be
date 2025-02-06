<?php

namespace App\Http\Controllers;

use App\Http\Requests\Service\ServiceStoreRequest;
use App\Http\Requests\Service\ServiceUpdateRequest;
use App\Http\Resources\ServiceResource;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('category', 'additions')->get();

        return ServiceResource::collection($services);
    }

    public function show(Service $service)
    {
        return new ServiceResource($service->load('category', 'additions'));
    }

    public function store(ServiceStoreRequest $request)
    {
        $service = Service::create($request->validated());

        return new ServiceResource($service);
    }

    public function update(ServiceUpdateRequest $request, Service $service)
    {
        $service->update($request->validated());

        return new ServiceResource($service->load('category'));
    }

    public function destroy(Service $service)
    {
        $service->delete();

        return response()->noContent();
    }

    public function addAdditionsService(Request $request, Service $service)
    {
        $data = $request->validate([
            'additions' => ['array'],
        ]);

        $service->additions()->sync($data['additions']);

        return new ServiceResource($service);
    }
}
