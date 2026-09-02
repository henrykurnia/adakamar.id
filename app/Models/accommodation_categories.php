<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class accommodation_categories extends Model
{
    use HasFactory;

    protected $table = 'accommodation_categories';

    protected $fillable = [

        'name',
        'slug',
        'description',
        
        'image',
        
    ];
}
