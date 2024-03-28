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
        Schema::create('kemitraans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("umkm_id");
            $table->unsignedBigInteger("perusahaan_id");

            $table->string("partnership_form");
            $table->string("description")->nullable();
            $table->string("start_of_partnership");
            $table->string("end_of_partnership");
            $table->string("partnership_status");

            $table->foreign("umkm_id")->references("id")->on("umkms")->cascadeOnDelete();
            $table->foreign("perusahaan_id")->references("id")->on("perusahaans")->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kemitraans');
    }
};
