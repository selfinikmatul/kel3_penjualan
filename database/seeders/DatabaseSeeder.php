<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

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

         DB::table('table_barang')->insert([
            [
                'nama_barang' => 'Topi',
                'harga' => 15000,
                'stok' => 10,
                'kategori' => 'Seragam',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_barang' => 'Dasi',
                'harga' => 12000,
                'stok' => 8,
                'kategori' => 'Seragam',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_barang' => 'Bolpoin',
                'harga' => 3000,
                'stok' => 25,
                'kategori' => 'ATK',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_barang' => 'Ikat Pinggang',
                'harga' => 18000,
                'stok' => 7,
                'kategori' => 'Seragam',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_barang' => 'Kaos Kaki',
                'harga' => 10000,
                'stok' => 15,
                'kategori' => 'Seragam',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_barang' => 'Kerudung',
                'harga' => 25000,
                'stok' => 6,
                'kategori' => 'Seragam',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
