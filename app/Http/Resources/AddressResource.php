<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource {
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array {
        return [
            'id' => $this->id,
            'country_id' => $this->country_id,
            'street' => $this->street,
            'house_number' => $this->house_number,
            'zip_code' => $this->zip_code,
            'city' => $this->city,
            'country' => new CountryResource($this->whenLoaded('country')), // Assuming you have a CountryResource
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
