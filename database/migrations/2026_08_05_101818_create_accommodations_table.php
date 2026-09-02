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
        Schema::create('accommodations', function (Blueprint $table) {
            $table->id();

            // Relasi ke kategori penginapan
            $table->foreignId('category_id')
                ->constrained('accommodation_categories')
                ->cascadeOnDelete();

            // Informasi Penginapan
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('thumbnail');

            // Harga
            $table->decimal('price', 12, 2);

            // Detail Penginapan
            $table->string('address');

            $table->integer('capacity')->default(1);
            $table->integer('bedroom')->default(1);
            $table->integer('bathroom')->default(1);

            $table->string('size')->nullable();

            // Status
            $table->enum('status', [
                'Available',
                'Full',
                'Maintenance'
            ])->default('Available');

            // Deskripsi
            $table->longText('description');

            // SEO
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accommodations');
    }
};