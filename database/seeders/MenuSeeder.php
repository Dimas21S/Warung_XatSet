<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $menus = [
            // Pauk
            ['nama_menu' => 'Ayam Ungkep',            'kategori_id' => 1, 'harga' => 5000],
            ['nama_menu' => 'Ayam Bawang Putih',       'kategori_id' => 1, 'harga' => 5000],
            ['nama_menu' => 'Ayam Fresh',              'kategori_id' => 1, 'harga' => 5000],
            ['nama_menu' => 'Ikan Laut Bumbu Kuning',  'kategori_id' => 1, 'harga' => 5000],
            ['nama_menu' => 'Ikan Nila Bumbu Kuning',  'kategori_id' => 1, 'harga' => 5000],
            ['nama_menu' => 'Telur Ayam Rebus',        'kategori_id' => 1, 'harga' => 3000],
            ['nama_menu' => 'Telur Puyuh Rebus',       'kategori_id' => 1, 'harga' => 2000],
            ['nama_menu' => 'Ikan Laut Fresh',         'kategori_id' => 1, 'harga' => 5000],
            ['nama_menu' => 'Ikan Mas Fresh',          'kategori_id' => 1, 'harga' => 5000],
            ['nama_menu' => 'Ikan Salai Patin',        'kategori_id' => 1, 'harga' => 7000],
            ['nama_menu' => 'Ikan Salai Limpek',       'kategori_id' => 1, 'harga' => 7000],

            // Sayur
            ['nama_menu' => 'Kangkung',                'kategori_id' => 2, 'harga' => 3000],
            ['nama_menu' => 'Bayam',                   'kategori_id' => 2, 'harga' => 3000],
            ['nama_menu' => 'Sawi Putih',              'kategori_id' => 2, 'harga' => 3000],
            ['nama_menu' => 'Pitulo + Wortel',         'kategori_id' => 2, 'harga' => 3000],
            ['nama_menu' => 'Capcay',                  'kategori_id' => 2, 'harga' => 4000],
            ['nama_menu' => 'Sayur Sop',               'kategori_id' => 2, 'harga' => 4000],
            ['nama_menu' => 'Daun Ubi Tumbuk',         'kategori_id' => 2, 'harga' => 3000],
            ['nama_menu' => 'Jengkol Rebus',           'kategori_id' => 2, 'harga' => 3000],
            ['nama_menu' => 'Daun Ubi Fresh',          'kategori_id' => 2, 'harga' => 3000],

            // Bumbu & Lainnya
            ['nama_menu' => 'Tahu',                    'kategori_id' => 3, 'harga' => 2000],
            ['nama_menu' => 'Tempe',                   'kategori_id' => 3, 'harga' => 2000],
            ['nama_menu' => 'Santan Murni',            'kategori_id' => 3, 'harga' => 5000],
            ['nama_menu' => 'Bumbu Ayam',              'kategori_id' => 3, 'harga' => 3000],
            ['nama_menu' => 'Bumbu Gulai Ikan',        'kategori_id' => 3, 'harga' => 3000],
            ['nama_menu' => 'Bumbu Gulai/Kalio Ayam',  'kategori_id' => 3, 'harga' => 3000],
            ['nama_menu' => 'Cabe Merah Bulat',        'kategori_id' => 3, 'harga' => 2000],
            ['nama_menu' => 'Cabe Rawit Bulat',        'kategori_id' => 3, 'harga' => 2000],
            ['nama_menu' => 'Cabe Merah Giling',       'kategori_id' => 3, 'harga' => 2000],
            ['nama_menu' => 'Cabe Merah Halus',        'kategori_id' => 3, 'harga' => 2000],
            ['nama_menu' => 'Cabe Hijau Bulat',        'kategori_id' => 3, 'harga' => 2000],
            ['nama_menu' => 'Cabe Hijau Giling',       'kategori_id' => 3, 'harga' => 2000],
            ['nama_menu' => 'Tomat',                   'kategori_id' => 3, 'harga' => 2000],
            ['nama_menu' => 'Bawang Merah Putih',      'kategori_id' => 3, 'harga' => 2000],
        ];

        foreach ($menus as $menu) {
            Menu::create(array_merge($menu, [
                'outlet_id' => 1,
                'stok'      => 50,
            ]));
        }
    }
}
