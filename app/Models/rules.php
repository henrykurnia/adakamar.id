<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rules extends Model
{
    use HasFactory;

    protected $table = 'rules';

    protected $fillable = [

        'name',
        'description',
        'is_active',
        
    ];
}
