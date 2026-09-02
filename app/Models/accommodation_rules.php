<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\accommodations;

class accommodation_rules extends Model
{
    use HasFactory;

    protected $table = 'accommodation_rules';

    protected $fillable = [

        'accommodation_id',
        'rule_id',
    
    ];

    public function accommodations()
    {
        return $this->belongsTo(accommodations::class);
    }
}
