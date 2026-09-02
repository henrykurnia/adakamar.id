<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class galleries extends Model
{
    use HasFactory;

    protected $table = 'galleries';

    protected $fillable = [

        
        'title',
        'image',
        'sort_order',
        'is_active',
        
        
    ];

    public function accommodation()
    {
        return $this->belongsTo(
            accommodations::class,
            'accommodation_id'
        );
    }

    
    
}
