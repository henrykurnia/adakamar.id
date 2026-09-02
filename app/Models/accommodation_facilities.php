<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\accommodations;
use App\Models\facilities;

class accommodation_facilities extends Model
{
    use HasFactory;

    protected $table = 'accommodation_facilities';

    protected $fillable = [

        'accommodation_id',
        'facility_id',
        
    ];

    public function accommodations()
    {
        return $this->belongsTo(accommodations::class);
    }

    public function facilities()
    {
        return $this->belongsTo(facilities::class);
    }
}
