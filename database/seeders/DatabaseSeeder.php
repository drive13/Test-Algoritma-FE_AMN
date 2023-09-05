<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        DB::table('products')->insert([
            'kode' => 'BGR1',
            'nama' => 'Buku Gambar',
            'harga' => '3000',
        ]);
        DB::table('products')->insert([
            'kode' => 'BGT1',
            'nama' => 'Buku Tulis',
            'harga' => '2000',
        ]);
        DB::table('products')->insert([
            'kode' => 'PGR1',
            'nama' => 'Penggaris',
            'harga' => '1000',
        ]);
        DB::table('products')->insert([
            'kode' => 'PGPS1',
            'nama' => 'Penghapus',
            'harga' => '500',
        ]);
    }
}
