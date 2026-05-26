<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Varian;
use App\Models\Ulasan;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class VitaStoreSeeder extends Seeder
{
    public function run(): void
    {
        // ── KATEGORI ──────────────────────────────────────────
        $kategoriData = [
            ['name' => 'Protein',     'icon' => 'dumbbell', 'description' => 'Whey, casein, dan plant-based protein.'],
            ['name' => 'Vitamin',     'icon' => 'pill',     'description' => 'Vitamin dan mineral harian.'],
            ['name' => 'Pre-Workout', 'icon' => 'zap',      'description' => 'Booster energi sebelum latihan.'],
            ['name' => 'Fat Burner',  'icon' => 'flame',    'description' => 'Pendukung fat loss dan metabolisme.'],
            ['name' => 'Creatine',    'icon' => 'activity', 'description' => 'Tingkatkan kekuatan dan performa.'],
        ];

        foreach ($kategoriData as $k) {
            Kategori::create([
                'name'        => $k['name'],
                'slug'        => Str::slug($k['name']),
                'icon'        => $k['icon'],
                'description' => $k['description'],
                'is_active'   => true,
            ]);
        }

        // ── PRODUK ────────────────────────────────────────────
        $produkData = [
            [
                'kategori' => 'Protein',
                'name'     => 'VitaWhey Gold',
                'brand'    => 'VitaStore',
                'price'    => 450000,
                'stock'    => 80,
                'featured' => true,
                'short'    => 'Whey protein premium dengan 25g protein per serving.',
                'benefits' => ['25g protein per serving', 'Rendah lemak dan gula', 'Mudah larut', 'Cocok post-workout'],
                'serving'  => '33g',
                'servings' => '30 servings',
                'nutrition' => [
                    ['name' => 'Kalori',      'amount' => '130 kcal'],
                    ['name' => 'Protein',     'amount' => '25g'],
                    ['name' => 'Karbohidrat', 'amount' => '4g'],
                    ['name' => 'Lemak',       'amount' => '2.5g'],
                ],
                'varian' => [
                    ['flavor' => 'Chocolate',  'weight' => '1kg', 'price' => 450000, 'stock' => 30, 'sku' => 'VWG-CHO-1KG'],
                    ['flavor' => 'Vanilla',    'weight' => '1kg', 'price' => 450000, 'stock' => 25, 'sku' => 'VWG-VAN-1KG'],
                    ['flavor' => 'Strawberry', 'weight' => '1kg', 'price' => 450000, 'stock' => 25, 'sku' => 'VWG-STR-1KG'],
                    ['flavor' => 'Chocolate',  'weight' => '2kg', 'price' => 850000, 'stock' => 15, 'sku' => 'VWG-CHO-2KG'],
                ],
                'ulasan' => [
                    ['name' => 'Rizky A.', 'rating' => 5, 'title' => 'Terbaik!',    'body' => 'Protein ini beneran enak, ga terlalu manis. Udah 2 bulan pake dan hasilnya keliatan.', 'verified' => true],
                    ['name' => 'Deni S.',  'rating' => 4, 'title' => 'Worth it',    'body' => 'Teksturnya smooth, gampang dicampur. Rasa chocolate paling enak.', 'verified' => true],
                    ['name' => 'Fajar M.', 'rating' => 5, 'title' => 'Recommended', 'body' => 'Recovery lebih cepat sejak pake ini. Packaging juga bagus.', 'verified' => false],
                ],
            ],
            [
                'kategori' => 'Pre-Workout',
                'name'     => 'VitaBlast Pre-Workout',
                'brand'    => 'VitaStore',
                'price'    => 280000,
                'stock'    => 50,
                'featured' => true,
                'short'    => 'Formula pre-workout dengan caffeine dan beta-alanine.',
                'benefits' => ['200mg caffeine alami', 'Beta-alanine untuk endurance', 'Tanpa crash', 'Rasa enak'],
                'serving'  => '10g',
                'servings' => '30 servings',
                'nutrition' => [
                    ['name' => 'Kalori',       'amount' => '15 kcal'],
                    ['name' => 'Caffeine',     'amount' => '200mg'],
                    ['name' => 'Beta-Alanine', 'amount' => '2g'],
                    ['name' => 'L-Citrulline', 'amount' => '3g'],
                ],
                'varian' => [
                    ['flavor' => 'Watermelon',     'weight' => '300g', 'price' => 280000, 'stock' => 20, 'sku' => 'VBP-WAT-300G'],
                    ['flavor' => 'Blue Raspberry',  'weight' => '300g', 'price' => 280000, 'stock' => 30, 'sku' => 'VBP-BLU-300G'],
                ],
                'ulasan' => [
                    ['name' => 'Andi K.',  'rating' => 5, 'title' => 'Nampol!',    'body' => 'Langsung kerasa efeknya 15 menit setelah minum.', 'verified' => true],
                    ['name' => 'Hendra L.', 'rating' => 4, 'title' => 'Oke banget', 'body' => 'Ga bikin jantung berdegup kenceng kayak produk lain.', 'verified' => true],
                ],
            ],
            [
                'kategori' => 'Vitamin',
                'name'     => 'VitaDaily Multivitamin',
                'brand'    => 'VitaStore',
                'price'    => 150000,
                'stock'    => 120,
                'featured' => false,
                'short'    => 'Multivitamin lengkap untuk imun, energi, dan kesehatan harian.',
                'benefits' => ['23 vitamin dan mineral', 'Imun booster', 'Tingkatkan energi', 'Bebas gluten'],
                'serving'  => '2 tablet',
                'servings' => '30 servings',
                'nutrition' => [
                    ['name' => 'Vitamin C',  'amount' => '500mg'],
                    ['name' => 'Vitamin D3', 'amount' => '1000 IU'],
                    ['name' => 'Zinc',       'amount' => '10mg'],
                    ['name' => 'B-Complex',  'amount' => '100% DV'],
                ],
                'varian' => [
                    ['flavor' => null, 'weight' => '60 tablet',  'price' => 150000, 'stock' => 60, 'sku' => 'VDM-60TAB'],
                    ['flavor' => null, 'weight' => '120 tablet', 'price' => 270000, 'stock' => 60, 'sku' => 'VDM-120TAB'],
                ],
                'ulasan' => [
                    ['name' => 'Sari N.', 'rating' => 5, 'title' => 'Badan lebih fit', 'body' => 'Sejak rutin minum ini jarang sakit, badan lebih seger tiap pagi.', 'verified' => true],
                    ['name' => 'Budi R.', 'rating' => 4, 'title' => 'Harga worth it', 'body' => 'Lengkap kandungannya, harga juga masuk akal.', 'verified' => false],
                ],
            ],
            [
                'kategori' => 'Creatine',
                'name'     => 'VitaCreatine Monohydrate',
                'brand'    => 'VitaStore',
                'price'    => 200000,
                'stock'    => 60,
                'featured' => false,
                'short'    => 'Creatine monohydrate murni 100% micronized.',
                'benefits' => ['100% creatine monohydrate', 'Micronized untuk absorbsi cepat', 'Unflavored', 'Tingkatkan kekuatan'],
                'serving'  => '5g',
                'servings' => '60 servings',
                'nutrition' => [
                    ['name' => 'Creatine Monohydrate', 'amount' => '5g'],
                ],
                'varian' => [
                    ['flavor' => 'Unflavored', 'weight' => '300g', 'price' => 200000, 'stock' => 40, 'sku' => 'VCM-UNF-300G'],
                    ['flavor' => 'Unflavored', 'weight' => '500g', 'price' => 310000, 'stock' => 20, 'sku' => 'VCM-UNF-500G'],
                ],
                'ulasan' => [
                    ['name' => 'Yoga P.', 'rating' => 5, 'title' => 'PR terus!', 'body' => 'Sejak loading creatine ini angkatan gw naik terus.', 'verified' => true],
                ],
            ],
            [
                'kategori' => 'Fat Burner',
                'name'     => 'VitaBurn Thermogenic',
                'brand'    => 'VitaStore',
                'price'    => 320000,
                'stock'    => 40,
                'featured' => true,
                'short'    => 'Thermogenic fat burner dengan green tea extract dan L-Carnitine.',
                'benefits' => ['Green tea extract 500mg', 'L-Carnitine 1000mg', 'Tingkatkan metabolisme', 'Kurangi nafsu makan'],
                'serving'  => '2 kapsul',
                'servings' => '30 servings',
                'nutrition' => [
                    ['name' => 'Green Tea Extract', 'amount' => '500mg'],
                    ['name' => 'L-Carnitine',       'amount' => '1000mg'],
                    ['name' => 'Caffeine',           'amount' => '100mg'],
                    ['name' => 'CLA',               'amount' => '500mg'],
                ],
                'varian' => [
                    ['flavor' => null, 'weight' => '60 kapsul', 'price' => 320000, 'stock' => 40, 'sku' => 'VBT-60CAP'],
                ],
                'ulasan' => [
                    ['name' => 'Mega W.', 'rating' => 4, 'title' => 'Membantu cut', 'body' => 'Dikombinasikan dengan diet dan cardio, lumayan bantu proses cutting.', 'verified' => true],
                    ['name' => 'Rina D.', 'rating' => 5, 'title' => 'Recommend!',   'body' => 'Setelah 1 bulan turun 3kg. Efeknya kerasa tapi ga bikin gelisah.', 'verified' => true],
                ],
            ],
        ];

        foreach ($produkData as $data) {
            $kategori = Kategori::where('name', $data['kategori'])->first();

            $produk = Produk::create([
                'kategori_id'            => $kategori->id,
                'name'                   => $data['name'],
                'slug'                   => Str::slug($data['name']),
                'short_description'      => $data['short'],
                'brand'                  => $data['brand'],
                'base_price'             => $data['price'],
                'stock'                  => $data['stock'],
                'benefits'               => $data['benefits'],
                'nutrition_facts'        => $data['nutrition'],
                'serving_size'           => $data['serving'],
                'servings_per_container' => $data['servings'],
                'status'                 => 'active',
                'is_featured'            => $data['featured'],
            ]);

            foreach ($data['varian'] as $v) {
                Varian::create([
                    'produk_id'    => $produk->id,
                    'flavor'       => $v['flavor'],
                    'weight'       => $v['weight'],
                    'price'        => $v['price'],
                    'stock'        => $v['stock'],
                    'sku'          => $v['sku'],
                    'is_available' => true,
                ]);
            }

            foreach ($data['ulasan'] as $u) {
                Ulasan::create([
                    'produk_id'     => $produk->id,
                    'reviewer_name' => $u['name'],
                    'rating'        => $u['rating'],
                    'title'         => $u['title'],
                    'body'          => $u['body'],
                    'is_verified'   => $u['verified'],
                    'is_visible'    => true,
                ]);
            }
        }
    }
}
