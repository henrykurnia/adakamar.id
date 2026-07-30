<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StockTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_id',
        'type',
        'quantity',
        'date',
        'status',
        'notes',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    /**
     * Transaksi stok dimiliki oleh satu produk.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Transaksi stok dilakukan oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}