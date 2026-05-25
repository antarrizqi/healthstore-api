<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = [
        'kategori_id', 'name', 'slug', 'short_description', 'description',
        'brand', 'base_price', 'stock', 'main_image', 'benefits',
        'nutrition_facts', 'serving_size', 'servings_per_container',
        'status', 'is_featured',
    ];

    protected $casts = [
        'base_price'      => 'decimal:2',
        'benefits'        => 'array',
        'nutrition_facts' => 'array',
        'is_featured'     => 'boolean',
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function gambarProduk(): HasMany
    {
        return $this->hasMany(GambarProduk::class, 'produk_id')->orderBy('sort_order');
    }

    public function varian(): HasMany
    {
        return $this->hasMany(Varian::class, 'produk_id');
    }

    public function ulasan(): HasMany
    {
        return $this->hasMany(Ulasan::class, 'produk_id')->where('is_visible', true);
    }
}