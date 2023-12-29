<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MotoModelResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'brand_id' => $this->brand_id,
            'engine_id' => $this->engine_id,
            'name' => $this->name,
            'release_start_year' => $this->release_start_year,
            'release_end_year' => $this->release_end_year,
            'weight' => $this->weight,
            'description' => $this->description,
            'image_url' => $this->image_url,
            'price' => $this->price,
            'price_currency' => $this->price_currency,
            'base_rent_price' => $this->base_rent_price,
            'base_rent_currency' => $this->base_rent_currency,
            'fuel_tank_capacity' => $this->fuel_tank_capacity,
            'fuel_tank_capacity_type' => $this->fuel_tank_capacity_type,
            'max_speed' => $this->max_speed,
            'type' => $this->type,
            'brand' => new BrandResource($this->whenLoaded('brand')), // Assuming you have a BrandResource
            'engine' => new EngineResource($this->whenLoaded('engine')), // Assuming you have an EngineResource
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
