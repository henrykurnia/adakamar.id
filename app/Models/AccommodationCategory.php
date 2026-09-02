<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AccommodationCategory extends Model
{
    use HasFactory;

    /**
     * Nama tabel.
     */
    protected $table = 'accommodation_categories';

    /**
     * Kolom yang boleh diisi secara mass assignment.
     */
    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'description',
    ];

    /**
     * Relasi ke accommodation.
     *
     * Satu kategori memiliki banyak accommodation.
     */
    public function accommodations(): HasMany
    {
        return $this->hasMany(
            Accommodation::class,
            'category_id'
        );
    }
}