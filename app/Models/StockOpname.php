<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StockOpname extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'system_stock',
        'physical_stock',
        'difference',
        'notes',
        'opname_date',
    ];

    protected $casts = [
        'opname_date' => 'date',
    ];

    /**
     * Stock opname milik satu produk.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Stock opname dibuat oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}