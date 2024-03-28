<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("permissions")->insert([
            "name" => "Manage User",
            "access_code" => "management.users",
        ]);

        DB::table("permissions")->insert([
            "name" => "Manage Permissions",
            "access_code" => "management.permissions",
        ]);

        DB::table("permissions")->insert([
            "name" => "Manage Sectors",
            "access_code" => "management.sectors",
        ]);

        DB::table("permissions")->insert([
            "name" => "Manage Sub Sectors",
            "access_code" => "management.sub-sectors",
        ]);

        DB::table("permissions")->insert([
            "name" => "Manage Comodities",
            "access_code" => "management.comodities",
        ]);

        DB::table("permissions")->insert([
            "name" => "Manage Master Categories",
            "access_code" => "management.master-categories",
        ]);

        DB::table("permissions")->insert([
            "name" => "Manage Tipe File",
            "access_code" => "management.file-types",
        ]);

        DB::table("permissions")->insert([
            "name" => "Manage Kecamatan",
            "access_code" => "management.kecamatans",
        ]);

        DB::table("permissions")->insert([
            "name" => "Manage Kelurahan",
            "access_code" => "management.kelurahans",
        ]);

        DB::table("permissions")->insert([
            "name" => "Manage Jenis Perusahaan",
            "access_code" => "management.jenis-perusahaans",
        ]);

        DB::table("permissions")->insert([
            "name" => "Manage Status Penanaman Modal",
            "access_code" => "management.status-penanaman-modals",
        ]);

        DB::table("permissions")->insert([
            "name" => "Manage UMKMS",
            "access_code" => "management.umkms",
        ]);

        DB::table("permissions")->insert([
            "name" => "Manage Perusahaan",
            "access_code" => "management.perusahaans",
        ]);

        DB::table("permissions")->insert([
            "name" => "Manage Kemitraan",
            "access_code" => "management.kemitraans",
        ]);

        DB::table("permissions")->insert([
            "name" => "Authorization",
            "access_code" => "management.authorize",
        ]);

        for ($i = 1; $i < 15; $i++) {
            DB::table("permission_user")->insert([
                'user_id' => 1,
                'permission_id' => $i
            ]);
        }


    }
}
