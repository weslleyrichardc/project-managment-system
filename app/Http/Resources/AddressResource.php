<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            'zip_code' => $this->zip_code,
            'number' => $this->number,
            'street' => $this->street,
            'city' => $this->city,
            'state' => $this->state,
        ];
    }
}
