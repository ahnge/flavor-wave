<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PreorderListsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            "order_no" => $this->order_no,
            "distributor_name" => $this->distributor->name,
            "is_urgent" => $this->is_urgent,
            "status" => $this->status,
            "total_amount" => $this->total,
            'due_date' => Carbon::createFromFormat('Y-m-d H:i:s', $this->due_date)->format('d-m-Y'),

        ];
    }
}
