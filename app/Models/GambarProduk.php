<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class GambarProduk extends Model
{
    protected $table = 'gambar_produk';

    protected $fillable = ['produk_id', 'image_path', 'sort_order'];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'produk_id');
    }
}