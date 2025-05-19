<?php

namespace App\Http\Controllers;

use App\Http\Requests\Booking\ListRequest;
use App\Http\Requests\Booking\StoreRequest;
use App\Http\Resources\Booking\BookingResource;
use App\Services\BookingService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BookingController extends BaseController
{

    public function __construct(private BookingService $bookingService){}
    /**
     * Display a listing of the resource.
     */
    public function index(ListRequest $request): JsonResponse
    {
        $bookings = $this->bookingService->getBookings(auth()->user(), $request->validated());
        return $this->sendResponse(BookingResource::collection($bookings));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $booking = $this->bookingService->createBooking($request->validated());
        return $this->sendResponse(new BookingResource($booking));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
