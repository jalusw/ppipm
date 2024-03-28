<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KecamatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("kecamatans")->insert([
            'name' => 'Bakarangan'
        ]);

        DB::table("kecamatans")->insert([
            'name' => 'Binuang'
        ]);

        DB::table("kecamatans")->insert([
            'name' => 'Bungur'
        ]);

        DB::table("kecamatans")->insert([
            'name' => 'Candi Laras Selatan'
        ]);

        DB::table("kecamatans")->insert([
            'name' => 'Candi Laras Utara'
        ]);

        DB::table("kecamatans")->insert([
            'name' => 'Hatungun'
        ]);

        DB::table("kecamatans")->insert([
            'name' => 'Lokpaikat'
        ]);

        DB::table("kecamatans")->insert([
            'name' => 'Piani'
        ]);

        DB::table("kecamatans")->insert([
            'name' => 'Salam Babaris'
        ]);

        DB::table("kecamatans")->insert([
            'name' => 'Tapin Selatan'
        ]);

        DB::table("kecamatans")->insert([
            'name' => 'Tapin Tengah'
        ]);

        DB::table("kecamatans")->insert([
            'name' => 'Tapin Utara'
        ]);
    }

}
