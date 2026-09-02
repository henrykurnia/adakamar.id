<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\accommodations;

class accommodation_images extends Model
{
    use HasFactory;

    protected $table = 'accommodation_images';

    protected $fillable = [

        'accommodation_id',
        'image',
        'sort_order',
        
    ];

    public function accomodations()
    {
        return $this->belongsTo(accommodations::class);
    }
}
