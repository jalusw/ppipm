<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('umkms', function (Blueprint $table) {
            $table->id();
            $table->char("nib", 13)->unique();
            $table->string("business_name");
            $table->string("email");
            $table->string("phone_number");
            $table->char("kbli", 5);
            $table->string("address");
            $table->unsignedBigInteger("capital");
            $table->unsignedBigInteger("personal_data_id")->nullable();
            $table->unsignedBigInteger("kecamatan_id")->nullable();
            $table->unsignedBigInteger("kelurahan_id")->nullable();
            $table->unsignedBigInteger("jenis_perusahaan_id")->nullable();
            $table->unsignedBigInteger("status_penanaman_modal_id")->nullable();

            $table->foreign("personal_data_id")->references("id")->on("personal_data")->nullOnDelete()->cascadeOnUpdate();
            $table->foreign("kecamatan_id")->references("id")->on("kecamatans")->nullOnDelete()->cascadeOnUpdate();
            $table->foreign("kelurahan_id")->references("id")->on("kelurahans")->nullOnDelete()->cascadeOnUpdate();
            $table->foreign("jenis_perusahaan_id")->references("id")->on("jenis_perusahaan")->nullOnDelete()->cascadeOnUpdate();
            $table->foreign("status_penanaman_modal_id")->references("id")->on("status_penanaman_modals")->nullOnDelete()->cascadeOnUpdate();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('umkms');
    }
};
