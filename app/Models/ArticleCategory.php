<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ArticleCategory extends Model
{
    use HasFactory;

    protected $table = 'article_categories';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relasi ke articles.
     *
     * Satu kategori dapat memiliki banyak artikel.
     */
    public function articles(): HasMany
    {
        return $this->hasMany(
            Article::class,
            'category_id'
        );
    }
}