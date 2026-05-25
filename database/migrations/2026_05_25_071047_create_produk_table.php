<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('produk', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kategori_id')
                ->references('id')
                ->on('kategori')
                ->cascadeOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->longText('description')->nullable();
            $table->string('brand')->nullable();
            $table->decimal('base_price', 10, 2);
            $table->unsignedInteger('stock')->default(0);
            $table->string('main_image')->nullable();
            $table->json('benefits')->nullable();
            $table->json('nutrition_facts')->nullable();
            $table->string('serving_size')->nullable();
            $table->string('servings_per_container')->nullable();
            $table->enum('status', ['active', 'inactive', 'out_of_stock'])->default('active');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('produk');
    }
};
