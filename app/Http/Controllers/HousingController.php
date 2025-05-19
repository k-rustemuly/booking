<?php

namespace App\Http\Controllers;

use App\Http\Requests\Housing\ListRequest;
use App\Http\Requests\Housing\StoreRequest;
use App\Http\Requests\Housing\UpdateRequest;
use App\Http\Resources\Housing\ListResource;
use App\Models\Housing;
use App\Services\HousingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Gate;

class HousingController extends BaseController
{

    public function __construct(private HousingService $housingService){}

    /**
     * Display a listing of the resource.
     */
    public function index(ListRequest $request): JsonResponse
    {
        Gate::authorize('viewAny', Housing::class);
        $data = $request->validated();
        $housings = $this->housingService->getHousings($data);
        return $this->sendResponse(ListResource::collection($housings));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        Gate::authorize('create', Housing::class);
        $data = $request->validated();
        $housing = $this->housingService->createHousing($data);
        return $this->sendResponse(new ListResource($housing));
    }

    /**
     * Display the specified resource.
     */
    public function show(Housing $housing): JsonResponse
    {
        Gate::authorize('view', $housing);
        return $this->sendResponse(new ListResource($housing));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Housing $housing, UpdateRequest $request): JsonResponse
    {
        Gate::authorize('update', $housing);
        $data = $request->validated();
        $housing = $this->housingService->updateHousing($housing, $data);
        return $this->sendResponse(new ListResource($housing));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Housing $housing): JsonResponse
    {
        Gate::authorize('delete', $housing);
        $this->housingService->deleteHousing($housing);
        return $this->sendResponse([], 204);
    }
}
