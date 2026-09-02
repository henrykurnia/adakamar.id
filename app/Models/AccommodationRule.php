<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AccommodationRule extends Model
{
    use HasFactory;

    /**
     * Nama tabel.
     */
    protected $table = 'accommodation_rules';

    /**
     * Kolom yang boleh diisi secara mass assignment.
     */
    protected $fillable = [
        'accommodation_id',
        'rule_id',
    ];

    /**
     * Relasi ke Accommodation.
     */
    public function accommodation(): BelongsTo
    {
        return $this->belongsTo(
            Accommodation::class,
            'accommodation_id'
        );
    }

    /**
     * Relasi ke Rule.
     */
    public function rule(): BelongsTo
    {
        return $this->belongsTo(
            Rule::class,
            'rule_id'
        );
    }
}