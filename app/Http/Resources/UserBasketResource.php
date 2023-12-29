<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserBasketResource extends JsonResource {
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
            'quantity' => $this->quantity,
            'status' => $this->status,
            'user' => new UserResource($this->whenLoaded('user')),
            'moto' => new MotoResource($this->whenLoaded('moto')),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
