<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusPenanamanModalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table("status_penanaman_modals")->insert([
            'name' => "PMDN",
            'description' => "Penanaman Modal Dalam Negeri"
        ]);

        DB::table("status_penanaman_modals")->insert([
            'name' => "PMA",
            'description' => "Penanaman Modal Asing"
        ]);
    }
}
