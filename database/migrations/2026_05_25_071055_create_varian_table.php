<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('varian', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')
                ->references('id')
                ->on('produk')
                ->cascadeOnDelete();
            $table->string('flavor')->nullable();
            $table->string('weight')->nullable();
            $table->decimal('price', 10, 2);
            $table->unsignedInteger('stock')->default(0);
            $table->string('sku')->unique();
            $table->boolean('is_available')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('varian');
    }
};
