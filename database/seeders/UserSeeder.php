<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Carbon;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $current_date = Carbon::now();

        $user = DB::table("users")->insert([
            "name" => "Super Admin",
            "username" => "admin",
            "password" => Hash::make("4dm1n#<3"),
            "is_active" => '1',
            "created_at" => $current_date,
            "updated_at" => $current_date,
        ]);

    }
}
