<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccommodationFacility extends Model
{
    use HasFactory;

    protected $table = 'accommodation_facilities';

    protected $fillable = [
        'accommodation_id',
        'facility_id',
    ];

    /**
     * Relasi ke accommodation.
     *
     * Satu data pivot dimiliki oleh satu accommodation.
     */
    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(
            Accommodation::class,
            'accommodation_id'
        );
    }

    /**
     * Relasi ke facility.
     *
     * Satu data pivot dimiliki oleh satu facility.
     */
    public function facility(): BelongsTo
    {
        return $this->belongsTo(
            Facility::class,
            'facility_id'
        );
    }
}