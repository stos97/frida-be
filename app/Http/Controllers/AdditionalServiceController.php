<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdditionalService\AdditionalServiceStoreRequest;
use App\Http\Requests\AdditionalService\AdditionalServiceUpdateRequest;
use App\Http\Resources\AdditionalServiceResource;
use App\Models\AdditionalService;
use Illuminate\Http\Request;

class AdditionalServiceController extends Controller
{
    public function index()
    {
        return AdditionalServiceResource::collection(AdditionalService::all());
    }

    public function show(AdditionalService $additionalService)
    {
        return new AdditionalServiceResource($additionalService);
    }

    public function store(AdditionalServiceStoreRequest $request)
    {
        $additionalService = AdditionalService::create($request->validated());

        return new AdditionalServiceResource($additionalService);
    }

    public function update(AdditionalServiceUpdateRequest $request, AdditionalService $additionalService)
    {
        $additionalService->update($request->validated());

        return new AdditionalServiceResource($additionalService);
    }

    public function destroy(AdditionalService $additionalService)
    {
        $additionalService->delete();

        return response()->noContent();
    }
}
