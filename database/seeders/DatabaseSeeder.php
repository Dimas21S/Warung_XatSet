<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Menu;
use App\Models\Outlets;
use App\Models\Kategori;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $kategoris = ['Lauk', 'Sayur', 'Bumbu'];

        foreach ($kategoris as $kategori) {
            Kategori::create([
                'nama_kategori' => $kategori
            ]);
        }

        $outlets = [
            [ 'nama_daerah' => 'Rao', 'alamat' => 'Jl. Contoh No. 123, Kota Contoh'],
            [ 'nama_daerah' => 'Lubuk Sikaping', 'alamat' => 'Jl. Contoh No. 456, Kota Contoh'],
        ];

        foreach ($outlets as $outlet) {
            Outlets::create($outlet);
        }

        $this->call(MenuSeeder::class);
    }
}
