<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;


class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $current_date = Carbon::now();

        DB::table("sectors")->insert([
            "name" => "Perikanan",
            "slug" => "perikanan",
            "code" => "A",
            "created_at" => $current_date,
            "updated_at" => $current_date,
        ]);

        DB::table("sectors")->insert([
            "name" => "Pertambangan",
            "slug" => "pertambangan",
            "code" => "B",
            "created_at" => $current_date,
            "updated_at" => $current_date,
        ]);

        DB::table("sectors")->insert([
            "name" => "Pertanian",
            "slug" => "pertanian",
            "code" => "C",
            "created_at" => $current_date,
            "updated_at" => $current_date,
        ]);

        DB::table("sectors")->insert([
            "name" => "Peternakan",
            "slug" => "peternakan",
            "code" => "D",
            "created_at" => $current_date,
            "updated_at" => $current_date,
        ]);
    }
}
