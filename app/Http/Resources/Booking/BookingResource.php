<?php

namespace App\Http\Resources\Booking;

use App\Http\Resources\Housing\ListResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'housing' => new ListResource($this->whenLoaded('housing')),
            'check_in' => $this->check_in->format('Y-m-d H:i:s'),
            'check_out' => $this->check_out->format('Y-m-d H:i:s'),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
