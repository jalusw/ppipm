<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisPerusahaanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("jenis_perusahaan")->insert([
            'name' => "Perorangan",
            'description' => ""
        ]);
        DB::table("jenis_perusahaan")->insert([
            'name' => "Persekutuan Comanditer",
            'description' => ""
        ]);
    }
}
