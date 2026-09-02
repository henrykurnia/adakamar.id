<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class article_categories extends Model
{
    use HasFactory;

    protected $table = 'article_categories';

    protected $fillable = [

        'name',
        'slug',
        'description',
        'is_active',

    ];

    
}
