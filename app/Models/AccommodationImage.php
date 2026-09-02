<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\accommodations;

class AccommodationImage extends Model
{
    use HasFactory;

    protected $table = 'accommodation_images';

    protected $fillable = [
        'accommodation_id',
        'image',
        'sort_order',
    ];

    public function accommodation()
    {
        return $this->belongsTo(
            accommodations::class,
            'accommodation_id'
        );
    }
}