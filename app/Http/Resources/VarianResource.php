<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VarianResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'           => $this->id,
            'flavor'       => $this->flavor,
            'weight'       => $this->weight,
            'price'        => $this->price,
            'stock'        => $this->stock,
            'sku'          => $this->sku,
            'is_available' => $this->is_available,
        ];
    }
}
