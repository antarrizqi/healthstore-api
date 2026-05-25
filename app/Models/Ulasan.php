<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Ulasan extends Model
{
    protected $table = 'ulasan';

    protected $fillable = [
        'produk_id',
        'reviewer_name',
        'reviewer_avatar',
        'rating',
        'title',
        'body',
        'is_verified',
        'is_visible',
    ];

    protected $casts = [
        'is_verified' => 'boolean',
        'is_visible'  => 'boolean',
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}
