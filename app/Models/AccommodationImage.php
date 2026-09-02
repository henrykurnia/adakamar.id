<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccommodationImage extends Model
{
    use HasFactory;

    /**
     * Nama tabel.
     */
    protected $table = 'accommodation_images';

    /**
     * Kolom yang boleh diisi secara mass assignment.
     */
    protected $fillable = [
        'accommodation_id',
        'image',
        'sort_order',
    ];

    /**
     * Casting tipe data.
     */
    protected $casts = [
        'sort_order' => 'integer',
    ];

    /**
     * Relasi ke Accommodation.
     *
     * Satu gambar dimiliki oleh satu accommodation.
     */
    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(
            Accommodation::class,
            'accommodation_id'
        );
    }
}