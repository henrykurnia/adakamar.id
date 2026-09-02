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
        Schema::create('settings', function (Blueprint $table) {
            $table->id();

            // Informasi Website
            $table->string('site_name');
            $table->string('tagline')->nullable();
            $table->longText('about')->nullable();

            // Branding
            $table->string('logo')->nullable();
            

            // Kontak
            $table->text('address')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('whatsapp', 20)->nullable();
            $table->string('email')->nullable();

            // Lokasi
            $table->longText('maps_embed')->nullable();

            // Sosial Media
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('x')->nullable();
            $table->string('youtube')->nullable();
            $table->string('tiktok')->nullable();

            // SEO Default
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();

            // Footer
            $table->text('footer_description')->nullable();
            $table->string('copyright')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};