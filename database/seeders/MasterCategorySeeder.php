<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MasterCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("master_categories")->insert([
            'name' => "Komoditas Unggulan",
            'slug' => "komoditas-unggulan"
        ]);

        DB::table("master_categories")->insert([
            'name' => "Sub Sektor Unggulan",
            'slug' => "sub-sektor-unggulan"
        ]);

        DB::table("master_categories")->insert([
            'name' => "Sektor Unggulan",
            'slug' => "sektor-unggulan"
        ]);
    }

}
