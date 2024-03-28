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
        Schema::create('comodities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("sub_sector_id")->nullable();
            $table->string("name")->unique();
            $table->string("slug");
            $table->string("image");
            $table->boolean("archived")->default(false);
            $table->text("description")->nullable();
            $table->foreign("sub_sector_id")
                ->references("id")
                ->on("sub_sectors")
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comodities');
    }
};
