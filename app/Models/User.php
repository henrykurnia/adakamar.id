<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public const ROLES = [
        'Admin' => 'Admin',
        'Staff Gudang' => 'Staff Gudang',
        'Manajer Gudang' => 'Manajer Gudang',
    ];

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];


    public function stockTransactions()
    {
        return $this->hasMany(StockTransaction::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}