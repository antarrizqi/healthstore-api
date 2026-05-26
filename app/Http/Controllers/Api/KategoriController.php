<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\KategoriResource;
use App\Models\Kategori;

class KategoriController extends Controller
{
    // GET /api/kategori
    public function index()
    {
        $kategori = Kategori::withCount('produk')
            ->where('is_active', true)
            ->get();

        return KategoriResource::collection($kategori);
    }
}
