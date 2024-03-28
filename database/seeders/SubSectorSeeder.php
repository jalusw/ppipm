<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class SubSectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $current_date = Carbon::now();
        DB::table("sub_sectors")->insert([
            "name" => "Hortikultura",
            "slug" => "hortikultura",
            "code" => "1",
            "description" => "",
            "sector_id" => 3,
            "created_at" => $current_date,
            "updated_at" => $current_date
        ]);
        DB::table("sub_sectors")->insert([
            "name" => "Perkebunan",
            "slug" => "perkebunan",
            "code" => "2",
            "description" => "",
            "sector_id" => 3,
            "created_at" => $current_date,
            "updated_at" => $current_date
        ]);
        DB::table("sub_sectors")->insert([
            "name" => "Batu Bara",
            "slug" => "batu-bara",
            "code" => "1",
            "description" => "",
            "sector_id" => 2,
            "created_at" => $current_date,
            "updated_at" => $current_date
        ]);
        DB::table("sub_sectors")->insert([
            "name" => "Perikanan Budidaya",
            "slug" => "perikanan-budidaya",
            "code" => "1",
            "description" => "",
            "sector_id" => 1,
            "created_at" => $current_date,
            "updated_at" => $current_date
        ]);
    }
}
