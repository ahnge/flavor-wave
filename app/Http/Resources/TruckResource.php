<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TruckResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            "id" => $this->id,
            "truck_no" => $this->truck_no,
            "driver_name" => $this->driver_name,
            "capacity" => $this->capacity,
            "status" => $this->status
        ];
    }
}
