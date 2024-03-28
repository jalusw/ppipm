<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;

class ComoditySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $current_datetime = Carbon::now();

        DB::table("comodities")->insert([
            "name" => "Cabai Hiyung",
            "slug" => "cabai-hiyung",
            "sub_sector_id" => 1,
            "description" => "",
            "created_at" => $current_datetime,
            "updated_at" => $current_datetime,
        ]);

        DB::table("comodities")->insert([
            "name" => "Pembibitan dan Penggemukan Sapi",
            "slug" => "pembibitan-dan-penggemukan-sapi",
            "sub_sector_id" => 1,
            "description" => "",
            "created_at" => $current_datetime,
            "updated_at" => $current_datetime,
        ]);

    }
}
