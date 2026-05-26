<?php

namespace App\Filament\Widgets;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Ulasan;
use App\Models\Varian;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        // hitung produk yang stoknya hampir habis (stok <= 10)
        $stokKritis = Produk::where('stock', '<=', 10)->count();

        // hitung rata-rata rating semua ulasan
        $rataRating = Ulasan::where('is_visible', true)->avg('rating');

        return [

            Stat::make('Total Produk', Produk::count())
                ->description('Semua produk aktif dan nonaktif')
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('success'),

            Stat::make('Total Kategori', Kategori::where('is_active', true)->count())
                ->description('Kategori yang aktif')
                ->descriptionIcon('heroicon-o-tag')
                ->color('info'),

            Stat::make('Stok Kritis', $stokKritis)
                ->description('Produk dengan stok ≤ 10')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color($stokKritis > 0 ? 'danger' : 'success'),

            Stat::make('Total Ulasan', Ulasan::where('is_visible', true)->count())
                ->description('Rating rata-rata: ' . number_format($rataRating, 1) . ' ⭐')
                ->descriptionIcon('heroicon-o-star')
                ->color('warning'),

        ];
    }
}
