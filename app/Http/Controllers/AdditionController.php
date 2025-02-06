<?php

namespace App\Http\Controllers;

use App\Http\Requests\Addition\AdditionStoreRequest;
use App\Http\Requests\Addition\AdditionUpdateRequest;
use App\Http\Resources\AdditionResource;
use App\Models\Addition;
use Illuminate\Http\Request;

class AdditionController extends Controller
{
    public function index(Request $request)
    {

        return AdditionResource::collection(Addition::filter($request->only('service_id'))->get());
    }

    public function show(Addition $addition)
    {
        return new AdditionResource($addition);
    }

    public function store(AdditionStoreRequest $request)
    {
        $addition = Addition::create($request->validated());

        return new AdditionResource($addition);
    }

    public function update(AdditionUpdateRequest $request, Addition $addition)
    {
        $addition->update($request->validated());

        return new AdditionResource($addition);
    }

    public function destroy(Addition $addition)
    {
        $addition->delete();

        return response()->noContent();
    }
}
