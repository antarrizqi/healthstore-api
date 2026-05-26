<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdukResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'                     => $this->id,
            'name'                   => $this->name,
            'slug'                   => $this->slug,
            'brand'                  => $this->brand,
            'short_description'      => $this->short_description,
            'description'            => $this->description,
            'base_price'             => $this->base_price,
            'stock'                  => $this->stock,
            'main_image'             => $this->main_image
                ? asset('storage/' . $this->main_image)
                : null,
            'benefits'               => $this->benefits,
            'nutrition_facts'        => $this->nutrition_facts,
            'serving_size'           => $this->serving_size,
            'servings_per_container' => $this->servings_per_container,
            'status'                 => $this->status,
            'is_featured'            => $this->is_featured,

            // relasi — hanya dimuat kalau di-load
            'kategori' => new KategoriResource($this->whenLoaded('kategori')),
            'varian'   => VarianResource::collection($this->whenLoaded('varian')),
            'ulasan'   => UlasanResource::collection($this->whenLoaded('ulasan')),

            // rata-rata rating — hitung dari relasi
            'rata_rating' => $this->ulasan
                ? round($this->ulasan->avg('rating'), 1)
                : 0,

            'jumlah_ulasan' => $this->ulasan
                ? $this->ulasan->count()
                : 0,
        ];
    }
}
