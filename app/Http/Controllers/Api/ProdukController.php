<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProdukResource;
use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    // GET /api/produk
    public function index(Request $request)
    {
        $query = Produk::with(['kategori', 'varian', 'ulasan'])
            ->where('status', 'active');

        // filter by kategori slug
        if ($request->has('kategori')) {
            $query->whereHas('kategori', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        // search by nama
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        // filter produk unggulan
        if ($request->has('featured')) {
            $query->where('is_featured', true);
        }

        $produk = $query->paginate(12);

        return ProdukResource::collection($produk);
    }

    // GET /api/produk/featured
    public function featured()
    {
        $produk = Produk::with(['kategori', 'varian', 'ulasan'])
            ->where('status', 'active')
            ->where('is_featured', true)
            ->take(6)
            ->get();

        return ProdukResource::collection($produk);
    }

    // GET /api/produk/{slug}
    public function show(string $slug)
    {
        $produk = Produk::with(['kategori', 'varian', 'ulasan'])
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        return new ProdukResource($produk);
    }
}
