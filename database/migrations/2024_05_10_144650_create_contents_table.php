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
        Schema::create(config('cms.table_names.contents'), function (Blueprint $table) {
            $table->id();
            // $table->foreignId('author_id') // FIXME: disabled author_id in content table temporarily
            //     ->constrained('taxonomies')
            //     ->cascadeOnDelete();
            
            $table->string('layout');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('type');
            $table->text('content');
            $table->string('excerpt');
            $table->json('meta_tags')->nullable();
            $table->json('custom_properties')->nullable();
            $table->integer('order_column');

            $table->foreignId('created_by')
                ->constrained('users');
            $table->foreignId('updated_by')
                ->nullable()
                ->default(null)
                ->constrained('users');
            $table->foreignId('deleted_by')
                ->nullable()
                ->default(null)
                ->constrained('users');

            $table->timestamp('published_at')->nullable()->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contents');
    }
};
