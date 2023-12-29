<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RentResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'moto_id' => $this->moto_id,
            'discount_id' => $this->discount_id,
            'start_date' => $this->start_date,
            'requested_end_date' => $this->requested_end_date,
            'actual_end_date' => $this->actual_end_date,
            'total_requested_price' => $this->total_requested_price,
            'total_actual_price' => $this->total_actual_price,
            'is_active' => $this->is_active,
            'user' => new UserResource($this->whenLoaded('user')), // Assuming you have a UserResource
            'moto' => new MotoResource($this->whenLoaded('moto')), // Assuming you have a MotoResource
            'discount' => new DiscountResource($this->whenLoaded('discount')), // Assuming you have a DiscountResource
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
