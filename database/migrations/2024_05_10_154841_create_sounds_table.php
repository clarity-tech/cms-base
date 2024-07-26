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
        Schema::create(config('cms.table_names.sounds'), function (Blueprint $table) {
            $table->id();
            $table->foreignId('type_id')
                ->constrained('taxonomies')
                ->cascadeOnDelete();
            $table->foreignId('artist_id')
                ->constrained('taxonomies')
                ->cascadeOnDelete();
            $table->foreignId('genre_id')
                ->constrained('taxonomies')
                ->cascadeOnDelete();

            $table->string('title');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sounds');
    }
};
