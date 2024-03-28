<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('json_data', function (Blueprint $table) {
            $table->id();
            $table->json('data');
            $table->unsignedBigInteger('dataable_id');
            $table->string('dataable_type');
            $table->timestamps();
            $table->index(['dataable_id', 'dataable_type']);
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('json_data');
    }
};
