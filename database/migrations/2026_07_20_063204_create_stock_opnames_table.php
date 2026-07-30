<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('stock_opnames', function (Blueprint $table) {
            $table->id();

            // User yang melakukan stock opname
            $table->foreignId('user_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('product_id')
                ->constrained('products')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            // Stok yang tercatat di sistem saat opname
            $table->integer('system_stock');

            // Stok hasil perhitungan fisik
            $table->integer('physical_stock');

            // Selisih = physical_stock - system_stock
            $table->integer('difference');

            // Keterangan jika ada selisih
            $table->text('notes')->nullable();

            // Tanggal pelaksanaan stock opname
            $table->date('opname_date');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stock_opnames');
    }
};