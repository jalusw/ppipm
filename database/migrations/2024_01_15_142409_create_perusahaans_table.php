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
        Schema::create('perusahaans', function (Blueprint $table) {
            $table->id();
            $table->string("business_name");
            $table->string("email");
            $table->string("phone_number");
            $table->string("address");
            $table->unsignedBigInteger("personal_data_id")->nullable();
            $table->unsignedBigInteger("kecamatan_id")->nullable();
            $table->unsignedBigInteger("kelurahan_id")->nullable();
            $table->unsignedBigInteger("jenis_perusahaan_id")->nullable();

            $table->foreign("personal_data_id")->references("id")->on("personal_data")->nullOnDelete()->cascadeOnUpdate();
            $table->foreign("kecamatan_id")->references("id")->on("kecamatans")->nullOnDelete()->cascadeOnUpdate();
            $table->foreign("jenis_perusahaan_id")->references("id")->on("jenis_perusahaan")->nullOnDelete()->cascadeOnUpdate();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perusahaans');
    }
};
