<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'name',
        'value',
    ];

    /**
     * Atribut dimiliki oleh satu produk.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}