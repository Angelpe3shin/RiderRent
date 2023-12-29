<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MotoResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'moto_model_id' => $this->moto_model_id,
            'color_id' => $this->color_id,
            'name' => $this->name,
            'production_year' => $this->production_year,
            'mileage' => $this->mileage,
            'status' => $this->status,
            'moto_model' => new MotoModelResource($this->whenLoaded('motoModel')), // Assuming you have a MotoModelResource
            'color' => new ColorResource($this->whenLoaded('color')), // Assuming you have a ColorResource
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
