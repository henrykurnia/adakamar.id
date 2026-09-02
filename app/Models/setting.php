<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $table = 'settings';

    protected $fillable = [
        // Informasi Website
        'site_name',
        'tagline',
        'about',

        // Branding
        'logo',
        'favicon',

        // Kontak
        'address',
        'phone',
        'whatsapp',
        'email',

        // Lokasi
        
        'maps_embed',

        // Sosial Media
        'facebook',
        'instagram',
        'youtube',
        'tiktok',

        // SEO Default
        'meta_title',
        'meta_description',
        'meta_keywords',

        // Footer
        'footer_description',
        'copyright',
    ];
}
