<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "product_name" => $this->title,
            "product_price" => $this->price,
            "product_photo" => $this->product_photo,
            "pc_per_box" => $this->pc_per_box,
            "total_box_count" => $this->total_box_count,
            "available_box_count" => $this->available_box_count,
            "reserving_box_count" => $this->reserving_box_count
        ];
    }
}
