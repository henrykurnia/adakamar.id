<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\StockOpname;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'supplier_id',
        'name',
        'sku',
        'description',
        'purchase_price',
        'selling_price',
        'image',
        'stock',
        'minimum_stock',
    ];

    /**
     * Produk milik satu kategori
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Produk milik satu supplier
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    /**
     * Produk memiliki banyak atribut
     */
    public function attributes()
    {
        return $this->hasMany(ProductAttribute::class);
    }

    /**
     * Produk memiliki banyak transaksi stok
     */
    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

    public function stockOpnames()
    {
        return $this->hasMany(StockOpname::class);
    }
}