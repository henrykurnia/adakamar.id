<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'articles';

    protected $fillable = [
        'category_id',
        'user_id',
        'title',
        'slug',
        'thumbnail',
        'excerpt',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Relasi ke kategori artikel.
     *
     * Satu artikel hanya memiliki satu kategori.
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(
            ArticleCategory::class,
            'category_id'
        );
    }

    /**
     * Relasi ke user/penulis.
     *
     * Satu artikel dibuat oleh satu user.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(
            User::class,
            'user_id'
        );
    }

    /**
     * Scope untuk artikel yang sudah dipublikasikan.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'Published');
    }

    /**
     * Scope untuk artikel draft.
     */
    public function scopeDraft($query)
    {
        return $query->where('status', 'Draft');
    }
}