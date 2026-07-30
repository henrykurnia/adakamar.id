<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            // User yang membuat produk
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('supplier_id')
                ->constrained('suppliers')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('name');

            $table->string('sku')->unique();

            $table->text('description')->nullable();

            $table->decimal('purchase_price', 15, 2);

            $table->decimal('selling_price', 15, 2);

            // Stok saat ini
            $table->integer('stock')->default(0);

            // Batas minimum stok
            $table->integer('minimum_stock')->default(0);

            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};