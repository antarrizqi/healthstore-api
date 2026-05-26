<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UlasanResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'reviewer_name'  => $this->reviewer_name,
            'reviewer_avatar' => $this->reviewer_avatar,
            'rating'         => $this->rating,
            'title'          => $this->title,
            'body'           => $this->body,
            'is_verified'    => $this->is_verified,
            'created_at'     => $this->created_at->format('d M Y'),
        ];
    }
}
